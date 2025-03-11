<?php

// app/Http/Controllers/ControlPanelController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ControlPanelController extends Controller
{
    public function index()
    {
        $user = \Illuminate\Support\Facades\Auth::user();

        if ($user->id_role == 1) {
            // Admin: Show all users and their roles
            $users = User::all();
            return view('control-panel.admin', compact('users'));
        }

        if ($user->id_role == 2) {
            // Professor: Show only students
            $students = User::with('class')->where('role_id', 3)->get();
            return view('control-panel.professor', compact('students'));
        }

        // Student: Show a welcome message
        return view('control-panel.student');
    }
    public function admin()
    {
        // Admin: Show all users and their roles
        $users = User::all();
        return view('control-panel.admin', compact('users'));
    }

    public function professor()
    {
        // Professor: Show only students
        $students = User::where('id_role', 3)->get();
        return view('control-panel.professor', compact('students'));
    }

    public function student()
    {
        // Student: Show a welcome message or any information
        return view('control-panel.student');
    }
}
