@extends('layouts.navbar')

@section('title', $offer->title)

@section('content')
<div class="px-4 max-w-5xl mx-auto">
    <!-- Banner -->
    <div class="banner-plane">
        <img src="{{ asset('images/site/banner2.png') }}" alt="banner" class="w-full rounded-lg shadow-md border border-gray-300">
    </div>

    <!-- Offer Details -->
    <section id="job-detail" class="p-4">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">{{ $offer->title }}</h3>
        <p class="text-sm text-gray-500">Publié {{ $offer->created_at->diffForHumans(['locale' => 'fr']) }}</p>

        <!-- Characteristics -->
        <div class="flex flex-wrap gap-2 mt-4">
            <span class="bg-[#6e9ae6] text-white text-sm px-3 py-1 rounded-lg">{{ $offer->level }}</span>
            <span class="bg-[#6e9ae6] text-white text-sm px-3 py-1 rounded-lg">{{ $offer->duration }}</span>
            <span class="bg-[#6e9ae6] text-white text-sm px-3 py-1 rounded-lg">{{ $offer->salary ?? 'Salaire à définir' }} €/mois</span>
            <span class="bg-[#6e9ae6] text-white text-sm px-3 py-1 rounded-lg">{{ $offer->category ?? 'Informatique' }}</span>
        </div>

        <!-- Job Description -->
        <div class="job-description mt-6">
            <h4 class="text-lg font-semibold text-gray-800">Description du poste :</h4>
            <p class="text-gray-700 mt-2">{{ $offer->contenu }}</p>
        </div>

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

        <!-- Apply Button -->
        <div class="mt-6">
            @auth
            <a href="{{ route('postulations.create', $offer->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-600 transition">
                Postuler
            </a>
            @else
            <a href="{{ route('login') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-gray-600 transition">
                Connectez-vous pour postuler
            </a>
            @endauth
        </div>

        @if (session('error'))
        <div class="bg-red-500 text-white p-4 rounded-md mb-4">
            {{ session('error') }}
        </div>
        @endif
</div>
@endsection