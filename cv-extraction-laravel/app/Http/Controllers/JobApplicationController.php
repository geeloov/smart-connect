<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobPosition;
use App\Events\JobApplicationSubmitted;
use App\Events\JobApplicationStatusUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of available job positions for job seekers.
     */
    public function availableJobs(Request $request)
    {
        $query = JobPosition::active()->latest();
        
        // Apply search filters if provided
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        if ($request->has('location') && !empty($request->location)) {
            $location = $request->location;
            $query->where('location', 'like', "%{$location}%");
        }
        
        // Apply job type filter if provided
        if ($request->has('job_type') && !empty($request->job_type)) {
            $query->where('job_type', $request->job_type);
        }
        
        // Paginate the results instead of getting all at once
        $jobPositions = $query->paginate(9);
        $jobPositions->appends($request->query());
        
        return view('job-seeker.jobs.available', compact('jobPositions'));
    }
    
    /**
     * Display a job position details.
     */
    public function jobDetails(JobPosition $jobPosition)
    {
        // Check if the job is active
        if (!$jobPosition->is_active) {
            abort(404, 'Job position not found or no longer active.');
        }
        
        // Load the recruiter relationship
        $jobPosition->load('recruiter');
        
        // Check if the user has already applied
        $hasApplied = false;
        if (Auth::check()) {
            $hasApplied = JobApplication::where('user_id', Auth::id())
                ->where('job_position_id', $jobPosition->id)
                ->exists();
        }
        
        return view('job-seeker.jobs.details', compact('jobPosition', 'hasApplied'));
    }
    
    /**
     * Show the form for creating a new job application.
     */
    public function create(JobPosition $jobPosition)
    {
        // Check if the job is active
        if (!$jobPosition->is_active) {
            abort(404, 'Job position not found or no longer active.');
        }
        
        // Check if the user has already applied
        $hasApplied = JobApplication::where('user_id', Auth::id())
            ->where('job_position_id', $jobPosition->id)
            ->exists();
            
        if ($hasApplied) {
            return redirect()->route('job-seeker.applications.index')
                ->with('info', 'You have already applied for this job position.');
        }
        
        return view('job-seeker.applications.create', compact('jobPosition'));
    }
    
    /**
     * Store a newly created job application in storage.
     */
    public function store(Request $request, JobPosition $jobPosition)
    {
        $request->validate([
            'cv_file' => 'required|mimes:pdf|max:10240', // 10MB max
            'cover_letter' => 'nullable|string|max:5000',
        ]);
        
        try {
            // Check if the user has already applied for this job
            $existingApplication = JobApplication::where('user_id', Auth::id())
                ->where('job_position_id', $jobPosition->id)
                ->first();
                
            if ($existingApplication) {
                return redirect()->back()->with('error', 'You have already applied for this position.');
            }
            
            // Get the CV file
            $file = $request->file('cv_file');
            $fileName = time() . '_' . Auth::id() . '_' . $file->getClientOriginalName();
            
            // Store the CV file
            $filePath = $file->storeAs('cv_files', $fileName, 'public');
            
            // Log file storage information for debugging
            Log::info('CV file stored successfully', [
                'path' => $filePath,
                'user_id' => Auth::id(),
                'job_id' => $jobPosition->id,
                'original_name' => $file->getClientOriginalName()
            ]);
            
            // Create the job application - WITHOUT skill matching or compatibility analysis
            $jobApplication = new JobApplication();
            $jobApplication->user_id = Auth::id();
            $jobApplication->job_position_id = $jobPosition->id;
            $jobApplication->cv_filename = $fileName;
            $jobApplication->cover_letter = $request->cover_letter;
            $jobApplication->status = 'pending';
            $jobApplication->recruiter_viewed_at = null;
            
            // Try to extract CV data for basic information (but skip skills matching)
            try {
                $response = Http::withHeaders([
                    'Accept' => 'application/json',
                ])->attach(
                    'cv_file', 
                    file_get_contents($file->path()), 
                    $file->getClientOriginalName()
                )->post(config('services.cv_extraction.api_url', 'http://localhost:5000/api/extract-cv'));
                
                if ($response->successful()) {
                    $apiData = $response->json();
                    $cvData = $apiData['cv_data'] ?? null;
                    
                    if ($cvData) {
                        $jobApplication->cv_data = is_string($cvData) ? $cvData : json_encode($cvData);
                    }
                }
            } catch (\Exception $e) {
                Log::error('Error calling CV extraction API: ' . $e->getMessage());
                // Continue without CV data
            }
            
            // Save the application
            $jobApplication->save();
            
            // Log success
            Log::info('Job application created successfully', [
                'application_id' => $jobApplication->id,
                'user_id' => Auth::id(),
                'job_id' => $jobPosition->id
            ]);
            
            // Dispatch event for new application submission
            try {
                event(new JobApplicationSubmitted($jobApplication));
            } catch (\Exception $e) {
                Log::error('Error dispatching JobApplicationSubmitted event: ' . $e->getMessage());
            }
            
            return redirect()->route('job-seeker.applications.show', $jobApplication)
                ->with('success', 'Job application submitted successfully!');
                
        } catch (\Exception $e) {
            Log::error('Error in job application submission: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'user_id' => Auth::id(),
                'job_id' => $jobPosition->id ?? null
            ]);
            
            return redirect()->back()
                ->with('error', 'An error occurred while submitting your application: ' . $e->getMessage())
                ->withInput();
        }
    }
    
    /**
     * Display the job seeker's applications.
     */
    public function index()
    {
        $applications = Auth::user()->jobApplications()
            ->with('jobPosition.recruiter')
            ->latest()
            ->get();
            
        return view('job-seeker.applications.index', compact('applications'));
    }
    
    /**
     * Display the specified job application.
     */
    public function show(JobApplication $jobApplication)
    {
        // Make sure the job seeker can only view their own applications
        if ($jobApplication->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Remove any compatibility analysis data to hide skills matching
        $jobApplication->compatibility_analysis = null;
        
        return view('job-seeker.applications.show', compact('jobApplication'));
    }
    
    /**
     * Update the status of a job application.
     */
    public function updateStatus(Request $request, JobApplication $jobApplication)
    {
        // Replace the authorize call with direct authorization check
        if ($jobApplication->jobPosition->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action. You can only update status for jobs you posted.');
        }
        
        $validated = $request->validate([
            'status' => 'required|in:pending,in_review,accepted,rejected',
            'recruiter_notes' => 'nullable|string|max:1000',
        ]);
        
        try {
            // Only update recruiter_notes if provided
            $updateData = ['status' => $validated['status']];
            
            if ($request->has('recruiter_notes')) {
                $updateData['recruiter_notes'] = $validated['recruiter_notes'];
            }
            
            // Reset seeker_viewed_at when status changes
            if ($jobApplication->status !== $validated['status']) {
                $updateData['seeker_viewed_at'] = null;
            }
            
            $jobApplication->update($updateData);
            
            return redirect()->back()->with('success', 'Application status updated successfully');
        } catch (\Exception $e) {
            Log::error('Error updating application status: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'An error occurred while updating the application status. Please try again.')
                ->withInput();
        }
    }
    
    /**
     * Display the job applications for the recruiter's job positions.
     */
    public function recruiterApplications(Request $request)
    {
        $jobPositions = Auth::user()->jobPositions()->with('applications.jobSeeker')->get();
        $applications = collect();
        
        foreach ($jobPositions as $position) {
            $applications = $applications->merge($position->applications);
        }
        
        // Apply filters if provided
        if ($request->has('job_position') && !empty($request->job_position)) {
            $applications = $applications->filter(function($app) use ($request) {
                return $app->job_position_id == $request->job_position;
            });
        }
        
        if ($request->has('status') && !empty($request->status)) {
            $applications = $applications->filter(function($app) use ($request) {
                return $app->status == $request->status;
            });
        }
        
        // Apply sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'oldest':
                    $applications = $applications->sortBy('created_at');
                    break;
                case 'highest_score':
                    $applications = $applications->sortByDesc('compatibility_score');
                    break;
                default:
                    $applications = $applications->sortByDesc('created_at');
                    break;
            }
        } else {
            $applications = $applications->sortByDesc('created_at');
        }
        
        // Convert the collection to a paginator
        $perPage = 10;
        $page = request()->get('page', 1);
        $offset = ($page - 1) * $perPage;
        
        $items = $applications->slice($offset, $perPage)->values();
        
        $applications = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $applications->count(),
            $perPage,
            $page,
            ['path' => request()->url()]
        );
        
        return view('recruiter.applications.index', compact('applications', 'jobPositions'));
    }
    
    /**
     * Display the specified job application for the recruiter.
     */
    public function recruiterShowApplication(JobApplication $jobApplication)
    {
        // Make sure the recruiter can only view applications for their job positions
        $jobPosition = $jobApplication->jobPosition;
        
        if ($jobPosition->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Remove any compatibility analysis data to hide skills matching
        $jobApplication->compatibility_analysis = null;
        
        return view('recruiter.applications.show', compact('jobApplication'));
    }
    
    /**
     * Add recruiter notes to a job application.
     */
    public function addNotes(Request $request, JobApplication $jobApplication)
    {
        //
    }
}
