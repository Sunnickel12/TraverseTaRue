@extends('layouts.navbar')

@section('title', 'Postuler à une Offre')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold text-center mb-8">Postuler à l'Offre: {{ $offer->title }}</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('postulations.store', ['offer' => $offer->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="cv" class="block text-sm font-medium text-gray-700">CV</label>
                <input type="file" name="cv" id="cv" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="motivation_letter" class="block text-sm font-medium text-gray-700">Lettre de Motivation (Facultatif)</label>
                <input type="file" name="motivation_letter" id="motivation_letter" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Envoyer la Candidature
                </button>
            </div>
        </form>
    </div>
</div>
@endsection