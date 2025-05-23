document.addEventListener('DOMContentLoaded', () => {
    const paragraphContainer = document.getElementById('paragraph-container');
    const homeBtn = document.getElementById('homeBtn');

    if (paragraphContainer && homeBtn) {
        homeBtn.addEventListener('click', () => {
            const isCollapsed = paragraphContainer.classList.contains('max-h-24');

            // Toggle between collapsed and expanded states
            paragraphContainer.classList.toggle('max-h-24');
            paragraphContainer.classList.toggle('max-h-full');

            // Update button text
            homeBtn.textContent = isCollapsed ? 'Lire moins' : 'Lire plus';
        });
    }

    // Hide success popup after 2 seconds
    setTimeout(function () {
        let popup = document.getElementById('success-popup');
        if (popup) {
            popup.style.display = 'none';
        }
    }, 2000); 
});
