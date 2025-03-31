<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offres de Stage</title>
    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Lien vers les fichiers CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/off.css') }}"> <!-- Utilisation de asset() -->
</head>
<body>
    <script src="{{ asset('js/script.js') }}"></script>

    <nav class="bg-[#3a3a3a] local-font-gliker shadow-md py-3 rounded-b-3xl fixed top-0 left-0 w-full z-50">
        <div class="flex mx-auto items-center">

            <!-- Menu burger à gauche (affiché sur mobile uniquement) -->
            <button id="burger-icon" class="md:hidden text-white focus:outline-none mr-2 md:mr-2">
                <img src="{{ asset('images/burger.png') }}" alt="Menu"
                    class="w-8 h-8 ml-1.5 justify-space-between md:mr-0">
            </button>

            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex hover:scale-110 transition duration-300">
                <img src="{{ asset('images/LogoTTR.png') }}" class="h-12 md:h-14 ml-2" alt="Logo" />
            </a>

            <!-- Navigation principale (mode PC) -->
            <div class="hidden md:flex absolute left-1/2 transform -translate-x-1/2 space-x-8 font-bold text-white">
                <a href="#"
                    class="md:text-2xl lg:text-3xl hover:text-[#6e9ae6] transition duration-200 hover:scale-110">Offres</a>
                <a href="#"
                    class="md:text-2xl lg:text-3xl hover:text-[#6e9ae6] transition duration-200 hover:scale-110">Entreprises</a>
                <a href="#"
                    class="md:text-2xl lg:text-3xl hover:text-[#6e9ae6] transition duration-200 hover:scale-110">Contact</a>
                <a href="{{ route('wishlist') }}"
                    class="md:text-2xl lg:text-3xl hover:text-[#6e9ae6] transition duration-200 hover:scale-110">Wishlist</a>
            </div>

            <!-- Bouton "Mon Compte" -->
            <button id="account-btn"
                class="bg-[#6e9ae6] text-white text-base md:text-xl lg:text-2xl xl:text-3xl rounded-full mr-2 px-2 py-2 flex items-center ml-auto hover:bg-white hover:text-[#6e9ae6] hover:scale-105 hover:ring-2 hover:ring-[#6e9ae6] transition-all duration-300">
                <img src="{{ asset('images/icon-user.png') }}" class=" bg-[#ffff] rounded-full w-6 h-6 md:w-8 md:h-8"
                    alt="User Icon" />
                <span class="ml-2">Compte</span>
            </button>
        </div>
    </nav>

    <!-- Overlay pour le menu mobile -->
    <div id="mobile-menu-overlay" class="hidden fixed inset-0 bg-black opacity-50 z-80"></div>

    <!-- Menu mobile (barre latérale) -->
    <div id="mobile-menu"
        class="md:hidden fixed top-0 left-0 w-50 h-full bg-[#2d2d2d] transform translate-x-full transition-transform duration-300 z-90 hidden">
        <div class="flex justify-end p-4">
            <button id="close-menu" class="text-white text-3xl">&times;</button>
        </div>
        <div class="flex flex-col space-y-4 mt-6 px-4">
            <a href="{{route('offres')}}"
                class="text-lg text-white bg-[#6e9ae6] hover:bg-[#5a85d1] py-2 px-4 rounded-lg text-center transition duration-200">Offres</a>
            <a href="#"
                class="text-lg text-white bg-[#6e9ae6] hover:bg-[#5a85d1] py-2 rounded-lg text-center transition duration-200">Entreprises</a>
            <a href="#"
                class="text-lg text-white bg-[#6e9ae6] hover:bg-[#5a85d1] py-2 px-4 rounded-lg text-center transition duration-200">Contact</a>
        </div>
    </div>

    <!-- Pop-up de connexion -->
    <div id="login-popup"
        class="local-font-gliker fixed top-0 w-full h-full flex justify-center items-center hidden z-100">
        <div class="bg-black opacity-50 absolute inset-0"></div>
        <div class="bg-white w-96 p-8 rounded-lg shadow-xl z-10 relative">
            <form>
                <div class="mb-6">
                    <label for="email"
                        class="block text-3xl text-center font-medium text-[#6e9ae6] mb-2">Identifiant</label>
                    <input type="email" id="email" name="email" placeholder="Entrez votre email"
                        class="w-full p-2 border-2 border-[#3a3a3a] rounded-md focus:border-[#6e9ae6] focus:ring-2 focus:ring-[#6e9ae6] focus:outline-none transition-all duration-300"
                        required>
                </div>
                <div class="mb-6">
                    <label for="password"
                        class="block text-xl md:text-3xl text-center font-medium text-[#6e9ae6] mb-2">Mot
                        de passe</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" placeholder="Mot de passe"
                            class="w-full p-2 pr-10 border-2 border-[#3a3a3a] rounded-md focus:border-[#6e9ae6] focus:ring-2 focus:ring-[#6e9ae6] focus:outline-none transition-all duration-300"
                            required>
                        <img id="toggle-password-icon" src="{{ asset('images/eye-closed.png') }}"
                            alt="Afficher/Masquer le mot de passe"
                            class="absolute right-4 top-1/2 transform -translate-y-1/2 cursor-pointer w-6 h-6">
                    </div>
                </div>
                <div class="flex items-center mb-4">
                    <input type="checkbox" id="remember-me"
                        class="w-6 h-6 border-2 border-[#3a3a3a] rounded-sm checked:bg-[#6e9ae6] focus:outline-none">
                    <label for="remember-me" class="ml-2 text-sm text-gray-700">Se souvenir de moi</label>
                </div>
                <div class="flex justify-between items-center">
                    <button type="submit"
                        class="bg-[#6e9ae6] text-white text-sm md:text-lg py-2 px-6 rounded-md hover:bg-[#6e9ae6] transform hover:scale-105">
                        Se connecter
                    </button>
                    <a href="#" class="text-sm text-[#6e9ae6] hover:underline">Mot de passe oublié ?</a>
                </div>
            </form>
            <button id="close-login-popup"
                class="absolute top-4 right-4 text-3xl text-gray-600 hover:text-[#6e9ae6] transition-all duration-200 transform hover:scale-110">&times;</button>
        </div>
    </div>

    <script>
        window.eyeClosedIcon = "{{ asset('images/eye-closed.png') }}";
        window.eyeOpenIcon = "{{ asset('images/eye-open.png') }}";
    </script>

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
    <h1>{{ $offres->isEmpty() ? 'Aucune offre disponible.' : $offres->count() . ' Offres Disponibles !' }}</h1> <!-- Dynamique, affiche le nombre d'offres -->
        
        <!-- Loop through the 'offres' and display them -->
        @foreach ($offres as $offre)
        <div class="job">
            <h2><a href="{{ route('offres.show', ['id_offers' => $offre->id_offers]) }}">{{ $offre->title }}</a></h2>
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
        @if ($offres->hasPages())
        <nav aria-label="Page navigation example" class="mt-4">
        <ul class="flex items-center -space-x-px h-8 text-sm">
            <!-- Bouton Précédent -->
            @if ($offres->onFirstPage())
            <li>
                <span class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-600 bg-white border border-gray-600 rounded-s-lg cursor-not-allowed">
                <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                </svg>
                </span>
            </li>
            @else
            <li>
                <a href="{{ $offres->previousPageUrl() }}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-[#6e9ae6] bg-white border border-[#6e9ae6] rounded-s-lg hover:bg-[#6e9ae6] hover:text-white">
                <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                </svg>
                </a>
            </li>
            @endif

            <!-- Numéros de pages -->
            @foreach ($offres->links()->elements[0] as $page => $url)
            <li>
                <a href="{{ $url }}" class="flex items-center justify-center px-3 h-8 leading-tight 
                {{ $page == $offres->currentPage() ? 'text-white bg-[#6e9ae6] border-[#6e9ae6]' : 'text-[#6e9ae6] bg-white border border-[#6e9ae6] hover:bg-[#6e9ae6] hover:text-white' }}">
                {{ $page }}
                </a>
            </li>
            @endforeach

            <!-- Bouton Suivant -->
            @if ($offres->hasMorePages())
            <li>
                <a href="{{ $offres->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 leading-tight text-[#6e9ae6] bg-white border border-[#6e9ae6] rounded-e-lg hover:bg-[#6e9ae6] hover:text-white">
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
