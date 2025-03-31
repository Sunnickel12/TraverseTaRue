<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\ClassModel;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;


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
        $roles = Role::all(); // Fetch all roles from Laravel Permission
        $classes = ClassModel::all(); // Fetch all classes

        return view('users.create', compact('roles', 'classes'));
    }

    // Store a newly created user in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:47',
            'first_name' => 'required|max:35',
            'birthdate' => 'required|date',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'pp' => 'nullable|image|max:2048',
            'classes_id' => 'required|exists:classes,id', // Ensure the class exists
            'role' => 'required|exists:roles,name', // Ensure the role exists
        ]);

        // Restrict role assignment for 'pilote'
        if (Auth::user()->roles->contains('name', 'pilote') && $request->role !== 'etudiant') {
            return redirect()->back()->withErrors(['role' => 'Pilotes can only assign the role "etudiant".']);
        }

        // Handle profile picture upload
        $data = $request->all();
        if ($request->hasFile('pp')) {
            $file = $request->file('pp');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename); // Save in public/images
            $data['pp'] = $filename;
        }

        // Create the user
        $user = User::create([
            'name' => $data['name'],
            'first_name' => $data['first_name'],
            'birthdate' => $data['birthdate'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'pp' => $data['pp'] ?? null,
            'classes_id' => $data['classes_id'],
        ]);

        // Assign the selected role to the user
        $user->assignRole($data['role']);

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
        // Fetch all roles and classes
        $roles = Role::all(); // Fetch all roles from Laravel Permission
        $classes = ClassModel::all(); // Fetch all classes from the database

        return view('users.edit', compact('user', 'roles', 'classes'));
    }

    // Update the specified user in the database (Update)
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|max:47',
            'first_name' => 'required|max:35',
            'birthdate' => 'required|date',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
            'pp' => 'nullable|image|max:2048',
            'classes_id' => 'required|exists:classes,id', // Ensure the class exists
            'role' => 'required|exists:roles,name', // Ensure the role exists
        ]);

        // Handle profile picture upload
        $data = $request->all();
        if ($request->hasFile('pp')) {
            $file = $request->file('pp');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename); // Save in public/images
            $data['pp'] = $filename;
        }

        // Update the user's details
        $user->update([
            'name' => $data['name'],
            'first_name' => $data['first_name'],
            'birthdate' => $data['birthdate'],
            'email' => $data['email'],
            'password' => $data['password'] ? bcrypt($data['password']) : $user->password,
            'pp' => $data['pp'] ?? $user->pp,
            'classes_id' => $data['classes_id'],
        ]);

        // Reassign the selected role to the user
        $user->syncRoles([$data['role']]);

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    // Delete the specified user from the database (Delete)
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}
