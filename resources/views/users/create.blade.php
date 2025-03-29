@extends('layouts.app')

@section('title', 'Create User')

@section('content')
@if(auth()->check() && auth()->user()->id_role === 1)
    <h1 class="text-3xl font-bold mb-6">Create User</h1>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <input type="text" name="name" placeholder="Last Name" class="border p-2" required>
            <input type="text" name="first_name" placeholder="First Name" class="border p-2" required>
            <input type="date" name="birthdate" class="border p-2" required>
            <input type="email" name="email" placeholder="Email" class="border p-2" required>
            <input type="password" name="password" placeholder="Password" class="border p-2" required>
            <input type="file" name="pp" accept="image/*">
            <input type="number" name="id_classes" placeholder="Class ID" class="border p-2" required>
            <input type="number" name="id_role" placeholder="Role ID" class="border p-2" required>
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg mt-4">Create</button>
    </form>
@else
<p class="text-red-500 font-bold">You are not authorized to view this page.</p>
@endif
@endsection