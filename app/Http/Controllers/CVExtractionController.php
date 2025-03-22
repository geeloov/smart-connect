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
                    'reasoning' => 'The AI service experienced a temporary issue. Try again later.',
                    'skills_analysis' => [
                        'matched_skills' => [],
                        'missing_skills' => []
                    ]
                ];
            }
            
            $matchingData = $response->json();
            
            // Extract the job_matching data from the response
            $jobMatching = $matchingData['job_matching'] ?? [];
            
            if (empty($jobMatching)) {
                Log::warning('Job matching API returned empty job_matching data', [
                    'data_keys' => array_keys($matchingData)
                ]);
                
                return [
                    'success' => false,
                    'match_score' => 50,
                    'is_perfect_match' => false,
                    'reasoning' => 'The CV analysis completed, but job matching data is incomplete.',
                    'skills_analysis' => [
                        'matched_skills' => [],
                        'missing_skills' => []
                    ]
                ];
            }
            
            Log::info('Job matching successful', ['data_keys' => array_keys($jobMatching)]);
            
            // Check if the reasoning contains an error message
            $reasoning = $jobMatching['reasoning'] ?? 'Analysis completed';
            $isErrorResponse = strpos($reasoning, 'Error in AI processing') !== false;
            
            return [
                'success' => !$isErrorResponse,
                'match_score' => $jobMatching['match_score'] ?? 50,
                'is_perfect_match' => $jobMatching['is_perfect_match'] ?? false,
                'reasoning' => $reasoning,
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

    // Other methods remain unchanged
    // ...
} 