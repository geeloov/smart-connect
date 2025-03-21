<?php

namespace App\Policies;

use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobApplicationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the job application.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\JobApplication  $jobApplication
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, JobApplication $jobApplication)
    {
        // Allow access if:
        // 1. The user is the job seeker who submitted the application
        // 2. The user is the recruiter who owns the job position
        
        if ($user->id === $jobApplication->user_id) {
            return true;
        }
        
        $jobPosition = $jobApplication->jobPosition;
        return $jobPosition && $jobPosition->user_id === $user->id;
    }

    /**
     * Determine whether the user can update the job application.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\JobApplication  $jobApplication
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, JobApplication $jobApplication)
    {
        // For recruiters: can update if they own the job position
        if ($user->role === 'recruiter') {
            $jobPosition = $jobApplication->jobPosition;
            return $jobPosition && $jobPosition->user_id === $user->id;
        }
        
        // For job seekers: can update if they own the application
        if ($user->role === 'job_seeker') {
            return $user->id === $jobApplication->user_id;
        }
        
        return false;
    }
} 