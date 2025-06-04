<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIfSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the authenticated user has 'user_type' of 'superAdmin'
        if (auth()->check() && auth()->user()->user_type === 'SuperAdmin') {
            return $next($request);
        }

        // If not, redirect or abort
        return redirect('/dashboard'); // You can redirect to any route you prefer
    }
}
