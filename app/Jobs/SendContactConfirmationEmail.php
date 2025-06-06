<?php

namespace App\Jobs;

use App\Mail\ContactConfirmation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendContactConfirmationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function handle(): void
    {
        try {
            \Log::info('Starting SendContactConfirmationEmail job', [
                'user_email' => $this->user->email
            ]);

            if (!$this->user || !$this->user->email) {
                throw new \Exception('Invalid user or missing email address');
            }

            Mail::to($this->user->email)->queue(new ContactConfirmation($this->user));
            
            \Log::info('Contact confirmation email queued successfully');
        } catch (\Exception $e) {
            \Log::error('Failed to queue contact confirmation email: ' . $e->getMessage());
            throw $e;
        }
    }
}
