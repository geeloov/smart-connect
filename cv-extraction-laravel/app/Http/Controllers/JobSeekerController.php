<?php

namespace App\Http\Controllers;

use App\Models\JobPosition;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class JobSeekerController extends Controller
{
    /**
     * Display the job seeker dashboard.
     */
    public function dashboard()
    {
        // Get recent job applications
        $recentApplications = Auth::user()->jobApplications()
            ->with('jobPosition')
            ->latest()
            ->take(5)
            ->get();
            
        // Get recent job listings
        $recentJobs = JobPosition::where('is_active', true)
            ->latest()
            ->take(5)
            ->get();
            
        // Get counts for dashboard stats
        $totalApplications = Auth::user()->jobApplications()->count();
        $pendingApplications = Auth::user()->jobApplications()->where('status', 'pending')->count();
        $shortlistedApplications = Auth::user()->jobApplications()->whereIn('status', ['shortlisted', 'hired'])->count();
        
        return view('job-seeker.dashboard', compact(
            'recentApplications',
            'recentJobs',
            'totalApplications',
            'pendingApplications',
            'shortlistedApplications'
        ));
    }

    /**
     * Display the job seeker profile.
     */
    public function profile()
    {
        $user = Auth::user();
        return view('job-seeker.profile', compact('user'));
    }

    /**
     * Update the job seeker profile.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
        ]);
        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        
        // Update or create candidate record
        $candidate = $user->candidate;
        if (!$candidate) {
            $candidate = new \App\Models\Candidate();
            $candidate->user_id = $user->id;
        }
        
        $candidate->phone = $request->phone;
        $candidate->location = $request->location;
        $candidate->bio = $request->bio;
        $candidate->save();
        
        return redirect()->route('job-seeker.profile')
            ->with('success', 'Profile updated successfully!');
    }

    /**
     * Display the CV upload form.
     */
    public function cvUpload(Request $request)
    {
        // Check for flashed CV data from session (after extraction)
        $cvData = $request->session()->get('cvData');
        $jobMatching = $request->session()->get('jobMatching');
        $jobDescription = $request->session()->get('jobDescription');
        
        return view('job-seeker.cv-upload', compact('cvData', 'jobMatching', 'jobDescription'));
    }

    /**
     * Process the CV upload.
     */
    public function cvUploadStore(Request $request)
    {
        // Validate the request
        $request->validate([
            'cv_file' => 'required|mimes:pdf|max:10240', // 10MB max
            'job_description' => 'nullable|string|max:50000', // Add validation for job description
        ]);
        
        try {
            // Log the original file details
            $file = $request->file('cv_file');
            Log::info('CV file uploaded by job seeker', [
                'filename' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'mime_type' => $file->getMimeType()
            ]);
            
            // Get extraction controller
            $extractionController = app()->make('App\Http\Controllers\CvExtractionController');
            
            // Get the extraction results - the file is only temporarily used
            $extractionResult = $extractionController->extract($request);
            
            // Process job matching if job description is provided
            $jobDescription = $request->job_description ?? '';
            $matchingResults = null;
            
            if (!empty($jobDescription) && isset($extractionResult['cv_data'])) {
                try {
                    // Match CV with job description
                    $matchingResults = $extractionController->matchWithJob($file, $jobDescription);
                } catch (\Exception $e) {
                    Log::warning('Job matching failed but continuing with CV data', [
                        'error' => $e->getMessage()
                    ]);
                }
            }
            
            // Flash the data to the session
            return redirect()->route('job-seeker.cv-upload')
                ->with('cvData', $extractionResult['cv_data'] ?? null)
                ->with('jobMatching', $matchingResults)
                ->with('jobDescription', $jobDescription)
                ->with('success', 'CV processed successfully!');
            
        } catch (\Exception $e) {
            Log::error('Error processing CV upload: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('job-seeker.cv-upload')
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Display job matches for the job seeker.
     */
    public function jobMatches()
    {
        // In a real application, we would:
        // 1. Fetch job matches for the authenticated user
        // 2. Pass the matches to the view

        return view('job-seeker.job-matches');
    }
}
