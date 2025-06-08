<?php

use App\Mail\VacationRequestNotification;
use App\Models\Role;
use App\Models\User;
use App\Models\VacationRequest;

it('builds vacation request notification email', function () {
    $employee = User::factory()->create(['role_id' => 2]);

    $vacationRequest = VacationRequest::create([
        'user_id' => $employee->id,
        'start_date' => now(),
        'end_date' => now()->addDays(5),
        'comments' => 'Test vacation request',
        'status' => 'pending',
    ]);

    $daysRequested = $vacationRequest->totalDays();
    $mail = new VacationRequestNotification($vacationRequest, $employee, $daysRequested);

    expect($mail->vacationRequest)->toEqual($vacationRequest)
        ->and($mail->envelope()->subject)->toEqual('Nueva Solicitud de Vacaciones - PESCADERIAS BENITO')
        ->and($mail->content()->markdown)->toEqual('emails.vacation-request')
        ->and($mail->content()->with['vacationRequest'])->toEqual($vacationRequest);
});

it('includes correct data in email content', function () {
    $employee = User::factory()->create(['role_id' => 2]);
    $startDate = now();
    $endDate = now()->addDays(5);

    $vacationRequest = VacationRequest::create([
        'user_id' => $employee->id,
        'start_date' => $startDate,
        'end_date' => $endDate,
        'comments' => 'Test vacation request',
        'status' => 'pending',
    ]);

    $daysRequested = $vacationRequest->totalDays();
    $mail = new VacationRequestNotification($vacationRequest, $employee, $daysRequested);
    $content = $mail->content();

    expect($content->with['vacationRequest']->start_date->format('Y-m-d'))->toBe($startDate->format('Y-m-d'))
        ->and($content->with['vacationRequest']->end_date->format('Y-m-d'))->toBe($endDate->format('Y-m-d'))
        ->and($content->with['vacationRequest']->comments)->toBe('Test vacation request')
        ->and($content->with['vacationRequest']->status)->toBe('pending')
        ->and($content->with['employee']->id)->toBe($employee->id);
});
