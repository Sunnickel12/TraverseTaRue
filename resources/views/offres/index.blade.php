<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offres de Stage</title>

    <!-- Lien vers les fichiers CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/off.css') }}"> <!-- Utilisation de asset() -->
</head>
<body>
    <script src="{{ asset('js/script.js') }}"></script>

    <nav>
        <img src="{{ asset('images/LogoTTR.png') }}" alt="Logo de Traverse Ta Rue" class="logo"> 
        <ul>
            <li><a href="#" class="active">Offres</a></li>
            <li><a href="#">Entreprises</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="{{ route('wishlist') }}">Wishlist</a></li> 
            <li><a href="#" id="compte"><i class="bi bi-person-circle"></i> Compte</a></li>
        </ul>
    </nav>

    <section id="search">
        <div class="search-container">
            <input type="text" placeholder="">
            <i class="fas fa-search"></i>
            <i class="fas fa-times"></i>
        </div>
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
            <img src="{{ asset($offre->company->logo_path) }}" alt="Logo de {{ $offre->company->name }}" class="job-logo">
        </div>
        @endforeach
    </main>
    
    <!-- Footer -->
    <footer class="bg-gray-800 p-4 mt-8">
        <nav class="flex space-x-4">
            <a href="#" class="text-white">Informations légales</a>
            <a href="#" class="text-white">CGU</a>
            <a href="#" class="text-white">Politique de confidentialité</a>
            <a href="#" class="text-white">Aide et Contact</a>
        </nav>
    </footer>
</body>
</html>
