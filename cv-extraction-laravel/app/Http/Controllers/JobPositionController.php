<?php

namespace App\Http\Controllers;

use App\Models\JobPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobPositionController extends Controller
{
    /**
     * Display a listing of the job positions for the recruiter.
     */
    public function index(Request $request)
    {
        $query = Auth::user()->jobPositions();

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->has('job_type') && !empty($request->job_type)) {
            $query->where('job_type', $request->job_type);
        }

        if ($request->has('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $jobPositions = $query->latest()->paginate(10);

        return view('recruiter.job-positions.index', compact('jobPositions'));
    }

    /**
     * Show the form for creating a new job position.
     */
    public function create()
    {
        return view('recruiter.job-positions.create');
    }

    /**
     * Store a newly created job position in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'company_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'job_type' => 'required|string|max:255',
            'salary_range' => 'nullable|string|max:255',
        ]);

        // Add user_id to the validated data
        $validated['user_id'] = Auth::id();
        
        // Create the job position
        $jobPosition = JobPosition::create($validated);

        return redirect()->route('recruiter.job-positions.show', $jobPosition)
            ->with('success', 'Job position created successfully.');
    }

    /**
     * Display the specified job position.
     */
    public function show(JobPosition $jobPosition)
    {
        // Make sure the recruiter can only view their own job positions
        if ($jobPosition->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Get applications for this job position
        $applications = $jobPosition->applications()->with('jobSeeker')->latest()->get();
        
        return view('recruiter.job-positions.show', compact('jobPosition', 'applications'));
    }

    /**
     * Show the form for editing the specified job position.
     */
    public function edit(JobPosition $jobPosition)
    {
        // Make sure the recruiter can only edit their own job positions
        if ($jobPosition->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('recruiter.job-positions.edit', compact('jobPosition'));
    }

    /**
     * Update the specified job position in storage.
     */
    public function update(Request $request, JobPosition $jobPosition)
    {
        // Make sure the recruiter can only update their own job positions
        if ($jobPosition->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'company_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'job_type' => 'required|string|max:255',
            'salary_range' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        // Update the job position
        $jobPosition->update($validated);

        return redirect()->route('recruiter.job-positions.show', $jobPosition)
            ->with('success', 'Job position updated successfully.');
    }

    /**
     * Remove the specified job position from storage.
     */
    public function destroy(JobPosition $jobPosition)
    {
        // Make sure the recruiter can only delete their own job positions
        if ($jobPosition->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $jobPosition->delete();

        return redirect()->route('recruiter.job-positions.index')
            ->with('success', 'Job position deleted successfully.');
    }
    
    /**
     * Toggle the active status of a job position
     */
    public function toggleActive(JobPosition $jobPosition)
    {
        // Make sure the recruiter can only update their own job positions
        if ($jobPosition->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $jobPosition->update([
            'is_active' => !$jobPosition->is_active
        ]);
        
        $status = $jobPosition->is_active ? 'activated' : 'deactivated';
        
        return redirect()->back()
            ->with('success', "Job position {$status} successfully.");
    }
}
