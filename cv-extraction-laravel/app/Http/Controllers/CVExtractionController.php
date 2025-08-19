<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\JobPosition;

class CVExtractionController extends Controller
{
    /**
     * Display the CV extraction form
     */
    public function index()
    {
        // Fetch available job positions for the current recruiter
        $availableJobPositions = JobPosition::where('user_id', Auth::id())
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('cv-extraction.index', compact('availableJobPositions'));
    }

    /**
     * Process method for the form - handles both extraction and optional matching
     */
    public function process(Request $request)
    {
        // \Illuminate\Support\Facades\Log::info('Request data:', $request->all()); // For logging
        // dd($request->all()); // For immediate browser output and script halt
        
        $request->validate([
            'cv_file' => 'required|file|mimes:pdf|max:10240', // 10MB max
            'job_position_id' => 'required|exists:job_positions,id' // Updated validation
        ], [
            'cv_file.required' => 'Please upload a CV file.',
            'cv_file.file' => 'The uploaded file is not valid.',
            'cv_file.mimes' => 'The CV file must be a PDF.',
            'cv_file.max' => 'The CV file size cannot exceed 10MB.',
            'job_position_id.required' => 'A job position must be selected.',
            'job_position_id.exists' => 'The selected job position is invalid.'
        ]);
        
        try {
            // Get the CV file
            $file = $request->file('cv_file');
            
            // Verify the job position belongs to the current recruiter
            $jobPosition = JobPosition::where('id', $request->job_position_id)
                ->where('user_id', Auth::id())
                ->first(); // Use first() instead of firstOrFail() to handle custom error
            
            if (!$jobPosition) {
                return back()->with('error', 'The selected job position could not be found or you do not have permission to access it.');
            }
            
            // Step 1: Extract CV data
            $extractedData = $this->extract($request);
            
            // Step 2: Get the job description from the selected position
            $jobDescription = $jobPosition->description;
            $matchingResults = null;
            $matchingError = null;
            
            try {
                // Important: Pass the original file, not extracted data
                $matchingResults = $this->matchWithJob($file, $jobDescription);
            } catch (\Exception $e) {
                // Store the error message but continue with CV extraction
                $matchingError = $e->getMessage();
                Log::warning('Job matching failed but continuing with CV data', [
                    'error' => $matchingError
                ]);
            }
            
            if (isset($matchingResults['success']) && !$matchingResults['success']) {
                Log::warning('Job matching failed', [
                    'error' => $matchingResults['error'] ?? 'Unknown error',
                    'reasoning' => $matchingResults['reasoning'] ?? 'No reasoning provided'
                ]);
                $matchingError = $matchingResults['reasoning'] ?? 'Failed to match CV with job description. Please try again or ensure the job description is clear.';
            }
            
            // Combine the results
            $result = [
                'cvData' => $extractedData['cv_data'] ?? null,
                'jobMatching' => $matchingResults,
                'jobPosition' => $jobPosition, // Pass job position instead of just description
                'jobDescription' => $jobDescription,
                'matchingError' => $matchingError // Pass the error to the view
            ];
            
            // Pass the extracted data to the view
            return view('cv-extraction.result', $result);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Re-throw validation exceptions so they are handled by Laravel's default error handler
            throw $e;
        } catch (\Exception $e) {
            Log::error('CV processing failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'An unexpected error occurred during CV processing. Please try again. If the problem persists, contact support.');
        }
    }

    /**
     * Process the CV extraction
     */
    public function extract(Request $request)
    {
        $request->validate([
            'cv_file' => 'required|mimes:pdf|max:10240', // 10MB max
            'job_position_id' => 'nullable|exists:job_positions,id', // Updated validation
        ]);
        
        try {
            // Get the CV file
            $file = $request->file('cv_file');
            
            // Build API URL from config base
            $apiUrl = rtrim(config('services.cv_extraction.api_url', 'http://127.0.0.1:5000'), '/') . '/api/extract-cv';
            
            Log::info('Sending CV to extraction API', [
                'api_url' => $apiUrl,
                'file_name' => $file->getClientOriginalName(),
                'file_size' => $file->getSize()
            ]);
            
            // Call the CV extraction API with the correct endpoint and method
            $response = Http::timeout(60)
                ->withHeaders(['Accept' => 'application/json'])
                ->attach(
                    'cv_file', 
                    file_get_contents($file->path()), 
                    $file->getClientOriginalName()
                )
                ->post($apiUrl);
            
            // Check if the API call was successful
            if (!$response->successful()) {
                Log::error('CV extraction API error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                // Provide a more user-friendly error message for API failures
                return back()->with('error', 'Failed to extract CV data from the analysis service. Please try again. Error details: ' . $response->status() . ' - ' . substr($response->body(), 0, 100) . '...');
            }
            
            // Get the API response data
            $apiData = $response->json();
            Log::info('CV extraction successful', ['data_keys' => array_keys($apiData)]);
            
            // Ensure we have cv_data field in the response
            if (!isset($apiData['cv_data']) && isset($apiData['data'])) {
                $apiData['cv_data'] = $apiData['data'];
            } else if (!isset($apiData['cv_data'])) {
                // Create default cv_data if none exists
                $apiData['cv_data'] = [
                    'name' => 'Unknown',
                    'skills' => []
                ];
            }
            
            // Return the extracted CV data
            return $apiData;
            
        } catch (\Exception $e) {
            Log::error('CV extraction exception', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            // Rethrow the exception after logging for upstream handling in the 'process' method
            throw new \Exception('Error communicating with the CV extraction service. Please ensure the service is running and try again.', 0, $e);
        }
    }

    /**
     * Process the CV and match it with a job description
     */
    public function matchWithJob($cvFile, $jobDescription)
    {
        try {
            $apiUrl = rtrim(config('services.cv_extraction.api_url', 'http://127.0.0.1:5000'), '/') . '/api/match-cv-with-job';
            
            Log::info('Sending CV data for job matching', [
                'api_url' => $apiUrl,
                'job_description_length' => strlen($jobDescription),
                'file_name' => $cvFile->getClientOriginalName()
            ]);
            
            // Create the multipart form data request
            $response = Http::timeout(60)
                ->attach(
                    'cv_file', 
                    file_get_contents($cvFile->path()), 
                    $cvFile->getClientOriginalName()
                )
                ->post($apiUrl, [
                    'job_description' => $jobDescription
                ]);
                
            if (!$response->successful()) {
                Log::error('Job matching API error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                
                // Return a properly structured error response with a more user-friendly message
                return [
                    'success' => false,
                    'match_score' => 0,
                    'is_perfect_match' => false,
                    'reasoning' => 'The job matching service encountered an error. Status: ' . $response->status() . '. Please ensure the service is running and try again.',
                    'skills_analysis' => [
                        'matched_skills' => [],
                        'missing_skills' => []
                    ]
                ];
            }
            
            $matchingData = $response->json();
            
            // Log the full API response for debugging
            Log::info('Full API response from job matching service', [
                'api_response' => json_encode($matchingData)
            ]);
            
            // Initialize standardized response structure
            $result = [
                'success' => true,
                'match_score' => 0,
                'is_perfect_match' => false,
                'reasoning' => 'No analysis provided.',
                'skills_analysis' => [
                    'matched_skills' => [],
                    'missing_skills' => []
                ]
            ];

            // Extract the job_matching data from the response if it exists
            if (isset($matchingData['job_matching'])) {
                $jobMatching = $matchingData['job_matching'];
                Log::info('Job matching successful (job_matching format)', ['data_keys' => array_keys($jobMatching)]);
                
                // Map fields from the standardized format
                $result['match_score'] = $jobMatching['match_score'] ?? 0;
                $result['is_perfect_match'] = $jobMatching['is_perfect_match'] ?? false;
                $result['reasoning'] = $jobMatching['reasoning'] ?? 'No analysis provided.';
                
                // Extract skills analysis
                if (isset($jobMatching['skills_analysis'])) {
                    $result['skills_analysis'] = [
                        'matched_skills' => $jobMatching['skills_analysis']['matched_skills'] ?? [],
                        'missing_skills' => $jobMatching['skills_analysis']['missing_skills'] ?? []
                    ];
                }
                
                // Extract experience and education analysis if available
                if (isset($jobMatching['experience_analysis'])) {
                    $result['experience_analysis'] = $jobMatching['experience_analysis'];
                }
                
                if (isset($jobMatching['education_analysis'])) {
                    $result['education_analysis'] = $jobMatching['education_analysis'];
                }

                // If job_matching is empty or malformed
                if (empty($jobMatching) || !is_array($jobMatching)) {
                    Log::warning('Job matching API response malformed or empty', ['api_response' => $matchingData]);
                    $result['success'] = false;
                    $result['reasoning'] = 'The job matching service returned an unexpected or empty response.';
                }
            } else {
                Log::warning('Job matching key not found in API response', ['api_response' => $matchingData]);
                $result['success'] = false;
                $result['reasoning'] = 'The job matching service did not return expected data format.';
            }
            
            // Ensure match_score is numeric
            if (!is_numeric($result['match_score'])) {
                $result['match_score'] = 0;
            }
            
            return $result;
            
        } catch (\Exception $e) {
            Log::error('Job matching exception', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            // Return a structured error response for exceptions during matching
            return [
                'success' => false,
                'match_score' => 0,
                'is_perfect_match' => false,
                'reasoning' => 'An error occurred while communicating with the job matching service. Please try again. Error: ' . $e->getMessage(),
                'skills_analysis' => [
                    'matched_skills' => [],
                    'missing_skills' => []
                ]
            ];
        }
    }

    /**
     * API endpoint to match a CV with a job description
     * Returns pure JSON response
     */
    public function apiMatchWithJob(Request $request)
    {
        $request->validate([
            'cv_file' => 'required|file|mimes:pdf|max:10240', // 10MB max
            'job_description' => 'required|string',
        ]);
        
        try {
            $file = $request->file('cv_file');
            $jobDescription = $request->job_description;
            
            // Use the existing matchWithJob method
            $result = $this->matchWithJob($file, $jobDescription);
            
            // Return as JSON response
            return response()->json($result);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    private function matchCVWithJob($cvData, $jobDescription)
    {
        try {
            $apiUrl = rtrim(config('services.cv_extraction.api_url', 'http://127.0.0.1:5000'), '/') . '/api/match-cv-with-job';
            
            Log::info('Sending CV data for job matching', [
                'api_url' => $apiUrl,
                'job_description_length' => strlen($jobDescription),
                'file_name' => $cvData['file_name'] ?? 'unknown'
            ]);

            $response = Http::timeout(30)->post($apiUrl, [
                'cv_data' => $cvData,
                'job_description' => $jobDescription
            ]);

            if (!$response->successful()) {
                Log::error('Job matching API error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                
                // Return as array, not inside another array
                return [
                    'success' => false,
                    'error' => 'API request failed',
                    'match_score' => 0,
                    'reasoning' => 'Unable to process matching at this time.',
                    'skills_analysis' => [],
                    'is_perfect_match' => false
                ];
            }

            $matchingData = $response->json();
            
            // Validate the response structure
            if (!$this->isValidMatchingResponse($matchingData)) {
                Log::error('Invalid matching response structure', [
                    'response' => $matchingData
                ]);
                
                return [
                    'success' => false,
                    'error' => 'Invalid response format',
                    'match_score' => 0,
                    'reasoning' => 'System received invalid response format.',
                    'skills_analysis' => [],
                    'is_perfect_match' => false
                ];
            }

            Log::info('Job matching completed successfully', [
                'matching_data_keys' => array_keys($matchingData)
            ]);

            return array_merge(['success' => true], $matchingData);

        } catch (\Exception $e) {
            Log::error('Job matching exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'error' => 'Internal processing error',
                'match_score' => 0,
                'reasoning' => 'An error occurred while processing the match.',
                'skills_analysis' => [],
                'is_perfect_match' => false
            ];
        }
    }

    private function isValidMatchingResponse($data)
    {
        // Make sure $data is an array
        if (!is_array($data)) {
            return false;
        }

        $requiredKeys = [
            'match_score',
            'reasoning',
            'skills_analysis',
            'is_perfect_match'
        ];
        
        // Check if all required keys exist
        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $data)) {
                return false;
            }
        }
        
        // Validate data types
        if (!is_numeric($data['match_score']) || 
            !is_string($data['reasoning']) || 
            !is_array($data['skills_analysis']) || 
            !is_bool($data['is_perfect_match'])) {
            return false;
        }
        
        // Validate match_score range
        if ($data['match_score'] < 0 || $data['match_score'] > 100) {
            return false;
        }
        
        return true;
    }

    /**
     * Extract CV data from a file directly.
     * This method is useful for internal calls from other controllers.
     * 
     * @param \Illuminate\Http\UploadedFile $file
     * @return array
     */
    public function extractFromFile($file)
    {
        try {
            // Fix: Correctly set the API URL to extract-cv
            $apiUrl = config('services.cv_extraction.api_url', 'http://localhost:5000/api/extract-cv');
            
            Log::info('Sending CV to extraction API', [
                'api_url' => $apiUrl,
                'file_name' => $file->getClientOriginalName(),
                'file_size' => $file->getSize()
            ]);
            
            // Call the CV extraction API with the correct endpoint and method
            $response = Http::timeout(60)
                ->withHeaders(['Accept' => 'application/json'])
                ->attach(
                    'cv_file', 
                    file_get_contents($file->path()), 
                    $file->getClientOriginalName()
                )
                ->post($apiUrl);
            
            // Check if the API call was successful
            if (!$response->successful()) {
                Log::error('CV extraction API error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                throw new \Exception('API Error (' . $response->status() . '): ' . $response->body());
            }
            
            // Get the API response data
            $apiData = $response->json();
            Log::info('CV extraction successful', ['data_keys' => array_keys($apiData)]);
            
            // Ensure we have cv_data field in the response
            if (!isset($apiData['cv_data']) && isset($apiData['data'])) {
                $apiData['cv_data'] = $apiData['data'];
            }
            
            return $apiData;
            
        } catch (\Exception $e) {
            Log::error('CV extraction failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            throw $e;
        }
    }

    /**
     * Check compatibility score between a given CV and a job position
     * This method is called via AJAX from the frontend.
     */
    public function checkCompatibilityScore(Request $request)
    {
        $request->validate([
            'cv_id' => 'required|exists:job_seeker_cvs,id',
            'job_position_id' => 'required|exists:job_positions,id',
        ], [
            'cv_id.required' => 'The CV is required for compatibility check.',
            'cv_id.exists' => 'The selected CV is invalid or does not exist.',
            'job_position_id.required' => 'The job position is required for compatibility check.',
            'job_position_id.exists' => 'The selected job position is invalid or does not exist.'
        ]);

        try {
            // Retrieve the CV content
            $cvContent = null;
            $jobSeekerCv = \App\Models\JobSeekerCV::find($request->cv_id);

            if (!$jobSeekerCv || $jobSeekerCv->user_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'error' => 'The selected CV could not be found or you do not have permission to access it.'
                ], 403); // Forbidden
            }
            
            // Assuming getCVContent method exists on JobSeekerController and returns the actual CV content
            // Need to instantiate JobSeekerController or move this logic
            // For now, let's assume we can directly access the file or content from the JobSeekerCV model
            // This is a placeholder, as fetching the CV content might involve file storage or database retrieval
            // For a robust solution, consider a dedicated service or method to safely retrieve CV content.
            // Example:
            $cvFilePath = storage_path('app/' . $jobSeekerCv->file_path);
            if (!file_exists($cvFilePath)) {
                 return response()->json([
                    'success' => false,
                    'error' => 'The CV file could not be found on the server.'
                ], 404);
            }
            // Temporarily create a dummy file object for consistency with matchWithJob
            // In a real scenario, you'd ensure matchWithJob can accept a file path or content directly
            $tempFile = new \Illuminate\Http\UploadedFile(
                $cvFilePath,
                basename($jobSeekerCv->file_path),
                mime_content_type($cvFilePath),
                null,
                true // for test
            );


            // Retrieve the Job Position description
            $jobPosition = \App\Models\JobPosition::find($request->job_position_id);

            if (!$jobPosition) {
                return response()->json([
                    'success' => false,
                    'error' => 'The selected job position could not be found.'
                ], 404);
            }

            // Call the matchWithJob function, passing the file and job description
            // The matchWithJob function expects an UploadedFile object for the CV
            $matchingResults = $this->matchWithJob($tempFile, $jobPosition->description);

            if ($matchingResults['success']) {
                // Optionally save the compatibility score
                // Example:
                // $compatibility = new JobCompatibility();
                // $compatibility->job_seeker_cv_id = $request->cv_id;
                // $compatibility->job_position_id = $request->job_position_id;
                // $compatibility->score = $matchingResults['match_score'];
                // $compatibility->save();

                return response()->json([
                    'success' => true,
                    'match_score' => $matchingResults['match_score'],
                    'reasoning' => $matchingResults['reasoning'],
                    'skills_analysis' => $matchingResults['skills_analysis']
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'error' => $matchingResults['reasoning'] ?? 'Failed to calculate compatibility score.',
                    'details' => $matchingResults // Pass full details for debugging, but user sees 'error'
                ], 500);
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Validation failed: ' . $e->getMessage(),
                'details' => $e->errors()
            ], 422); // Unprocessable Entity
        } catch (\Exception $e) {
            Log::error('Error checking compatibility score', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'error' => 'An unexpected error occurred while checking compatibility. Please try again. If the problem persists, contact support.'
            ], 500);
        }
    }
}
