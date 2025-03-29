@extends('layouts.app')

@section('title', 'Users List')

@section('content')
@if(auth()->check() && (auth()->user()->id_role === 1 || auth()->user()->id_role === 2))
    <h1 class="text-3xl font-bold mb-6">Users</h1>

    @if(auth()->check() && (auth()->user()->id_role === 1 || auth()->user()->id_role === 2))
        <a href="{{ route('users.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg shadow-md mb-4 inline-block">+ Add User</a>
    @endif

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 shadow-md">
            <thead>
                <tr>
                    <th class="py-2 px-4 border">Name</th>
                    <th class="py-2 px-4 border">Email</th>
                    <th class="py-2 px-4 border">Class</th>
                    <th class="py-2 px-4 border">Role</th>
                    <th class="py-2 px-4 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    @if(auth()->user()->id_role === 1 || (auth()->user()->id_role === 2 && $user->id_role === 3))
                        <tr>
                            <td class="py-2 px-4 border">{{ $user->getFullNameAttribute() }}</td>
                            <td class="py-2 px-4 border">{{ $user->email }}</td>
                            <td class="py-2 px-4 border">{{ $user->class->name ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border">{{ $user->role->name }}</td>
                            <td class="py-2 px-4 border flex gap-2">
                                <a href="{{ route('users.edit', $user->id_users) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded">Edit</a>
                                
                                @if(auth()->check() && (auth()->user()->id_role === 1 || auth()->user()->id_role === 2))
                                    <form action="{{ route('users.destroy', $user->id_users) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p>You are not authorized to view this page.</p>
@endif
@endsection
