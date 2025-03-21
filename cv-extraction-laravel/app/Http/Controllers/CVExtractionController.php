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
            'cv_file' => 'required|mimes:pdf|max:10240', // 10MB max
            'job_description' => 'nullable|string',
        ]);
        
        try {
            // Get the CV file
            $file = $request->file('cv_file');
            
            // Step 1: Extract CV data
            $extractedData = $this->extract($request);
            
            // Step 2: If job description is provided, try to match CV with job
            $jobDescription = $request->job_description ?? '';
            $matchingData = null;
            $matchingError = null;
            
            if (!empty($jobDescription)) {
                try {
                    // Important: Pass the original file, not extracted data
                    $matchingData = $this->matchWithJob($file, $jobDescription);
                } catch (\Exception $e) {
                    // Store the error message but continue with CV extraction
                    $matchingError = $e->getMessage();
                    Log::warning('Job matching failed but continuing with CV data', [
                        'error' => $matchingError
                    ]);
                }
            }
            
            // Combine the results
            $result = [
                'cvData' => $extractedData['cv_data'] ?? null,
                'jobMatching' => $matchingData ?? null,
                'jobDescription' => $jobDescription,
                'matchingError' => $matchingError // Pass the error to the view
            ];
            
            // Pass the extracted data to the view
            return view('cv-extraction.result', $result);
            
        } catch (\Exception $e) {
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
            // Set the API URL for job matching
            $apiUrl = 'http://127.0.0.1:5000/api/match-cv-with-job';
            
            Log::info('Sending CV data for job matching', [
                'api_url' => $apiUrl,
                'job_description_length' => strlen($jobDescription),
                'file_name' => $cvFile instanceof \Illuminate\Http\UploadedFile ? $cvFile->getClientOriginalName() : 'Unknown file'
            ]);
            
            // Ensure we have a valid file to send
            if (!$cvFile instanceof \Illuminate\Http\UploadedFile) {
                throw new \Exception('Invalid CV file provided for job matching');
            }
            
            // Call the job matching API - send the file, not the data
            $response = Http::timeout(60)
                ->withHeaders(['Accept' => 'application/json'])
                ->attach(
                    'cv_file', 
                    file_get_contents($cvFile->path()), 
                    $cvFile->getClientOriginalName()
                )
                ->post($apiUrl, [
                    'job_description' => $jobDescription,
                    'job_title' => request('job_title', 'Job Position'),
                    'required_skills' => request('required_skills', ''),
                    'experience_years' => request('experience_years', ''),
                    'education_requirements' => request('education_requirements', '')
                ]);
                
            // Check if the API call was successful
            if (!$response->successful()) {
                Log::error('Job matching API error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                
                return [
                    'error' => true,
                    'message' => 'Job matching API error: ' . $response->status(),
                    'details' => $response->json() ?: $response->body()
                ];
            }
            
            // Get the API response data as JSON
            $matchingData = $response->json();
            
            if (!$matchingData || !is_array($matchingData)) {
                Log::error('Invalid job matching response format', [
                    'response' => $response->body()
                ]);
                
                return [
                    'error' => true,
                    'message' => 'Invalid response format from job matching API'
                ];
            }
            
            Log::info('Job matching successful', ['data_keys' => array_keys($matchingData)]);
            
            return $matchingData;
            
        } catch (\Exception $e) {
            Log::error('Job matching exception', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            
            return [
                'error' => true,
                'message' => $e->getMessage()
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
}
