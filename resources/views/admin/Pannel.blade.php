@extends('layouts.navbar')

@section('title', 'Panneau d\'Administration')

@section('content')
@role('admin')
<div class="flex min-h-screen bg-gray-100">
    <div class="flex-1 p-10">
        <h1 class="text-3xl font-bold text-[#6e9ae6] mb-4">Panneau d'Administration</h1>
        <p class="text-lg text-gray-700 mb-6">Gérez les utilisateurs, les paramètres et plus encore.</p>

        <!-- Conteneur des sections -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <!-- Section Utilisateurs -->
            <div class="p-6 bg-white shadow-lg rounded-lg text-center">
                <div class="text-[#6e9ae6] text-4xl mb-3">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="text-xl font-semibold text-[#3a3a3a]">Gestion des utilisateurs</h3>
                <p class="text-gray-600 mt-2">Ajoutez, modifiez ou supprimez des comptes.</p>
                <a href="{{ route('admin.manage-users') }}" class="mt-4 inline-block bg-[#6e9ae6] text-white py-2 px-6 rounded-lg shadow hover:bg-blue-400">
                    Gérer
                </a>
            </div>

            <!-- Section Support -->
            <div class="p-6 bg-white shadow-lg rounded-lg text-center">
                <div class="text-[#6e9ae6] text-4xl mb-3">
                    <i class="fas fa-headset"></i>
                </div>
                <h3 class="text-xl font-semibold text-[#3a3a3a]">Support</h3>
                <p class="text-gray-600 mt-2">Gérer les demandes de contact.</p>
                <a href="{{ route('admin.support.index') }}" class="mt-4 inline-block bg-[#6e9ae6] text-white py-2 px-6 rounded-lg shadow hover:bg-blue-400">
                    Gérer
                </a>
            </div>

            <!-- Section Villes -->
            <div class="p-6 bg-white shadow-lg rounded-lg text-center">
                <div class="text-[#6e9ae6] text-4xl mb-3">
                    <i class="fas fa-city"></i>
                </div>
                <h3 class="text-xl font-semibold text-[#3a3a3a]">Gestion des Villes</h3>
                <p class="text-gray-600 mt-2">Ajouter, modifier et supprimer des villes.</p>
                <a href="{{ route('cities.index') }}" class="mt-4 inline-block bg-[#6e9ae6] text-white py-2 px-6 rounded-lg shadow hover:bg-blue-400">
                    Configurer
                </a>
            </div>

            <!-- Section Départements -->
            <div class="p-6 bg-white shadow-lg rounded-lg text-center">
                <div class="text-[#6e9ae6] text-4xl mb-3">
                    <i class="fas fa-landmark"></i>
                </div>
                <h3 class="text-xl font-semibold text-[#3a3a3a]">Gestion des Départements</h3>
                <p class="text-gray-600 mt-2">Ajouter, modifier et supprimer des départements.</p>
                <a href="{{ route('departements.index') }}" class="mt-4 inline-block bg-[#6e9ae6] text-white py-2 px-6 rounded-lg shadow hover:bg-blue-400">
                    Configurer
                </a>
            </div>

            <!-- Section Régions -->
            <div class="p-6 bg-white shadow-lg rounded-lg text-center">
                <div class="text-[#6e9ae6] text-4xl mb-3">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <h3 class="text-xl font-semibold text-[#3a3a3a]">Gestion des Régions</h3>
                <p class="text-gray-600 mt-2">Ajouter, modifier et supprimer des régions.</p>
                <a href="{{ route('regions.index') }}" class="mt-4 inline-block bg-[#6e9ae6] text-white py-2 px-6 rounded-lg shadow hover:bg-blue-400">
                    Configurer
                </a>
            </div>

            <!-- Section Pays -->
            <div class="p-6 bg-white shadow-lg rounded-lg text-center">
                <div class="text-[#6e9ae6] text-4xl mb-3">
                    <i class="fas fa-globe"></i>
                </div>
                <h3 class="text-xl font-semibold text-[#3a3a3a]">Gestion des Pays</h3>
                <p class="text-gray-600 mt-2">Ajouter, modifier et supprimer des pays.</p>
                <a href="{{ route('countries.index') }}" class="mt-4 inline-block bg-[#6e9ae6] text-white py-2 px-6 rounded-lg shadow hover:bg-blue-400">
                    Configurer
                </a>
            </div>

        </div>
    </div>
</div>
@else
<div class="flex justify-center items-center min-h-screen">
    <div class="text-center">
        <h1 class="text-3xl font-extrabold text-red-500">Accès refusé</h1>
        <p class="text-gray-700 mt-2">Vous devez être administrateur pour accéder à cette page.</p>
    </div>
</div>
@endrole
@endsection
