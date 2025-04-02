document.addEventListener("DOMContentLoaded", function () {
    const paginationLinks = document.querySelectorAll(".pagination a");

    paginationLinks.forEach(link => {
        link.addEventListener("click", function (e) {
            e.preventDefault();
            const url = this.href;
            
            fetch(url, {
                headers: { "X-Requested-With": "XMLHttpRequest" }
            })
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, "text/html");
                document.querySelector("main").innerHTML = doc.querySelector("main").innerHTML;
                window.history.pushState({}, "", url);
            })
            .catch(error => console.error("Erreur de pagination :", error));
        });
    });
});
