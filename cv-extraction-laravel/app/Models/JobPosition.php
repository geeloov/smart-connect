<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobPosition extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'requirements',
        'company_name',
        'location',
        'job_type',
        'salary_range',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the recruiter (user) who posted this job position.
     */
    public function recruiter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the applications for this job position.
     */
    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }
    
    /**
     * Scope a query to only include active job positions.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
