<?php

namespace App\Listeners;

use App\Events\FishAdded;
use Illuminate\Support\Facades\Session;

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
        Session::flash('toast', [
            'type' => 'success',
            'message' => '¡Pez agregado exitosamente: '.$event->fish->name.'!',
        ]);
    }
}
