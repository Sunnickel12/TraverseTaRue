@extends('layouts.navbar')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">Evaluations for {{ $company->name }}</h1>

    <!-- Back to Company Button -->
    <div class="mb-4">
        <a href="{{ route('companies.show', $company->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
            Back to {{ $company->name }}
        </a>
    </div>

    <!-- Star Rating -->
    <div class="flex items-center mb-4">
        @for ($i = 1; $i <= 5; $i++)
            @if ($i <= floor($averageRating))
                <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.957c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.175 0l-3.37 2.448c-.784.57-1.838-.197-1.54-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.01 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.286-3.957z"></path>
                </svg>
            @else
                <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.957c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.175 0l-3.37 2.448c-.784.57-1.838-.197-1.54-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.01 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.286-3.957z"></path>
                </svg>
            @endif
        @endfor
        <span class="ml-2 text-gray-700 font-bold">{{ number_format($averageRating, 1) ?? 'N/A' }}/5</span>
    </div>

    @foreach ($evaluations as $evaluation)
    <div class="bg-white p-4 rounded-lg border border-black shadow-md mb-4">
        <div>    
            <p class="text-gray-700"><strong>Rating:</strong> {{ $evaluation->note }}/5</p>
            <p class="text-gray-700"><strong>Comment:</strong> {{ $evaluation->comment ?? 'No comment provided.' }}</p>
            <p class="text-gray-500 text-sm">By {{ $evaluation->user->first_name }} on {{ $evaluation->created_at->format('d M Y') }}</p>
        </div>
        @role('admin')
        <form action="{{ route('evaluations.destroy', $evaluation->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this evaluation?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                Delete
            </button>
        </form>
        @endrole
    </div>
    @endforeach

    <!-- Pagination Links -->
    <div class="mt-6">
        {{ $evaluations->links() }}
    </div>
</div>
@endsection