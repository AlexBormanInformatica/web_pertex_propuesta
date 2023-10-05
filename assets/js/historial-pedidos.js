(function ($) {
    var id = 0;
    var numero = 0;
    var total = 0;
    var info_estado = "";
    var info_estado2 = "";
    var info_estado3 = "";
    var info_estado4 = "";
    var estado = "";

    /**
     * Muestra los botones de la columna ACCIONES (tabla historial de pedidos) dependiendo el estado en el que se encuentre dicho pedido
     */
    function mostrarBotonesSegunEstado() {

        //Si existe al menos un pedido
        if ($("#tablaHistorial tr").length > 1) {
            var numPedido = "";
            var resume_table = document.getElementById("tablaHistorial");
            //Recorro la tabla por fila
            for (var i = 1, row; row = resume_table.rows[i]; i++) {
                //Recorro por columna(fila)
                for (var j = 0, col; col = row.cells[j]; j++) {
                    //console.log(`Txt: ${col.innerText} \tFila: ${i} \t Celda: ${j}`);

                    if (j == 0) {
                        numPedido = col.innerText.trim();
                    }
                    if (j == 4) {
                        switch (col.innerText.trim()) {

                            case 'Pendiente':
                                $('.confirmarPedido_' + numPedido).show();
                                $('.verBoceto_' + numPedido).hide();
                                $('.eliminarPedido_' + numPedido).show();
                                $('.anularPedido_' + numPedido).hide();
                                break;
                            case 'Confirmado':
                                $('.confirmarPedido_' + numPedido).hide();
                                $('.verBoceto_' + numPedido).hide();
                                $('.eliminarPedido_' + numPedido).hide();
                                $('.anularPedido_' + numPedido).show();
                                break;
                            case 'Validado':
                                $('.confirmarPedido_' + numPedido).hide();
                                $('.verBoceto_' + numPedido).hide();
                                $('.eliminarPedido_' + numPedido).hide();
                                $('.anularPedido_' + numPedido).show();
                                break;
                            case 'Preparando boceto':
                                $('.confirmarPedido_' + numPedido).hide();
                                $('.verBoceto_' + numPedido).hide();
                                $('.eliminarPedido_' + numPedido).hide();
                                $('.anularPedido_' + numPedido).show();
                                break;
                            case 'Boceto generado':
                                $('.confirmarPedido_' + numPedido).hide();
                                $('.verBoceto_' + numPedido).show();
                                $('.eliminarPedido_' + numPedido).hide();
                                $('.anularPedido_' + numPedido).show();
                                break;
                            case 'No aceptado':
                                $('.confirmarPedido_' + numPedido).hide();
                                $('.verBoceto_' + numPedido).hide();
                                $('.eliminarPedido_' + numPedido).hide();
                                $('.anularPedido_' + numPedido).show();
                                break;
                            case 'Procesando pago':
                                $('.confirmarPedido_' + numPedido).hide();
                                $('.verBoceto_' + numPedido).hide();
                                $('.eliminarPedido_' + numPedido).hide();
                                $('.anularPedido_' + numPedido).hide();
                                break;
                            case 'Pago confirmado':
                                $('.confirmarPedido_' + numPedido).hide();
                                $('.verBoceto_' + numPedido).hide();
                                $('.eliminarPedido_' + numPedido).hide();
                                $('.anularPedido_' + numPedido).hide();
                                break;
                            case 'Pendiente fabricar':
                                $('.confirmarPedido_' + numPedido).hide();
                                $('.verBoceto_' + numPedido).hide();
                                $('.eliminarPedido_' + numPedido).hide();
                                $('.anularPedido_' + numPedido).hide();
                                break;
                            case 'Esperando anticipo':
                                $('.confirmarPedido_' + numPedido).hide();
                                $('.verBoceto_' + numPedido).hide();
                                $('.eliminarPedido_' + numPedido).hide();
                                $('.anularPedido_' + numPedido).hide();
                                break;
                            case 'Fabricando':
                                $('.confirmarPedido_' + numPedido).hide();
                                $('.verBoceto_' + numPedido).hide();
                                $('.eliminarPedido_' + numPedido).hide();
                                $('.anularPedido_' + numPedido).hide();
                                break;
                            case 'Enviando':
                                $('.confirmarPedido_' + numPedido).hide();
                                $('.verBoceto_' + numPedido).hide();
                                $('.eliminarPedido_' + numPedido).hide();
                                $('.anularPedido_' + numPedido).hide();

                                break;
                            case 'Anulado':
                                $('.confirmarPedido_' + numPedido).hide();
                                $('.verBoceto_' + numPedido).hide();
                                $('.eliminarPedido_' + numPedido).hide();
                                $('.anularPedido_' + numPedido).hide();
                                break;
                        }
                    }
                }
            }
        }
    }
    mostrarBotonesSegunEstado();


    //Control botones tabla-----------------------------------------------------------------------------------------------

    //Al darle click al icono de información abrirá una ventana modal con los descripción del estado de ese pedido
    $('#tablaHistorial').on('click', '.estadoPedido', 'td', function (event) {
        $(this).each(function (i) {
            //Textos correspondientes de información dependiendo el estado del pedido
            switch ($(this).text().trim()) {
                case 'Pendiente':
                    estado = "pendiente";
                    info_estado = $("#txt-info-pendiente-1").text();
                    info_estado2 = "";//$("#txt-info-pendiente-2").text();
                    info_estado3 = $("#txt-info-pendiente-3").text();
                    info_estado4 = "";
                    break;

                case 'Confirmado':
                    estado = "confirmado";
                    info_estado = $("#txt-info-confirmado-1").text();
                    info_estado2 = $("#txt-info-confirmado-2").text();
                    info_estado3 = $("#txt-info-confirmado-3").text();
                    info_estado4 = "";
                    break;

                case 'Validado':
                    estado = "";
                    info_estado = $("#txt-info-validado-1").text();
                    info_estado2 = $("#txt-info-validado-2").text();
                    info_estado3 = $("#txt-info-validado-3").text();
                    info_estado4 = "";
                    break;

                case 'Preparando boceto':
                    estado = "preparando";
                    info_estado = $("#txt-info-preparando-1").text();
                    info_estado2 = $("#txt-info-preparando-2").text();
                    info_estado3 = $("#txt-info-preparando-3").text();
                    info_estado4 = "";
                    break;

                case 'Boceto generado':
                    estado = "generado";
                    info_estado = $("#txt-info-boceto-1").text();
                    info_estado2 = $("#txt-info-boceto-2").text();
                    info_estado3 = $("#txt-info-boceto-3").text();
                    info_estado4 = $("#txt-info-boceto-4").text();
                    info_estado4 = "";
                    break;

                case 'Procesando pago':
                    estado = "pago";
                    info_estado = $("#txt-info-procesando-pago-1").text();
                    info_estado2 = $("#txt-info-procesando-pago-2").text();
                    info_estado3 = "";
                    info_estado4 = "";
                    break;

                case 'Pago confirmado':
                    estado = "";
                    info_estado = $("#txt-info-pago-ok-1").text();
                    info_estado2 = $("#txt-info-pago-ok-2").text();
                    info_estado3 = "";
                    info_estado4 = "";
                    break;

                case 'Pendiente fabricar':
                    estado = "";
                    info_estado = $("#txt-info-pago-ok-1").text();
                    info_estado2 = $("#txt-info-pago-ok-2").text();
                    info_estado3 = "";
                    info_estado4 = "";
                    break;

                case 'Fabricando':
                    estado = "fabricando";
                    info_estado = $("#txt-info-fabricando-1").text();
                    info_estado2 = $("#txt-info-fabricando-2").text();
                    info_estado3 = "";
                    info_estado4 = "";
                    break;

                case 'Enviando':
                    estado = "enviando";
                    info_estado = $("#txt-info-enviando-1").text();
                    info_estado2 = $("#txt-info-enviando-2").text();
                    info_estado3 = "";//$("#txt-info-enviando-3").text();
                    info_estado4 = $("#txt-info-enviando-4").text();
                    break;

                case 'Anulado':
                    break;
            }
        });
    });

    //Obtener id del pedido al darle al boton ver detalles
    $('#tablaHistorial').on('click', '.fila_hc', 'tr', function (event) {
        $(this).children("td").each(function (i) {
            switch (i) {
                case 0:
                    id = $(this).text();
                    break;
            }
        });
        $('.divsLP').hide();
        $('.div_idLP_' + id).show();
        $('#detalles_pedido').show();
        $('.divMuestra').hide();
        $('.muestras_' + id).show();

        $('#idPedidoEliminar').val(id);

        $('.lineasEliminar').hide();
        $('.lineaEliminar_' + id).show();

        $('.checkLineasEliminar').attr("disabled", true);;
        $('.checkLineaEliminar_' + id).removeAttr("disabled");
        //Lista eliminar
    });

    //Obtener id, numero del pedido y total al darle al boton ver boceto
    $('#tablaHistorial').on('click', '.btnVerBoceto', 'tr', function (event) {
        $('.divBocetos').hide();
        $(this).parent().parent().children("td").each(function (i) {
            switch (i) {
                case 3:
                    total = $(this).text();
                    break;
                case 0:
                    id = $(this).text();
                    break;
            }
        });
        $(this).parent().parent().children("td").each(function (i) {
            switch (i) {
                case 0:
                    $('.lpBoceto_' + id).show();
                    $('#btnRechazarBoceto').show();
                    break;
                case 6:
                    if ($(this).text() == "repetido") {
                        $('#btnRechazarBoceto').hide();
                        $('#formconfirma').attr('action', 'checkout');

                    }
                    break;
            }
        });

        $('#idPedidos').val(id);
        $('#total').val(total);
        $('#numeroPedido').val(id);
    });

    //Obtener id del pedido al darle al boton confirmar
    $('#tablaHistorial').on('click', '.btnConfirmarPedido', 'tr', function (event) {
        $(this).parent().parent().children("td").each(function (i) {
            switch (i) {
                case 0:
                    id = $(this).text();
                    break;
            }
        });
    });


    //Obtener id del pedido al darle al boton eliminar
    $('#tablaHistorial').on('click', '.btnEliminarPedido', 'tr', function (event) {
        $(this).parent().parent().children("td").each(function (i) {
            switch (i) {
                case 0:
                    id = $(this).text();
                    break;
            }
        });
    });

    //Obtener id del pedido al darle al boton anular
    $('#tablaHistorial').on('click', '.btnAnularPedido', 'tr', function (event) {
        $(this).parent().parent().children("td").each(function (i) {
            switch (i) {
                case 0:
                    id = $(this).text();
                    break;
            }
        });
        $('#idPedidoA').val(id);
        $('#numPedidoA').val(id);
    });

    //Obtener id del pedido al darle al boton valorar
    $('#tablaHistorial').on('click', '.btnFinalizarPedido', 'tr', function (event) {
        $(this).parent().parent().children("td").each(function (i) {
            switch (i) {
                case 0:
                    id = $(this).text();
                    break;
            }
        });
        $('#numPedidoF').val(id);
        $('#idPedidoF').val(id);
    });

    //Control modales---------------------------------------------------------------------
    $(document).on('click', '#btn-modal-ines', function () {//Inserta los textos de informacion del estado
        $('#texto-m-estado').html(info_estado);
        $('#texto-m-estado-2').html(info_estado2);
        $('#texto-m-estado-3').html(info_estado3);
        $('#texto-m-estado-4').html(info_estado4);
        $('#link_ancla').attr('href', "infografia#" + estado);
    });

    $(document).on('click', '.btnAnularPedido', function () {
        $('#idPedido').val(id);
        $('#numPedido').val(id);
    });

    /**
     * Al darle a cada botón se asignara a un elemento como valor el id o numero de pedido recogido anteriormente.
     * En el caso de rechazar pedido se oculta el footer que es el formulario donde indicara los motivos si le da al botón
     */
    $(document).on('click', '#btnRechazarBoceto', function () {
        $('#footModal').hide();
        $('#divFormRechazoBoceto').show();
        $('#idPedido').val(id);
        $('#numPedido').val(id);
    });

    $(document).on('hide.bs.modal', '#boceto', function () {
        $('#footModal').show();
        $('#divFormRechazoBoceto').hide();
    });

    $(document).on('click', '.btnRepetirPedido', function () {
        //Buscar que exista mas de una linea de pedido en pedidos enviados
        $('#masDeUnaLinea').show();
        $('.pedidosFinalizados').hide();
        $('.pedido_' + id).show();

        //Eliminar <em></em> de existir (linea de error)
        $('.idlbl').siblings("em").remove();
        $('.cantidadRepetir').siblings("em").remove();
        $('.nombredisenorep').siblings("em").remove();

        //Limpiamos checkbox e inputs
        $('.cantidadRepetir').siblings("em").remove();
        $('.cantidadRepetir').val('');
        $('.nombredisenorep').siblings("em").remove();
        $('.nombredisenorep').val('');
        $('.lpCheck').prop("checked", false);
    });

    /**
     * Redirecciona las urls con los get necesarios
     */
    $(document).on('click', '#btnSiConfirma', function () {
        $('#btnSiConfirma').addClass("button--loading");
        $('#btnSiConfirma').prop("disabled", true);

        var comercial = $('#comercial').val();
        var nombredecomercial = $("#comercial option:selected").text();

        var cliente = $('#clienteFP').val();
        var anticipo = $('#sianticipo').is(':checked') ? 1 : 0;
        var porcentajeanticipo = $('#porcentajeAnticipo').val();
        var comentario = $('#comentario').val();
        window.location.replace("./DAOs//historial-pedidosDAO.php?pag=" + document.location.href.match(/[^\/]+$/)[0] + "&scnf=" + id
            + "&numPedido=" + id + "&comentario=" + comentario + "&cliente=" + cliente + "&comercial=" + comercial + "&nombredecomercial=" + nombredecomercial
            + "&anticipo=" + anticipo + "&porcentajeanticipo=" + porcentajeanticipo);
    });
    /**
     * Redirecciona las urls con los get necesarios
     */
    $(document).on('click', '#btnSiConfirmaRepetido', function () {
        $('#btnSiConfirmaRepetido').addClass("button--loading");
        $('#btnSiConfirmaRepetido').prop("disabled", true);

        var comercial = $('#comercialrep').val();
        var nombredecomercial = $("#comercialrep option:selected").text();

        var cliente = $('#clienteFPrep').val();
        var anticipo = $('#sianticiporep').is(':checked') ? 1 : 0;
        var porcentajeanticipo = $('#porcentajeAnticipoRep').val();
        var comentario = $('#comentariorep').val();
        window.location.replace("./DAOs/historial-pedidosDAO.php?pag=" + document.location.href.match(/[^\/]+$/)[0] + "&scnf2=" + id
            + "&numPedido=" + id + "&comentario=" + comentario + "&cliente=" + cliente + "&comercial=" + comercial + "&nombredecomercial=" + nombredecomercial
            + "&anticipo=" + anticipo + "&porcentajeanticipo=" + porcentajeanticipo);
    });

    $(document).on('click', '#btnSiElimina', function () {
        $('#btnSiElimina').addClass("button--loading");
        $('#btnSiElimina').prop("disabled", true);
        window.location.replace("./DAOs/historial-pedidosDAO.php?pag=" + document.location.href.match(/[^\/]+$/)[0] + "&slm=" + id);
    });

    $(document).on('click', '.btnEliminarLineaPedido', function () {
        window.location.replace("./DAOs/historial-pedidosDAO.php?pag=" + document.location.href.match(/[^\/]+$/)[0] + "&slmlp=" + $(this).attr("id") + "&slm2=" + id);
    });

    $(document).on('click', '.btnEliminarLineaMuestra', function () {
        window.location.replace("./DAOs/historial-pedidosDAO.php?pag=" + document.location.href.match(/[^\/]+$/)[0] + "&slmlm=" + $(this).attr("id") + "&slm3=" + id);
    });


    /**
     * Funcion del buscador de la tabla
     */
    $("#q").keyup(function () {
        console.log("s");
        var num_cols, display, input, filter, table_body, tr, td, i, txtValue;
        num_cols = 5;
        input = document.getElementById("q");
        filter = input.value.toUpperCase();
        table_body = document.getElementById("the_table_body");
        tr = table_body.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            display = "none";
            for (j = 0; j < num_cols; j++) {
                td = tr[i].getElementsByTagName("td")[j];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        display = "";
                    }
                }
            }
            tr[i].style.display = display;
        }
    });



})(jQuery);