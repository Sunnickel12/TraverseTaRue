@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
@if(auth()->check() && auth()->user()->id_role === 1)
    <h1 class="text-3xl font-bold mb-6">Edit User</h1>

    <form action="{{ route('users.update', $user->id_users) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-2 gap-4">
            <input type="text" name="name" value="{{ $user->name }}" class="border p-2" required>
            <input type="text" name="first_name" value="{{ $user->first_name }}" class="border p-2" required>
            <input type="date" name="birthdate" value="{{ $user->birthdate }}" class="border p-2" required>
            <input type="email" name="email" value="{{ $user->email }}" class="border p-2" required>
            <input type="password" name="password" placeholder="New Password (optional)" class="border p-2">
            <input type="text" name="pp" value="{{ $user->pp }}" class="border p-2">
            <input type="number" name="id_classes" value="{{ $user->id_classes }}" class="border p-2" required>
            <input type="number" name="id_role" value="{{ $user->id_role }}" class="border p-2" required>
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg mt-4">Update</button>
    </form>
@else
<p class="text-red-500 font-bold">You are not authorized to view this page.</p>
@endif
@endsection