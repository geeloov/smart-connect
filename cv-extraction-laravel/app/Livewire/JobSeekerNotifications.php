<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;

class JobSeekerNotifications extends Component
{
    public $notifications = [];
    public $unreadCount = 0;
    
    protected $listeners = [
        'echo:job-applications,JobApplicationStatusUpdated' => 'handleStatusUpdate',
        'markAsRead' => 'markAsRead',
        'refresh-notifications' => 'resetNotificationState'
    ];

    public function mount()
    {
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        $jobSeeker = Auth::user();
        
        if (!$jobSeeker || !$jobSeeker->hasRole('job_seeker')) {
            return;
        }
        
        // Get recent application updates for this job seeker
        $this->notifications = JobApplication::where('user_id', $jobSeeker->id)
            ->with('jobPosition')
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($application) {
                $statusText = ucfirst(str_replace('_', ' ', $application->status));
                
                return [
                    'id' => $application->id,
                    'message' => "Your application for {$application->jobPosition->title} is now {$statusText}",
                    'time' => $application->updated_at->diffForHumans(),
                    'link' => route('job-seeker.applications.show', $application->id),
                    'is_read' => $application->seeker_viewed_at !== null
                ];
            })
            ->toArray();
            
        $this->unreadCount = count(array_filter($this->notifications, function ($notification) {
            return !$notification['is_read'];
        }));
    }
    
    public function handleStatusUpdate($data)
    {
        $jobSeeker = Auth::user();
        
        // Only update if the application belongs to this job seeker
        if ($jobSeeker && isset($data['job_application_id'])) {
            $application = JobApplication::with('jobPosition')
                ->where('id', $data['job_application_id'])
                ->where('user_id', $jobSeeker->id)
                ->first();
                
            if ($application) {
                $this->loadNotifications();
                
                // Emit browser notification event
                $statusText = ucfirst(str_replace('_', ' ', $application->status));
                $this->dispatch('showNotification', [
                    'title' => 'Application Update',
                    'body' => "Your application for {$application->jobPosition->title} is now {$statusText}"
                ]);
            }
        }
    }
    
    public function markAsRead($id)
    {
        $application = JobApplication::find($id);
        
        if ($application && $application->user_id === Auth::id()) {
            $application->seeker_viewed_at = now();
            $application->save();
            
            $this->loadNotifications();
        }
    }
    
    public function markAllAsRead()
    {
        $jobSeeker = Auth::user();
        
        if (!$jobSeeker || !$jobSeeker->hasRole('job_seeker')) {
            return;
        }
        
        JobApplication::where('user_id', $jobSeeker->id)
            ->whereNull('seeker_viewed_at')
            ->update(['seeker_viewed_at' => now()]);
            
        $this->loadNotifications();
    }

    public function resetNotificationState()
    {
        $this->loadNotifications();
        
        // Check if there are new notifications and trigger a browser notification for each
        $unreadNotifications = array_filter($this->notifications, function ($notification) {
            return !$notification['is_read'];
        });
        
        foreach($unreadNotifications as $notification) {
            $this->dispatch('showNotification', [
                'title' => 'Application Update',
                'body' => $notification['message']
            ]);
        }
    }

    public function render()
    {
        return view('livewire.job-seeker-notifications');
    }
} 