document.addEventListener('DOMContentLoaded', function () {
    // Obtén todas las filas de encargo
    const filasEncargo = document.querySelectorAll('.fila_hc');

    // Agrega un evento clic a cada fila de encargo
    filasEncargo.forEach(function (fila) {
        fila.addEventListener('click', function () {
            // Encuentra la fila de detalles correspondiente
            const detalles = fila.nextElementSibling;

            // Alternar la visibilidad de la fila de detalles
            if (detalles.style.display === 'none' || detalles.style.display === '') {
                detalles.style.display = 'table-row';
            } else {
                detalles.style.display = 'none';
            }
        });
    });
});