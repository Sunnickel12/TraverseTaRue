@extends('layouts.app')

@section('content')
<h1>Search Offers</h1>

<form action="{{ route('offers.search') }}" method="GET">
    <input type="text" name="keyword" placeholder="Search by title" value="{{ request('keyword') }}">
    
    <button type="submit">Search</button>
</form>

<h2>Results:</h2>
@if($offers->count())
    <ul>
        @foreach($offers as $offer)
            <li>
                <h3>{{ $offer->title }}</h3>
                <p>{{ $offer->content }}</p>
                <p>Salary: {{ $offer->salary }}</p>
                <p>Location: {{ $offer->city->name ?? 'Unknown' }}</p>
            </li>
        @endforeach
    </ul>
    {{ $offers->links() }}
@else
    <p>No results found.</p>
@endif
@endsection
