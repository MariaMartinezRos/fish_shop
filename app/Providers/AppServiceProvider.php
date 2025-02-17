<?php

namespace App\Providers;

use App\Models\Fish;
use App\Observers\FishObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fish::observe(FishObserver::class);
    }
}
