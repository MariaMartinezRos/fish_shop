<?php

use App\Events\FishAdded;
use App\Events\PageAccessed;
use App\Events\ProductAdded;
use App\Events\UserCreated;
use App\Listeners\SendNotificationOnFishAdded;
use App\Listeners\SendNotificationOnProductAdded;
use App\Listeners\SendWelcomeEmail;
use App\Listeners\ShowSweetAlertOnPageAccess;
use App\Mail\WelcomeMail;
use App\Models\Fish;
use App\Models\Product;
use App\Models\User;
use App\Providers\EventServiceProvider;
use Illuminate\Support\Facades\Event;

it('registers all event listeners correctly', function () {
    // Test UserCreated event
    Event::fake();
    Event::assertListening(
        UserCreated::class,
        SendWelcomeEmail::class
    );

    // Test FishAdded event
    Event::assertListening(
        FishAdded::class,
        SendNotificationOnFishAdded::class
    );

    // Test ProductAdded event
    Event::assertListening(
        ProductAdded::class,
        SendNotificationOnProductAdded::class
    );

    // Test PageAccessed event
    Event::assertListening(
        PageAccessed::class,
        ShowSweetAlertOnPageAccess::class
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
    Event::fake();

    $client = User::factory()->create(['role_id' => 4]);

    event(new UserCreated($client));

    Event::assertDispatched(UserCreated::class);
    Event::assertListening(
        UserCreated::class,
        SendWelcomeEmail::class
    );
});

it('dispatches SendNotificationOnFishAdded when FishAdded event is fired', function () {
    Event::fake();

    $fish = Fish::factory()->create();

    event(new FishAdded($fish));

    Event::assertDispatched(FishAdded::class);
    Event::assertListening(
        FishAdded::class,
        SendNotificationOnFishAdded::class
    );
});

it('dispatches SendNotificationOnProductAdded when ProductAdded event is fired', function () {
    Event::fake();

    $category = \App\Models\Category::factory()->create();
    $product = Product::factory()->create(['category_id' => $category->id]);

    event(new ProductAdded($product));

    Event::assertDispatched(ProductAdded::class);
    Event::assertListening(
        ProductAdded::class,
        SendNotificationOnProductAdded::class
    );
});

it('dispatches ShowSweetAlertOnPageAccess when PageAccessed event is fired', function () {
    Event::fake();

    $message = 'Welcome to the Fish Shop!';

    event(new PageAccessed($message));

    Event::assertDispatched(PageAccessed::class);
    Event::assertListening(
        PageAccessed::class,
        ShowSweetAlertOnPageAccess::class
    );
});

it('registers all event listeners in the correct order', function () {
    $provider = new EventServiceProvider(app());
    $listen = $provider->listens();

    // Check that each event has exactly one listener
    foreach ($listen as $event => $listeners) {
        expect($listeners)->toHaveCount(1);
    }
});

it('registers all required events', function () {
    $provider = new EventServiceProvider(app());
    $listen = $provider->listens();

    $requiredEvents = [
        UserCreated::class,
        FishAdded::class,
        ProductAdded::class,
        PageAccessed::class
    ];

    foreach ($requiredEvents as $event) {
        expect($listen)->toHaveKey($event);
    }
});
