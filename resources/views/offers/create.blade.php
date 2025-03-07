@extends('layouts.app')

@section('content')
    <h1>Create Offer</h1>

    <form action="{{ route('offers.store') }}" method="POST">
        @csrf
        <label>Title: <input type="text" name="title" required></label><br>
        <label>Description: <textarea name="description" required></textarea></label><br>
        <label>Salary: <input type="number" name="salary" required></label><br>
        <label>Location: <input type="text" name="location" required></label><br>
        <label>Company ID: <input type="number" name="company_id" required></label><br>
        <button type="submit">Create</button>
    </form>
@endsection
