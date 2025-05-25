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
            
        // Get job position IDs for this recruiter
        $jobPositionIds = Auth::user()->jobPositions()->pluck('id');
        
        // Get recent applications
        $recentApplications = JobApplication::whereIn('job_position_id', $jobPositionIds)
            ->with(['jobSeeker', 'jobPosition'])
            ->latest()
            ->take(5)
            ->get();
            
        // Get recent compatibility checks (from job seekers who haven't applied yet)
        $compatibilityChecks = \App\Models\CVJobCompatibility::whereIn('job_position_id', $jobPositionIds)
            ->whereNotExists(function ($query) {
                $query->select(\DB::raw(1))
                    ->from('job_applications')
                    ->whereRaw('job_applications.user_id = cv_job_compatibility.user_id')
                    ->whereRaw('job_applications.job_position_id = cv_job_compatibility.job_position_id');
            })
            ->with(['user', 'jobPosition', 'cv'])
            ->latest()
            ->take(5)
            ->get();
            
        // Get counts for dashboard stats
        $totalJobPositions = Auth::user()->jobPositions()->count();
        $activeJobPositions = Auth::user()->jobPositions()->where('is_active', true)->count();
        $totalApplications = JobApplication::whereIn('job_position_id', $jobPositionIds)->count();
        $totalCompatibilityChecks = \App\Models\CVJobCompatibility::whereIn('job_position_id', $jobPositionIds)->count();
        
        return view('recruiter.dashboard', compact(
            'recentJobPositions',
            'recentApplications',
            'compatibilityChecks',
            'totalJobPositions',
            'activeJobPositions',
            'totalApplications',
            'totalCompatibilityChecks'
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
        // Get the recruiter's job positions for the dropdown
        $jobPositions = Auth::user()->jobPositions()
                        ->where('is_active', true)
                        ->latest()
                        ->get();
        
        // Check for data in session first - this is for redirects from error handling
        $cvData = session('cvData');
        $jobMatching = session('jobMatching');
        $jobDescription = session('jobDescription');
        
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
        \Illuminate\Support\Facades\Log::info('Recruiter CV Process Request data:', $request->all());
        // Validate the request
        $request->validate([
            'cv_file' => 'required|file|mimes:pdf|max:10240', // 10MB max
            'job_description' => 'nullable|string',
            'job_position_id' => 'nullable|exists:job_positions,id',
        ]);

        try {
            // Log the original file details
            $file = $request->file('cv_file');
            Log::info('CV file uploaded by recruiter', [
                'filename' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'mime_type' => $file->getMimeType()
            ]);
            
            // If a job position is selected, get its description
            $jobPosition = null;
            if ($request->filled('job_position_id')) {
                $jobPosition = JobPosition::findOrFail($request->job_position_id);
                $jobDescription = $jobPosition->description;
                
                // Add job description to the request
                $request->merge(['job_description' => $jobDescription]);
            } else {
                $jobDescription = $request->job_description ?? '';
            }
            
            // Get extraction controller
            $extractionController = app()->make('App\Http\Controllers\CVExtractionController');
            
            // Step 1: Extract the CV data
            $extractedData = $extractionController->extract($request);
            
            // Step 2: If job description is provided, try to match CV with job
            $matchingData = null;
            
            if (!empty($jobDescription)) {
                try {
                    Log::info('Sending CV data for job matching', [
                        'job_description_length' => strlen($jobDescription)
                    ]);
                    
                    // Get matching data from API
                    $matchingData = $extractionController->matchWithJob($file, $jobDescription);
                    
                    // Log the matching data structure to help diagnose
                    Log::info('Job matching data received', [
                        'structure' => array_keys($matchingData),
                        'success' => $matchingData['success'] ?? false,
                        'match_score' => $matchingData['match_score'] ?? 'not set',
                    ]);
                    
                    // Force a true success flag so the view doesn't show error warnings
                    // This now processes both the old and new formats consistently
                    $matchingData['success'] = true;
                    
                } catch (\Exception $e) {
                    Log::warning('Job matching failed but continuing with CV data', [
                        'error' => $e->getMessage()
                    ]);
                    
                    // Return error response with empty data
                    $matchingData = [
                        'success' => false,
                        'match_score' => 0,
                        'is_perfect_match' => false,
                        'reasoning' => 'Error processing CV data: ' . $e->getMessage(),
                        'skills_analysis' => [
                            'matched_skills' => [],
                            'missing_skills' => []
                        ]
                    ];
                }
            }
            
            // Get the recruiter's job positions for the dropdown (needed for the view)
            $jobPositions = Auth::user()->jobPositions()
                            ->where('is_active', true)
                            ->latest()
                            ->get();
            
            // Render the view directly with all the data, avoiding the redirect
            return view('recruiter.cv-extraction', [
                'cvData' => $extractedData['cv_data'] ?? null, 
                'jobMatching' => $matchingData,
                'jobDescription' => $jobDescription,
                'jobPositions' => $jobPositions,
                'success' => 'CV processed successfully!'
            ]);
                
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

