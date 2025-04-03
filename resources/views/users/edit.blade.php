@extends('layouts.navbar')

@section('title', 'Modifier un Utilisateur')

@section('content')
@role('admin|pilote')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-[#6e9ae6] text-3xl font-bold text-center mb-8 md:mb-10">Modifier un Utilisateur</h1>

    <div class="text-center mb-4">
        <a href="{{ route('users.index') }}" class="text-[#6e9ae6] hover:text-blue-400 font-semibold text-lg flex items-center justify-center space-x-2">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span>Retour à la liste des utilisateurs</span>
        </a>
    </div>
    
    <!-- Display Success or Error Messages -->
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        {{ session('error') }}
    </div>
    @endif

    @if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Form -->
    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-xl border-2 border-[#3a3a3a] space-y-6">
        @csrf
        @method('PUT')

        <!-- Nom -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-[#3a3a3a]">Nom</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" required>
        </div>

        <!-- Prénom -->
        <div class="mb-4">
            <label for="first_name" class="block text-sm font-medium text-[#3a3a3a]">Prénom</label>
            <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $user->first_name) }}" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" required>
        </div>

        <!-- Date de naissance -->
        <div class="mb-4">
            <label for="birthdate" class="block text-sm font-medium text-[#3a3a3a]">Date de naissance</label>
            <input type="date" name="birthdate" id="birthdate" value="{{ old('birthdate', $user->birthdate) }}" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" required>
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-[#3a3a3a]">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" required>
        </div>

        <!-- Classe -->
        <div class="mb-4">
            <label for="classes_id" class="block text-sm font-medium text-[#3a3a3a]">Classe</label>
            <select name="classes_id" id="classes_id" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" required>
                <option value="" disabled>Choisissez une classe</option>
                @foreach($classes as $class)
                <option value="{{ $class->id }}" {{ old('classes_id', $user->classes_id) == $class->id ? 'selected' : '' }}>
                    {{ $class->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Rôle -->
        <div class="mb-4">
            <label for="role" class="block text-sm font-medium text-[#3a3a3a]">Rôle</label>
            <select name="role" id="role" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" required>
                <option value="" disabled>Choisissez un rôle</option>
                @foreach($roles as $role)
                <option value="{{ $role->name }}" {{ old('role', $user->getRoleNames()->first()) == $role->name ? 'selected' : '' }}>
                    {{ $role->name }}
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