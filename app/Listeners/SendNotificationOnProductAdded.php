<?php

namespace App\Listeners;

use App\Events\ProductAdded;
use Illuminate\Support\Facades\Session;

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
        Session::flash('toast', [
            'type' => 'success',
            'message' => __('Product added succesfully: ').$event->product->name.'!',
        ]);
    }
}
