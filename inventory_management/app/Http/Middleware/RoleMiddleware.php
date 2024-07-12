<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role_as !== 'admin') {
            return redirect()->route('home')->with('status', 'Access denied. You are not an admin.');
        } else if ((Auth::check() && Auth::user()->role_as !== 'userP') || (Auth::user()->role_as != 'admin'&& Auth::check())) {
            return redirect()->route('home')->with('status', 'Access denied. You are not allow to access this page.');
        }
        
        return $next($request);
    }
}
