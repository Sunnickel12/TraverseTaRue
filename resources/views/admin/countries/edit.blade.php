@extends('layouts.navbar')

@section('content')
@role('admin')
<div class="container mx-auto px-4 mt-8">
    <h1 class="text-2xl font-bold mb-4">Modifier le Pays</h1>

    <form action="{{ route('countries.update', $country->id) }}" method="POST" class="bg-white p-6 shadow-md rounded-lg">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block font-bold">Nom du Pays</label>
            <input type="text" name="name" value="{{ old('name', $country->name) }}" required
                class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:ring-2 focus:ring-blue-500">
        </div>
        <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white py-2 px-4 rounded-lg shadow-md">
            Mettre à jour
        </button>
    </form>
</div>
@else
<h1 class="text-3xl font-extrabold text-red-500 text-center">Accès refusé</h1>
<p class="text-gray-700 text-center">Vous devez être administrateur pour accéder à cette page.</p>
@endrole
@endsection
