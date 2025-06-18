<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CVExtractionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobSeekerController;
use App\Http\Controllers\RecruiterController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobPositionController;
use App\Http\Controllers\JobCompatibilityController;
use App\Http\Controllers\JobSeeker\ApplicationController as JobSeekerApplicationController;
use App\Http\Controllers\ChatbotController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PipelineController;

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
Route::get('/resume-analyzer', [CVExtractionController::class, 'index'])->name('cv-extraction.index');
Route::post('/resume-analyzer/extract', [CVExtractionController::class, 'process'])->name('cv-extraction.process');
Route::post('/resume-analyzer/compatibility', [CVExtractionController::class, 'checkCompatibilityScore'])->name('cv-extraction.check-compatibility');

// Chatbot routes (accessible to all users)
Route::post('/assistant/message', [ChatbotController::class, 'getResponse'])->name('chatbot.response');
Route::get('/assistant/suggestions', [ChatbotController::class, 'getQuickQuestions'])->name('chatbot.quick-questions');

// Job Seeker routes
Route::middleware('role:job_seeker')->prefix('job-seeker')->name('job-seeker.')->group(function () {
    Route::get('/dashboard', [JobSeekerController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [JobSeekerController::class, 'profile'])->name('profile');
    Route::put('/profile/update', [JobSeekerController::class, 'updateProfile'])->name('profile.update');
    
    // CV Management routes
    Route::post('/resume/upload', [JobSeekerController::class, 'uploadCV'])->name('cv.upload');
    Route::post('/resume/{cv}/set-default', [JobSeekerController::class, 'setDefaultCV'])->name('cv.set-default');
    Route::get('/resume/{cv}/view', [JobSeekerController::class, 'viewCV'])->name('cv.view');
    Route::delete('/resume/{cv}', [JobSeekerController::class, 'deleteCV'])->name('cv.delete');
    Route::get('/resume/default', [JobSeekerController::class, 'getDefaultCVForProcessing'])->name('cv.default-for-processing');
    Route::get('/resume/{cv}/compatibility', [JobSeekerController::class, 'getCVForCompatibility'])->name('cv.compatibility');
    
    Route::get('/match-results', [JobSeekerController::class, 'jobMatches'])->name('job-matches');
    
    // Job listings and applications
    Route::get('/opportunities', [JobApplicationController::class, 'availableJobs'])->name('jobs.available');
    Route::get('/opportunities/{jobPosition}', [JobApplicationController::class, 'jobDetails'])->name('jobs.details');
    
    // Job applications
    Route::get('/my-applications', [JobSeekerApplicationController::class, 'index'])->name('applications.index');
    Route::get('/my-applications/{jobApplication}', [JobSeekerApplicationController::class, 'show'])->name('applications.show');
    Route::get('/opportunities/{jobPosition}/apply', [JobSeekerApplicationController::class, 'create'])->name('applications.create');
    Route::post('/opportunities/{jobPosition}/submit', [JobSeekerApplicationController::class, 'store'])->name('applications.store');
    Route::post('/my-applications/{jobApplication}/status', [JobSeekerApplicationController::class, 'updateStatus'])->name('applications.update-status');
    Route::post('/my-applications/{jobApplication}/notes', [JobSeekerApplicationController::class, 'addNotes'])->name('applications.add-notes');

    // Job compatibility routes
    Route::post('/match/analyze', [JobCompatibilityController::class, 'checkCompatibility'])->name('job-compatibility.check');
    Route::post('/match/save', [JobCompatibilityController::class, 'storeCompatibility'])->name('job-compatibility.store');
    
    // CV file routes
    Route::get('/resume-file/{cv}', [JobSeekerController::class, 'getCVFile'])->name('cv-file.get');
    Route::get('/resume-content/{cv}', [JobSeekerController::class, 'getCVContent'])->name('cv-content.get');
});

// Recruiter routes
Route::middleware('role:recruiter')->prefix('recruiter')->name('recruiter.')->group(function () {
    Route::get('/dashboard', [RecruiterController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [RecruiterController::class, 'profile'])->name('profile');
    Route::put('/profile/update', [RecruiterController::class, 'updateProfile'])->name('profile.update');
    Route::get('/resume-analyzer', [RecruiterController::class, 'cvExtraction'])->name('cv-extraction');
    Route::post('/resume-analyzer/extract', [RecruiterController::class, 'cvExtractionProcess'])->name('cv-extraction.process');
    Route::post('/resume-analyzer/save-talent', [RecruiterController::class, 'saveCandidate'])->name('save-candidate');
    Route::get('/talent-pool', [RecruiterController::class, 'candidates'])->name('candidates');
    Route::get('/talent-matching', [RecruiterController::class, 'jobMatching'])->name('job-matching');
    
    // Job positions management
    Route::get('/listings', [JobPositionController::class, 'index'])->name('job-positions.index');
    Route::get('/listings/new', [JobPositionController::class, 'create'])->name('job-positions.create');
    Route::post('/listings', [JobPositionController::class, 'store'])->name('job-positions.store');
    Route::get('/listings/{jobPosition}', [JobPositionController::class, 'show'])->name('job-positions.show');
    Route::get('/listings/{jobPosition}/edit', [JobPositionController::class, 'edit'])->name('job-positions.edit');
    Route::put('/listings/{jobPosition}', [JobPositionController::class, 'update'])->name('job-positions.update');
    Route::delete('/listings/{jobPosition}', [JobPositionController::class, 'destroy'])->name('job-positions.destroy');
    Route::patch('/listings/{jobPosition}/status', [JobPositionController::class, 'toggleActive'])->name('job-positions.toggle-active');
    
    // Candidate Pipeline
    Route::get('/hiring-pipeline', [PipelineController::class, 'index'])->name('pipeline');

    // Job applications management
    Route::get('/applicants', [JobApplicationController::class, 'recruiterApplications'])->name('applications.index');
    Route::get('/applicants/{jobApplication}', [JobApplicationController::class, 'recruiterShowApplication'])->name('applications.show');
    Route::patch('/applicants/{jobApplication}/status', [JobApplicationController::class, 'updateStatus'])->name('applications.update-status');
    Route::patch('/applicants/{jobApplication}/stage', [JobApplicationController::class, 'updateStage'])->name('applications.update-stage');
    
    // Add a route that matches the URL pattern used in the pipeline.blade.php JavaScript
    Route::patch('/applications/{jobApplication}/update-stage', [JobApplicationController::class, 'updateStage'])->name('applications.update-stage-alt');
});

// Additional route as an alias to the existing applications.create route (requires authentication)
Route::middleware('auth')->get('/opportunities/{jobPosition}/apply', [JobApplicationController::class, 'create'])->name('jobs.apply');
