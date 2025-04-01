@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center mt-8">
        <ul class="inline-flex space-x-2">
            {{-- Bouton précédent --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="px-4 py-2 text-gray-400 bg-gray-200 border border-gray-300 rounded-md cursor-not-allowed">
                        ← Précédent
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                        class="px-4 py-2 text-white bg-[#6e9ae6] border border-[#6e9ae6] rounded-md hover:bg-blue-300 transition duration-300">
                        ← Précédent
                    </a>
                </li>
            @endif

            {{-- Numéros de page --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="px-4 py-2 text-gray-400">{{ $element }}</li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li>
                            @if ($page == $paginator->currentPage())
                                <span class="px-4 py-2 text-white bg-[#6e9ae6] border border-[#3a3a3a] rounded-md">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}"
                                    class="px-4 py-2 text-[#3a3a3a] bg-white border border-[#3a3a3a] rounded-md hover:bg-[#6e9ae6] hover:text-white transition duration-300">
                                    {{ $page }}
                                </a>
                            @endif
                        </li>
                    @endforeach
                @endif
            @endforeach

            {{-- Bouton suivant --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                        class="px-4 py-2 text-white bg-[#6e9ae6] border border-[#6e9ae6] rounded-md hover:bg-blue-700 transition duration-300">
                        Suivant →
                    </a>
                </li>
            @else
                <li>
                    <span class="px-4 py-2 text-gray-400 bg-gray-200 border border-gray-300 rounded-md cursor-not-allowed">
                        Suivant →
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
