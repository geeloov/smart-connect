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
        Schema::create('job_matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_posting_id')->constrained()->onDelete('cascade');
            $table->float('match_score', 5, 2); // Score from 0 to 100
            $table->string('status')->default('pending'); // 'pending', 'viewed', 'applied', 'rejected', 'shortlisted'
            $table->json('match_details')->nullable();
            $table->boolean('viewed_by_candidate')->default(false);
            $table->boolean('viewed_by_recruiter')->default(false);
            $table->timestamps();
            
            // Prevent duplicate matches
            $table->unique(['candidate_id', 'job_posting_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_matches');
    }
}; 