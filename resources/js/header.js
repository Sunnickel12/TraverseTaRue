// Menu mobile
const burgerIcon = document.getElementById('burger-icon');
const mobileMenu = document.getElementById('mobile-menu');
const closeMenu = document.getElementById('close-menu');
const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');

let startX = 0;

// Ouvrir le menu mobile
if (burgerIcon) {
    burgerIcon.addEventListener('click', () => {
        mobileMenu.classList.remove('hidden'); // Assure que le menu est visible
        mobileMenu.classList.remove('translate-x-full');
        mobileMenu.classList.add('translate-x-0');
        mobileMenuOverlay.classList.remove('hidden');
    });
}

// Fermer le menu mobile
if (closeMenu && mobileMenuOverlay) {
    closeMenu.addEventListener('click', closeMobileMenu);
    mobileMenuOverlay.addEventListener('click', closeMobileMenu);
}

function closeMobileMenu() {
    if (mobileMenu && mobileMenuOverlay) {
        mobileMenu.classList.add('hidden'); // Cache immédiatement le menu
        mobileMenu.classList.add('translate-x-full');
        mobileMenu.classList.remove('translate-x-0');
        mobileMenuOverlay.classList.add('hidden');
    }
}

// Gérer le swipe pour fermer le menu mobile sur tout l'écran
document.addEventListener('touchstart', (e) => {
    startX = e.touches[0].clientX;
});

document.addEventListener('touchmove', (e) => {
    let moveX = e.touches[0].clientX;
    if (startX - moveX > 50) { // Si l'utilisateur swipe à gauche
        closeMobileMenu();
    }
});

// Pop-up de connexion
const accountBtn = document.getElementById('account-btn');
const loginPopup = document.getElementById('login-popup');
const closeLoginPopup = document.getElementById('close-login-popup');
const popupBackground = loginPopup ? loginPopup.querySelector('.bg-black') : null;

// Affichage / masquage de la pop-up
document.addEventListener('DOMContentLoaded', () => {
    if (accountBtn && loginPopup && popupBackground) {
        accountBtn.addEventListener('click', () => {
            loginPopup.classList.remove('hidden');
            popupBackground.classList.add('opacity-50');
        });
    }

    if (closeLoginPopup && loginPopup && popupBackground) {
        closeLoginPopup.addEventListener('click', () => {
            loginPopup.classList.add('hidden');
            popupBackground.classList.remove('opacity-50');
        });
    }

    if (popupBackground) {
        window.addEventListener('click', (e) => {
            if (e.target === popupBackground) {
                loginPopup.classList.add('hidden');
                popupBackground.classList.remove('opacity-50');
            }
        });
    }

    // Fermer la pop-up avec la touche Échap
    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && loginPopup && !loginPopup.classList.contains('hidden')) {
            loginPopup.classList.add('hidden');
            popupBackground.classList.remove('opacity-50');
        }
    });

    // Toggle mot de passe
    const passwordField = document.getElementById('password');
    const togglePasswordIcon = document.getElementById('toggle-password-icon');

    if (togglePasswordIcon && passwordField) {
        togglePasswordIcon.addEventListener('click', () => {
            const isPassword = passwordField.type === 'password';
            passwordField.type = isPassword ? 'text' : 'password';
            togglePasswordIcon.src = isPassword ? window.eyeOpenIcon : window.eyeClosedIcon;
        });
    }
});

// Menu utilisateur (affichage du menu burger après connexion)
const userMenuBtn = document.getElementById('user-menu-btn');
const userMenu = document.getElementById('user-menu');

if (userMenuBtn && userMenu) {
    userMenuBtn.addEventListener('click', () => {
        userMenu.classList.toggle('hidden');
    });
}

// Menu utilisateur (bouton user-btn)
const userBtn = document.getElementById('user-btn');
const menu = document.getElementById('usermenu');

if (userBtn && menu) {
    userBtn.addEventListener('click', (event) => {
        event.stopPropagation(); // Empêche la propagation pour éviter la fermeture immédiate
        menu.classList.toggle('hidden');
    });

    document.addEventListener('click', (event) => {
        if (menu && !menu.contains(event.target) && !userBtn.contains(event.target)) {
            menu.classList.add('hidden');
        }
    });
}

// Désactiver le bouton de soumission du formulaire de connexion après un clic
const loginForm = document.querySelector('form');
const submitButton = loginForm ? loginForm.querySelector('button[type="submit"]') : null;

if (loginForm && submitButton) {
    loginForm.addEventListener('submit', function () {
        submitButton.disabled = true;
        submitButton.innerHTML = 'En cours...'; 
    });

    window.addEventListener('click', (e) => {
        if (e.target === popupBackground) {
            loginPopup.classList.add('hidden');
            popupBackground.classList.remove('opacity-50');
        }
    });

    // Fermer la pop-up avec la touche Échap
    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !loginPopup.classList.contains('hidden')) {
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
};