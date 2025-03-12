<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $roleId)
    {
        // Ensure user is authenticated and has the correct role ID
        if (!Auth::check() || Auth::user()->role !== (int) $roleId) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
