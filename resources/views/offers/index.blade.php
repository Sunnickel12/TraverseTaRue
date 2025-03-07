@extends('layouts.app')

@section('content')
    <h1>Offers</h1>
    <a href="{{ route('offers.create') }}">Create New Offer</a>

    @foreach($offers as $offer)
        <div>
            <h2><a href="{{ route('offers.show', $offer) }}">{{ $offer->title }}</a></h2>
            <p>{{ $offer->description }}</p>
            <p><strong>Salary:</strong> {{ $offer->salary }}</p>
            <p><strong>Location:</strong> {{ $offer->location }}</p>
            <form action="{{ route('offers.destroy', $offer) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </div>
    @endforeach
@endsection
