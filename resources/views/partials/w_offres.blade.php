<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Wishlist</title>

    <!-- Lien vers le CSS -->
    <link rel="stylesheet" href="{{ asset('css/wish.css') }}">
</head>
<body>
    <script src="{{ asset('js/script.js') }}"></script>

    <header>
        <!-- Logo -->
        <div class="logo">
            <img src="{{ asset('images/LogoTTR.png') }}" alt="Logo de l'entreprise">
        </div>

        <!-- Accueil -->
        <div class="nav-links">
            <a href="{{ route('accueil') }}">Accueil</a>
        </div>

        <!-- Barre de recherche -->
        <div class="search-bar">
            <input type="text" placeholder="Rechercher...">
        </div>

        <!-- Icônes -->
        <div class="icons">
            <img src="{{ asset('images/heart_icon.png') }}" alt="Favoris">
            <img src="{{ asset('images/icon-user.png') }}" alt="Profil">
        </div>
    </header>

    <main>
        <!-- Liens de navigation -->
        <div class="menu">
            <a href="{{ route('w_offres') }}" class="active">Mes offres</a>
            <a href="{{ route('wishlist') }}">Mes favoris</a>
            <a href="{{ route('w_candidatures') }}">Mes candidatures</a>
        </div>

        <h1>Ma Wishlist</h1>

    </main>

    <footer>
        <div class="left">
            <a href="{{ route('info') }}">Informations légales</a>
            <a href="{{ route('cgu') }}">CGU</a>
        </div>
        <div class="right">
            <a href="{{ route('aide_contact') }}">Aide et Contact</a>
        </div>
    </footer>
</body>
</html>
