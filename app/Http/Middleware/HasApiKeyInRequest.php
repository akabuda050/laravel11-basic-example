<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HasApiKeyInRequest
{
    public function handle(Request $request, Closure $next)
    {
        // Bad Practice! Just for learning basics.
        // Check api key in request to allow request or not.
        if (config('auth.api_key') !== $request->header('X-Requested-With-Api-Key')) {
            abort(404);
        }

        // If everything is correct above, pass request to next handler.
        return $next($request);
    }
}
