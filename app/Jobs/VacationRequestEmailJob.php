<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\VacationRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class VacationRequestEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $vacationRequest;

    public function __construct(VacationRequest $vacationRequest)
    {
        $this->vacationRequest = $vacationRequest;
    }

    public function handle()
    {
        try {
            \Log::info('Starting VacationRequestEmailJob', [
                'vacation_request_id' => $this->vacationRequest->id,
            ]);

            $user = $this->vacationRequest->user;
            if (! $user) {
                throw new \Exception('User not found for vacation request');
            }

            $admin = User::whereHas('role', function ($query) {
                $query->where('name', 'admin');
            })->first();

            if (! $admin) {
                throw new \Exception('No admin user found to send vacation request notification');
            }

            \Log::info('Sending vacation request email', [
                'to' => $admin->email,
                'employee' => $user->name,
            ]);

            Mail::send('mail.vacation-request', [
                'vacationRequest' => $this->vacationRequest,
                'employee' => $user,
                'days_requested' => $this->vacationRequest->start_date->diffInDays($this->vacationRequest->end_date) + 1,
            ], function ($message) use ($admin) {
                $message->to($admin->email)
                    ->subject(__('New Vacation Request - PESCADERIAS BENITO'));
            });

            \Log::info(__('Vacation request email sent successfully'));
        } catch (\Exception $e) {
            \Log::error(__('Failed to send vacation request email'), [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            throw $e;
        }
    }
}
