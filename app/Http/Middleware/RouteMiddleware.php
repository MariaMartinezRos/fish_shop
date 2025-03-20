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

//In this case, the App\Http\Middleware namespace is used to group related
//middleware classes together. The RouteMiddleware class is defined within
//this namespace, and it contains the logic for registering route middleware.

