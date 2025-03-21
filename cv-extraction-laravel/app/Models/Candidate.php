<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Candidate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'phone',
        'location',
        'skills',
        'experience_years',
        'education',
        'career_interests',
        'languages',
        'bio',
        'last_cv_upload',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'skills' => 'array',
        'education' => 'array',
        'languages' => 'array',
        'last_cv_upload' => 'datetime',
    ];

    /**
     * Get the user that owns the candidate profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the CVs for the candidate.
     */
    public function cvs(): HasMany
    {
        return $this->hasMany(CV::class);
    }

    /**
     * Get the latest CV for the candidate.
     */
    public function latestCV()
    {
        return $this->cvs()->latest()->first();
    }

    /**
     * Get the job matches for the candidate.
     */
    public function jobMatches(): BelongsToMany
    {
        return $this->belongsToMany(JobPosting::class, 'job_matches')
            ->withPivot('match_score', 'status')
            ->withTimestamps();
    }
} 