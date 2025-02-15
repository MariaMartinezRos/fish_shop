<?php


use App\Mail\WelcomeMail;
use App\Models\User;

it('includes login details', function () {
    // Arrange
    $user = User::factory()->create();

    // Act
    $mail = new WelcomeMail($user);

    // Assert
    $mail->AssertSeeInText("Thanks for creating an account, {$user->name}!!");
    $mail->AssertSeeInText('Login');
    $mail->AssertSeeInHtml(route('login'));

});

