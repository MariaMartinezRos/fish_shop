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
    $provider = new EventServiceProvider(app());
    $provider->boot();

    // Test UserCreated event
    expect(Event::getListeners(UserCreated::class))->toContain(SendWelcomeEmail::class);

    // Test FishAdded event
    expect(Event::getListeners(FishAdded::class))->toContain(SendNotificationOnFishAdded::class);

    // Test ProductAdded event
    expect(Event::getListeners(ProductAdded::class))->toContain(SendNotificationOnProductAdded::class);

    // Test PageAccessed event
    expect(Event::getListeners(PageAccessed::class))->toContain(ShowSweetAlertOnPageAccess::class);
});

it('has correct event to listener mappings', function () {
    $provider = new EventServiceProvider(app());
    $mappings = $provider->listens();

    expect($mappings)->toHaveKey(UserCreated::class);
    expect($mappings)->toHaveKey(FishAdded::class);
    expect($mappings)->toHaveKey(ProductAdded::class);
    expect($mappings)->toHaveKey(PageAccessed::class);

    expect($mappings[UserCreated::class])->toContain(SendWelcomeEmail::class);
    expect($mappings[FishAdded::class])->toContain(SendNotificationOnFishAdded::class);
    expect($mappings[ProductAdded::class])->toContain(SendNotificationOnProductAdded::class);
    expect($mappings[PageAccessed::class])->toContain(ShowSweetAlertOnPageAccess::class);
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
