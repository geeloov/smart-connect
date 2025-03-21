<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobMatch extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'candidate_id',
        'job_posting_id',
        'match_score',
        'status',
        'match_details',
        'viewed_by_candidate',
        'viewed_by_recruiter',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'match_score' => 'float',
        'match_details' => 'array',
        'viewed_by_candidate' => 'boolean',
        'viewed_by_recruiter' => 'boolean',
    ];

    /**
     * Get the candidate for this match.
     */
    public function candidate(): BelongsTo
    {
        return $this->belongsTo(Candidate::class);
    }

    /**
     * Get the job posting for this match.
     */
    public function jobPosting(): BelongsTo
    {
        return $this->belongsTo(JobPosting::class);
    }

    /**
     * Scope a query to only include strong matches.
     */
    public function scopeStrongMatches($query)
    {
        return $query->where('match_score', '>=', 80);
    }

    /**
     * Scope a query to only include good matches.
     */
    public function scopeGoodMatches($query)
    {
        return $query->whereBetween('match_score', [60, 79.99]);
    }

    /**
     * Scope a query to only include fair matches.
     */
    public function scopeFairMatches($query)
    {
        return $query->whereBetween('match_score', [40, 59.99]);
    }

    /**
     * Get the match status display text.
     */
    public function getMatchStatusText()
    {
        if ($this->match_score >= 80) {
            return 'Strong Match';
        } elseif ($this->match_score >= 60) {
            return 'Good Match';
        } elseif ($this->match_score >= 40) {
            return 'Fair Match';
        } else {
            return 'Poor Match';
        }
    }
} 