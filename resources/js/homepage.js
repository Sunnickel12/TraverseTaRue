$(document).ready(function () {
    // Fonctionnalité de défilement horizontal pour le carrousel des entreprises partenaires
    const $carousel = $('#partnerCarousel');
    const $prevBtn = $('#prevBtn');
    const $nextBtn = $('#nextBtn');

    $prevBtn.on('click', function () {
        $carousel.animate({ scrollLeft: '-=300' }, 300); // Défilement vers la gauche
    });

    $nextBtn.on('click', function () {
        $carousel.animate({ scrollLeft: '+=300' }, 300); // Défilement vers la droite
    });

    // Fonctionnalité "Lire plus / Lire moins" pour le texte
    const $paragraphContainer = $('#paragraph-container');
    const $homeBtn = $('#homeBtn');

    if ($paragraphContainer.length && $homeBtn.length) {
        $homeBtn.on('click', function () {
            if ($paragraphContainer.hasClass('max-h-24')) {
                // Afficher tout le texte
                $paragraphContainer.removeClass('max-h-24').addClass('max-h-full');
                $homeBtn.text('Lire moins');
            } else {
                // Réduire le texte
                $paragraphContainer.removeClass('max-h-full').addClass('max-h-24');
                $homeBtn.text('Lire plus');
            }
        });
    }
});