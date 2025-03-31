
@extends('layouts.navbar')

@section('title', 'Companies List')

@section('content')
<h1 class="text-3xl font-bold mb-6">Companies</h1>

<!-- Search Form -->
<form action="{{ route('companies.index') }}" method="GET" class="mb-6">
    <input 
        type="text" 
        name="search" 
        value="{{ request('search') }}" 
        placeholder="Search for companies..." 
        class="border border-gray-300 rounded-lg py-2 px-4 w-full md:w-1/3"
    >
    <button 
        type="submit" 
        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg mt-2 md:mt-0">
        Search
    </button>
</form>

<!-- Check if the user has the "admin" or "manager" role -->
@role('admin|manager')
<a href="{{ route('companies.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
    + Create Company
</a>
@endrole

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
    @foreach($companies as $company)
    <div class="border border-gray-300 p-4 rounded-lg hover:shadow-lg transition flex flex-col">
        <!-- Clickable image -->
        <a href="{{ route('companies.show', $company->id) }}" class="w-full h-40 overflow-hidden mb-4 block">
            <img src="{{ asset('images/' . $company->logo) }}" alt="{{ $company->name }}" class="w-full h-full object-cover rounded-md">
        </a>

        <!-- Clickable text -->
        <a href="{{ route('companies.show', $company->id) }}" class="block">
            <h2 class="text-xl font-semibold">{{ $company->name }}</h2>
        </a>
        <a href="{{ route('companies.show', $company->id) }}" class="block">
            <p class="text-gray-600">{{ Str::limit($company->description, 100) }}</p>
        </a>

        <!-- Check if the user has the "admin" or "manager" role -->
        @role('admin')
        <div class="mt-4 flex justify-between gap-2">
            <div>
                <a href="{{ route('companies.edit', $company->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition block">
                    Edit
                </a>
            </div>
            <div>
                <form action="{{ route('companies.destroy', $company->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this company?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition block">
                        Delete
                    </button>
                </form>
            </div>
        </div>
        @endrole
    </div>
    @endforeach
</div>

<div class="mt-8">
    {{ $companies->links() }}
</div>
@endsection