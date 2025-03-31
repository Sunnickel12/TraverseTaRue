<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>offers de Stage</title>
    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <section id="search">
    <form class="max-w-lg mx-auto">   
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search offers..." required />
        <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-[#6e9ae6] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
    </div>
</form>
    </section>

    <button id="filtres">Filtres</button>
    <div id="filter-menu" style="display: none;">
        <label><input type="checkbox" value="BAC+2" class="filter-checkbox"> BAC+2</label>
        <label><input type="checkbox" value="BAC+3/4" class="filter-checkbox"> BAC+3/4</label>
        <label><input type="checkbox" value="BAC" class="filter-checkbox"> BAC</label>
    </div>

    <main>
    <h1>{{ $offers->isEmpty() ? 'Aucune offre disponible.' : $offers->count() . ' offers Disponibles !' }}</h1> <!-- Dynamique, affiche le nombre d'offers -->
        
        <!-- Loop through the 'offers' and display them -->
        @foreach ($offers as $offre)
        <div class="job">
            <h2><a href="{{ route('offers.show', ['id_offers' => $offre->id_offers]) }}">{{ $offre->title }}</a></h2>
            <p class="published"> Publié il y a {{($offre->publication_date)}}</p> <!-- Affiche la date de publication -->
            <div class="characteristics">
                <button class="toutes">{{ $offre->niveau }}</button>
                <button class="toutes">{{ $offre->duree }}</button>
                <button class="toutes">{{ $offre->salary }} €/mois</button>
                <!--<button class="toutes">{{ $offre->skills }}</button>-->
            </div>
            <span class="heart" data-id="{{ $offre->id_offers }}">♡</span> <!-- Cœur vide par défaut -->
            <img src="{{ asset($offre->logo_path) }}" alt="Logo de {{ $offre->company->name }}" class="job-logo">
        </div>
        @endforeach
        <!-- PAGINATION PERSONNALISÉE -->
        @if ($offers->hasPages())
        <nav aria-label="Page navigation example" class="mt-4">
        <ul class="flex items-center -space-x-px h-8 text-sm">
            <!-- Bouton Précédent -->
            @if ($offers->onFirstPage())
            <li>
                <span class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-600 bg-white border border-gray-600 rounded-s-lg cursor-not-allowed">
                <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                </svg>
                </span>
            </li>
            @else
            <li>
                <a href="{{ $offers->previousPageUrl() }}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-[#6e9ae6] bg-white border border-[#6e9ae6] rounded-s-lg hover:bg-[#6e9ae6] hover:text-white">
                <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                </svg>
                </a>
            </li>
            @endif

            <!-- Numéros de pages -->
            @foreach ($offers->links()->elements[0] as $page => $url)
            <li>
                <a href="{{ $url }}" class="flex items-center justify-center px-3 h-8 leading-tight 
                {{ $page == $offers->currentPage() ? 'text-white bg-[#6e9ae6] border-[#6e9ae6]' : 'text-[#6e9ae6] bg-white border border-[#6e9ae6] hover:bg-[#6e9ae6] hover:text-white' }}">
                {{ $page }}
                </a>
            </li>
            @endforeach

            <!-- Bouton Suivant -->
            @if ($offers->hasMorePages())
            <li>
                <a href="{{ $offers->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 leading-tight text-[#6e9ae6] bg-white border border-[#6e9ae6] rounded-e-lg hover:bg-[#6e9ae6] hover:text-white">
                <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                </a>
            </li>
            @else
            <li>
                <span class="flex items-center justify-center px-3 h-8 leading-tight text-gray-600 bg-white border border-gray-600 rounded-e-lg cursor-not-allowed">
                <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                </span>
            </li>
            @endif
        </ul>
        </nav>
        @endif

        
        
    </main>
    
    <!-- Footer -->
    <footer class="bg-[#3a3a3a] p-4 mt-8">
        <nav class="flex space-x-8">
            <a href="#" class="text-white">Informations légales</a>
            <a href="#" class="text-white">CGU</a>
            <a href="#" class="text-white">Politique de confidentialité</a>
            <a href="#" class="text-white">Aide et Contact</a>
        </nav>
    </footer>
    <!-- Appel du script JS externe -->
    <script src="{{ asset('js/pagination.js') }}"></script>
    <script src="{{ asset('js/postulation.js') }}"></script>

</body>
</html>
