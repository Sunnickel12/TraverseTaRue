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
                <li>Étudiant(e) en informatique (Bac+2 minimum) avec une spécialisation en développement ou DevOps.</li>
                <li>Bonne maîtrise de Python et des concepts de programmation orientée objet (POO).</li>
                <li>Connaissances en gestion de bases de données (SQL, NoSQL).</li>
                <li>Compréhension des langages web (HTML, CSS, JavaScript) est un plus.</li>
            </ul>
        </div>
        <div class="job-requirements"></div>
            <p><b>Conditions :</b></p>
            <ul>
                <li>Stage de 4 mois à Toulouse, rémunéré 600 €/mois.</li>
                <li>Encadrement par des experts du domaine et opportunité d’évoluer dans un environnement innovant.</li>
            </ul>
        </div>
        <br>
            <!-- Bouton -->
            <button id="applyButton" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800">
                <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-transparent group-hover:dark:bg-transparent">Postuler</span>
            </button>

            <!-- Pop-up -->
            <div id="popup" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" style="display:none;">
                <div class="relative top-20 mx-auto p-5 border max-w-3xl w-full shadow-lg rounded-md bg-white">
                    <div class="mt-3 text-center">
                        <div class="mt-2 px-7 py-3">
                            <p class="text-sm text-gray-500">
                                <section class="apply-section mt-6">
                                    <h2>Postuler maintenant !</h2>
                                    <div class="apply-form">
                                        <div class="input-group">
                                            <label for="prenom">Prénom</label>
                                            <input type="text" id="prenom" placeholder="Prénom" class="w-full border rounded-md p-2">
                                        </div>
                                        <div class="input-group mt-4">
                                            <label for="nom">Nom</label>
                                            <input type="text" id="nom" placeholder="Nom" class="w-full border rounded-md p-2">
                                        </div>
                                        <div class="input-group mt-4">
                                            <label for="mail">Mail</label>
                                            <input type="email" id="mail" placeholder="Email" class="w-full border rounded-md p-2">
                                        </div>
                                        <div class="file-upload mt-4">
                                            <label for="cv">CV</label>
                                            <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" class="w-full border rounded-md p-2">
                                        </div>
                                        <div class="file-upload mt-4">
                                            <label for="motivation">Lettre de Motivation</label>
                                            <input type="file" id="motivation" name="motivation" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" class="w-full border rounded-md p-2">
                                        </div>
                                        <div class="text-right mt-6">
                                            <button id="submitApplication" class="px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                                            Save
                                            </button>
                                        </div>
                                    </div>
                                </section>
                            </p>
                        </div>
                        <!-- Boutons -->
                        <div class="items-center px-4 py-3">
                            <button id="closeButton" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- JavaScript -->
            <script>
                document.getElementById('applyButton').addEventListener('click', function() {
                    document.getElementById('popup').style.display = 'block';
                });

                document.getElementById('closeButton').addEventListener('click', function() {
                    document.getElementById('popup').style.display = 'none';
                });
            </script>

           <!-- <section class="apply-section mt-6">
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
        </section>-->
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
