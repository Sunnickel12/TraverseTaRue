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
                    <strong>CV:</strong>
                    @if($postulation->cv)
                    <a href="{{ route('postulations.download', ['type' => 'cv', 'id' => $postulation->id]) }}" class="text-blue-500 hover:underline">
                        Download CV
                    </a>
                    @else
                    No CV uploaded
                    @endif
                </li>
                @if($postulation->motivation_letter)
                <li>
                    <strong>Motivation Letter:</strong>
                    <a href="{{ route('postulations.download', ['type' => 'motivation_letter', 'id' => $postulation->id]) }}" class="text-blue-500 hover:underline">
                        Download Motivation Letter
                    </a>
                </li>
                @endif
            </ul>
        </div>

        @if(auth()->user()->hasRole('admin') && isset($statuses))
        <div class="mt-6">
            <h3 class="text-lg font-bold">Modify Status:</h3>
            <form action="{{ route('postulations.update', ['id' => $postulation->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status_id" id="status" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        @foreach($statuses as $status)
                        <option value="{{ $status->id }}" {{ $postulation->status_id == $status->id ? 'selected' : '' }}>
                            {{ $status->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Update Status
                </button>
            </form>
        </div>
        @endif

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