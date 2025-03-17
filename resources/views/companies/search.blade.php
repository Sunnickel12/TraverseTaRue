@extends('layouts.app')

@section('content')
<h1>Search Companies</h1>

<form action="{{ route('companies.search') }}" method="GET">
    <input type="text" name="keyword" placeholder="Keyword" value="{{ request('keyword') }}">

    <select name="region">
        <option value="">Select Region</option>
        @foreach($regions as $region)
            <option value="{{ $region->id_region }}" {{ request('region') == $region->id_region ? 'selected' : '' }}>
                {{ $region->name }}
            </option>
        @endforeach
    </select>

    <select name="city">
        <option value="">Select City</option>
        @foreach($cities as $city)
            <option value="{{ $city->id_city }}" {{ request('city') == $city->id_city ? 'selected' : '' }}>
                {{ $city->name }}
            </option>
        @endforeach
    </select>

    <button type="submit">Search</button>
</form>

<h2>Results:</h2>
@if($companies->count())
    <ul>
        @foreach($companies as $company)
            <li>
                <h3>{{ $company->name }}</h3>
                <p>Location: {{ $company->city->name ?? 'Unknown' }}</p>
            </li>
        @endforeach
    </ul>
    {{ $companies->links() }}
@else
    <p>No results found.</p>
@endif
@endsection
