import './bootstrap';
import './header';
import './home';
import './company';
import './contact';

// Mobile Menu Toggle
document.addEventListener("DOMContentLoaded", function () {
    const burgerIcon = document.getElementById("burger-icon");
    const mobileMenu = document.getElementById("mobile-menu");
    const mobileMenuOverlay = document.getElementById("mobile-menu-overlay");
    const closeMenu = document.getElementById("close-menu");

    if (!burgerIcon || !mobileMenu || !mobileMenuOverlay || !closeMenu) {
        console.error("Menu elements are missing from the DOM.");
        return;
    }

    // Open the mobile menu
    burgerIcon.addEventListener("click", function () {
        mobileMenu.classList.remove("hidden");
        mobileMenu.classList.add("block");
        mobileMenuOverlay.classList.remove("hidden");
    });

    // Close the mobile menu
    closeMenu.addEventListener("click", function () {
        mobileMenu.classList.add("hidden");
        mobileMenu.classList.remove("block");
        mobileMenuOverlay.classList.add("hidden");
    });

    // Close the menu when clicking outside
    mobileMenuOverlay.addEventListener("click", function () {
        mobileMenu.classList.add("hidden");
        mobileMenu.classList.remove("block");
        mobileMenuOverlay.classList.add("hidden");
    });
});