<?php

use App\Mail\ContactConfirmation;
use App\Models\User;

it('has correct subject', function () {
    $user = User::factory()->create();
    $mail = new ContactConfirmation($user);

    expect($mail->envelope()->subject)->toBe('Contact Confirmation - PESCADERIAS BENITO');
});

it('has correct view', function () {
    $user = User::factory()->create();
    $mail = new ContactConfirmation($user);

    expect($mail->content()->view)->toBe('emails.contact-confirmation');
});

it('has correct data', function () {
    $user = User::factory()->create();
    $mail = new ContactConfirmation($user);

    expect($mail->content()->with['user'])->toBe($user);
});

it('has no attachments', function () {
    $user = User::factory()->create();
    $mail = new ContactConfirmation($user);

    expect($mail->attachments())->toBeEmpty();
});

it('can be dispatched', function () {
    expect(method_exists(ContactConfirmation::class, 'dispatch'))->toBeTrue();
})->todo();
