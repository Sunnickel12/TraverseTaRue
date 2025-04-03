
document.addEventListener('DOMContentLoaded', function () {
    // Sélectionner tous les cœurs
    const hearts = document.querySelectorAll('.heart');

    // Ajout d'un événement de clic sur chaque cœur
    hearts.forEach(heart => {
        heart.addEventListener('click', function () {
            const offerId = this.getAttribute('data-id'); // ID de l'offre
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Récupère le token CSRF

            // Envoie une requête AJAX
            fetch('/wishlist/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token // Ajoute le token CSRF pour la sécurité
                },
                body: JSON.stringify({ offer_id: offerId }) // Envoie l'ID de l'offre
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'added') {
                    this.classList.remove('text-gray-400');
                    this.classList.add('text-red-500'); // Change la couleur en rouge
                } else if (data.status === 'removed') {
                    this.classList.remove('text-red-500');
                    this.classList.add('text-gray-400'); // Change la couleur en gris
                }
            })
            .catch(error => console.error('Erreur:', error));
        });
    });
});
