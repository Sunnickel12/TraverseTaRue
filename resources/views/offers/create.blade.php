<!-- filepath: c:\Users\steve\OneDrive\Documentos\01 Cesi\01 CPI 2\Blocs\Web\Projet\Git\WebSite\TraverseTaRue\resources\views\offers\create.blade.php -->
@extends('layouts.navbar')

@section('title', 'Créer une Offre')

@section('content')
@role('admin|pilote')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-[#6e9ae6] text-3xl font-bold text-center mb-8 md:mb-10">Créer une Offre</h1>

    <!-- Bouton Retour -->
    <div class="text-center mb-4">
        <a href="{{ route('offers.index') }}" class="text-[#6e9ae6] hover:text-blue-400 font-semibold text-lg flex items-center justify-center space-x-2">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span>Retour à la liste des offres</span>
        </a>
    </div>

    <form action="{{ route('offers.store') }}" method="POST" class="bg-white p-8 rounded-lg shadow-xl border-2 border-[#3a3a3a] space-y-6">
        @csrf

        <!-- Titre de l'offre -->
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-[#3a3a3a]">Titre de l'offre</label>
            <input type="text" name="title" id="title" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" value="{{ old('title') }}" required>
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label for="contenu" class="block text-sm font-medium text-[#3a3a3a]">Description</label>
            <textarea name="contenu" id="contenu" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" required>{{ old('contenu') }}</textarea>
        </div>

        <!-- Salaire -->
        <div class="mb-4">
            <label for="salary" class="block text-sm font-medium text-[#3a3a3a]">Salaire (€)</label>
            <input type="number" name="salary" id="salary" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" value="{{ old('salary') }}" required>
        </div>

        <!-- Durée -->
        <div class="mb-4">
            <label for="duration" class="block text-sm font-medium text-[#3a3a3a]">Durée</label>
            <input type="text" name="duration" id="duration" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" value="{{ old('duration') }}" required>
        </div>

        <!-- Niveau -->
        <div class="mb-4">
            <label for="level" class="block text-sm font-medium text-[#3a3a3a]">Niveau</label>
            <input type="text" name="level" id="level" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" value="{{ old('level') }}" required>
        </div>

        <!-- Date de début -->
        <div class="mb-4">
            <label for="start_date" class="block text-sm font-medium text-[#3a3a3a]">Date de début</label>
            <input type="date" name="start_date" id="start_date" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" value="{{ old('start_date') }}" required>
        </div>

        <!-- Date de fin -->
        <div class="mb-4">
            <label for="end_date" class="block text-sm font-medium text-[#3a3a3a]">Date de fin</label>
            <input type="date" name="end_date" id="end_date" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" value="{{ old('end_date') }}">
        </div>

        <!-- Entreprise -->
        <div class="mb-4">
            <label for="company_id" class="block text-sm font-medium text-[#3a3a3a]">Entreprise</label>
            <select name="company_id" id="company_id" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" required>
                @foreach ($companies as $company)
                <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Ville -->
        <div class="mb-4">
            <label for="city_id" class="block text-sm font-medium text-[#3a3a3a]">Ville</label>
            <select name="city_id" id="city_id" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" required>
                @foreach ($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Bouton de soumission -->
        <div class="text-center">
            <button type="submit" class="bg-[#6e9ae6] text-white font-bold py-3 px-8 rounded-md hover:bg-blue-400 transition-all ease-in-out duration-300 transform hover:scale-105 focus:ring-4 focus:ring-[#6e9ae6]">
                Créer l'offre
            </button>
        </div>
    </form>
</div>
@endrole
@endsection