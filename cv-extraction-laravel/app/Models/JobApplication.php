<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
        'cover_letter',
        'status',
        'recruiter_notes',
        'recruiter_viewed_at',
        'seeker_viewed_at',
        'cv_data',
        'compatibility_analysis',
        'compatibility_score',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'recruiter_viewed_at' => 'datetime',
        'seeker_viewed_at' => 'datetime',
        'compatibility_score' => 'integer',
        // Remove any json/array cast for cv_data to avoid automatic conversion
        // 'cv_data' => 'json',  // This would cause problems!
        // 'compatibility_analysis' => 'json',  // This would also cause problems!
    ];

    /**
     * Get the CV data.
     *
     * @return string|null
     */
    public function getCvDataAttribute($value)
    {
        if (empty($value)) {
            Log::info('CV data is empty in accessor', [
                'application_id' => $this->id ?? 'not_saved'
            ]);
            return null;
        }

        try {
            // Log the type of value being accessed
            Log::info('Accessing cv_data in accessor', [
                'value_type' => gettype($value),
                'is_string' => is_string($value),
                'is_json_string' => is_string($value) && $this->isJson($value),
                'value_length' => is_string($value) ? strlen($value) : 'not a string'
            ]);
            
            // IMPORTANT: Always return the value directly as a string
            // Don't decode to array - this prevents the "Indirect modification" error
            return $value;
            
        } catch (\Exception $e) {
            Log::error('Error accessing CV data: ' . $e->getMessage(), [
                'application_id' => $this->id ?? 'not_saved'
            ]);
            
            // Return a safe value as a JSON string
            return json_encode(['error' => 'Error accessing CV data: ' . $e->getMessage()]);
        }
    }

    /**
     * Set the CV data.
     *
     * @param mixed $value
     * @return void
     */
    public function setCvDataAttribute($value)
    {
        try {
            // If it's null, set as null
            if (is_null($value)) {
                $this->attributes['cv_data'] = null;
                Log::info('Setting cv_data to null');
                return;
            }
            
            // Log what we're trying to store
            Log::info('Setting cv_data in mutator', [
                'value_type' => gettype($value),
                'value_is_json_string' => is_string($value) && $this->isJson($value),
                'value_length' => is_string($value) ? strlen($value) : 'not a string'
            ]);
            
            // IMPORTANT: Always ensure we're working with a copy of data, not a reference
            // to avoid the "Indirect modification of overloaded property" error
            $dataToStore = null;
            
            if (is_array($value)) {
                // Create a copy of the array rather than using it directly
                $dataCopy = [];
                foreach ($value as $k => $v) {
                    $dataCopy[$k] = $v;
                }
                
                // Encode the copy to JSON string
                $encoded = json_encode($dataCopy, JSON_UNESCAPED_UNICODE);
                if ($encoded === false) {
                    Log::error('JSON encoding failed: ' . json_last_error_msg());
                    $dataToStore = json_encode(['error' => 'Failed to encode array: ' . json_last_error_msg()]);
                } else {
                    $dataToStore = $encoded;
                }
                
                Log::info('Stored array as JSON string', [
                    'json_string_length' => strlen($dataToStore)
                ]);
            } else if (is_string($value)) {
                // For strings, check if already JSON
                if ($this->isJson($value)) {
                    // Already a valid JSON string
                    $dataToStore = $value;
                } else {
                    // Convert non-JSON string to JSON object
                    $dataToStore = json_encode(['value' => $value]);
                }
            } else if (is_object($value)) {
                // For objects, convert to array first
                try {
                    $asArray = json_decode(json_encode($value), true); // Safe way to convert objects
                    $encoded = json_encode($asArray);
                    if ($encoded === false) {
                        Log::error('Failed to encode object to JSON: ' . json_last_error_msg());
                        $dataToStore = json_encode(['error' => 'Failed to encode object']);
                    } else {
                        $dataToStore = $encoded;
                    }
                } catch (\Exception $e) {
                    Log::error('Exception converting object to JSON: ' . $e->getMessage());
                    $dataToStore = json_encode(['error' => 'Exception converting object: ' . $e->getMessage()]);
                }
            } else {
                // For any other type, just wrap in a JSON object
                $dataToStore = json_encode(['value' => $value]);
            }
            
            // Apply the data to attributes directly
            if ($dataToStore !== null) {
                // Final verification - ENSURE we have a string
                if (!is_string($dataToStore)) {
                    Log::error('CRITICAL: dataToStore is not a string after processing', [
                        'type' => gettype($dataToStore)
                    ]);
                    $dataToStore = '{"error":"Failed to convert CV data to string"}';
                }
                
                // Store the processed string directly in attributes
                $this->attributes['cv_data'] = $dataToStore;
                
                Log::info('Successfully stored cv_data as string', [
                    'length' => strlen($this->attributes['cv_data']),
                    'is_json' => $this->isJson($this->attributes['cv_data'])
                ]);
            } else {
                // Something went wrong if we got here
                Log::error('Failed to process cv_data, resulting in null');
                $this->attributes['cv_data'] = '{"error":"Data processing failed completely"}';
            }
            
        } catch (\Exception $e) {
            Log::error('Error setting CV data: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            $this->attributes['cv_data'] = json_encode(['error' => 'Error setting CV data: ' . $e->getMessage()]);
        }
    }
    
    /**
     * Helper function to check if a string is valid JSON
     */
    private function isJson($string) {
        if (!is_string($string)) return false;
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
    
    /**
     * Get the compatibility analysis data.
     *
     * @return string|null
     */
    public function getCompatibilityAnalysisAttribute($value)
    {
        if (empty($value)) {
            return null;
        }
        
        try {
            // Log the type of value being accessed
            Log::info('Accessing compatibility_analysis in accessor', [
                'value_type' => gettype($value),
                'is_string' => is_string($value),
                'is_json_string' => is_string($value) && $this->isJson($value),
                'value_length' => is_string($value) ? strlen($value) : 'not a string'
            ]);
            
            // Always return the value directly as a string
            return $value;
            
        } catch (\Exception $e) {
            Log::error('Error accessing compatibility analysis: ' . $e->getMessage());
            return json_encode(['error' => 'Error accessing compatibility analysis']);
        }
    }
    
    /**
     * Set the compatibility analysis data.
     *
     * @param mixed $value
     * @return void
     */
    public function setCompatibilityAnalysisAttribute($value)
    {
        try {
            if (is_null($value)) {
                $this->attributes['compatibility_analysis'] = null;
                return;
            }
            
            Log::info('Setting compatibility_analysis in mutator', [
                'value_type' => gettype($value),
                'is_json_string' => is_string($value) && $this->isJson($value)
            ]);
            
            // Process data safely to avoid indirect modification errors
            $dataToStore = null;
            
            if (is_array($value)) {
                // Create a copy of the array
                $dataCopy = [];
                foreach ($value as $k => $v) {
                    $dataCopy[$k] = $v;
                }
                
                // Encode the copy to JSON string
                $dataToStore = json_encode($dataCopy, JSON_UNESCAPED_UNICODE);
            } else if (is_string($value)) {
                // For strings, check if already JSON
                if ($this->isJson($value)) {
                    // Already a valid JSON string
                    $dataToStore = $value;
                } else {
                    // Convert non-JSON string to JSON object
                    $dataToStore = json_encode(['value' => $value]);
                }
            } else if (is_object($value)) {
                // For objects, convert to array first using a safe method
                $asArray = json_decode(json_encode($value), true);
                $dataToStore = json_encode($asArray);
            } else {
                // For any other type
                $dataToStore = json_encode(['value' => $value]);
            }
            
            // Set the final value
            if ($dataToStore !== null) {
                $this->attributes['compatibility_analysis'] = $dataToStore;
            } else {
                $this->attributes['compatibility_analysis'] = json_encode(['error' => 'Failed to process compatibility data']);
            }
            
        } catch (\Exception $e) {
            Log::error('Error setting compatibility analysis: ' . $e->getMessage());
            $this->attributes['compatibility_analysis'] = json_encode(['error' => 'Error setting compatibility analysis: ' . $e->getMessage()]);
        }
    }
    
    /**
     * Get the user (job seeker) that owns the job application.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Alias for the user relationship to make the code more readable.
     */
    public function jobSeeker()
    {
        return $this->user();
    }
    
    /**
     * Get the job position that the application is for.
     */
    public function jobPosition()
    {
        return $this->belongsTo(JobPosition::class);
    }
    
    /**
     * Get the URL of the CV file.
     *
     * @return string|null
     */
    public function getCvUrl()
    {
        if (!$this->cv_filename) {
            return null;
        }
        
        return Storage::url('cv_files/' . $this->cv_filename);
    }
    
    /**
     * Check if the job application has been viewed by the recruiter.
     *
     * @return bool
     */
    public function hasBeenViewedByRecruiter()
    {
        return $this->recruiter_viewed_at !== null;
    }
    
    /**
     * Mark the job application as viewed by the recruiter.
     *
     * @return void
     */
    public function markAsViewedByRecruiter()
    {
        if (!$this->hasBeenViewedByRecruiter()) {
            $this->update(['recruiter_viewed_at' => now()]);
        }
    }
    
    /**
     * Check if the job application has been viewed by the job seeker.
     *
     * @return bool
     */
    public function hasBeenViewedBySeeker()
    {
        return $this->seeker_viewed_at !== null;
    }
    
    /**
     * Mark the job application as viewed by the job seeker.
     *
     * @return void
     */
    public function markAsViewedBySeeker()
    {
        if (!$this->hasBeenViewedBySeeker()) {
            $this->update(['seeker_viewed_at' => now()]);
        }
    }
    
    /**
     * Get formatted status for display
     */
    public function getFormattedStatus()
    {
        $statuses = [
            'pending' => 'Pending Review',
            'in_review' => 'In Review',
            'accepted' => 'Accepted',
            'rejected' => 'Rejected'
        ];
        
        return $statuses[$this->status] ?? ucfirst($this->status);
    }
    
    /**
     * Get status badge color class
     */
    public function getStatusBadgeClass()
    {
        $classes = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'in_review' => 'bg-blue-100 text-blue-800',
            'accepted' => 'bg-green-100 text-green-800',
            'rejected' => 'bg-red-100 text-red-800'
        ];
        
        return $classes[$this->status] ?? 'bg-gray-100 text-gray-800';
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
