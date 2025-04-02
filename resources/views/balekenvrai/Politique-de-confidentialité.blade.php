@extends('layouts.navbar')

@section('title', 'Politique de Confidentialité')

@section('content')
@vite(['resources/js/app.js', 'resources/css/app.css'])

<div class="max-w-6xl mx-auto p-6 shadow-xl rounded-2xl border-3 border-[#3a3a3a] my-10">
    <!-- Conteneur principal -->
    <div class="text-center">
        <h1 class="text-3xl md:text-5xl text-[#6e9ae6] font-extrabold mb-6">Politique de Confidentialité</h1>

        <p class="text-lg md:text-xl text-[#3a3a3a] mb-4">
            Nous respectons la confidentialité de vos données personnelles et nous engageons à les protéger. Veuillez lire attentivement notre politique de confidentialité.
        </p>
    </div>

    <!-- Section : Collecte des informations -->
    <div class="mt-6">
        <h2 class="text-xl md:text-2xl font-semibold text-[#3a3a3a] mb-4">Collecte des Informations</h2>
        <p class="text-base md:text-lg text-[#3a3a3a]">
            Nous collectons des informations personnelles lorsque vous vous inscrivez sur notre site, effectuez une commande, vous abonnez à notre newsletter, ou interagissez avec nos services. Ces informations incluent votre nom, adresse e-mail, numéro de téléphone et autres informations nécessaires pour améliorer votre expérience.
        </p>
    </div>

    <!-- Section : Utilisation des données -->
    <div class="mt-6">
        <h2 class="text-xl md:text-2xl font-semibold text-[#3a3a3a] mb-4">Utilisation des Données</h2>
        <p class="text-base md:text-lg text-[#3a3a3a]">
            Les données collectées sont utilisées pour vous fournir nos services, améliorer votre expérience sur notre site, et vous contacter en cas de besoin. Nous n'utiliserons vos informations que dans le cadre des services pour lesquels elles ont été collectées.
        </p>
    </div>

    <!-- Section : Protection des données -->
    <div class="mt-6">
        <h2 class="text-xl md:text-2xl font-semibold text-[#3a3a3a] mb-4">Protection des Données</h2>
        <p class="text-base md:text-lg text-[#3a3a3a]">
            Nous mettons en œuvre des mesures de sécurité pour protéger vos données contre tout accès non autorisé, perte ou divulgation. Cependant, aucune méthode de transmission sur Internet n'est totalement sécurisée, et nous ne pouvons garantir la sécurité absolue de vos informations.
        </p>
    </div>

    <!-- Section : Partage des données -->
    <div class="mt-6">
        <h2 class="text-xl md:text-2xl font-semibold text-[#3a3a3a] mb-4">Partage des Données</h2>
        <p class="text-base md:text-lg text-[#3a3a3a]">
            Nous ne vendons, échangeons ou transférons vos informations personnelles à des tiers, sauf si cela est nécessaire pour exécuter nos services ou si la loi l'exige.
        </p>
    </div>

    <!-- Section : Vos droits -->
    <div class="mt-6">
        <h2 class="text-xl md:text-2xl font-semibold text-[#3a3a3a] mb-4">Vos Droits</h2>
        <p class="text-base md:text-lg text-[#3a3a3a]">
            Conformément à la législation en vigueur, vous disposez de droits d'accès, de rectification, de suppression et d'opposition sur vos données personnelles. Vous pouvez exercer ces droits en nous contactant directement via notre formulaire de contact ou en vous connectant à votre compte.
        </p>
    </div>

    <!-- Section : Modifications de la politique -->
    <div class="mt-6">
        <h2 class="text-xl md:text-2xl font-semibold text-[#3a3a3a] mb-4">Modifications de la Politique</h2>
        <p class="text-base md:text-lg text-[#3a3a3a]">
            Nous nous réservons le droit de modifier cette politique de confidentialité à tout moment. Nous vous informerons de tout changement important concernant l'utilisation de vos données personnelles.
        </p>
    </div>

    <!-- Boutons avec centrage et amélioration -->
    <div class="mt-6 flex justify-center gap-6">
        <a href="{{ url()->previous() ?: route('home') }}"
            class="bg-[#6e9ae6] text-white font-semibold py-3 px-8 rounded-lg shadow-md hover:bg-blue-400 transition duration-300 transform hover:scale-105 text-center">
            ← Retour à la page précédente
        </a>
    </div>
</div>

@endsection
