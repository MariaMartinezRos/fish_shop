<?php
//
//use App\Jobs\VacationRequestEmailJob;
//use App\Mail\VacationRequestNotification;
//use App\Models\Role;
//use App\Models\User;
//use App\Models\VacationRequest;
//use Illuminate\Support\Facades\Mail;
//
//it('sends vacation request notification email', function () {
//    Mail::fake();
//
//    $adminRole = Role::factory()->create(['name' => 'admin']);
//    $employeeRole = Role::factory()->create(['name' => 'employee']);
//
//    $admin = User::factory()->create(['role_id' => $adminRole->id]);
//    $employee = User::factory()->create(['role_id' => $employeeRole->id]);
//
//    $vacationRequest = VacationRequest::factory()->create([
//        'user_id' => $employee->id,
//        'start_date' => now()->addDays(7),
//        'end_date' => now()->addDays(14),
//        'status' => 'pending'
//    ]);
//
//    $job = new VacationRequestEmailJob($vacationRequest);
//    $job->handle();
//
//    Mail::assertSent(VacationRequestNotification::class, function ($mail) use ($admin, $vacationRequest) {
//        return $mail->hasTo($admin->email) &&
//               $mail->vacationRequest->id === $vacationRequest->id;
//    });
//});
//
//it('handles vacation request with different statuses', function () {
//    Mail::fake();
//
//    $adminRole = Role::factory()->create(['name' => 'admin']);
//    $employeeRole = Role::factory()->create(['name' => 'employee']);
//
//    $admin = User::factory()->create(['role_id' => $adminRole->id]);
//    $employee = User::factory()->create(['role_id' => $employeeRole->id]);
//
//    $vacationRequest = VacationRequest::factory()->create([
//        'user_id' => $employee->id,
//        'start_date' => now()->addDays(7),
//        'end_date' => now()->addDays(14),
//        'status' => 'approved'
//    ]);
//
//    $job = new VacationRequestEmailJob($vacationRequest);
//    $job->handle();
//
//    Mail::assertSent(VacationRequestNotification::class);
//});
//
//it('handles vacation request with different date ranges', function () {
//    Mail::fake();
//
//    $adminRole = Role::factory()->create(['name' => 'admin']);
//    $employeeRole = Role::factory()->create(['name' => 'employee']);
//
//    $admin = User::factory()->create(['role_id' => $adminRole->id]);
//    $employee = User::factory()->create(['role_id' => $employeeRole->id]);
//
//    $vacationRequest = VacationRequest::factory()->create([
//        'user_id' => $employee->id,
//        'start_date' => now()->addMonths(1),
//        'end_date' => now()->addMonths(1)->addDays(5),
//        'status' => 'pending'
//    ]);
//
//    $job = new VacationRequestEmailJob($vacationRequest);
//    $job->handle();
//
//    Mail::assertSent(VacationRequestNotification::class);
//});
//
//it('handles vacation request with different users', function () {
//    Mail::fake();
//
//    $adminRole = Role::factory()->create(['name' => 'admin']);
//    $employeeRole = Role::factory()->create(['name' => 'employee']);
//
//    $admin = User::factory()->create(['role_id' => $adminRole->id]);
//    $employee = User::factory()->create([
//        'role_id' => $employeeRole->id,
//        'name' => 'John Doe',
//        'email' => 'john@example.com'
//    ]);
//
//    $vacationRequest = VacationRequest::factory()->create([
//        'user_id' => $employee->id,
//        'start_date' => now()->addDays(7),
//        'end_date' => now()->addDays(14),
//        'status' => 'pending'
//    ]);
//
//    $job = new VacationRequestEmailJob($vacationRequest);
//    $job->handle();
//
//    Mail::assertSent(VacationRequestNotification::class, function ($mail) use ($admin, $employee) {
//        return $mail->hasTo($admin->email) &&
//               $mail->vacationRequest->user->name === $employee->name;
//    });
//});
