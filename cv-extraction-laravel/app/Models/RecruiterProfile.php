<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecruiterProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'company_name',
        'phone',
        'location',
        'bio',
        'website',
        'industry',
    ];

    /**
     * Get the user that owns the recruiter profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
