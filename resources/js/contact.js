document.addEventListener("DOMContentLoaded", function () {
    let fileInput = document.getElementById("file");
    let errorElement = document.getElementById("file-error");

    if (fileInput) {
        fileInput.addEventListener("change", function () {
            let file = this.files[0]; // Récupère le fichier sélectionné
            let maxSize = 10 * 1024 * 1024; // 10MB en octets

            if (file && file.size > maxSize) {
                errorElement.classList.remove("hidden"); // Affiche le message d'erreur
                this.value = ""; // Réinitialise l'input file pour empêcher l'envoi
            } else {
                errorElement.classList.add("hidden"); // Cache l'erreur si tout est bon
            }
        });
    }
});
