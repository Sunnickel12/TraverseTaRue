@extends('layouts.navbar')

@section('title', 'Entreprise')


@section('content')
@vite(['resources/js/app.js', 'resources/css/app.css'])


<!-- Ajouter les fichiers CSS et JS de Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


<body class="local-font-gliker">
    <h1 class="text-[#6e9ae6] text-3xl font-bold mt-4 text-center md:text-left md:text-5xl md:ml-6">
        Companies
    </h1>

    <!-- Search bar -->
    <div class="flex items-center justify-center bg-[#3a3a3a] py-2 mt-1.5 md:mt-2.5">

        <!-- Bouton create admin -->
        @role('admin|pilote')
        <div class="text-start mx-4">
            <a href="{{ route('companies.create') }}" class="bg-[#6e9ae6] hover:bg-blue-400 text-white font-bold py-2 md:py-3 px-4 md:px-6 md:text-lg rounded-lg shadow-md transition">
                + Create Company
            </a>
        </div>
        @endrole

        <div class="relative w-full max-w-xs md:max-w-lg lg:max-w-xl xl:max-w-2xl">
            <form id="searchForm" action="{{ route('companies.index') }}" method="GET" class="flex items-center border-2 border-white rounded-lg shadow-md transition focus-within:border-[#6e9ae6] focus-within:ring-2 focus-within:ring-[#6e9ae6]">
                <button type="submit" class="flex items-center justify-center border-r-2 border-white px-3 py-2 rounded-l-lg">
                    <img src="{{ asset('images/site/white-search.png') }}" alt="Search Icon" class="h-4 md:h-6 xl:h-8 object-contain transition-transform duration-300 hover:scale-150 focus:scale-125">
                </button>
                <input type="search" name="search" value="{{ request('search') }}" id="default-search" class="block w-full p-2 text-white text-sm md:text-lg bg-transparent placeholder-white focus:outline-none transition" placeholder="Rechercher une entreprise..." />
            </form>
        </div>
    </div>



    <!-- Bouton pour afficher/masquer les filtres sur mobile -->
    <div class="md:hidden text-center mt-4">
        <button id="filterButton" class="bg-[#6e9ae6] text-white py-2 px-4 rounded-md transition">
            Ouvrir les filtres
        </button>
    </div>

    <div class="flex flex-col md:flex-row mt-6 gap-4">
        <!-- Sidebar Filtres -->
        <aside id="filterSidebar" class="w-auto mx-2 md:w-64 bg-white p-4 rounded-lg shadow-md hidden md:block border-2 border-[#3a3a3a]">
            <h2 class="text-xl text-[#3a3a3a] font-semibold mb-3">Filtres</h2>
            <form action="{{ route('companies.index') }}" method="GET">
                <div class="mb-4">
                    <label for="location" class="block text-sm font-medium text-gray-700">Lieu</label>
                    <select name="location[]" id="location" class="mt-1 block w-full p-2 border border-[#3a3a3a] rounded-md" multiple="multiple">
                        @foreach ($locations as $id => $city)
                        <option value="{{ $id }}" {{ in_array($id, request('location', [])) ? 'selected' : '' }}>{{ $city }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="category" class="block text-sm font-medium text-gray-700">Catégorie</label>
                    <select name="category[]" id="category" class="mt-1 block w-full p-2 border border-[#3a3a3a] rounded-md" multiple="multiple">
                        @foreach ($sectors as $id => $sector)
                        <option value="{{ $id }}" {{ in_array($id, request('category', [])) ? 'selected' : '' }}>{{ $sector }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="w-full bg-[#6e9ae6] text-white py-2 px-4 rounded-md hover:bg-blue-400 hover:scale-105 transition">
                    Filtrer
                </button>
            </form>
        </aside>


        <!-- Liste des entreprises -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:w-full mx-4 md:mx-8">
            @foreach ($companies as $company)
            <div class="border-2 border-[#3a3a3a] bg-white p-4 rounded-lg hover:shadow-black hover:shadow-2xl transition hover:scale-105 flex flex-col">
                <a href="{{ route('companies.show', $company->id) }}" class="block w-full h-30 overflow-hidden mb-4">
                    <img src="{{ asset(file_exists(public_path($path = 'images/company/' . ($company->logo ?? 'default-company.png'))) ? $path : 'images/company/default-company.png') }}"
                        alt="{{ $company->name }}"
                        class="w-full h-full object-contain rounded-md">
                </a>
                <a href="{{ route('companies.show', $company->id) }}" class="block">
                    <h2 class="text-xl font-semibold">
                        {{ $company->name }}
                        <span class="text-yellow-500 text-lg">
                            ({{ is_numeric($company->average_evaluation) ? number_format($company->average_evaluation, 1) : $company->average_evaluation }}/5 ⭐)
                        </span>
                    </h2>
                </a>
                <a href="{{ route('companies.show', $company->id) }}" class="block mb-4">
                    <p class="text-gray-600">{{ Str::limit($company->description, 100) }}</p>
                </a>

                <!-- Display Sectors -->
                <div class="flex flex-wrap gap-2 mt-4">
                    @foreach ($company->sectors as $sector)
                    <span class="bg-gray-200 text-gray-800 text-sm px-3 py-1 rounded-lg">{{ $sector->name }}</span>
                    @endforeach
                </div>

                @role('admin|pilote')
                <div class="mt-auto flex justify-center gap-4">
                    <a href="{{ route('companies.edit', $company->id) }}" class="bg-[#6e9ae6] hover:bg-blue-400 text-white font-bold py-2 px-4 rounded-lg shadow-md transition text-sm md:text-base lg:text-lg">
                        Edit
                    </a>
                    <form action="{{ route('companies.destroy', $company->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this company?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-900 text-white font-bold py-2 px-4 rounded-lg shadow-md transition text-sm md:text-base lg:text-lg">
                            Delete
                        </button>
                    </form>
                </div>
                @endrole
            </div>
            @endforeach
        </div>

    </div>

    <div class="mt-8 flex justify-center">
        {{ $companies->links() }}
    </div>
</body>
@endsection