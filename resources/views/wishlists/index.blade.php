@extends('layouts.navbar')

@section('title', 'Ma Wishlist')

@section('content')

<!-- Liens de navigation (Menu commun) -->
<div class="menu flex space-x-8 text-lg font-bold mb-6 ml-16 mt-6">
    <a href="{{ route('wishlists.index') }}" class="{{ request()->routeIs('wishlists.index') ? 'text-black border-b-2 border-black' : 'text-gray-600 hover:text-[#6e9ae6] hover:border-b-2 hover:border-[#6e9ae6]' }}">
        Mes favoris
    </a>
    <a href="{{ route('wishlists.show') }}" class="{{ request()->routeIs('wishlists.show') ? 'text-black border-b-2 border-black' : 'text-gray-600 hover:text-[#6e9ae6] hover:border-b-2 hover:border-[#6e9ae6]' }}">
        Mes candidatures
    </a>
</div>


<!-- Contenu principal -->
<div class="container mx-auto p-6">
    <h1 class="text-4xl font-semibold text-center mb-6">Ma Wishlist</h1>
    
    <div class="flex justify-center space-x-4 mb-6">
        <button class="bg-gray-200 px-4 py-2 rounded-lg shadow hover:bg-gray-300">⚙ Gérer mes favoris</button>
        <a href= "{{ route('offers.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">❤️ Ajouter un coup de cœur</a>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($wishlistedOffers as $offer)
            <div class="relative border rounded-lg shadow-md overflow-hidden bg-white">
                <img src="{{ asset($offer->logo_path) }}" alt="Logo de {{ $offer->company?->name ?? 'Entreprise inconnue' }}" class="w-full h-40 object-cover">
                <div class="p-4">
                    <h2 class="text-lg font-bold text-gray-800">{{ $offer->title }}</h2>
                    <p class="text-sm text-gray-500">{{ $offer->company->name ?? 'Entreprise inconnue' }}</p>
                </div>
                <span class="absolute top-2 right-2 text-2xl text-red-500 cursor-pointer">❤️</span>
            </div>
        @endforeach
    </div>
</div>

@endsection
