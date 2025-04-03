$(document).ready(function () {
    // Initialisation de Select2
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

    // Gestion de l'affichage des filtres sur mobile
    const filterButton = document.getElementById("filterButton");
    const filterSidebar = document.getElementById("filterSidebar");
    if (filterButton && filterSidebar) {
        filterButton.addEventListener("click", function () {
            filterSidebar.classList.toggle("hidden");
            filterButton.textContent = filterSidebar.classList.contains("hidden") ? "Ouvrir les filtres" : "Fermer les filtres";
        });
    }

    // Gestion de l'aperçu et de l'erreur pour le fichier logo
    let fileInput = document.getElementById("logo");
    let previewContainer = document.getElementById("logoPreview");
    let previewImage = document.getElementById("preview");
    let errorElement = document.getElementById("logo-error"); // Message d'erreur
    let maxSize = 2 * 1024 * 1024; // 2MB en octets

    fileInput.addEventListener("change", function (event) {
        let file = event.target.files[0];

        if (file) {
            // Vérification de la taille du fichier
            if (file.size > maxSize) {
                errorElement.classList.remove("hidden"); // Affiche l'erreur
                fileInput.value = ""; // Réinitialise l'input file
                previewContainer.classList.add("hidden"); // Masque l'aperçu
                event.preventDefault(); // Empêche l'envoi du formulaire
                return;
            } else {
                errorElement.classList.add("hidden"); // Cache l'erreur si tout est bon
            }

            let reader = new FileReader();
            reader.onload = function (e) {
                previewImage.src = e.target.result;
                previewContainer.classList.remove("hidden");
            };
            reader.readAsDataURL(file);
        } else {
            previewContainer.classList.add("hidden");
            errorElement.classList.add("hidden"); // Cache l'erreur si aucun fichier n'est sélectionné
        }
    });
});
