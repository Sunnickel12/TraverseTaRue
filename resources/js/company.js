// JavaScript pour gérer l'affichage/masquage des filtres
document.getElementById('filterButton').addEventListener('click', function() {
    var sidebar = document.getElementById('filterSidebar');
    var button = document.getElementById('filterButton');
    sidebar.classList.toggle('hidden');
    button.textContent = sidebar.classList.contains('hidden') ? 'Ouvrir les filtres' : 'Fermer les filtres';
});

// Initialisation de Select2 pour les filtres
$(document).ready(function() {
    // Initialisation pour les filtres de lieux
    $('#location').select2({
        placeholder: "Sélectionner une ou plusieurs villes",
        allowClear: true,
        width: '100%'
    });

    // Initialisation pour les filtres de catégories
    $('#category').select2({
        placeholder: "Sélectionner une ou plusieurs catégories",
        allowClear: true,
        width: '100%'
    });
});
