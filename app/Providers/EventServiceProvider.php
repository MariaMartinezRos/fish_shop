<?php

namespace App\Providers;

use App\Events\FishAdded;
use App\Events\UserCreated;
use App\Listeners\SendNotificationOnFishAdded;
use App\Listeners\SendWelcomeEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\ProductAdded;
use App\Listeners\SendNotificationOnProductAdded;
use App\Events\PageAccessed;
use App\Listeners\LogPageAccess;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserCreated::class => [
            SendWelcomeEmail::class,
        ],
        FishAdded::class => [
            SendNotificationOnFishAdded::class,
        ],
        ProductAdded::class => [
            SendNotificationOnProductAdded::class,
        ],
        PageAccessed::class => [
            LogPageAccess::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        parent::boot();

        Event::listen(UserCreated::class, [SendWelcomeEmail::class, 'handle']);
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
