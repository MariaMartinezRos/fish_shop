<?php

namespace App\Jobs;

use App\Mail\VacationRequestNotification;
use App\Models\User;
use App\Models\VacationRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\VacationRequest as VacationRequestModel;

class VacationRequestEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $vacationRequest;

    public function __construct(VacationRequest $vacationRequest)
    {
        $this->vacationRequest = $vacationRequest;
    }

    public function handle(): void
    {
        try {
            \Log::info('Starting VacationRequestEmailJob', [
                'vacation_request_id' => $this->vacationRequest->id,
            ]);

            $user = $this->vacationRequest->user;
            if (! $user) {
                throw new \Exception(__('User not found for vacation request'));
            }

            $admin = User::whereHas('role', function ($query) {
                $query->where('name', 'admin');
            })->first();

            if (! $admin) {
                throw new \Exception(__('No admin user found to send vacation request notification'));
            }

            \Log::info('Sending vacation request email', [
                'admin_email' => $admin->email,
                'employee_name' => $user->name,
                'vacation_request_id' => $this->vacationRequest->id
            ]);

            Mail::to($admin->email)
                ->queue(new VacationRequestNotification(
                    $this->vacationRequest,
                    $user,
                    $this->vacationRequest->totalDays()
                ));

            \Log::info('Vacation request email sent successfully');
            
        } catch (\Exception $e) {
            \Log::error('Failed to send vacation request email: ' . $e->getMessage(), [
                'exception' => $e,
                'vacation_request_id' => $this->vacationRequest->id ?? null
            ]);
            throw $e;
        }
    }
}
