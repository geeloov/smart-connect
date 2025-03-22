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
        $request->validate([
            'cv_file' => 'required|file|mimes:pdf|max:10240', // 10MB max
            'job_position_id' => 'required|exists:job_positions,id' // Updated validation
        ]);
        
        try {
            // Get the CV file
            $file = $request->file('cv_file');
            
            // Verify the job position belongs to the current recruiter
            $jobPosition = JobPosition::where('id', $request->job_position_id)
                ->where('user_id', Auth::id())
                ->firstOrFail();
            
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
            'job_position_id' => 'nullable|exists:job_positions,id', // Updated validation
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
                    'match_score' => 0,
                    'is_perfect_match' => false,
                    'reasoning' => 'The CV extraction service encountered an error. Status: ' . $response->status(),
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
            } 
            // For backward compatibility and legacy response formats
            else if (isset($matchingData['match_score']) || isset($matchingData['reasoning'])) {
                Log::info('Job matching using direct format', ['data_keys' => array_keys($matchingData)]);
                
                // Map direct fields
                $result['match_score'] = $matchingData['match_score'] ?? 0;
                $result['is_perfect_match'] = $matchingData['is_perfect_match'] ?? false;
                $result['reasoning'] = $matchingData['reasoning'] ?? 'No analysis provided.';
                
                // Handle different skills analysis structures
                if (isset($matchingData['skills_analysis'])) {
                    if (isset($matchingData['skills_analysis']['matched_skills'])) {
                        $result['skills_analysis']['matched_skills'] = $matchingData['skills_analysis']['matched_skills'];
                    }
                    
                    if (isset($matchingData['skills_analysis']['missing_skills'])) {
                        $result['skills_analysis']['missing_skills'] = $matchingData['skills_analysis']['missing_skills'];
                    }
                } else if (isset($matchingData['skills'])) {
                    // Alternative structure with a 'skills' key
                    if (isset($matchingData['skills']['matched'])) {
                        $result['skills_analysis']['matched_skills'] = $matchingData['skills']['matched'];
                    }
                    
                    if (isset($matchingData['skills']['missing'])) {
                        $result['skills_analysis']['missing_skills'] = $matchingData['skills']['missing'];
                    }
                }
                
                // Map experience and education if available
                if (isset($matchingData['experience_analysis'])) {
                    $result['experience_analysis'] = $matchingData['experience_analysis'];
                }
                
                if (isset($matchingData['education_analysis'])) {
                    $result['education_analysis'] = $matchingData['education_analysis'];
                }
            } else {
                Log::warning('Unexpected API response format', [
                    'data_keys' => is_array($matchingData) ? array_keys($matchingData) : 'not an array'
                ]);
            }
            
            // Ensure match_score is numeric
            if (!is_numeric($result['match_score'])) {
                $result['match_score'] = 0;
            }
            
            return $result;
            
        } catch (\Exception $e) {
            Log::error('Job matching exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return [
                'success' => false,
                'match_score' => 0,
                'is_perfect_match' => false,
                'reasoning' => 'An error occurred during the matching process: ' . $e->getMessage(),
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
