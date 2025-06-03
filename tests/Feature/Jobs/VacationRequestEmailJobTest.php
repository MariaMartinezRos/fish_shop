<?php

use App\Jobs\VacationRequestEmailJob;
use App\Mail\VacationRequestNotification;
use App\Models\Role;
use App\Models\User;
use App\Models\VacationRequest;
use Illuminate\Support\Facades\Mail;

beforeEach(function () {
    // Create admin role and user
    $adminRole = Role::factory()->create(['name' => 'admin']);
    $this->admin = User::factory()->create(['role_id' => $adminRole->id]);

    // Create employee role and user
    $employeeRole = Role::factory()->create(['name' => 'employee']);
    $this->employee = User::factory()->create(['role_id' => $employeeRole->id]);

    // Create vacation request
    $this->vacationRequest = VacationRequest::factory()->create([
        'user_id' => $this->employee->id,
        'start_date' => now()->addDays(5),
        'end_date' => now()->addDays(10),
        'status' => 'pending'
    ]);
});

it('sends vacation request email to admin', function () {
    Mail::fake();

    $job = new VacationRequestEmailJob($this->vacationRequest);
    $job->handle();

    Mail::assertSent(VacationRequestNotification::class, function ($mail) {
        return $mail->hasTo($this->admin->email) &&
               $mail->subject === 'Nueva Solicitud de Vacaciones - PESCADERIAS BENITO';
    });
});

it('throws exception when user not found', function () {
    $this->vacationRequest->user()->delete();

    $job = new VacationRequestEmailJob($this->vacationRequest);
    
    expect(fn() => $job->handle())->toThrow(\Exception::class, 'User not found for vacation request');
});

it('throws exception when no admin found', function () {
    // Delete the admin user
    $this->admin->delete();

    $job = new VacationRequestEmailJob($this->vacationRequest);
    
    expect(fn() => $job->handle())->toThrow(\Exception::class, 'No admin user found to send vacation request notification');
});

it('calculates correct number of days', function () {
    Mail::fake();

    $job = new VacationRequestEmailJob($this->vacationRequest);
    $job->handle();

    Mail::assertSent(VacationRequestNotification::class, function ($mail) {
        $data = $mail->buildViewData();
        return $data['days_requested'] === 6; // 5 days difference + 1
    });
});

it('includes correct data in email', function () {
    Mail::fake();

    $job = new VacationRequestEmailJob($this->vacationRequest);
    $job->handle();

    Mail::assertSent(VacationRequestNotification::class, function ($mail) {
        $data = $mail->buildViewData();
        return $data['vacationRequest']->id === $this->vacationRequest->id &&
               $data['employee']->id === $this->employee->id;
    });
});

it('handles job failure gracefully', function () {
    Mail::fake();
    Mail::shouldReceive('to')->andThrow(new \Exception('Mail server error'));

    $job = new VacationRequestEmailJob($this->vacationRequest);
    
    expect(fn() => $job->handle())->toThrow(\Exception::class, 'Failed to send vacation request email');
}); 