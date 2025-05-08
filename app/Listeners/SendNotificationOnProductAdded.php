<?php

namespace App\Listeners;

use App\Events\FishAdded;
use App\Events\ProductAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
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
            'message' => '¡Producto agregado exitosamente: ' . $event->product->name . '!'
        ]);
    }
}
