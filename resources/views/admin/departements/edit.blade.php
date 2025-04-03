@extends('layouts.navbar')

@section('content')
<div class="container mx-auto px-4 mt-8">
    <h1 class="text-2xl font-bold mb-4">Modifier le Département</h1>

    <form action="{{ route('departements.update', $departement->id) }}" method="POST" class="bg-white p-6 shadow-md rounded-lg">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block font-bold">Nom du Département</label>
            <input type="text" name="name" value="{{ old('name', $departement->name) }}" required
                class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="mb-4">
            <label class="block font-bold">Région</label>
            <select name="region_id" required
                class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:ring-2 focus:ring-blue-500">
                <option value="">Sélectionner une région</option>
                @foreach($regions as $region)
                <option value="{{ $region->id }}" {{ $region->id == old('region_id', $departement->region_id) ? 'selected' : '' }}>
                    {{ $region->name }}
                </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white py-2 px-4 rounded-lg shadow-md">
            Mettre à jour
        </button>
    </form>
</div>
@endsection
