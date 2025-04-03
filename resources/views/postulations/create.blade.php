@extends('layouts.navbar')

@section('title', 'Postuler')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Postuler pour l'offre : {{ $offer->title }}</h1>
    <form action="{{ route('postulations.store', $offer->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-xl border-2 border-gray-300 space-y-6">
        @csrf
        <div class="mb-4">
            <label for="cv" class="block text-sm font-medium text-gray-700">CV</label>
            <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
        </div>
        <div class="mb-4">
            <label for="motivation_letter" class="block text-sm font-medium text-gray-700">Lettre de motivation</label>
            <input type="file" id="motivation_letter" name="motivation_letter" accept=".pdf,.doc,.docx" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        </div>
        <div class="text-right">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-600 transition">
                Envoyer
            </button>
        </div>
    </form>
</div>
@endsection