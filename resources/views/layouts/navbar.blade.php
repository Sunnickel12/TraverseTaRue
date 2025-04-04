<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta tags for character encoding and responsive design -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Page title with a default value -->
    <title>@yield('title', 'Traverse Ta Rue')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/site/pagelogo.png') }}" />

    <!-- Manifest for PWA -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <!-- Service Worker registration -->
    <script>
        if ("serviceWorker" in navigator) {
            window.addEventListener("load", function() {
                navigator.serviceWorker.register("/sw.js").then(
                    function(registration) {
                        console.log("Service Worker registered with scope:", registration.scope);
                    },
                    function(error) {
                        console.log("Service Worker registration failed:", error);
                    }
                );
            });
        }
    </script>

    <!-- Global variables for icons -->
    <script>
        window.eyeClosedIcon = "{{ asset('images/site/eye-closed.png') }}";
        window.eyeOpenIcon = "{{ asset('images/site/eye-open.png') }}";
    </script>

    <!-- User menu toggle functionality -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const userBtn = document.getElementById("user-btn");
            const userMenu = document.getElementById("usermenu");

            if (userBtn && userMenu) {
                userBtn.addEventListener("click", function () {
                    userMenu.classList.toggle("hidden");
                });

                // Close the menu if clicked outside
                document.addEventListener("click", function (event) {
                    if (!userBtn.contains(event.target) && !userMenu.contains(event.target)) {
                        userMenu.classList.add("hidden");
                    }
                });
            }
        });
    </script>

    <!-- Include styles and scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite(['resources/js/header.js'])
</head>

<body class="flex flex-col min-h-screen">
    <header>
        <!-- Navigation bar -->
        <nav class="bg-[#3a3a3a] local-font-gliker shadow-md py-3 rounded-b-3xl top-0 left-0 w-full z-50">
            <div class="flex mx-auto items-center">
                <!-- Mobile menu button -->
                <button id="burger-icon" class="md:hidden text-white focus:outline-none mr-2 md:mr-2">
                    <img src="{{ asset('images/site/burger.png') }}" alt="Menu"
                        class="w-8 h-8 ml-1.5 justify-space-between md:mr-0">
                </button>

                <!-- Logo -->
                <a href="{{ url(path: 'home') }}" class="flex hover:scale-110 transition duration-300">
                    <img src="{{ asset('images/site/LogoTTR.png') }}" class="h-12 md:h-14 ml-2" alt="Logo" />
                </a>

                <!-- Main navigation for desktop -->
                <div class="hidden md:flex absolute left-1/2 transform -translate-x-1/2 space-x-8 font-bold text-white">
                    <a href="{{ route('offers.index') }}"
                        class="md:text-2xl lg:text-3xl hover:text-[#6e9ae6] transition duration-200 hover:scale-110">Offres</a>
                    <a href="{{ route('companies.index') }}"
                        class="md:text-2xl lg:text-3xl hover:text-[#6e9ae6] transition duration-200 hover:scale-110">Entreprises</a>
                    @role('admin|pilote|etudiant')
                    <a href="{{ route('Contact') }}"
                        class="md:text-2xl lg:text-3xl hover:text-[#6e9ae6] transition duration-200 hover:scale-110">Contact</a>
                    @endrole
                </div>

                <!-- User account button -->
                @if (Auth::check())
                <!-- For logged-in users -->
                <div class="relative flex items-center ml-auto mt-1">
                    <button id="user-btn"
                        class="bg-[#6e9ae6] text-white text-base md:text-xl lg:text-2xl xl:text-3xl rounded-full mr-2 px-2 py-2 flex items-center hover:bg-white hover:text-[#6e9ae6] hover:scale-105 transition-all duration-300">
                        <img src="{{ Auth::user()->profile_picture ? asset(Auth::user()->profile_picture) : asset('images/site/default-user.png') }}"
                            alt="Photo de profil" class="bg-[#ffff] rounded-full w-8 h-8 md:w-10 md:h-10">
                        <span class="ml-2 hidden sm:inline">{{ Auth::user()->first_name }}</span>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="usermenu"
                        class="hidden absolute right-2 top-full mt-2 w-auto text-nowrap bg-white rounded-lg shadow-lg overflow-hidden ring-1 ring-[#6e9ae6] z-50 mr-2">
                        <a href="{{ route('users.dashboard', ['id' => Auth::user()->id]) }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-[#6e9ae6] hover:text-white">Profil</a>
                        @role('admin')
                        <a href="{{ route('Panneau_de_Configuration') }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-[#6e9ae6] hover:text-white">Panneau de Configuration</a>
                        @endrole
                        @role('admin|pilote')
                        <a href="{{ route('users.index') }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-[#6e9ae6] hover:text-white">
                            User List
                        </a>
                        @endrole
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-gray-700 hover:bg-[#ff7070] hover:text-white">
                                Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @else
            <!-- For guests -->
            <button id="account-btn"
                class="bg-[#6e9ae6] text-white text-base md:text-xl lg:text-2xl xl:text-3xl rounded-full mr-2 px-2 py-2 flex items-center ml-auto hover:bg-white hover:text-[#6e9ae6] hover:scale-105 hover:ring-2 hover:ring-[#6e9ae6] transition-all duration-300"
                onclick="document.getElementById('login-popup').classList.remove('hidden');">
                <img src="{{ asset('images/site/icon-user.png') }}"
                    class="bg-[#ffff] rounded-full w-6 h-6 md:w-8 md:h-8" alt="User Icon" />
                <span class="ml-2">Compte</span>
            </button>
            @endif
            
            </div>
        </nav>

        <!-- Mobile menu overlay -->
        <div id="mobile-menu-overlay" class="hidden fixed inset-0 bg-black opacity-50 z-80"></div>

        <!-- Mobile menu sidebar -->
        <div id="mobile-menu"
            class="md:hidden fixed top-0 left-0 w-50 h-full bg-[#2d2d2d] transform translate-x-full transition-transform duration-300 z-90 hidden">
            <div class="flex justify-end p-4">
                <button id="close-menu" class="text-white text-3xl">&times;</button>
            </div>
            <div class="flex flex-col local-font-gliker space-y-4 mt-6 px-4">
                <a href="{{ url(path: 'home') }}"
                    class="text-lg text-white bg-[#6e9ae6] hover:bg-[#5a85d1] py-2 px-4 rounded-lg text-center transition duration-200">Accueil</a>
                <a href="{{ route('offers.index') }}"
                    class="text-lg text-white bg-[#6e9ae6] hover:bg-[#5a85d1] py-2 px-4 rounded-lg text-center transition duration-200">Offres</a>
                <a href="{{ route('companies.index') }}"
                    class="text-lg text-white bg-[#6e9ae6] hover:bg-[#5a85d1] py-2 rounded-lg text-center transition duration-200">Entreprises</a>
                @role('admin|pilote|etudiant')
                <a href="{{ route('Contact') }}"
                    class="text-lg text-white bg-[#6e9ae6] hover:bg-[#5a85d1] py-2 px-4 rounded-lg text-center transition duration-200">Contact</a>
                <a href="{{ route('wishlists.index') }}"
                    class="text-lg text-white bg-[#6e9ae6] hover:bg-[#5a85d1] py-2 rounded-lg text-center transition duration-200">Wishlist</a>
                @endrole
            </div>
        </div>

        <!-- Login popup -->
        <div id="login-popup"
            class="local-font-gliker fixed top-0 w-full h-full flex justify-center items-center hidden z-100">
            <div class="bg-black opacity-50 absolute inset-0"></div>
            <div class="bg-white w-90 md:w-130 p-8 rounded-lg shadow-xl z-10 relative">
                <form method="POST" action="{{ route('login') }}" id="login-form">
                    @csrf

                    <div class="mb-6">
                        <label for="email"
                            class="block text-xl md:text-4xl text-center font-medium text-[#6e9ae6] mb-2">Identifiant</label>
                        <input type="email" id="email" name="email" placeholder="Entrez votre email"
                            value="{{ old('email') }}"
                            class="w-full p-2 border-2 border-[#3a3a3a] rounded-md focus:border-[#6e9ae6] focus:ring-2 focus:ring-[#6e9ae6] focus:outline-none transition-all duration-300"
                            required>
                    </div>

                    <!-- Erreurs globales (si présentes) -->
                    @if ($errors->any())
                    <div class="bg-red-500 text-white p-2 mb-4 rounded-md text-center">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="mb-6">
                        <label for="password"
                            class="block text-xl md:text-4xl text-center font-medium text-[#6e9ae6] mb-2">Mot de
                            passe</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" placeholder="Mot de passe"
                                class="w-full p-2 pr-10 border-2 border-[#3a3a3a] rounded-md focus:border-[#6e9ae6] focus:ring-2 focus:ring-[#6e9ae6] focus:outline-none transition-all duration-300"
                                required>
                            <img id="toggle-password-icon" src="{{ asset('images/site/eye-closed.png') }}"
                                alt="Afficher/Masquer le mot de passe"
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 cursor-pointer w-6 h-6">
                        </div>
                    </div>
                    <div class="flex justify-center items-center">
                        <button type="submit"
                            class="bg-[#6e9ae6] text-white text-[14px] md:text-lg py-2 px-4 rounded-md hover:bg-[#6e9ae6] transform hover:scale-105">
                            Se connecter
                        </button>
                    </div>
                </form>
                <!-- Close button -->
                <button id="close-login-popup"
                    class="absolute top-4 right-4 text-3xl text-gray-600 hover:text-[#6e9ae6] transition-all duration-200 transform hover:scale-110">&times;</button>
            </div>
        </div>
    </header>

    <main class="flex-1 local-font-gliker">
        <!-- Success message -->
        @if (session('success'))
        <div id="success-popup"
            class="bg-green-600 opacity-80 m-4 md:mx-50 lg:mx-150 text-white text-center py-2 text-sm md:text-xl p-4 rounded-2xl local-font-gliker">
            {{ session('success') }}
        </div>
        @endif

        <!-- Main content -->
        @yield('content')
    </main>

    <footer class="mt-auto">
        <!-- Footer navigation -->
        <nav id="footer" class="bottom-0 left-0 w-full mt-6 rounded-t-xl shadow-sm bg-[#3a3a3a] local-font-gliker"
            aria-label="Pied de page">
            <div class="w-full max-w-screen-xl mx-auto p-2 md:py-4">
                <div class="sm:flex sm:items-center sm:justify-between mt-2">
                    <a href="{{ route('home') }}"
                        class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse transition duration-200 hover:scale-110">
                        <img src="{{ asset('images/site/LogoTTR.png') }}" class="h-4 md:h-8" alt="Logo" />
                        <span
                            class="self-center text-xs sm:text-sm md:text-xl font-semibold whitespace-nowrap hover:text-[#6e9ae6] text-[#ffffff]">Traverse
                            Ta Rue</span>
                    </a>
                    <ul
                        class="flex flex-wrap items-center mb-4 text-[10px] sm:text-xs md:text-sm font-medium text-gray-300 sm:mb-0">
                        <li>
                            <a href="{{ route('Informations-legales') }}"
                                class="hover:underline mx-2 hover:text-[#6e9ae6] sm:me-2 md:me-6">Informations
                                légales</a>
                        </li>
                        <li>
                            <a href="{{ route('Politique de confidentialité') }}"
                                class="hover:underline mx-2 hover:text-[#6e9ae6] sm:me-2 md:me-6">Politique de
                                confidentialité</a>
                        </li>
                        <li>
                            @role('admin|pilote|etudiant')
                            <a href="{{ route('Contact') }}"
                                class="hover:underline mx-2 hover:text-[#6e9ae6]">Contact</a>
                            @endrole
                        </li>
                    </ul>
                </div>
                <hr class="my-2 border-[#ffffff] sm:mx-auto lg:my-6" />
                <span class="block text-[10px] sm:text-xs md:text-sm text-gray-300 sm:text-center">© 2025 <a
                        href="{{ route('home') }}" class="hover:underline hover:text-[#6e9ae6]">Traverse Ta Rue</a>.
                    All Rights
                    Reserved.</span>
            </div>
        </nav>
    </footer>
</body>

</html>