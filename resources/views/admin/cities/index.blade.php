@extends('layouts.navbar')

@section('content')
@role('admin')
<div class="container mx-auto px-4 mt-8">
    <h1 class="text-2xl font-bold mb-4">Liste des Villes</h1>

    <!-- Formulaire de recherche et filtres -->
    <form action="{{ route('cities.index') }}" method="GET" class="mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Recherche par nom de ville -->
            <div>
                <input type="text" name="search" placeholder="Rechercher par ville" value="{{ request('search') }}"
                    class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <!-- Filtre par département -->
            <div>
                <select name="departement_id"
                    class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Tous les départements</option>
                    @foreach($departements as $departement)
                    <option value="{{ $departement->id }}" {{ request('departement_id') == $departement->id ? 'selected' : '' }}>
                        {{ $departement->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <!-- Filtre par région -->
            <div>
                <select name="region_id"
                    class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Toutes les régions</option>
                    @foreach($regions as $region)
                    <option value="{{ $region->id }}" {{ request('region_id') == $region->id ? 'selected' : '' }}>
                        {{ $region->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <!-- Filtre par pays -->
            <div>
                <select name="country_id"
                    class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Tous les pays</option>
                    @foreach($countries as $country)
                    <option value="{{ $country->id }}" {{ request('country_id') == $country->id ? 'selected' : '' }}>
                        {{ $country->name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="flex justify-end mt-4">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
                Appliquer les filtres
            </button>
        </div>
    </form>

    <!-- Bouton pour ajouter une nouvelle ville -->
    <div class="mb-4">
        <a href="{{ route('cities.create') }}"
            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
            + Ajouter une Ville
        </a>
    </div>

    <!-- Tableau des villes -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 shadow-md rounded-lg text-sm">
            <thead class="bg-gray-700 text-white">
                <tr>
                    <th class="py-2 px-3 border text-left">Ville</th>
                    <th class="py-2 px-3 border text-left">Département</th>
                    <th class="py-2 px-3 border text-left">Région</th>
                    <th class="py-2 px-3 border text-left">Pays</th>
                    <th class="py-2 px-3 border text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cities as $city)
                <tr class="hover:bg-gray-100 transition duration-200">
                    <td class="py-2 px-3 border">{{ $city->name }}</td>
                    <td class="py-2 px-3 border">{{ $city->departement->name ?? '-' }}</td>
                    <td class="py-2 px-3 border">{{ $city->departement->region->name ?? '-' }}</td>
                    <td class="py-2 px-3 border">{{ $city->departement->region->country->name ?? '-' }}</td>
                    <td class="py-2 px-3 border flex space-x-2">
                        <a href="{{ route('cities.edit', $city) }}"
                            class="bg-yellow-500 hover:bg-yellow-700 text-white py-1 px-3 rounded-lg text-xs transition duration-300">
                            Modifier
                        </a>
                        <form action="{{ route('cities.destroy', $city) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette ville ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded-lg text-xs transition duration-300">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $cities->links() }}
    </div>
</div>
@else
    <h1 class="text-3xl font-extrabold text-red-500 text-center">Accès refusé</h1>
    <p class="text-gray-700 text-center">Vous devez être administrateur pour accéder à cette page.</p>
@endrole
@endsection
