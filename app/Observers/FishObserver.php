<?php

namespace App\Observers;

use App\Models\Fish;
use Illuminate\Support\Facades\Cache;

class FishObserver
{
    /**
     * Handle the Fish "created" event.
     */
    public function created(Fish $fish): void
    {
        Cache::forget('fishes');
    }

    /**
     * Handle the Fish "updated" event.
     */
    public function updated(Fish $fish): void
    {
        Cache::forget('fishes');
    }

    /**
     * Handle the Fish "deleted" event.
     */
    public function deleted(Fish $fish): void
    {
        Cache::forget('fishes');
    }
}
