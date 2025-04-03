@extends('layouts.navbar')

@section('title', 'Offres de Stage')

@section('content')
<!-- Include Select2 CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<body class="local-font-gliker">
    <h1 class="text-[#6e9ae6] text-3xl font-bold mt-4 text-center md:text-left md:text-5xl md:ml-6">
        Offres de Stage
    </h1>

    <!-- Search bar -->
    <div class="flex items-center justify-center bg-[#3a3a3a] py-2 mt-1.5 md:mt-2.5">
        <!-- Create Offer Button -->
        @role('admin|pilote')
        <div class="text-start mx-4">
            <a href="{{ route('offers.create') }}" class="bg-[#6e9ae6] hover:bg-blue-400 text-white font-bold py-2 md:py-3 px-4 md:px-6 md:text-lg rounded-lg shadow-md transition">
                + Créer une Offre
            </a>
        </div>
        @endrole

        <div class="relative w-full max-w-xs md:max-w-lg lg:max-w-xl xl:max-w-2xl">
            <form id="searchForm" action="{{ route('offers.index') }}" method="GET" class="flex items-center border-2 border-white rounded-lg shadow-md transition focus-within:border-[#6e9ae6] focus-within:ring-2 focus-within:ring-[#6e9ae6]">
                <button type="submit" class="flex items-center justify-center border-r-2 border-white px-3 py-2 rounded-l-lg">
                    <img src="{{ asset('images/site/white-search.png') }}" alt="Search Icon" class="h-4 md:h-6 xl:h-8 object-contain transition-transform duration-300 hover:scale-150 focus:scale-125">
                </button>
                <input type="search" name="search" value="{{ request('search') }}" id="default-search" class="block w-full p-2 text-white text-sm md:text-lg bg-transparent placeholder-white focus:outline-none transition" placeholder="Rechercher une offre..." />
            </form>
        </div>
    </div>

    <!-- Toggle Filters Button for Mobile -->
    <div class="md:hidden text-center mt-4">
        <button id="filterButton" class="bg-[#6e9ae6] text-white py-2 px-4 rounded-md transition">
            Ouvrir les filtres
        </button>
    </div>

    <div class="flex flex-col md:flex-row mt-6 gap-4">
        <!-- Sidebar Filters -->
        <aside id="filterSidebar" class="w-auto mx-2 md:w-64 bg-white p-4 rounded-lg shadow-md hidden md:block border-2 border-[#3a3a3a]">
            <h2 class="text-xl text-[#3a3a3a] font-semibold mb-3">Filtres</h2>
            <form action="{{ route('offers.index') }}" method="GET">
                <!-- Skills -->
                <div class="mb-4">
                    <label for="skills" class="block text-sm font-medium text-gray-700">Compétences</label>
                    <select name="skills[]" id="skills" class="select2 mt-1 block w-full p-2 border border-[#3a3a3a] rounded-md" multiple="multiple">
                        @foreach ($skills as $id => $skill)
                        <option value="{{ $id }}" {{ in_array($id, request('skills', [])) ? 'selected' : '' }}>{{ $skill }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- City -->
                <div class="mb-4">
                    <label for="city" class="block text-sm font-medium text-gray-700">Ville</label>
                    <select name="city[]" id="city" class="select2 mt-1 block w-full p-2 border border-[#3a3a3a] rounded-md" multiple="multiple">
                        @foreach ($cities as $id => $city)
                        <option value="{{ $id }}" {{ in_array($id, request('city', [])) ? 'selected' : '' }}>{{ $city }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Sector -->
                <div class="mb-4">
                    <label for="sector" class="block text-sm font-medium text-gray-700">Secteur</label>
                    <select name="sector[]" id="sector" class="select2 mt-1 block w-full p-2 border border-[#3a3a3a] rounded-md" multiple="multiple">
                        @foreach ($sectors as $id => $sector)
                        <option value="{{ $id }}" {{ in_array($id, request('sector', [])) ? 'selected' : '' }}>{{ $sector }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Company -->
                <div class="mb-4">
                    <label for="company" class="block text-sm font-medium text-gray-700">Entreprise</label>
                    <select name="company[]" id="company" class="select2 mt-1 block w-full p-2 border border-[#3a3a3a] rounded-md" multiple="multiple">
                        @foreach ($companies as $id => $company)
                        <option value="{{ $id }}" {{ in_array($id, request('company', [])) ? 'selected' : '' }}>{{ $company }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="w-full bg-[#6e9ae6] text-white py-2 px-4 rounded-md hover:bg-blue-400 hover:scale-105 transition">
                    Filtrer
                </button>
            </form>
        </aside>

        <!-- Offers List -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:w-full mx-4 md:mx-8">
            @foreach ($offers as $offer)
            <div class="border-2 border-[#3a3a3a] bg-white p-4 rounded-lg hover:shadow-black hover:shadow-2xl transition hover:scale-105 flex flex-col">
                <a href="{{ route('offers.show', $offer->id) }}" class="block w-full h-30 overflow-hidden mb-4">
                    <img src="{{ asset('images/company/' . ($offer->company->logo_path ?? 'default-company.png')) }}" alt="Logo de {{ $offer->company->name ?? 'Entreprise inconnue' }}" class="w-full h-full object-contain rounded-md">
                </a>
                <a href="{{ route('offers.show', $offer->id) }}" class="block">
                    <h2 class="text-xl font-semibold">
                        {{ $offer->title }}
                    </h2>
                    <p class="text-sm text-gray-500">Publié {{ $offer->created_at->diffForHumans(['locale' => 'fr']) }}</p>
                    <p class="text-sm text-gray-500">Publié par : {{ $offer->company->name ?? 'Inconnue' }}</p>
                </a>
                <a href="{{ route('offers.show', $offer->id) }}" class="block mb-4">
                    <p class="text-gray-600">{{ Str::limit($offer->description, 100) }}</p>
                </a>
                <div class="flex flex-wrap gap-2 mt-4">
                    <span class="bg-[#6e9ae6] text-white text-sm px-3 py-1 rounded-lg">{{ $offer->level }}</span>
                    <span class="bg-[#6e9ae6] text-white text-sm px-3 py-1 rounded-lg">{{ $offer->duration }}</span>
                    <span class="bg-[#6e9ae6] text-white text-sm px-3 py-1 rounded-lg">{{ $offer->salary }} €/mois</span>
                    @foreach ($offer->skills->take(3) as $skill)
                    <span class="bg-gray-200 text-gray-800 text-sm px-3 py-1 rounded-lg">{{ $skill->name }}</span>
                    @endforeach
                </div>
                @role('admin|pilote')
                <div class="mt-auto flex justify-center gap-4">
                    <a href="{{ route('offers.edit', $offer->id) }}" class="bg-[#6e9ae6] hover:bg-blue-400 text-white font-bold py-2 px-4 rounded-lg shadow-md transition text-sm md:text-base lg:text-lg">
                        Edit
                    </a>
                    <form action="{{ route('offers.destroy', $offer->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this offer?');">
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
        {{ $offers->links() }}
    </div>
</body>

<!-- Initialize Select2 -->
<script>
    $(document).ready(function() {
        // Initialize Select2 for dropdowns
        $('.select2').select2({
            placeholder: "Sélectionnez une option",
            allowClear: true
        });

        // Toggle filters on mobile
        $('#filterButton').on('click', function() {
            const filterSidebar = $('#filterSidebar');
            if (filterSidebar.hasClass('hidden')) {
                filterSidebar.removeClass('hidden').addClass('block'); // Show the filter sidebar
            } else {
                filterSidebar.removeClass('block').addClass('hidden'); // Hide the filter sidebar
            }
        });
    });
</script>
@endsection