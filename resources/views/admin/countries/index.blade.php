@extends('layouts.navbar')

@section('content')
@role('admin')
<div class="container mx-auto px-4 mt-8">
    <h1 class="text-2xl font-bold mb-4">Liste des Pays</h1>

    <!-- Formulaire de recherche -->
    <form action="{{ route('countries.index') }}" method="GET" class="mb-6">
        <input type="text" name="search" placeholder="Rechercher un pays" value="{{ request('search') }}"
            class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:ring-2 focus:ring-blue-500">
        <button type="submit"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg mt-2">
            Rechercher
        </button>
    </form>

    <!-- Bouton Ajouter -->
    <a href="{{ route('countries.create') }}"
        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">
        + Ajouter un Pays
    </a>

    <!-- Tableau des pays -->
    <div class="overflow-x-auto mt-4">
        <table class="min-w-full bg-white border border-gray-300 shadow-md rounded-lg text-sm">
            <thead class="bg-gray-700 text-white">
                <tr>
                    <th class="py-2 px-3 border text-left">Nom du Pays</th>
                    <th class="py-2 px-3 border text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($countries as $country)
                <tr class="hover:bg-gray-100 transition duration-200">
                    <td class="py-2 px-3 border">{{ $country->name }}</td>
                    <td class="py-2 px-3 border flex gap-2">
                        <a href="{{ route('countries.edit', $country->id) }}"
                            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded-lg shadow-md">
                            Modifier
                        </a>
                        <form action="{{ route('countries.destroy', $country->id) }}" method="POST"
                            onsubmit="return confirm('Voulez-vous vraiment supprimer ce pays ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded-lg shadow-md">
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
    <div class="mt-6 flex justify-center">
        {{ $countries->links() }}
    </div>
</div>
@else
<h1 class="text-3xl font-extrabold text-red-500 text-center">Accès refusé</h1>
<p class="text-gray-700 text-center">Vous devez être administrateur pour accéder à cette page.</p>
@endrole
@endsection
