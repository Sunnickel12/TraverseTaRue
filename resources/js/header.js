$(document).ready(function () {
    // Menu mobile
    const $burgerIcon = $('#burger-icon');
    const $mobileMenu = $('#mobile-menu');
    const $closeMenu = $('#close-menu');

    // Vérifiez si les éléments existent avant d'ajouter des écouteurs d'événements
    if ($burgerIcon.length && $mobileMenu.length && $closeMenu.length) {
        // Toggle menu mobile
        $burgerIcon.on('click', function () {
            $mobileMenu.toggleClass('translate-x-0');
        });

        $closeMenu.on('click', function () {
            $mobileMenu.toggleClass('translate-x-0');
        });
    }

    // Pop-up de connexion
    const $accountBtn = $('#account-btn');
    const $loginPopup = $('#login-popup');
    const $closeLoginPopup = $loginPopup.find('#close-login-popup');
    const $popupBackground = $loginPopup.find('.bg-black');

    // Vérifiez si les éléments existent avant d'ajouter des écouteurs d'événements
    if ($accountBtn.length && $loginPopup.length && $closeLoginPopup.length && $popupBackground.length) {
        // Affichage / masquage de la pop-up
        $accountBtn.on('click', function () {
            $loginPopup.removeClass('hidden');
            $popupBackground.addClass('opacity-50');
        });

        $closeLoginPopup.on('click', function () {
            $loginPopup.addClass('hidden');
            $popupBackground.removeClass('opacity-50');
        });

        $(window).on('click', function (e) {
            if ($(e.target).is($loginPopup)) {
                $loginPopup.addClass('hidden');
                $popupBackground.removeClass('opacity-50');
            }
        });
    }

    // Toggle mot de passe
    const $passwordField = $('#password');
    const $togglePasswordIcon = $('#toggle-password-icon');

    // Vérifiez si les éléments existent avant d'ajouter des écouteurs d'événements
    if ($passwordField.length && $togglePasswordIcon.length) {
        $togglePasswordIcon.on('click', function () {
            const isPassword = $passwordField.attr('type') === 'password';
            $passwordField.attr('type', isPassword ? 'text' : 'password');
            $togglePasswordIcon.attr('src', isPassword ? window.eyeOpenIcon : window.eyeClosedIcon);
        });
    }
});