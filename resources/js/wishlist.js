document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".heart").forEach(function (heart) {
        heart.addEventListener("click", function () {
            let offerId = this.getAttribute("data-id");
            let isFavorite = this.innerText === "❤️"; // Vérifier l'état actuel

            fetch(`/toggle-favorite/${offerId}`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "added") {
                    this.innerText = "❤️";
                    this.classList.remove("text-gray-400");
                    this.classList.add("text-red-500");
                } else {
                    this.innerText = "🤍";
                    this.classList.remove("text-red-500");
                    this.classList.add("text-gray-400");
                }
            })
            .catch(error => console.error("Erreur:", error));
        });
    });
});
function toggleHeart(icon) {
            if (icon.classList.contains("bi-suit-heart")) {
                icon.classList.remove("bi-suit-heart");
                icon.classList.add("bi-suit-heart-fill");
            } else {
                icon.classList.remove("bi-suit-heart-fill");
                icon.classList.add("bi-suit-heart");
            }
        }

