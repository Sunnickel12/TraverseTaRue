@extends('layouts.navbar')

@section('content')
@role('admin')
<div class="container mx-auto px-4 mt-8">
    <h1 class="text-2xl font-bold mb-4">Liste des Régions</h1>

    <form action="{{ route('regions.index') }}" method="GET" class="mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <input type="text" name="search" placeholder="Rechercher une région" value="{{ request('search') }}"
                    class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <select name="country_id"
                    class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:ring-2 focus:ring-blue-500">
                    <option value="">Tous les pays</option>
                    @foreach($countries as $country)
                    <option value="{{ $country->id }}" {{ request('country_id') == $country->id ? 'selected' : '' }}>
                        {{ $country->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-lg shadow-md">
                    Appliquer les filtres
                </button>
            </div>
        </div>
    </form>

    <div class="mb-4">
        <a href="{{ route('regions.create') }}"
            class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded-lg shadow-md">
            + Ajouter une Région
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 shadow-md">
            <thead class="bg-gray-700 text-white">
                <tr>
                    <th class="py-2 px-3 border">Nom</th>
                    <th class="py-2 px-3 border">Pays</th>
                    <th class="py-2 px-3 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($regions as $region)
                <tr class="hover:bg-gray-100 transition duration-200">
                    <td class="py-2 px-3 border">{{ $region->name }}</td>
                    <td class="py-2 px-3 border">{{ $region->country->name }}</td>
                    <td class="py-2 px-3 border flex space-x-2">
                        <a href="{{ route('regions.edit', $region->id) }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-3 rounded-lg">
                            Modifier
                        </a>
                        <form action="{{ route('regions.destroy', $region->id) }}" method="POST"
                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette région ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded-lg">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-center">
        {{ $regions->links() }}
    </div>
</div>
@else
<h1 class="text-3xl font-extrabold text-red-500 text-center">Accès refusé</h1>
<p class="text-gray-700 text-center">Vous devez être administrateur pour accéder à cette page.</p>
@endrole
@endsection
