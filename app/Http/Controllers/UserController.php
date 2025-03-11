<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Display a listing of users (Read)
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Show the form for creating a new user (Create)
    public function create()
    {
        return view('users.create');
    }

    // Store a newly created user in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:47',
            'first_name' => 'required|max:35',
            'birthdate' => 'required|date',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'pp' => 'required|string|max:255',
            'id_classes' => 'required|integer',
            'id_role' => 'required|integer',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    // Display the specified user (Read)
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // Show the form for editing a user (Update)
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Update the specified user in the database (Update)
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|max:47',
            'first_name' => 'required|max:35',
            'birthdate' => 'required|date',
            'email' => 'required|email|unique:users,email,' . $user->id_users,
            'pp' => 'required|string|max:255',
            'id_classes' => 'required|integer',
            'id_role' => 'required|integer',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    // Delete the specified user from the database (Delete)
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}
