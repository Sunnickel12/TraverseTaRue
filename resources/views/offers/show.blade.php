@extends('layouts.navbar') 

@section('title', $offer->title) 

@section('content')
<div class="px-4 max-w-5xl mx-auto">
    <!-- Banner Section -->
    <div class="banner-plane">
        <img src="{{ asset('images/site/banner2.png') }}" alt="banner" class="w-full rounded-lg shadow-md border border-gray-300">
    </div>

    @role('admin|etudiant') 
    <!-- Wishlist Section for admin and etudiant roles -->
    <div class="mt-4">
        @if ($offer->isInWishlist())
        <!-- Display if the offer is already in the wishlist -->
        <button type="button" class="bg-green-500 text-black px-4 py-2 rounded-md shadow-md cursor-not-allowed">
            Déjà dans la wishlist!
        </button>
        <!-- Remove from wishlist button -->
        <form method="POST" action="{{ route('wishlist.remove') }}" class="inline-block">
            @csrf
            @method('DELETE')
            <input type="hidden" name="offer_id" value="{{ $offer->id }}">
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-red-600 transition">
                Retirer de la wishlist
            </button>
        </form>
        @else
        <!-- Add to wishlist button -->
        <form method="POST" action="{{ route('wishlist.add') }}" class="inline-block">
            @csrf
            <input type="hidden" name="offer_id" value="{{ $offer->id }}">
            <button type="submit" class="bg-[#6e9ae6] text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-400 transition">
                Ajouter à la wishlist
            </button>
        </form>
        @endif
    </div>
    @endrole

    <!-- Offer Details Section -->
    <section id="job-detail" class="p-4">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">{{ $offer->title }}</h3>
        <p class="text-sm text-gray-500">Publié {{ $offer->created_at->diffForHumans(['locale' => 'fr']) }}</p>
        <p class="text-sm text-gray-500">Par : {{ $offer->company->name }}</p>

        <!-- Offer Characteristics -->
        <div class="flex flex-wrap gap-2 mt-4">
            <span class="bg-[#6e9ae6] text-white text-sm px-3 py-1 rounded-lg">{{ $offer->level }}</span>
            <span class="bg-[#6e9ae6] text-white text-sm px-3 py-1 rounded-lg">{{ $offer->duration }}</span>
            <span class="bg-[#6e9ae6] text-white text-sm px-3 py-1 rounded-lg">{{ $offer->salary ?? 'Salaire à définir' }} €/mois</span>
            <span class="bg-[#6e9ae6] text-white text-sm px-3 py-1 rounded-lg">{{ $offer->city->name }}</span>
        </div>

        <!-- Job Description -->
        <div class="job-description mt-6">
            <h4 class="text-lg font-semibold text-gray-800">Description du poste :</h4>
            <p class="text-gray-700 mt-2">{{ $offer->contenu }}</p>
        </div>

        <!-- Job Requirements -->
        <div class="job-requirements mt-6">
            <h4 class="text-lg font-semibold text-gray-800">Conditions :</h4>
            <ul class="list-disc list-inside text-gray-700 mt-2">
                <li>Stage de {{ $offer->duration }}</li>
                <li>Début du stage : {{ \Carbon\Carbon::parse($offer->start_date)->translatedFormat('d F Y') }}</li>
                <li>Ubication : {{ $offer->city->name }}</li>
                <li>Rémuniteation : {{ $offer->salary }} €/mois</li>
                <li>Skills : {{ $offer->skills->pluck('name')->join(', ') }}</li>
            </ul>
        </div>

        <!-- Apply Button Section -->
        <div class="mt-6">
            @auth
            @role('admin|etudiant')
            <!-- Show "Postuler" button for admin and etudiant roles -->
            <a href="{{ route('postulations.create', ['offer' => $offer->id]) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-600 transition">
                Postuler
            </a>
            @elserole('pilote')
            <!-- Message for pilote role -->
            <p class="text-red-500 font-bold">You can't postulate to an offer.</p>
            @else
            <!-- Message for other authenticated users -->
            <p class="text-gray-500">You are not authorized to postulate for this offer.</p>
            @endrole
            @else
            <!-- Login prompt for unauthenticated users -->
            <a href="{{ route('login') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-gray-600 transition">
                Connectez-vous pour postuler
            </a>
            @endauth
        </div>

        @if (session('error'))
        <!-- Error message display -->
        <div class="bg-red-500 text-white p-4 rounded-md mb-4">
            {{ session('error') }}
        </div>
        @endif
</div>
@endsection