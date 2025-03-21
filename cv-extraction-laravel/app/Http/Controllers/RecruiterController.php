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
        
        return view('recruiter.cv-extraction', compact('cvData', 'jobMatching', 'jobDescription'));
    }

    /**
     * Process the CV extraction for recruiters.
     */
    public function cvExtractionProcess(Request $request)
    {
        // Validate the request
        $request->validate([
            'cv_file' => 'required|file|mimes:pdf|max:10240', // 10MB max
        ]);

        try {
            // Log the original file details
            $file = $request->file('cv_file');
            Log::info('CV file uploaded by recruiter', [
                'filename' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'mime_type' => $file->getMimeType()
            ]);
            
            // Get extraction controller - SAME AS JOB SEEKER APPROACH
            $extractionController = app()->make('App\Http\Controllers\CvExtractionController');
            
            // Get the extraction results - the file is only temporarily used
            $response = $extractionController->extract($request);
            
            // If the extraction returned a view, we need to extract the data and redirect back
            if ($response instanceof \Illuminate\View\View) {
                $viewData = $response->getData();
                
                // Flash the data to the session
                return redirect()->route('recruiter.cv-extraction')
                    ->with('cvData', $viewData['cvData'] ?? null)
                    ->with('jobMatching', $viewData['jobMatching'] ?? null)
                    ->with('jobDescription', $viewData['jobDescription'] ?? null)
                    ->with('success', 'CV processed successfully!');
            }
            
            // If we get here, something went wrong
            return redirect()->route('recruiter.cv-extraction')
                ->with('error', 'Failed to process CV. Please try again.');
            
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

