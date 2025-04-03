@extends('layouts.navbar')

@section('title', 'Gestion des Contacts')

@section('content')
@role('admin|user')
    <div class="max-w-6xl mx-2 md:mx-auto p-6 shadow-xl rounded-2xl border-3 border-[#3a3a3a] my-10">
        <h1 class="text-3xl text-[#6e9ae6] font-extrabold mb-6">Gestion des demandes de contact</h1>

        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="border-b p-3">Titre</th>
                    <th class="border-b p-3">Contenu</th>
                    <th class="border-b p-3">Date</th>
                    <th class="border-b p-3">Statut</th>
                    <th class="border-b p-3">Utilisateur</th>
                    <th class="border-b p-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                <tr>
                    <td class="border-b p-3">{{ $contact->title }}</td>
                    <td class="border-b p-3">{{ Str::limit($contact->content, 50) }}</td>
                    <td class="border-b p-3">{{ $contact->created_at->format('d/m/Y') }}</td>
                    <td class="border-b p-3">
                        <span class="px-2 py-1 rounded-full {{ $contact->status->class }}">
                            {{ $contact->status->name }}
                        </span>
                    </td>
                    <td class="border-b p-3">{{ $contact->user->email }}</td>
                    <td class="border-b p-3">
                        <a href="{{ route('admin.support.show', $contact) }}" class="text-blue-500">Voir</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <h1 class="text-3xl md:text-5xl text-[#6e9ae6] font-extrabold mb-6 text-center">Vous n'avez pas accès à cette page.</h1>
    <p class="text-lg md:text-xl text-[#3a3a3a] mb-4 text-center">
        Vous devez être connecté en tant qu'administrateur ou utilisateur pour accéder à cette page.
    </p>
@endrole
@endsection
