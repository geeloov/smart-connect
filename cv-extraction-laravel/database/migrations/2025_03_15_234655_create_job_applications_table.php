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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Job seeker who applied
            $table->foreignId('job_position_id')->constrained()->onDelete('cascade');
            $table->string('cv_filename'); // Store the filename of the uploaded CV
            $table->json('cv_data')->nullable(); // Store extracted CV data
            $table->decimal('compatibility_score', 5, 2)->nullable(); // Store the compatibility score
            $table->text('compatibility_analysis')->nullable(); // Store compatibility analysis details
            $table->text('cover_letter')->nullable(); // Optional cover letter
            $table->enum('status', ['pending', 'in_review', 'accepted', 'rejected'])->default('pending');
            $table->text('recruiter_notes')->nullable(); // Private notes for the recruiter
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
