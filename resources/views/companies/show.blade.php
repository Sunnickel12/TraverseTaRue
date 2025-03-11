@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6">
        <!-- Company Details -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold">{{ $company->name }}</h1>
            <div class="w-48 h-48 mx-auto mt-4">
                <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" class="w-full h-full object-cover rounded-full">
            </div>
            <p class="mt-4"><strong>Dirección:</strong> {{ $company->address }}</p>
            <p class="mt-2"><strong>Description:</strong> {{ $company->description }}</p>
        </div>

        <!-- Additional Information (Optional) -->
        <div class="mt-8">
            <h2 class="text-2xl font-semibold">More Information</h2>
            <p><strong>Location:</strong> {{ $company->location }}</p>
            <p><strong>Contact:</strong> {{ $company->contact_email }}</p>
        </div>

        <!-- Back to All Companies -->
        <div class="mt-8">
            <a href="{{ route('companies.index') }}" class="bg-blue-500 text-white py-2 px-4 rounded-lg">Back to All Companies</a>
        </div>
    </div>
@endsection
