<!-- filepath: resources/views/user/dashboard.blade.php -->

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto mt-8">
    <div class="grid grid-cols-2 gap-4">
        <!-- Postulations Section -->
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-xl font-bold mb-4">My Postulations</h2>
            @if($postulations->isEmpty())
                <p>No postulations found.</p>
            @else
                <ul>
                    @foreach($postulations as $postulation)
                        <li class="mb-2">
                            <strong>Offer:</strong> {{ $postulation->offer->tittle ?? 'N/A' }}<br>
                            <strong>Status:</strong> {{ $postulation->status }}<br>
                            <strong>Motivation Letter:</strong> {{ $postulation->motivation_letter }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Wishlist Section -->
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-xl font-bold mb-4">My Wishlist</h2>
            @if($wishlist->isEmpty())
                <p>No items in your wishlist.</p>
            @else
                <ul>
                    @foreach($wishlist as $item)
                        <li class="mb-2">
                            <strong>Wishlist Item ID:</strong> {{ $item->id_wishlist }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection