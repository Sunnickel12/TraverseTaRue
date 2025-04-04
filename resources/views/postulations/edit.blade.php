@extends('layouts.navbar')

@section('title', 'Edit Postulation')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold text-center mb-8">Edit Postulation</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('postulations.update', $postulation->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Ensure the PUT method is specified -->

            <!-- Hidden input to store the previous URL -->
            <input type="hidden" name="previous_url" value="{{ url()->previous() }}">

            <!-- Status -->
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

            <!-- CV -->
            <div class="mb-4">
                <label for="cv" class="block text-sm font-medium text-gray-700">CV</label>
                <p class="text-gray-500">
                    @if($postulation->cv)
                    <a href="{{ route('postulations.download', ['type' => 'cv', 'id' => $postulation->id]) }}" class="text-blue-500 hover:underline">
                        Download CV
                    </a>
                    @else
                    No CV uploaded
                    @endif
                </p>
            </div>

            <!-- Motivation Letter -->
            <div class="mb-4">
                <label for="motivation_letter" class="block text-sm font-medium text-gray-700">Motivation Letter</label>
                <p class="text-gray-500">
                    @if($postulation->motivation_letter)
                    <a href="{{ route('postulations.download', ['type' => 'motivation_letter', 'id' => $postulation->id]) }}" class="text-blue-500 hover:underline">
                        Download Motivation Letter
                    </a>
                    @else
                    No Motivation Letter uploaded
                    @endif
                </p>
            </div>

            <!-- Submit Button -->
            <div class="text-right">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Update Postulation
                </button>
            </div>
        </form>
    </div>
</div>
@endsection