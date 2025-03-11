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
            // Redirect user based on their role after successful login
            return $this->redirectUserBasedOnRole(Auth::user());
        }

        return back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
    }

    // Redirect user based on role after successful login
    protected function redirectUserBasedOnRole($user)
    {
        // Redirect Admin
        if ($user->id_role == 1) {
            return redirect()->route('control.panel.admin');
        }

        // Redirect Professor
        if ($user->id_role == 2) {
            return redirect()->route('control.panel.professor');
        }

        // Redirect Student (default)
        return redirect()->route('control.panel.student');
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
