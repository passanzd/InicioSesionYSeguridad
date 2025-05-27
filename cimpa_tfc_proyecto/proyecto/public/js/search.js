document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("campo-busqueda");
    const rows = document.querySelectorAll(".tabla-wrapper tbody tr:not(#sin-resultados tr)");
    const noResults = document.getElementById("sin-resultados");

    searchInput.addEventListener("input", function () {
        const filter = searchInput.value.toLowerCase();
        let matches = 0;

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const isVisible = text.includes(filter);
            row.style.display = isVisible ? "" : "none";
            if (isVisible) matches++;
        });


        if (noResults) {
            noResults.style.display = matches === 0 ? "" : "none";
        }
    });
});


