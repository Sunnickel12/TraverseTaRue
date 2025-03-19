<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Traverse Ta Rue')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/pagelogo.png') }}" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/header.js', 'resources/js/homepage.js'])
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        @include('partials.header')
    </header>

    <main>
        <nav class="bg-[#ffff] local-font-gliker">
            <div>
                <h1 class="text-[#6e9ae6] text-3xl font-bold mt-4 text-center">Traverse Ta Rue</h1>
                <p class="bg-[#3a3a3a] text-[#ffff] text-sm py-3 text-center">
                    Quelques pas suffisent pour saisir une opportunité !
                </p>
            </div>
            <!-- Banner avec barre de recherche superposée -->
            <div class="relative">
                <!-- Bannière -->
                <img src="{{ asset('images/banner2.png') }}" class="rounded-3xl mt-4 w-full" alt="banner z-[1]" />

                <!-- Barre de recherche superposée -->
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="relative w-[240px]">
                        <form id="searchForm"
                            class="flex items-center bg-white border-2 border-[#3a3a3a] rounded-lg shadow-md">
                            <!-- Bouton avec l'image de la loupe -->
                            <button type="submit"
                                class="flex items-center justify-center bg-white border-r-2 border-[#3a3a3a] hover:scale-110 active:scale-95 transition-transform focus:outline-none px-3 py-2 rounded-l-lg">
                                <img src="{{ asset('images/search.png') }}" alt="Search Icon"
                                    class="h-5 object-contain">
                            </button>
                            <!-- Champ de recherche -->
                            <input type="search" id="default-search"
                                class="block w-full p-2 pl-3 text-xs text-[#3a3a3a] border-none rounded-r-lg bg-white placeholder-gray-400 focus:ring-2 focus:ring-[#6e9ae6] focus:outline-none"
                                placeholder="Rechercher une opportunité..." required />
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <hr class="my-6 border-t-3 border-[#3a3a3a] opacity-50">
        </hr>

        <nav>
            <h1 class="text-[#6e9ae6] text-3xl text-center font-bold mt-6 local-font-gliker"> Qui sommes-nous ? </h1>
            <div class="mt-2 mx-0.5">
                <div id="paragraph-container"
                    class="overflow-hidden max-h-24 transition-all duration-200 ease-in-out rounded-3xl border-3 border-[#6e9ae6] bg-[#ffffff] shadow-lg p-2 mx-2 z-10">
                    <p id="paragraph" class="text-base text-[#3a3a3a] leading-relaxed">
                        Nous sommes une équipe de jeunes passionnés par l'entrepreneuriat et le développement
                        personnel. Nous avons décidé de créer cette plateforme pour vous aider à trouver des
                        opportunités de stage, d'emploi, de formation et de financement. Chez Traverse Ta Rue, nous
                        avons une mission : simplifier la recherche de stages et connecter facilement étudiants et
                        entreprises. Derrière cette initiative, Thomas, Shayna et Steven, trois passionnés de
                        numérique et d'innovation, convaincus qu'un bon stage peut ouvrir de grandes portes.
                        Notre plateforme centralise les offres, facilite les candidatures et permet aux entreprises
                        de trouver les talents de demain. Interface intuitive, fonctionnalités optimisées et accès
                        rapide aux opportunités : avec Traverse Ta Rue, postuler n'a jamais été aussi simple.
                        Ne cherchez plus, saisissez votre chance. Traversez la rue… et trouvez votre stage !
                    </p>
                </div>
                <!-- Bouton pour afficher plus / moins -->
                <button id="homeBtn"
                    class="block ml-auto mr-3 mt-3 px-3 py-1.5 bg-[#6e9ae6] text-white font-medium text-sm rounded-md shadow hover:bg-[#5a85d1] focus:ring-2 focus:ring-[#81affe] focus:outline-none transition-all">
                    Lire plus
                </button>
            </div>

            <!-- Cartes des membres de l'équipe -->
            <div class="relative mt-8">
                <!-- Conteneur des cartes -->
                <div class="justify-center space-x-5 mx-20 overflow-x-auto whitespace-nowrap scroll-smooth">
                    <!-- Carte 1 -->
                    <div class="inline-block w-50 h-full border-2 drop-shadow-xl border-[#3a3a3a] mb-4 rounded-lg">
                        <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center text-center h-full">
                            <img src="{{ asset('images/icon-user.png') }}" alt="Icon User"
                                class="w-16 h-16 rounded-full mb-4">
                            <h3 class="text-lg font-semibold text-[#3a3a3a]">Shayna</h3>
                        </div>
                    </div>

                    <!-- Carte 2 -->
                    <div class="inline-block w-50 h-full border-2 drop-shadow-xl border-[#3a3a3a] mb-4 rounded-lg">
                        <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center text-center">
                            <img src="{{ asset('images/icon-user.png') }}" alt="Icon User"
                                class="w-16 h-16 rounded-full mb-4">
                            <h3 class="text-lg font-semibold text-[#3a3a3a]">Thomas</h3>
                        </div>
                    </div>

                    <!-- Carte 3 -->
                    <div class="inline-block w-50 h-full border-2 drop-shadow-xl border-[#3a3a3a] mb-4 rounded-lg">
                        <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center text-center h-full">
                            <img src="{{ asset('images/icon-user.png') }}" alt="Icon User"
                                class="w-16 h-16 rounded-full mb-4">
                            <h3 class="text-lg font-semibold text-[#3a3a3a]">Steven</h3>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <hr class="my-6 border-t-3 border-[#3a3a3a] opacity-50">
        </hr>

        <!-- Entreprises Partenaires -->
        <nav>
            <nav>
                <h1 class="text-[#6e9ae6] text-3xl text-center font-bold local-font-gliker mt-12"> Entreprises
                    partenaires </h1>
            </nav>

            <!-- Carrousel des entreprises partenaires -->
            <div class="relative w-full mt-6">
                <div class="flex justify-between items-center mb-4 px-4">
                    <button id="prevBtn"
                        class="px-4 py-2 bg-[#6e9ae6] text-white rounded-full shadow-md hover:bg-[#5a85d1] focus:outline-none focus:ring-2 focus:ring-[#81affe] transition-all">◀</button>
                    <button id="nextBtn"
                        class="px-4 py-2 bg-[#6e9ae6] text-white rounded-full shadow-md hover:bg-[#5a85d1] focus:outline-none focus:ring-2 focus:ring-[#81affe] transition-all">▶</button>
                </div>

                <div id="partnerCarousel" class="flex overflow-x-auto space-x-6 snap-x scroll-smooth scrollbar-hide px-4">
                    <!-- Carte Entreprise 1 -->
                    <div
                        class="flex-shrink-0 w-80 border-2 border-[#3a3a3a] bg-gradient-to-b from-white to-gray-100 shadow-lg rounded-lg p-6 snap-center hover:scale-105 transition-transform duration-300">
                        <img src="{{ asset('images/capgemini.png') }}" alt="Capgemini Logo"
                            class="w-auto h-24 mx-auto mb-4 rounded-full border-2 border-[#6e9ae6]">
                        <h3 class="text-lg font-semibold text-[#3a3a3a] text-center">Capgemini</h3>
                        <p class="text-sm text-[#3a3a3a] text-center mt-2">Leader du conseil et services numériques, spécialisé en
                            transformation digitale.</p>
                    </div>

                    <!-- Carte Entreprise 2 -->
                    <div
                        class="flex-shrink-0 w-80 border-2 border-[#3a3a3a] bg-gradient-to-b from-white to-gray-100 shadow-lg rounded-lg p-6 snap-center hover:scale-105 transition-transform duration-300">
                        <img src="{{ asset('images/airbus.png') }}" alt="Airbus Logo"
                            class="w-auto h-24 mx-auto mb-4 rounded-full border-2 border-[#6e9ae6]">
                        <h3 class="text-lg font-semibold text-[#3a3a3a] text-center">Airbus</h3>
                        <p class="text-sm text-[#3a3a3a] text-center mt-2">Leader mondial de l'aéronautique et de l'industrie
                            spatiale.</p>
                    </div>

                    <!-- Carte Entreprise 3 -->
                    <div
                        class="flex-shrink-0 w-80 border-2 border-[#3a3a3a] bg-gradient-to-b from-white to-gray-100 shadow-lg rounded-lg p-6 snap-center hover:scale-105 transition-transform duration-300">
                        <img src="{{ asset('images/google.png') }}" alt="Google Logo"
                            class="w-auto h-24 mx-auto mb-4 rounded-xl border-2 border-[#6e9ae6]">
                        <h3 class="text-lg font-semibold text-[#3a3a3a] text-center">Google</h3>
                        <p class="text-sm text-[#3a3a3a] text-center mt-2">Géant de la technologie et de l'innovation numérique.</p>
                    </div>
                </div>
            </div>
    </main>
</body>

</html>
