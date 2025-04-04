@extends('layouts.navbar') 
// Extends the navbar layout

@section('title', 'Evaluer') 
// Sets the title of the page

@section('content')
@vite(['resources/js/app.js', 'resources/css/app.css']) 
// Includes the necessary CSS and JS files

<div class="container mx-auto mt-8 border border-black rounded-lg">
    <h1 class="text-2xl font-bold mb-4 text-center">Add Evaluation for {{ $company->name }}</h1> 
    <!-- Page heading displaying the company name -->

    <form action="{{ route('evaluations.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf 
        <!-- CSRF token for form security -->
        <input type="hidden" name="company_id" value="{{ $company->id }}"> 
        <!-- Hidden input to store the company ID -->

        <div class="mb-4">
            <label for="note" class="block text-gray-700 font-bold mb-2">Rating (1-5)</label> 
            <!-- Label for the rating -->
            <div id="star-rating" class="flex space-x-2">
                @for ($i = 1; $i <= 5; $i++) 
                <!-- Loop to display star icons for rating -->
                    <svg data-value="{{ $i }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8 text-gray-400 cursor-pointer star">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                    </svg>
                @endfor
            </div>
            <input type="hidden" name="note" id="note" required> 
            <!-- Hidden input to store the selected rating -->
        </div>

        <div class="mb-4">
            <label for="comment" class="block text-gray-700 font-bold mb-2">Comment (Optional)</label> 
            <!-- Label for the comment -->
            <textarea name="comment" id="comment" rows="4"
                class="w-full border border-black rounded-lg shadow-sm focus:ring focus:ring-blue-200"></textarea> 
            <!-- Textarea for the comment -->
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-md">
            Submit Evaluation
        </button> 
        <!-- Submit button -->
    </form>

    <!-- Back to Company Button -->
    <div class="mb-4">
        <a href="{{ route('companies.show', $company->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
            Back to {{ $company->name }}
        </a> 
        <!-- Button to navigate back to the company page -->
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('#star-rating .star'); 
        // Select all star icons
        const noteInput = document.getElementById('note'); 
        // Select the hidden input for the rating

        stars.forEach(star => {
            star.addEventListener('click', function() {
                const value = this.getAttribute('data-value'); 
                // Get the value of the clicked star
                noteInput.value = value; 
                // Set the value in the hidden input

                // Reset all stars to gray
                stars.forEach(s => {
                    s.classList.remove('text-yellow-500'); 
                    // Remove yellow color
                    s.classList.add('text-gray-400'); 
                    // Add gray color
                    s.setAttribute('fill', 'none'); 
                    // Reset fill to none
                });

                // Highlight selected stars in yellow
                for (let i = 0; i < value; i++) {
                    stars[i].classList.remove('text-gray-400'); 
                    // Remove gray color
                    stars[i].classList.add('text-yellow-500'); 
                    // Add yellow color
                    stars[i].setAttribute('fill', 'currentColor'); 
                    // Set fill to yellow
                }
            });
        });
    });
</script> 
<!-- Script to handle star rating interaction -->
@endsection