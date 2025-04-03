@extends('layouts.navbar')

@section('title', 'Panneau d\'Administration')

@section('content')
@role('admin|pilote')
<div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <div class="w-64 bg-[#3a3a3a] text-white p-6">
        <h2 class="text-2xl font-bold text-center mb-6">Admin Panel</h2>
        <ul>
            <li class="mb-4"><a href="#" class="block p-3 rounded-lg hover:bg-gray-700">Tableau de bord</a></li>
            <li class="mb-4"><a href="#" class="block p-3 rounded-lg hover:bg-gray-700">Utilisateurs</a></li>
            <li class="mb-4"><a href="#" class="block p-3 rounded-lg hover:bg-gray-700">Paramètres</a></li>
            <li><a href="#"  class="block p-3 rounded-lg hover:bg-red-600">Déconnexion</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-10">
        <h1 class="text-3xl font-bold text-[#6e9ae6] mb-6">Bienvenue sur le panneau d'administration</h1>
        <p class="text-lg text-gray-700">Gérez les utilisateurs, les paramètres et plus encore depuis cet espace.</p>

        <!-- Section de gestion -->
        <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-6 bg-white shadow-md rounded-lg text-center">
                <h3 class="text-xl font-semibold text-[#3a3a3a]">Gestion des utilisateurs</h3>
                <p class="text-gray-600 mt-2">Ajoutez, modifiez ou supprimez des comptes.</p>
                <a href="#"  class="mt-4 inline-block bg-[#6e9ae6] text-white py-2 px-6 rounded-lg shadow hover:bg-blue-300">Gérer</a>
            </div>
            <div class="p-6 bg-white shadow-md rounded-lg text-center">
                <h3 class="text-xl font-semibold text-[#3a3a3a]">Paramètres</h3>
                <p class="text-gray-600 mt-2">Personnalisez votre expérience d'administration.</p>
                <a href="#"  class="mt-4 inline-block bg-[#6e9ae6] text-white py-2 px-6 rounded-lg shadow hover:bg-blue-300">Configurer</a>
            </div>
            <div class="p-6 bg-white shadow-md rounded-lg text-center">
                <h3 class="text-xl font-semibold text-[#3a3a3a]">Support Msg</h3>
                <p class="text-gray-600 mt-2">Gérer les demandes de contact</p>
                <a href="{{ route('admin.support.index') }}"  class="mt-4 inline-block bg-[#6e9ae6] text-white py-2 px-6 rounded-lg shadow hover:bg-blue-300">Gérer</a>
            </div>
        </div>
    </div>
</div>
@else
<h1 class="text-3xl text-center font-extrabold text-red-500 mt-20">Accès refusé</h1>
<p class="text-center text-gray-700 mt-4">Vous devez être administrateur ou pilote pour accéder à cette page.</p>
@endrole
@endsection
