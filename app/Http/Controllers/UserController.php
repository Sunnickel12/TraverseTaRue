<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\ClassModel;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
// Removed incorrect Log import
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Traits\HasRoles;


class UserController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');
        $currentUser = Auth::user();

        // Fetch roles and classes for filters
        $roles = Role::pluck('name', 'id'); // Fetch all roles
        $classes = ClassModel::pluck('name', 'id'); // Fetch all classes

        $query = User::query();

        if ($currentUser->roles->contains('name', 'admin')) {
            // Admin sees all users and can filter by role, class, or search
            $query->with('roles', 'class');

            if ($request->filled('role')) {
                $query->whereHas('roles', function ($q) use ($request) {
                    $q->where('id', $request->role);
                });
            }
        } elseif ($currentUser->roles->contains('name', 'pilote')) {
            // Pilote sees only users with the role 'etudiant' and can filter by class or search
            $query->whereHas('roles', function ($q) {
                $q->where('name', 'etudiant');
            })->with('roles', 'class');
        } else {
            // Etudiant sees nothing
            return view('users.index')->with('unauthorized', true);
        }

        // Apply class filter
        if ($request->filled('class')) {
            $query->where('classes_id', $request->class); // Use the classes_id column directly
        }

        // Apply search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('first_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhereHas('class', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Fetch filtered users
        $users = $query->paginate(10);

        return view('users.index', compact('users', 'roles', 'classes'));
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
    public function edit($id)
    {
        $currentUser = Auth::user();
        $user = User::findOrFail($id);

        // Restrict access for pilotes
        if ($currentUser->roles->contains('name', 'pilote') && !$user->roles->contains('name', 'etudiant')) {
            return redirect()->route('users.index')->with('error', 'Vous n\'êtes pas autorisé à modifier cet utilisateur.');
        }

        // Fetch roles and classes for the dropdowns
        $roles = Auth::user()->roles->contains('name', 'pilote')
            ? Role::where('name', 'etudiant')->get()
            : Role::all();
        $classes = ClassModel::all();

        return view('users.edit', compact('user', 'roles', 'classes'));
    }

    // Update the specified user in the database (Update)
    public function update(Request $request, $id)
    {
        $currentUser = Auth::user();
        $user = User::findOrFail($id);

        // Restrict access for pilotes
        if ($currentUser->roles->contains('name', 'pilote') && !$user->roles->contains('name', 'etudiant')) {
            return redirect()->route('users.index')->with('error', 'Vous n\'êtes pas autorisé à modifier cet utilisateur.');
        }

        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'classes_id' => 'required|exists:classes,id',
            'role' => 'required|exists:roles,name',
        ]);
        try {
            // Update user details
            $user->name = $validatedData['name'];
            $user->first_name = $validatedData['first_name'];
            $user->birthdate = $validatedData['birthdate'];
            $user->email = $validatedData['email'];
            $user->classes_id = $validatedData['classes_id'];

            // Update password if provided
            if (!empty($validatedData['password'])) {
                $user->password = bcrypt($validatedData['password']);
            }

            // Update profile picture if provided
            if ($request->hasFile('pp')) {
                $file = $request->file('pp');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images/users'), $filename);
                $user->pp = $filename;
            }

            // Update role
            $user->syncRoles([$validatedData['role']]);

            $user->save();

            return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error updating user: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la mise à jour de l\'utilisateur.');
        }
    }

    // Delete the specified user from the database (Delete)
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Prevent the currently authenticated user from deleting themselves
        if ($user->id === optional(auth())->id) {
            return redirect()->route('users.index')->with('error', 'You cannot delete your own account.');
        }

        $user->delete(); // Perform a soft delete

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore(); // Restore the soft-deleted user

        return redirect()->route('users.index')->with('success', 'User restored successfully.');
    }

    public function dashboard(Request $request, $id = null)
    {
        $authUser = Auth::user();

        // Role-based access control
        if ($authUser->roles->contains('name', 'admin')) {
            // Admin can see their own profile or any user's profile
            if ($id === null || $id == $authUser->id) {
                $user = $authUser;
            } else {
                $user = User::findOrFail($id);
            }
        } elseif ($authUser->roles->contains('name', 'pilote')) {
            // Pilote can see their own profile and all "etudiant" users
            if ($id === null || $id == $authUser->id) {
                $user = $authUser;
            } else {
                $user = User::where('id', $id)->whereHas('roles', function ($query) {
                    $query->where('name', 'etudiant');
                })->firstOrFail();
            }
        } elseif ($authUser->roles->contains('name', 'etudiant')) {
            // Etudiant can only see their own profile
            if ($id === null || $id == $authUser->id) {
                $user = $authUser;
            } else {
                abort(403, 'You are not authorized to view this profile.');
            }
        } else {
            abort(403, 'You are not authorized to view this profile.');
        }

        // Fetch postulations for the user with pagination
        $postulations = $user->postulations()->with('offer', 'status')->paginate(5, ['*'], 'postulations_page');

        // Fetch wishlist offers for the user with pagination
        $wishlistOffers = $user->wishlist ? $user->wishlist->offers()->with('company')->paginate(5, ['*'], 'wishlist_page') : collect();

        return view('users.dashboard', compact('user', 'postulations', 'wishlistOffers'));
    }
}
