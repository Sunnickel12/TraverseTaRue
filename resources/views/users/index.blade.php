<!-- filepath: resources/views/users/index.blade.php -->

@extends('layouts.navbar')

@section('title', 'Users List')

@section('content')
@role('admin|pilote')
    <h1 class="text-3xl font-bold mb-6">Users</h1>

    <!-- Search Form -->
    <form action="{{ route('users.index') }}" method="GET" class="mb-6">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}" 
            placeholder="Search for users..." 
            class="border border-gray-300 rounded-lg py-2 px-4 w-full md:w-1/3"
        >
        <button 
            type="submit" 
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg mt-2 md:mt-0">
            Search
        </button>
    </form>
    
    @role('admin|pilote')
        <a href="{{ route('users.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg shadow-md mb-4 inline-block">+ Add User</a>
    @endrole

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
                    @role('admin')
                        <!-- Admin sees all users -->
                        <tr>
                            <td class="py-2 px-4 border">{{ $user->getFullNameAttribute() }}</td>
                            <td class="py-2 px-4 border">{{ $user->email }}</td>
                            <td class="py-2 px-4 border">{{ $user->class->name ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border">{{ $user->roles->pluck('name')->join(', ') }}</td>
                            <td class="py-2 px-4 border flex gap-2">
                                <!-- Admin cannot edit other admins or delete their own account -->
                                @if(!$user->hasRole('admin') && $user->id !== auth()->id())
                                    <a href="{{ route('users.edit', $user->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded">Edit</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @elserole('pilote')
                        <!-- Pilote sees only users with the role 'etudiant' -->
                        @if($user->hasRole('etudiant'))
                            <tr>
                                <td class="py-2 px-4 border">{{ $user->getFullNameAttribute() }}</td>
                                <td class="py-2 px-4 border">{{ $user->email }}</td>
                                <td class="py-2 px-4 border">{{ $user->class->name ?? 'N/A' }}</td>
                                <td class="py-2 px-4 border">{{ $user->roles->pluck('name')->join(', ') }}</td>
                                <td class="py-2 px-4 border">N/A</td>
                            </tr>
                        @endif
                    @endrole
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <!-- Etudiant sees unauthorized message -->
    <p class="text-red-500 font-bold">You are not authorized to view this page.</p>
@endif
@endsection