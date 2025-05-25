<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Define the full list of desired statuses
        $statuses = [
            'pending', 'in_review', 'shortlisted', 'interview_scheduled', 
            'interviewing', 'technical_test', 'offer_extended', 'offer_accepted', 
            'hired', 'rejected', 'offer_declined', 'withdrawn', 'on_hold'
        ];
        
        // Convert array to comma-separated string for ENUM definition
        $enumString = "'" . implode("','", $statuses) . "'";

        // Use raw SQL to modify the ENUM column (syntax for MySQL)
        // Note: SQLite does not support modifying columns in this way directly.
        // For other databases, the ALTER TABLE syntax might differ slightly.
        DB::statement("ALTER TABLE job_applications MODIFY COLUMN status ENUM({$enumString}) NOT NULL DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Define the original list of statuses for rollback
        $originalStatuses = ['pending', 'in_review', 'accepted', 'rejected'];
        $originalEnumString = "'" . implode("','", $originalStatuses) . "'";

        // Revert to the original ENUM definition
        DB::statement("ALTER TABLE job_applications MODIFY COLUMN status ENUM({$originalEnumString}) NOT NULL DEFAULT 'pending'");
    }
};
