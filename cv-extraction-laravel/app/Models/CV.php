<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CV extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cvs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'is_default',
        'file_path',
        'file_name',
        'file_size',
        'mime_type',
        'extracted_data',
        'extracted_skills',
        'extracted_education',
        'extracted_experience',
        'extracted_languages',
        'extracted_certifications',
        'extracted_phone',
        'extracted_email',
        'extracted_location',
        'processed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_default' => 'boolean',
        'extracted_data' => 'array',
        'extracted_skills' => 'array',
        'extracted_education' => 'array',
        'extracted_experience' => 'array',
        'extracted_languages' => 'array',
        'extracted_certifications' => 'array',
        'processed_at' => 'datetime',
    ];

    /**
     * Get the user that owns the CV.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include default CVs.
     */
    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }

    /**
     * Set this CV as the default for the user.
     * This will unset any other default CVs for this user.
     */
    public function setAsDefault()
    {
        // First, unset any existing default CVs for this user
        self::where('user_id', $this->user_id)
            ->where('is_default', true)
            ->update(['is_default' => false]);
        
        // Then set this one as default
        $this->is_default = true;
        $this->save();
        
        return $this;
    }
} 