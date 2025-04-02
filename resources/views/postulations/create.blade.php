@extends('layouts.navbar')

@section('title', 'Postuler pour : ' . $offer->title)

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-[#6e9ae6] text-3xl font-bold text-center mb-8">Postuler pour : {{ $offer->title }}</h1>

    <!-- Bouton Retour -->
    <div class="text-center mb-4">
        <a href="{{ route('offers.index') }}" class="text-[#6e9ae6] hover:text-blue-400 font-semibold text-lg flex items-center justify-center space-x-2">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span>Retour à la liste des offres</span>
        </a>
    </div>

    <form action="{{ route('postulation.store', ['id' => $offer->id]) }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-xl border-2 border-[#3a3a3a] space-y-6">
        @csrf

        <!-- Prénom -->
        <div class="mb-4">
            <label for="prenom" class="block text-sm font-medium text-[#3a3a3a]">Prénom</label>
            <input type="text" id="prenom" name="prenom" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" required>
        </div>

        <!-- Nom -->
        <div class="mb-4">
            <label for="nom" class="block text-sm font-medium text-[#3a3a3a]">Nom</label>
            <input type="text" id="nom" name="nom" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" required>
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="mail" class="block text-sm font-medium text-[#3a3a3a]">Email</label>
            <input type="email" id="mail" name="mail" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" required>
        </div>

        <!-- CV -->
        <div class="mb-4">
            <label for="cv" class="block text-sm font-medium text-[#3a3a3a]">CV</label>
            <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" required>
        </div>

        <!-- Lettre de motivation -->
        <div class="mb-4">
            <label for="motivation" class="block text-sm font-medium text-[#3a3a3a]">Lettre de motivation</label>
            <input type="file" id="motivation" name="motivation" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300">
        </div>

        <!-- Boutons d'action -->
        <div class="text-center">
            <button type="submit" class="bg-[#6e9ae6] text-white font-bold py-3 px-8 rounded-md hover:bg-blue-400 transition-all ease-in-out duration-300 transform hover:scale-105 focus:ring-4 focus:ring-[#6e9ae6]">
                Envoyer
            </button>
        </div>
    </form>
</div>
@endsection
