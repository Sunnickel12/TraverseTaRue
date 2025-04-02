@extends('layouts.navbar')

@section('title', $offer->title)

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Bannière -->
    <div class="banner-plane mb-6">
        <img src="{{ asset('images/bannière.png') }}" alt="Bannière" class="w-full rounded-lg shadow">
    </div>

    <!-- Détails de l'offre -->
    <section id="job-detail" class="p-6 bg-white rounded-lg shadow-md border border-gray-200">
        <h1 class="text-3xl font-bold text-[#6e9ae6] mb-4">{{ $offer->title }}</h1>
        <p class="text-gray-500 mb-4">Publié il y a {{ $offer->publication_date }}</p>

        <!-- Tags de l'offre -->
        <div class="flex flex-wrap gap-2 mt-4">
            <span class="bg-[#6e9ae6] text-white text-sm px-4 py-1 rounded-lg shadow">{{ $offer->level }}</span>
            <span class="bg-[#6e9ae6] text-white text-sm px-4 py-1 rounded-lg shadow">{{ $offer->duration }}</span>
            <span class="bg-[#6e9ae6] text-white text-sm px-4 py-1 rounded-lg shadow">{{ $offer->salary }} €/mois</span>
        </div>

        <!-- Description -->
        <div class="job-description mt-6">
            <h2 class="text-xl font-bold text-gray-800 mb-2">Description du poste :</h2>
            <p class="text-gray-700">{{ $offer->contenu }}</p>
        </div>

        <!-- Missions -->
        <div class="job-requirements mt-6">
            <h2 class="text-xl font-bold text-gray-800 mb-2">Missions :</h2>
            <ul class="list-disc pl-6 text-gray-700">
                <li>Développer et optimiser des scripts et applications en Python pour l’automatisation des tâches.</li>
                <li>Gérer et maintenir les bases de données associées aux applications.</li>
                <li>Assurer la documentation technique des solutions mises en place.</li>
                <li>Participer à l’intégration continue et au déploiement des solutions (CI/CD).</li>
            </ul>
        </div>

        <!-- Profil recherché -->
        <div class="job-requirements mt-6">
            <h2 class="text-xl font-bold text-gray-800 mb-2">Profil recherché :</h2>
            <ul class="list-disc pl-6 text-gray-700">
                <li>Étudiant(e) en informatique ({{ $offer->level }} minimum) avec une spécialisation en développement ou DevOps.</li>
                <li>Bonne maîtrise de Python et des concepts de programmation orientée objet (POO).</li>
                <li>Connaissances en gestion de bases de données (SQL, NoSQL).</li>
                <li>Compréhension des langages web (HTML, CSS, JavaScript) est un plus.</li>
            </ul>
        </div>

        <!-- Conditions -->
        <div class="job-requirements mt-6">
            <h2 class="text-xl font-bold text-gray-800 mb-2">Conditions :</h2>
            <ul class="list-disc pl-6 text-gray-700">
                <li>Stage de {{ $offer->duration }} à Toulouse, rémunéré {{ $offer->salary }} €/mois.</li>
                <li>Encadrement par des experts du domaine et opportunité d’évoluer dans un environnement innovant.</li>
            </ul>
        </div>

        <!-- Bouton Postuler -->
        <div class="text-center mt-6">
            <a href="{{ route('postulation.create', ['offer_id' => $offer->id]) }}" class="inline-block bg-[#6e9ae6] text-white font-bold py-3 px-8 rounded-md hover:bg-blue-400 transition-all ease-in-out duration-300 transform hover:scale-105 focus:ring-4 focus:ring-[#6e9ae6]">
                Postuler
            </a>
        </div>
    </section>
</div>
@endsection
