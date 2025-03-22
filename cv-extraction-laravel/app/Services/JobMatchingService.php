<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class JobMatchingService
{
    public function matchCVWithJob($cvData, $jobDescription)
    {
        try {
            $response = Http::post(config('services.matching_api.url') . '/api/match-cv-with-job', [
                'cv_data' => $cvData,
                'job_description' => $jobDescription
            ]);

            if (!$response->successful()) {
                Log::error('Job matching API error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                
                // Return a structured error response instead of failing
                return [
                    'match_score' => 0,
                    'is_perfect_match' => false,
                    'reasoning' => 'The matching service is temporarily unavailable. Please try again later.',
                    'skills_analysis' => [
                        'matched_skills' => [],
                        'missing_skills' => [],
                        'skills_match_score' => 0
                    ],
                    'error' => true
                ];
            }

            $matchingData = $response->json();
            
            // Validate the response structure
            if (!$this->isValidMatchingResponse($matchingData)) {
                throw new Exception('Invalid matching response structure');
            }

            return $matchingData;

        } catch (Exception $e) {
            Log::error('Job matching failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Return a structured error response
            return [
                'match_score' => 0,
                'is_perfect_match' => false,
                'reasoning' => 'An error occurred during job matching. Please try again later.',
                'skills_analysis' => [
                    'matched_skills' => [],
                    'missing_skills' => [],
                    'skills_match_score' => 0
                ],
                'error' => true
            ];
        }
    }

    private function isValidMatchingResponse($data)
    {
        return isset($data['match_score']) &&
               isset($data['is_perfect_match']) &&
               isset($data['reasoning']) &&
               isset($data['skills_analysis']);
    }
} 