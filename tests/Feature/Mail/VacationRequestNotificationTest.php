<?php

use App\Mail\VacationRequestNotification;
use App\Models\Role;
use App\Models\User;
use App\Models\VacationRequest;
use Illuminate\Support\Facades\Mail;

beforeEach(function () {
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

it('builds vacation request notification email', function () {
    $mail = new VacationRequestNotification($this->vacationRequest);

    expect($mail->vacationRequest)->toBe($this->vacationRequest);
    expect($mail->envelope()->subject)->toBe('Nueva Solicitud de Vacaciones - PESCADERIAS BENITO');
    expect($mail->content()->markdown)->toBe('emails.vacation-request');
    expect($mail->content()->with)->toHaveKey('vacationRequest');
    expect($mail->content()->with)->toHaveKey('employee');
    expect($mail->attachments())->toBeArray();
    expect($mail->attachments())->toBeEmpty();
});

it('sends vacation request notification email', function () {
    Mail::fake();

    Mail::to('admin@example.com')
        ->send(new VacationRequestNotification($this->vacationRequest));

    Mail::assertSent(VacationRequestNotification::class, function ($mail) {
        return $mail->hasTo('admin@example.com') &&
               $mail->vacationRequest->id === $this->vacationRequest->id;
    });
});

it('includes correct data in email content', function () {
    $mail = new VacationRequestNotification($this->vacationRequest);
    $data = $mail->content()->with;

    expect($data['vacationRequest'])->toBe($this->vacationRequest);
    expect($data['employee'])->toBe($this->employee);
    expect($data['days_requested'])->toBe(6); // 5 days difference + 1
});

it('formats dates correctly in email', function () {
    $mail = new VacationRequestNotification($this->vacationRequest);
    $data = $mail->content()->with;

    expect($data['vacationRequest']->start_date->format('d/m/Y'))->toBe(now()->addDays(5)->format('d/m/Y'));
    expect($data['vacationRequest']->end_date->format('d/m/Y'))->toBe(now()->addDays(10)->format('d/m/Y'));
}); 