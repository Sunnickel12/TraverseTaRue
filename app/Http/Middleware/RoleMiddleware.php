<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Vérifie si l'utilisateur est authentifié et a le rôle nécessaire
        if (auth()->check() && auth()->user()->role === $role) {
            return $next($request);
        }

        // Si l'utilisateur n'a pas le rôle, redirige-le ou affiche un message
        return redirect('/')->with('error', 'Accès non autorisé.');
    }
}
