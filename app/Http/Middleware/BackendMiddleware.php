<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BackendMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->type == 1) {
            abort(403);
        }
        return $next($request);
    }
}
