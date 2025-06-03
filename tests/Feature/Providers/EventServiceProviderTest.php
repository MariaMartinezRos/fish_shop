<?php

use App\Events\UserCreated;
use App\Events\FishAdded;
use App\Events\ProductAdded;
use App\Events\PageAccessed;
use App\Listeners\SendWelcomeEmail;
use App\Listeners\SendNotificationOnFishAdded;
use App\Listeners\SendNotificationOnProductAdded;
use App\Listeners\ShowSweetAlertOnPageAccess;
use App\Mail\WelcomeMail;
use App\Models\Fish;
use App\Models\Product;
use App\Models\User;
use App\Providers\EventServiceProvider;
use Illuminate\Support\Facades\Event;

it('registers event listeners correctly', function () {
    Event::fake();

    event(new UserCreated(User::factory()->make()));

    Event::assertListening(
        UserCreated::class,
        SendWelcomeEmail::class,
    );
});

it('has correct event-listener mappings in protected $listen property', function () {
    $provider = new EventServiceProvider(app());
    $listen = $provider->listens();

    expect($listen)->toHaveKey(UserCreated::class)
        ->and($listen[UserCreated::class])->toContain(SendWelcomeEmail::class)
        ->and($listen)->toHaveKey(FishAdded::class)
        ->and($listen[FishAdded::class])->toContain(SendNotificationOnFishAdded::class)
        ->and($listen)->toHaveKey(ProductAdded::class)
        ->and($listen[ProductAdded::class])->toContain(SendNotificationOnProductAdded::class)
        ->and($listen)->toHaveKey(PageAccessed::class)
        ->and($listen[PageAccessed::class])->toContain(ShowSweetAlertOnPageAccess::class);
});

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
        UserCreated::class,
        SendWelcomeEmail::class
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
