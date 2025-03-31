<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
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
            // Rediriger vers la page où l'utilisateur était avant de se connecter
            return redirect()->to(url()->previous())->with('success', 'Connexion réussie.');
        }

        // Si la connexion échoue
        return back()->withErrors(['error' => 'Identifiant ou mot de passe incorrect.'])->withInput();
    }
    
    // Déconnexion de l'utilisateur et redirection vers la page d'accueil
    public function logout(Request $request)
    {
        $previousUrl = url()->previous();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->to($previousUrl)->with('success', 'Vous avez été déconnecté.');
    }
}
