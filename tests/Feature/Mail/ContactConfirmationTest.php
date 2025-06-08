<?php
//
//use App\Mail\ContactConfirmation;
//use App\Models\Role;
//use App\Models\User;
//use Illuminate\Support\Facades\Mail;
//
//it('builds contact confirmation email with correct data', function () {
//    $role = Role::factory()->create(['name' => 'employee']);
//    $user = User::factory()->create([
//        'role_id' => $role->id,
//        'name' => 'John Doe',
//        'email' => 'john@example.com'
//    ]);
//
//    $message = 'Test message content';
//    $mail = new ContactConfirmation($user, $message);
//
//    expect($mail->to[0]['address'])->toBe('john@example.com')
//        ->and($mail->to[0]['name'])->toBe('John Doe')
//        ->and($mail->message)->toBe('Test message content');
//});
//
//it('renders email with correct subject', function () {
//    $role = Role::factory()->create(['name' => 'employee']);
//    $user = User::factory()->create(['role_id' => $role->id]);
//    $message = 'Test message content';
//
//    $mail = new ContactConfirmation($user, $message);
//
//    expect($mail->subject)->toBe('Confirmación de contacto - Fish Shop');
//});
//
//it('renders email with correct view', function () {
//    $role = Role::factory()->create(['name' => 'employee']);
//    $user = User::factory()->create(['role_id' => $role->id]);
//    $message = 'Test message content';
//
//    $mail = new ContactConfirmation($user, $message);
//
//    expect($mail->view)->toBe('emails.contact-confirmation');
//});
//
//it('passes correct data to email view', function () {
//    $role = Role::factory()->create(['name' => 'employee']);
//    $user = User::factory()->create([
//        'role_id' => $role->id,
//        'name' => 'John Doe',
//        'email' => 'john@example.com'
//    ]);
//    $message = 'Test message content';
//
//    $mail = new ContactConfirmation($user, $message);
//    $viewData = $mail->buildViewData();
//
//    expect($viewData['user'])->toBe($user)
//        ->and($viewData['message'])->toBe('Test message content');
//});
//
//it('handles long messages correctly', function () {
//    $role = Role::factory()->create(['name' => 'employee']);
//    $user = User::factory()->create(['role_id' => $role->id]);
//    $longMessage = str_repeat('Test message content. ', 100);
//
//    $mail = new ContactConfirmation($user, $longMessage);
//
//    expect($mail->message)->toBe($longMessage);
//});
//
//it('handles special characters in message', function () {
//    $role = Role::factory()->create(['name' => 'employee']);
//    $user = User::factory()->create(['role_id' => $role->id]);
//    $message = 'Test message with special chars: áéíóú ñ ¿? ¡!';
//
//    $mail = new ContactConfirmation($user, $message);
//
//    expect($mail->message)->toBe($message);
//});
