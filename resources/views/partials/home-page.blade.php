<nav class="bg-white local-font-gliker">
    <!-- Header Section -->
    <div class="text-[#6e9ae6] text-3xl md:text-5xl font-bold mt-4 px-4 md:px-6 py-2 text-start md:text-left">
        Traverse Ta Rue
    </div>
    <div class="bg-[#3a3a3a] text-white text-lg md:text-2xl text-center py-2 px-4">
        Quelques pas suffisent pour saisir une opportunité !
    </div>

    <!-- Banner Section -->
    <div class="relative mx-auto my-6 h-64 md:h-72 w-full max-w-screen-lg z-10 px-4">
        <img src="{{ asset('images/banner2.png') }}" class="rounded-3xl w-full object-cover" alt="banner" />
        <div class="absolute inset-0 flex items-center justify-center">
            <form class="w-full max-w-lg md:max-w-2xl mx-auto">
                <label for="default-search" class="mb-2 text-sm font-medium text-[#3a3a3a] sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" id="default-search"
                        class="block w-full p-3 md:p-4 ps-10 border-2 text-sm text-[#3a3a3a] border-[#3a3a3a] rounded-lg bg-white focus:ring-[#81affe] focus:border-[#81affe]"
                        placeholder="Rechercher des opportunités..." required />
                    <button type="submit"
                        class="text-white absolute end-2.5 bottom-2 bg-[#6e9ae6] hover:bg-[#5a7dbb] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5 md:px-4 md:py-2">Rechercher</button>
                </div>
            </form>
        </div>
    </div>
    <div id="who" class="hidden text-[#6e9ae6] text-3xl md:text-5xl font-bold mt-4 px-4 md:px-6 py-2 text-start md:text-left">
        Qui sommes-nous ?
    </div>
</nav>


