<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if the user is authenticated
        if (auth::check()) {
            // Check if the user has the required role
            if (auth::user()->Auth::user()->$role) {
                return $next($request);
            }
        }

        // If the user does not have the role, redirect or show an error
        return redirect('/')->with('error', 'Unauthorized access.');
    }
}