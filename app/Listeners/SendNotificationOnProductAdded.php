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
            'message' => '¡Producto agregado exitosamente: '.$event->product->name.'!',
        ]);
    }
}
