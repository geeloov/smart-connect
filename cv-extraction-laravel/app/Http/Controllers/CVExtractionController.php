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
     * Process method for the form
     */
    public function process(Request $request)
    {
        return $this->extract($request);
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
            
            // Prepare job description (use empty string if not provided)
            $jobDescription = $request->job_description ?? '';
            
            // Fix: Correctly set the API URL to extract-cv, not just extract
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
                ->post($apiUrl, [
                    'job_description' => $jobDescription,
                ]);
            
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
            
            // Pass the extracted data to the view
            return view('cv-extraction.result', [
                'cvData' => $apiData['cv_data'] ?? null,
                'jobMatching' => $apiData['job_matching'] ?? null,
                'jobDescription' => $jobDescription
            ]);
            
        } catch (\Exception $e) {
            Log::error('CV extraction exception', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
