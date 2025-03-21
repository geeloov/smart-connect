<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobPosting extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'required_skills',
        'experience_level',
        'location',
        'employment_type',
        'salary_min',
        'salary_max',
        'is_remote',
        'status',
        'expires_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'required_skills' => 'array',
        'is_remote' => 'boolean',
        'expires_at' => 'datetime',
        'salary_min' => 'integer',
        'salary_max' => 'integer',
    ];

    /**
     * Get the recruiter who posted the job.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the candidates that match this job posting.
     */
    public function candidateMatches(): BelongsToMany
    {
        return $this->belongsToMany(Candidate::class, 'job_matches')
            ->withPivot('match_score', 'status')
            ->withTimestamps();
    }

    /**
     * Scope a query to only include active job postings.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            });
    }
} 