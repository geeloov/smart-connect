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
        Schema::create('cv_job_compatibility', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('cv_id')->constrained('cvs')->onDelete('cascade');
            $table->foreignId('job_position_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('compatibility_score');
            $table->text('explanation')->nullable();
            $table->unsignedInteger('skills_score')->nullable();
            $table->unsignedInteger('experience_score')->nullable();
            $table->unsignedInteger('education_score')->nullable();
            $table->text('matched_skills')->nullable();
            $table->text('missing_skills')->nullable();
            $table->timestamps();
            $table->unique(['user_id', 'cv_id', 'job_position_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cv_job_compatibility');
    }
};
