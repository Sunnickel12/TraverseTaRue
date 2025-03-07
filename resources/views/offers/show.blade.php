@extends('layouts.app')

@section('content')
    <h1>{{ $offer->title }}</h1>
    <p>{{ $offer->description }}</p>
    <p><strong>Salary:</strong> {{ $offer->salary }}</p>
    <p><strong>Location:</strong> {{ $offer->location }}</p>
    <p><strong>Company:</strong> {{ $offer->company->name }}</p>

    <a href="{{ route('offers.edit', $offer) }}">Edit</a>
    <form action="{{ route('offers.destroy', $offer) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endsection
