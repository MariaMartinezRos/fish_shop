<?php

//
// use App\Jobs\SendContactConfirmationEmail;
// use App\Mail\ContactConfirmation;
// use App\Models\Role;
// use App\Models\User;
// use Illuminate\Support\Facades\Mail;
//
// it('sends contact confirmation email', function () {
//    Mail::fake();
//
//    $role = Role::factory()->create(['name' => 'employee']);
//    $user = User::factory()->create([
//        'role_id' => $role->id,
//        'name' => 'John Doe',
//        'email' => 'john@example.com'
//    ]);
//
//    $message = 'Test message content';
//    $job = new SendContactConfirmationEmail($user, $message);
//    $job->handle();
//
//    Mail::assertSent(ContactConfirmation::class, function ($mail) use ($user, $message) {
//        return $mail->hasTo($user->email) &&
//               $mail->message === $message;
//    });
// });
//
// it('handles long messages', function () {
//    Mail::fake();
//
//    $role = Role::factory()->create(['name' => 'employee']);
//    $user = User::factory()->create(['role_id' => $role->id]);
//    $longMessage = str_repeat('Test message content. ', 100);
//
//    $job = new SendContactConfirmationEmail($user, $longMessage);
//    $job->handle();
//
//    Mail::assertSent(ContactConfirmation::class, function ($mail) use ($longMessage) {
//        return $mail->message === $longMessage;
//    });
// });
//
// it('handles special characters in message', function () {
//    Mail::fake();
//
//    $role = Role::factory()->create(['name' => 'employee']);
//    $user = User::factory()->create(['role_id' => $role->id]);
//    $message = 'Test message with special chars: áéíóú ñ ¿? ¡!';
//
//    $job = new SendContactConfirmationEmail($user, $message);
//    $job->handle();
//
//    Mail::assertSent(ContactConfirmation::class, function ($mail) use ($message) {
//        return $mail->message === $message;
//    });
// });
//
// it('handles different user roles', function () {
//    Mail::fake();
//
//    $roles = [
//        Role::factory()->create(['name' => 'admin']),
//        Role::factory()->create(['name' => 'employee']),
//        Role::factory()->create(['name' => 'customer'])
//    ];
//
//    foreach ($roles as $role) {
//        $user = User::factory()->create(['role_id' => $role->id]);
//        $message = 'Test message for ' . $role->name;
//
//        $job = new SendContactConfirmationEmail($user, $message);
//        $job->handle();
//
//        Mail::assertSent(ContactConfirmation::class, function ($mail) use ($user, $message) {
//            return $mail->hasTo($user->email) &&
//                   $mail->message === $message;
//        });
//    }
// });
//
// it('handles empty message', function () {
//    Mail::fake();
//
//    $role = Role::factory()->create(['name' => 'employee']);
//    $user = User::factory()->create(['role_id' => $role->id]);
//    $message = '';
//
//    $job = new SendContactConfirmationEmail($user, $message);
//    $job->handle();
//
//    Mail::assertSent(ContactConfirmation::class, function ($mail) use ($message) {
//        return $mail->message === $message;
//    });
// });
