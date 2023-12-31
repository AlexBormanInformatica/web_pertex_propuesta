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
            } else {
                detalles.style.display = 'none';
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
    }

    /*_________________________________________________MANEJAR ACCIONES_________________________________________________*/
    const enviarAnulado = document.getElementById('submitDelFormularioAnular');
    const formularioAnular = document.getElementById('formularioAnular');

    enviarAnulado.addEventListener('click', function () {
        formularioAnular.submit(); // Enviar el formulario cuando se hace clic en el botón
    });

});

$(document).ready(function () {
    // Agrega un manejador de clic a las filas con la clase "fila_hc"
    $(".fila_hc").click(function () {
        // Obtiene el valor de la primera columna (Nº diseño)
        var numDiseno = $(this).find("td:first").text();
        document.getElementById('id_disenoAnular').value = numDiseno;

        // Solicitud AJAX detalles del diseño
        $.ajax({
            url: "funciones/functions.php",
            type: 'POST',
            data: { detallesEncargoSeleccionado: "", numDiseno: numDiseno },
            success: function (response) {
                $("#celdaDetalles" + numDiseno).html(response);
            }
        });

        // Solicitud AJAX historial
        $.ajax({
            url: "funciones/functions.php",
            type: 'POST',
            data: { historialEncargoSeleccionado: "", numDiseno: numDiseno },
            success: function (response) {
                $("#mensajesEquipoPertex" + numDiseno).html("<h4 class='text-center m-0'>Modificaciones del diseño:</h4>" + response);
            }
        });
    });

    $('#cerrarDiv').click(function () {
        $('#divOk').fadeOut(1000);
    });

    //JQUERY VALIDATOR
    //ANULAR DISEÑO
    $("#formularioAnular").validate({
        rules: {
            comentarioAnular: "required",
        },
        messages: {
            comentarioAnular: "Campo obligatorio",
        },
        errorElement: "span",
        errorPlacement: function (error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");
            error.addClass("");
            error.insertAfter(element);
        }
    });

    // Cuando se hace clic en el botón "Ver boceto" en la tabla
    $('.ver-boceto-encargo').on('click', function () {
        $('#bocetoImage').attr('src', 'imagenes_bocetos/D' + $(this).data('encargo-id') + '.jpg');
        $('#verBoceto').css('display', 'block');
    });
});