@extends('layouts.navbar')

@section('content')
@if(auth()->check() && auth()->user()->id_role === 1)
<div class="container">
    <h1 class="text-3xl font-bold mb-6">Edit Company</h1>

    <form action="{{ route('companies.update', $company->id_company) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold">Name</label>
            <input type="text" name="name" class="w-full border rounded-lg p-2" value="{{ $company->name }}" required>
        </div>

        <div>
            <label class="block font-semibold">Address</label>
            <input type="text" name="address" class="w-full border rounded-lg p-2" value="{{ $company->address }}" required>
        </div>

        <div>
            <label class="block font-semibold">Description</label>
            <textarea name="description" class="w-full border rounded-lg p-2" required>{{ $company->description }}</textarea>
        </div>

        <div>
            <label class="block font-semibold">Email</label>
            <input type="email" name="email" class="w-full border rounded-lg p-2" value="{{ $company->email }}">
        </div>

        <div>
            <label class="block font-semibold">Phone</label>
            <input type="text" name="phone" class="w-full border rounded-lg p-2" value="{{ $company->phone }}">
        </div>

        <div>
            <label class="block font-semibold">Current Logo</label>
            @if($company->logo)
            <img src="{{ asset('storage/images/' . $company->logo) }}" alt="Company Logo" class="w-40 h-40 object-cover rounded-md border">
            @else
            <p>No logo available</p>
            @endif
        </div>

        <div>
            <label class="block font-semibold">New Logo</label>
            <input type="file" name="logo" class="w-full border rounded-lg p-2">
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
            Update
        </button>
    </form>
</div>
@else
<p class="text-red-500 font-bold">You are not authorized to view this page.</p>
@endif
@endsection