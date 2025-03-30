<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Wishlist</title>
    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Lien vers les fichiers CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/wish.css') }}"> <!-- Utilisation de asset() -->   
</head>
<body>
    <script src="{{ asset('js/script.js') }}"></script>

    <header>
        <nav class="bg-[#3a3a3a] local-font-gliker shadow-md py-3 rounded-b-lg">
        <div class="max-w-screen-xl mx-auto flex items-center justify-between px-4">

        <!-- Menu burger à gauche (affiché sur mobile uniquement) -->
        <button id="burger-icon" class="md:hidden text-white focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Logo -->
        <a href="{{ url('/') }}" class="flex items-center transform transition duration-300 hover:scale-110">
            <img src="{{ asset('images/LogoTTR.png') }}" class="h-10 md:h-12" alt="Logo" />
        </a>

        <!-- Navigation principale (mode PC) -->
        <div class="hidden md:flex justify-start space-x-8 font-bold text-white">
            <a href="{{ route('offres') }}" class="text-2xl hover:text-[#6e9ae6] transition duration-200 transform hover:scale-110">Offres</a>
            <a href="#" class="text-2xl hover:text-[#6e9ae6] transition duration-200 transform hover:scale-110">Entreprises</a>
            <a href="#" class="text-2xl hover:text-[#6e9ae6] transition duration-200 transform hover:scale-110">Contact</a>
        </div>

        <!-- Bouton "Mon Compte" -->
        <button id="account-btn" class="bg-[#6e9ae6] text-white text-lg rounded-full px-2 py-2 flex items-center hover:bg-white hover:text-[#6e9ae6] hover:scale-105 hover:ring-2 hover:ring-[#6e9ae6] transition-all duration-300">
            <img src="{{ asset('images/icon-user.png') }}" class="w-6 h-6 md:w-7 md:h-7" alt="User Icon" />
            <span class="ml-2">Mon Compte</span>
        </button>
        </div>

        <!-- Menu mobile (barre latérale) -->
        <div id="mobile-menu" class="md:hidden fixed top-0 left-0 w-48 h-full bg-[#2d2d2d] transform -translate-x-full transition-all duration-300 ease-in-out">
            <div class="flex justify-end p-4">
                <button id="close-menu" class="text-white text-3xl">&times;</button>
            </div>
            <div class="flex flex-col space-y-6 mt-6 px-4">
                <div class="space-y-4">
                    <a href="{{route('offres')}}" class="text-2xl text-white hover:text-[#6e9ae6] transition duration-200">Offres</a>
                    <a href="#" class="text-2xl text-white hover:text-[#6e9ae6] transition duration-200">Entreprises</a>
                    <a href="#" class="text-2xl text-white hover:text-[#6e9ae6] transition duration-200">Contact</a>
                    <a href="#" class="active">Wishlist</a>
                </div>
            </div>
        </div>
        </nav>

        <!-- Pop-up de connexion -->
        <div id="login-popup" class="local-font-gliker fixed top-0 left-0 w-full h-full flex justify-center items-center hidden">
            <div class="bg-black opacity-50 absolute inset-0"></div>
            <div class="bg-white w-96 p-8 rounded-lg shadow-xl z-10 relative">
                <form>
                    <div class="mb-6">
                        <label for="email" class="block text-3xl text-center font-medium text-[#6e9ae6] mb-2">Identifiant</label>
                        <input type="email" id="email" name="email" placeholder="Entrez votre email"
                            class="w-full p-2 border-2 border-[#3a3a3a] rounded-md focus:border-[#6e9ae6] focus:ring-2 focus:ring-[#6e9ae6] focus:outline-none transition-all duration-300" required>
                    </div>
                    <div class="relative w-full mb-4">
                        <input type="password" id="password" name="password" placeholder="Mot de passe"
                            class="w-full p-2 pr-10 border-2 border-[#3a3a3a] rounded-md focus:border-[#6e9ae6] focus:ring-2 focus:ring-[#6e9ae6] focus:outline-none transition-all duration-300"
                            required>
                        <img id="toggle-password-icon" src="{{ asset('images/eye-closed.png') }}" alt="Afficher/Masquer le mot de passe"
                            class="absolute right-0 top-1/2 transform -translate-y-1/2 cursor-pointer w-6 h-6" />
                    </div>
                    <div class="flex items-center mb-4">
                        <input type="checkbox" id="remember-me" class="w-4 h-4 text-[#6e9ae6] border-gray-300 rounded focus:ring-[#6e9ae6]">
                        <label for="remember-me" class="ml-2 text-sm text-gray-700">Se souvenir de moi</label>
                    </div>
                    <div class="flex justify-between items-center">
                        <button type="submit" class="bg-[#6e9ae6] text-white py-2 px-6 rounded-md hover:bg-[#5a85d1] transform hover:scale-105">
                            Se connecter
                        </button>
                        <a href="#" class="text-sm text-[#6e9ae6] hover:underline">Mot de passe oublié ?</a>
                    </div>
                </form>
                <button id="close-login-popup" class="absolute top-4 right-4 text-3xl text-gray-600 hover:text-[#6e9ae6] transition-all duration-200 transform hover:scale-110">&times;</button>
            </div>
        </div>


        <script src="{{ asset('js/header.js') }}"></script>
        <script>
            window.eyeClosedIcon = "{{ asset('images/eye-closed.png') }}";
            window.eyeOpenIcon = "{{ asset('images/eye-open.png') }}";
        </script>

    </header>

    <main>
        <!-- Liens de navigation -->
        <div class="menu">
            <a href="{{ route('w_offres') }}">Mes offres</a>
            <a href="{{ route('wishlist') }}">Mes favoris</a>
            <a href="{{ route('w_candidatures') }}" class="active">Mes candidatures</a>
        </div>

        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Mes candidatures</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            
        @endif
        <!-- Affichage des candidatures dans la wishlist -->
        <div class="wishlist-item bg-white p-6 rounded-lg shadow-md border border-gray-200">
            @if($postulations->isEmpty())
                <p>Aucune candidature enregistrée.</p>
            @else
                @foreach($postulations as $postulation)
                    <div class="wishlist-item">
                    <!-- Titre de l'offre -->
                    <h3 class="text-xl font-bold text-gray-900 mb-4">
                            @if($postulation->offer)
                                {{ $postulation->offer->title }}
                            @else
                                <span class="text-red-500">Offre supprimée</span>
                            @endif
                        </h3>
                        <p><strong>Statut :</strong> {{ ucfirst($postulation->status) }}</p>

                        <div class="files">
                            <a href="{{ Storage::url($postulation->cv) }}" target="_blank" class="file-link">
                                <img src="{{ asset('images/pdf_icon.png') }}" alt="CV" class="file-icon">
                                Télécharger le CV
                            </a>
                            @if($postulation->motivation_letter)
                                <a href="{{ Storage::url($postulation->motivation_letter) }}" target="_blank" class="file-link">
                                    <img src="{{ asset('images/pdf_icon.png') }}" alt="Lettre de Motivation" class="file-icon">
                                    Télécharger la Lettre de Motivation
                                </a>
                            @else
                                <p><em>Aucune lettre de motivation fournie.</em></p>
                            @endif
                        </div>
                            <!-- Bouton "Voir l'offre" -->
                            @if($postulation->offer)
                                <div class="postulation-actions">
                                    <a href="{{ route('offres.show', ['id_offers' => $postulation->offer->id_offers]) }}" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800">
                                        <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-transparent group-hover:dark:bg-transparent">
                                            Voir l'offre
                                        </span>
                                    </a>
                                </div>
                            @endif
                        </div>
                        

                    </div>
                @endforeach
            @endif
        </div>

    </main>

    <footer class="bg-gray-800 text-white py-4">
        <div class="left text-center mb-6">
            <a href="{{ route('info') }}" class="hover:text-[#6e9ae6]">Informations légales</a>
            <span class="mx-4">|</span>
            <a href="{{ route('cgu') }}" class="hover:text-[#6e9ae6]">CGU</a>
        </div>
        <div class="right text-center">
            <a href="{{ route('aide_contact') }}" class="hover:text-[#6e9ae6]">Aide et Contact</a>
        </div>
    </footer>
</body>
</html>