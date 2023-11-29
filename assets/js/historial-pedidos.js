
    /*_________________________________________________<INPUT> DE BUSQUEDA PRIMERA COLUMNA (Nº DISEÑO)_________________________________________________*/
    const input = document.getElementById("busquedaPedido");
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
        const currentPageSpan = document.getElementById("currentPage_pedidos");
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
    const prevPageButton = document.getElementById("prevPage_pedidos");
    const nextPageButton = document.getElementById("nextPage_pedidos");

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