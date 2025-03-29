<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $offre->title }}</title> <!-- Titre dynamique de l'offre -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/off.css') }}"> <!-- Lien vers ton fichier CSS -->
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <img src="{{ asset('images/LogoTTR.png') }}" alt="Logo TR"> <!-- Logo -->
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('offres') }}" class="active">Offres</a></li> <!-- Lien dynamique vers les offres -->
            <li><a href="#">Entreprises</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
        <div class="user-section">
            <div class="favorites">
                <i class="fas fa-bookmark"></i>
                <span class="fav-count">2</span> <!-- Affichage statique du nombre de favoris -->
            </div>
            <div class="user">
                <img src="{{ asset('images/icon-user.svg') }}" alt="User"> <!-- Avatar utilisateur -->
                <span>{{ Auth::user()->name ?? 'User' }}</span> <!-- Nom de l'utilisateur connecté -->
            </div>
        </div>
    </nav>

    <main>
        <!-- Bannière -->
        <div class="banner-plane">
            <img src="{{ asset('images/bannière.png') }}" alt="banner"> <!-- Bannière de l'offre -->
        </div>

        <section id="job-detail">
            <h3>{{ $offre->title }}</h3> <!-- Titre de l'offre -->
            <p>Publié il y a {{ \Carbon\Carbon::parse($offre->created_at)->diffForHumans() }}</p> <!-- Date de publication -->
            
            <div class="characteristics">
                <button class="toutes">{{ $offre->niveau }}</button> <!-- Niveau requis (par exemple : BAC+2) -->
                <button class="toutes">{{ $offre->duree }}</button> <!-- Durée du stage -->
                <button class="toutes">{{ $offre->salary ?? 'Salaire à définir' }} €/mois</button> <!-- Salaire -->
                <button class="toutes">{{ $offre->category ?? 'Informatique' }}</button> <!-- Catégorie -->
            </div>

            <div class="job-description">
                <p><b>Description du poste :</b></p>
                <p>{{ $offre->contenu }}</p> <!-- Description dynamique du poste -->
            </div>

            <div class="job-requirements">
                <p><b>Missions :</b></p>
                <ul>
                    <li>{{ $offre->missions }}</li> <!-- Liste des missions, dynamique si tu les as dans la base -->
                </ul>
            </div>

            <div class="job-requirements">
                <p><b>Profil recherché :</b></p>
                <ul>
                    <li>{{ $offre->profil_recherche }}</li> <!-- Profil recherché dynamique -->
                </ul>
            </div>

            <div class="job-requirements">
                <p><b>Conditions :</b></p>
                <ul>
                    <li>{{ $offre->conditions }}</li> <!-- Conditions de l'offre -->
                </ul>
            </div>

            <section class="apply-section">
                <h2>Apply now!</h2>
                <div class="apply-form">
                    <div class="input-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" id="prenom" placeholder="">
                    </div>
                    <div class="input-group">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" placeholder="">
                    </div>
                    <div class="input-group">
                        <label for="mail">Mail</label>
                        <input type="email" id="mail" placeholder="">
                    </div>
                    <div class="file-upload">
                    <!-- Section pour le CV -->
                    <div class="file-box">
                        <label for="cv" class="file-title">CV</label>
                        <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" class="hidden-file-input" onchange="updateFileName('cv')">
                        <button type="button" class="upload-btn" onclick="document.getElementById('cv').click()">
                        <i class="fas fa-upload"></i> Upload File
                        </button>
                        <span id="cv-file-name" class="text-gray-600 text-sm mt-2 block"></span> <!-- Affiche le nom du fichier sélectionné -->
                        <p>Max size 2 MB</p>
                        <p>File Type: .pdf ; .docs ; .png</p>
                    </div>

                    <!-- Section pour la lettre de motivation -->
                    <div class="file-box">
                        <label for="motivation" class="file-title">Lettre de Motivation</label>
                        <input type="file" id="motivation" name="motivation" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" class="hidden-file-input" onchange="updateFileName('motivation')">
                        <button type="button" class="upload-btn" onclick="document.getElementById('motivation').click()">
                        <i class="fas fa-upload"></i> Upload File
                    </button>
                    <span id="motivation-file-name" class="text-gray-600 text-sm mt-2 block"></span> <!-- Affiche le nom du fichier sélectionné -->
                    <p>Max size 2 MB</p>
                    <p>File Type: .pdf ; .docs ; .png</p>
                    </div>
                    </div>

                    <!-- Ajoute un script pour afficher le nom du fichier sélectionné -->
                    <script>
                    function updateFileName(inputId) {
                    var fileInput = document.getElementById(inputId);
                    var fileName = fileInput.files[0] ? fileInput.files[0].name : 'Aucun fichier sélectionné';
                    document.getElementById(inputId + '-file-name').textContent = fileName;
                    }
                    </script>

                </div>
            </section>
        </section>

        <footer>
            <nav class="footer-nav">
                <a href="#">Informations légales</a>
                <a href="#">CGU</a>
                <a href="#">Politique de confidentialité</a>
                <a href="#">Aide et Contact</a>
            </nav>
        </footer>
    </main>
</body>
</html>