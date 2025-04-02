@extends('layouts.navbar')

@section('content')
@vite(['resources/js/app.js'])

<body>
    <nav class="bg-[#ffff] local-font-gliker">
        <div>
            <!-- Titre principal -->
            <h1 class="text-[#6e9ae6] text-3xl font-bold mt-4 text-center md:text-left md:text-5xl md:ml-6">
                Traverse Ta Rue</h1>
            <p class="bg-[#3a3a3a] text-[#ffff] text-sm py-3 text-center md:text-xl">
                Quelques pas suffisent pour saisir une opportunité !
            </p>
        </div>
        <!-- Banner avec barre de recherche superposée -->
        <div class="relative z-10 ">
            <!-- Bannière -->
            <img src="{{ asset('images/site/banner2.png') }}"
                class="rounded-3xl mt-4 w-full md:w-2xl lg:w-4xl xl:w-6xl block mx-auto" alt="banner z-[1]" />

            <!-- Barre de recherche superposée -->
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="relative w-[250px] md:w-[450px] lg:w-[600px] xl:w-[800px]">
                    <form id="searchForm"
                        class="flex items-center bg-white border-3 border-[#3a3a3a] rounded-lg shadow-md">
                        <!-- Bouton avec l'image de la loupe -->
                        <button type="submit"
                            class="flex items-center justify-center bg-white border-r-3 border-[#3a3a3a] transition-transform px-3 py-1.5 md:py-3 lg:py-3 xl:py-4 rounded-l-lg">
                            <img src="{{ asset('images/site/search.png') }}" alt="Search Icon"
                                class="h-4 object-contain md:mx-2 lg:h-6 lg:mx-2 xl:h-8 xl:mx-4">
                        </button>
                        <!-- Champ de recherche -->
                        <input type="search" id="default-search"
                            class="block w-full p-2 pl-3 text-[8px] md:text-sm lg:text-lg xl:text-xl text-[#3a3a3a] rounded-r-lg bg-white placeholder-gray-400 focus:outline-none"
                            placeholder="Rechercher une opportunité..." required />
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <hr class="my-6 border-t-3 border-[#3a3a3a] opacity-50">

    <nav>
        <h1
            class="text-[#6e9ae6] text-3xl text-center md:text-left md:text-5xl md:ml-6 font-bold mt-6 local-font-gliker">
            Qui sommes-nous ?
        </h1>
        <div class="mt-2 md:mt-3 mx-0.5">
            <div id="paragraph-container"
                class="overflow-hidden max-h-24 font-sans md:max-h-full transition-all duration-200 ease-in-out rounded-3xl border-3 border-[#6e9ae6] bg-[#ffffff] shadow-lg p-2 mx-2 z-10">
                <p id="paragraph" class="text-base lg:text-lg text-[#3a3a3a] leading-relaxed">
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
                class="block md:hidden ml-auto mr-3 mt-3 px-3 py-1.5 bg-[#6e9ae6] text-white font-medium text-sm rounded-md shadow hover:bg-[#5a85d1] focus:ring-2 focus:ring-[#81affe] focus:outline-none transition-all">
                Lire plus
            </button>
        </div>

        <!-- Cartes des membres de l'équipe -->
        <div class="relative mt-8">
            <!-- Conteneur des cartes -->
            <div
                class="flex justify-start md:justify-center space-x-5 mx-auto overflow-x-auto whitespace-nowrap scroll-smooth scrollbar-hide">
                <!-- Carte 1 -->
                <div
                    class="inline-block flex-shrink-0 w-64 h-full border-2 drop-shadow-xl border-[#3a3a3a] mb-4 rounded-lg ml-2">
                    <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center text-center h-full">
                        <img src="{{ asset('images/site/icon-user.png') }}" alt="Icon User"
                            class="w-16 h-16 rounded-full mb-4">
                        <h3 class="text-lg font-semibold text-[#3a3a3a]">Shayna</h3>
                    </div>
                </div>

                <!-- Carte 2 -->
                <div
                    class="inline-block flex-shrink-0 w-64 h-full border-2 drop-shadow-xl border-[#3a3a3a] mb-4 rounded-lg">
                    <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center text-center">
                        <img src="{{ asset('images/site/icon-user.png') }}" alt="Icon User"
                            class="w-16 h-16 rounded-full mb-4">
                        <h3 class="text-lg font-semibold text-[#3a3a3a]">Thomas</h3>
                    </div>
                </div>

                <!-- Carte 3 -->
                <div
                    class="inline-block flex-shrink-0 w-64 h-full border-2 drop-shadow-xl border-[#3a3a3a] mb-4 rounded-lg mr-2">
                    <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center text-center h-full">
                        <img src="{{ asset('images/site/icon-user.png') }}" alt="Icon User"
                            class="w-16 h-16 rounded-full mb-4">
                        <h3 class="text-lg font-semibold text-[#3a3a3a]">Steven</h3>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</body>
@endsection