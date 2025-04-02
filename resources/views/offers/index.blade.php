@extends('layouts.navbar')

@section('title', 'Offres de Stage')

@section('content')
    <!-- Section Recherche -->
    <section id="search" class="py-6">
        <form method="GET" action="{{ route('offers.index') }}" class="max-w-lg mx-auto">
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="text" name="search" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Rechercher des offres..." value="{{ request('search') }}" />
                <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-[#6e9ae6] hover:bg-blue-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-4 py-2">Rechercher</button>
            </div>
        </form>
    </section>

    <!-- Section des offres -->
    <main class="px-4 max-w-5xl mx-auto">
        <h1 class="text-xl font-bold text-gray-700 text-center">{{ $offers->isEmpty() ? 'Aucune offre disponible.' : $offers->count() . ' Offres Disponibles !' }}</h1>

        <div class="grid gap-6 mt-6 sm:grid-cols-1 lg:grid-cols-1">
            @foreach ($offers as $offer)
            <div class="bg-white border border-gray-300 rounded-xl p-6 shadow-lg flex flex-col justify-between relative">
                <h2 class="text-lg font-bold text-gray-800"><a href="{{ route('offers.show', ['id' => $offer->id]) }}">{{ $offer->title }}</a></h2>
                <p class="text-sm text-gray-500">Publié il y a {{ $offer->publication_date }}</p>
                <div class="flex flex-wrap gap-2 mt-4">
                    <span class="bg-[#6e9ae6] text-white text-sm px-3 py-1 rounded-lg">{{ $offer->level }}</span>
                    <span class="bg-[#6e9ae6] text-white text-sm px-3 py-1 rounded-lg">{{ $offer->duration }}</span>
                    <span class="bg-[#6e9ae6] text-white text-sm px-3 py-1 rounded-lg">{{ $offer->salary }} €/mois</span>
                </div>
                <span class="absolute top-3 right-3 text-red-500 text-xl cursor-pointer" data-id="{{ $offer->id }}">♡</span>
                <img src="{{ asset('images/company/' . ($company->logo ?? 'default_logo.png')) }}" alt="Logo de {{ $offer->company->name ?? 'Entreprise inconnue' }}" class="h-12 w-auto object-contain mt-4">

            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if ($offers->hasPages())
        <nav class="mt-6 flex justify-center">
            <ul class="flex items-center space-x-2">
                @if ($offers->onFirstPage())
                    <li class="text-gray-400 px-3 py-1 border border-gray-400 rounded-lg cursor-not-allowed">Précédent</li>
                @else
                    <li><a href="{{ $offers->previousPageUrl() }}" class="px-3 py-1 border border-[#6e9ae6] text-[#6e9ae6] rounded-lg hover:bg-[#6e9ae6] hover:text-white">Précédent</a></li>
                @endif

                @foreach ($offers->links()->elements[0] as $page => $url)
                    <li>
                        <a href="{{ $url }}" class="px-3 py-1 border rounded-lg {{ $page == $offers->currentPage() ? 'bg-[#6e9ae6] text-white' : 'text-[#6e9ae6] border-[#6e9ae6] hover:bg-[#6e9ae6] hover:text-white' }}">{{ $page }}</a>
                    </li>
                @endforeach

                @if ($offers->hasMorePages())
                    <li><a href="{{ $offers->nextPageUrl() }}" class="px-3 py-1 border border-[#6e9ae6] text-[#6e9ae6] rounded-lg hover:bg-[#6e9ae6] hover:text-white">Suivant</a></li>
                @else
                    <li class="text-gray-400 px-3 py-1 border border-gray-400 rounded-lg cursor-not-allowed">Suivant</li>
                @endif
            </ul>
        </nav>
        @endif
    </main>
@endsection
