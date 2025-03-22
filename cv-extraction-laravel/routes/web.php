<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CVExtractionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobSeekerController;
use App\Http\Controllers\RecruiterController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobPositionController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// CV Extraction Routes (accessible to both recruiters and job seekers)
Route::get('/cv-extraction', [App\Http\Controllers\CVExtractionController::class, 'index'])->name('cv-extraction.index');
Route::post('/cv-extraction/process', [App\Http\Controllers\CVExtractionController::class, 'process'])->name('cv-extraction.process');

// Protected routes with authentication
Route::middleware(['auth'])->group(function () {
    // Job Seeker routes
    Route::middleware('auth', \App\Http\Middleware\CheckRole::class.':job_seeker')->prefix('job-seeker')->name('job-seeker.')->group(function () {
        Route::get('/dashboard', [JobSeekerController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [JobSeekerController::class, 'profile'])->name('profile');
        Route::put('/profile/update', [JobSeekerController::class, 'updateProfile'])->name('profile.update');
        Route::get('/cv-upload', [JobSeekerController::class, 'cvUpload'])->name('cv-upload');
        Route::post('/cv-upload', [JobSeekerController::class, 'cvUploadStore'])->name('cv-upload.store');
        Route::get('/job-matches', [JobSeekerController::class, 'jobMatches'])->name('job-matches');
        
        // Job listings and applications
        Route::get('/jobs', [JobApplicationController::class, 'availableJobs'])->name('jobs.available');
        Route::get('/jobs/{jobPosition}', [JobApplicationController::class, 'jobDetails'])->name('jobs.details');
        
        // Job applications
        Route::get('/applications', [JobApplicationController::class, 'index'])->name('applications.index');
        Route::get('/applications/{jobApplication}', [JobApplicationController::class, 'show'])->name('applications.show');
        Route::get('/applications/{jobPosition}/create', [JobApplicationController::class, 'create'])->name('applications.create');
        Route::post('/jobs/{jobPosition}/apply', [JobApplicationController::class, 'store'])->name('applications.store');
        Route::post('/applications/{jobApplication}/update-status', [JobApplicationController::class, 'updateStatus'])->name('applications.update-status');
        Route::post('/applications/{jobApplication}/add-notes', [JobApplicationController::class, 'addNotes'])->name('applications.add-notes');
    });
    
    // Recruiter routes
    Route::middleware('auth', \App\Http\Middleware\CheckRole::class.':recruiter')->prefix('recruiter')->name('recruiter.')->group(function () {
        Route::get('/dashboard', [RecruiterController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [RecruiterController::class, 'profile'])->name('profile');
        Route::put('/profile/update', [RecruiterController::class, 'updateProfile'])->name('profile.update');
        Route::get('/cv-extraction', [RecruiterController::class, 'cvExtraction'])->name('cv-extraction');
        Route::post('/cv-extraction/process', [RecruiterController::class, 'cvExtractionProcess'])->name('cv-extraction.process');
        Route::post('/cv-extraction/save-candidate', [RecruiterController::class, 'saveCandidate'])->name('save-candidate');
        Route::get('/candidates', [RecruiterController::class, 'candidates'])->name('candidates');
        Route::get('/job-matching', [RecruiterController::class, 'jobMatching'])->name('job-matching');
        
        // Job positions management
        Route::get('/job-positions', [JobPositionController::class, 'index'])->name('job-positions.index');
        Route::get('/job-positions/create', [JobPositionController::class, 'create'])->name('job-positions.create');
        Route::post('/job-positions', [JobPositionController::class, 'store'])->name('job-positions.store');
        Route::get('/job-positions/{jobPosition}', [JobPositionController::class, 'show'])->name('job-positions.show');
        Route::get('/job-positions/{jobPosition}/edit', [JobPositionController::class, 'edit'])->name('job-positions.edit');
        Route::put('/job-positions/{jobPosition}', [JobPositionController::class, 'update'])->name('job-positions.update');
        Route::delete('/job-positions/{jobPosition}', [JobPositionController::class, 'destroy'])->name('job-positions.destroy');
        Route::patch('/job-positions/{jobPosition}/toggle-active', [JobPositionController::class, 'toggleActive'])->name('job-positions.toggle-active');
        
        // Job applications management
        Route::get('/applications', [JobApplicationController::class, 'recruiterApplications'])->name('applications.index');
        Route::get('/applications/{jobApplication}', [JobApplicationController::class, 'recruiterShowApplication'])->name('applications.show');
        Route::patch('/applications/{jobApplication}/status', [JobApplicationController::class, 'updateStatus'])->name('applications.update-status');
    });

    // Additional route as an alias to the existing applications.create route
    Route::get('/jobs/{jobPosition}/apply', [JobApplicationController::class, 'create'])->name('jobs.apply');
});
