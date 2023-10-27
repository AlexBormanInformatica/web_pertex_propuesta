document.addEventListener('DOMContentLoaded', function () {
    let currentPage = 1; // Página actual
    const recordsPerPage = 10; // Cantidad de registros por página

    /*_________________________________________________Detalles del encargo seleccionado_________________________________________________*/
    // Obtén todas las filas de encargo
    const filasEncargo = document.querySelectorAll('.fila_hc');

    // Agrega un evento clic a cada fila de encargo
    filasEncargo.forEach(function (fila) {
        fila.addEventListener('click', function () {
            // Encuentra la fila de detalles correspondiente
            const detalles = fila.nextElementSibling;

            // Alternar la visibilidad de la fila de detalles
            if (detalles.style.display === 'none' || getComputedStyle(detalles).display === 'none') {
                detalles.style.display = 'table-row';
                fila.classList.add('seleccionada'); // Aplica la clase seleccionada
            } else {
                detalles.style.display = 'none';
                fila.classList.remove('seleccionada'); // Quita la clase seleccionada
            }
        });
    });

    /*_________________________________________________<INPUT> DE BUSQUEDA PRIMERA COLUMNA (Nº DISEÑO)_________________________________________________*/
    const input = document.getElementById("busquedaEncargo");
    const table_body = document.getElementById("the_table_body");
    const rows = table_body.getElementsByClassName("fila_hc");

    // Agrega un evento de escucha para el evento 'input' en el campo de búsqueda
    input.addEventListener("input", function () {
        ocultarDetalles();

        const filter = input.value.trim().toUpperCase();
        if (filter == "" && Math.ceil(document.getElementsByClassName("fila_hc").length / recordsPerPage) > 1) {
            $('#paginationControls').show();
            showPage(currentPage);
        } else {
            $('#paginationControls').hide();
        }
        for (let i = 0; i < rows.length; i++) {
            const firstCell = rows[i].getElementsByTagName("td")[0];
            const cellText = firstCell.textContent || firstCell.innerText;
            const found = cellText.toUpperCase().includes(filter);
            rows[i].style.display = found ? "" : "none";
        }
    });

    /*_________________________________________________FILTRAR POR <SELECT> DE PRODUCTOS_________________________________________________*/
    const uniqueProducts = [...new Set([...document.querySelectorAll('#the_table_body .fila_hc td:nth-child(5)')].map(td => td.textContent.trim()))];

    // Llena el select con las opciones de productos únicos
    const filtroProductoSelect = document.getElementById("filtroProducto");
    uniqueProducts.forEach(product => {
        const option = document.createElement("option");
        option.value = product;
        option.textContent = product;
        filtroProductoSelect.appendChild(option);
    });

    // Agrega un manejador de eventos para el cambio en el select
    filtroProductoSelect.addEventListener("change", function () {
        ocultarDetalles();

        const selectedProduct = filtroProductoSelect.value;

        // Oculta todas las filas de la tabla
        document.querySelectorAll('#the_table_body .fila_hc').forEach(row => {
            row.style.display = "none";
        });

        // Muestra las filas que coinciden con el producto seleccionado o muestra todas si se selecciona "Todos los productos"
        document.querySelectorAll('#the_table_body .fila_hc td:nth-child(5)').forEach(td => {
            if (selectedProduct === "" || td.textContent.trim() === selectedProduct) {
                if (selectedProduct === "" && Math.ceil(document.getElementsByClassName("fila_hc").length / recordsPerPage) > 1) {
                    $('#paginationControls').show();
                    showPage(currentPage);
                } else {
                    $('#paginationControls').hide();
                }
                td.parentElement.style.display = "";
            }
        });
    });

    /*_________________________________________________PAGINACION_________________________________________________*/
    // Función para mostrar la página actual
    function showPage(pageNumber) {
        const rows = document.getElementsByClassName("fila_hc");
        const startIndex = (pageNumber - 1) * recordsPerPage;
        const endIndex = startIndex + recordsPerPage;

        for (let i = 0; i < rows.length; i++) {
            if (i >= startIndex && i < endIndex) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }

        const totalRows = document.getElementsByClassName("fila_hc").length;
        const totalPages = Math.ceil(totalRows / recordsPerPage);

        // Actualiza la página actual en el HTML
        const currentPageSpan = document.getElementById("currentPage");
        currentPageSpan.textContent = ` ${currentPage} / ${totalPages}`;

        if (totalPages == 1) {
            $('#paginationControls').hide();
        } else {
            $('#paginationControls').show();
        }
    }

    // Muestra la página inicial al cargar
    showPage(currentPage);

    // Maneja los botones de paginación
    const prevPageButton = document.getElementById("prevPage");
    const nextPageButton = document.getElementById("nextPage");

    prevPageButton.addEventListener("click", () => {
        ocultarDetalles();

        if (currentPage > 1) {
            currentPage--;
            showPage(currentPage);
        }
    });

    nextPageButton.addEventListener("click", () => {
        ocultarDetalles();

        const totalRows = document.getElementsByClassName("fila_hc").length;
        const totalPages = Math.ceil(totalRows / recordsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            showPage(currentPage);
        }
    });

    function ocultarDetalles() {
        // Oculto los detalles que estén abiertos
        const detallesAbiertos = document.getElementsByClassName("no-hover");
        for (let i = 0; i < detallesAbiertos.length; i++) {
            detallesAbiertos[i].style.display = 'none';
        }
        // Quito la clase "seleccionada" de las filas
        const filasSeleccionadas = document.getElementsByClassName("fila_hc seleccionada");
        for (let i = 0; i < filasSeleccionadas.length; i++) {
            filasSeleccionadas[i].classList.remove('seleccionada');
        }
    }

    /*_________________________________________________MANEJAR ACCIONES_________________________________________________*/
    // Agrega un manejador de eventos para el botón de anulación
    document.querySelectorAll('.anular-encargo').forEach(button => {
        button.addEventListener('click', function () {
            const encargoId = this.getAttribute('data-encargo-id');
            
        });
    });

});

$(document).ready(function () {
    // Agrega un manejador de clic a las filas con la clase "fila_hc"
    $(".fila_hc").click(function () {
        // Obtiene el valor de la primera columna (Nº diseño)
        var numDiseno = $(this).find("td:first").text();

        // Solicitud AJAX
        $.ajax({
            url: "funciones/functions.php",
            type: 'POST',
            data: { detallesEncargoSeleccionado: "", numDiseno: numDiseno },
            success: function (response) {
                $("#celdaDetalles" + numDiseno).html(response);
            }
        });
    });
});