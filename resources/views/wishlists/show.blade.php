@extends('layouts.navbar')

@section('title', 'Mes candidatures')

@section('content')
    <main>
        <!-- Liens de navigation (Menu commun) -->
        <div class="menu flex space-x-8 text-lg font-bold mb-6 ml-16 mt-6">
            <a href="{{ route('wishlists.index') }}" class="{{ request()->routeIs('wishlists.index') ? 'text-black border-b-2 border-black' : 'text-gray-600 hover:text-[#6e9ae6] hover:border-b-2 hover:border-[#6e9ae6]' }}">
                Mes favoris
            </a>
            <a href="{{ route('wishlists.candidatures') }}" class="{{ request()->routeIs('wishlists.candidatures') ? 'text-black border-b-2 border-black' : 'text-gray-600 hover:text-[#6e9ae6] hover:border-b-2 hover:border-[#6e9ae6]' }}">
                Mes candidatures
            </a>
        </div>

        <h1 class="text-3xl font-semibold text-center mb-6">Mes candidatures</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            
        @endif
        <!-- Affichage des candidatures dans la wishlist -->
        <div class="wishlist-container flex flex-row flex-wrap gap-6">
            @if(isset($postulations) && $postulations->isEmpty())
                <p>Aucune candidature enregistrée.</p>
            @else
            @foreach($postulations as $postulation)
                @if($postulation->id) <!-- Vérifiez si l'ID de la postulation est présent -->
                    <div class="wishlist-item bg-white p-6 rounded-lg shadow-md border border-gray-200 flex-grow-0 flex-shrink-0 md:w-1/3 lg:w-1/4">
                        <h3 class="text-xl font-bold text-gray-900">
                            @if(isset($postulation->offer))
                                {{ $postulation->offer->title }}
                            @else
                                <span class="text-red-500">Offre supprimée</span>
                            @endif
                        </h3>
                        <p><strong>Statut :</strong> {{ ucfirst($postulation->status) }}</p>

                        <div class="files">
                            <a href="{{ Storage::url($postulation->cv) }}" target="_blank" class="file-link">
                                <img src="{{ asset('images/icon-cv.png') }}" alt="CV" class="file-icon">
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

                        <!-- Affichage des actions si l'offre existe -->
                        @if($postulation->offer)
                            <div class="postulation-actions flex space-x-4 mt-4">
                                <!-- Lien "Voir l'offre" -->
                                <a href="{{ route('offers.show', ['offer_id' => $postulation->offer->offer_id]) }}" class="relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800">
                                    <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-transparent group-hover:dark:bg-transparent">
                                        Voir l'offre
                                    </span>
                                </a>

                                <!-- Lien "Gérer la candidature" -->
                                <a href="{{ route('postulations.manage', ['postulation_id' => $postulation->id]) }}" 
                                class="relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-500 to-pink-500 group-hover:from-purple-500 group-hover:to-pink-500 hover:text-white focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800
                                @if($postulation->status == null) pointer-events-none opacity-50 @endif">
                                    <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-transparent group-hover:dark:bg-transparent">
                                        Gérer la candidature
                                    </span>
                                </a>
                            </div>
                        @else
                            <p>Cette candidature n'a pas d'offre associée.</p>
                        @endif
                    </div>
                @else
                    <p>Aucune candidature valide pour cette postulation (ID manquant).</p>
                @endif
            @endforeach

            @endif
        </div>

    </main>
    @endsection