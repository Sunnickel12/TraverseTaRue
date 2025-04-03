@extends('layouts.navbar')

@section('title', 'Edit Postulation')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold text-center mb-8">Edit Postulation</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        {{-- <form action="{{ route('postulations.update', ['id' => $postulation->id]) }}" method="POST"> --}}
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

            <div class="text-right">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Update Status
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
