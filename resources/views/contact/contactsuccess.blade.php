@extends('layouts.navbar')

@section('title', 'Message envoyé')

@section('content')
<div class="max-w-6xl mx-2 md:mx-auto p-6 shadow-xl rounded-2xl border-3 border-[#3a3a3a] my-10">
    <div class="text-center">
        <h1 class="text-3xl md:text-5xl text-[#6e9ae6] font-extrabold mb-6">Message envoyé avec succès</h1>
        <p class="text-lg md:text-xl text-[#3a3a3a] mb-4">
            Merci de nous avoir contactés ! Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.
        </p>
    </div>

    <!-- Bouton de retour à la page d'accueil -->
    <div class="mt-6 text-center">
        <a href="{{ route('home') }}" 
            class="bg-[#6e9ae6] text-white font-semibold py-3 px-8 rounded-lg shadow-md hover:bg-blue-400 transition duration-300 transform hover:scale-105">
            Retour à l'accueil
        </a>
    </div>
</div>
@endsection
