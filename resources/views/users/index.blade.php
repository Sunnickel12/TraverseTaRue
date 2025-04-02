<!-- filepath: resources/views/users/index.blade.php -->

@extends('layouts.navbar')

@section('title', 'Users List')

@section('content')
@role('admin|pilote')
    <!-- Navbar -->
    <nav class="bg-[#ffff] local-font-gliker">
        <div>
            <!-- Main Title -->
            <h1 class="text-[#6e9ae6] text-3xl font-bold mt-4 text-center md:text-left md:text-5xl md:ml-6">
                Users</h1>
            <p class="bg-[#3a3a3a] text-[#ffff] text-sm py-3 text-center md:text-xl">
            </p>
        </div>
    </nav>

    <div class="container mx-auto px-4 mt-8">

        <!-- Search Form -->
        <form action="{{ route('users.index') }}" method="GET" class="mb-6 flex flex-col md:flex-row items-center gap-4 justify-center">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}" 
                placeholder="Search for users..." 
                class="border border-[#3a3a3a] rounded-lg py-2 px-4 w-full md:w-1/3 focus:outline-none focus:ring-2 focus:ring-[#6e9ae6]"
            >
            <button 
                type="submit" 
                class="bg-[#6e9ae6] hover:bg-[#5a85d1] text-white font-bold py-2 px-4 rounded-lg transition-all duration-300">
                Search
            </button>
        </form>

        @role('admin|pilote')
            <a href="{{ route('users.create') }}" 
               class="bg-[#6e9ae6] hover:bg-[#5a85d1] text-white font-bold py-2 px-4 rounded-lg shadow-md mb-4 inline-block transition-all duration-300 text-center">
                + Add User
            </a>
        @endrole

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Centered Table -->
        <div class="overflow-x-auto flex justify-center">
            <table class="min-w-full bg-white border border-gray-300 shadow-md rounded-lg">
                <thead class="bg-[#3a3a3a] text-white">
                    <tr>
                        <th class="py-3 px-4 border">Name</th>
                        <th class="py-3 px-4 border">Email</th>
                        <th class="py-3 px-4 border">Class</th>
                        <th class="py-3 px-4 border">Role</th>
                        <th class="py-3 px-4 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        @role('admin')
                            <!-- Admin sees all users -->
                            <tr class="hover:bg-gray-100 transition duration-200">
                                <td class="py-3 px-4 border">{{ $user->getFullNameAttribute() }}</td>
                                <td class="py-3 px-4 border">{{ $user->email }}</td>
                                <td class="py-3 px-4 border">{{ $user->class->name ?? 'N/A' }}</td>
                                <td class="py-3 px-4 border">{{ $user->roles->pluck('name')->join(', ') }}</td>
                                <td class="py-3 px-4 border flex gap-2">
                                    <!-- Admin cannot edit other admins or delete their own account -->
                                    @if(!$user->hasRole('admin') && $user->id !== auth()->id())
                                        <a href="{{ route('users.edit', $user->id) }}" 
                                           class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded transition-all duration-300">
                                            Edit
                                        </a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded transition-all duration-300">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @elserole('pilote')
                            <!-- Pilote sees only users with the role 'etudiant' -->
                            @if($user->hasRole('etudiant'))
                                <tr class="hover:bg-gray-100 transition duration-200">
                                    <td class="py-3 px-4 border">{{ $user->getFullNameAttribute() }}</td>
                                    <td class="py-3 px-4 border">{{ $user->email }}</td>
                                    <td class="py-3 px-4 border">{{ $user->class->name ?? 'N/A' }}</td>
                                    <td class="py-3 px-4 border">{{ $user->roles->pluck('name')->join(', ') }}</td>
                                    <td class="py-3 px-4 border">N/A</td>
                                </tr>
                            @endif
                        @endrole
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    <!-- Etudiant sees unauthorized message -->
    <div class="text-center mt-10">
        <p class="text-red-500 font-bold text-2xl">You are not authorized to view this page.</p>
    </div>
@endif
@endsection