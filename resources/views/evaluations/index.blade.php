@extends('layouts.navbar') 
// Extends the navbar layout

@section('title', 'Evaluation') 
// Sets the title of the page

@section('content')
@vite(['resources/js/app.js', 'resources/css/app.css']) 
// Includes the necessary CSS and JS files

<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">Evaluations for {{ $company->name }}</h1> 
    <!-- Page heading displaying the company name -->

    <!-- Back to Company Button -->
    <div class="mb-4">
        <a href="{{ route('companies.show', $company->id) }}" class="bg-[#6e9ae6] hover:bg-blue-400 text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
            ← Back to {{ $company->name }}
        </a>
    </div>

    <!-- Star Rating -->
    <div class="flex items-center mb-4">
        @for ($i = 1; $i <= 5; $i++) 
        <!-- Loop to display star icons based on the average rating -->
            @if ($i <= floor($averageRating)) 
            <!-- Filled star for ratings less than or equal to the average -->
            <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.957c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.175 0l-3.37 2.448c-.784.57-1.838-.197-1.54-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.01 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.286-3.957z"></path>
            </svg>
            @else 
            <!-- Empty star for ratings greater than the average -->
            <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.957c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.175 0l-3.37 2.448c-.784.57-1.838-.197-1.54-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.01 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.286-3.957z"></path>
            </svg>
            @endif
        @endfor
        <span class="ml-2 text-gray-700 font-bold">{{ number_format($averageRating, 1) ?? 'N/A' }}/5</span> 
        <!-- Displays the average rating -->
    </div>

    @if($evaluations->isEmpty()) 
    <!-- If no evaluations exist -->
        <div class="bg-gray-100 p-4 rounded-lg text-center">
            <p class="text-gray-700 font-bold">Aucune évaluation pour le moment</p> 
            <!-- Message for no evaluations -->
        </div>
    @else
        @foreach ($evaluations as $evaluation) 
        <!-- Loop through each evaluation -->
        <div class="bg-white p-4 rounded-lg border border-black shadow-md mb-4">
            <div>
                <p class="text-gray-700"><strong>Note:</strong> {{ $evaluation->note }}/5</p> 
                <!-- Displays the rating -->
                <p class="text-gray-700"><strong>Commentaire:</strong> {{ $evaluation->comment ?? 'Sans commentaire' }}</p> 
                <!-- Displays the comment -->
                <p class="text-gray-500 text-sm">Par {{ $evaluation->user->first_name }} le {{ $evaluation->created_at->format('d M Y') }}</p> 
                <!-- Displays the user and date -->
            </div>
            @role('admin') 
            <!-- Admin-only delete button -->
            <form action="{{ route('evaluations.destroy', $evaluation->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this evaluation?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-700 hover:bg-red-900 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                    Delete
                </button>
            </form>
            @endrole
        </div>
        @endforeach

        <!-- Pagination Links -->
        <div class="mt-6">
            {{ $evaluations->links() }} 
            <!-- Displays pagination links -->
        </div>
    @endif
</div>
@endsection