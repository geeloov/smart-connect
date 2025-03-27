<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobPosition;
use App\Events\JobApplicationSubmitted;
use App\Events\JobApplicationStatusUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\CV;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of available job positions for job seekers.
     */
    public function availableJobs(Request $request)
    {
        $query = JobPosition::active()->latest();
        
        // Apply search filters if provided
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        if ($request->has('location') && !empty($request->location)) {
            $location = $request->location;
            $query->where('location', 'like', "%{$location}%");
        }
        
        // Apply job type filter if provided
        if ($request->has('job_type') && !empty($request->job_type)) {
            $query->where('job_type', $request->job_type);
        }
        
        // Paginate the results instead of getting all at once
        $jobPositions = $query->paginate(9);
        $jobPositions->appends($request->query());
        
        return view('job-seeker.jobs.available', compact('jobPositions'));
    }
    
    /**
     * Display a job position details.
     */
    public function jobDetails(JobPosition $jobPosition)
    {
        // Check if the job is active
        if (!$jobPosition->is_active) {
            abort(404, 'Job position not found or no longer active.');
        }
        
        // Load the recruiter relationship
        $jobPosition->load('recruiter');
        
        // Check if the user has already applied
        $hasApplied = false;
        if (Auth::check()) {
            $hasApplied = JobApplication::where('user_id', Auth::id())
                ->where('job_position_id', $jobPosition->id)
                ->exists();
        }
        
        return view('job-seeker.jobs.details', compact('jobPosition', 'hasApplied'));
    }
    
    /**
     * Show the form for creating a new job application.
     */
    public function create(JobPosition $jobPosition)
    {
        // Check if the job is active
        if (!$jobPosition->is_active) {
            abort(404, 'Job position not found or no longer active.');
        }
        
        // Check if the user has already applied
        $hasApplied = JobApplication::where('user_id', Auth::id())
            ->where('job_position_id', $jobPosition->id)
            ->exists();
            
        if ($hasApplied) {
            return redirect()->route('job-seeker.applications.index')
                ->with('info', 'You have already applied for this job position.');
        }
        
        // Get the user's default CV if available
        $defaultCV = Auth::user()->defaultCV();
        
        return view('job-seeker.applications.create', compact('jobPosition', 'defaultCV'));
    }
    
    /**
     * Store a newly created job application in storage.
     */
    public function store(Request $request, JobPosition $jobPosition)
    {
        // Start debug logging
        Log::info('========== JOB APPLICATION SUBMISSION STARTED ==========', [
            'user_id' => Auth::id(),
            'job_position_id' => $jobPosition->id,
            'job_title' => $jobPosition->title,
            'time' => now()->toDateTimeString()
        ]);
        
        // IMPORTANT DEBUGGING: Check if backend is running
        $pythonBackend = config('services.cv_extraction.api_url', 'http://localhost:5000');
        $backendRunning = false;
        
        try {
            $healthCheck = Http::timeout(2)->get(rtrim($pythonBackend, '/') . '/api/health-check');
            $backendRunning = $healthCheck->successful();
            
            Log::info('Python CV extraction backend status', [
                'running' => $backendRunning,
                'response' => $backendRunning ? $healthCheck->json() : 'Failed',
                'url' => $pythonBackend
            ]);
        } catch (\Exception $e) {
            Log::error('Python backend is not running!', [
                'url' => $pythonBackend,
                'error' => $e->getMessage()
            ]);
            
            return redirect()->back()
                ->with('error', 'The CV processing service is not running. Please ask an administrator to start the Python backend server.')
                ->withInput();
        }
        
        if (!$backendRunning) {
            return redirect()->back()
                ->with('error', 'The CV processing service is not available. Please ask an administrator to check that the Python backend server is running properly at ' . $pythonBackend)
                ->withInput();
        }

        Log::info('CV Extraction backend is running successfully');
        
        // Validate the request with conditional validation
        $request->validate([
            'cv_file' => $request->has('use_default_cv') ? 'nullable' : 'required|mimes:pdf|max:10240', // 10MB max
            'cover_letter' => 'nullable|string|max:5000',
            'use_default_cv' => 'nullable|boolean',
        ]);
        
        Log::info('Validation passed successfully');
        
        try {
            // Check if the user has already applied for this job
            $existingApplication = JobApplication::where('user_id', Auth::id())
                ->where('job_position_id', $jobPosition->id)
                ->first();
                
            if ($existingApplication) {
                Log::info('User already applied for this position', [
                    'application_id' => $existingApplication->id,
                    'created_at' => $existingApplication->created_at
                ]);
                return redirect()->back()->with('error', 'You have already applied for this position.');
            }
            
            // Initialize variables
            $fileName = null;
            $cvData = null;
            $matchingData = null;
            $apiResponse = null;
            
            // Get extraction controller to access its methods
            $extractionController = app()->make('App\Http\Controllers\CVExtractionController');
            
            Log::info('Preparing to process CV', [
                'is_default_cv' => $request->has('use_default_cv'),
                'has_cv_file' => $request->hasFile('cv_file')
            ]);
            
            if ($request->has('use_default_cv')) {
                // Use the default CV logic
                $defaultCV = CV::where('user_id', Auth::id())
                    ->where('is_default', true)
                    ->first();
                
                if (!$defaultCV) {
                    Log::error('No default CV found for user', ['user_id' => Auth::id()]);
                    return redirect()->back()->with('error', 'No default CV found. Please upload a CV.');
                }
                
                $fileName = $defaultCV->file_name;
                
                Log::info('Using default CV', [
                    'cv_id' => $defaultCV->id,
                    'file_name' => $fileName,
                    'has_extracted_data' => !empty($defaultCV->extracted_data),
                    'user_id' => Auth::id(),
                    'user_name' => Auth::user()->name
                ]);
                
                // IMPROVED CV FILE FINDING LOGIC

                // First check if we can get the file directly from the database path
                $filePath = null;
                
                // Check if file_path from database exists
                if (!empty($defaultCV->file_path)) {
                    $filePath = $defaultCV->file_path;
                    if (file_exists($filePath)) {
                        Log::info('Using file_path directly from database', [
                            'file_path' => $filePath
                        ]);
                    } else {
                        Log::warning('file_path from database exists but file not found', [
                            'file_path' => $filePath
                        ]);
                        $filePath = null;
                    }
                }

                // If filename might contain a timestamp or user_id format, try to find matching files
                if (!$filePath) {
                    $userName = Auth::user()->name;
                    $userId = Auth::id();
                    
                    // Common CV naming patterns to search for
                    $possiblePatterns = [
                        "*_{$userId}_*", // Files with user ID pattern
                        "*_{$userId}_{$fileName}", // Files with user ID and exact filename
                        "*_{$fileName}", // Files with any prefix but exact filename
                        str_replace(' ', '_', "*_{$userName}*"), // Files with username
                        '*' . basename($fileName) // File with exact basename regardless of prefix
                    ];
                    
                    $cvDirectories = [
                        public_path('storage/cvs'),
                        public_path('storage/cv_files'),
                        storage_path('app/public/cvs'),
                        storage_path('app/public/cv_files'),
                        base_path('cv-extraction-laravel/public/storage/cvs'),
                        base_path('cv-extraction-laravel/public/storage/cv_files')
                    ];
                    
                    Log::info('Searching for CV files with patterns', [
                        'user_id' => $userId,
                        'user_name' => $userName,
                        'patterns' => $possiblePatterns,
                        'directories' => $cvDirectories
                    ]);
                    
                    foreach ($cvDirectories as $directory) {
                        if (!is_dir($directory)) {
                            continue;
                        }
                        
                        foreach ($possiblePatterns as $pattern) {
                            $matchingFiles = glob($directory . '/' . $pattern);
                            if (!empty($matchingFiles)) {
                                // Sort files by modification time, newest first
                                usort($matchingFiles, function($a, $b) {
                                    return filemtime($b) - filemtime($a);
                                });
                                
                                $filePath = $matchingFiles[0];
                                Log::info('Found matching CV file using pattern', [
                                    'pattern' => $pattern,
                                    'directory' => $directory,
                                    'found_file' => $filePath
                                ]);
                                
                                // Update fileName to match the actual file
                                $fileName = basename($filePath);
                                
                                // Update the database record with the correct file path and name
                                $defaultCV->file_path = $filePath;
                                $defaultCV->file_name = $fileName;
                                $defaultCV->save();
                                
                                Log::info('Updated default CV record with correct file info', [
                                    'cv_id' => $defaultCV->id,
                                    'file_name' => $fileName,
                                    'file_path' => $filePath
                                ]);
                                
                                break 2; // Break both loops
                            }
                        }
                    }
                }
                
                // If still no file found, try the static paths as before
                if (!$filePath) {
                    // Get the physical file path - Try multiple possible locations
                    $possiblePaths = [
                        storage_path('app/public/cv_files/' . $fileName),
                        storage_path('app/public/cvs/' . $fileName),
                        public_path('storage/cvs/' . $fileName),
                        public_path('storage/cv_files/' . $fileName),
                        storage_path('app/cvs/' . $fileName),
                        storage_path('app/cv_files/' . $fileName),
                        storage_path('cvs/' . $fileName),
                        storage_path('cv_files/' . $fileName),
                        public_path('cvs/' . $fileName),
                        public_path('cv_files/' . $fileName),
                        base_path('storage/app/public/cvs/' . $fileName),
                        base_path('storage/app/public/cv_files/' . $fileName),
                        base_path('public/storage/cvs/' . $fileName),
                        base_path('public/storage/cv_files/' . $fileName),
                        base_path('cv-extraction-laravel/public/storage/cvs/' . $fileName),
                        base_path('cv-extraction-laravel/public/storage/cv_files/' . $fileName),
                        base_path('cv-extraction-laravel/storage/app/public/cvs/' . $fileName),
                        base_path('cv-extraction-laravel/storage/app/public/cv_files/' . $fileName),
                        'cv-extraction-laravel/public/storage/cvs/' . $fileName,
                        'cv-extraction-laravel/public/storage/cv_files/' . $fileName,
                        'cv-extraction-laravel/storage/app/public/cvs/' . $fileName,
                        'cv-extraction-laravel/storage/app/public/cv_files/' . $fileName,
                        'public/storage/cvs/' . $fileName,
                        'public/storage/cv_files/' . $fileName,
                        'storage/app/public/cvs/' . $fileName,
                        'storage/app/public/cv_files/' . $fileName
                    ];
                    
                    // Print debug info about the file we're looking for
                    Log::info('Looking for default CV file with details:', [
                        'fileName' => $fileName,
                        'defaultCV_id' => $defaultCV->id,
                        'storage_path_base' => storage_path(),
                        'public_path_base' => public_path(),
                        'base_path' => base_path()
                    ]);
                    
                    foreach ($possiblePaths as $path) {
                        if (file_exists($path)) {
                            $filePath = $path;
                            Log::info('Found default CV file at: ' . $filePath);
                            break;
                        }
                    }
                }
                
                // If there's extracted data, use it
                if ($defaultCV->extracted_data) {
                    $cvData = is_string($defaultCV->extracted_data) ? 
                        json_decode($defaultCV->extracted_data, true) : 
                        $defaultCV->extracted_data;
                        
                    Log::info('Using extracted data from default CV', [
                        'cv_id' => $defaultCV->id,
                        'data_type' => gettype($cvData),
                        'is_array' => is_array($cvData),
                        'has_keys' => is_array($cvData) ? implode(', ', array_keys($cvData)) : 'not an array'
                    ]);
                } else {
                    // No extracted data exists, so we need to extract it now
                    Log::info('No extracted data found for default CV, attempting extraction now', [
                        'cv_id' => $defaultCV->id,
                        'file_name' => $fileName
                    ]);
                    
                    // Get the physical file path - Try multiple possible locations
                    $possiblePaths = [
                        storage_path('app/public/cv_files/' . $fileName),
                        storage_path('app/public/cvs/' . $fileName),
                        public_path('storage/cvs/' . $fileName),
                        public_path('storage/cv_files/' . $fileName),
                        storage_path('app/cvs/' . $fileName),
                        storage_path('app/cv_files/' . $fileName),
                        storage_path('cvs/' . $fileName),
                        storage_path('cv_files/' . $fileName),
                        public_path('cvs/' . $fileName),
                        public_path('cv_files/' . $fileName),
                        base_path('storage/app/public/cvs/' . $fileName),
                        base_path('storage/app/public/cv_files/' . $fileName),
                        base_path('public/storage/cvs/' . $fileName),
                        base_path('public/storage/cv_files/' . $fileName),
                        base_path('cv-extraction-laravel/public/storage/cvs/' . $fileName),
                        base_path('cv-extraction-laravel/public/storage/cv_files/' . $fileName),
                        base_path('cv-extraction-laravel/storage/app/public/cvs/' . $fileName),
                        base_path('cv-extraction-laravel/storage/app/public/cv_files/' . $fileName),
                        'cv-extraction-laravel/public/storage/cvs/' . $fileName,
                        'cv-extraction-laravel/public/storage/cv_files/' . $fileName,
                        'cv-extraction-laravel/storage/app/public/cvs/' . $fileName,
                        'cv-extraction-laravel/storage/app/public/cv_files/' . $fileName,
                        'public/storage/cvs/' . $fileName,
                        'public/storage/cv_files/' . $fileName,
                        'storage/app/public/cvs/' . $fileName,
                        'storage/app/public/cv_files/' . $fileName
                    ];
                    
                    // Print debug info about the file we're looking for
                    Log::info('Looking for default CV file with details:', [
                        'fileName' => $fileName,
                        'defaultCV_id' => $defaultCV->id,
                        'storage_path_base' => storage_path(),
                        'public_path_base' => public_path(),
                        'base_path' => base_path()
                    ]);
                    
                    $filePath = null;
                    foreach ($possiblePaths as $path) {
                        if (file_exists($path)) {
                            $filePath = $path;
                            Log::info('Found default CV file at: ' . $filePath);
                            break;
                        }
                    }
                    
                    if (!$filePath) {
                        // If still no file found, try to locate any PDFs anywhere in the storage directory
                        if (!$filePath) {
                            Log::info('Searching entire storage for PDFs as last resort...');
                            $allPDFs = glob(storage_path('app') . '/**/*.pdf', GLOB_NOSORT);
                            
                            if (!empty($allPDFs)) {
                                $filePath = $allPDFs[0];
                                Log::info('Found PDF via deep search: ' . $filePath);
                            }
                        }
                        
                        // If still no file found, let's actually download a sample CV
                        if (!$filePath) {
                            Log::info('No CV files found in any location. Cannot proceed without a CV file.');
                        }
                        
                        if (!$filePath) {
                            Log::error('Default CV file not found on disk after extensive search. Checking for extracted data...', [
                                'cv_id' => $defaultCV->id,
                                'has_extracted_data' => !empty($defaultCV->extracted_data)
                            ]);
                            
                            // If we already have extracted data, we can proceed without the physical file
                            if (!empty($defaultCV->extracted_data)) {
                                Log::info('Using existing extracted data even though physical file not found', [
                                    'cv_id' => $defaultCV->id,
                                    'extracted_data_length' => strlen($defaultCV->extracted_data)
                                ]);
                                
                                // Skip the API call since we already have the data
                                goto skip_cv_extraction_api_call;
                            }
                            
                            return redirect()->back()->with('error', 'Default CV file not found. Please upload a new CV.');
                        }
                    }
                    
                    if (!$filePath) {
                        Log::error('Default CV file not found on disk after extensive search. Checking for extracted data...', [
                            'cv_id' => $defaultCV->id,
                            'has_extracted_data' => !empty($defaultCV->extracted_data)
                        ]);
                        
                        // If we already have extracted data, we can proceed without the physical file
                        if (!empty($defaultCV->extracted_data)) {
                            Log::info('Using existing extracted data even though physical file not found', [
                                'cv_id' => $defaultCV->id,
                                'extracted_data_length' => strlen($defaultCV->extracted_data)
                            ]);
                            
                            // Skip the API call since we already have the data
                            goto skip_cv_extraction_api_call;
                        }
                        
                        return redirect()->back()->with('error', 'Default CV file not found. Please upload a new CV.');
                    }
                    
                    Log::info('Default CV file found, preparing to send to extraction API', [
                        'file_path' => $filePath,
                        'file_size' => filesize($filePath)
                    ]);
                    
                    // Prepare to call the extraction API
                    try {
                        // First check if API is running
                        $healthCheckUrl = rtrim(config('services.cv_extraction.api_url', 'http://localhost:5000'), '/') . '/api/health-check';
                        $healthCheckResponse = Http::timeout(5)->get($healthCheckUrl);
                        
                        if (!$healthCheckResponse->successful()) {
                            Log::error('CV extraction API is not available (for default CV)', [
                                'health_check_status' => $healthCheckResponse->status(),
                                'health_check_body' => $healthCheckResponse->body()
                            ]);
                            return redirect()->back()
                                ->with('error', 'The CV extraction service is currently unavailable. Please try again later.')
                                ->withInput();
                        }
                        
                        // API is running, now prepare the request
                        $extractionUrl = rtrim(config('services.cv_extraction.api_url', 'http://localhost:5000'), '/') . '/api/extract-cv';
                        Log::info('CV extraction API is available, sending default CV for extraction', [
                            'api_url' => $extractionUrl,
                            'cv_id' => $defaultCV->id
                        ]);
                        
                        // Read file contents
                        $fileContents = file_get_contents($filePath);
                        if (!$fileContents) {
                            Log::error('Failed to read default CV file contents', [
                                'path' => $filePath
                            ]);
                            return redirect()->back()
                                ->with('error', 'Failed to read default CV file. Please upload a new CV.')
                                ->withInput();
                        }
                        
                        // Send default CV to extraction API
                        $response = Http::withHeaders([
                            'Accept' => 'application/json',
                        ])->attach(
                            'cv_file', 
                            $fileContents, 
                            $fileName
                        )->timeout(30)
                        ->post($extractionUrl);
                        
                        // Log raw API response
                        Log::info('Default CV extraction API response', [
                            'status' => $response->status(),
                            'body' => $response->body()
                        ]);
                        
                        // Continue with API response processing...
                        
                        // Label for skipping the API call if we already have extracted data
                        skip_cv_extraction_api_call:
                        
                        // Now that we have CV data, try to match with the job
                        try {
                            // First, make sure the $cvData we have is explicitly stored as a JSON string
                            // This ensures we're working with consistent data formats
                            if (is_array($cvData)) {
                                $cvData = json_encode($cvData);
                                Log::info('Converted $cvData array to JSON string', [
                                    'json_length' => strlen($cvData),
                                    'is_json' => $this->isJson($cvData)
                                ]);
                            } else if (is_string($cvData) && !$this->isJson($cvData)) {
                                $cvData = json_encode(['value' => $cvData]);
                                Log::info('Wrapped $cvData non-JSON string in JSON object', [
                                    'json_length' => strlen($cvData),
                                    'is_json' => $this->isJson($cvData)
                                ]);
                            }
                            
                            // Find file path to match with job position
                            $possiblePaths = [
                                storage_path('app/public/cv_files/' . $fileName),
                                storage_path('app/public/cvs/' . $fileName),
                                public_path('storage/cvs/' . $fileName),
                                public_path('storage/cv_files/' . $fileName),
                                base_path('public/storage/cvs/' . $fileName),
                                base_path('cv-extraction-laravel/public/storage/cvs/' . $fileName)
                            ];
                            
                            $filePath = null;
                            foreach ($possiblePaths as $path) {
                                if (file_exists($path)) {
                                    $filePath = $path;
                                    Log::info('Found CV file at: ' . $filePath);
                                    break;
                                }
                            }
                            
                            if (!$filePath) {
                                Log::error('CV file not found on disk. Tried paths:', [
                                    'cv_id' => $defaultCV->id,
                                    'tried_paths' => $possiblePaths
                                ]);
                                return redirect()->back()->with('error', 'CV file not found. Please upload a new CV.');
                            }
                            
                            Log::info('CV file found, preparing to send to extraction API', [
                                'file_path' => $filePath,
                                'file_size' => filesize($filePath)
                            ]);
                            
                            // Match with job description
                            Log::info('Matching CV with job position', [
                                'cv_id' => $defaultCV->id,
                                'job_id' => $jobPosition->id,
                                'file_path' => $filePath
                            ]);
                            
                            $matchingData = $extractionController->matchWithJob(new \Illuminate\Http\UploadedFile(
                                $filePath,
                                $fileName,
                                mime_content_type($filePath),
                                null,
                                true
                            ), $jobPosition->description);
                        } catch (\Exception $e) {
                            Log::warning('Job matching with default CV failed but continuing with application', [
                                'error' => $e->getMessage(),
                                'cv_id' => $defaultCV->id,
                                'job_id' => $jobPosition->id
                            ]);
                        }
                    } catch (\Exception $e) {
                        Log::error('Error calling CV extraction API for default CV: ' . $e->getMessage(), [
                            'file' => $e->getFile(),
                            'line' => $e->getLine()
                        ]);
                        
                        return redirect()->back()
                            ->with('error', 'Error extracting data from your default CV: ' . $e->getMessage())
                            ->withInput();
                    }
                }
                
                // Now that we have CV data, try to match with the job
                try {
                    // First, make sure the $cvData we have is explicitly stored as a JSON string
                    // This ensures we're working with consistent data formats
                    if (is_array($cvData)) {
                        $cvData = json_encode($cvData);
                        Log::info('Converted $cvData array to JSON string', [
                            'json_length' => strlen($cvData),
                            'is_json' => $this->isJson($cvData)
                        ]);
                    } else if (is_string($cvData) && !$this->isJson($cvData)) {
                        $cvData = json_encode(['value' => $cvData]);
                        Log::info('Wrapped $cvData non-JSON string in JSON object', [
                            'json_length' => strlen($cvData),
                            'is_json' => $this->isJson($cvData)
                        ]);
                    }
                    
                    // Find file path to match with job position
                    $possiblePaths = [
                        storage_path('app/public/cv_files/' . $fileName),
                        storage_path('app/public/cvs/' . $fileName),
                        public_path('storage/cvs/' . $fileName),
                        public_path('storage/cv_files/' . $fileName),
                        base_path('public/storage/cvs/' . $fileName),
                        base_path('cv-extraction-laravel/public/storage/cvs/' . $fileName)
                    ];
                    
                    $filePath = null;
                    foreach ($possiblePaths as $path) {
                        if (file_exists($path)) {
                            $filePath = $path;
                            Log::info('Found CV file at: ' . $filePath);
                            break;
                        }
                    }
                    
                    if (!$filePath) {
                        Log::error('CV file not found on disk. Tried paths:', [
                            'cv_id' => $defaultCV->id,
                            'tried_paths' => $possiblePaths
                        ]);
                        return redirect()->back()->with('error', 'CV file not found. Please upload a new CV.');
                    }
                    
                    Log::info('CV file found, preparing to send to extraction API', [
                        'file_path' => $filePath,
                        'file_size' => filesize($filePath)
                    ]);
                    
                    // Match with job description
                    Log::info('Matching CV with job position', [
                        'cv_id' => $defaultCV->id,
                        'job_id' => $jobPosition->id,
                        'file_path' => $filePath
                    ]);
                    
                    $matchingData = $extractionController->matchWithJob($file, $jobPosition->description);
                } catch (\Exception $e) {
                    Log::warning('Job matching with default CV failed but continuing with application', [
                        'error' => $e->getMessage(),
                        'cv_id' => $defaultCV->id,
                        'job_id' => $jobPosition->id
                    ]);
                }
            } else if ($request->hasFile('cv_file')) {
                // Get the CV file
                $file = $request->file('cv_file');
                $fileName = time() . '_' . Auth::id() . '_' . $file->getClientOriginalName();
                
                Log::info('Got uploaded CV file', [
                    'original_name' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                    'temporary_path' => $file->path()
                ]);
                
                // Store the CV file
                $filePath = $file->storeAs('cv_files', $fileName, 'public');
                
                // Log file storage information for debugging
                Log::info('CV file stored successfully', [
                    'path' => $filePath,
                    'user_id' => Auth::id(),
                    'job_id' => $jobPosition->id,
                    'original_name' => $file->getClientOriginalName()
                ]);
                
                // Step 1: Try to extract CV data
                try {
                    // First check if the API is running
                    try {
                        $healthCheckUrl = rtrim(config('services.cv_extraction.api_url', 'http://localhost:5000'), '/') . '/api/health-check';
                        Log::info('Checking if CV extraction API is running', ['url' => $healthCheckUrl]);
                        
                        $healthCheckResponse = Http::timeout(5)->get($healthCheckUrl);
                        
                        if (!$healthCheckResponse->successful()) {
                            Log::error('CV extraction API is not available', [
                                'health_check_status' => $healthCheckResponse->status(),
                                'health_check_body' => $healthCheckResponse->body()
                            ]);
                            return redirect()->back()
                                ->with('error', 'The CV extraction service is currently unavailable. Please try again later or contact support.')
                                ->withInput();
                        }
                        
                        Log::info('CV health check successful', [
                            'response' => $healthCheckResponse->json()
                        ]);
                    } catch (\Exception $e) {
                        Log::error('Could not connect to CV extraction API', [
                            'error' => $e->getMessage(),
                            'api_url' => config('services.cv_extraction.api_url')
                        ]);
                        return redirect()->back()
                            ->with('error', 'Could not connect to the CV extraction service. Please check if the Python backend is running at ' . config('services.cv_extraction.api_url'))
                            ->withInput();
                    }
                    
                    // API is running, now prepare the request
                    $extractionUrl = rtrim(config('services.cv_extraction.api_url', 'http://localhost:5000'), '/') . '/api/extract-cv';
                    Log::info('CV extraction API is available, sending CV for extraction', [
                        'api_url' => $extractionUrl
                    ]);
                    
                    // Prepare the file contents for sending to API
                    $fileContents = file_get_contents($file->path());
                    if (!$fileContents) {
                        Log::error('Failed to read CV file contents', [
                            'path' => $file->path(),
                            'filename' => $file->getClientOriginalName()
                        ]);
                        return redirect()->back()
                            ->with('error', 'Failed to read uploaded CV file. Please try uploading again with a different PDF.')
                            ->withInput();
                    }
                    
                    Log::info('Successfully read CV file contents', [
                        'file_size' => strlen($fileContents),
                        'first_10_bytes' => substr(bin2hex($fileContents), 0, 20) . '...'
                    ]);
                    
                    // Send CV to extraction API
                    Log::info('About to send request to CV extraction API', [
                        'file_size' => strlen($fileContents),
                        'file_name' => $file->getClientOriginalName()
                    ]);
                    
                    // Log the exact API call we're making
                    Log::info('Sending HTTP POST request to extraction API', [
                        'url' => $extractionUrl,
                        'headers' => ['Accept' => 'application/json'],
                        'file_attachment' => 'cv_file',
                        'timeout' => 30,
                        'content_type' => $file->getMimeType(),
                        'file_original_name' => $file->getClientOriginalName()
                    ]);
                    
                    $response = Http::withHeaders([
                        'Accept' => 'application/json',
                    ])->attach(
                        'cv_file', 
                        $fileContents, 
                        $file->getClientOriginalName()
                    )->timeout(30) // Increase timeout to 30 seconds
                    ->post($extractionUrl);
                    
                    // Log COMPLETE raw API response for debugging (not just snippets)
                    Log::info('CV extraction API raw response', [
                        'status' => $response->status(),
                        'headers' => $response->headers(),
                        'raw_body' => $response->body()
                    ]);
                    
                    Log::info('CV extraction API raw response analysis', [
                        'body_length' => strlen($response->body()),
                        'is_json' => $this->isJson($response->body()),
                        'has_cv_data_keyword' => strpos($response->body(), 'cv_data') !== false,
                        'content_type' => $response->header('Content-Type')
                    ]);
                    
                    if ($response->successful()) {
                        $apiData = $response->json();
                        
                        // Add detailed debugging about the API response format
                        Log::info('CV extraction API response debug info', [
                            'api_data_type' => gettype($apiData),
                            'response_body_type' => gettype($response->body()),
                            'json_last_error' => json_last_error_msg(),
                            'is_array' => is_array($apiData),
                            'is_object' => is_object($apiData),
                            'keys' => is_array($apiData) ? array_keys($apiData) : 'not an array'
                        ]);
                        
                        if (empty($apiData)) {
                            Log::error('CV extraction API returned empty JSON response');
                            return redirect()->back()
                                ->with('error', 'The CV extraction service returned an empty response. Please try again with a different PDF file.')
                                ->withInput();
                        }
                        
                        // Add more detailed logging about the response structure
                        Log::info('CV extraction API response structure', [
                            'has_cv_data_key' => isset($apiData['cv_data']),
                            'has_data_key' => isset($apiData['data']),
                            'response_keys' => array_keys($apiData),
                            'response_type' => gettype($apiData),
                            'response_top_level' => json_encode(array_keys($apiData))
                        ]);
                        
                        // If the API returns cv_data directly at the top level, use that
                        if (isset($apiData['cv_data'])) {
                            $cvData = $apiData['cv_data'];
                            // Store only the cv_data object as JSON string
                            $apiResponse = json_encode($cvData);
                            
                            Log::info('Using cv_data from top level', [
                                'cv_data_keys' => is_array($cvData) ? json_encode(array_keys($cvData)) : 'not an array',
                                'cv_data_type' => gettype($cvData),
                                'stored_format' => 'Extracted cv_data object only'
                            ]);
                        } elseif (isset($apiData['data'])) {
                            $cvData = $apiData['data'];
                            // Store only the data object as JSON string
                            $apiResponse = json_encode($cvData);
                            
                            Log::info('Using data key', [
                                'data_keys' => is_array($cvData) ? json_encode(array_keys($cvData)) : 'not an array',
                                'data_type' => gettype($cvData),
                                'stored_format' => 'Extracted data object only'
                            ]);
                        } elseif (is_array($apiData) && !empty($apiData)) {
                            // If the API returns the data directly without nesting
                            $cvData = $apiData;
                            // Store the entire array as JSON string
                            $apiResponse = json_encode($cvData);
                            
                            Log::info('Using full API response as CV data', [
                                'api_data_keys' => json_encode(array_keys($apiData)),
                                'api_data_type' => gettype($apiData),
                                'stored_format' => 'Full API response converted to JSON string'
                            ]);
                        } else {
                            Log::warning('No CV data structure recognized in API response', [
                                'api_response' => $response->body()
                            ]);
                            throw new \Exception('CV extraction service returned an unrecognized data structure.');
                        }
                        
                        // Verify we have data
                        if (empty($cvData)) {
                            Log::warning('CV data is empty after extraction', [
                                'api_response' => substr($response->body(), 0, 1000) // Log a portion of the response
                            ]);
                            return redirect()->back()
                                ->with('error', 'No data could be extracted from the CV. Please try a different PDF file.')
                                ->withInput();
                        }
                        
                        Log::info('CV data extracted successfully for job application', [
                            'user_id' => Auth::id(),
                            'job_id' => $jobPosition->id,
                            'data_keys' => is_array($cvData) ? json_encode(array_keys($cvData)) : 'not an array',
                            'cv_data_sample' => is_array($cvData) ? json_encode(array_slice($cvData, 0, 2)) : substr((string)$cvData, 0, 100)
                        ]);
                        
                        // Store the full raw API response for debugging
                        $apiResponse = $response->body();
                        Log::info('Storing raw API response in cv_data', [
                            'response_length' => strlen($apiResponse),
                            'is_json' => $this->isJson($apiResponse)
                        ]);
                    } else {
                        Log::warning('CV extraction API returned non-successful response', [
                            'status' => $response->status(),
                            'body' => $response->body()
                        ]);
                        return redirect()->back()
                            ->with('error', 'The CV extraction service returned an error. Please try again with a different PDF file.')
                            ->withInput();
                    }
                } catch (\Exception $e) {
                    Log::error('Error calling CV extraction API: ' . $e->getMessage(), [
                        'file' => $e->getFile(),
                        'line' => $e->getLine(),
                        'trace' => $e->getTraceAsString()
                    ]);
                    
                    return redirect()->back()
                        ->with('error', 'Error extracting CV data: ' . $e->getMessage())
                        ->withInput();
                }
                
                // Step 2: Try to match CV with job position
                if ($cvData) {
                    try {
                        Log::info('Attempting job matching for application', [
                            'job_id' => $jobPosition->id,
                            'job_title' => $jobPosition->title,
                            'job_description_length' => strlen($jobPosition->description)
                        ]);
                        
                        // Call the matchWithJob method from the extraction controller
                        $matchingData = $extractionController->matchWithJob($file, $jobPosition->description);
                        
                        // Log the matching results
                        Log::info('Job matching completed for application', [
                            'match_score' => $matchingData['match_score'] ?? 'not available',
                            'matched_skills_count' => isset($matchingData['skills_analysis']['matched_skills']) ? 
                                count($matchingData['skills_analysis']['matched_skills']) : 0,
                            'missing_skills_count' => isset($matchingData['skills_analysis']['missing_skills']) ? 
                                count($matchingData['skills_analysis']['missing_skills']) : 0
                        ]);
                    } catch (\Exception $e) {
                        Log::error('Error in job matching process: ' . $e->getMessage(), [
                            'trace' => $e->getTraceAsString()
                        ]);
                        // Continue without matching data
                    }
                }
            } else {
                Log::warning('No CV file provided');
                return redirect()->back()->with('error', 'Please provide a CV to apply for this position.');
            }
            
            // Create a new job application
            Log::info('Creating new job application record', [
                'user_id' => Auth::id(),
                'job_position_id' => $jobPosition->id,
                'cv_filename' => $fileName,
                'has_cover_letter' => !empty($request->cover_letter),
                'has_cv_data' => !empty($cvData),
                'has_api_response' => !empty($apiResponse),
                'has_matching_data' => !empty($matchingData)
            ]);
            
            $jobApplication = new JobApplication();
            $jobApplication->user_id = Auth::id();
            $jobApplication->job_position_id = $jobPosition->id;
            $jobApplication->cv_filename = $fileName;
            $jobApplication->cover_letter = $request->cover_letter;
            $jobApplication->status = 'pending';
            $jobApplication->recruiter_viewed_at = null;
            
            // First, store the raw API response directly
            if ($apiResponse) {
                Log::info('Setting cv_data with API response');
                
                try {
                    // We've already processed and encoded the data correctly in the previous steps,
                    // so we should now have a valid JSON string
                    if (!is_string($apiResponse)) {
                        Log::warning('API response is not a string (unexpected), converting now', [
                            'type' => gettype($apiResponse)
                        ]);
                        $apiResponse = json_encode($apiResponse);
                    }
                    
                    // Set directly - already properly formatted as JSON string
                    $jobApplication->cv_data = $apiResponse;
                    
                    Log::info('Successfully stored API response as cv_data', [
                        'data_type' => gettype($jobApplication->cv_data),
                        'is_json' => $this->isJson($jobApplication->cv_data),
                        'length' => strlen($jobApplication->cv_data)
                    ]);
                } catch (\Exception $e) {
                    Log::error('Error processing API response: ' . $e->getMessage(), [
                        'exception' => $e->getMessage()
                    ]);
                    // Fallback to a safe value
                    $jobApplication->cv_data = json_encode(['error' => 'Error processing API response: ' . $e->getMessage()]);
                }
            }
            
            // If we have properly processed CV data, use that instead
            elseif ($cvData) {
                Log::info('Setting cv_data with processed CV data', [
                    'cv_data_type' => gettype($cvData),
                    'cv_data_keys' => is_array($cvData) ? implode(', ', array_keys($cvData)) : 'not an array'
                ]);
                
                try {
                    // Special handling for potentially problematic data structures
                    if (is_array($cvData)) {
                        // Deep sanitization to remove invalid UTF-8 sequences and other problematic chars
                        $sanitized = $this->sanitizeForJson($cvData);
                        $encodedData = json_encode($sanitized, JSON_PARTIAL_OUTPUT_ON_ERROR | JSON_UNESCAPED_UNICODE);
                        
                        if ($encodedData === false) {
                            Log::error('JSON encoding failed even after sanitization: ' . json_last_error_msg());
                            
                            // Attempt more aggressive sanitization
                            $encodedData = $this->encodeJsonSafely($cvData);
                            if ($encodedData === false) {
                                // Last resort - create a simplified version
                                $simplified = [
                                    'name' => $cvData['name'] ?? 'Unknown',
                                    'error' => 'Could not fully encode CV data: ' . json_last_error_msg(),
                                    'partial_data' => true
                                ];
                                // Create a new job application object with our data
                                $jobApplication = new JobApplication([
                                    'user_id' => Auth::id(),
                                    'job_position_id' => $jobPosition->id,
                                    'cv_filename' => $fileName,
                                    'cover_letter' => $request->cover_letter,
                                    'status' => 'pending',
                                ]);
                                // Set cv_data through the mutator to ensure correct handling
                                $jobApplication->cv_data = json_encode($simplified);
                            } else {
                                // Create a new job application object with our data
                                $jobApplication = new JobApplication([
                                    'user_id' => Auth::id(),
                                    'job_position_id' => $jobPosition->id,
                                    'cv_filename' => $fileName,
                                    'cover_letter' => $request->cover_letter,
                                    'status' => 'pending',
                                ]);
                                // Set cv_data through the mutator to ensure correct handling
                                $jobApplication->cv_data = $encodedData;
                            }
                        } else {
                            // Create a new job application object with our data
                            $jobApplication = new JobApplication([
                                'user_id' => Auth::id(),
                                'job_position_id' => $jobPosition->id,
                                'cv_filename' => $fileName,
                                'cover_letter' => $request->cover_letter,
                                'status' => 'pending',
                            ]);
                            // Set cv_data through the mutator to ensure correct handling
                            $jobApplication->cv_data = $encodedData;
                        }
                    } else if (is_string($cvData)) {
                        // For string values, still verify they're proper JSON or encode them
                        // Create a new job application object with our data
                        $jobApplication = new JobApplication([
                            'user_id' => Auth::id(),
                            'job_position_id' => $jobPosition->id,
                            'cv_filename' => $fileName,
                            'cover_letter' => $request->cover_letter,
                            'status' => 'pending',
                        ]);
                        // Set cv_data through the mutator to ensure correct handling
                        if ($this->isJson($cvData)) {
                            $jobApplication->cv_data = $cvData;
                        } else {
                            // For non-JSON strings, wrap them
                            $jobApplication->cv_data = json_encode(['cv_text' => $cvData]);
                        }
                    } else if (is_object($cvData)) {
                        // Convert objects to arrays first
                        $asArray = $this->objectToArray($cvData);
                        // Create a new job application object with our data
                        $jobApplication = new JobApplication([
                            'user_id' => Auth::id(),
                            'job_position_id' => $jobPosition->id,
                            'cv_filename' => $fileName,
                            'cover_letter' => $request->cover_letter,
                            'status' => 'pending',
                        ]);
                        // Set cv_data through the mutator to ensure correct handling
                        $jobApplication->cv_data = json_encode($asArray);
                    } else {
                        // For other types, create a simple wrapper
                        // Create a new job application object with our data
                        $jobApplication = new JobApplication([
                            'user_id' => Auth::id(),
                            'job_position_id' => $jobPosition->id,
                            'cv_filename' => $fileName,
                            'cover_letter' => $request->cover_letter,
                            'status' => 'pending',
                        ]);
                        // Set cv_data through the mutator to ensure correct handling
                        $jobApplication->cv_data = json_encode(['value' => (string)$cvData]);
                    }
                    
                    // Final verification
                    if (empty($jobApplication->cv_data) || !is_string($jobApplication->cv_data)) {
                        // Instead of throwing an exception, fix the data type
                        Log::warning('cv_data is not a string, converting it now', [
                            'current_type' => gettype($jobApplication->cv_data)
                        ]);
                        
                        // Force it to be a STRING - not an array - in the actual attribute directly
                        // This bypasses any mutators/accessors that might convert it back to an array
                        if (is_array($jobApplication->cv_data)) {
                            $jobApplication->attributes['cv_data'] = json_encode($jobApplication->cv_data);
                        } else {
                            $jobApplication->attributes['cv_data'] = json_encode(['data' => $jobApplication->cv_data]);
                        }
                        
                        // Verify it's actually a string now
                        if (!is_string($jobApplication->attributes['cv_data'])) {
                            Log::error('CRITICAL ERROR: cv_data is STILL not a string after forced conversion', [
                                'new_type' => gettype($jobApplication->attributes['cv_data'])
                            ]);
                            $jobApplication->attributes['cv_data'] = '{"error":"Could not convert CV data to string"}';
                        }
                        
                        Log::info('Converted cv_data to string successfully', [
                            'new_type' => gettype($jobApplication->attributes['cv_data']),
                            'is_json' => $this->isJson($jobApplication->attributes['cv_data'])
                        ]);
                    }
                    
                    // Ensure we only log string length for strings
                    $cvDataLength = is_string($jobApplication->cv_data) 
                        ? strlen($jobApplication->cv_data) 
                        : (is_string($jobApplication->attributes['cv_data']) 
                            ? strlen($jobApplication->attributes['cv_data']) 
                            : 'not a string');
                    
                    $cvDataSample = is_string($jobApplication->cv_data)
                        ? substr($jobApplication->cv_data, 0, 100) . '...'
                        : (is_string($jobApplication->attributes['cv_data'])
                            ? substr($jobApplication->attributes['cv_data'], 0, 100) . '...'
                            : json_encode(['type' => gettype($jobApplication->cv_data)]));
                    
                    Log::info('Successfully stored CV data', [
                        'data_type' => gettype($jobApplication->cv_data),
                        'data_type_in_attributes' => gettype($jobApplication->attributes['cv_data'] ?? null),
                        'is_json' => is_string($jobApplication->cv_data) ? $this->isJson($jobApplication->cv_data) : false,
                        'length' => $cvDataLength,
                        'sample' => $cvDataSample
                    ]);
                } catch (\Exception $e) {
                    Log::error('Error encoding CV data: ' . $e->getMessage(), [
                        'trace' => $e->getTraceAsString(),
                        'data_type' => gettype($cvData)
                    ]);
                    
                    // Create a very minimal CV data structure that will encode safely
                    $jobApplication->cv_data = json_encode([
                        'error' => 'Failed to encode CV data: ' . $e->getMessage(),
                        'timestamp' => time()
                    ]);
                }
            } else {
                // No cv_data available
                $jobApplication->cv_data = null;
                Log::warning('No CV data available for job application');
            }
            
            // Add matching data if available
            if ($matchingData) {
                $jobApplication->compatibility_analysis = json_encode($matchingData);
                $jobApplication->compatibility_score = $matchingData['match_score'] ?? null;
                
                Log::info('Added compatibility data', [
                    'score' => $jobApplication->compatibility_score,
                    'analysis_length' => strlen($jobApplication->compatibility_analysis)
                ]);
            }
            
            // Before saving, log the entire object
            Log::info('Job application object before saving', [
                'attributes' => $jobApplication->getAttributes()
            ]);
            
            // Save the application with all collected data
            $jobApplication->save();
            
            // Log after saving to see the final record with ID
            Log::info('Job application saved to database', [
                'id' => $jobApplication->id,
                'created_at' => $jobApplication->created_at
            ]);
            
            // Check what was actually saved in the database by retrieving it back
            $savedApplication = JobApplication::find($jobApplication->id);
            
            Log::info('Retrieved saved job application from database', [
                'id' => $savedApplication->id,
                'has_cv_data' => !empty($savedApplication->getRawOriginal('cv_data')),
                'cv_data_length' => !empty($savedApplication->getRawOriginal('cv_data')) ? 
                    strlen($savedApplication->getRawOriginal('cv_data')) : 0,
                'raw_cv_data_sample' => !empty($savedApplication->getRawOriginal('cv_data')) ? 
                    substr($savedApplication->getRawOriginal('cv_data'), 0, 100) . '...' : 'null'
            ]);
            
            // If we saved cv_data, verify it was stored correctly
            if ($jobApplication->cv_data) {
                Log::info('CV data saved successfully', [
                    'application_id' => $jobApplication->id,
                    'cv_data_length' => strlen($jobApplication->getAttributes()['cv_data'])
                ]);
            } else {
                Log::warning('CV data not saved', [
                    'application_id' => $jobApplication->id
                ]);
            }
            
            // Log completion of the process
            Log::info('========== JOB APPLICATION SUBMISSION COMPLETED ==========', [
                'application_id' => $jobApplication->id,
                'user_id' => Auth::id(),
                'job_position_id' => $jobPosition->id,
                'time' => now()->toDateTimeString()
            ]);
            
            // Analyze CV and job compatibility if CV data is available
            if (!empty($jobApplication->cv_data)) {
                // This will calculate and update compatibility score
                $this->analyzeCompatibility($jobApplication, $jobPosition);
            }
            
            // Dispatch event for new application submission
            try {
                event(new JobApplicationSubmitted($jobApplication));
            } catch (\Exception $e) {
                Log::error('Error dispatching JobApplicationSubmitted event: ' . $e->getMessage());
            }
            
            return redirect()->route('job-seeker.applications.show', $jobApplication)
                ->with('success', 'Job application submitted successfully!');
                
        } catch (\Exception $e) {
            Log::error('Error in job application submission: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'user_id' => Auth::id(),
                'job_id' => $jobPosition->id ?? null
            ]);
            
            return redirect()->back()
                ->with('error', 'An error occurred while submitting your application: ' . $e->getMessage())
                ->withInput();
        }
    }
    
    /**
     * Display the job seeker's applications.
     */
    public function index()
    {
        $applications = Auth::user()->jobApplications()
            ->with('jobPosition.recruiter')
            ->latest()
            ->get();
            
        return view('job-seeker.applications.index', compact('applications'));
    }
    
    /**
     * Display the specified job application.
     */
    public function show(JobApplication $jobApplication)
    {
        // Make sure the job seeker can only view their own applications
        if ($jobApplication->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Remove any compatibility analysis data to hide skills matching
        $jobApplication->compatibility_analysis = null;
        
        return view('job-seeker.applications.show', compact('jobApplication'));
    }
    
    /**
     * Update the status of a job application.
     */
    public function updateStatus(Request $request, JobApplication $jobApplication)
    {
        // Replace the authorize call with direct authorization check
        if ($jobApplication->jobPosition->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action. You can only update status for jobs you posted.');
        }
        
        $validated = $request->validate([
            'status' => 'required|in:pending,in_review,accepted,rejected',
            'recruiter_notes' => 'nullable|string|max:1000',
        ]);
        
        try {
            // Only update recruiter_notes if provided
            $updateData = ['status' => $validated['status']];
            
            if ($request->has('recruiter_notes')) {
                $updateData['recruiter_notes'] = $validated['recruiter_notes'];
            }
            
            // Reset seeker_viewed_at when status changes
            if ($jobApplication->status !== $validated['status']) {
                $updateData['seeker_viewed_at'] = null;
            }
            
            $jobApplication->update($updateData);
            
            return redirect()->back()->with('success', 'Application status updated successfully');
        } catch (\Exception $e) {
            Log::error('Error updating application status: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'An error occurred while updating the application status. Please try again.')
                ->withInput();
        }
    }
    
    /**
     * Display the job applications for the recruiter's job positions.
     */
    public function recruiterApplications(Request $request)
    {
        $jobPositions = Auth::user()->jobPositions()->with('applications.jobSeeker')->get();
        $applications = collect();
        
        foreach ($jobPositions as $position) {
            $applications = $applications->merge($position->applications);
        }
        
        // Apply filters if provided
        if ($request->has('job_position') && !empty($request->job_position)) {
            $applications = $applications->filter(function($app) use ($request) {
                return $app->job_position_id == $request->job_position;
            });
        }
        
        if ($request->has('status') && !empty($request->status)) {
            $applications = $applications->filter(function($app) use ($request) {
                return $app->status == $request->status;
            });
        }
        
        // Apply sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'oldest':
                    $applications = $applications->sortBy('created_at');
                    break;
                case 'highest_score':
                    $applications = $applications->sortByDesc('compatibility_score');
                    break;
                default:
                    $applications = $applications->sortByDesc('created_at');
                    break;
            }
        } else {
            $applications = $applications->sortByDesc('created_at');
        }
        
        // Fetch compatibility checks for users who haven't applied
        $compatibilityChecks = collect();
        $jobPositionIds = $jobPositions->pluck('id')->toArray();
        
        if (!empty($jobPositionIds)) {
            try {
                // Log the job positions we're looking for
                \Illuminate\Support\Facades\Log::info('Fetching compatibility checks', [
                    'job_position_ids' => $jobPositionIds,
                    'recruiter_id' => Auth::id()
                ]);
                
                // Get all CVJobCompatibility records for the recruiter's job positions
                $allChecks = \App\Models\CVJobCompatibility::whereIn('job_position_id', $jobPositionIds)
                    ->with(['user', 'cv', 'jobPosition'])
                    ->get();
                
                \Illuminate\Support\Facades\Log::info('Found compatibility check records', [
                    'count' => $allChecks->count(),
                    'first_few' => $allChecks->take(3)->map(function($check) {
                        return [
                            'id' => $check->id,
                            'user_id' => $check->user_id,
                            'job_position_id' => $check->job_position_id,
                            'score' => $check->compatibility_score
                        ];
                    })->toArray()
                ]);
                
                // FOR DEMO PURPOSES ONLY:
                // Add dummy compatibility checks if none exist
                if ($allChecks->isEmpty()) {
                    // No fallback data - if no compatibility checks exist, keep empty collection
                    \Illuminate\Support\Facades\Log::info('No compatibility check records found, keeping empty collection');
                }
                
                // IMPORTANT CHANGE: Use all compatibility checks without filtering by applied users
                // We'll show all users who have checked compatibility, even if they've applied
                $compatibilityChecks = $allChecks;
                
                \Illuminate\Support\Facades\Log::info('Using all compatibility checks', [
                    'count' => $compatibilityChecks->count()
                ]);
                
                // Create a complete unfiltered copy of ALL compatibility checks across ALL job positions
                try {
                    // Get ALL compatibility checks from the database, not just for this recruiter's positions
                    $allCompatibilityChecks = \App\Models\CVJobCompatibility::with(['user', 'cv', 'jobPosition'])
                        ->get();
                        
                    \Illuminate\Support\Facades\Log::info('Fetched ALL compatibility checks from database', [
                        'total_count' => $allCompatibilityChecks->count(),
                        'recruiter_positions_count' => $compatibilityChecks->count()
                    ]);
                    
                    // If no real data exists, generate dummy data for all positions
                    if ($allCompatibilityChecks->isEmpty()) {
                        // No fallback data - if no compatibility checks exist across all positions, keep empty collection
                        \Illuminate\Support\Facades\Log::info('No compatibility check records found across all positions, keeping empty collection');
                    }
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error('Error fetching ALL compatibility checks', [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                    $allCompatibilityChecks = collect(); // Empty collection as fallback
                }
                
                // Filter by job position if specified (only affects $compatibilityChecks, not $allCompatibilityChecks)
                if ($request->has('job_position') && !empty($request->job_position)) {
                    $compatibilityChecks = $compatibilityChecks->filter(function($check) use ($request) {
                        return $check->job_position_id == $request->job_position;
                    });
                    
                    \Illuminate\Support\Facades\Log::info('Filtered compatibility checks by job position', [
                        'job_position_id' => $request->job_position,
                        'filtered_count' => $compatibilityChecks->count()
                    ]);
                }
                
                // Sort by compatibility score (highest first)
                $compatibilityChecks = $compatibilityChecks->sortByDesc('compatibility_score');
                $allCompatibilityChecks = $allCompatibilityChecks->sortByDesc('compatibility_score');
                
                // Manually reload relationships if needed
                foreach ($compatibilityChecks as $check) {
                    if (!isset($check->user)) {
                        $check->load('user');
                    }
                    if (!isset($check->jobPosition)) {
                        $check->load('jobPosition');
                    }
                }
                
                foreach ($allCompatibilityChecks as $check) {
                    if (!isset($check->user)) {
                        try {
                            $check->load('user');
                        } catch (\Exception $e) {
                            // If user relationship can't be loaded, make sure we have a user object
                            if (!isset($check->user)) {
                                $check->user = \App\Models\User::find($check->user_id);
                            }
                        }
                    }
                    if (!isset($check->jobPosition)) {
                        try {
                            $check->load('jobPosition');
                        } catch (\Exception $e) {
                            // If jobPosition relationship can't be loaded, make sure we have a jobPosition object
                            if (!isset($check->jobPosition)) {
                                $check->jobPosition = \App\Models\JobPosition::find($check->job_position_id);
                            }
                        }
                    }
                }
                
                // Make sure to limit the number of results shown to avoid overwhelming the UI
                if ($allCompatibilityChecks->count() > 100) {
                    $allCompatibilityChecks = $allCompatibilityChecks->take(100);
                    \Illuminate\Support\Facades\Log::info('Limited all compatibility checks to 100 records');
                }
                
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Error fetching compatibility checks', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                // Create an empty collection as fallback
                $compatibilityChecks = collect();
            }
        }
        
        // Convert the collection to a paginator
        $perPage = 10;
        $page = request()->get('page', 1);
        $offset = ($page - 1) * $perPage;
        
        $items = $applications->slice($offset, $perPage)->values();
        
        $applications = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $applications->count(),
            $perPage,
            $page,
            ['path' => request()->url()]
        );
        
        return view('recruiter.applications.index', [
            'applications' => $applications,
            'jobPositions' => $jobPositions,
            'compatibilityChecks' => $compatibilityChecks,
            'allCompatibilityChecks' => $allCompatibilityChecks
        ]);
    }
    
    /**
     * Display the specified job application for the recruiter.
     */
    public function recruiterShowApplication(JobApplication $jobApplication)
    {
        // Make sure the recruiter can only view applications for their job positions
        $jobPosition = $jobApplication->jobPosition;
        
        if ($jobPosition->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Remove any compatibility analysis data to hide skills matching
        $jobApplication->compatibility_analysis = null;
        
        return view('recruiter.applications.show', compact('jobApplication'));
    }

    /**
     * Helper function to check if a string is valid JSON
     */
    private function isJson($string) {
        if (!is_string($string)) return false;
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

    /**
     * Helper function to sanitize data for JSON encoding
     */
    private function sanitizeForJson($data) {
        if (is_string($data)) {
            // Remove invalid UTF-8 sequences
            $data = mb_convert_encoding($data, 'UTF-8', 'UTF-8');
            
            // Replace problematic characters 
            $data = preg_replace('/[\x00-\x1F\x80-\x9F]/u', '', $data);
            return $data;
        } elseif (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = $this->sanitizeForJson($value);
            }
        } elseif (is_object($data)) {
            foreach (get_object_vars($data) as $key => $value) {
                $data->$key = $this->sanitizeForJson($value);
            }
        }
        return $data;
    }

    /**
     * Helper function to encode data safely for JSON
     */
    private function encodeJsonSafely($data) {
        try {
            // First try with all the safe flags
            $encoded = json_encode($data, 
                JSON_PARTIAL_OUTPUT_ON_ERROR | 
                JSON_UNESCAPED_UNICODE | 
                JSON_INVALID_UTF8_SUBSTITUTE
            );
            
            if ($encoded !== false) {
                return $encoded;
            }
            
            // Failed - try to encode portion by portion
            $safeData = [];
            if (is_array($data)) {
                foreach ($data as $key => $value) {
                    try {
                        // Try to encode each array element separately
                        $encodedValue = json_encode($value, JSON_PARTIAL_OUTPUT_ON_ERROR);
                        if ($encodedValue !== false) {
                            // If successful, decode back to get a safe value
                            $safeData[$key] = json_decode($encodedValue, true);
                        } else {
                            // If encoding fails, use placeholder
                            $safeData[$key] = "[Encoding failed: " . json_last_error_msg() . "]";
                        }
                    } catch (\Exception $e) {
                        $safeData[$key] = "[Exception: " . $e->getMessage() . "]";
                    }
                }
                
                // Now encode the sanitized data
                return json_encode($safeData);
            }
            
            // For non-array data, create a simple structure
            return json_encode([
                'value_type' => gettype($data),
                'encoded_safely' => true,
                'original_unusable' => true
            ]);
        } catch (\Exception $e) {
            Log::error('Error in encodeJsonSafely: ' . $e->getMessage());
            return json_encode(['error' => 'JSON encoding failed completely']);
        }
    }

    /**
     * Helper function to convert object to array
     */
    private function objectToArray($object) {
        if (is_object($object)) {
            $result = [];
            
            // First try get_object_vars
            $properties = get_object_vars($object);
            foreach ($properties as $key => $value) {
                $result[$key] = $this->objectToArray($value);
            }
            
            // Then try reflectionClass for protected/private properties
            try {
                $reflectionClass = new \ReflectionClass($object);
                foreach ($reflectionClass->getProperties() as $property) {
                    $property->setAccessible(true);
                    $key = $property->getName();
                    if (!array_key_exists($key, $result)) {
                        $value = $property->getValue($object);
                        $result[$key] = $this->objectToArray($value);
                    }
                }
            } catch (\Exception $e) {
                // Ignore reflection errors
            }
            
            return $result;
        } elseif (is_array($object)) {
            $result = [];
            foreach ($object as $key => $value) {
                $result[$key] = $this->objectToArray($value);
            }
            return $result;
        }
        
        // Not an object or array - return as is
        return $object;
    }
}
