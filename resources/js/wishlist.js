//interaction du coeur 
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.heart').forEach(heart => {
        let offreId = heart.getAttribute('data-id');

        // Vérifier si l'offre est déjà en wishlist (stockée en localStorage pour l'instant)
        if (localStorage.getItem('wishlist_' + offreId)) {
            heart.textContent = '❤️'; // Remplir le cœur si déjà en wishlist
        }

        heart.addEventListener('click', function() {
            if (heart.textContent === '♡') {
                heart.textContent = '❤️'; // Remplir le cœur
                localStorage.setItem('wishlist_' + offreId, true);
                addToWishlist(offreId);
            } else {
                heart.textContent = '♡'; // Vider le cœur
                localStorage.removeItem('wishlist_' + offreId);
                removeFromWishlist(offreId);
            }
        });
    });
});

// Fonction AJAX pour ajouter à la wishlist
function addToWishlist(offreId) {
    fetch("{{ route('wishlist.add') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ id_offers: offreId })
    }).then(response => response.json())
      .then(data => console.log(data.message))
      .catch(error => console.error('Erreur:', error));
}

// Fonction AJAX pour retirer de la wishlist
function removeFromWishlist(offreId) {
    fetch("{{ route('wishlist.remove') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ id_offers: offreId })
    }).then(response => response.json())
      .then(data => console.log(data.message))
      .catch(error => console.error('Erreur:', error));
}
