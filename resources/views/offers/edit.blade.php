<!-- filepath: c:\Users\steve\OneDrive\Documentos\01 Cesi\01 CPI 2\Blocs\Web\Projet\Git\WebSite\TraverseTaRue\resources\views\offers\edit.blade.php -->
@extends('layouts.navbar')

@section('content')
@role('admin|pilote')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-[#6e9ae6] text-3xl font-bold text-center mb-8 md:mb-10">Éditer une offre</h1>

    <!-- Bouton Retour -->
    <div class="text-center mb-4">
        <a href="{{ route('offers.index') }}" class="text-[#6e9ae6] hover:text-blue-400 font-semibold text-lg inline-flex items-center justify-center px-4 py-2 space-x-2 border border-[#6e9ae6] rounded-md hover:bg-blue-50 transition-all duration-300">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span>Retour à la liste des offres</span>
        </a>
    </div>

    <form action="{{ route('offers.update', $offer->id) }}" method="POST" class="bg-white p-8 rounded-lg shadow-xl border-2 border-[#3a3a3a] space-y-6">
        @csrf
        @method('PUT')

        <!-- Titre de l'offre -->
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-[#3a3a3a]">Titre de l'offre</label>
            <input type="text" name="title" id="title" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" value="{{ $offer->title }}" required>
            @error('title')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Contenu -->
        <div class="mb-4">
            <label for="contenu" class="block text-sm font-medium text-[#3a3a3a]">Description</label>
            <textarea name="contenu" id="contenu" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" required>{{ $offer->contenu }}</textarea>
            @error('contenu')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Salaire -->
        <div class="mb-4">
            <label for="salary" class="block text-sm font-medium text-[#3a3a3a]">Salaire (€)</label>
            <input type="number" name="salary" id="salary" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" value="{{ $offer->salary }}" required>
            @error('salary')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Durée -->
        <div class="mb-4">
            <label for="duration" class="block text-sm font-medium text-[#3a3a3a]">Durée</label>
            <select name="duration" id="duration" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" required>
                <option value="" disabled>Choisissez une durée</option>
                <option value="2 weeks" {{ $offer->duration == '2 weeks' ? 'selected' : '' }}>2 semaines</option>
                <option value="1 month" {{ $offer->duration == '1 month' ? 'selected' : '' }}>1 mois</option>
                <option value="2 months" {{ $offer->duration == '2 months' ? 'selected' : '' }}>2 mois</option>
                <option value="3 months" {{ $offer->duration == '3 months' ? 'selected' : '' }}>3 mois</option>
                <option value="4 months" {{ $offer->duration == '4 months' ? 'selected' : '' }}>4 mois</option>
                <option value="6 months" {{ $offer->duration == '6 months' ? 'selected' : '' }}>6 mois</option>
            </select>
            @error('duration')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Compétences -->
        <div class="mb-4">
            <label for="skills" class="block text-sm font-medium text-[#3a3a3a]">Compétences</label>
            <select name="skills[]" id="skills" class="select2 mt-1 block w-full p-2 border border-gray-300 rounded-md" multiple>
                @foreach ($skills as $id => $skill)
                <option value="{{ $id }}" {{ in_array($id, $offer->skills->pluck('id')->toArray()) ? 'selected' : '' }}>
                    {{ $skill }}
                </option>
                @endforeach
            </select>
            @error('skills')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Niveau -->
        <div class="mb-4">
            <label for="level" class="block text-sm font-medium text-[#3a3a3a]">Niveau</label>
            <input type="text" name="level" id="level" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" value="{{ $offer->level }}" required>
            @error('level')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Date de début -->
        <div class="mb-4">
            <label for="start_date" class="block text-sm font-medium text-[#3a3a3a]">Date de début</label>
            <input type="date" name="start_date" id="start_date" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" value="{{ $offer->start_date }}" required>
            @error('start_date')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Date de fin -->
        <div class="mb-4">
            <label for="end_date" class="block text-sm font-medium text-[#3a3a3a]">Date de fin</label>
            <input type="date" name="end_date" id="end_date" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" value="{{ $offer->end_date }}">
            @error('end_date')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Entreprise -->
        <div class="mb-4">
            <label for="company_id" class="block text-sm font-medium text-[#3a3a3a]">Entreprise</label>
            <select name="company_id" id="company_id" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" required>
                @foreach ($companies as $company)
                <option value="{{ $company->id }}" {{ $offer->company_id == $company->id ? 'selected' : '' }}>
                    {{ $company->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Bouton de soumission -->
        <div class="text-center">
            <button type="submit" class="bg-[#6e9ae6] text-white font-bold py-3 px-8 rounded-md hover:bg-blue-400 transition-all ease-in-out duration-300 transform hover:scale-105 focus:ring-4 focus:ring-[#6e9ae6]">
                Mettre à jour
            </button>
        </div>
    </form>
</div>

@else
<p class="text-red-500 font-bold text-center">Vous n'êtes pas autorisé à voir cette page.</p>
@endrole
@endsection