@extends('layouts.navbar')

@section('title', 'Ma Wishlist')

@section('content')
<main>
    <!-- Liens de navigation -->
    <div class="menu flex space-x-8 text-lg font-bold mb-6 ml-16 mt-6">
        <a href="{{ route('wishlists.index') }}" class="{{ request()->routeIs('wishlists.index') ? 'text-black border-b-2 border-black' : 'text-gray-600 hover:text-[#6e9ae6] hover:border-b-2 hover:border-[#6e9ae6]' }}">
            Mes favoris
        </a>
        <a href="{{ route('wishlists.candidatures') }}" class="{{ request()->routeIs('wishlists.candidatures') ? 'text-black border-b-2 border-black' : 'text-gray-600 hover:text-[#6e9ae6] hover:border-b-2 hover:border-[#6e9ae6]' }}">
            Mes candidatures
        </a>
    </div>

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold text-center mb-6">Ma Wishlist</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($wishlistedOffers as $offer)
                <div class="job p-4 border rounded-lg shadow-md relative">  <!-- Ajout de relative -->
                    
                    <!-- Icône Cœur en haut à droite -->
                    <span 
                        class="heart absolute top-2 right-2 text-2xl cursor-pointer text-red-500" 
                        data-id="{{ $offer->id }}">
                        ❤️
                    </span>

                    <h2 class="text-xl font-semibold">
                        <a href="{{ route('offers.show', ['offer' => $offer->id]) }}">{{ $offer->title }}</a>
                    </h2>
                    <p class="text-sm text-gray-500">Publié il y a {{ $offer->created_at->diffForHumans() }}</p>

                    <div class="characteristics">
                        <button class="toutes">{{ $offer->niveau }}</button>
                        <button class="toutes">{{ $offer->duree }}</button>
                        <button class="toutes">{{ $offer->salary }} €/mois</button>
                    </div>

                    <img src="{{ asset($offer->company->logo ?? 'default-logo.png') }}" alt="Logo de {{ $offer->company->name ?? 'Entreprise inconnue' }}" class="job-logo mt-4">
                </div>
            @endforeach
        </div>
    </div>
</main>
@endsection
