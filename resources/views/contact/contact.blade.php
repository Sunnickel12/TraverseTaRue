@extends('layouts.navbar')

@section('title', 'Contact')

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


@section('content')
    @auth



        <!-- Message de succès -->
        @if (session('successsend'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                class="mb-6 mt-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg shadow-md transition-opacity duration-500">
                <p class="text-lg font-semibold">{{ session('successsend') }}</p>
            </div>
        @endif

        <div class="max-w-6xl mx-2 md:mx-auto p-6 shadow-xl rounded-2xl border-3 border-[#3a3a3a] my-10">
            <div class="text-center">
                <h1 class="text-3xl md:text-5xl text-[#6e9ae6] font-extrabold mb-6">Contactez-nous</h1>
                <p class="text-sm md:text-xl text-[#3a3a3a] mb-2">
                    Si vous avez des questions ou des demandes, n'hésitez pas à nous contacter via le formulaire ci-dessous.
                </p>
                <p class="text-base md:text-xl text-[#ff0000] mb-4">
                    Vous recevrez une réponse par mail dans les plus brefs délais.
                </p>
            </div>

            <!-- Formulaire de contact -->
            <div class="mt-6 flex justify-center">
                <form action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data"
                    class="w-full max-w-lg">
                    @csrf

                    <div class="mb-4">
                        <label for="title" class="block text-[#3a3a3a] text-lg font-semibold">Titre</label>
                        <input type="text" id="title" name="title"
                            class="w-full p-4 mt-2 border-2 border-[#6e9ae6] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#6e9ae6]"
                            required>
                        @error('title')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="content" class="block text-[#3a3a3a] text-lg font-semibold">Message</label>
                        <textarea id="content" name="content" rows="4"
                            class="w-full p-4 mt-2 border-2 border-[#6e9ae6] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#6e9ae6]"
                            required></textarea>
                        @error('content')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="file" class="block text-[#3a3a3a] text-lg font-semibold">Joindre un fichier
                            (facultatif)
                        </label>
                        <input type="file" id="file" name="file"
                            class="w-full p-4 mt-2 border-2 border-[#6e9ae6] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#6e9ae6]">
                        @error('file')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit"
                            class="bg-[#6e9ae6] text-white font-semibold py-3 px-8 rounded-lg shadow-md hover:bg-blue-400 transition duration-300 transform hover:scale-105">
                            Envoyer le message
                        </button>
                    </div>
                </form>
            </div>

            <!-- Boutons avec centrage et amélioration -->
            <div class="mt-6 flex justify-end gap-6">
                <a href="{{ route('home') }}"
                    class="bg-[#6e9ae6] text-white font-semibold py-3 px-8 rounded-lg shadow-md hover:bg-blue-400 transition duration-300 transform hover:scale-105 text-center">
                    ← Retour à la page précédente
                </a>
            </div>
        </div>
    @else
        <h1 class="text-3xl md:text-5xl text-[#6e9ae6] font-extrabold mb-6 text-center">Vous n'avez pas accès à cette page.</h1>
        <p class="text-lg md:text-xl text-[#3a3a3a] mb-4 text-center">
            Vous devez être connecté en tant qu'administrateur, pilote ou étudiant pour accéder à cette page.
        </p>
    @endauth    
@endsection
