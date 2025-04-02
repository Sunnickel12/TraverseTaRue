document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("postulation-form").addEventListener("submit", function (event) {
        event.preventDefault(); // Empêche le rechargement de la page

        let formData = new FormData(this);

        fetch(this.action, {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            }
        })
        .then(response => response.json())
        .then(data => {
            // Vérifie si la demande a réussi
            if (data.success) {
                document.getElementById("successMessage").classList.remove("hidden");
                setTimeout(() => {
                    document.getElementById("popup").classList.add("hidden");
                    // Redirection vers la page des offres après 2 secondes
                    window.location.href = data.redirectUrl || '/';
                }, 2000); // Ferme après 2 secondes
            } else {
                document.getElementById("errorMessage").classList.remove("hidden");
                // Si la réponse contient une URL de redirection dans le cas d'une erreur
                if (data.redirectUrl) {
                    setTimeout(() => {
                        window.location.href = data.redirectUrl; // Redirection vers l'URL d'erreur
                    }, 2000); // Redirection après 2 secondes
                }
            }
        })
        .catch(error => {
            console.error("Erreur :", error);
            document.getElementById("errorMessage").classList.remove("hidden");
        });
    });

    // Gestion de l'affichage de la pop-up
    document.getElementById('applyButton').addEventListener('click', function () {
        document.getElementById('popup').classList.remove('hidden');
    });

    document.getElementById('closeButton').addEventListener('click', function () {
        document.getElementById('popup').classList.add('hidden');
    });
});
