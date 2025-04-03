
@extends('layouts.navbar')

@section('title', 'Users List')

@section('content')
@role('admin|pilote')
    <div class="container mx-auto px-4 mt-8">

        <!-- Filters -->
        <form action="{{ route('users.index') }}" method="GET" class="mb-6 flex flex-col md:flex-row items-center gap-4 justify-center">
            @role('admin')
            <!-- Role Filter -->
            <select name="role" onchange="this.form.submit()" class="border border-[#3a3a3a] rounded-lg py-2 px-4 w-full md:w-1/4 focus:outline-none focus:ring-2 focus:ring-[#6e9ae6]">
                <option value="">All Roles</option>
                @foreach($roles as $id => $name)
                    <option value="{{ $id }}" {{ request('role') == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
            @endrole

            <!-- Class Filter -->
            <select name="class" onchange="this.form.submit()" class="border border-[#3a3a3a] rounded-lg py-2 px-4 w-full md:w-1/4 focus:outline-none focus:ring-2 focus:ring-[#6e9ae6]">
                <option value="">All Classes</option>
                @foreach($classes as $id => $name)
                    <option value="{{ $id }}" {{ request('class') == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>

            <!-- Search -->
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="border border-[#3a3a3a] rounded-lg py-2 px-4 w-full md:w-1/4 focus:outline-none focus:ring-2 focus:ring-[#6e9ae6]" />
        </form>

        <!-- Users Table -->
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
                        <tr class="hover:bg-gray-100 transition duration-200">
                            <td class="py-3 px-4 border">{{ $user->getFullNameAttribute() }}</td>
                            <td class="py-3 px-4 border">{{ $user->email }}</td>
                            <td class="py-3 px-4 border">{{ $user->class->name ?? 'N/A' }}</td>
                            <td class="py-3 px-4 border">{{ $user->roles->pluck('name')->join(', ') }}</td>
                            <td class="py-3 px-4 border flex gap-2">
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
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
@else
    <!-- Unauthorized Message -->
    <div class="text-center mt-10">
        <p class="text-red-500 font-bold text-2xl">You are not authorized to view this page.</p>
    </div>
@endif
@endsection