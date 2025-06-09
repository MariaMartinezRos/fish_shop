<?php

namespace App\Listeners;

use App\Events\ProductAdded;

class SendNotificationOnProductAdded
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
    public function handle(ProductAdded $event): void
    {
        \Log::info('Product added successfully: '.$event->product->name);
    }
}
