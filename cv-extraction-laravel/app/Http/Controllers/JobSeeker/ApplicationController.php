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
        // Ensure $jobApplication is an instance of JobApplication
        // If it's an ID, fetch the model instance
        if (!($jobApplication instanceof \App\Models\JobApplication)) {
            // Removed 'cv' from eager loading
            $jobApplication = \App\Models\JobApplication::with(['user', 'jobPosition'])->findOrFail($jobApplication);
        } else {
            // If it's already a model instance, ensure relations are loaded
            // Removed 'cv' from loadMissing
            $jobApplication->loadMissing(['user', 'jobPosition']);
        }

        $currentStatusKey = $jobApplication->status;

        // Define all possible statuses with their labels, icons, and order
        $statuses = [
            'pending' => [
                'label' => 'Application Submitted',
                // Ultra-simple: filled circle
                'icon' => '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16z" clip-rule="evenodd" />',
                'order' => 1
            ],
            'in_review' => [
                'label' => 'In Review',
                // Ultra-simple: basic magnifying glass
                'icon' => '<path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />',
                'order' => 2
            ],
            'interview_scheduled' => [
                'label' => 'Interview Scheduled',
                // Ultra-simple: basic calendar icon
                'icon' => '<path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />',
                'order' => 3
            ],
            'interviewing' => [
                'label' => 'Interviewing',
                // Ultra-simple: basic chat/dialog icon
                'icon' => '<path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9z" clip-rule="evenodd" />',
                'order' => 4
            ],
            'offer_extended' => [
                'label' => 'Offer Extended',
                // Ultra-simple: basic star icon
                'icon' => '<path fill-rule="evenodd" d="M10 18a.75.75 0 01-.75-.75V4.543l-2.47 1.123a.75.75 0 01-.56-1.348l4.5-2.045a.75.75 0 011.06 0l4.5 2.045a.75.75 0 01-.56 1.348L10.75 4.543V17.25A.75.75 0 0110 18zM9.25 2.278l-4.5 2.045a.75.75 0 00.56 1.348L7.25 4.543V17.25a.75.75 0 001.5 0V4.543l1.94-1.123a.75.75 0 00.56-1.348l-4.5-2.045a.75.75 0 00-1.06 0z" clip-rule="evenodd" />',
                'order' => 5
            ],
            'offer_accepted' => [
                'label' => 'Offer Accepted',
                // Ultra-simple: basic checkmark
                'icon' => '<path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />',
                'order' => 6
            ],
            'hired' => [
                'label' => 'Hired',
                // Ultra-simple: basic user/person icon
                'icon' => '<path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />',
                'order' => 7
            ],
            'accepted' => [ 
                'label' => 'Accepted',
                // Ultra-simple: basic check in circle
                'icon' => '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />',
                'order' => 8
            ],
             'application_outcome' => [
                'label' => 'Application Outcome',
                // Ultra-simple: basic document/file icon
                'icon' => '<path fill-rule="evenodd" d="M4 2a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V4a2 2 0 00-2-2H4zm0 1h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z" clip-rule="evenodd" />',
                'order' => 9
            ],
            'offer_declined' => [
                'label' => 'Offer Declined',
                // Ultra-simple: basic X mark
                'icon' => '<path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L10 8.94l3.47-3.47a.75.75 0 111.06 1.06L11.06 10l3.47 3.47a.75.75 0 11-1.06 1.06L10 11.06l-3.47 3.47a.75.75 0 01-1.06-1.06L8.94 10 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />',
                'order' => 10
            ],
            'rejected' => [
                'label' => 'Rejected',
                // Ultra-simple: basic minus/block icon
                'icon' => '<path fill-rule="evenodd" d="M4 8a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H4.75A.75.75 0 014 8z" clip-rule="evenodd" />',
                'order' => 11
            ],
            'withdrawn' => [
                'label' => 'Application Withdrawn',
                // Ultra-simple: basic left arrow
                'icon' => '<path fill-rule="evenodd" d="M17 8a.75.75 0 01-.75.75H5.612l4.158 3.96a.75.75 0 11-1.04 1.08l-5.5-5.25a.75.75 0 010-1.08l5.5-5.25a.75.75 0 111.04 1.08L5.612 7.25H16.25A.75.75 0 0117 8z" clip-rule="evenodd" />',
                'order' => 12
            ]
        ];

        // Ensure the current status from the job application exists in our $statuses array
        // If not, add it with a default icon and label to prevent errors
        if (!isset($statuses[$currentStatusKey])) {
            $statuses[$currentStatusKey] = [
                'label' => ucwords(str_replace('_', ' ', $currentStatusKey)), // Generate a label
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />', // Default question mark icon
                'order' => isset($jobApplication->status_updated_at) ? $jobApplication->status_updated_at->timestamp : time() // Fallback order
            ];
        }
        
        $currentOrder = $statuses[$currentStatusKey]['order'] ?? 0;
        $passedCurrent = false; // Helper to determine future states correctly

        return view('job-seeker.applications.show', compact('jobApplication', 'statuses', 'currentStatusKey', 'currentOrder', 'passedCurrent'));
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