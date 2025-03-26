<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Traverse Ta Rue')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/pagelogo.png') }}" />

    <script>
    window.eyeClosedIcon = "{{ asset('images/eye-closed.png') }}";
    window.eyeOpenIcon = "{{ asset('images/eye-open.png') }}";
    </script>
    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <header>
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
                <a href="#"
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
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <nav id="footer" class="fixed bottom-0 left-0 w-full rounded-t-xl shadow-sm bg-[#3a3a3a] local-font-gliker" aria-label="Pied de page">
            <div class="w-full max-w-screen-xl mx-auto p-2 md:py-4">
                <div class="sm:flex sm:items-center sm:justify-between mt-2">
                    <a href="#" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse transition duration-200 hover:scale-110">
                        <img src="{{ asset('images/LogoTTR.png') }}" class="h-3 md:h-8" alt="Logo" />
                        <span class="self-center text-xs sm:text-sm md:text-xl font-semibold whitespace-nowrap hover:text-[#6e9ae6] text-[#ffffff]">Traverse Ta Rue</span>
                    </a>
                    <ul class="flex flex-wrap items-center mb-4 text-[10px] sm:text-xs md:text-sm font-medium text-gray-300 sm:mb-0">
                        <li>
                            <a href="#" class="hover:underline mx-2 hover:text-[#6e9ae6] sm:me-4 md:me-6">Informations légales</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline mx-2 hover:text-[#6e9ae6] sm:me-4 md:me-6">Politique de confidentialité</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline mx-2 hover:text-[#6e9ae6]">Contact</a>
                        </li>
                    </ul>
                </div>
                <hr class="my-4 border-[#ffffff] sm:mx-auto lg:my-6" />
                <span class="block text-[10px] sm:text-xs md:text-sm text-gray-300 sm:text-center">© 2025 <a href="#" class="hover:underline hover:text-[#6e9ae6]">Traverse Ta Rue</a>. All Rights Reserved.</span>
            </div>
        </nav>
    </footer>
</body>

</html>