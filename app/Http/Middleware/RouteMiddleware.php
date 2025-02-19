<?php

// app/Http/Middleware/RouteMiddleware.php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;

class RouteMiddleware
{
    /**
     * Register any route middleware.
     */
    public static function register(): void
    {
        Route::middleware('admin', \App\Http\Middleware\AdminMiddleware::class);
    }
}
