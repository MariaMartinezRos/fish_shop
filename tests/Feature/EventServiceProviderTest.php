<?php

use App\Events\FishAdded;
use App\Events\PageAccessed;
use App\Events\ProductAdded;
use App\Events\UserCreated;
use App\Listeners\SendWelcomeEmail;
use App\Models\Fish;
use App\Models\Product;
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

it('registers expected event listeners', function () {
    Event::fake();

    $user = new User();
    $fish = new Fish();
    $product = new Product();
    $message = 'Page accessed';

    event(new UserCreated($user));
    event(new FishAdded($fish));
    event(new ProductAdded($product));
    event(new PageAccessed($message));

    Event::assertListening(
        \App\Events\UserCreated::class,
        \App\Listeners\SendWelcomeEmail::class
    );

    Event::assertListening(
        \App\Events\FishAdded::class,
        \App\Listeners\SendNotificationOnFishAdded::class
    );

    Event::assertListening(
        \App\Events\ProductAdded::class,
        \App\Listeners\SendNotificationOnProductAdded::class
    );

    Event::assertListening(
        \App\Events\PageAccessed::class,
        \App\Listeners\ShowSweetAlertOnPageAccess::class
    );
});

