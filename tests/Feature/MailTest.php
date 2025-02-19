<?php

use App\Jobs\SendContactConfirmationEmail;
use App\Mail\ContactConfirmation;
use App\Mail\WelcomeMail;
use App\Models\User;

it('includes login details for the welcome mail', function () {
    // Arrange
    $user = User::factory()->create();

    // Act
    $mail = new WelcomeMail($user);

    // Assert
    $mail->AssertSeeInText("Gracias por crear una cuenta, {$user->name}!!");
    $mail->AssertSeeInText('Login');
    $mail->AssertSeeInHtml(route('login'));

});

it('sends the confirmation email for the contact page', function () {
    // Arrange
    Mail::fake();
    $user = User::factory()->create();

    // Act
    SendContactConfirmationEmail::dispatch($user);

    // Assert
    Mail::assertQueued(ContactConfirmation::class, function ($mail) use ($user) {
        return $mail->hasTo($user->email);
    });
});

it('includes valid data for the contact mail', function () {
    // Arrange
    $response = $this->post(route('contact.submit'), [
        'name' => '',
        'email' => 'invalid-email',
        'message' => '',
    ]);

    // Act && Assert
    $response->assertSessionHasErrors(['name', 'email', 'message']);
});
