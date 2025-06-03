<?php

use App\Jobs\VacationRequestEmailJob;
use App\Mail\VacationRequestNotification;
use App\Models\User;
use App\Models\VacationRequest;
use App\Models\Role;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

it('sends vacation request email to admin', function () {
    Mail::fake();

    $adminRole = Role::factory()->create(['name' => 'admin']);
    $admin = User::factory()->create(['role_id' => $adminRole->id]);

    $employeeRole = Role::factory()->create(['name' => 'employee']);
    $employee = User::factory()->create(['role_id' => $employeeRole->id]);

    $vacationRequest = VacationRequest::create([
        'user_id' => $employee->id,
        'start_date' => now(),
        'end_date' => now()->addDays(5),
        'comments' => 'Test vacation request',
        'status' => 'pending'
    ]);

    VacationRequestEmailJob::dispatch($vacationRequest);

    Mail::assertSent(VacationRequestNotification::class, function ($mail) use ($admin) {
        return $mail->hasTo('mariaamartinezros@gmail.com');
    });

})->todo('comprobar envio');


