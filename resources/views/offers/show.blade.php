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
            <p>Publié il y a {{($offre->publication_date)}}</p>
            
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

            <div class="job-requirements">
            <p><b>Missions :</b></p>
            <ul>
                <li>Développer et optimiser des scripts et applications en Python pour l’automatisation des tâches.</li>
                <li>Gérer et maintenir les bases de données associées aux applications.</li>
                <li>Assurer la documentation technique des solutions mises en place.</li>
                <li>Participer à l’intégration continue et au déploiement des solutions (CI/CD).</li>
            </ul>
        </div>
        <div class="job-requirements"></div>
            <p><b>Profil recherché :</b></p>
            <ul>
                <li>Étudiant(e) en informatique ({{ $offre->niveau }} minimum) avec une spécialisation en développement ou DevOps.</li>
                <li>Bonne maîtrise de Python et des concepts de programmation orientée objet (POO).</li>
                <li>Connaissances en gestion de bases de données (SQL, NoSQL).</li>
                <li>Compréhension des langages web (HTML, CSS, JavaScript) est un plus.</li>
            </ul>
        </div>
        <div class="job-requirements"></div>
            <p><b>Conditions :</b></p>
            <ul>
                <li>Stage de {{ $offre->duree }} à Toulouse, rémunéré {{ $offre->salary }} €/mois.</li>
                <li>Encadrement par des experts du domaine et opportunité d’évoluer dans un environnement innovant.</li>
            </ul>
        </div>
        <br>
            <!-- BOUTON POUR OUVRIR LA POP-UP -->
            <button id="applyButton" class="relative inline-flex items-center justify-center p-2 text-white bg-blue-500 rounded-md shadow-sm hover:bg-blue-600 focus:ring-2 focus:ring-blue-300">
                Postuler
            </button>

            <!-- POP-UP AVEC FORMULAIRE -->
            <div id="popup" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
                <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                    <h2 class="text-xl font-bold mb-4">Postuler maintenant</h2>

                    <form id="postulation-form" action="{{ route('postulation.store', $offre->id_offers) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="prenom" class="block text-sm font-medium">Prénom</label>
                            <input type="text" id="prenom" name="prenom" class="w-full border rounded-md p-2" required>
                        </div>

                        <div class="mb-3">
                            <label for="nom" class="block text-sm font-medium">Nom</label>
                            <input type="text" id="nom" name="nom" class="w-full border rounded-md p-2" required>
                        </div>

                        <div class="mb-3">
                            <label for="mail" class="block text-sm font-medium">Mail</label>
                            <input type="email" id="mail" name="mail" class="w-full border rounded-md p-2" required>
                        </div>

                        <div class="mb-3">
                            <label for="cv" class="block text-sm font-medium">CV</label>
                            <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" class="w-full border rounded-md p-2" required>
                        </div>

                        <div class="mb-3">
                            <label for="motivation" class="block text-sm font-medium">Lettre de motivation</label>
                            <input type="file" id="motivation" name="motivation" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" class="w-full border rounded-md p-2">
                        </div>

                        <div class="flex justify-end gap-2">
                            <button type="button" id="closeButton" class="px-4 py-2 bg-gray-400 text-white rounded-md">Annuler</button>
                            <button type="submit" id="submitApplication" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Envoyer</button>
                        </div>
                    </form>
                    <!-- Message de succès ou d'erreur -->
                    <p id="successMessage" class="text-green-600 hidden mt-2">Postulation réussie !</p>
                    <p id="errorMessage" class="text-red-600 hidden mt-2">Erreur lors de la postulation.</p>

                    <div class="items-center px-4 py-3">
                        <button id="closeButton" class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                            Close
                        </button>
                    </div>
                </div>
            </div>


            <!-- JavaScript -->
            <script>
                document.getElementById('applyButton').addEventListener('click', function() {
                    document.getElementById('popup').classList.remove('hidden');
                });

                document.getElementById('closeButton').addEventListener('click', function() {
                    document.getElementById('popup').classList.add('hidden');
                });
            </script>
        
    </main>

    <footer>
        <nav class="footer-nav">
            <a href="#">Informations légales</a>
            <a href="#">CGU</a>
            <a href="#">Politique de confidentialité</a>
            <a href="#">Aide et Contact</a>
        </nav>
    </footer>
    @if(session('success') || session('error'))
        <script>
            // Masquer le message après 10 secondes et rediriger
            setTimeout(function() {
                document.getElementById('message').style.display = 'none';
                window.location.href = '{{ route('offres') }}';  // Rediriger vers la page des offres ou autre page souhaitée
            }, 10000);  // 10 secondes
        </script>
    @endif
</body>
</html>
