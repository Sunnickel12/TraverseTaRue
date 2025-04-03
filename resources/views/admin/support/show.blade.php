@extends('layouts.navbar')

@section('title', 'Détails de la demande de contact')

@section('content')

@role('admin')
    @if (isset($contact))
    <div class="max-w-4xl mx-2 md:mx-auto p-6 shadow-xl rounded-2xl border-3 border-[#3a3a3a] my-10 bg-gray-50">
        <h1 class="text-3xl text-[#6e9ae6] font-extrabold mb-6">Détails de la demande de contact</h1>

        <div class="bg-white p-6 rounded-lg border-2 border-[#3a3a3a] space-y-6">
            <h2 class="text-2xl font-semibold text-[#6e9ae6] mb-4">{{ $contact->title }}</h2>
            <p class="text-gray-700"><strong>Contenu :</strong> {{ $contact->content }}</p>
            <p class="text-gray-700"><strong>Date de création :</strong> {{ $contact->created_at->format('d/m/Y H:i') }}</p>

            <!-- Vérifier si le statut existe -->
            @if(isset($contact->status))
                <p class="text-gray-700"><strong>Statut :</strong> <span class="px-3 py-1 rounded-full {{ $contact->status->class }}">{{ $contact->status->name }}</span></p>
            @endif

            <!-- Vérifier si l'utilisateur existe -->
            @if(isset($contact->user))
                <p class="text-gray-700"><strong>Utilisateur :</strong> <a href="mailto:{{ $contact->user->email }}" class="text-blue-500">{{ $contact->user->email }}</a></p>
            @endif

            <!-- Vérifier si un fichier existe -->
            @if($contact->file)
            <div class="mt-4">
                <strong>Fichier joint :</strong>
                <a href="{{ route('contact.download', $contact->id) }}" class="text-blue-500 hover:underline">Télécharger le fichier</a>
            </div>
            @endif
        </div>

        <!-- Formulaire pour changer le statut -->
        <form action="{{ route('admin.contacts.update', $contact) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="status" class="block text-sm font-semibold text-gray-700">Changer le statut</label>
            <select name="status" id="status" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" onchange="this.form.submit()">
                @foreach($statuses as $status)
                <option value="{{ $status->id }}" {{ $contact->status_id == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
                @endforeach
            </select>
        </form>

        <!-- Bouton pour supprimer la demande -->
        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="mt-6">
            @csrf
            @method('DELETE')
            <button type="submit" class="w-full px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">Supprimer la demande</button>
        </form>

        <div class="mt-6">
            <a href="{{ route('admin.support.index') }}" class="text-gray-600 hover:underline">Retour à la gestion des contacts</a>
        </div>
    </div>
    @else
        <p class="text-red-500">Le contact n'existe pas ou une erreur est survenue.</p>
    @endif
@else
    <h1 class="text-3xl md:text-5xl text-[#6e9ae6] font-extrabold mb-6 text-center">Vous n'avez pas accès à cette page.</h1>
    <p class="text-lg md:text-xl text-[#3a3a3a] mb-4 text-center">
        Vous devez être connecté en tant qu'administrateur pour accéder à cette page.
    </p>
@endrole

@endsection
