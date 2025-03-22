<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\JobPosition;

class RecruiterController extends Controller
{
    /**
     * Display the CV extraction tool for recruiters.
     */
    public function cvExtraction()
    {
        // Check for flashed CV data from session (after extraction)
        $cvData = request()->session()->get('cvData');
        $jobMatching = request()->session()->get('jobMatching');
        $jobPosition = request()->session()->get('jobPosition');
        $matchingError = request()->session()->get('matchingError');
        
        // Get the recruiter's job positions for the dropdown
        $jobPositions = Auth::user()->jobPositions()
                        ->where('is_active', true)
                        ->latest()
                        ->get();
        
        return view('recruiter.cv-extraction', compact(
            'cvData', 
            'jobMatching', 
            'jobPosition',
            'matchingError',
            'jobPositions'
        ));
    }

    /**
     * Process the CV extraction for recruiters.
     */
    public function cvExtractionProcess(Request $request)
    {
        // Validate the request
        $request->validate([
            'cv_file' => 'required|file|mimes:pdf|max:10240', // 10MB max
            'job_position_id' => 'required|exists:job_positions,id',
        ]);

        try {
            // Log the original file details
            $file = $request->file('cv_file');
            Log::info('CV file uploaded by recruiter', [
                'filename' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'mime_type' => $file->getMimeType()
            ]);
            
            // Verify the job position belongs to the current recruiter
            $jobPosition = JobPosition::where('id', $request->job_position_id)
                ->where('user_id', Auth::id())
                ->firstOrFail();
            
            // Get job description from selected position
            $jobDescription = $jobPosition->description;
            
            // Get extraction controller
            $extractionController = app()->make('App\Http\Controllers\CVExtractionController');
            
            // Step 1: Extract the CV data
            $extractedData = $extractionController->extract($request);
            
            // Step 2: Match CV with job using the job description
            $matchingData = null;
            $matchingError = null;
            
            try {
                Log::info('Sending CV data for job matching', [
                    'job_description_length' => strlen($jobDescription)
                ]);
                
                // Get matching data from API
                $matchingData = $extractionController->matchWithJob($file, $jobDescription);
                
                // Check if the matching was successful
                if (isset($matchingData['success']) && $matchingData['success'] === false) {
                    // If there was an error in the API but we got a structured response
                    $matchingError = "Job matching completed with limited accuracy. Some features may not be available.";
                    
                    // If the reasoning contains an error message, extract it
                    if (isset($matchingData['reasoning']) && strpos($matchingData['reasoning'], 'Error') !== false) {
                        // Extract just the first sentence of the error for user-friendly display
                        $errorParts = explode('.', $matchingData['reasoning'], 2);
                        $matchingError = $errorParts[0] . ".";
                    }
                    
                    // Clean up any developer-facing error messages for the user
                    $matchingData['reasoning'] = "The system was able to analyze your CV but experienced some 
                       limitations with the job matching. Basic results are shown below.";
                }
                
            } catch (\Exception $e) {
                Log::warning('Job matching failed but continuing with CV data', [
                    'error' => $e->getMessage()
                ]);
                
                $matchingError = "We've extracted your CV data, but the job matching process encountered a technical issue.";
                
                // Use default error response structure from matchWithJob
                $matchingData = [
                    'success' => false,
                    'match_score' => 50,
                    'is_perfect_match' => false,
                    'reasoning' => 'Your CV has been processed. Job matching results are limited at this time.',
                    'skills_analysis' => [
                        'matched_skills' => [],
                        'missing_skills' => []
                    ]
                ];
            }
            
            // Flash the data to the session
            return redirect()->route('recruiter.cv-extraction')
                ->with('cvData', $extractedData['cv_data'] ?? null)
                ->with('jobMatching', $matchingData)
                ->with('jobPosition', $jobPosition)
                ->with('matchingError', $matchingError)
                ->with('success', 'CV processed successfully!');
                
        } catch (\Exception $e) {
            Log::error('Error processing CV upload for recruiter: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('recruiter.cv-extraction')
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }
} 