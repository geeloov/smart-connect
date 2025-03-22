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

    /**
     * Show the job application form for a specific job.
     */
    public function createJobApplication($jobId)
    {
        $jobPosition = JobPosition::findOrFail($jobId);
        
        // Check for flashed CV data from session (if user has already uploaded CV)
        $cvData = session('cvData');
        $jobMatching = session('jobMatching');
        
        return view('job-seeker.create-application', compact('jobPosition', 'cvData', 'jobMatching'));
    }

    /**
     * Store a new job application.
     */
    public function storeJobApplication(Request $request, $jobId)
    {
        // Validate the request
        $request->validate([
            'cv_file' => 'required_without:use_existing_cv|mimes:pdf|max:10240', // Required if not using existing CV
            'cover_letter' => 'nullable|string|max:5000',
            'use_existing_cv' => 'nullable|boolean',
        ]);
        
        try {
            $jobPosition = JobPosition::findOrFail($jobId);
            $user = Auth::user();
            
            // Check if the user has already applied for this job
            $existingApplication = JobApplication::where('user_id', $user->id)
                ->where('job_position_id', $jobId)
                ->first();
                
            if ($existingApplication) {
                return redirect()->back()->with('error', 'You have already applied for this position.');
            }
            
            // Process CV file
            $cvFilename = null;
            $cvData = null;
            $compatibilityScore = null;
            $compatibilityAnalysis = null;
            
            // Get extraction controller
            $extractionController = app()->make('App\Http\Controllers\CvExtractionController');
            
            if ($request->hasFile('cv_file')) {
                // Handle new CV upload
                $file = $request->file('cv_file');
                $cvFilename = time() . '_' . $user->id . '_' . $file->getClientOriginalName();
                
                // Store the file
                $file->storeAs('cvs', $cvFilename, 'public');
                
                // Extract CV data
                $extractionResult = $extractionController->extract($request);
                $cvData = $extractionResult['cv_data'] ?? null;
                
                // Match with job description if available
                if ($jobPosition->description) {
                    try {
                        $matchingResults = $extractionController->matchWithJob($file, $jobPosition->description);
                        $compatibilityScore = $matchingResults['score'] ?? null;
                        $compatibilityAnalysis = $matchingResults;
                    } catch (\Exception $e) {
                        Log::warning('Job matching failed but continuing with application', [
                            'error' => $e->getMessage()
                        ]);
                    }
                }
            } elseif ($request->has('use_existing_cv') && session()->has('cvData')) {
                // Use CV data from session (previously uploaded)
                $cvData = session('cvData');
                $compatibilityScore = session('jobMatching.score') ?? null;
                $compatibilityAnalysis = session('jobMatching') ?? null;
                
                // Should have a way to reference the previously uploaded file
                // For now, we'll assume there's another storage mechanism for this
                $cvFilename = 'existing_cv_' . time() . '_' . $user->id . '.pdf';
            }
            
            // Create job application
            $application = new JobApplication();
            $application->user_id = $user->id;
            $application->job_position_id = $jobId;
            $application->cv_filename = $cvFilename;
            $application->cover_letter = $request->cover_letter;
            $application->cv_data = $cvData ? json_encode($cvData) : null;
            $application->compatibility_score = $compatibilityScore;
            $application->compatibility_analysis = $compatibilityAnalysis ? json_encode($compatibilityAnalysis) : null;
            $application->status = 'pending';
            $application->save();
            
            return redirect()->route('job-seeker.applications')
                ->with('success', 'Your application has been submitted successfully!');
                
        } catch (\Exception $e) {
            Log::error('Error submitting job application: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Display all job applications for the authenticated user.
     */
    public function applications()
    {
        $applications = Auth::user()->jobApplications()
            ->with('jobPosition')
            ->latest()
            ->paginate(10);
            
        return view('job-seeker.applications', compact('applications'));
    }
}
