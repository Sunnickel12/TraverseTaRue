@extends('layouts.admin')

@section('title', 'Détails de la demande de contact')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl text-[#6e9ae6] font-bold mb-6">Détails de la demande</h1>

        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl text-[#3a3a3a] font-semibold">Titre: {{ $contact->title }}</h2>
            <p class="text-lg text-[#3a3a3a] mt-2"><strong>Message:</strong> {{ $contact->content }}</p>
            <p class="text-lg text-[#3a3a3a] mt-2"><strong>Utilisateur:</strong> {{ $contact->user->name }}</p>
            <p class="text-lg text-[#3a3a3a] mt-2"><strong>Fichier joint:</strong> 
                @if($contact->file)
                    <a href="{{ asset('storage/' . $contact->file) }}" target="_blank" class="text-blue-500">Voir le fichier</a>
                @else
                    Aucun fichier joint
                @endif
            </p>

            <h3 class="text-xl text-[#3a3a3a] mt-6">Mettre à jour le statut</h3>
            <form action="{{ route('admin.contacts.updateStatus', $contact->id) }}" method="POST">
                @csrf
                <div class="mt-4">
                    <select name="status_id" class="p-2 border-2 border-[#6e9ae6] rounded-md w-full">
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}" {{ $status->id == $contact->status_id ? 'selected' : '' }}>
                                {{ $status->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-4 text-right">
                    <button type="submit" class="bg-[#6e9ae6] text-white py-2 px-6 rounded-lg">Mettre à jour le statut</button>
                </div>
            </form>
        </div>
    </div>
@endsection
