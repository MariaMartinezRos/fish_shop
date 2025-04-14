<?php

use App\Events\UserCreated;
use App\Listeners\SendWelcomeEmail;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use App\Mail\WelcomeMail;


it('dispatches SendWelcomeEmail when UserCreated event is fired', function () {
    // Arrange
    Event::fake();

    $role_customer = \App\Models\Role::factory()->create(['name' => 'customer', 'id' => 4]);
    $client = User::factory()->create(['role_id' => $role_customer->id]);

    // Act
    event(new UserCreated($client));

    // Assert
    Event::assertDispatched(UserCreated::class);
    Event::assertListening(
        UserCreated::class,
        SendWelcomeEmail::class
    );
});

it('triggers the listener and sends welcome email', function () {
    Mail::fake();

    event(new UserCreated($user = \App\Models\User::factory()->create()));

    Mail::assertSent(WelcomeMail::class, function ($mail) use ($user) {
        return $mail->hasTo($user->email);
    });
});

