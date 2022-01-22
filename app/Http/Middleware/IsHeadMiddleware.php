<?php

namespace App\Http\Middleware;

use Closure;

class IsHeadMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->hasRole('Head')) {
            return redirect()->back();
        }

        return $next($request);
    }
}
