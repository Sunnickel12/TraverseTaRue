<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Gérer l'authentification de l'utilisateur.
     */
    public function login(Request $request)
    {
        // Empêcher un utilisateur déjà connecté d'accéder à la connexion
        if (Auth::check()) {
            return redirect()->route('home')->with('info', 'Vous êtes déjà connecté.');
        }

        // Validation des entrées
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Tentative de connexion
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate(); // Sécurisation de la session
            // Si une page précédente existe, rediriger vers elle, sinon rediriger vers la page d'accueil
            $previousUrl = url()->previous() ?: route('home');
            return redirect()->to($previousUrl)->with('success', 'Connexion réussie.');
        }

        // Si la connexion échoue
        return back()->withErrors(['error' => 'Identifiant ou mot de passe incorrect.'])->withInput();
    }

    /**
     * Gérer la déconnexion de l'utilisateur.
     */
    public function logout(Request $request)
    {
        // Vérifier si l'utilisateur est déjà déconnecté
        if (!Auth::check()) {
            return redirect()->route('home')->with('info', 'Vous êtes déjà déconnecté.');
        }

        // Récupérer l'URL précédente ou la page d'accueil si aucune page précédente
        $previousUrl = url()->previous() ?: route('home');

        // Déconnexion de l'utilisateur
        Auth::logout();

        // Invalidation et régénération de la session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Rediriger vers la page précédente ou la page d'accueil
        return redirect()->to($previousUrl)->with('success', 'Vous avez été déconnecté.');
    }
}
