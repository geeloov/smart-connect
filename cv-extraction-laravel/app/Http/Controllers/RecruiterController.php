<?php

namespace App\Http\Controllers;

use App\Models\JobPosition;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Services\CVExtractionService;
use GuzzleHttp\Client;

class RecruiterController extends Controller
{
    /**
     * Display the recruiter dashboard.
     */
    public function dashboard()
    {
        // Get recent job positions
        $recentJobPositions = Auth::user()->jobPositions()
            ->latest()
            ->take(5)
            ->get();
            
        // Get recent applications
        $jobPositionIds = Auth::user()->jobPositions()->pluck('id');
        $recentApplications = JobApplication::whereIn('job_position_id', $jobPositionIds)
            ->with(['jobSeeker', 'jobPosition'])
            ->latest()
            ->take(5)
            ->get();
            
        // Get counts for dashboard stats
        $totalJobPositions = Auth::user()->jobPositions()->count();
        $activeJobPositions = Auth::user()->jobPositions()->where('is_active', true)->count();
        $totalApplications = JobApplication::whereIn('job_position_id', $jobPositionIds)->count();
        
        return view('recruiter.dashboard', compact(
            'recentJobPositions',
            'recentApplications',
            'totalJobPositions',
            'activeJobPositions',
            'totalApplications'
        ));
    }

    /**
     * Display the recruiter profile.
     */
    public function profile()
    {
        $user = Auth::user();
        return view('recruiter.profile', compact('user'));
    }
    
    /**
     * Update the recruiter profile.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'company_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
        ]);
        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        
        // Update or create recruiter profile record if needed
        // For now, we can use the candidate model or create a separate recruiter profile model
        $recruiterProfile = $user->recruiterProfile;
        if (!$recruiterProfile) {
            $recruiterProfile = new \App\Models\RecruiterProfile();
            $recruiterProfile->user_id = $user->id;
        }
        
        $recruiterProfile->company_name = $request->company_name;
        $recruiterProfile->phone = $request->phone;
        $recruiterProfile->location = $request->location;
        $recruiterProfile->bio = $request->bio;
        $recruiterProfile->save();
        
        return redirect()->route('recruiter.profile')
            ->with('success', 'Profile updated successfully!');
    }

    /**
     * Display the CV extraction tool for recruiters.
     */
    public function cvExtraction()
    {
        // Check for flashed CV data from session (after extraction)
        $cvData = request()->session()->get('cvData');
        $jobMatching = request()->session()->get('jobMatching');
        $jobDescription = request()->session()->get('jobDescription');
        
        // Get the recruiter's job positions for the dropdown
        $jobPositions = Auth::user()->jobPositions()
                        ->where('is_active', true)
                        ->latest()
                        ->get();
        
        return view('recruiter.cv-extraction', compact(
            'cvData', 
            'jobMatching', 
            'jobDescription',
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
            'job_description' => 'nullable|string',
            'job_position_id' => 'nullable|exists:job_positions,id',
        ]);

        try {
            // Get the CV file and store it for future reference
            $file = $request->file('cv_file');
            
            // Log the file details
            Log::info('CV file uploaded by recruiter', [
                'filename' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'mime_type' => $file->getMimeType()
            ]);
            
            // Get or prepare the job description and related info
            $jobDescription = '';
            $jobTitle = '';
            $requiredSkills = '';
            $experienceYears = '';
            $educationRequirements = '';
            
            // Get job position information if selected
            if ($request->job_position_id) {
                $jobPosition = JobPosition::findOrFail($request->job_position_id);
                $jobDescription = $jobPosition->description;
                $jobTitle = $jobPosition->title;
                
                // Extract other job details if available
                $requiredSkills = $jobPosition->requirements ?? '';
                $experienceYears = $jobPosition->experience_years ?? '';
                $educationRequirements = $jobPosition->education_requirements ?? '';
                
                // Add job details to the request
                $request->merge([
                    'job_description' => $jobDescription,
                    'job_title' => $jobTitle,
                    'required_skills' => $requiredSkills,
                    'experience_years' => $experienceYears,
                    'education_requirements' => $educationRequirements
                ]);
            } else if ($request->has('job_description')) {
                $jobDescription = $request->job_description;
            }
            
            // Get extraction controller
            $extractionController = app()->make('App\Http\Controllers\CVExtractionController');
            
            // Step 1: Always extract CV data
            $apiData = null;
            $cvData = null;
            $matchingData = null;
            $matchingError = null;
            
            try {
                // Extract CV data
                $apiData = $extractionController->extract($request);
                
                if (isset($apiData['cv_data'])) {
                    $cvData = $apiData['cv_data'];
                    Log::info('CV data extracted successfully', ['data_keys' => array_keys($cvData)]);
                } else {
                    throw new \Exception('No CV data returned from extraction API');
                }
                
                // Step 2: If job description is provided, match CV with job
                if (!empty($jobDescription)) {
                    try {
                        Log::info('Sending CV data for job matching', [
                            'job_description_length' => strlen($jobDescription)
                        ]);
                        
                        // Pass the original file, not the data
                        $matchingResult = $extractionController->matchWithJob($file, $jobDescription);
                        
                        // Check for errors in the matching result
                        if (isset($matchingResult['error']) && $matchingResult['error'] === true) {
                            throw new \Exception($matchingResult['message']);
                        }
                        
                        // Transform the job matching data to the format expected by the view
                        $formattedJobMatching = [];
                        
                        if (isset($matchingResult['job_matching'])) {
                            $jobMatching = $matchingResult['job_matching'];
                            
                            // Set the score
                            $formattedJobMatching['score'] = $jobMatching['match_score'] ?? 0;
                            
                            // Get matching skills from skills_analysis
                            if (isset($jobMatching['skills_analysis']) && isset($jobMatching['skills_analysis']['matched_skills'])) {
                                $formattedJobMatching['matching_skills'] = $jobMatching['skills_analysis']['matched_skills'];
                            }
                            
                            // Add missing skills
                            if (isset($jobMatching['skills_analysis']) && isset($jobMatching['skills_analysis']['missing_skills'])) {
                                $formattedJobMatching['missing_skills'] = $jobMatching['skills_analysis']['missing_skills'];
                            }
                            
                            // Add reasoning
                            if (isset($jobMatching['reasoning'])) {
                                $formattedJobMatching['reasoning'] = $jobMatching['reasoning'];
                            }
                            
                            // Add education and experience analyses
                            if (isset($jobMatching['education_analysis'])) {
                                $formattedJobMatching['education'] = $jobMatching['education_analysis'];
                            }
                            
                            if (isset($jobMatching['experience_analysis'])) {
                                $formattedJobMatching['experience'] = $jobMatching['experience_analysis'];
                            }
                            
                            // Add is_perfect_match flag
                            $formattedJobMatching['is_perfect_match'] = $jobMatching['is_perfect_match'] ?? false;
                            
                        } elseif (isset($matchingResult['match_score'])) {
                            // Direct match score from the API
                            $formattedJobMatching['score'] = $matchingResult['match_score'];
                            
                            // Try to get other data
                            if (isset($matchingResult['compatibility_analysis'])) {
                                $compAnalysis = is_string($matchingResult['compatibility_analysis']) ? 
                                                json_decode($matchingResult['compatibility_analysis'], true) : 
                                                $matchingResult['compatibility_analysis'];
                                
                                if (isset($compAnalysis['matching_skills'])) {
                                    $formattedJobMatching['matching_skills'] = $compAnalysis['matching_skills'];
                                }
                                
                                if (isset($compAnalysis['missing_skills'])) {
                                    $formattedJobMatching['missing_skills'] = $compAnalysis['missing_skills'];
                                }
                                
                                if (isset($compAnalysis['reasoning'])) {
                                    $formattedJobMatching['reasoning'] = $compAnalysis['reasoning'];
                                }
                            }
                        }
                        
                        $matchingData = $formattedJobMatching;
                        
                        Log::info('Job matching completed successfully', [
                            'matching_data_keys' => is_array($matchingData) ? array_keys($matchingData) : 'not an array'
                        ]);
                        
                    } catch (\Exception $e) {
                        // Store the error message but continue with CV data
                        $matchingError = $e->getMessage();
                        Log::warning('Job matching failed but continuing with CV data', [
                            'error' => $matchingError
                        ]);
                    }
                }
            } catch (\Exception $e) {
                Log::error('CV extraction failed: ' . $e->getMessage(), [
                    'trace' => $e->getTraceAsString()
                ]);
                
                return redirect()->route('recruiter.cv-extraction')
                    ->with('error', 'CV extraction failed: ' . $e->getMessage());
            }
            
            // Return results to view
            $redirectResponse = redirect()->route('recruiter.cv-extraction')
                ->with('cvData', $cvData)
                ->with('jobMatching', $matchingData)
                ->with('jobDescription', $jobDescription)
                ->with('success', 'CV processed successfully!');
                
            // Add matching error if present
            if ($matchingError) {
                $redirectResponse->with('matchingError', $matchingError);
                $redirectResponse->with('warning', 'CV data extracted successfully, but job matching failed: ' . $matchingError);
            }
            
            return $redirectResponse;
            
        } catch (\Exception $e) {
            Log::error('Error processing CV upload for recruiter: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('recruiter.cv-extraction')
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Save a candidate from the CV extraction tool.
     */
    public function saveCandidate(Request $request)
    {
        try {
            $request->validate([
                'cv_data' => 'required|array'
            ]);
            
            // Log the save attempt
            \Log::info('Candidate save requested', [
                'data_keys' => array_keys($request->input('cv_data'))
            ]);
            
            // Here you would typically save to a database
            // For now, we'll just return success
            
            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Candidate saved successfully'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error saving candidate: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Calculate years of experience from work history.
     */
    private function calculateExperienceYears($workExperience)
    {
        // Simple calculation - just count the number of entries
        return count($workExperience);
    }

    /**
     * Display the candidates database.
     */
    public function candidates()
    {
        // In a real application, we would:
        // 1. Fetch candidates from the database
        // 2. Pass them to the view

        return view('recruiter.candidates');
    }

    /**
     * Display the job matching tool.
     */
    public function jobMatching()
    {
        return view('recruiter.job-matching');
    }

    /**
     * Display a list of job applications for a recruiter.
     *
     * @return \Illuminate\View\View
     */
    public function applications()
    {
        // Get the authenticated user (recruiter)
        $user = auth()->user();
        
        // Get job positions belonging to this recruiter
        $jobPositionIds = $user->jobPositions()->pluck('id');
        
        // Query job applications for these positions with pagination
        $applications = \App\Models\JobApplication::whereIn('job_position_id', $jobPositionIds)
            ->with(['jobSeeker', 'jobPosition'])
            ->latest()
            ->paginate(10);
            
        return view('recruiter.applications.index', compact('applications'));
    }
}

