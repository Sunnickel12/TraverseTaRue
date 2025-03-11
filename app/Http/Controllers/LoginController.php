<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login logic
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard')->with('success', 'You are logged in!');
        }

        return back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
    }

    // Logout function
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logged out successfully.');
    }

    // Show dashboard (for logged-in users)
    public function dashboard()
    {
        return view('dashboard');
    }
}
