<!-- filepath: c:\Users\steve\OneDrive\Documentos\01 Cesi\01 CPI 2\Blocs\Web\Projet\Git\WebSite\TraverseTaRue\resources\views\users\dashboard.blade.php -->
@extends('layouts.navbar')

@section('title', 'User Dashboard')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold text-center mb-8">User Dashboard</h1>

    <!-- User Details -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h2 class="text-xl font-bold mb-4">User Details</h2>
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Role:</strong> {{ $user->roles->pluck('name')->join(', ') }}</p>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Postulations Section -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-bold mb-4">Postulations</h2>
            @if($postulations->isEmpty())
            <p>No postulations found.</p>
            @else
            <ul>
                @foreach($postulations as $postulation)
                <li class="mb-2">
                    <strong>Offer:</strong> {{ $postulation->offer->title ?? 'N/A' }}<br>
                    <strong>Status:</strong> {{ $postulation->status }}
                </li>
                @endforeach
            </ul>
            @endif
        </div>

        <!-- Wishlist Section -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-bold mb-4">Wishlist</h2>
            @if($wishlist->isEmpty())
            <p>No items in your wishlist.</p>
            @else
            <ul>
                @foreach($wishlist as $offer)
                <li class="mb-2">
                    <strong>Offer:</strong> {{ $offer->title ?? 'N/A' }}
                </li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
</div>
@endsection