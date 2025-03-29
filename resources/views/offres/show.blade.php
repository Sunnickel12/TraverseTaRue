<!-- resources/views/show.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $offre->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/off.css') }}">
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <img src="{{ asset('images/LogoTTR.png') }}" alt="Logo TR">
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('offres') }}" class="active">Offres</a></li>
            <li><a href="#">Entreprises</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
        <div class="user-section">
            <div class="favorites">
                <i class="fas fa-bookmark"></i>
                <span class="fav-count">2</span>
            </div>
            <div class="user">
                <img src="{{ asset('images/icon-user.svg') }}" alt="User">
                <span>{{ Auth::user()->name ?? 'User' }}</span>
            </div>
        </div>
    </nav>

    <main>
        <div class="banner-plane">
            <img src="{{ asset('images/bannière.png') }}" alt="banner">
        </div>

        <section id="job-detail" class="p-4">
            <h3 class="text-2xl mb-4">{{ $offre->title }}</h3>
            <p>Publié il y a {{ \Carbon\Carbon::parse($offre->created_at)->diffForHumans() }}</p>
            
            <div class="characteristics">
                <button class="toutes">{{ $offre->niveau }}</button>
                <button class="toutes">{{ $offre->duree }}</button>
                <button class="toutes">{{ $offre->salary ?? 'Salaire à définir' }} €/mois</button>
                <button class="toutes">{{ $offre->category ?? 'Informatique' }}</button>
            </div>

            <div class="job-description mt-4">
                <p><b>Description du poste :</b></p>
                <p>{{ $offre->contenu }}</p>
            </div>

            <div class="job-requirements mt-4">
                <p><b>Missions :</b></p>
                <ul>
                    <li>{{ $offre->missions }}</li>
                </ul>
            </div>

            <div class="job-requirements mt-4">
                <p><b>Profil recherché :</b></p>
                <ul>
                    <li>{{ $offre->profil_recherche }}</li>
                </ul>
            </div>

            <div class="job-requirements mt-4">
                <p><b>Conditions :</b></p>
                <ul>
                    <li>{{ $offre->conditions }}</li>
                </ul>
            </div>

            <section class="apply-section mt-6">
                <h2>Postuler maintenant !</h2>
                <div class="apply-form">
                    <div class="input-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" id="prenom" placeholder="Prénom">
                    </div>
                    <div class="input-group">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" placeholder="Nom">
                    </div>
                    <div class="input-group">
                        <label for="mail">Mail</label>
                        <input type="email" id="mail" placeholder="Email">
                    </div>
                    <div class="file-upload">
                        <label for="cv">CV</label>
                        <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg">
                    </div>
                    <div class="file-upload">
                        <label for="motivation">Lettre de Motivation</label>
                        <input type="file" id="motivation" name="motivation" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg">
                    </div>
                </div>
            </section>
        </section>
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
