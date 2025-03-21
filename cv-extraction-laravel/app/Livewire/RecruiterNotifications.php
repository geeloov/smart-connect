<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;

class RecruiterNotifications extends Component
{
    public $notifications = [];
    public $unreadCount = 0;
    
    protected $listeners = [
        'echo:job-applications,JobApplicationSubmitted' => 'handleNewApplication',
        'markAsRead' => 'markAsRead',
        'refresh-notifications' => 'resetNotificationState'
    ];

    public function mount()
    {
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        // Get the current recruiter's job positions
        $recruiter = Auth::user();
        
        if (!$recruiter || !$recruiter->hasRole('recruiter')) {
            return;
        }
        
        // Get recent applications for this recruiter's job positions
        $this->notifications = JobApplication::whereHas('jobPosition', function ($query) use ($recruiter) {
                $query->where('user_id', $recruiter->id);
            })
            ->with(['jobSeeker', 'jobPosition'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($application) {
                return [
                    'id' => $application->id,
                    'message' => "{$application->jobSeeker->name} applied for {$application->jobPosition->title}",
                    'time' => $application->created_at->diffForHumans(),
                    'link' => route('recruiter.applications.show', $application->id),
                    'is_read' => $application->recruiter_viewed_at !== null
                ];
            })
            ->toArray();
            
        $this->unreadCount = count(array_filter($this->notifications, function ($notification) {
            return !$notification['is_read'];
        }));
    }
    
    public function handleNewApplication($data)
    {
        // Reload notifications when a new application is submitted
        $this->loadNotifications();
        
        // Emit browser notification event
        $this->dispatch('showNotification', [
            'title' => 'New Job Application',
            'body' => 'A new candidate has applied for a position'
        ]);
    }
    
    public function markAsRead($id)
    {
        $application = JobApplication::find($id);
        
        if ($application) {
            $application->recruiter_viewed_at = now();
            $application->save();
            
            $this->loadNotifications();
        }
    }
    
    public function markAllAsRead()
    {
        $recruiter = Auth::user();
        
        if (!$recruiter || !$recruiter->hasRole('recruiter')) {
            return;
        }
        
        JobApplication::whereHas('jobPosition', function ($query) use ($recruiter) {
                $query->where('user_id', $recruiter->id);
            })
            ->whereNull('recruiter_viewed_at')
            ->update(['recruiter_viewed_at' => now()]);
            
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
                'title' => 'New Job Application',
                'body' => $notification['message']
            ]);
        }
    }

    public function render()
    {
        return view('livewire.recruiter-notifications');
    }
} 