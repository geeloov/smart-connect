<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('job_applications', function (Blueprint $table) {
            if (!Schema::hasColumn('job_applications', 'cv_data')) {
                $table->json('cv_data')->nullable()->after('cover_letter');
            }
            
            if (!Schema::hasColumn('job_applications', 'compatibility_score')) {
                $table->float('compatibility_score')->nullable()->after('cv_data');
            }
            
            if (!Schema::hasColumn('job_applications', 'compatibility_analysis')) {
                $table->json('compatibility_analysis')->nullable()->after('compatibility_score');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->dropColumn(['cv_data', 'compatibility_score', 'compatibility_analysis']);
        });
    }
};