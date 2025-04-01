@extends('layouts.navbar')

@section('content')
<div class="max-w-6xl mx-4 p-6 bg-white shadow-xl rounded-2xl border-2 border-[#3a3a3a] m-10 ">
    <!-- Conteneur principal -->
    <div class="flex flex-col md:flex-row items-center md:items-stretch gap-6">

        <!-- Company Logo -->
        <div class="w-full md:w-1/3 flex items-center justify-center md:self-stretch">
            <div class="w-40 h-40 md:w-60 md:h-60 p-3 rounded-xl flex items-center justify-center">
                <img src="{{ asset('images/' . $company->logo) }}" alt="Logo"
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
            <div class="mt-6 bg-white p-4 rounded-xl">
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

    <!-- Bouton Retour -->
    <div class="mt-6 flex justify-center">
        <a href="{{ route('companies.index') }}"
            class="bg-[#6e9ae6] text-white font-semibold py-3 px-6 rounded-lg shadow-md hover:bg-blue-400 transition duration-300 transform hover:scale-105">
            ← Back to All Companies
        </a>

        <!-- Button to create an evaluation -->
        <a href="{{ route('evaluations.create', $company->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
            Add Evaluation
        </a>

        <!-- Button to view all evaluations -->
        <a href="{{ route('evaluations.index', $company->id) }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
            View All Evaluations
        </a>
    </div>
</div>
@endsection