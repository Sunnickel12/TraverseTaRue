@extends('layouts.navbar')

@section('title', 'Users List')

@section('content')
@role('admin|pilote')
<div class="container mx-auto px-4 mt-8">
    <!-- Filters -->
    <form action="{{ route('users.index') }}" method="GET" class="mb-6 flex flex-col md:flex-row items-center gap-4 justify-center">
        @role('admin')
        <!-- Role Filter -->
        <select name="role" onchange="this.form.submit()" class="border border-[#3a3a3a] rounded-lg py-2 px-4 w-full md:w-auto md:flex-1 focus:outline-none focus:ring-2 focus:ring-[#6e9ae6]">
            <option value="">All Roles</option>
            @foreach($roles as $id => $name)
            <option value="{{ $id }}" {{ request('role') == $id ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
        @endrole

        <!-- Class Filter -->
        <select name="class" onchange="this.form.submit()" class="border border-[#3a3a3a] rounded-lg py-2 px-4 w-full md:w-auto md:flex-1 focus:outline-none focus:ring-2 focus:ring-[#6e9ae6]">
            <option value="">All Classes</option>
            @foreach($classes as $id => $name)
            <option value="{{ $id }}" {{ request('class') == $id ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>

        <!-- Search -->
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="border border-[#3a3a3a] rounded-lg py-2 px-4 w-full md:w-auto md:flex-1 focus:outline-none focus:ring-2 focus:ring-[#6e9ae6]" />
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

    <!-- Users Table -->
    <div class="overflow-x-auto">
    <table class="min-w-full table-auto bg-white border border-gray-300 shadow-md rounded-lg text-sm">
        <thead class="bg-[#3a3a3a] text-white">
            <tr>
                <th class="py-2 px-3 border text-left">Name</th>
                <th class="py-2 px-3 border text-left">Email</th>
                <th class="py-2 px-3 border text-left">Class</th>
                <th class="py-2 px-3 border text-left">Role</th>
                <th class="py-2 px-3 border text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="hover:bg-gray-100 transition duration-200">
                <td class="py-2 px-3 border whitespace-nowrap">{{ $user->getFullNameAttribute() }}</td>
                <td class="py-2 px-3 border">{{ $user->email }}</td>
                <td class="py-2 px-3 border">{{ $user->class->name ?? 'N/A' }}</td>
                <td class="py-2 px-3 border">{{ $user->roles->pluck('name')->join(', ') }}</td>
                <td class="py-2 px-3 border flex flex-col md:flex-row gap-2">
                    @if(!$user->roles->contains('name', 'admin') && $user->id !== auth()->id())
                    <a href="{{ route('users.edit', $user->id) }}"
                        class="bg-[#6e9ae6] hover:bg-blue-400 text-white font-bold py-1 px-3 rounded-lg shadow-md transition text-sm md:text-base lg:text-lg">
                        Edit
                    </a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-900 text-white font-bold py-1 px-3 rounded-lg shadow-md transition text-sm md:text-base lg:text-lg">
                            Delete
                        </button>
                    </form>
                    <a href="{{ route('users.dashboard', $user->id) }}"
                        class="bg-[#6e9ae6] hover:bg-blue-400 text-white font-bold py-1 px-3 rounded-lg shadow-md transition text-sm md:text-base lg:text-lg">
                        View
                    </a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-center">
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