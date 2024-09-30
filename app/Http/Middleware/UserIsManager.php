<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserIsManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'manager') {
            return $next($request);
        }

        // Redirection ou action si l'utilisateur n'est pas un manager
        return redirect('/dashboard')->withErrors('Accès refusé.');
    }
}
