@extends('layouts.admin')

@section('title', 'Gestion des demandes de contact')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl text-[#6e9ae6] font-bold mb-6">Demandes de contact</h1>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg shadow-md">
                <p class="text-lg">{{ session('success') }}</p>
            </div>
        @endif

        <div class="overflow-hidden shadow-xl sm:rounded-lg">
            <table class="min-w-full table-auto">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-100">Titre</th>
                        <th class="px-6 py-3 bg-gray-100">Utilisateur</th>
                        <th class="px-6 py-3 bg-gray-100">Statut</th>
                        <th class="px-6 py-3 bg-gray-100">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact) <!-- La variable $contacts doit être définie ici -->
                        <tr class="border-b">
                            <td class="px-6 py-3">{{ $contact->title }}</td>
                            <td class="px-6 py-3">{{ $contact->user->name }}</td>
                            <td class="px-6 py-3">{{ $contact->status->name }}</td>
                            <td class="px-6 py-3">
                                <a href="{{ route('admin.contacts.show', $contact->id) }}" class="text-blue-500">Voir</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
