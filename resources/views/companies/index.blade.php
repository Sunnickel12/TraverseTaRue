@extends('layouts.navbar')

@section('title', 'Companies List')


@section('content')
@vite(['resources/js/header.js'])

<body class="local-font-gliker">
    <h1 class="text-[#6e9ae6] text-3xl font-bold mt-4 text-center md:text-left md:text-5xl md:ml-6">
        Companies</h1>

    <!-- Search bar -->
    <div class="inset-0 flex items-center justify-center bg-[#3a3a3a] py-2 mt-1.5 md:mt-2.5">
        <div class="relative w-[250px] md:w-[450px] lg:w-[600px] xl:w-[800px]">
            <form id="searchForm" action="{{ route('companies.index') }}" method="GET"
                class="flex items-center border-2 border-[#ffffff] rounded-lg shadow-md transition-colors duration-300 
            focus-within:border-[#6e9ae6] focus-within:ring-2 focus-within:ring-[#6e9ae6]">

                <!-- Bouton avec l'image de la loupe -->
                <button type="submit"
                    class="flex items-center justify-center border-r-2 border-[#ffffff] px-3 py-1.5 md:py-3 lg:py-3 xl:py-4 rounded-l-lg">
                    <img src="{{ asset('images/white-search.png') }}" alt="Search Icon"
                        class="h-4 object-contain transition-transform duration-300 hover:scale-150 focus:scale-125 md:mx-2 lg:h-6 lg:mx-2 xl:h-8 xl:mx-4">
                </button>

                <!-- Champ de recherche -->
                <input type="search" name="search" value="{{ request('search') }}" id="default-search"
                    class="block w-full p-2 pl-3 text-[8px] md:text-sm lg:text-lg xl:text-xl text-[#ffffff] rounded-r-lg bg-transparent placeholder-white focus:outline-none 
                transition-colors duration-300"
                    placeholder="Rechercher une entreprise..." />
            </form>
        </div>
    </div>


    <!-- Check if the user has the "admin" or "manager" role -->
    @role('admin|manager')
    <a href="{{ route('companies.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
        + Create Company
    </a>
    @endrole

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        @foreach($companies as $company)
        <div class="border border-gray-300 p-4 rounded-lg hover:shadow-lg transition flex flex-col">
            <!-- Clickable image -->
            <a href="{{ route('companies.show', $company->id) }}" class="w-full h-40 overflow-hidden mb-4 block">
                <img src="{{ asset('images/' . $company->logo) }}" alt="{{ $company->name }}" class="w-full h-full object-cover rounded-md">
            </a>

            <!-- Clickable text -->
            <a href="{{ route('companies.show', $company->id) }}" class="block">
                <h2 class="text-xl font-semibold">{{ $company->name }}</h2>
            </a>
            <a href="{{ route('companies.show', $company->id) }}" class="block">
                <p class="text-gray-600">{{ Str::limit($company->description, 100) }}</p>
            </a>

            <!-- Check if the user has the "admin" or "manager" role -->
            @role('admin')
            <div class="mt-4 flex justify-between gap-2">
                <div>
                    <a href="{{ route('companies.edit', $company->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition block">
                        Edit
                    </a>
                </div>
                <div>
                    <form action="{{ route('companies.destroy', $company->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this company?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition block">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
            @endrole
        </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $companies->links() }}
    </div>
</body>
@endsection