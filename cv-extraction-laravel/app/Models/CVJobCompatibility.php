<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CVJobCompatibility extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cv_job_compatibility';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'cv_id',
        'job_position_id',
        'compatibility_score',
        'skills_score',
        'experience_score', 
        'education_score',
        'matched_skills',
        'missing_skills',
        'explanation',
        'is_simulated'
    ];

    /**
     * Get the user that owns this compatibility record.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Unknown User',
            'email' => 'unknown@example.com',
        ]);
    }

    /**
     * Get the CV that this compatibility record belongs to.
     */
    public function cv(): BelongsTo
    {
        return $this->belongsTo(CV::class, 'cv_id')->withDefault([
            'file_name' => 'Unknown CV',
            'file_path' => 'unknown',
        ]);
    }

    /**
     * Get the job position that this compatibility record belongs to.
     */
    public function jobPosition(): BelongsTo
    {
        return $this->belongsTo(JobPosition::class)->withDefault([
            'title' => 'Unknown Position',
            'company_name' => 'Unknown Company',
            'description' => 'No description available',
        ]);
    }
}
