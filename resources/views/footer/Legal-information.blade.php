@extends('layouts.navbar')

@section('title', 'Informations Légales')

@section('content')
@vite(['resources/js/app.js', 'resources/css/app.css'])

<div class="max-w-6xl mx-auto p-6 shadow-xl rounded-2xl border-3 border-[#3a3a3a] my-10">
    <!-- Conteneur principal -->
    <div class="text-center">
        <h1 class="text-3xl md:text-5xl text-[#6e9ae6] font-extrabold mb-6">Informations Légales</h1>

        <p class="text-lg md:text-xl text-[#3a3a3a] mb-4">
            Cette page regroupe toutes les informations légales concernant l'utilisation de notre site web. Veuillez les lire attentivement.
        </p>
    </div>

    <!-- Section : Propriétaire du site -->
    <div class="mt-6">
        <h2 class="text-xl md:text-2xl font-semibold text-[#3a3a3a] mb-4">Propriétaire du Site</h2>
        <p class="text-base md:text-lg text-[#3a3a3a]">
            Le site web est la propriété de <strong>Traverse Ta Rue</strong>, société à responsabilité limitée, inscrite au registre du commerce sous le numéro <strong>SIRET 123 456 789</strong>.
        </p>
    </div>

    <!-- Section : Hébergeur -->
    <div class="mt-6">
        <h2 class="text-xl md:text-2xl font-semibold text-[#3a3a3a] mb-4">Hébergeur</h2>
        <p class="text-base md:text-lg text-[#3a3a3a]">
            L'hébergement du site est assuré par la société <strong>Laravel Cloud</strong>, située à <a href="https://cloud.laravel.com/" target="_blank" class="hover:text-[#6e9ae6]">
                <strong>https://cloud.laravel.com/</strong></a>, et contactable au numéro suivant : <strong>+33 7 68 63 18 28</strong>.
        </p>
    </div>

    <!-- Section : Collecte des données personnelles -->
    <div class="mt-6">
        <h2 class="text-xl md:text-2xl font-semibold text-[#3a3a3a] mb-4">Collecte des Données Personnelles</h2>
        <p class="text-base md:text-lg text-[#3a3a3a]">
            Nous collectons des données personnelles vous concernant lors de l'utilisation de notre site. Ces données sont nécessaires pour la gestion de votre compte et la fourniture de nos services. Vous avez la possibilité de modifier ou de supprimer vos informations à tout moment en vous connectant à votre compte ou en contactant notre support client.
        </p>
    </div>

    <!-- Section : Propriété intellectuelle -->
    <div class="mt-6">
        <h2 class="text-xl md:text-2xl font-semibold text-[#3a3a3a] mb-4">Propriété Intellectuelle</h2>
        <p class="text-base md:text-lg text-[#3a3a3a]">
            Tous les éléments présents sur le site (textes, images, logos, etc.) sont protégés par des droits de propriété intellectuelle. Toute reproduction ou utilisation des éléments du site sans autorisation préalable est interdite.
        </p>
    </div>

    <!-- Section : Liens externes -->
    <div class="mt-6">
        <h2 class="text-xl md:text-2xl font-semibold text-[#3a3a3a] mb-4">Liens Externes</h2>
        <p class="text-base md:text-lg text-[#3a3a3a]">
            Ce site peut contenir des liens vers des sites tiers. Nous ne sommes pas responsables de leur contenu, de leur politique de confidentialité ou de leurs pratiques.
        </p>
    </div>

    <!-- Boutons avec centrage et amélioration -->
        <div class="mt-6 flex justify-center gap-6">
            <a href="{{ url()->previous() ?: route('home') }}"
                class="bg-[#6e9ae6] text-white font-semibold py-3 px-8 rounded-lg shadow-md hover:bg-blue-400 transition duration-300 transform hover:scale-105 text-center">
                ← Retour à la page précédente
            </a>
        </div>
    @endsection