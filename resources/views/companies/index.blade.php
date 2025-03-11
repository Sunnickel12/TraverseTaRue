@extends('layouts.app')


@section('title', 'Home - Companies')

@section('content')
    <h1 class="text-4xl font-bold text-center mb-8">All Companies</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6 border-black p-8 mx-8">
     @foreach($companies as $company)
        <div class="border rounded-lg p-8 shadow-lg flex flex-col items-center border-black aspect-square">
                <!-- Image centered and circular -->
                <div class="w-24 h-24 mb-4">
                    <img src="{{ asset('public/' . $company->logo) }}" alt="Logo" class="w-full h-full object-cover rounded-full">
                </div>
                <h2 class="text-xl font-semibold">{{ $company->name }}</h2>
                <p><strong>Dirección:</strong> {{ $company->address }}</p>
                <p><strong>Description:</strong> {{ $company->description }}</p>
            </div>
        @endforeach
    </div>
@endsection
