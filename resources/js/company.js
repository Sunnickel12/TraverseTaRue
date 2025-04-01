document.addEventListener("DOMContentLoaded", function () {
    const carousel = document.getElementById("company-carousel");
    const prevBtn = document.getElementById("prev-btn");
    const nextBtn = document.getElementById("next-btn");
    
    let scrollAmount = 0;
    const scrollStep = 300;

    nextBtn.addEventListener("click", function () {
        if (scrollAmount < carousel.scrollWidth - carousel.clientWidth) {
            scrollAmount += scrollStep;
            carousel.scrollTo({ left: scrollAmount, behavior: "smooth" });
        }
    });

    prevBtn.addEventListener("click", function () {
        if (scrollAmount > 0) {
            scrollAmount -= scrollStep;
            carousel.scrollTo({ left: scrollAmount, behavior: "smooth" });
        }
    });
});