<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Models\JobPosition;
use App\Models\CV;
use App\Models\CVJobCompatibility;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ApplicationController extends Controller
{
    /**
     * Show the form for creating a new application.
     *
     * @param  JobPosition  $jobPosition
     * @return \Illuminate\View\View
     */
    public function create(JobPosition $jobPosition)
    {
        try {
            // Get the authenticated user
            $user = Auth::user();
            Log::info('Loading application create page', [
                'user_id' => $user->id,
                'job_position_id' => $jobPosition->id
            ]);
            
            // Get the default CV if it exists
            $defaultCV = CV::where('user_id', $user->id)
                ->where('is_default', true)
                ->first();
            
            // Initialize this to an empty collection to avoid undefined variable errors
            $compatibilityHistory = collect([]);
            $historyStats = [
                'average_score' => 0,
                'highest_score' => 0,
                'lowest_score' => 0,
                'total_comparisons' => 0,
                'recent_trend' => 'stable'
            ];
            
            // Use the authenticated user's ID to get compatibility history
            $userId = $user->id;
            
            // Output important debugging information
            Log::info('Important user information', [
                'authenticated_user_id' => $userId,
                'session_user_id' => session('user_id'),
                'has_default_cv' => !is_null($defaultCV),
                'default_cv_id' => $defaultCV ? $defaultCV->id : 'none'
            ]);
            
            // DIRECT DB QUERY for debugging purposes to see what's actually in the database
            $rawRecords = DB::table('cv_job_compatibility')
                ->where('user_id', $userId)
                ->get();

            Log::info('Raw DB query results for cv_job_compatibility', [
                'count' => $rawRecords->count(),
                'records' => $rawRecords
            ]);
                
            // Get compatibility history for the current user WITHOUT EAGER LOADING
            $compatibilityHistory = CVJobCompatibility::where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->take(10) // Limit to 10 most recent records
                ->get();
            
            // ADDED DEBUGGING: Dump SQL query for debugging
            $query = CVJobCompatibility::where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->toSql();
            
            Log::info('SQL query used for compatibility history', [
                'sql' => $query,
                'user_id' => $userId,
                'result_count' => $compatibilityHistory->count()
            ]);
            
            // ADDED DEBUGGING: Directly check the database table
            $rawCountCheck = DB::select("SELECT COUNT(*) as count FROM cv_job_compatibility WHERE user_id = ?", [$userId]);
            Log::info('Raw count check from database', [
                'raw_count_result' => $rawCountCheck,
                'user_id' => $userId
            ]);
            
            // Now do eager loading separately to avoid issues if some related records don't exist
            if ($compatibilityHistory->isNotEmpty()) {
                $cvIds = $compatibilityHistory->pluck('cv_id')->unique();
                $jobPositionIds = $compatibilityHistory->pluck('job_position_id')->unique();
                
                // Check if CV and JobPosition records actually exist in the database
                $cvs = CV::whereIn('id', $cvIds)->get()->keyBy('id');
                $positions = JobPosition::whereIn('id', $jobPositionIds)->get()->keyBy('id');
                
                Log::info('Related record lookup results', [
                    'cv_ids_requested' => $cvIds->toArray(),
                    'cv_ids_found' => $cvs->keys()->toArray(),
                    'job_position_ids_requested' => $jobPositionIds->toArray(),
                    'job_position_ids_found' => $positions->keys()->toArray(),
                    'missing_cvs' => $cvIds->diff($cvs->keys())->toArray(),
                    'missing_positions' => $jobPositionIds->diff($positions->keys())->toArray()
                ]);
                
                // Check if we have all the expected related records
                $missingRelations = false;
                
                if ($cvIds->count() !== $cvs->count()) {
                    $missingRelations = true;
                    Log::warning('Missing CV records', [
                        'missing_ids' => $cvIds->diff($cvs->keys())->toArray()
                    ]);
                }
                
                if ($jobPositionIds->count() !== $positions->count()) {
                    $missingRelations = true;
                    Log::warning('Missing JobPosition records', [
                        'missing_ids' => $jobPositionIds->diff($positions->keys())->toArray()
                    ]);
                }
                
                // Force relationship creation even if the related records don't exist
                // This ensures the compatibility history will display even with missing relations
                foreach ($compatibilityHistory as $item) {
                    // Set CV relation (use default if missing)
                    if (isset($cvs[$item->cv_id])) {
                        $item->setRelation('cv', $cvs[$item->cv_id]);
                    } else {
                        // Create a default CV object
                        $defaultCv = new CV();
                        $defaultCv->id = $item->cv_id;
                        $defaultCv->file_name = "CV #" . $item->cv_id . " (Missing)";
                        $item->setRelation('cv', $defaultCv);
                    }
                    
                    // Set JobPosition relation (use default if missing)
                    if (isset($positions[$item->job_position_id])) {
                        $item->setRelation('jobPosition', $positions[$item->job_position_id]);
                    } else {
                        // Create a default JobPosition object
                        $defaultPosition = new JobPosition();
                        $defaultPosition->id = $item->job_position_id;
                        $defaultPosition->title = "Position #" . $item->job_position_id . " (Missing)";
                        $defaultPosition->company_name = "Unknown Company";
                        $item->setRelation('jobPosition', $defaultPosition);
                    }
                }
            }
            
            // Add metadata for the history display, with proper null handling
            $historyStats = [
                'average_score' => $compatibilityHistory->avg('compatibility_score') ?? 0,
                'highest_score' => $compatibilityHistory->max('compatibility_score') ?? 0,
                'lowest_score' => $compatibilityHistory->min('compatibility_score') ?? 0,
                'total_comparisons' => $compatibilityHistory->count(),
                'recent_trend' => $this->calculateCompatibilityTrend($compatibilityHistory)
            ];
            
            // View debug variable to see in the page
            $debug = [
                'user_id' => $user->id,
                'job_position_id' => $jobPosition->id,
                'history_count' => $compatibilityHistory->count(),
                'raw_records_count' => $rawRecords->count(),
                'has_default_cv' => !is_null($defaultCV),
                'route_path' => request()->path()
            ];
            
            // Double-check that compatibility history is defined
            if (!isset($compatibilityHistory)) {
                Log::error('Compatibility history is still null after initialization');
                $compatibilityHistory = collect([]);
            }
            
            // Dump debugging info to logs
            Log::info('Final data being passed to view', [
                'compatibility_history_count' => $compatibilityHistory->count(),
                'compatibility_history_type' => get_class($compatibilityHistory),
                'history_stats' => $historyStats
            ]);
            
            return view('job-seeker.applications.create', compact(
                'jobPosition', 
                'defaultCV', 
                'compatibilityHistory',
                'historyStats',
                'debug'
            ));
            
        } catch (\Exception $e) {
            Log::error('Exception in ApplicationController.create: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Return a view with error information but ensure all required variables are defined
            $compatibilityHistory = collect([]);
            $historyStats = [
                'average_score' => 0,
                'highest_score' => 0,
                'lowest_score' => 0,
                'total_comparisons' => 0,
                'recent_trend' => 'stable'
            ];
            $debug = [
                'error' => $e->getMessage(),
                'has_default_cv' => false
            ];
            
            return view('job-seeker.applications.create', compact(
                'jobPosition', 
                'compatibilityHistory',
                'historyStats',
                'debug'
            ))->withErrors(['error' => 'Error loading application form: ' . $e->getMessage()]);
        }
    }
    
    /**
     * Store a newly created job application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  JobPosition  $jobPosition
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, JobPosition $jobPosition)
    {
        try {
            // Log the start of the store method
            Log::info('ApplicationController@store called', [
                'user_id' => Auth::id(),
                'job_position_id' => $jobPosition->id
            ]);
            
            // Delegate to the JobApplicationController's store method
            $jobApplicationController = app()->make('App\Http\Controllers\JobApplicationController');
            return $jobApplicationController->store($request, $jobPosition);
            
        } catch (\Exception $e) {
            Log::error('Exception in ApplicationController.store: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->with('error', 'Error submitting application: ' . $e->getMessage())
                ->withInput();
        }
    }
    
    /**
     * Display the job seeker's applications.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            // Get the authenticated user's applications
            $user = Auth::user();
            Log::info('Loading applications index page', [
                'user_id' => $user->id
            ]);
            
            // Get all applications for the user with job position information
            $applications = $user->jobApplications()
                ->with('jobPosition')
                ->latest()
                ->get();
                
            return view('job-seeker.applications.index', compact('applications'));
            
        } catch (\Exception $e) {
            Log::error('Exception in ApplicationController.index: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return view('job-seeker.applications.index')
                ->withErrors(['error' => 'Error loading applications: ' . $e->getMessage()]);
        }
    }
    
    /**
     * Display the specified job application.
     *
     * @param  \App\Models\JobApplication  $jobApplication
     * @return \Illuminate\View\View
     */
    public function show($jobApplication)
    {
        try {
            // Find the job application
            $jobApplication = \App\Models\JobApplication::findOrFail($jobApplication);
            
            // Make sure the job seeker can only view their own applications
            if ($jobApplication->user_id !== Auth::id()) {
                abort(403, 'Unauthorized action.');
            }
            
            // Load related data
            $jobApplication->load('jobPosition');
            
            return view('job-seeker.applications.show', compact('jobApplication'));
            
        } catch (\Exception $e) {
            Log::error('Exception in ApplicationController.show: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('job-seeker.applications.index')
                ->withErrors(['error' => 'Error loading application: ' . $e->getMessage()]);
        }
    }
    
    /**
     * Calculate if the compatibility scores are trending up, down, or stable
     * 
     * @param Collection $history
     * @return string
     */
    private function calculateCompatibilityTrend(Collection $history): string
    {
        if ($history->count() < 2) {
            return 'stable';
        }
        
        // Get the scores in chronological order (oldest first)
        $scores = $history->sortBy('created_at')->pluck('compatibility_score')->toArray();
        
        // Calculate a simple trend by comparing the average of the first half vs second half
        $halfCount = ceil(count($scores) / 2);
        $firstHalf = array_slice($scores, 0, $halfCount);
        $secondHalf = array_slice($scores, $halfCount);
        
        $firstAvg = !empty($firstHalf) ? array_sum($firstHalf) / count($firstHalf) : 0;
        $secondAvg = !empty($secondHalf) ? array_sum($secondHalf) / count($secondHalf) : 0;
        
        $difference = $secondAvg - $firstAvg;
        
        if ($difference >= 5) {
            return 'up';
        } elseif ($difference <= -5) {
            return 'down';
        } else {
            return 'stable';
        }
    }
} 