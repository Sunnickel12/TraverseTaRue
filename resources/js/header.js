// Menu mobile
const burgerIcon = document.getElementById('burger-icon');
const mobileMenu = document.getElementById('mobile-menu');
const closeMenu = document.getElementById('close-menu');

// Toggle menu mobile
burgerIcon.addEventListener('click', () => mobileMenu.classList.toggle('translate-x-0'));
closeMenu.addEventListener('click', () => mobileMenu.classList.toggle('translate-x-0'));

// Pop-up de connexion
const accountBtn = document.getElementById('account-btn');
const loginPopup = document.getElementById('login-popup');
const closeLoginPopup = document.getElementById('close-login-popup');
const popupBackground = loginPopup.querySelector('.bg-black');

// Affichage / masquage de la pop-up
accountBtn.addEventListener('click', () => {
    loginPopup.classList.remove('hidden');
    popupBackground.classList.add('opacity-50');
});
closeLoginPopup.addEventListener('click', () => {
    loginPopup.classList.add('hidden');
    popupBackground.classList.remove('opacity-50');
});
window.addEventListener('click', (e) => {
    if (e.target === loginPopup) {
        loginPopup.classList.add('hidden');
        popupBackground.classList.remove('opacity-50');
    }
});

// Toggle mot de passe
const passwordField = document.getElementById('password');
const togglePasswordIcon = document.getElementById('toggle-password-icon');

if (togglePasswordIcon) {
    togglePasswordIcon.addEventListener('click', () => {
        const isPassword = passwordField.type === 'password';
        passwordField.type = isPassword ? 'text' : 'password';
        togglePasswordIcon.src = isPassword ? window.eyeOpenIcon : window.eyeClosedIcon;
    });
}
