@extends('layouts.app')

@section('title', 'Companies List')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Companies</h1>

    <div class="grid grid-cols-3 gap-6">
        @foreach($companies as $company)
        <a href="{{ route('companies.show', $company) }}">
            <div class="w-full h-40 overflow-hidden mb-4">
                <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}" class="w-full h-full object-cover">
            </div>
            <h2 class="text-xl font-semibold">{{ $company->name }}</h2>
            <p class="text-gray-600">{{ Str::limit($company->description, 100) }}</p>
        </a>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $companies->links() }}
    </div>
@endsection
