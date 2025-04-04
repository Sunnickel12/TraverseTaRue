@extends('layouts.navbar')

@section('title', 'Entreprises')

@section('content')
@vite(['resources/js/app.js', 'resources/css/app.css'])

<div class="max-w-6xl mx-4 lg:mx-auto p-6 shadow-xl rounded-2xl border-3 border-[#3a3a3a] my-20">
    <!-- Conteneur principal centré -->
    <div class="flex flex-col md:flex-row items-center justify-center gap-6">

        <!-- Company Logo -->
        <div class="w-full md:w-1/3 flex items-center justify-center md:self-stretch">
            <div class="w-40 h-40 md:w-60 md:h-60 p-3 rounded-xl flex items-center justify-center">
                <img src="{{ asset(file_exists(public_path($path = 'images/company/' . ($company->logo ?? 'default-company.png'))) ? $path : 'images/company/default-company.png') }}"
                    alt="Logo"
                    class="w-full h-full object-contain rounded-lg">
            </div>
        </div>

        <!-- Company Info -->
        <div class="w-full md:w-2/3 text-center md:text-left">
            <h1 class="text-3xl md:text-5xl text-[#6e9ae6] font-extrabold">{{ $company->name }}</h1>

            <p class="mt-4 text-base md:text-lg text-[#3a3a3a]">
                <strong class="text-[#3a3a3a] text-lg md:text-2xl">Adresse:</strong> {{ $company->address }}
            </p>
            <p class="mt-2 text-base md:text-lg text-gray-700">
                <strong class="text-[#3a3a3a]">Description:</strong> {{ $company->description }}
            </p>

            <!-- Contact Information -->
            <div class="mt-6 p-4 rounded-xl">
                <h2 class="text-xl md:text-2xl font-semibold text-[#3a3a3a] mb-2">Contact</h2>
                <p class="text-gray-700">
                    <strong>Email:</strong>
                    <a href="mailto:{{ $company->email }}" class="text-[#6e9ae6] hover:underline">
                        {{ $company->email }}
                    </a>
                </p>
                <p class="text-gray-700"><strong>Phone:</strong> {{ $company->phone ?? 'Aucun numéro renseigné' }}</p>
            </div>
        </div>
    </div>

    <!-- Boutons avec centrage et amélioration -->
    <div class="mt-6 flex flex-wrap justify-center gap-3">
        <a href="{{ route('companies.index') }}"
            class="bg-[#6e9ae6] text-white font-semibold py-3 px-6 sm:px-8 md:px-10 lg:px-12 text-xs sm:text-lg md:text-lg lg:text-xl rounded-lg shadow-md hover:bg-blue-400 transition duration-300 transform hover:scale-105 text-center">
            ← Back to All Companies
        </a>

        <a href="{{ route('evaluations.create', $company->id) }}"
            class="bg-[#6e9ae6] hover:bg-blue-400 text-white font-bold py-3 px-6 sm:px-8 md:px-10 lg:px-12 text-xs sm:text-lg md:text-xl lg:text-xl rounded-lg shadow-md transition duration-300 transform hover:scale-105 text-center">
            + Evaluation
        </a>

        <a href="{{ route('evaluations.index', $company->id) }}"
            class="bg-[#6e9ae6] hover:bg-blue-400 text-white font-bold py-3 px-6 sm:px-8 md:px-10 lg:px-12 text-xs sm:text-lg md:text-xl lg:text-xl rounded-lg shadow-md transition duration-300 transform hover:scale-105 text-center">
            Voir toutes les évaluations
        </a>
    </div>
</div>

<!-- Section pour les stats -->
<div class="max-w-6xl mx-4 lg:mx-auto p-6 shadow-xl rounded-2xl border-3 border-[#3a3a3a] my-20">
    <h2 class="text-2xl md:text-3xl font-bold text-[#6e9ae6] mb-6 text-center">Statistiques</h2>
    <div class="flex flex-col md:flex-row justify-center items-center gap-6">
        <!-- Number of Offers -->
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-300 text-center w-64">
            <img src="{{ asset('images/company/bag.png') }}" alt="Offers Icon" class="w-16 h-16 mx-auto mb-4">
            <h3 class="text-lg font-semibold text-[#3a3a3a]">Nombre d'offres</h3>
            <p class="text-4xl font-bold text-[#6e9ae6]">{{ $company->offers_count ?? 0 }}</p>
        </div>

        <!-- Average Notation -->
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-300 text-center w-64">
            <h3 class="text-lg font-semibold text-[#3a3a3a]">Note Moyenne</h3>
            <div class="flex justify-center items-center gap-2 mt-2">
                <p class="text-4xl font-bold text-[#6e9ae6]">
                    {{ is_numeric($company->average_evaluation) ? number_format($company->average_evaluation, 1) : 'N/A' }}
                </p>
                <svg class="w-8 h-8 text-yellow-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.957c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.175 0l-3.37 2.448c-.784.57-1.838-.197-1.54-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.01 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.286-3.957z"></path>
                </svg>
            </div>
            <p class="text-sm text-gray-500 mt-2">{{ $company->ratings_count ?? 0 }} avis</p>
        </div>

        <!-- Number of Employees -->
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-300 text-center w-64">
            <img src="{{ asset('images/company/team.png') }}" alt="Employees Icon" class="w-16 h-16 mx-auto mb-4">
            <h3 class="text-lg font-semibold text-[#3a3a3a]">Nombre d'employés</h3>
            <p class="text-4xl font-bold text-[#6e9ae6]">250</p> <!-- Static value -->
        </div>
    </div>
</div>
@endsection