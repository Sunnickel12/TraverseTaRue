@extends('layouts.navbar')

@section('title', 'Postulation Details')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold text-center mb-8">Postulation Details</h1>

    @if(auth()->user()->id === $postulation->user_id || auth()->user()->hasRole('admin'))
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4">Offer: {{ $postulation->offer->title ?? 'N/A' }}</h2>
        <p><strong>Status:</strong> {{ $postulation->status->name ?? 'N/A' }}</p>
        <p><strong>Submitted by:</strong> {{ $postulation->user->name ?? 'Unknown User' }}</p>

        <div class="mt-4">
            <h3 class="text-lg font-bold">Files:</h3>
            <ul>
                <li>
                    <strong>CV:</strong> {{ $postulation->cv ?? 'No CV uploaded' }}
                </li>
                @if($postulation->motivation_letter)
                <li>
                    <strong>Motivation Letter:</strong> {{ $postulation->motivation_letter }}
                </li>
                @endif
            </ul>
        </div>

        <div class="mt-6 flex space-x-4">
            @if(auth()->user()->hasRole('admin'))
            <a href="{{ route('postulations.edit', ['id' => $postulation->id]) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                Edit
            </a>
            @endif

            <form action="{{ route('postulations.delete', $postulation->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this postulation?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    Delete
                </button>
            </form>
        </div>
    </div>
    @else
    <div class="bg-red-100 text-red-700 p-4 rounded-lg">
        <p>You are not authorized to view this postulation.</p>
    </div>
    @endif
</div>
@endsection