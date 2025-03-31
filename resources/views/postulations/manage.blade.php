<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer la candidature</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="max-w-screen-md mx-auto p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Gérer la candidature</h1>
        
        <!-- Formulaire de mise à jour -->
        <form action="{{ route('postulation.update', ['id_postulation' => $postulation->id]) }}" method="POST" class="mb-6">
            @csrf
            @method('PUT')

            <!-- Sélecteur pour changer le statut -->
            <div class="mb-4">
                <label for="status" class="block text-gray-700 font-medium mb-2">Statut :</label>
                <select id="status" name="status" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    <option value="accepté" {{ $postulation->status == 'accepté' ? 'selected' : '' }}>Accepté</option>
                    <option value="refusé" {{ $postulation->status == 'refusé' ? 'selected' : '' }}>Refusé</option>
                </select>
            </div>

            <!-- Bouton pour mettre à jour -->
            <div class="text-center">
                <button type="submit" class="bg-green-500 text-white font-semibold px-6 py-2 rounded-md hover:bg-green-600 transition">
                    Mettre à jour
                </button>
            </div>
        </form>

        <!-- Formulaire pour supprimer -->
        <form action="{{ route('postulations.delete', ['id_postulation' => $postulation->id]) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette candidature ?');">
            @csrf
            @method('DELETE')
            <div class="text-center">
                <button type="submit" class="bg-red-500 text-white font-semibold px-6 py-2 rounded-md hover:bg-red-600 transition">
                    Supprimer
                </button>
            </div>
        </form>
    </div>
</body>
</html>
