(function ($) {
    const sibase = $("#sibase");
    const nobase = $("#nobase");
    const sipelo = $("#sipelo");
    const nopelo = $("#nopelo");
    const sitope = $("#siTopePulsera");
    const notope = $("#noTopePulsera");
    const tecnica = $("#tecnica");
    const selectBase = $("#selectBase");
    const contadorColores = document.getElementById("contadorColores");
    const txtColores = document.getElementById("p-txt-colores");
    const tituloColores = document.getElementById("tituloColores");
    const tecnicaTuProducto = document.getElementById("tecnicaTuProducto");
    var forma = "";
    var base = false;
    var suma = 0;

    const colorDiseno = $("#colorDiseno");
    const colorMetal = $("#colorMetal");
    const colorPiel = $("#colorPiel");

    /*
     $('select[name="tecnica"] :selected').attr('class').split(' ')[0]
     [0] maximo de colores
     [1] precio del molde
     [2] €
     [3] id texto archivos
     [4] id formas
     [5] cmyk (t/f)
     [6] colores (t/f)
     [7] tope (t/f)
    */


    //Técnica
    tecnica.on('change', function () {
        //Cuando cambie la tecnica seleccionada se ocultarán y vaciarán todos los campos
        //Como si se reiniciara el formulario
        $('#lblcolorBase').hide();
        $('#rowColoresMetal').hide();
        $('#rowColoresPiel').hide();
        $('.metalicos').hide();
        $('.pieles').hide();
        $('#divMedidasTela').hide();
        $('#rowBotonImagen').hide();
        $('#rowTopes').hide();
        $('#rowPxuBase').hide();
        $('#rowPxuPelo').hide();
        $('#rowSuperficieBase').hide();
        $('#rowMoldeBase').hide();
        $('#rowColoresBase').hide();

        $('#pTopesTuProducto').text('');
        $('#pTopesTuProducto').val('');

        $('#superficieTuProducto').text('');
        $('#superficieTuProducto').val('');

        $('#superficieBaseTuProducto').text('');
        $('#superficieBaseTuProducto').val('');

        $('#pMoldeBaseTuProducto').text('');
        $('#pMoldeBaseTuProducto').val('');

        $('#pMoldePeloTuProducto').text('');
        $('#pMoldePeloTuProducto').val('');

        $('#pPxuTuProducto').text('');
        $('#pPxuTuProducto').val('');

        $('#pPxuBaseTuProducto').text('');
        $('#pPxuBaseTuProducto').val('');

        $('#pPxuPeloTuProducto').text('');
        $('#pPxuPeloTuProducto').val('');

        $('#cantidadTuProducto').text('');
        $('#cantidadTuProducto').val('');

        $('#coloresTuProducto').empty();

        $('#sBaseTuProducto').text('');

        $('#pBaseTuProducto').text('');

        $('#pBaseTuProducto').val('');

        $('#cBaseTuProducto').text('');

        $('#cMetalTuProducto').text('');

        $('#cPielTuProducto').text('');

        // $('#archivo').hide();
        // $('#archivo').val('');
        // $('#imagenPrevisualizacion').hide();
        // $('#imagenPrevisualizacion')[0].setAttribute("src", "");
        $('#nobase').prop("checked", true);
        $('#nopelo').prop("checked", true);
        $('#noTopePulsera').prop("checked", true);

        // $('#aceptaPI').prop("checked", false);
        // $('#archivo').prop("disabled", true);
        $('#pBase').hide();
        $('#pBaseVelcro').hide();
        $('#pBaseTela').hide();

        $('#pstPrecioTopes').val('');
        $('#pstCantidadTopes').val('');
        $('#pstMoldeBase').val('');
        $('#pstImagen')[0].setAttribute("src", "");
        $('#pstAncho').val('');
        $('#pstLargo').val('');
        $('#pstSuperficie').val('');
        $('#pstCantidad').val('');
        $('#pstIdColoresProducto').empty();
        $('#pstIdForma').val('');
        $('#pstIdBase').val('');
        $('#pstIdColorBase').val('');
        $('#pstIdColorPiel').val('');
        $('#pstIdColorMetal').val('');
        $('#pstAnchoBase').val('');
        $('#pstLargoBase').val('');
        $('#pstPelo').val('');
        $('#pstPxuProducto').val('');
        $('#pstPxuBase').val('');
        $('#pstMoldeProducto').val('');

        $("#colorDiseno input:checkbox:checked").prop('checked', false);
        $("#colorBase input:checkbox:checked").prop('checked', false);
        $("#colorMetal input:checkbox:checked").prop('checked', false);
        $("#colorPiel input:checkbox:checked").prop('checked', false);

        $('#num1').css('box-shadow', '');
        $('#num2').css('box-shadow', '');
        $('#cant1').css('box-shadow', '');
        $('#cant2').css('box-shadow', '');
        $('#cantidad').css('box-shadow', '');
        $('#cantidadTopes').css('box-shadow', '');
        $('#errorForma').text("");
        $('#divMedidas').show();

        $("input[name='formas_fijas']").prop('checked', false);

        //console.log($("input[name='formas_fijas']"));

        if (tecnica.val() == '') {//Si selecciona el primer valor (que no es una tecnica, sino la propia instruccion "selecciona una tecnica") se recargará la página
            location.reload();
        } else {
            seleccionTecnica();
        }

        calcularTotal();
    });

    //Vaciar campos de superficie y cantidad cuando escriban los campos descritos-------------------
    $("#num1").keydown(function (event) {//Ancho producto
        $('#superficieTuProducto').text('');
        $('#superficieTuProducto').val('');
        $('#cantidadTuProducto').text('');
        $('#cantidadTuProducto').val('');
        $('#pPxuTuProducto').text('');
        $('#pPxuTuProducto').val('');
        $('#num1').css('box-shadow', '');
        $('#num2').css('box-shadow', '');
        $('#nucantidadTuProductom2').css('box-shadow', '');

        calcularTotal();
    });

    $("#num2").keydown(function (event) {//Largo producto
        $('#superficieTuProducto').text('');
        $('#superficieTuProducto').val('');
        $('#cantidadTuProducto').text('');
        $('#cantidadTuProducto').val('');
        $('#pPxuTuProducto').text('');
        $('#pPxuTuProducto').val('');
        $('#num1').css('box-shadow', '');
        $('#num2').css('box-shadow', '');
        $('#cantidadTuProducto').css('box-shadow', '');

        calcularTotal();
    });

    $("#cant1").keydown(function (event) {//Ancho base
        $('#superficieBaseTuProducto').text('');
        $('#superficieBaseTuProducto').val('');
        $('#cantidadTuProducto').text('');
        $('#cantidadTuProducto').val('');

        $('#pPxuBaseTuProducto').text('');
        $('#pPxuBaseTuProducto').val('');

        $('#cant1').css('box-shadow', '');
        $('#cant2').css('box-shadow', '');

        calcularTotal();
    });

    $("#cant2").keydown(function (event) {//Largo base
        $('#superficieBaseTuProducto').text('');
        $('#superficieBaseTuProducto').val('');
        $('#cantidadTuProducto').text('');
        $('#cantidadTuProducto').val('');

        $('#pPxuBaseTuProducto').text('');
        $('#pPxuBaseTuProducto').val('');

        $('#cant1').css('box-shadow', '');
        $('#cant2').css('box-shadow', '');

        calcularTotal();
    });

    $("#cantidad").keydown(function (event) {//Cantidad
        $('#superficieBaseTuProducto').text('');
        $('#superficieBaseTuProducto').val('');
        $('#superficieTuProducto').text('');
        $('#superficieTuProducto').val('');
        $('#cantidadTuProducto').text('');
        $('#cantidadTuProducto').val('');
        $('#pPxuTuProducto').text('');
        $('#pPxuTuProducto').val('');
        $('#pPxuBaseTuProducto').text('');
        $('#pPxuBaseTuProducto').val('');

        $('#cantidad').css('box-shadow', '');

        calcularTotal();
    });


    //Si quiere tope mostramos el div para añada la cantidad de topes que desee
    sitope.on('click', function () {
        if (sitope.is(':checked')) {
            $('#cantidadTopes').css('box-shadow', '');
            $('#divCantidadTopes').show();
            calcularTotal();
        }
    });

    //Si no quiere topes se oculta el div
    notope.on('click', function () {
        if (notope.is(':checked')) {
            $('#divCantidadTopes').hide();
            $('#rowTopes').hide();
            document.getElementById('pTopesTuProducto').innerHTML = "";
            document.getElementById('pTopesTuProducto').value = 0;
            $('#pstPrecioTopes').val('');
            $('#pstCantidadTopes').val("");
            $('#cantidadTopes').css('box-shadow', '');
            calcularTotal();
        }
    });

    //Calculo de precio por topes de pulsera
    $('#añadirTopes').click(function (e) {
        e.preventDefault();
        $.ajax({//Peticion de ajax
            method: "POST",
            url: "functions.php",
            data: {//47 es el id del condint (los topes de pulsera)
                precio: "", idproducto: 47, superficie: 47, cantidad: "fijo"
            }
        }).done(function (response) {
            // console.log("Response Ajax precios: " + response);
            if (response != "null") {
                //Se hace el cálculo del costo y se asigna el valor
                //Por otra parte con ese calculo, se hace su versión visual (colocando el símbolo del euro, cambiando puntos por comas)
                if (Math.trunc($('#cantidadTopes').val()) > 0) {
                    var calculo = (parseFloat(response) * parseFloat(Math.trunc($('#cantidadTopes').val()))).toFixed(3);
                    var strCalculo = calculo.toString().replace('.', ',');
                    document.getElementById('pTopesTuProducto').innerHTML = strCalculo + " € (" + response.replace('.', ',') + "€/ud)";
                    document.getElementById('pTopesTuProducto').value = calculo;
                    $('#pstPrecioTopes').val(calculo);
                    $('#pstCantidadTopes').val(Math.trunc($('#cantidadTopes').val()));
                    $('#rowTopes').show();
                    $('#cantidadTopes').css('box-shadow', '0 0 10px green');
                    calcularTotal();
                }
            }
        })
    });

    //Quiere base---------------------------------------------------------
    sibase.on('click', function () {
        $('#rowMoldeBase').show();
        $('#rowPxuBase').show();
        var base = $('#productoBase').find('div#' + tecnica.val());

        if (sibase.is(':checked')) {
            $('#rowColoresBase').show();
            if (base.length > 1) {
                //Si puede tener mas de una base se muestra el select para que la escoja
                $('#selectBase').show();
                $('#addPelo').hide();
                $('#divPelo').hide();
            } else {
                //reinicio el select y lo oculto
                $('#selectBase option:eq(0)').prop('selected', true);
                $('#selectBase').hide();

                //mostramos los colores correspondientes de la base correspondiente a la tecnica seleccionada
                $('#lblcolorBase').show();
                $('#colorBase').show();
                $('.bases').hide();
                $('.base_' + tecnica.val()).show();

                //Precio del molde
                // if ($('#noestalog').length == 0) {
                document.getElementById('pMoldeBaseTuProducto').innerText = $("#productoBase").find('#' + tecnica.val()).attr('class').split(' ')[0] + " €";
                document.getElementById('pMoldeBaseTuProducto').value = $("#productoBase").find('#' + tecnica.val()).attr('class').split(' ')[0];
                // }
                $('#pstMoldeBase').val($("#productoBase").find('#' + tecnica.val()).attr('class').split(' ')[0]);

                /**Si es base de tela muestra campos para que escriba la medida de la base
                Si es base de velcro muestra campo pelo
                */
                if (base.text().trim() == '1') {//Tela
                    medidasBase("show");
                    $('#addPelo').hide();
                    $('#divPelo').hide();
                    $('#pstIdBase').val("1");
                    $('#lblcolorBase').text($('#elige-base').text());
                } else {//Velcro
                    medidasBase("hide");
                    $('#addPelo').show();
                    $('#divPelo').show();
                    $('#pstIdBase').val("2");
                    $('#lblcolorBase').text($('#elige-cierre').text());
                }
            }
        } else {//Reinicio valores
            $('#addPelo').hide();
            $('#divPelo').hide();
            $('#lblcolorBase').hide();
            $('#colorBase').hide();
            $('#pstIdBase').val("6");
            $('#pstIdColorBase').val("");

            medidasBase("hide");
        }
        calcularTotal();
    });

    //No quiere base---------------------------------------------------------
    nobase.on('click', function () {//Reinicio valores
        nopelo.prop('checked', true);
        $('#cBaseTuProducto').empty();
        $('#rowColoresBase').hide();
        $('#rowMoldeBase').hide();
        $('#rowPxuBase').hide();
        $('#selectBase').hide();
        $('#selectBase option:eq(0)').prop('selected', true);
        $('#addPelo').hide();
        $('#divPelo').hide();
        $('#lblcolorBase').hide();
        $('#colorBase').hide();
        $('.bases').hide();
        medidasBase("hide");
        $('#pstIdBase').val("6");
        $('#pstIdColorBase').val("");

        $('#pstPelo').val("0");
        $('#rowPxuPelo').hide();
        $('#pMoldePeloTuProducto').val('');
        $('#pMoldePeloTuProducto').text('');

        $('#pMoldeBaseTuProducto').val('');
        $('#pMoldeBaseTuProducto').text('');
        $('#pstMoldeBase').val('');

        $("#colorBase input:checkbox:checked").prop('checked', false);
        $("#colorBase input:checkbox:not(:checked)").prop('disabled', false);

        document.getElementById('pPxuBaseTuProducto').innerText = "";
        document.getElementById('pPxuBaseTuProducto').value = "";

        $('#superficieBaseTuProducto').text('');
        $('#superficieBaseTuProducto').val('');
        $('#cantidadTuProducto').text('');
        $('#cantidadTuProducto').val('');
        $('#cantidad').css('box-shadow', '');

        document.getElementById('pPxuPeloTuProducto').innerText = "";
        document.getElementById('pPxuPeloTuProducto').value = "";

        $('#pPxuBaseTuProducto').text('');
        $('#pPxuBaseTuProducto').val('');

        $('#cant1').css('box-shadow', '');
        $('#cant2').css('box-shadow', '');
        $('#cant1').val('');
        $('#cant2').val('');

        calcularTotal();
    });

    //Quiere pelo---------------------------------------------------------
    sipelo.on('click', function () {
        if (sipelo.is(':checked')) {
            $('#pstPelo').val("1");
            $('#rowPxuPelo').show();
            $('#lblcolorBase').text($('#elige-cierre-pelo').text());
            $('#cantidadTuProducto').text('');
            $('#cantidadTuProducto').val('');
            $('#cantidad').css('box-shadow', '');
            // document.getElementById('pMoldePeloTuProducto').innerText = $("#productoBase").find('#' + tecnica.val()).attr('class').split(' ')[1];
            // document.getElementById('pMoldePeloTuProducto').value = $("#productoBase").find('#' + tecnica.val()).attr('class').split(' ')[1];
            calcularTotal();
        }
    });

    //No quiere pelo---------------------------------------------------------
    nopelo.on('click', function () {//Reinicio valores
        $('#lblcolorBase').text($('#elige-cierre').text());
        // $('#cBaseTuProducto').empty();
        $('#pstPelo').val("0");
        $('#rowPxuPelo').hide();
        $('#pMoldePeloTuProducto').val('');
        $('#pMoldePeloTuProducto').text('');

        document.getElementById('pPxuPeloTuProducto').innerText = "";
        document.getElementById('pPxuPeloTuProducto').value = "";

        $('#cantidadTuProducto').text('');
        $('#cantidadTuProducto').val('');
        $('#cantidad').css('box-shadow', '');

        calcularTotal();
    });

    //Base (cuando admite ambas)---------------------------------------
    selectBase.on('change', function () {
        //Segun la base escogida seguira mismo procedimiento
        $("#colorBase input:checkbox:checked").prop('checked', false);//Checkbox a falso
        $("#colorBase input:checkbox:not(:checked)").prop('disabled', false);
        $('#cBaseTuProducto').empty();
        if (selectBase.val() == '1') {
            document.getElementById('pMoldeBaseTuProducto').innerText = $("#productoBase").find('#' + tecnica.val()).attr('class').split(' ')[0] + " €";
            document.getElementById('pMoldeBaseTuProducto').value = $("#productoBase").find('#' + tecnica.val()).attr('class').split(' ')[0];
            $('#rowMoldeBase').show();
            $('#rowPxuBase').show();
            $('#rowColoresBase').show();
            $('#lblcolorBase').text($('#elige-base').text());
            $('#lblcolorBase').show();
            $('#colorBase').show();
            $('.bases').hide();
            $('.base_' + tecnica.val()).show();
            $('.idbase_' + 2).hide();
            $('#pstIdBase').val("1");

            document.getElementById('pPxuBaseTuProducto').innerText = "";
            document.getElementById('pPxuBaseTuProducto').value = "";

            $('#rowSupBase').show();
            medidasBase("show");
            $('#addPelo').hide();
            $('#divPelo').hide();
            $('#pstPelo').val("0");
            $('#rowPxuPelo').hide();
            $('#pMoldePeloTuProducto').val('');
            $('#pMoldePeloTuProducto').text('');
            nopelo.prop('checked', true);
        } else if (selectBase.val() == '2') {
            document.getElementById('pMoldeBaseTuProducto').innerText = $("#productoBase").find('#' + tecnica.val()).attr('class').split(' ')[0] + " €";
            document.getElementById('pMoldeBaseTuProducto').value = $("#productoBase").find('#' + tecnica.val()).attr('class').split(' ')[0];
            $('#rowMoldeBase').show();
            $('#rowPxuBase').show();
            var base = $('#productoBase').find('div#' + tecnica.val());
            $('#rowColoresBase').show();
            $('#lblcolorBase').text($('#elige-cierre').text());
            $('#lblcolorBase').show();
            $('#colorBase').show();
            $('.bases').hide();
            $('.base_' + tecnica.val()).show();
            $('.idbase_' + 1).hide();
            $('#pstIdBase').val("2");
            $('#addPelo').show();
            $('#divPelo').show();
            $('#rowSupBase').hide();
            $('#pstPelo').val("0");
            $('#rowPxuPelo').hide();
            $('#pMoldePeloTuProducto').val('');
            $('#pMoldePeloTuProducto').text('');
            nopelo.prop('checked', true);

            document.getElementById('pPxuBaseTuProducto').innerText = "";
            document.getElementById('pPxuBaseTuProducto').value = "";

            $('#superficieBaseTuProducto').text('');
            $('#superficieBaseTuProducto').val('');
            $('#cantidadTuProducto').text('');
            $('#cantidadTuProducto').val('');
            $('#cantidad').css('box-shadow', '');

            document.getElementById('pPxuPeloTuProducto').innerText = "";
            document.getElementById('pPxuPeloTuProducto').value = "";

            $('#cant1').css('box-shadow', '');
            $('#cant2').css('box-shadow', '');
            $('#cant1').val('');
            $('#cant2').val('');

            medidasBase("hide");
        } else {
            $('#rowSupBase').hide();
            nopelo.prop('checked', true);
            $('#cBaseTuProducto').empty();
            $('#rowColoresBase').hide();
            $('#rowMoldeBase').hide();
            $('#rowPxuBase').hide();
            $('#addPelo').hide();
            $('#divPelo').hide();
            $('#lblcolorBase').hide();
            $('#colorBase').hide();
            $('.bases').hide();
            medidasBase("hide");
            $('#pstIdBase').val("6");
            $('#pstIdColorBase').val("");

            $('#pstPelo').val("0");
            $('#rowPxuPelo').hide();
            $('#pMoldePeloTuProducto').val('');
            $('#pMoldePeloTuProducto').text('');

            $('#pMoldeBaseTuProducto').val('');
            $('#pMoldeBaseTuProducto').text('');
            $('#pstMoldeBase').val('');

            $("#colorBase input:checkbox:checked").prop('checked', false);
            $("#colorBase input:checkbox:not(:checked)").prop('disabled', false);

            document.getElementById('pPxuBaseTuProducto').innerText = "";
            document.getElementById('pPxuBaseTuProducto').value = "";

            $('#superficieBaseTuProducto').text('');
            $('#superficieBaseTuProducto').val('');
            $('#cantidadTuProducto').text('');
            $('#cantidadTuProducto').val('');
            $('#cantidad').css('box-shadow', '');

            document.getElementById('pPxuPeloTuProducto').innerText = "";
            document.getElementById('pPxuPeloTuProducto').value = "";

            $('#pPxuBaseTuProducto').text('');
            $('#pPxuBaseTuProducto').val('');

            $('#cant1').css('box-shadow', '');
            $('#cant2').css('box-shadow', '');
            $('#cant1').val('');
            $('#cant2').val('');
            medidasBase("hide");
        }
        calcularTotal();
    });

    //Diseño
    $(document).on('click', '.diseno_fijo', function () {
        // $(this).children("input:radio[name=formas_fijas]");
        $('#pPxuTuProducto').text("");
        $('#pPxuTuProducto').val("");
        $('#cantidadTuProducto').text("");

        $('#pPxuBaseTuProducto').text("");
        $('#pPxuBaseTuProducto').val("");

        //Arma el texto de la forma seleccionada (en el caso que corresponda) y asigna valores
        var texto = $(this).children("input:radio[name=formas_fijas]:checked").attr('class').split(' ')[1];
        texto += ($(this).children("input:radio[name=formas_fijas]:checked").attr('class').split(' ')[2] == undefined) ? "" : " " + $(this).children("input:radio[name=formas_fijas]:checked").attr('class').split(' ')[2];
        texto += ($(this).children("input:radio[name=formas_fijas]:checked").attr('class').split(' ')[3] == undefined) ? "" : " " + $(this).children("input:radio[name=formas_fijas]:checked").attr('class').split(' ')[3];
        texto += ($(this).children("input:radio[name=formas_fijas]:checked").attr('class').split(' ')[4] == undefined) ? "" : " " + $(this).children("input:radio[name=formas_fijas]:checked").attr('class').split(' ')[4];

        // console.log("t " + texto);

        $('#formaTuProducto').text(texto.trim());
        $('#pstIdForma').val($(this).children("input:radio[name=formas_fijas]:checked").attr('class').split(' ')[0]);
        calcularTotal();
    });

    //Validación de imagen
    //Reinicia valores al dar click
    // $('#archivo').on('click', function () {
    //     $(this).val('');
    // });
    // $('#archivomsj').on('click', function () {
    //     $(this).val('');
    //     $('#pdfSubido').text('');

    // });

    //Verifica el archivo subido
    $(document).on('change', 'input[type="file"]', function () {
        // this.files[0].size recupera el tamaño del archivo
        // alert(this.files[0].size);
        var error = false;
        var fileName = this.files[0].name;
        var fileSize = this.files[0].size;
        var ext = fileName.split('.').pop();
        // console.log(1e+8);

        /* filesize es dado en Byte
            Tamaño máximo del archivo 100Megabyte = 1e+8 Byte
        */
        if (fileSize > 1e+8) {//Tamaño del archivo
            alert($('#err_p1').text());
            this.value = '';
            this.files[0].name = '';
            error = true;
        } else {
            // recuperamos la extensión del archivo


            // Convertimos en minúscula porque 
            // la extensión del archivo puede estar en mayúscula
            ext = ext.toLowerCase();

            // console.log("extension del archivo: " + ext);
            //var archtxt = $('select[name="tecnica"] :selected').attr('class').split(' ')[3];
            switch (ext) {//Extensiones permitidas
                case 'ai':
                case 'pdf':
                case 'eps':
                case 'svg':
                case 'psd':
                case 'jpg':
                case 'png':
                case 'tif':
                case 'bmp': break;
                default:
                    alert($('#err_p2').text());
                    this.value = ''; // reset del valor
                    this.files[0].name = '';
                    error = true;
            }
        }


        if (error == false) {
            var reader = new FileReader(); //Leemos el contenido

            reader.onload = function (e) {//Asigno valores
                //Al cargar el contenido lo pasamos como atributo de la imagen de arriba
                $('#imagenPrevisualizacion').attr('src', e.target.result);
                $('#imagenTuProducto').attr('src', e.target.result);
                $('#pstImagen').attr('src', e.target.result);
                $('#subirImagen').modal('hide');

                ///////////////////////////////////////////////////
                $('#imagenPrevMsj').attr('src', e.target.result);
                if ($('#imagenPrevMsj').attr('src') != "") {
                    $('#divSelectPer').show();
                    $('#divImagenPrev').show();
                } else {
                    $('#divSelectPer').hide();
                    $('#divImagenPrev').hide();
                }

                switch (ext) {//Extensiones permitidas
                    case 'ai':
                    case 'pdf':
                    case 'eps':
                    case 'svg':
                    case 'psd':
                    case 'tif':
                    case 'bmp':
                        $('#imagenPrevisualizacion').attr('src', 'iconos/extensiones/' + ext + '.png');
                        $('#imagenTuProducto').attr('src', 'iconos/extensiones/' + ext + '.png');
                        break;
                    default:
                        break;
                }
            }
            reader.readAsDataURL(this.files[0]);
        }

    });

    //Propiedad Intelectual
    // $('#aceptaPI').on('click', function () {
    //     if ($('#aceptaPI').is(':checked')) {//Si acepta mostramos el boton para que pueda subir el archivo
    //         // $('#archivo').prop("disabled", false);
    //         $('#imagenPrevisualizacion').show();
    //         $('#imagenTuProducto').show();
    //         $('#rowBotonImagen').show();
    //     } else {//Reinicio valores
    //         // $('#archivo').prop("disabled", true);
    //         $('#imagenPrevisualizacion').hide();
    //         $('#imagenTuProducto').hide();
    //         $('#imagenTuProducto')[0].setAttribute("src", "");
    //         $('#imagenPrevisualizacion')[0].setAttribute("src", "");
    //         $('#rowBotonImagen').hide();
    //     }
    // });

    //Deshabilitar al llegar a la cantidad máxima de colores a elegir
    var cantidad = 0;
    $('input[type=checkbox]').on('change', function () {
        //Cuando detecta cambio en input de tipo checkbox
        if ($(this).is('#checkColoresDiseno')) {
            //Si el checkbox que ha cambiado es parte del grupo de checkbox de colores del diseño
            var max_colores = $('select[name="tecnica"] :selected').attr('class').split(' ')[0];//cantidad maxima de colores que puede elegir segun la tecnica seleccionada
            if ($(this).is(':checked')) {//Si esta seleccionado el checkbox
                cantidad++;//Sumamos cantidad

                var divColor = $(this).parent().parent().clone();//Clonamos el elemento
                divColor.children().find("input").remove();//Eliminamos el input checkbox 
                $('#coloresTuProducto').append(divColor);//Agregamos el elemento clonado a la zona de presupuesto
                arrColores($(this), "agregar");//Agregamos el color al array de colores
            } else {
                cantidad--;//Restamos cantidad
                $('#coloresTuProducto').find('div#' + $(this).parent().parent().attr('id')).remove();//Buscamos el elemento del color y lo quitamos (de la zona de presupuesto)
                arrColores($(this), "remover");//Quitamos el color del array de colores
            }

            if (max_colores != 0 && tecnica.val() != 32) {//Si el usuario debe escoger colores se inicia el contador de colores seleccionados
                //Cuanto max_colores es 0 quiere decir que es una tecnica de CMYK o que por alguna razon no es necesaria la eleccion de colores en esta parte
                //El producto 32 es combifix, una tecnica que es por CMYK y a su vez por eleccion de colores
                contadorColores.innerText = cantidad + ' / ' + max_colores;
            }

            //Si llega a la cantidad máxima de colores se deshabilitan los demas checkbox
            if (cantidad == max_colores && max_colores != 0) {
                $("#colorDiseno input:checkbox:not(:checked)").prop('disabled', true);
            } else {
                $("#colorDiseno input:checkbox:not(:checked)").prop('disabled', false);
            }
            //console.log($('#coloresTuProducto > div').size());
        }

        if ($(this).is('#checkColoresMetal')) {//Metal
            //Si el checkbox que ha cambiado es parte del grupo de checkbox de colores del modulo de metal
            if ($(this).is(':checked')) {
                //Se clona el elemento y se inserta en la zona de presupuesto.
                //Como solo se escoje un color se deshabilitan los demas checkbox
                var divColor = $(this).parent().parent().clone();
                divColor.children().find("input").remove();
                $('#cMetalTuProducto').append(divColor);

                $("#colorMetal input:checkbox:not(:checked)").prop('disabled', true);
                $('#pstIdColorMetal').val($(this).parent().parent().attr('id'));
                //console.log($('#cMetalTuProducto > div').size());
            } else {//Quito el color
                $('#cMetalTuProducto').find('div#' + $(this).parent().parent().attr('id')).remove();
                $("#colorMetal input:checkbox:not(:checked)").prop('disabled', false);
                $('#pstIdColorMetal').val("");
            }
        }

        if ($(this).is('#checkColoresPiel')) {//Piel
            //Si el checkbox que ha cambiado es parte del grupo de checkbox de colores del modulo de piel
            if ($(this).is(':checked')) {
                //Se clona el elemento y se inserta en la zona de presupuesto.
                //Como solo se escoje un color se deshabilitan los demas checkbox
                var divColor = $(this).parent().parent().clone();
                divColor.children().find("input").remove();
                $('#cPielTuProducto').append(divColor);

                $("#colorPiel input:checkbox:not(:checked)").prop('disabled', true);
                $('#pstIdColorPiel').val($(this).parent().parent().attr('id'));
            } else {//Quito el color
                $('#cPielTuProducto').find('div#' + $(this).parent().parent().attr('id')).remove();
                $("#colorPiel input:checkbox:not(:checked)").prop('disabled', false);
                $('#pstIdColorPiel').val("");
            }
        }

        if ($(this).is('#checkColoresBase')) {//Base
            //Si el checkbox que ha cambiado es parte del grupo de checkbox de colores de la base
            if ($(this).is(':checked')) {
                //Se clona el elemento y se inserta en la zona de presupuesto.
                //Como solo se escoje un color se deshabilitan los demas checkbox
                var divColor = $(this).parent().parent().clone();
                divColor.children().find("input").remove();
                $('#cBaseTuProducto').append(divColor);

                $("#colorBase input:checkbox:not(:checked)").prop('disabled', true);
                $('#pstIdColorBase').val($(this).parent().parent().attr('id'));
            } else {//Quito el color
                $('#cBaseTuProducto').find('div#' + $(this).parent().parent().attr('id')).remove();
                $("#colorBase input:checkbox:not(:checked)").prop('disabled', false);
                $('#pstIdColorBase').val("");
            }
        }

        if ($(this).is('#quitarMolde')) {//Checkboxes de los diseños a pagar
            if ($(this).is(':checked')) {
                
                $('#pstMoldeProducto').val("0");
                $('#pstMoldeBase').val("0");

                $('#pMoldeTuProducto').val("0");
                $('#pMoldeBaseTuProducto').val("0");

                $('#pMoldeTuProducto').text("0 €");
                $('#pMoldeBaseTuProducto').text("0 €");

                calcularTotal();
            } else {
                $('#pstMoldeProducto').val($('select[name="tecnica"] :selected').attr('class').split(' ')[1]);
                $('#pstMoldeBase').val($("#productoBase").find('#' + tecnica.val()).attr('class').split(' ')[0]);

                document.getElementById('pMoldeTuProducto').innerText = $('select[name="tecnica"] :selected').attr('class').split(' ')[1] + " €";
                document.getElementById('pMoldeTuProducto').value = $('select[name="tecnica"] :selected').attr('class').split(' ')[1];
            
                document.getElementById('pMoldeBaseTuProducto').innerText = $("#productoBase").find('#' + tecnica.val()).attr('class').split(' ')[0] + " €";
                document.getElementById('pMoldeBaseTuProducto').value = $("#productoBase").find('#' + tecnica.val()).attr('class').split(' ')[0];

                calcularTotal();
            }
        }


    });


    $('#anadirCarrito').click(function () {
        anadirCarrito();
    });

    $('#anadirCarritoMV').click(function () {
        anadirCarrito();
    });

    //Funcion añadir carrito---------------------------------
    /**
     * Cuando llega al paso 4 (ultimo paso) aparece el boton para que pueda añadir la personalización a un pedido.
     * Procede a validar los datos.
     */
    function anadirCarrito() {
        //Verifica si están todos los datos necesarios:
        //La técnica, la superficie, cantidad, colores(si no es CMYK) y la imagen
        //NOTA: los mensajes de error se encuentran en errores.php
        var error = $('#err_p3').text() + " </br>";
        var bool = false;//Verdadero cuando haya error

        //Si es pulsera textil verificamos cantidad de topes (si los quiere)
        if (sitope.is(':checked')) {
            if ($('#pTopesTuProducto').text() == '') {
                error += $('#err_p8').text() + "</br>";
                bool = true;
            }
        }

        //Si quiere base tiene que escoger el color de la base
        if (sibase.is(':checked')) {
            if ($('#cBaseTuProducto > div').size() == 0) {
                error += $('#err_p10').text() + "</br>";
                bool = true;
            }
        }

        if ($('#tecnicaTuProducto').text() == '') {
            error += $('#err_p3-2').text() + " </br>";
            bool = true;
        } else if ($('#tecnicaTuProducto').text() != '') {
            if ($('#tecnica').val() == '39') { //Labeltex = hay que elegir forma y superficie
                if ($('#superficieTuProducto').text() == '') {
                    error += $('#err_p4').text() + "</br>";
                    bool = true;
                }
                if ($('#formaTuProducto').text() == '') {
                    error += $('#err_p4M').text() + "</br>";
                    bool = true;
                }
            } else {
                if ($('#idF_' + $('select[name="tecnica"] :selected').val()).attr('class').split(' ')[0] == 'fijo_0') {//Si no es forma fija
                    if ($('#superficieTuProducto').text() == '') {
                        error += $('#err_p4').text() + "</br>";
                        bool = true;
                    }
                } else {//formas fijas
                    if ($('#formaTuProducto').text() == '') {
                        error += $('#err_p4M').text() + "</br>";
                        bool = true;
                    }
                }
            }
        }

        if (sibase.is(':checked')) {
            if ($('#productoBase').find('div#' + $('select[name="tecnica"] :selected').val()).text().trim() == 1) {//Si es tela la superficie
                if ($('#superficieBaseTuProducto').text() == '') {
                    error += $('#err_p9').text() + "</br>";
                    bool = true;
                }
            }
        }

        if ($('select[name="tecnica"] :selected').val() == '31') {//Si es digitrans
            if ($('select[name="selectBase"] :selected').val() == 1) {
                if ($('#cBaseTuProducto > div').size() == 0) {
                    error += $('#err_p10').text() + "</br>";
                    bool = true;
                }
                if ($('#superficieBaseTuProducto').text() == '') {
                    error += $('#err_p9').text() + "</br>";
                    bool = true;
                }
            } else if ($('select[name="selectBase"] :selected').val() == 2) {
                if ($('#cBaseTuProducto > div').size() == 0) {
                    error += $('#err_p10').text() + "</br>";
                    bool = true;
                }
            }
        }

        if ($('#cantidadTuProducto').text() == '') {
            error += $('#err_p5').text() + "</br>";
            bool = true;
        }

        if ($('select[name="tecnica"] :selected').attr('class').split(' ')[0] != 0 && $('#tecnica').val() != '40' && $('#tecnica').val() != '42') {
            if ($('#coloresTuProducto > div').size() == 0) {
                error += $('#err_p6').text() + "</br>";
                bool = true;
            }
        }
        if ($('#productoModulo').find('div#' + tecnica.val()).length > 1) {//Si puede tener mas de un modulo (solo existen dos modulos)
            if ($('#cMetalTuProducto > div').size() == 0) {
                error += $('#err_p11').text() + "</br>";
                bool = true;
            }
            if ($('#cPielTuProducto > div').size() == 0) {
                error += $('#err_p12').text() + "</br>";
                bool = true;
            }
        } else {
            //Color metal
            if ($('#productoModulo').find('div#' + tecnica.val()).attr('class') == '1') {
                if ($('#cMetalTuProducto > div').size() == 0) {
                    error += $('#err_p11').text() + "</br>";
                    bool = true;
                }
            }

            //color piel
            if ($('#productoModulo').find('div#' + tecnica.val()).attr('class') == '2') {
                if ($('#cPielTuProducto > div').size() == 0) {
                    error += $('#err_p12').text() + "</br>";
                    bool = true;
                }
            }
        }

        if ($('#imagenTuProducto').attr("src") == '') {
            error += $('#err_p7').text() + "</br>";
            bool = true;
        }


        $('#txtModalEP').html("");
        $('#divLinkAddPedido').hide();


        if (bool) { //Si hay error
            $('#divNombres').hide();

            $('#txtModalEP').show();
            $('#txtModalEP').html(error);

            $('#divPTPMal').show();
            $('#divPTPBien').hide();
            $('#icono-modal-agregar').show();
        } else {
            $('#divNombres').show();

            $('#txtModalEP').hide();
            $('#txtModalEP').html("");

            $('#divPTPMal').hide();
            $('#divPTPBien').show();
            $('#icono-modal-agregar').hide();

            var lista = "";
            //lista += "<li class='list-group-item'><a class='btn' href='#' onclick=\"document.forms['formularioPersonalizar'].submit();\">" + $('#li1').text() + "</a></li>";
            $('.numeroPedidos').each(function (i, obj) {
                //Por cada pedido abierto se agrega un elemento li
                if (i == 0) {
                    lista += "<li class=''><a class='text-black' href='#' onclick=\"submitDelForm(" + $(this).attr('id') + ")\">" + $('#li2').text() + $(this).text().trim() + "</a></li>";
                } else {
                    lista += "<li class=''><a class='text-black' href='#' onclick=\"submitDelForm(" + $(this).attr('id') + ")\">" + $('#li2').text() + $(this).text().trim() + "</a></li>";
                }
            });

            $('#ulLinkAddPedido').html(lista);
            $('#divLinkAddPedido').show();
        }
    }

    //nombre personalizacion
    $("#pstNombrePer").keyup(function (event) {
        $.ajax({//Peticion de ajax
            method: "POST",
            url: "functions.php",
            data: {
                nombreDisenoExiste: $("#pstNombrePer").val()
            }
        }).done(function (response) {
            //console.log("Re: " + response);
            if (response.trim() == "1") { //true = nombre ya existe, saco error
                $('#resultadoNombreDiseno').show();
                $('#btnPedidoNuevo').prop("disabled", true);
                $('#divLinkAddPedido').hide();
            } else {
                $('#resultadoNombreDiseno').hide();
                $('#btnPedidoNuevo').prop("disabled", false);
                $('#divLinkAddPedido').show();
            }
        });
    });

    //nombre pedido (modal muestrario)
    $("#pstNombrePed2").keyup(function (event) {
        $.ajax({//Peticion de ajax
            method: "POST",
            url: "functions.php",
            data: {
                nombrePedidoExiste: $("#pstNombrePed2").val()
            }
        }).done(function (response) {
            //console.log("Re: " + response);
            if (response.trim() == "1") { //true = nombre ya existe, saco error
                $('#nombre_repetido2').show();
                $('#btnPedidoNuevoM').prop("disabled", true);
            } else {
                $('#nombre_repetido2').hide();
                $('#btnPedidoNuevoM').prop("disabled", false);
            }
        });
    });

    //nombre pedido (modal muestra)    
    $("#pstNombrePed3").keyup(function (event) {
        $.ajax({//Peticion de ajax
            method: "POST",
            url: "functions.php",
            data: {
                nombrePedidoExiste: $("#pstNombrePed3").val()
            }
        }).done(function (response) {
            //console.log("Re: " + response);
            if (response.trim() == "1") { //true = nombre ya existe, saco error
                $('#nombre_repetido3').show();
                $('#btnPedidoNuevoMI').prop("disabled", true);
            } else {
                $('#nombre_repetido3').hide();
                $('#btnPedidoNuevoMI').prop("disabled", false);
            }
        });
    });

    //Mensaje diseño fijo---------------------------------------------
    function mensajeDisenoFijo(idProducto) {
        // console.log("msj " +  idProducto);
        switch (idProducto) {
            case '35'://Crematex
                $('#mensajeDisenoFijo').text($('#txtDF1').text());
                break;
            case '36'://Cremajet
                $('#mensajeDisenoFijo').text($('#txtDF2').text());
                $('#mensajeDisenoFijo2').text($('#txtDF4-2').text());
                break;
            case '37'://Cremaglass
                $('#mensajeDisenoFijo').text($('#txtDF3').text());
                break;
            case '41'://Papertick
                $('#mensajeDisenoFijo').text($('#txtDF4').text());
                $('#mensajeDisenoFijo2').text($('#txtDF4-2').text());
                break;
            case '50'://Chapas
                $('#mensajeDisenoFijo').text($('#txtDF4').text());
                $('#mensajeDisenoFijo2').text($('#txtDF4-2').text());
                break;
            case '39'://Labeltex
                $('#mensajeDisenoFijo').text($('#txtDF5').text());
                $('#mensajeDisenoFijo2').text($('#txtDF4-2').text());
                break;
        }
    }

    //Medidas de la tela---------------------------------------------
    /**
     * Para ocultar o mostrar los elementos correspondientes de bases
     */
    function medidasBase(que) {
        if (que == 'show') {
            $('#divMedidasTela').show();
            $('#rowPrecioBase').show();
            $('#rowSuperficieBase').show();
        } else {
            $('#divMedidasTela').hide();
            $('#rowPrecioBase').hide();
            $('#rowSuperficieBase').hide();
        }
    }


    //-----------------------------
    $("#tecnica").prop("selectedIndex", 0);
    /**
     * Si viene de pagina de algun sistema especifico (seleccionamos el producto que corresponde)
     * Se muestra, oculta y calcula todo lo de la tecnica
     */
    if ($('#prd').text() != '' && $('#prd').text().length < 50 && $('#prd').text() != "personaliza-tu-producto") {
        //console.log($('#prd').text());
        $("#tecnica").val($('#prd').text());
        $("#divTecnicaTuProducto").show();
        document.getElementById('tecnicaTuProducto').innerText = $('#tecnica option:selected').text().trim();
        $('#pstIdProducto').val($('#tecnica option:selected').val());
        seleccionTecnica();
    }
    //-------------

    /**
     * Pasos que se iran mostrando u ocultando al momento de cambiar de tecnica
     */
    function seleccionTecnica() {
        $('#informacionDeLaTecnica').show();//Icono de informacion

        //Asigna valores de la tecnica
        tecnicaTuProducto.innerText = $('#tecnica option:selected').text().trim();
        $('#pstIdProducto').val($('#tecnica option:selected').val());

        // if ($('#noestalog').length == 0) {
        document.getElementById('pMoldeTuProducto').innerText = $('select[name="tecnica"] :selected').attr('class').split(' ')[1] + " €";
        document.getElementById('pMoldeTuProducto').value = $('select[name="tecnica"] :selected').attr('class').split(' ')[1];
        // }
        $('#pstMoldeProducto').val($('select[name="tecnica"] :selected').attr('class').split(' ')[1]);

        limpiarCheckColores();

        var max_colores = $('select[name="tecnica"] :selected').attr('class').split(' ')[0];

        switch (max_colores) {
            case '0'://CMYK
                //Oculta lo relacionado a seleccion de colores y muestra el texto de CMYK
                contadorColores.innerText = $('#txtColor1').text();
                tituloColores.innerText = "";
                txtColores.innerText = "";
                colorDiseno.show();
                colorMetal.hide();
                colorPiel.hide();
                $('#rowColores').hide();
                $('#texto_columna').removeClass("col-4").addClass("col-12");
                $('#buscador_colores').hide();
                break;

            default:
                if (tecnica.val() == 32) {//Combifix
                    //Primera parte CMYK //Segunda parte colores normales
                    contadorColores.innerHTML = $('#txtColor2').text();
                    tituloColores.innerText = $('#txtColor3').text();
                    txtColores.innerText = "";
                    colorDiseno.show();
                    colorMetal.hide();
                    colorPiel.hide();
                    $('#rowColores').show();
                    $('#texto_columna').removeClass("col-4").addClass("col-12");
                    $('#buscador_colores').hide();
                    break;
                } else if (tecnica.val() == '40' || tecnica.val() == '42') {//Labelsilk y labelprint
                    //Oculta lo relacionado a seleccion de colores
                    //No requiere eleccion, son en negros en base blanca.
                    contadorColores.innerHTML = $('#txtColor4').text();
                    tituloColores.innerText = "";
                    txtColores.innerText = "";
                    colorDiseno.show();
                    colorMetal.hide();
                    colorPiel.hide();
                    $('#rowColores').hide();
                    $('#texto_columna').removeClass("col-4").addClass("col-12");
                    $('#buscador_colores').hide();
                    break;
                } else {
                    //Eleccion de colores
                    tituloColores.innerText = $('#txtColor5').text();
                    contadorColores.innerText = "0 / " + $('select[name="tecnica"] :selected').attr('class').split(' ')[0]
                    txtColores.innerText = $('#ptp_paso_3_p').text();
                    colorDiseno.show();
                    $('#rowColores').show();
                    $('#texto_columna').removeClass("col-12").addClass("col-4");
                    $('#buscador_colores').show();

                    //Tecnicas que aparte de elegir colores para el sistema se debe escoger
                    //colores para modulos (de piel y/o metal)
                    if (tecnica.val() == '8' || tecnica.val() == '21' || tecnica.val() == '7') {//plasticmetal, metaltex patillas, metaltex base piel
                        colorMetal.show();
                        if (tecnica.val() == '8') {//metaltex base piel
                            colorPiel.show();
                        } else {
                            colorPiel.hide();
                        }
                    } else {
                        colorPiel.hide();
                        colorMetal.hide();
                    }
                    break;
                }
        }

        //Añadir base------------------
        verificarBase();
        $('#addPelo').hide();
        $('#divPelo').hide();
        if (base) {// Si el sistema puede tener base
            //Mostramos/ocultamos lo correspondiente a cada base 
            $('#addBase').show();
            $('#divBase').show();
            $('#lblcolorBase').hide();
            $('#colorBase').hide();
            $('#selectBase option:eq(0)').prop('selected', true);
            $('#selectBase').hide();
            $('#elegirBase').hide();

            var bases = $('#productoBase').find('div#' + tecnica.val());
            var cambioClaseSi = document.getElementById("lblSi");
            var cambioClaseNo = document.getElementById("lblNo");

            if (bases.text().trim() == '1') {//Tela
                $('#divBases').show();
                $('#pBaseTela').show();
                $('#pBaseValcro').hide();
                $('#pBase').hide();

                //Si = drinkcard-cc congancho || drinkcard-cc visa
                //No = drinkcard-cc singancho || drinkcard-cc mastercard
                cambioClaseSi.className = "drinkcard-cc visa"
                cambioClaseNo.className = "drinkcard-cc mastercard"
            } else if (bases.text().trim() == '2') {//Velcro
                $('#divBases').show();
                $('#pBaseVelcro').show();
                $('#pBaseTela').hide();
                $('#pBase').hide();

                cambioClaseSi.className = "drinkcard-cc congancho"
                cambioClaseNo.className = "drinkcard-cc singancho"
            } else {
                $('#divBases').hide();
                $('#selectBase').show();
                $('#elegirBase').show();

                $('#pBase').show();
                $('#pBaseVelcro').hide();
                $('#pBaseTela').hide();
            }

        } else {//Reinicio valores
            $('#addBase').hide();
            $('#divBase').hide();
            $('#selectBase').hide();
            $('#selectBase option:eq(0)').prop('selected', true);
            $('#lblcolorBase').hide();
            $('#colorBase').hide();
        }

        //En el caso de pulseras textiles si desea añadir el tope (condint)
        if ($('select[name="tecnica"] :selected').attr('class').split(' ')[7] == 1) {
            $('#topePulsera').show();
        } else {//Reinicio valores
            $('#topePulsera').hide();
            $('#divCantidadTopes').hide();
            document.getElementById('pTopesTuProducto').innerHTML = "";
            document.getElementById('pTopesTuProducto').value = 0;
            $('#pstPrecioTopes').val('');
            $('#pstCantidadTopes').val('');
        }

        //Show/hide por id del producto-----------------------------------------------------------------------------------------------------------------------------------------
        //Texto imagenes-----------------------
        $('.textoArchivo').hide();
        $('#id_' + $('select[name="tecnica"] :selected').attr('class').split(' ')[3]).show();

        //Imagen ejemplo--------------------------
        $('.imagenes').hide();
        $('.imagen_' + tecnica.val()).show();

        //Imagen forma--------------------------
        $('.imagenesforma').hide();
        $('.imagenforma_' + tecnica.val()).show();

        //Descripciones LARGAS--------------------------
        $('.descripciones_largas').hide();
        $('.descripcionlarga_' + tecnica.val()).show();

        //Descripciones CORTAS--------------------------
        $('.descripciones_cortas').hide();
        $('.descripcioncorta_' + tecnica.val()).show();

        //Descripcion informacion--------------------------
        $('.descripciones_info').hide();
        $('.descripcioninfo_' + tecnica.val()).show();

        //Descripcion envios--------------------------
        $('.descripciones_envios').hide();
        $('.descripcionenvios_' + tecnica.val()).show();

        //Descripcion consejos de lavado--------------------------
        $('.descripciones_consejos').hide();
        $('.descripcionconsejos_' + tecnica.val()).show();

        //Info producto--------------------------
        $('.infos').hide();
        $('.info_' + tecnica.val()).show();

        //Plazos de entrega--------------------------
        $('.entregas').hide();
        $('.entrega_' + tecnica.val()).show();

        //Consejos de lavado--------------------------
        $('.lavados').hide();
        $('.lavado_' + tecnica.val()).show();

        // Ocultamos todos los contenedores de colores
        $('.colores').hide();
        $('.color_' + tecnica.val()).show();

        //Formas--------------------------
        $('.radios').hide();
        if (tecnica.val() != '37' && tecnica.val() != '35') {//cremaglass y crematex
            $('.rdbtn_' + tecnica.val()).show();
        }
        //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        //saber si es forma fija o no------------------
        forma = $('#idF_' + $('select[name="tecnica"] :selected').val());
        var fijo = forma.attr('class').split(' ')[0];
        if (tecnica.val() == '39') {//Si es labeltex (selecciona forma y superficie->cumple fijo y no fijo)
            $('#disenoNoFijo').show();
            $('#disenoFijo').show();
            $('#mensajeDisenoFijo').show();
            $('#rowForma').show();
            $('#rowSuperficie').show();
            mensajeDisenoFijo($('select[name="tecnica"] :selected').val());
        } else if (fijo == "fijo_0") {//No es fijo. 
            $('#disenoNoFijo').show();
            $('#disenoFijo').hide();
            $('#mensajeDisenoFijo').hide();
            $('#rowForma').hide();
            $('#rowSuperficie').show();
        } else {//Es fijo
            $('#disenoNoFijo').hide();
            mensajeDisenoFijo($('select[name="tecnica"] :selected').val());
            if (tecnica.val() == '38') {//pulseras
                $('#mensajeDisenoFijo').hide();
                $('#disenoFijo').hide();
            } else {
                $('#mensajeDisenoFijo').show();
                $('#disenoFijo').show();
            }
            $('#rowForma').show();
            $('#rowSuperficie').hide();
        }


        //Seleccion del ancho por medidas fijas 
        if (tecnica.val() == '40' || tecnica.val() == '42') {//Si es labelsilk o labelprint
            $('#ancho_select').show();
            $('#ancho_superficie').hide();
        } else {
            $('#ancho_select').hide();
            $('#ancho_superficie').show();
        }

        //Casos que tienen forma fija pero no seleccion, solo hay en una forma, por lo que se asigna directamente el valor (id)
        //y no se muestra la seleccion de formas en si
        if (tecnica.val() == '37') {//Cremaglass
            $('#divMedidas').hide();
            $('#formaTuProducto').text("Redonda");
            $('#pstIdForma').val("32");
        } else if (tecnica.val() == '35') {//Crematex
            $('#divMedidas').hide();
            $('#formaTuProducto').text("Rectangular");
            $('#pstIdForma').val("12");
        } else {//Reinicio valores
            $('#pstIdForma').val('');
            $('#formaTuProducto').text('');
        }

        //Si tiene modulo
        var modulo = $('#productoModulo').find('div#' + tecnica.val());

        if (modulo.length > 1) {//Si puede tener mas de un modulo (solo existen dos modulos)
            $('#rowColoresMetal').show();
            $('#rowColoresPiel').show();
            $('#colorMetal').show();
            $('#colorPiel').show();

            $('.metalicos').hide();
            $('.metal_' + tecnica.val()).show();

            $('.pieles').hide();
            $('.piel_' + tecnica.val()).show();
        } else {//Si solo tiene un modulo, metal o piel
            if (modulo.attr('class') == '1') {//1=metal
                $('#rowColoresMetal').show();
                $('#rowColoresPiel').hide();
                $('#colorMetal').show();
                $('.metalicos').hide();
                $('.metal_' + tecnica.val()).show();
            } else if (modulo.attr('class') == '2') {//2=piel
                $('#rowColoresMetal').hide();
                $('#rowColoresPiel').show();
                $('#colorPiel').show();
                $('.pieles').hide();
                $('.piel_' + tecnica.val()).show();
            }
        }

        calcularTotal();
    }


    //Otras funciones--------------------------------------------------------------------
    /**
     * Reiniciar valores de contador de colores y seleccion
     */
    function limpiarCheckColores() {
        $("input:checkbox:not(:checked)").prop('disabled', false);

        cantidad = 0;//Reiniciamos contador
        contadorColores.innerText = cantidad + ' / ' + $('select[name="tecnica"] :selected').attr('class').split(' ')[0];
    }

    /**
     * Botones en cada tecnica que redirigen directamente a ptp y selecciona la tecnica
     */
    $('.btnRedirigir').on('click', function () {
        window.location.replace("./personaliza-tu-producto?prd=" + this.id);
    });

    /**
     * Si tiene o no base
     */
    function verificarBase() {
        var buscaProductoBase = $('#productoBase').find('div#' + tecnica.val());
        if (buscaProductoBase.length != 0) {
            base = true;
        } else {
            base = false;
        }
    }

    var listaColores = [];
    function arrColores(elemento, que) {//Lista de colores que se pasara por post
        if (que == "agregar") {
            listaColores.push(elemento.parent().parent().attr('id'));
        } else {
            //Buscar un elemento del array por su nombre (en este caso el id)
            var i = listaColores.indexOf(elemento.parent().parent().attr('id'));
            if (i !== -1) {//Lo quitamos
                listaColores.splice(i, 1);
            }
        }
        $('#pstIdColoresProducto').val(listaColores);//Asignamos el nuevo array
        // console.log(listaColores);
        // console.log(listaColores.values);
        // console.log($('#pstIdColoresProducto').val());
    }

    $(document).keypress(function (event) {
        if (event.which == '13') {//Enter
            event.preventDefault();
        }
    });

    $('#añadir').click(function (e) {
        e.preventDefault();

        //Reiniciamos valores y recalcular superficie y precio
        $('#superficie').text('');
        $('#superficieBaseTela').text('');
        $('#cantidad').text('');

        calcularSupxCant();
    });


})(jQuery);

//Calcular subtotal---------------------------------------------
function calcularTotal() {
    // if ($('#noestalog').length == 0) {
    //Obtenemos el valor de cada dato a sumar
    suma = 0;
    var dato1 = parseFloat($('#pMoldeTuProducto').val());
    var dato3 = parseFloat($('#pTopesTuProducto').val());
    var dato4 = parseFloat($('#pPxuTuProducto').val());
    var dato5 = parseFloat($('#pMoldeBaseTuProducto').val());
    // var dato6 = parseFloat($('#pMoldePeloTuProducto').val());
    var dato7 = parseFloat($('#pPxuPeloTuProducto').val());
    var dato8 = parseFloat($('#pPxuBaseTuProducto').val());

    suma += $.isNumeric(dato1) ? dato1 : 0; //Verifica que haya datos (si no hay variable numerica no podra sumar y dará error)
    suma += $.isNumeric(dato3) ? dato3 : 0;
    suma += $.isNumeric(dato4) ? dato4 : 0;
    suma += $.isNumeric(dato5) ? dato5 : 0;
    // suma += $.isNumeric(dato6) ? dato6 : 0;
    suma += $.isNumeric(dato7) ? dato7 : 0;
    suma += $.isNumeric(dato8) ? dato8 : 0;

    var strSuma = suma.toFixed(3).toString().replace('.', ',');
    if (cantidad != 0 && cantidad != null && $.isNumeric(dato4)) {
        $('#totalTuProducto').text(strSuma + " € (" + (suma / cantidad).toFixed(3).toString().replace('.', ',') + "€/ud)");
    } else {
        $('#totalTuProducto').text(strSuma + " €");
    }
    $('#strSubtotal').val(suma);
    $('#pstSubtotal').val(suma);

    //console.log(dato1 + " " + " " + dato3 + " " + dato4 + " " + dato5 + " " + dato7 + " " + dato8);
    // }
}

/**
 * Obtenemos minimos y maximos de superficie y cantidad por tecnica (id)
 * @param {*} idtecnica 
 * @returns Array de 4 [cantidadMinima,cantidadMaxima, superficieMinima, superficieMaxima]
 */
function cantidadSuperficieMinMax(idtecnica) {
    switch (idtecnica) {
        case '49':
            return [100, 2999, 1, 1000];

        case '39':
            return [100, 10000, 1, 1000];

        case '42':
            return [100, 10000, 1, 1000];

        case '40':
            return [100, 10000, 1, 1000];

        case '1':
            return [100, 2999, 1, 1000];

        case '2':
            return [100, 2999, 1, 1000];

        case '3':
            return [100, 2999, 1, 1000];

        case '4':
            return [100, 2999, 1, 1000];

        case '5':
            return [100, 2999, 1, 400];

        case '6':
            return [100, 2999, 1, 300];

        case '7':
            return [100, 2999, 1, 300];

        case '23':
            return [100, 2999, 1, 200];

        case '24':
            return [100, 2999, 1, 700];

        case '25':
            return [100, 2999, 1, 600];

        case '8':
            return [100, 2999, 1, 600];

        case '21':
            return [100, 2999, 1, 600];

        case '27':
            return [20, 999, 1, 1000];

        case '28':
            return [20, 999, 1, 1000];

        case '46':
            return [20, 999, 1, 1000];

        case '29':
            return [20, 999, 1, 1000];

        case '30':
            return [20, 999, 1, 600];

        case '22':
            return [1, 5999, 1, 1000];

        case '31':
            return [20, 999, 1, 1000];

        case '32':
            return [20, 999, 1, 1000];

        case '34':
            return [20, 999, 1, 1000];

        case '33':
            return [20, 999, 1, 1000];

        case '38':
            return [100, 10000, 30, 50];

        case '35':
            return [100, 10000, null, null];

        case '36':
            return [100, 10000, null, null];

        case '37':
            return [50, 2999, null, null];

        case '41':
            return [100, 5999, null, null];

        case '50':
            return [100, 5999, null, null];
    }

}

//Calcular superficie
const cantidadTuProducto = document.getElementById("cantidadTuProducto");
const superficieTuProducto = document.getElementById("superficieTuProducto");
var sqlSuperficie = 0;
var anchoSuperficie = 0;
var altoSuperficie = 0;

function calcularSuperficieProducto() {
    //Recogo valores y los divido a 10 para tenerlos en centimetros
    var ancho_min = ($('select[name="tecnica"] :selected').attr('class').split(' ')[8]) / 10;
    var alto_min = ($('select[name="tecnica"] :selected').attr('class').split(' ')[9]) / 10;
    var ancho_max = ($('select[name="tecnica"] :selected').attr('class').split(' ')[10]) / 10;
    var alto_max = ($('select[name="tecnica"] :selected').attr('class').split(' ')[11]) / 10;

    //Almaceno los valores de los inputs
    var numero1 = 0;
    if ($('select[name="tecnica"] :selected').val() == '40' || $('select[name="tecnica"] :selected').val() == '42') {//40=labelsilk 42=labelprint
        numero1 = ($('select[name="ancho_fijo"] :selected').val()) / 10;//Obtengo el ancho seleccionado del select
    } else {//Las demas tecnicas obtengo el ancho del input
        numero1 = ($('#num1').val()) / 10;
    }
    var numero2 = ($('#num2').val()) / 10;

    anchoSuperficie = numero1;
    altoSuperficie = numero2;

    //Verificamos el ancho y alto
    if ((parseFloat(numero1) >= ancho_min && parseFloat(numero1) <= ancho_max) &&
        (parseFloat(numero2) >= alto_min && parseFloat(numero2) <= alto_max)) {//Si el ancho y alto están dentro del minimo-maximo (estos son por MAQUINA)
        var superficie = (parseFloat(numero1) * parseFloat(numero2)).toFixed(3);

        //Muestro el resultado
        let arr = cantidadSuperficieMinMax($('select[name="tecnica"] :selected').val());//[cantidadMinima,cantidadMaxima, superficieMinima, superficieMaxima]
        // console.log(cantidadSuperficieMinMax($('select[name="tecnica"] :selected').val()));
        if (superficie <= arr[3] && superficie >= arr[2]) {//Si estan dentro del min-max (por tabla TARIFA)
            // $('#superficie').text(superficie.replace('.', ','));
            if (numero1 != "" && numero2 != "") {//Si los valores no están en blanco, asigno los valores
                superficieTuProducto.innerHTML = numero1.toString().replace('.', ',') + "cm x " + numero2.toString().replace('.', ',') + "cm = " + superficie.toString().replace('.', ',') + "cm<sup>2</sup>";
                $('#pstAncho').val(numero1);
                $('#pstLargo').val(numero2);
                $('#pstSuperficie').val(superficie);
                $('#num1').css('box-shadow', '0 0 5px green');
                $('#num2').css('box-shadow', '0 0 5px green');
            } else {//Reinicio valores
                superficieTuProducto.innerText = "";
                $('#pstAncho').val("");
                $('#pstLargo').val("");
                $('#pstSuperficie').val("");
                $('#superficie').html("");
                $('#superficieTuProducto').text('');
                $('#num1').css('box-shadow', '0 0 5px red');
                $('#num2').css('box-shadow', '0 0 5px red');
            }

            if (superficie > 0 && superficie < 20) {
                sqlSuperficie = 20;
            } else if (superficie >= 20 && superficie < 30) {
                sqlSuperficie = 30;
            } else if (superficie >= 30 && superficie < 40) {
                sqlSuperficie = 40;
            } else if (superficie >= 40 && superficie < 50) {
                sqlSuperficie = 50;
            } else if (superficie >= 50 && superficie < 65) {
                sqlSuperficie = 65;
            } else if (superficie >= 65 && superficie < 80) {
                sqlSuperficie = 80;
            } else if (superficie >= 80 && superficie < 100) {
                sqlSuperficie = 100;
            } else if (superficie >= 100 && superficie < 125) {
                sqlSuperficie = 125;
            } else if (superficie >= 125 && superficie < 150) {
                sqlSuperficie = 150;
            } else if (superficie >= 150 && superficie < 200) {
                sqlSuperficie = 200;
            } else if (superficie >= 200 && superficie < 250) {
                sqlSuperficie = 250;
            } else if (superficie >= 250 && superficie < 300) {
                sqlSuperficie = 300;
            } else if (superficie >= 300 && superficie < 350) {
                sqlSuperficie = 350;
            } else if (superficie >= 350 && superficie < 400) {
                sqlSuperficie = 400;
            } else if (superficie >= 400 && superficie < 500) {
                sqlSuperficie = 500;
            } else if (superficie >= 500 && superficie < 600) {
                sqlSuperficie = 600;
            } else if (superficie >= 600 && superficie < 700) {
                sqlSuperficie = 700;
            } else if (superficie >= 700 && superficie < 800) {
                sqlSuperficie = 800;
            } else if (superficie >= 800 && superficie < 900) {
                sqlSuperficie = 900;
            } else if (superficie >= 900 && superficie < 1000) {
                sqlSuperficie = 1000;
            }
        } else if (superficie > arr[3]) {//Si se pasa del maximo. Muestro error y reinicio valores
            superficie = $('#err_sup1').text() + " " + arr[3] + "cm<sup style='color:inherit'>2</sup>";
            $('#superficie').html(superficie);
            $('#superficieTuProducto').text('');
            $('#pstAncho').val("");
            $('#pstLargo').val("");
            $('#pstSuperficie').val("");
            $('#num1').css('box-shadow', '0 0 10px red');
            $('#num2').css('box-shadow', '0 0 10px red');
        } else if (superficie < arr[2]) {//Si no llega al minimo. Muestro error y reinicio valores
            superficie = $('#err_sup2').text() + " " + arr[2] + "cm<sup style='color:inherit'>2</sup>";
            $('#superficie').html(superficie);
            $('#superficieTuProducto').text('');
            $('#pstAncho').val("");
            $('#pstLargo').val("");
            $('#pstSuperficie').val("");
            $('#num1').css('box-shadow', '0 0 10px red');
            $('#num2').css('box-shadow', '0 0 10px red');
        }
    } else {//Si no esta dentro del min-max (por MAQUINA). Muestro error y reinicio valores
        superficie = $('#err_sup3').text() + " " + (ancho_min * 10) + "mm " + $('#err_sup3-1').text() + " " + (ancho_max * 10) + "mm.<br>" + $('#err_sup3-2').text() + " " + (alto_min * 10) + "mm " + $('#err_sup3-1').text() + " " + (alto_max * 10) + "mm.";
        $('#superficie').html(superficie);
        $('#superficieTuProducto').text('');
        $('#pstAncho').val("");
        $('#pstLargo').val("");
        $('#pstSuperficie').val("");
        $('#num1').css('box-shadow', '0 0 10px red');
        $('#num2').css('box-shadow', '0 0 10px red');
    }

}


var nuevaCantidad = 0;
var cantidad = 0;
/**
 * Calcula la superficia * cantidad
 */
function calcularSupxCant() {
    calcularSuperficieProducto();//calculo de la superficie del producto
    calcularSuperficieBase();//calculo de la superficie de la base 
    cantidad = Math.trunc($("#cantidad").val());
    if (cantidad == 1) {//Asignamos valor a variable que servira para la consulta SQL
        nuevaCantidad = 1;
    } else if (cantidad > 1 && cantidad <= 4) {
        nuevaCantidad = 4;
    } else if (cantidad > 4 && cantidad <= 9) {
        nuevaCantidad = 9;
    } else if (cantidad > 9 && cantidad <= 19) {
        nuevaCantidad = 19;
    } else if (cantidad > 19 && cantidad <= 34) {
        nuevaCantidad = 34;
    } else if (cantidad > 34 && cantidad <= 49) {
        nuevaCantidad = 49;
    } else if (cantidad > 49 && cantidad <= 99) {
        nuevaCantidad = 99;
    } else if (cantidad > 99 && cantidad <= 199) {
        nuevaCantidad = 199;
    } else if (cantidad > 199 && cantidad <= 349) {
        nuevaCantidad = 349;
    } else if (cantidad > 349 && cantidad <= 499) {
        nuevaCantidad = 499;
    } else if (cantidad > 499 && cantidad <= 749) {
        nuevaCantidad = 749;
    } else if (cantidad > 749 && cantidad <= 999) {
        nuevaCantidad = 999;
    } else if (cantidad > 999 && cantidad <= 1499) {
        nuevaCantidad = 1499;
    } else if (cantidad > 1499 && cantidad <= 1999) {
        nuevaCantidad = 1999;
    } else if (cantidad > 1999 && cantidad <= 2999) {
        nuevaCantidad = 2999;
    } else if (cantidad > 2999 && cantidad <= 3999) {
        nuevaCantidad = 3999;
    } else if (cantidad > 3999 && cantidad <= 5999) {
        nuevaCantidad = 5999;
    } else if (cantidad > 5999 && cantidad <= 7999) {
        nuevaCantidad = 7999;
    } else if (cantidad > 7999 && cantidad <= 9999) {
        nuevaCantidad = 9999;
    } else if (cantidad > 9999) {
        nuevaCantidad = 10000;
    }

    switch ($('select[name="tecnica"] :selected').val()) {
        case "35"://Crematex
        case "36"://Cremajet
        case "37"://Cremaglass
            sqlSuperficie = $('select[name="tecnica"] :selected').val();//Ya que es superficie fija, pasamos el id de la tecnica para encontrar el precio
            break;
        case "41"://Papertick
            sqlSuperficie = $('#pstIdForma').val();//La tarifa va con la forma elegida, pasamos el id de la forma para encontrar el precio
            break;
        case "50"://Chapas
            sqlSuperficie = $('#pstIdForma').val();//La tarifa va con la forma elegida, pasamos el id de la forma para encontrar el precio
            break;
    }
    let arr = cantidadSuperficieMinMax($('select[name="tecnica"] :selected').val());//[cantidadMinima,cantidadMaxima, superficieMinima, superficieMaxima]
    // console.log($('select[name="tecnica"] :selected').val() + " " + sqlSuperficie + " " + nuevaCantidad);
    if (nuevaCantidad >= arr[0] && nuevaCantidad <= arr[1]) {//Si esta dentro del min-max(por tabla TARIFA)
        // console.log(sqlSuperficie);
        // console.log(nuevaCantidad);
        $.ajax({//Peticion de ajax
            method: "POST",
            url: "functions.php",
            data: {
                precio: "", idproducto: $('select[name="tecnica"] :selected').val(), superficie: sqlSuperficie, cantidad: nuevaCantidad
            }
        }).done(function (response) {
            // console.log("Response Ajax precios: " + response);
            if (response != "null") { //Saco el calculo de la tarifa * la cantidad del producto
                var calculo = (parseFloat(response) * parseFloat(cantidad)).toFixed(3);
                // console.log(response);
                var strCalculo = calculo.toString().replace('.', ',');
                cantidadTuProducto.innerText = cantidad;
                $('#errorCantidad').hide();
                $('#pstCantidad').val(cantidad);

                if (/*$('#noestalog').length == 0 &&*/ !isNaN(calculo)) {//Si el calculo es correcto asigno valores
                    $('#pPxuTuProducto').text(strCalculo + " (" + response.replace('.', ',') + "€/ud)");
                    $('#pPxuTuProducto').val(calculo);
                    $('#pstPxuProducto').val(calculo);
                    $('#errorForma').text("");
                    $('#cantidad').css('box-shadow', '0 0 10px green');
                    calcularTotal();
                } else {
                    if ($('select[name="tecnica"] :selected').val() == '41' || $('select[name="tecnica"] :selected').val() == '50') {//papertick o chapas
                        $('#pPxuTuProducto').text("");
                        $('#pPxuTuProducto').val('');
                        $('#pstPxuProducto').val('');
                        $('#cantidad').css('box-shadow', '0 0 10px red');
                        $('#errorForma').text($('#err_forma').text());
                    }
                }
            }
        });

        const sibase = $("#sibase");
        const sipelo = $("#sipelo");

        if (sibase.prop('checked') || $("#selectBase").val() == '1' || $("#selectBase").val() == '2') {//Si quiere base
            var base = $('#productoBase').find('div#' + $("#tecnica").val());
            //Base de tela
            if ((base.text().trim() == '1' || $("#selectBase").val() == '1') && sqlSuperficieBase > 0) {
                var idp = 43; // id del producto base de tela
            } else if (base.text().trim() == '2' || $("#selectBase").val() == '2') {
                var idp = 44; // id del producto base de velcro
                sqlSuperficieBase = sqlSuperficie;//La superficie de la base de velcro es la misma que la superficie del producto
            }
            $.ajax({//Peticion de ajax
                method: "POST",
                url: "functions.php",
                data: {
                    precio: "", idproducto: idp, superficie: sqlSuperficieBase, cantidad: nuevaCantidad
                }
            }).done(function (response) {
                // console.log(idp + " " + sqlSuperficieBase + " " + nuevaCantidad);
                if (response != "null") {
                    var calculoBase = (parseFloat(response) * parseFloat(cantidad)).toFixed(3);
                    var strCalculoBase = calculoBase.toString().replace('.', ',');

                    if (/*$('#noestalog').length == 0 &&*/ !isNaN(calculoBase)) {//Si el calculo es correcto asigno valores
                        $('#pPxuBaseTuProducto').text(strCalculoBase + " € (" + response.replace('.', ',') + "€/ud)");
                        $('#pPxuBaseTuProducto').val(calculoBase);
                        $('#pstPxuBase').val(calculoBase);
                        $('#cantidad').css('box-shadow', '0 0 10px green');
                        calcularTotal();
                    }
                }
            });
        }

        if (sipelo.prop('checked')) {//Si quiere pelo
            $.ajax({//Peticion de ajax
                method: "POST",
                url: "functions.php",
                data: {
                    precio: "", idproducto: 48, superficie: sqlSuperficie, cantidad: nuevaCantidad
                }
            }).done(function (response) {
                // console.log("Response Ajax precios: " + response);
                if (response != "null") {
                    var calculoBase = (parseFloat(response) * parseFloat(cantidad)).toFixed(3);
                    var strCalculoBase = calculoBase.toString().replace('.', ',');

                    if (/*$('#noestalog').length == 0 &&*/ !isNaN(calculoBase)) {//Si el calculo es correcto asigno valores
                        $('#pPxuPeloTuProducto').text(strCalculoBase + " € (" + response.replace('.', ',') + "€/ud)");
                        $('#pPxuPeloTuProducto').val(calculoBase);
                        $('#pstPxuPelo').val(calculoBase);
                        $('#cantidad').css('box-shadow', '0 0 10px green');
                        calcularTotal();
                    }
                }
            })
        }

    } else if (nuevaCantidad > arr[1]) {//La cantidad supera el maximo. Reinicio valores.
        $('#errorCantidad').show();
        $('#errorCantidad').text($('#err_cant1').text() + " " + arr[1]);
        cantidadTuProducto.innerHTML = '';
        $('#pstCantidad').val('');

        document.getElementById('pPxuTuProducto').innerText = "";
        document.getElementById('pPxuTuProducto').value = "";

        document.getElementById('pPxuBaseTuProducto').innerText = "";
        document.getElementById('pPxuBaseTuProducto').value = "";

        document.getElementById('pPxuPeloTuProducto').innerText = "";
        document.getElementById('pPxuPeloTuProducto').value = "";

        $('#pstPxuProducto').val('');
        $('#pstPxuBase').val('');
        $('#cantidad').css('box-shadow', '0 0 10px red');

    } else if (nuevaCantidad < arr[0]) {//La cantidad no llega al minimo. Reinicio valores.
        $('#errorCantidad').show();
        $('#errorCantidad').text($('#err_cant2').text() + " " + arr[0]);
        cantidadTuProducto.innerHTML = '';
        $('#pstCantidad').val('');

        document.getElementById('pPxuTuProducto').innerText = "";
        document.getElementById('pPxuTuProducto').value = "";

        document.getElementById('pPxuBaseTuProducto').innerText = "";
        document.getElementById('pPxuBaseTuProducto').value = "";

        document.getElementById('pPxuPeloTuProducto').innerText = "";
        document.getElementById('pPxuPeloTuProducto').value = "";

        $('#pstPxuProducto').val('');
        $('#pstPxuBase').val('');
        $('#cantidad').css('box-shadow', '0 0 10px red');
    }

}


//Calcular superficie de la base
var sqlSuperficieBase = 0;
function calcularSuperficieBase() {
    //Almaceno los valores de los inputs
    var numero1 = ($('#cant1').val()) / 10;
    var numero2 = ($('#cant2').val()) / 10;

    // console.log(numero1 < anchoSuperficie);
    // console.log(numero2 < altoSuperficie);

    //Las medidas de la base deben ser iguales o mayor que las medidas del producto
    if (numero1 < anchoSuperficie || numero2 < altoSuperficie) {//Muestro error y reinicio valores
        superficie = $('#err_sup-base1').text();
        $('#superficieBaseTela').html(superficie);
        $('#superficieBaseTuProducto').text("");
        $('#pstAnchoBase').val("");
        $('#pstLargoBase').val("");
        $('#cant1').css('box-shadow', '0 0 10px red');
        $('#cant2').css('box-shadow', '0 0 10px red');
    } else {
        var superficie = (parseFloat(numero1) * parseFloat(numero2)).toFixed(3);

        //Muestro el resultado
        if (superficie <= 0) {//Si la superficie es 0 o menor de 0. Marco error y reinicio valores
            $('#superficieBaseTela').html("");
            $('#superficieBaseTuProducto').text("");
            $('#pstAnchoBase').val("");
            $('#pstLargoBase').val("");
            $('#cant1').css('box-shadow', '0 0 10px red');
            $('#cant2').css('box-shadow', '0 0 10px red');
        } else if (superficie > 0 && superficie <= 999) {//Si esta dentro del min-max. Asigno valores
            $('#superficieBaseTuProducto').html(numero1.toString().replace('.', ',') + "cm x " + numero2.toString().replace('.', ',') + "cm = " + superficie.replace('.', ',') + "cm<sup>2</sup>");
            // $('#superficieBaseTela').text(superficie.replace('.', ','));
            $('#sBaseTuProducto').text(superficie.replace('.', ','));
            $('#pstAnchoBase').val(numero1);
            $('#pstLargoBase').val(numero2);
            $('#cant1').css('box-shadow', '0 0 10px green');
            $('#cant2').css('box-shadow', '0 0 10px green');
        } else {//Si excede la superficie. Muestro error y reinicio valores
            superficie = $('#err_sup1').text() + " 999cm<sup style='color:inherit'>2</sup>";
            $('#superficieBaseTela').html(superficie);
            $('#superficieBaseTuProducto').text("");
            $('#pstAnchoBase').val("");
            $('#pstLargoBase').val("");
            $('#cant1').css('box-shadow', '0 0 10px red');
            $('#cant2').css('box-shadow', '0 0 10px red');
        }
        // superficieBaseTela.innerText = superficie.replace('.', ',');

        if (superficie > 0 && superficie <= 20) {//Superficie para consulta SQL
            sqlSuperficieBase = 20;
        } else if (superficie > 20 && superficie <= 30) {
            sqlSuperficieBase = 30;
        } else if (superficie > 30 && superficie <= 40) {
            sqlSuperficieBase = 40;
        } else if (superficie > 40 && superficie <= 50) {
            sqlSuperficieBase = 50;
        } else if (superficie > 50 && superficie <= 65) {
            sqlSuperficieBase = 65;
        } else if (superficie > 65 && superficie <= 80) {
            sqlSuperficieBase = 80;
        } else if (superficie > 80 && superficie <= 100) {
            sqlSuperficieBase = 100;
        } else if (superficie > 100 && superficie <= 125) {
            sqlSuperficieBase = 125;
        } else if (superficie > 125 && superficie <= 150) {
            sqlSuperficieBase = 150;
        } else if (superficie > 150 && superficie <= 200) {
            sqlSuperficieBase = 200;
        } else if (superficie > 200 && superficie <= 250) {
            sqlSuperficieBase = 250;
        } else if (superficie > 250 && superficie <= 300) {
            sqlSuperficieBase = 300;
        } else if (superficie > 300 && superficie <= 350) {
            sqlSuperficieBase = 350;
        } else if (superficie > 350 && superficie <= 400) {
            sqlSuperficieBase = 400;
        } else if (superficie > 400 && superficie <= 500) {
            sqlSuperficieBase = 500;
        } else if (superficie > 500 && superficie <= 600) {
            sqlSuperficieBase = 600;
        } else if (superficie > 600 && superficie <= 700) {
            sqlSuperficieBase = 700;
        } else if (superficie > 700 && superficie <= 800) {
            sqlSuperficieBase = 800;
        } else if (superficie > 800 && superficie <= 900) {
            sqlSuperficieBase = 900;
        } else if (superficie > 900 && superficie <= 1000) {
            sqlSuperficieBase = 1000;
        }
    }
}


$("#pantone").keyup(function () {
    var tecnica = document.getElementById("tecnica").value;
    input = document.getElementById("pantone");
    filter = input.value.toUpperCase();
    div = document.getElementsByClassName("colores");

    var arr = Array.prototype.slice.call(div)

    //Primero filtro la lista de los divs para tener SOLO los visibles
    for (var i = 0, max = div.length; i < max; i++) {
        if (isHidden(div[i])) {//Si el div esta oculto lo saco de la lista
            arr.splice(i, 1);
        }
    }

    //Recorriendo elementos a filtrar mediante los "div"
    for (i = 0; i < div.length; i++) {

        a = div[i].getElementsByTagName("label")[0];
        if (a) {//Si existe el elemento
            textValue = a.getAttribute('data-title');//El valor del data-title es lo que busco

            if (textValue.toUpperCase().indexOf(filter) > -1) {
                //Si coincide el div (con la clase concreta del color perteneciente a la tecnica elegida)
                if (div[i].classList.contains("color_" + tecnica)) {
                    div[i].style.display = "";
                }
            } else {
                div[i].style.display = "none";
            }
        }
    }
});


function isHidden(el) {
    var style = window.getComputedStyle(el);
    return ((style.display === 'none') || (style.visibility === 'hidden'))
}

