
@extends('layouts.navbar')

@section('title', 'Créer un Utilisateur')

@section('content')
@role('admin|pilote')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-[#6e9ae6] text-3xl font-bold text-center mb-8 md:mb-10">Créer un Utilisateur</h1>

    <!-- Bouton Retour -->
    <div class="text-center mb-4">
        <a href="{{ route('users.index') }}" class="text-[#6e9ae6] hover:text-blue-400 font-semibold text-lg flex items-center justify-center space-x-2">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span>Retour à la liste des utilisateurs</span>
        </a>
    </div>

    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-xl border-2 border-[#3a3a3a] space-y-6">
        @csrf

        <!-- Nom -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-[#3a3a3a]">Nom</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" placeholder="Nom de famille" required>
        </div>

        <!-- Prénom -->
        <div class="mb-4">
            <label for="first_name" class="block text-sm font-medium text-[#3a3a3a]">Prénom</label>
            <input type="text" name="first_name" id="first_name" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" placeholder="Prénom" required>
        </div>

        <!-- Date de naissance -->
        <div class="mb-4">
            <label for="birthdate" class="block text-sm font-medium text-[#3a3a3a]">Date de naissance</label>
            <input type="date" name="birthdate" id="birthdate" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" required>
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-[#3a3a3a]">Email</label>
            <input type="email" name="email" id="email" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" placeholder="Adresse email" required>
        </div>

        <!-- Mot de passe -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-[#3a3a3a]">Mot de passe</label>
            <input type="password" name="password" id="password" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" placeholder="Mot de passe" required>
        </div>

        <!-- Photo de profil -->
        <div class="mb-4">
            <label for="pp" class="block text-sm font-medium text-[#3a3a3a]">Photo de profil</label>
            <input type="file" name="pp" id="pp" accept="image/*" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300">
        </div>

        <!-- Classe -->
        <div class="mb-4">
            <label for="classes_id" class="block text-sm font-medium text-[#3a3a3a]">Classe</label>
            <select name="classes_id" id="classes_id" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" required>
                <option value="" disabled selected>Choisissez une classe</option>
                @foreach($classes as $class)
                <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Rôle -->
        <div class="mb-4">
            <label for="role" class="block text-sm font-medium text-[#3a3a3a]">Rôle</label>
            <select name="role" id="role" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" required>
                <option value="" disabled selected>Choisissez un rôle</option>
                @if(auth()->user()->hasRole('admin'))
                    @foreach($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                @elseif(auth()->user()->hasRole('pilote'))
                    <option value="etudiant">etudiant</option>
                @endif
            </select>
        </div>

        <!-- Bouton de soumission -->
        <div class="text-center">
            <button type="submit" class="bg-[#6e9ae6] text-white font-bold py-3 px-8 rounded-md hover:bg-blue-400 transition-all ease-in-out duration-300 transform hover:scale-105 focus:ring-4 focus:ring-[#6e9ae6]">
                Créer l'utilisateur
            </button>
        </div>
    </form>
</div>
@else
<p class="text-red-500 font-bold text-center">Vous n'êtes pas autorisé à voir cette page.</p>
@endrole
@endsection