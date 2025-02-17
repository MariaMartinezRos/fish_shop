<?php

namespace App\Http\Middleware;

class AlwaysAcceptJsonMiddleware
{
    public function handle($request, $next)
    {
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}
