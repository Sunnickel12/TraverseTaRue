@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto p-6">
        <h1 class="text-2xl font-bold">Apply for {{ $offer->tittle }}</h1>

        <form action="{{ route('applications.store', $offer->id) }}" method="POST" enctype="multipart/form-data" class="mt-6">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700">Full Name</label>
                <input type="text" name="name" class="w-full border rounded-lg p-2" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" class="w-full border rounded-lg p-2" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Cover Letter</label>
                <textarea name="cover_letter" class="w-full border rounded-lg p-2" rows="5" required></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Upload Resume (PDF only)</label>
                <input type="file" name="resume" class="w-full border rounded-lg p-2" accept=".pdf" required>
            </div>

            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600">Submit Application</button>
        </form>
    </div>
@endsection
