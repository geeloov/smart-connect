<?php

namespace App\Http\Controllers;

use App\Models\JobPosition;
use App\Models\JobApplication;
use App\Models\CV;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class JobSeekerController extends Controller
{
    /**
     * Display the job seeker dashboard.
     */
    public function dashboard()
    {
        // Get recent job applications
        $recentApplications = Auth::user()->jobApplications()
            ->with('jobPosition')
            ->latest()
            ->take(5)
            ->get();
            
        // Get recent job listings
        $recentJobs = JobPosition::where('is_active', true)
            ->latest()
            ->take(5)
            ->get();
            
        // Get counts for dashboard stats
        $totalApplications = Auth::user()->jobApplications()->count();
        $pendingApplications = Auth::user()->jobApplications()->where('status', 'in_review')->count();
        $shortlistedApplications = Auth::user()->jobApplications()->whereIn('status', ['shortlisted', 'hired'])->count();
        
        return view('job-seeker.dashboard', compact(
            'recentApplications',
            'recentJobs',
            'totalApplications',
            'pendingApplications',
            'shortlistedApplications'
        ));
    }

    /**
     * Display the job seeker profile.
     */
    public function profile()
    {
        $user = Auth::user();
        
        // Load the user's CVs
        $user->load('cvs');
        
        return view('job-seeker.profile', compact('user'));
    }

    /**
     * Update the job seeker profile.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
        ]);
        
        // Update user information
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'location' => $request->location,
            'bio' => $request->bio,
        ]);
        
        return redirect()->route('job-seeker.profile')
            ->with('success', 'Profile updated successfully!');
    }

    /**
     * Display the CV upload form.
     */
    public function cvUpload(Request $request)
    {
        // Check for flashed CV data from session (after extraction)
        $cvData = $request->session()->get('cvData');
        $jobMatching = $request->session()->get('jobMatching');
        $jobDescription = $request->session()->get('jobDescription');
        
        return view('job-seeker.cv-upload', compact('cvData', 'jobMatching', 'jobDescription'));
    }

    /**
     * Process the CV upload.
     */
    public function cvUploadStore(Request $request)
    {
        // Validate the request
        $request->validate([
            'cv_file' => 'required|mimes:pdf|max:10240', // 10MB max
            'job_description' => 'nullable|string|max:50000', // Add validation for job description
        ]);
        
        try {
            // Log the original file details
            $file = $request->file('cv_file');
            Log::info('CV file uploaded by job seeker', [
                'filename' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'mime_type' => $file->getMimeType()
            ]);
            
            // Get extraction controller
            $extractionController = app()->make('App\Http\Controllers\CvExtractionController');
            
            // Get the extraction results - the file is only temporarily used
            $extractionResult = $extractionController->extract($request);
            
            // Process job matching if job description is provided
            $jobDescription = $request->job_description ?? '';
            $matchingResults = null;
            
            if (!empty($jobDescription) && isset($extractionResult['cv_data'])) {
                try {
                    // Match CV with job description
                    $matchingResults = $extractionController->matchWithJob($file, $jobDescription);
                } catch (\Exception $e) {
                    Log::warning('Job matching failed but continuing with CV data', [
                        'error' => $e->getMessage()
                    ]);
                }
            }
            
            // Flash the data to the session
            return redirect()->route('job-seeker.cv-upload')
                ->with('cvData', $extractionResult['cv_data'] ?? null)
                ->with('jobMatching', $matchingResults)
                ->with('jobDescription', $jobDescription)
                ->with('success', 'CV processed successfully!');
            
        } catch (\Exception $e) {
            Log::error('Error processing CV upload: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('job-seeker.cv-upload')
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Display job matches for the job seeker.
     */
    public function jobMatches()
    {
        // In a real application, we would:
        // 1. Fetch job matches for the authenticated user
        // 2. Pass the matches to the view

        return view('job-seeker.job-matches');
    }

    /**
     * Show the job application form for a specific job.
     */
    public function createJobApplication($jobId)
    {
        $jobPosition = JobPosition::findOrFail($jobId);
        
        // Check for flashed CV data from session (if user has already uploaded CV)
        $cvData = session('cvData');
        $jobMatching = session('jobMatching');
        
        return view('job-seeker.create-application', compact('jobPosition', 'cvData', 'jobMatching'));
    }

    /**
     * Store a new job application.
     */
    public function storeJobApplication(Request $request, $jobId)
    {
        // Validate the request
        $request->validate([
            'cv_file' => 'required_without:use_existing_cv|mimes:pdf|max:10240', // Required if not using existing CV
            'cover_letter' => 'nullable|string|max:5000',
            'use_existing_cv' => 'nullable|boolean',
        ]);
        
        try {
            $jobPosition = JobPosition::findOrFail($jobId);
            $user = Auth::user();
            
            // Check if the user has already applied for this job
            $existingApplication = JobApplication::where('user_id', $user->id)
                ->where('job_position_id', $jobId)
                ->first();
                
            if ($existingApplication) {
                return redirect()->back()->with('error', 'You have already applied for this position.');
            }
            
            // Process CV file
            $cvFilename = null;
            $cvData = null;
            $compatibilityScore = null;
            $compatibilityAnalysis = null;
            
            // Get extraction controller
            $extractionController = app()->make('App\Http\Controllers\CvExtractionController');
            
            if ($request->hasFile('cv_file')) {
                // Handle new CV upload
                $file = $request->file('cv_file');
                $cvFilename = time() . '_' . $user->id . '_' . $file->getClientOriginalName();
                
                // Store the file
                $file->storeAs('cvs', $cvFilename, 'public');
                
                // Extract CV data
                $extractionResult = $extractionController->extract($request);
                $cvData = $extractionResult['cv_data'] ?? null;
                
                // Match with job description if available
                if ($jobPosition->description) {
                    try {
                        $matchingResults = $extractionController->matchWithJob($file, $jobPosition->description);
                        $compatibilityScore = $matchingResults['score'] ?? null;
                        $compatibilityAnalysis = $matchingResults;
                    } catch (\Exception $e) {
                        Log::warning('Job matching failed but continuing with application', [
                            'error' => $e->getMessage()
                        ]);
                    }
                }
            } elseif ($request->has('use_existing_cv') && session()->has('cvData')) {
                // Use CV data from session (previously uploaded)
                $cvData = session('cvData');
                $compatibilityScore = session('jobMatching.score') ?? null;
                $compatibilityAnalysis = session('jobMatching') ?? null;
                
                // Should have a way to reference the previously uploaded file
                // For now, we'll assume there's another storage mechanism for this
                $cvFilename = 'existing_cv_' . time() . '_' . $user->id . '.pdf';
            }
            
            // Create job application
            $application = new JobApplication();
            $application->user_id = $user->id;
            $application->job_position_id = $jobId;
            $application->cv_filename = $cvFilename;
            $application->cover_letter = $request->cover_letter;
            $application->cv_data = $cvData ? json_encode($cvData) : null;
            $application->compatibility_score = $compatibilityScore;
            $application->compatibility_analysis = $compatibilityAnalysis ? json_encode($compatibilityAnalysis) : null;
            $application->status = 'pending';
            $application->save();
            
            return redirect()->route('job-seeker.applications')
                ->with('success', 'Your application has been submitted successfully!');
                
        } catch (\Exception $e) {
            Log::error('Error submitting job application: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Display all job applications for the authenticated user.
     */
    public function applications()
    {
        $applications = Auth::user()->jobApplications()
            ->with('jobPosition')
            ->latest()
            ->paginate(10);
            
        return view('job-seeker.applications', compact('applications'));
    }

    /**
     * Upload a new CV and extract data from it.
     */
    public function uploadCV(Request $request)
    {
        // Validate the request
        $request->validate([
            'cv_file' => 'required|mimes:pdf|max:10240', // 10MB max
            'make_default' => 'nullable|boolean',
        ]);
        
        try {
            $file = $request->file('cv_file');
            $fileName = time() . '_' . Auth::id() . '_' . $file->getClientOriginalName();
            
            // Store in public disk with proper permissions
            $filePath = $file->storeAs('cvs', $fileName, 'public');
            
            // Ensure the file is publicly accessible
            chmod(storage_path('app/public/' . $filePath), 0644);
            
            // Create a new CV record
            $cv = new CV([
                'user_id' => Auth::id(),
                'is_default' => $request->make_default ? true : false,
                'file_path' => $filePath,
                'file_name' => $file->getClientOriginalName(),
                'file_size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
            ]);
            
            // If this is set as default, unset any other default CVs
            if ($request->make_default) {
                CV::where('user_id', Auth::id())
                  ->where('is_default', true)
                  ->update(['is_default' => false]);
            }
            
            // Save the CV
            $cv->save();
            
            // Extract CV data
            try {
                $extractionController = app()->make('App\Http\Controllers\CVExtractionController');
                $extractionResult = $extractionController->extractFromFile($file);
                
                if (isset($extractionResult['cv_data'])) {
                    // Update CV with extracted data
                    $cvData = $extractionResult['cv_data'];
                    $cv->extracted_data = $cvData;
                    
                    // Extract and store specific data points
                    if (isset($cvData['skills'])) {
                        $cv->extracted_skills = $cvData['skills'];
                    }
                    
                    if (isset($cvData['education'])) {
                        $cv->extracted_education = $cvData['education'];
                    }
                    
                    if (isset($cvData['experience'])) {
                        $cv->extracted_experience = $cvData['experience'];
                    }
                    
                    if (isset($cvData['languages'])) {
                        $cv->extracted_languages = $cvData['languages'];
                    }
                    
                    if (isset($cvData['certifications'])) {
                        $cv->extracted_certifications = $cvData['certifications'];
                    }
                    
                    if (isset($cvData['phone'])) {
                        $cv->extracted_phone = $cvData['phone'];
                    }
                    
                    if (isset($cvData['email'])) {
                        $cv->extracted_email = $cvData['email'];
                    }
                    
                    if (isset($cvData['location'])) {
                        $cv->extracted_location = $cvData['location'];
                    }
                    
                    $cv->processed_at = now();
                    $cv->save();
                }
            } catch (\Exception $e) {
                Log::error('CV data extraction failed: ' . $e->getMessage());
                // Continue without CV data extraction
            }
            
            return redirect()->route('job-seeker.profile')
                ->with('success', 'CV uploaded successfully.');
                
        } catch (\Exception $e) {
            Log::error('CV upload failed: ' . $e->getMessage());
            
            return redirect()->route('job-seeker.profile')
                ->with('error', 'Failed to upload CV: ' . $e->getMessage());
        }
    }
    
    /**
     * Set a CV as the default.
     */
    public function setDefaultCV(CV $cv)
    {
        // Ensure the CV belongs to the authenticated user
        if ($cv->user_id !== Auth::id()) {
            return redirect()->route('job-seeker.profile')
                ->with('error', 'You do not have permission to modify this CV.');
        }
        
        // Unset any existing default CVs
        CV::where('user_id', Auth::id())
          ->where('is_default', true)
          ->update(['is_default' => false]);
        
        // Set this CV as default
        $cv->is_default = true;
        $cv->save();
        
        return redirect()->route('job-seeker.profile')
            ->with('success', 'Default CV updated successfully.');
    }
    
    /**
     * View a CV.
     */
    public function viewCV(CV $cv)
    {
        // Ensure the CV belongs to the authenticated user
        if ($cv->user_id !== Auth::id()) {
            return redirect()->route('job-seeker.profile')
                ->with('error', 'You do not have permission to view this CV.');
        }
        
        // Generate a URL to the stored file
        $url = Storage::url($cv->file_path);
        
        return response()->file(storage_path('app/public/' . $cv->file_path));
    }
    
    /**
     * Delete a CV.
     */
    public function deleteCV(CV $cv)
    {
        // Ensure the CV belongs to the authenticated user
        if ($cv->user_id !== Auth::id()) {
            return redirect()->route('job-seeker.profile')
                ->with('error', 'You do not have permission to delete this CV.');
        }
        
        // Delete the file from storage
        Storage::disk('public')->delete($cv->file_path);
        
        // Delete the database record
        $cv->delete();
        
        return redirect()->route('job-seeker.profile')
            ->with('success', 'CV deleted successfully.');
    }

    /**
     * Get CV file for compatibility check
     */
    public function getCVFile(CV $cv)
    {
        // Check if user owns this CV
        if ($cv->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized access to CV'], 403);
        }

        // Check if file exists in storage/app/public/cvs directory
        $filePath = storage_path('app/public/' . $cv->file_path);
        
        if (!file_exists($filePath)) {
            Log::error('CV file not found', [
                'file_path' => $cv->file_path,
                'full_path' => $filePath,
                'cv_id' => $cv->id,
                'file_name' => $cv->file_name
            ]);
            return response()->json(['error' => 'CV file not found'], 404);
        }

        // Return the file as a download
        return response()->file($filePath, [
            'Content-Type' => 'application/pdf',
        ]);
    }

    /**
     * Get the default CV for the authenticated user
     */
    public function getDefaultCV()
    {
        $user = Auth::user();
        $defaultCV = $user->cvs()->where('is_default', true)->first();
        
        if (!$defaultCV) {
            return null;
        }
        
        return $defaultCV;
    }

    /**
     * Get CV file content as base64 for compatibility check
     */
    public function getCVContent(CV $cv)
    {
        // Check if user owns this CV
        if ($cv->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized access to CV'], 403);
        }

        // Check if file exists in storage/app/public/cvs directory
        $filePath = storage_path('app/public/' . $cv->file_path);
        
        if (!file_exists($filePath)) {
            Log::error('CV file not found', [
                'file_path' => $cv->file_path,
                'full_path' => $filePath,
                'cv_id' => $cv->id,
                'file_name' => $cv->file_name
            ]);
            return response()->json(['error' => 'CV file not found'], 404);
        }

        // Read the file and encode as base64
        $fileContent = base64_encode(file_get_contents($filePath));
        
        return response()->json([
            'file_name' => $cv->file_name,
            'file_content' => $fileContent,
            'mime_type' => 'application/pdf'
        ]);
    }
}
