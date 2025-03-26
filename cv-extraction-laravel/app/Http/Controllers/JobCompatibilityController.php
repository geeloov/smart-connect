<?php

namespace App\Http\Controllers;

use App\Models\CV;
use App\Models\CVJobCompatibility;
use App\Models\JobPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Illuminate\Validation\ValidationException;

class JobCompatibilityController extends Controller
{
    /**
     * Check compatibility between a CV and job position
     * First checks if an existing compatibility score exists
     * If not, makes an API call to get the score and stores it
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkCompatibility(Request $request)
    {
        try {
            Log::info('Starting compatibility check', [
                'has_cv_id' => $request->has('cv_id'),
                'cv_id_value' => $request->input('cv_id'),
                'has_cv_file' => $request->hasFile('cv_file'),
                'job_position_id' => $request->input('job_position_id')
            ]);
            
            $request->validate([
                'cv_id' => 'required_without:cv_file',
                'cv_file' => 'required_without:cv_id|file|mimes:pdf|max:10240',
                'job_position_id' => 'required|exists:job_positions,id',
            ]);

            $jobPositionId = $request->input('job_position_id');
            $jobPosition = JobPosition::findOrFail($jobPositionId);
            $userId = Auth::id();
            
            // Check if using existing CV or uploaded file
            if ($request->has('cv_id') && !empty($request->input('cv_id'))) {
                $cvId = $request->input('cv_id');
                
                Log::info('Looking up CV with ID', ['cv_id' => $cvId]);
                
                try {
                    $cv = CV::findOrFail($cvId);
                    
                    Log::info('Found CV', [
                        'cv_id' => $cvId,
                        'file_name' => $cv->file_name,
                        'file_path' => $cv->file_path
                    ]);
                    
                    // Check if the CV file actually exists
                    $cvPath = storage_path('app/public/' . $cv->file_path);
                    
                    if (!file_exists($cvPath)) {
                        Log::error('CV file does not exist at path', ['path' => $cvPath]);
                        return response()->json([
                            'error' => 'CV file not found on server. Please upload a new CV.'
                        ], 404);
                    }
                    
                    // Check if the file is readable
                    if (!is_readable($cvPath)) {
                        Log::error('CV file is not readable', ['path' => $cvPath]);
                        return response()->json([
                            'error' => 'CV file cannot be read. Please upload a new CV.'
                        ], 500);
                    }
                    
                    // Check if we already have a compatibility score for this user/CV/job combination
                    $existingCompatibility = CVJobCompatibility::where('user_id', $userId)
                        ->where('cv_id', $cvId)
                        ->where('job_position_id', $jobPositionId)
                        ->first();
                    
                    if ($existingCompatibility) {
                        Log::info('Found existing compatibility score', [
                            'score' => $existingCompatibility->compatibility_score
                        ]);
                        
                        return response()->json([
                            'compatibility_score' => $existingCompatibility->compatibility_score,
                            'explanation' => $existingCompatibility->explanation,
                            'from_cache' => true
                        ]);
                    }
                    
                    // No existing score, need to make API call
                    Log::info('No existing score, making API call', [
                        'cv_path' => $cvPath,
                        'job_position_id' => $jobPositionId,
                        'file_exists' => file_exists($cvPath),
                        'file_size' => filesize($cvPath)
                    ]);
                    
                    return $this->getAndStoreCompatibilityScore($cvPath, $jobPosition, $userId, $cvId);
                } catch (\Exception $e) {
                    Log::error('Error finding CV', [
                        'cv_id' => $cvId,
                        'error' => $e->getMessage()
                    ]);
                    
                    return response()->json([
                        'error' => 'Could not find CV with ID ' . $cvId
                    ], 404);
                }
            } elseif ($request->hasFile('cv_file')) {
                // Handle uploaded file
                $uploadedFile = $request->file('cv_file');
                
                // Make sure we have a valid file
                if (!$uploadedFile->isValid()) {
                    Log::error('Invalid uploaded file', [
                        'error' => $uploadedFile->getError(),
                        'original_name' => $uploadedFile->getClientOriginalName()
                    ]);
                    return response()->json(['error' => 'Invalid file upload'], 400);
                }
                
                // Save to temp location accessible by Flask
                $tempPath = $uploadedFile->getRealPath();
                
                // Check if the temp file is accessible to Flask
                if (!is_readable($tempPath)) {
                    Log::error('Uploaded file is not readable', ['path' => $tempPath]);
                    
                    // Try to copy to a more accessible location
                    $newTempPath = sys_get_temp_dir() . '/' . uniqid('cv_') . '.pdf';
                    if (!copy($tempPath, $newTempPath)) {
                        Log::error('Failed to copy file to accessible location', [
                            'from' => $tempPath,
                            'to' => $newTempPath
                        ]);
                        return response()->json(['error' => 'Failed to process uploaded file'], 500);
                    }
                    
                    $tempPath = $newTempPath;
                    Log::info('Copied file to accessible location', ['new_path' => $tempPath]);
                }
                
                Log::info('Using uploaded CV file', [
                    'original_name' => $uploadedFile->getClientOriginalName(),
                    'temp_path' => $tempPath,
                    'size' => $uploadedFile->getSize(),
                    'mime' => $uploadedFile->getMimeType(),
                    'file_exists' => file_exists($tempPath),
                    'is_readable' => is_readable($tempPath)
                ]);
                
                // For uploaded file, we don't store in DB since it's a temporary check
                return $this->getCompatibilityScore($tempPath, $jobPosition);
            } else {
                Log::error('Missing CV data in request');
                return response()->json(['error' => 'No CV provided. Please provide either cv_id or cv_file.'], 400);
            }
        } catch (\Exception $e) {
            Log::error('Error in checkCompatibility: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'error' => 'Error processing compatibility check: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Get compatibility score from API and store it in database
     *
     * @param string $cvPath
     * @param JobPosition $jobPosition
     * @param int $userId
     * @param int $cvId
     * @return \Illuminate\Http\JsonResponse
     */
    private function getAndStoreCompatibilityScore($cvPath, JobPosition $jobPosition, $userId, $cvId)
    {
        try {
            $apiResponse = $this->getCompatibilityScore($cvPath, $jobPosition);
            $responseData = json_decode($apiResponse->getContent(), true);
            
            // Only store if API call was successful
            if (!isset($responseData['error']) && isset($responseData['compatibility_score'])) {
                try {
                    Log::info('Storing compatibility score in database', [
                        'user_id' => $userId,
                        'cv_id' => $cvId,
                        'job_position_id' => $jobPosition->id,
                        'score' => $responseData['compatibility_score']
                    ]);
                    
                    // Use updateOrCreate to safely handle the unique constraint
                    $record = CVJobCompatibility::updateOrCreate(
                        [
                            'user_id' => $userId,
                            'cv_id' => $cvId,
                            'job_position_id' => $jobPosition->id,
                        ],
                        [
                            'compatibility_score' => $responseData['compatibility_score'],
                            'explanation' => $responseData['explanation'] ?? null,
                        ]
                    );
                    
                    Log::info('Stored compatibility record', ['record_id' => $record->id]);
                    
                    // Add a flag to indicate this was stored in the database
                    $responseData['from_cache'] = false;
                    $responseData['stored_in_db'] = true;
                    
                    return response()->json($responseData);
                } catch (\Exception $e) {
                    Log::error('Failed to store compatibility score: ' . $e->getMessage(), [
                        'exception' => get_class($e),
                        'trace' => $e->getTraceAsString(),
                        'user_id' => $userId,
                        'cv_id' => $cvId,
                        'job_position_id' => $jobPosition->id
                    ]);
                    
                    // Still return the API response even if storing fails
                    return $apiResponse;
                }
            }
            
            return $apiResponse;
        } catch (\Exception $e) {
            Log::error('Exception in getAndStoreCompatibilityScore: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'error' => 'Failed to process compatibility check: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Quick check if Flask server is running to avoid long timeouts
     *
     * @return bool
     */
    private function isFlaskServerRunning()
    {
        try {
            $ch = curl_init('http://127.0.0.1:5000/api/health-check');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 2); // Short timeout
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            curl_close($ch);
            
            if ($httpCode === 200) {
                try {
                    $responseData = json_decode($response, true);
                    Log::info('Flask server is running', [
                        'health_status' => $responseData['status'] ?? 'unknown',
                        'message' => $responseData['message'] ?? 'No message',
                        'api_key_configured' => $responseData['api_key_configured'] ?? 'unknown'
                    ]);
                    return true;
                } catch (\Exception $e) {
                    Log::warning('Failed to parse Flask health check response', ['error' => $e->getMessage()]);
                    // Consider the server running if we got a 200 response, even if we can't parse it
                    return true;
                }
            } else {
                Log::warning('Flask server returned non-200 status code', [
                    'http_code' => $httpCode, 
                    'error' => $error
                ]);
                return false;
            }
        } catch (\Exception $e) {
            Log::warning('Exception when checking Flask server', ['error' => $e->getMessage()]);
            return false;
        }
    }
    
    /**
     * Make API call to Flask backend to get compatibility score
     *
     * @param string $cvPath
     * @param JobPosition $jobPosition
     * @return \Illuminate\Http\JsonResponse
     */
    private function getCompatibilityScore($cvPath, JobPosition $jobPosition)
    {
        try {
            Log::info('Beginning getCompatibilityScore method', [
                'cv_path' => $cvPath,
                'job_position_id' => $jobPosition->id,
                'job_title' => $jobPosition->title
            ]);

            if (!file_exists($cvPath)) {
                Log::error('CV file does not exist at path', ['path' => $cvPath]);
                return response()->json(['error' => 'CV file not found'], 404);
            }
            
            // Quick check if the Flask server is running before making a full API call
            if (!$this->isFlaskServerRunning()) {
                return response()->json([
                    'error' => 'The compatibility service is unavailable. Please ensure the Flask server is running at http://127.0.0.1:5000.'
                ], 503);
            }

            // Log the file details for debugging
            Log::info('Making API call to Flask', [
                'file_path' => $cvPath,
                'file_exists' => file_exists($cvPath),
                'file_size' => filesize($cvPath),
                'file_readable' => is_readable($cvPath),
                'file_mime' => mime_content_type($cvPath)
            ]);

            // Set up cURL request
            $ch = curl_init();
            
            // IMPORTANT: The Flask API expects a file path, not a file object
            // So we send the path as a string, not as a CURLFile
            $postFields = [
                'cv_file' => $cvPath,  // Send the file path as a string
                'job_description' => $jobPosition->description
            ];

            curl_setopt_array($ch, [
                CURLOPT_URL => 'http://127.0.0.1:5000/api/check-compatibility-score',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $postFields,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_VERBOSE => true
            ]);
            
            Log::info('Executing cURL request to Flask API', [
                'url' => 'http://127.0.0.1:5000/api/check-compatibility-score',
                'cv_path_sent' => $cvPath,
                'job_description_length' => strlen($jobPosition->description),
                'job_description_preview' => substr($jobPosition->description, 0, 100) . '...',
                'post_fields_keys' => array_keys($postFields)
            ]);
            
            // Execute request and get response
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $curlError = curl_error($ch);
            $curlErrorNo = curl_errno($ch);
            
            // Log the result
            Log::info('Received response from Flask API', [
                'http_code' => $httpCode,
                'curl_error' => $curlError,
                'curl_errno' => $curlErrorNo,
                'response_length' => $response ? strlen($response) : 0,
                'response_preview' => $response ? substr($response, 0, 100) . '...' : 'Empty response'
            ]);
            
            curl_close($ch);
            
            // Handle error cases
            if ($curlError) {
                Log::error('cURL error', [
                    'error' => $curlError,
                    'error_no' => $curlErrorNo
                ]);
                
                // Special handling for common error codes
                $errorMessage = $curlError;
                if ($curlErrorNo == 7) {
                    $errorMessage = "Failed to connect to Flask API. Is the Flask server running at http://127.0.0.1:5000?";
                }
                
                return response()->json(['error' => $errorMessage], 503);
            }
            
            // Process successful responses
            if ($httpCode >= 200 && $httpCode < 300) {
                try {
                    $responseData = json_decode($response, true);
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        Log::error('JSON decode error', [
                            'error' => json_last_error_msg(),
                            'response' => $response
                        ]);
                        return response()->json(['error' => 'Invalid response from Flask API'], 500);
                    }
                    
                    Log::info('Successfully parsed JSON response', [
                        'compatibility_score' => $responseData['compatibility_score'] ?? 'not found',
                        'has_explanation' => isset($responseData['explanation']),
                        'explanation_preview' => isset($responseData['explanation']) ? 
                            substr($responseData['explanation'], 0, 100) . '...' : 'No explanation'
                    ]);
                    
                    return response()->json($responseData);
                } catch (\Exception $e) {
                    Log::error('JSON parsing error', ['error' => $e->getMessage(), 'response' => $response]);
                    return response()->json(['error' => 'Failed to parse response from Flask API'], 500);
                }
            } else {
                Log::error('Flask API error', [
                    'http_code' => $httpCode,
                    'response' => $response
                ]);
                return response()->json([
                    'error' => 'Error from Flask API', 
                    'status_code' => $httpCode,
                    'response' => $response
                ], 500);
            }
        } catch (\Exception $e) {
            Log::error('Exception in getCompatibilityScore', [
                'message' => $e->getMessage(), 
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Service unavailable: ' . $e->getMessage()], 503);
        }
    }

    /**
     * Test if the Flask API is running and accessible
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function testFlaskConnection()
    {
        try {
            // Make a simple GET request to the Flask server (not a specific endpoint)
            $ch = curl_init('http://127.0.0.1:5000/');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_exec($ch);
            
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            curl_close($ch);
            
            if ($error) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Could not connect to Flask server: ' . $error,
                    'details' => 'Make sure the Flask server is running at http://127.0.0.1:5000'
                ], 500);
            }
            
            return response()->json([
                'status' => 'success',
                'message' => 'Flask server is running and accessible',
                'response_code' => $statusCode
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Exception while testing Flask connection: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store compatibility results from client-side API call
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeCompatibility(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'cv_id' => 'required|exists:cvs,id',
                'job_position_id' => 'required|exists:job_positions,id',
                'compatibility_score' => 'required|integer|min:0|max:100',
                'explanation' => 'nullable|string',
                'skills_score' => 'nullable|integer|min:0|max:100',
                'experience_score' => 'nullable|integer|min:0|max:100',
                'education_score' => 'nullable|integer|min:0|max:100',
                'matched_skills' => 'nullable|string', // JSON encoded array
                'missing_skills' => 'nullable|string', // JSON encoded array
            ]);

            // Get the current user
            $userId = Auth::id();
            
            // Check if a compatibility record already exists
            $existingRecord = CVJobCompatibility::where('user_id', $userId)
                ->where('cv_id', $validated['cv_id'])
                ->where('job_position_id', $validated['job_position_id'])
                ->first();
            
            if ($existingRecord) {
                // Return existing record without modification
                return response()->json([
                    'message' => 'Compatibility record already exists',
                    'data' => $existingRecord,
                    'from_cache' => true
                ]);
            }
            
            // Create a new compatibility record
            $compatibilityRecord = CVJobCompatibility::create([
                'user_id' => $userId,
                'cv_id' => $validated['cv_id'],
                'job_position_id' => $validated['job_position_id'],
                'compatibility_score' => $validated['compatibility_score'],
                'explanation' => $validated['explanation'] ?? null,
                'skills_score' => $validated['skills_score'] ?? null,
                'experience_score' => $validated['experience_score'] ?? null,
                'education_score' => $validated['education_score'] ?? null,
                'matched_skills' => $validated['matched_skills'] ?? null,
                'missing_skills' => $validated['missing_skills'] ?? null,
            ]);
            
            return response()->json([
                'message' => 'Compatibility record created successfully',
                'data' => $compatibilityRecord
            ]);
        } catch (ValidationException $e) {
            Log::error('Validation error in storeCompatibility', [
                'errors' => $e->errors(),
            ]);
            
            return response()->json([
                'error' => 'Validation error',
                'details' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error in storeCompatibility: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'error' => 'Failed to store compatibility record: ' . $e->getMessage()
            ], 500);
        }
    }
}
