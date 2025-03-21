<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApplication extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'job_position_id',
        'cv_filename',
        'cv_data',
        'compatibility_score',
        'compatibility_analysis',
        'cover_letter',
        'status',
        'recruiter_notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'cv_data' => 'array',
        'compatibility_score' => 'float',
    ];

    /**
     * Get the job seeker (user) who submitted this application.
     */
    public function jobSeeker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the job position for this application.
     */
    public function jobPosition(): BelongsTo
    {
        return $this->belongsTo(JobPosition::class);
    }

    /**
     * Get the recruiter through the job position.
     */
    public function recruiter()
    {
        return $this->jobPosition->recruiter;
    }
    
    /**
     * Scope a query to only include applications with a specific status.
     */
    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
