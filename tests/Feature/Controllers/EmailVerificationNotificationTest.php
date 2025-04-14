<?php

use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\VerifyEmail;

beforeEach(function () {
Notification::fake();
});

it('redirects to dashboard if email already verified', function () {
    $user = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    $response = $this->actingAs($user)->post('/email/verification-notification');

    $response->assertRedirect(route('dashboard', [], false));
    Notification::assertNothingSent();
});

it('sends email verification notification if email is not verified', function () {
    $user = User::factory()->create([
        'email_verified_at' => null,
    ]);

    $response = $this->actingAs($user)->post('/email/verification-notification');

    $response
    ->assertRedirect()
    ->assertSessionHas('status', 'verification-link-sent');

    Notification::assertSentTo($user, VerifyEmail::class);
});
