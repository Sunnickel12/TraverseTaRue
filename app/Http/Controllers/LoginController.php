<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home'); // Redirige si déjà connecté
        }

        return view('auth.login');
    }

    // Handle login logic
    public function login(Request $request)
    {
        // Valider les entrées
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Tentative de connexion
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Si la connexion est réussie, rediriger vers la page d'accueil
            return redirect()->intended(route('home'))->with('success', 'Bienvenue, ' . Auth::user()->first_name . ' ! Connexion réussie.');
        }

        // Si la connexion échoue, retourner avec un message d'erreur
        return back()->withErrors(['error' => 'Identifiant ou mot de passe incorrect.'])->withInput();
    }

    // Log out user and redirect to home page
    public function logout()
    {
        Auth::logout(); // Déconnexion de l'utilisateur
        return redirect()->route('home'); // Redirection vers la page d'accueil après déconnexion
    }
}