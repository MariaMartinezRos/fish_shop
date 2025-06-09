<?php

namespace App\Listeners;

use App\Events\FishAdded;

class SendNotificationOnFishAdded
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(FishAdded $event): void
    {
        \Log::info('Fish added successfully: '.$event->fish->name);
    }
}
