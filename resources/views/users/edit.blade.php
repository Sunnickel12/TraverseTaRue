@extends('layouts.navbar')

@section('title', 'Edit User')

@section('content')
@role('admin')
    <h1 class="text-3xl font-bold mb-6">Edit User</h1>

    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-2 gap-4">
            <input type="text" name="name" value="{{ $user->name }}" class="border p-2" required>
            <input type="text" name="first_name" value="{{ $user->first_name }}" class="border p-2" required>
            <input type="date" name="birthdate" value="{{ $user->birthdate }}" class="border p-2" required>
            <input type="email" name="email" value="{{ $user->email }}" class="border p-2" required>
            <input type="password" name="password" placeholder="New Password (optional)" class="border p-2">
            <input type="file" name="pp" accept="image/*" class="border p-2">

            <!-- Dropdown for Classes -->
            <select name="classes_id" class="border p-2" required>
                <option value="" disabled>Select Class</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}" {{ $user->classes_id == $class->id ? 'selected' : '' }}>
                        {{ $class->name }}
                    </option>
                @endforeach
            </select>

            <!-- Dropdown for Roles -->
            <select name="role" class="border p-2" required>
                <option value="" disabled>Select Role</option>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}" {{ $user->getRoleNames()->first() == $role->name ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg mt-4">Update</button>
    </form>
@else
<p class="text-red-500 font-bold">You are not authorized to view this page.</p>
@endrole
@endsection