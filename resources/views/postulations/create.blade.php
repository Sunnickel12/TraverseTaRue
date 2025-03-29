@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto p-6">
        <h1 class="text-2xl font-bold">Apply for {{ $offer->tittle }}</h1>

        <form action="{{ route('postulations.store', $offer->id_offer) }}" method="POST" enctype="multipart/form-data" class="mt-6">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700">Upload CV (PDF only)</label>
                <input type="file" name="cv" class="w-full border rounded-lg p-2" accept=".pdf" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Upload Motivation Letter (Optional, PDF only)</label>
                <input type="file" name="motivation_letter" class="w-full border rounded-lg p-2" accept=".pdf">
            </div>

            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600">Submit Application</button>
        </form>
    </div>
@endsection
