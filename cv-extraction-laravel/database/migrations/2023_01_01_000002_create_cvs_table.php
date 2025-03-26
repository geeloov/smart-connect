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
        Schema::create('cvs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('is_default')->default(false);
            $table->string('file_path');
            $table->string('file_name');
            $table->integer('file_size');
            $table->string('mime_type');
            $table->json('extracted_data')->nullable(); // Raw extracted data
            $table->json('extracted_skills')->nullable(); // Array of skills
            $table->json('extracted_education')->nullable(); // Array of education details
            $table->json('extracted_experience')->nullable(); // Array of work experience
            $table->json('extracted_languages')->nullable(); // Array of languages
            $table->json('extracted_certifications')->nullable(); // Array of certifications
            $table->string('extracted_phone')->nullable(); // Contact phone
            $table->string('extracted_email')->nullable(); // Contact email
            $table->string('extracted_location')->nullable(); // Location/address
            $table->timestamp('processed_at')->nullable(); // When the CV was processed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cvs');
    }
}; 