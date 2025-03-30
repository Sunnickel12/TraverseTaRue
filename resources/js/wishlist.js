document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.heart').forEach(heart => {
        let offreId = heart.getAttribute('data-id');

        // Vérifier si l'offre est déjà dans la wishlist
        if (localStorage.getItem('wishlist_' + offreId)) {
            heart.textContent = '❤️'; // Cœur plein si déjà dans la wishlist
        }

        heart.addEventListener('click', function() {
            if (heart.textContent === '♡') {
                heart.textContent = '❤️'; // Ajouter à la wishlist
                localStorage.setItem('wishlist_' + offreId, true);
                addToWishlist(offreId);
            } else {
                heart.textContent = '♡'; // Retirer de la wishlist
                localStorage.removeItem('wishlist_' + offreId);
                removeFromWishlist(offreId);
            }
        });
    });
});

// Fonction AJAX pour ajouter une offre à la wishlist
function addToWishlist(offreId) {
    fetch("{{ route('wishlist.add') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ id_offers: offreId })
    })
    .then(response => response.json())
    .then(data => console.log(data.message))
    .catch(error => console.error('Erreur:', error));
}

// Fonction AJAX pour retirer une offre de la wishlist
function removeFromWishlist(offreId) {
    fetch("{{ route('wishlist.remove') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ id_offers: offreId })
    })
    .then(response => response.json())
    .then(data => console.log(data.message))
    .catch(error => console.error('Erreur:', error));
}
