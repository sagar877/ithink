<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        if (! $request->expectsJson()) {
            // For API: don’t redirect, just return JSON 401
            abort(response()->json(['message' => 'Unauthorized'], 401));
        }

        return null;
    }
}
