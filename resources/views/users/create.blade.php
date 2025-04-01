<!-- filepath: resources/views/users/create.blade.php -->

@extends('layouts.navbar')

@section('title', 'Create User')

@section('content')
@role('admin|pilote')
<h1 class="text-3xl font-bold mb-6">Create User</h1>

<form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-2 gap-4">
        <input type="text" name="name" placeholder="Last Name" class="border p-2" required>
        <input type="text" name="first_name" placeholder="First Name" class="border p-2" required>
        <input type="date" name="birthdate" class="border p-2" required>
        <input type="email" name="email" placeholder="Email" class="border p-2" required>
        <input type="password" name="password" placeholder="Password" class="border p-2" required>
        <input type="file" name="pp" accept="image/*" class="border p-2">

        <!-- Dropdown for Classes -->
        <select name="classes_id" class="border p-2" required>
            <option value="" disabled selected>Select Class</option>
            @foreach($classes as $class)
                <option value="{{ $class->id }}">{{ $class->name }}</option>
            @endforeach
        </select>

        <!-- Dropdown for Roles -->
        <select name="role" class="border p-2" required>
            <option value="" disabled selected>Select Role</option>
            @if(auth()->user()->hasRole('admin'))
                @foreach($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            @elseif(auth()->user()->hasRole('pilote'))
                <option value="etudiant">etudiant</option>
            @endif
        </select>
    </div>
    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg mt-4">Create</button>
</form>
@else
<p class="text-red-500 font-bold">You are not authorized to view this page.</p>
@endrole
@endsection