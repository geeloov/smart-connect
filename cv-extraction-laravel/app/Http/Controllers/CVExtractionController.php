<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CvExtractionController extends Controller
{
    /**
     * Display the CV extraction form
     */
    public function index()
    {
        return view('cv-extraction.index');
    }

    /**
     * Process method for the form - handles both extraction and optional matching
     */
    public function process(Request $request)
    {
        $request->validate([
            'cv_file' => 'required|file|mimes:pdf|max:10240', // 10MB max
            'job_description' => 'nullable|string|max:50000'
        ]);
        
        try {
            // Get the CV file
            $file = $request->file('cv_file');
            
            // Step 1: Extract CV data
            $extractedData = $this->extract($request);
            
            // Step 2: If job description is provided, try to match CV with job
            $jobDescription = $request->job_description ?? '';
            $matchingResults = null;
            $matchingError = null;
            
            if (!empty($jobDescription)) {
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
            }
            
            if (!$matchingResults['success']) {
                Log::warning('Job matching failed', [
                    'error' => $matchingResults['error'],
                    'reasoning' => $matchingResults['reasoning']
                ]);
            }
            
            // Combine the results
            $result = [
                'cvData' => $extractedData['cv_data'] ?? null,
                'jobMatching' => $matchingResults,
                'jobDescription' => $jobDescription,
                'matchingError' => $matchingError // Pass the error to the view
            ];
            
            // Pass the extracted data to the view
            return view('cv-extraction.result', $result);
            
        } catch (\Exception $e) {
            Log::error('CV processing failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Process the CV extraction
     */
    public function extract(Request $request)
    {
        $request->validate([
            'cv_file' => 'required|mimes:pdf|max:10240', // 10MB max
            'job_description' => 'nullable|string',
        ]);
        
        try {
            // Get the CV file
            $file = $request->file('cv_file');
            
            // Fix: Correctly set the API URL to extract-cv
            $apiUrl = 'http://127.0.0.1:5000/api/extract-cv';
            
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
                return back()->with('error', 'API Error (' . $response->status() . '): ' . $response->body());
            }
            
            // Get the API response data
            $apiData = $response->json();
            Log::info('CV extraction successful', ['data_keys' => array_keys($apiData)]);
            
            // Return the extracted CV data
            return $apiData;
            
        } catch (\Exception $e) {
            Log::error('CV extraction exception', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            throw $e;
        }
    }

    /**
     * Process the CV and match it with a job description
     */
    public function matchWithJob($cvFile, $jobDescription)
    {
        try {
            $apiUrl = 'http://127.0.0.1:5000/api/match-cv-with-job';
            
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
                
                // Return a properly structured error response
                return [
                    'success' => false,
                    'match_score' => 50,
                    'is_perfect_match' => false,
                    'reasoning' => 'The AI service experienced a temporary issue. The CV has been extracted, but detailed matching is unavailable right now.',
                    'skills_analysis' => [
                        'matched_skills' => [],
                        'missing_skills' => []
                    ]
                ];
            }
            
            $matchingData = $response->json();
            
            // Extract the job_matching data from the response
            $jobMatching = $matchingData['job_matching'] ?? [];
            
            Log::info('Job matching successful', ['data_keys' => array_keys($jobMatching)]);
            
            return [
                'success' => true,
                'match_score' => $jobMatching['match_score'] ?? 50,
                'is_perfect_match' => $jobMatching['is_perfect_match'] ?? false,
                'reasoning' => $jobMatching['reasoning'] ?? 'Analysis completed',
                'skills_analysis' => $jobMatching['skills_analysis'] ?? [
                    'matched_skills' => [],
                    'missing_skills' => []
                ]
            ];
            
        } catch (\Exception $e) {
            Log::error('Job matching exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return [
                'success' => false,
                'match_score' => 50,
                'is_perfect_match' => false,
                'reasoning' => 'An error occurred during the matching process.',
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
            $apiUrl = config('services.cv_matching.url', 'http://127.0.0.1:5000/api/match-cv-with-job');
            
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
}
