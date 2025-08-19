<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The newly registered user.
     */
    public User $user;

    /**
     * Suggested URL to continue from the email.
     */
    public string $targetUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->targetUrl = $user->isRecruiter() ? route('recruiter.dashboard') : route('job-seeker.dashboard');
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->subject('Welcome to ' . config('app.name'))
            ->view('emails.welcome')
            ->text('emails.welcome')
            ->with([
                'user' => $this->user,
                'targetUrl' => $this->targetUrl,
                'appName' => config('app.name', 'Smart Connect'),
                'appUrl' => config('app.url'),
            ]);
    }
}


