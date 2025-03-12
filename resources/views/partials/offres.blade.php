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
        <h1>450 Offres Disponibles !</h1>
        <div class="job">
            <h2><a href="{{ route('offre.details', ['id' => 1]) }}">Stage Gestion des Flux interne sous-terrain</a></h2> <!-- Utilisation de route() -->
            <p class="published">Publié il y a 14 jours</p>
            <div class="characteristics">
                <button class="toutes">BAC+2</button>
                <button class="toutes">4 à 6 mois</button>
                <button class="toutes">Salaire à définir</button>
                <button class="toutes">Informatique</button>
            </div>
            <span class="heart">❤</span>
            <img src="{{ asset('images/logo_google.png') }}" alt="Logo Google" class="job-logo">
        </div>

        <div class="job">
            <h2>Stage Conception d'un logiciel pour la NASA</h2>
            <p>Publié il y a 3 jours</p>
            <div class="characteristics">
                <button class="toutes">BAC</button>
                <button class="toutes">2 à 3 mois</button>
                <button class="toutes">Non rémunéré</button>
                <button class="toutes">Compétences techniques</button>
            </div>
            <span class="heart">❤</span>
            <img src="{{ asset('images/logo_nasa.jpg') }}" alt="Logo NASA" class="job-logo">
        </div>

        <div class="job">
            <h2>Stage développement web</h2>
            <p>Publié il y a 5 jours</p>
            <div class="characteristics">
                <button class="toutes">BAC+3/4</button>
                <button class="toutes">6 mois</button>
                <button class="toutes">750 par mois</button>
                <button class="toutes">Caractéristique 4</button>
            </div>
            <span class="heart">❤</span>
            <img src="{{ asset('images/logo_capgemini.png') }}" alt="Logo Capgemini" class="job-logo">
        </div>

        <div class="job">
            <h2>Stage programmation atterrissage automatique</h2>
            <p>Publié il y a 1 mois</p>
            <div class="characteristics">
                <button class="toutes">BAC+2</button>
                <button class="toutes">2 à 3 mois</button>
                <button class="toutes">500 par mois</button>
                <button class="toutes">Caractéristique 4</button>
            </div>
            <span class="heart">❤</span>
            <img src="{{ asset('images/logo_airbus.png') }}" alt="Logo Airbus" class="job-logo">
        </div>
    </main>

    <footer>
        <nav class="footer-nav">
            <a href="#">Informations légales</a>
            <a href="#">CGU</a>
            <a href="#">Politique de confidentialité</a>
            <a href="#">Aide et Contact</a>
        </nav>
    </footer>
</body>
</html>
