@extends('layouts.navbar')

@role('admin')
@section('content')
<div class="container mx-auto px-4 mt-8">
    <h1 class="text-2xl font-bold mb-4">Ajouter une Ville</h1>

    <form action="{{ route('cities.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Nom de la Ville :</label>
            <input type="text" name="name" id="name"
                class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="departement_id" class="block text-gray-700 font-bold mb-2">Département :</label>
            <select name="departement_id" id="departement_id"
                class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 select2">
                <option value="">Sélectionner un département</option>
                @foreach($departements as $departement)
                <option value="{{ $departement->id }}">{{ $departement->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
                Ajouter la Ville
            </button>
        </div>
    </form>
</div>

<!-- Importation de Select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Sélectionner une option",
            allowClear: true
        });
    });
</script>
@else
<h1 class="text-3xl font-extrabold text-red-500 text-center">Accès refusé</h1>
<p class="text-gray-700 text-center">Vous devez être administrateur pour accéder à cette page.</p>
@endrole
@endsection
