@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-4xl font-bold">{{ $offer->tittle }}</h1>
        <p class="mt-4"><strong>Company:</strong> {{ $offer->company->name }}</p>
        <p><strong>Location:</strong> {{ $offer->city->name }}</p>
        <p class="mt-2"><strong>Salary:</strong> 💰 {{ number_format($offer->salary, 2) }} €</p>
        <p class="mt-6">{{ $offer->contenu }}</p>

        <div class="mt-8 flex space-x-4">
            <a href="{{ route('offers.index') }}" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Back to All Offers</a>

            <a href="{{ route('postulations.create', $offer->id_offer) }}" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600">Apply Now</a>
        </div>
    </div>
@endsection
