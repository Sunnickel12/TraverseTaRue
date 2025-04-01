@extends('layouts.navbar')

@section('content')
@role('admin')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-[#6e9ae6] text-3xl font-bold text-center mb-8 md:mb-10">Éditer une entreprise</h1>

    <!-- Bouton Retour -->
    <div class="text-center mb-4">
        <a href="{{ route('companies.index') }}" class="text-[#6e9ae6] hover:text-blue-400 font-semibold text-lg flex items-center justify-center space-x-2">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span>Retour à la liste des entreprises</span>
        </a>
    </div>

    <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-xl border-2 border-[#3a3a3a] space-y-6">
        @csrf
        @method('PUT')

        <!-- Nom de l'entreprise -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-[#3a3a3a]">Nom de l'entreprise</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" value="{{ $company->name }}" required>
        </div>

        <!-- Adresse -->
        <div class="mb-4">
            <label for="address" class="block text-sm font-medium text-[#3a3a3a]">Adresse</label>
            <input type="text" name="address" id="address" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" value="{{ $company->address }}" required>
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-[#3a3a3a]">Description</label>
            <textarea name="description" id="description" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" required>{{ $company->description }}</textarea>
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-[#3a3a3a]">Email</label>
            <input type="email" name="email" id="email" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" value="{{ $company->email }}">
        </div>

        <!-- Téléphone -->
        <div class="mb-4">
            <label for="phone" class="block text-sm font-medium text-[#3a3a3a]">Téléphone</label>
            <input type="text" name="phone" id="phone" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" value="{{ $company->phone }}">
        </div>

        <!-- Logo actuel -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-[#3a3a3a]">Logo actuel</label>
            @if($company->logo)
                <div class="flex justify-center">
                    <img src="{{ asset('images/' . $company->logo) }}" alt="Company Logo" class="w-40 h-40 object-cover rounded-md border">
                </div>
            @else
                <p class="text-center text-[#3a3a3a]">Aucun logo disponible</p>
            @endif
        </div>

        <!-- Nouveau Logo avec aperçu -->
        <div class="mb-4">
            <label for="logo" class="block text-sm font-medium text-[#3a3a3a]">Logo</label>
            <input type="file" name="logo" id="logo" accept="image/*" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#6e9ae6] transition-all duration-300" onchange="previewImage(event)">

            <!-- Aperçu du nouveau logo -->
            <div id="logoPreview" class="mt-2 hidden">
                <img id="preview" class="max-w-full h-auto rounded-md" src="#" alt="Aperçu Logo" />
            </div>
        </div>

        <!-- Bouton de soumission -->
        <div class="text-center">
            <button type="submit" class="bg-[#6e9ae6] text-white font-bold py-3 px-8 rounded-md hover:bg-blue-400 transition-all ease-in-out duration-300 transform hover:scale-105 focus:ring-4 focus:ring-[#6e9ae6]">
                Mettre à jour
            </button>
        </div>
    </form>
</div>

<script>
    // Fonction d'aperçu d'image pour le logo
    function previewImage(event) {
        const preview = document.getElementById('preview');
        const logoPreview = document.getElementById('logoPreview');
        const file = event.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                logoPreview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            logoPreview.classList.add('hidden');
        }
    }
</script>

@else
<p class="text-red-500 font-bold text-center">Vous n'êtes pas autorisé à voir cette page.</p>
@endrole
@endsection