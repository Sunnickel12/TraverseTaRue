$(document).ready(function() {
    $('#location').select2({
        placeholder: "Choisir Lieu",
        allowClear: true,
        width: '100%'
    });

    $('#category').select2({
        placeholder: "Choisir Catégorie",
        allowClear: true,
        width: '100%'
    });
});


document.addEventListener("DOMContentLoaded", function () {
    // Initialisation de Select2
    if (typeof jQuery !== "undefined") {
        $('#location').select2({
            placeholder: "Sélectionner une ou plusieurs villes",
            allowClear: true,
            width: '100%'
        });

        $('#category').select2({
            placeholder: "Sélectionner une ou plusieurs catégories",
            allowClear: true,
            width: '100%'
        });
    }

    // Gestion de l'affichage des filtres sur mobile
    const filterButton = document.getElementById("filterButton");
    const filterSidebar = document.getElementById("filterSidebar");
    if (filterButton && filterSidebar) {
        filterButton.addEventListener("click", function () {
            filterSidebar.classList.toggle("hidden");
            filterButton.textContent = filterSidebar.classList.contains("hidden") ? "Ouvrir les filtres" : "Fermer les filtres";
        });
    }
});