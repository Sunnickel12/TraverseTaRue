@if ($paginator->hasPages())
<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center mt-4 md:mt-8">
    <ul class="inline-flex space-x-2">
        {{-- Bouton précédent --}}
        @if ($paginator->onFirstPage())
        <li>
            <span class="px-4 py-2 text-gray-400 bg-gray-200 border border-gray-300 rounded-md cursor-not-allowed text-[10px] md:text-xl">
                Précédent
            </span>
        </li>
        @else
        <li>
            <a href="{{ $paginator->previousPageUrl() }}"
                class="px-4 py-2 text-white bg-[#6e9ae6] border border-[#6e9ae6] rounded-md hover:bg-blue-300 transition duration-300 text-[10px] md:text-xl">
                Précédent
            </a>
        </li>
        @endif

        {{-- Numéros de page --}}
        @foreach ($elements as $element)
        @if (is_string($element))
            {{-- Si c'est une chaîne, cela signifie qu'il y a des "..." - on les ignore --}}
            @continue
        @endif

        @if (is_array($element))
        @foreach ($element as $page => $url)
        {{-- Affichage des pages proches de la page courante --}}
        @if (abs($paginator->currentPage() - $page) <= 1)
        <li>
            @if ($page == $paginator->currentPage())
            <span class="px-4 py-2 text-white bg-[#6e9ae6] border border-[#3a3a3a] rounded-md text-[10px] md:text-xl">
                {{ $page }}
            </span>
            @else
            <a href="{{ $url }}"
                class="px-4 py-2 text-[#3a3a3a] bg-white border border-[#3a3a3a] rounded-md hover:bg-[#6e9ae6] hover:text-white transition duration-300 text-[10px] md:text-xl">
                {{ $page }}
            </a>
            @endif
        </li>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Bouton suivant --}}
        @if ($paginator->hasMorePages())
        <li>
            <a href="{{ $paginator->nextPageUrl() }}"
                class="px-4 py-2 text-white bg-[#6e9ae6] border border-[#6e9ae6] rounded-md hover:bg-blue-300 transition duration-300 text-[10px] md:text-xl">
                Suivant
            </a>
        </li>
        @else
        <li>
            <span class="px-4 py-2 text-gray-400 bg-gray-200 border border-gray-300 rounded-md cursor-not-allowed text-[10px] md:text-xl">
                Suivant
            </span>
        </li>
        @endif
    </ul>
</nav>
@endif
