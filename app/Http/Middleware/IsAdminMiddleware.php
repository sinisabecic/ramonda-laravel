<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdminMiddleware
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
        //? Uvijek ide na negaciju uslov. Jer ovo $next je kao neki else true/continue
        // * getIsAdminAttribute() je is_admin/isAdmin funkcija iz User modela


        if (!auth()->check() || !auth()->user()->is_admin) { // moze i isAdmin, svejedno je
            return redirect()->back();
        }

        return $next($request); // next me vodi na zeljenu rutu
    }
}
