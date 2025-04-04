@extends('layouts.navbar')

@section('content')
@role('admin')
<h1 class="text-2xl font-bold mb-4">Modifier la ville</h1>
<form action="{{ route('cities.update', $city) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label class="block mb-2">Nom de la ville</label>
        <input type="text" name="name" value="{{ $city->name }}" class="border rounded w-full p-2" required>
    </div>
    <div class="mb-4">
        <label class="block mb-2">Département</label>
        <select name="departement_id" class="border rounded w-full p-2" required>
            <option value="">Sélectionnez un département</option>
            @foreach($departements as $departement)
            <option value="{{ $departement->id }}" {{ $city->departement_id == $departement->id ? 'selected' : '' }}>
                {{ $departement->name }} ({{ $departement->region->name ?? 'Région non définie' }} - {{ $departement->region->country->name ?? 'Pays non défini' }})
            </option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Mettre à jour</button>
</form>
@else
<h1 class="text-3xl font-extrabold text-red-500 text-center">Accès refusé</h1>
<p class="text-gray-700 text-center">Vous devez être administrateur pour accéder à cette page.</p>
@endrole
@endsection