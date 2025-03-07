@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6 cente">All Companies</h1>

    <!-- Grid to display companies in boxes -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($companies as $company)
            <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-xl transition-shadow">
                <h2 class="text-xl font-semibold mb-2">{{ $company->name }}</h2>
                <p><strong>Direccion:</strong> {{ $company->address }}</p>
                <p><strong>Logo:</strong> <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" class="w-24 h-24 object-cover mt-2 mb-2 rounded-md"></p>
                <p><strong>Description:</strong> {{ $company->description }}</p>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $companies->links('pagination::tailwind') }}
    </div>
@endsection
