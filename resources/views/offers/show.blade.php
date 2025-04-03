
@extends('layouts.navbar')

@section('title', $offer->title)

@section('content')
<main class="px-4 max-w-5xl mx-auto">


    <!-- Offer Details -->
    <section id="job-detail" class="p-4">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">{{ $offer->title }}</h3>
        <p class="text-sm text-gray-500">Publié il y a {{ $offer->created_at->diffForHumans() }}</p>


        <!-- Characteristics -->
        <div class="flex flex-wrap gap-2 mt-4">
            <span class="bg-[#6e9ae6] text-white text-sm px-3 py-1 rounded-lg">{{ $offer->level }}</span>
            <span class="bg-[#6e9ae6] text-white text-sm px-3 py-1 rounded-lg">{{ $offer->duration }}</span>
            <span class="bg-[#6e9ae6] text-white text-sm px-3 py-1 rounded-lg">{{ $offer->salary ?? 'Salaire à définir' }} €/mois</span>
            <span class="bg-[#6e9ae6] text-white text-sm px-3 py-1 rounded-lg">{{ $offer->category ?? 'Informatique' }}</span>
        </div>

        <!-- Job Description -->
        <div class="job-description mt-6">
            <h4 class="text-lg font-semibold text-gray-800">Description du poste :</h4>
            <p class="text-gray-700 mt-2">{{ $offer->contenu }}</p>
        </div>

        <!-- Job Requirements -->
        <div class="job-requirements mt-6">
            <h4 class="text-lg font-semibold text-gray-800">Missions :</h4>
            <ul class="list-disc list-inside text-gray-700 mt-2">
                <li>Développer et optimiser des scripts et applications en Python pour l’automatisation des tâches.</li>
                <li>Gérer et maintenir les bases de données associées aux applications.</li>
                <li>Assurer la documentation technique des solutions mises en place.</li>
                <li>Participer à l intégration continue et au déploiement des solutions (CI/CD).</li>
            </ul>
        </div>

        <div class="job-requirements mt-6">
            <h4 class="text-lg font-semibold text-gray-800">Profil recherché :</h4>
            <ul class="list-disc list-inside text-gray-700 mt-2">
                <li>Étudiant(e) en informatique ({{ $offer->level }} minimum) avec une spécialisation en développement ou DevOps.</li>
                <li>Bonne maîtrise de Python et des concepts de programmation orientée objet (POO).</li>
                <li>Connaissances en gestion de bases de données (SQL, NoSQL).</li>
                <li>Compréhension des langages web (HTML, CSS, JavaScript) est un plus.</li>
            </ul>
        </div>

        <div class="job-requirements mt-6">
            <h4 class="text-lg font-semibold text-gray-800">Conditions :</h4>
            <ul class="list-disc list-inside text-gray-700 mt-2">
                <li>Stage de {{ $offer->duration }} à {{ $offer->city->name }}, rémunéré {{ $offer->salary }} €/mois.</li>
                <li>Encadrement par des experts du domaine et opportunité d’évoluer dans un environnement innovant.</li>
            </ul>
        </div>

        <!-- Apply Button -->
        <div class="mt-6">
            <button id="applyButton" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-600 transition">
                Postuler
            </button>
        </div>

        <!-- Popup Form -->
        <div id="popup" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <h2 class="text-xl font-bold mb-4">Postuler maintenant</h2>
                <form id="postulation-form" action="{{ route('postulations.store', $offer->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
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
            </div>
        </div>
    </section>
</main>

<!-- JavaScript -->
<script>
    document.getElementById('applyButton').addEventListener('click', function() {
        document.getElementById('popup').classList.remove('hidden');
    });

    document.getElementById('closeButton').addEventListener('click', function() {
        document.getElementById('popup').classList.add('hidden');
    });
</script>
@endsection