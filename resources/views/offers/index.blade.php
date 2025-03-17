@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Job Offers</h1>

    <div class="grid grid-cols-3 gap-6">
        @foreach($offers as $offer)
            <a href="{{ route('offers.show', $offer) }}" class="block border rounded-lg shadow-lg p-4 hover:shadow-xl transition">
                <h2 class="text-xl font-semibold">{{ $offer->tittle }}</h2>
                <p class="text-gray-600">{{ Str::limit($offer->contenu, 100) }}</p>
                <p class="text-green-500 mt-2">💼 {{ $offer->company->name }}</p>
                <p class="text-blue-500 mt-2">📍 {{ $offer->city->name }}</p>
                <p class="mt-2">💰 {{ number_format($offer->salary, 2) }} €</p>
            </a>
        @endforeach
    </div>

    <div class="mt-8">{{ $offers->links() }}</div>
@endsection
