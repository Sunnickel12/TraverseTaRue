@extends('layouts.app')

@section('content')
    <h1>Edit Offer</h1>

    <form action="{{ route('offers.update', $offer) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Title: <input type="text" name="title" value="{{ $offer->title }}" required></label><br>
        <label>Description: <textarea name="description" required>{{ $offer->description }}</textarea></label><br>
        <label>Salary: <input type="number" name="salary" value="{{ $offer->salary }}" required></label><br>
        <label>Location: <input type="text" name="location" value="{{ $offer->location }}" required></label><br>
        <label>Company ID: <input type="number" name="company_id" value="{{ $offer->company_id }}" required></label><br>
        <button type="submit">Update</button>
    </form>
@endsection
