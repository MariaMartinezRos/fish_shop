<?php

namespace App\Listeners;

use App\Events\PageAccessed;
use Illuminate\Support\Facades\Session;

class ShowSweetAlertOnPageAccess
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
    public function handle(PageAccessed $event): void
    {
        Session::flash('toast', [
            'type' => 'success',
            'message' => '¡ '.$event->message.' !',
        ]);
    }
}
