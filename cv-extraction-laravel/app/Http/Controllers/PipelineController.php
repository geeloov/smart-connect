<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobApplication;
use App\Models\JobPosition;

class PipelineController extends Controller
{
    public function index(Request $request)
    {
        $recruiter = Auth::user();
        $selectedJobPositionId = $request->query('job_position_id');

        // Base query for job applications
        $applicationsQuery = JobApplication::whereHas('jobPosition', function ($query) use ($recruiter) {
            $query->where('user_id', $recruiter->id);
        })->with(['user', 'jobPosition']); // Eager load relationships

        // Filter by selected job position if one is chosen
        if ($selectedJobPositionId) {
            $applicationsQuery->where('job_position_id', $selectedJobPositionId);
        }

        $applications = $applicationsQuery->latest()->get();

        // Group applications by their status for the Kanban board
        $applicationsByStage = $applications->groupBy('status')->all();

        // Define the stages based on your enum or future PipelineStages model
        // Ensure all potential stages are present in the keys, even if empty, for consistent column rendering
        $definedStages = [
            'pending' => 'Pending Review',
            'in_review' => 'In Review',
            // Add other statuses from your JobApplication model if they differ or you add more
            // For now, let's assume these plus what's in the Blade view covers it.
            // We will eventually replace this with a dynamic PipelineStages model.
            'interviewing' => 'Interviewing', 
            'offer_extended' => 'Offer Extended', 
            'accepted' => 'Hired',
            'rejected' => 'Rejected',
        ];

        // Ensure all defined stages exist as keys in $applicationsByStage, with empty collections if no apps
        foreach (array_keys($definedStages) as $stageKey) {
            if (!isset($applicationsByStage[$stageKey])) {
                $applicationsByStage[$stageKey] = collect([]);
            }
        }

        // Fetch job positions for the filter dropdown
        $jobPositions = JobPosition::where('user_id', $recruiter->id)
            ->where('is_active', true)
            ->orderBy('title')
            ->get();

        return view('recruiter.pipeline', compact(
            'applicationsByStage',
            'jobPositions',
            'selectedJobPositionId' // Pass this to set the dropdown's selected value
        ), ['fullWidthLayout' => true]);
    }
} 