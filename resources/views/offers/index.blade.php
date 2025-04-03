@extends('layouts.navbar')

@section('title', 'Offres de Stage')

@section('content')
<!-- Section Recherche -->
<section id="search" class="py-6">
    <form method="GET" action="{{ route('offers.index') }}" class="max-w-lg mx-auto">
        <!-- Input et Bouton Rechercher -->
    </form>
</section>

<!-- Section des offres -->
<main class="px-4 max-w-7xl mx-auto">
    <h1 class="text-xl font-bold text-gray-700 text-center">
        {{ $totalOffers === 0 ? 'Aucune offre disponible.' : $totalOffers . ' Offres Disponibles !' }}
    </h1>
    <div class="grid gap-6 mt-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($offers as $offer)
        <div class="bg-white border border-gray-300 rounded-xl p-6 shadow-lg flex flex-col justify-between relative">
            <!-- Offer Title -->
            <h2 class="text-lg font-bold text-gray-800">
                <a href="{{ route('offers.show', ['offer' => $offer->id]) }}">{{ $offer->title }}</a>
            </h2>
            <!-- Publication Date -->
            <p class="text-sm text-gray-500">Publié il y a {{ $offer->created_at->diffForHumans() }}</p>

            <!-- Offer Details -->
            <div class="flex flex-wrap gap-2 mt-4">
                <span class="bg-[#6e9ae6] text-white text-sm px-3 py-1 rounded-lg">{{ $offer->level }}</span>
                <span class="bg-[#6e9ae6] text-white text-sm px-3 py-1 rounded-lg">{{ $offer->duration }}</span>
                <span class="bg-[#6e9ae6] text-white text-sm px-3 py-1 rounded-lg">{{ $offer->salary }} €/mois</span>
            </div>

            <!-- Heart for Wishlist -->
            
            <span 
                class=" heart absolute top-3 right-3 text-2xl cursor-pointer 'text-red-500' : 'text-gray-400' }}" 
                data-id="{{ $offer->id }}">
                ❤️
            </span>

            <!-- Company Logo -->
            <img 
                src="{{ asset('images/company/' . ($offer->company->logo_path ?? 'default-company.png')) }}" 
                alt="Logo de {{ $offer->company->name ?? 'Entreprise inconnue' }}" 
                class="h-12 w-auto object-contain mt-4">
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    @if ($offers->hasPages())
    <nav class="mt-6 flex justify-center">
        <ul class="flex items-center space-x-2">
            <!-- Pagination Navigation -->
        </ul>
    </nav>
    @endif
</main>
@endsection
