<?php
// Include config file
require_once "includes/config.php";

include("functions.php");

//Verificar si existe un idioma
//Sino, se hace un llamado inicial con el español
if (isset($_GET['idioma']) && !isset($_SESSION['idioma'])) {
    $_SESSION['idioma'] = $_GET['idioma'];
} else if (isset($_SESSION['idioma'])) {
} else {
    $_SESSION['idioma'] = 'ES';
}

if (!isset($_SESSION['resultadoTraduccionPertex']) || !isset($_SESSION['resultadoTraduccionFormularios'])) {
    $_SESSION['resultadoTraduccionPertex'] = llamadoInicial($_SESSION['idioma']);
    $_SESSION['resultadoTraduccionFormularios'] = llamadoInicialFormularios($_SESSION["idioma"]);
} else if ($_SESSION['idioma'] != "ES") {
    $_SESSION['resultadoTraduccionPertex'] = llamadoInicial($_SESSION['idioma']);
    $_SESSION['resultadoTraduccionFormularios'] = llamadoInicialFormularios($_SESSION["idioma"]);
}
?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Hazte cliente</title>
    <meta name="description" content="<?= buscarTexto("WEB", "contacto", "cont_description", "", $_SESSION['idioma']); ?>">
    <meta property="og:locale" content="es_ES">
    <meta property="og:site_name" content="personalizacionestextiles" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Hazte cliente" />
    <meta property="og:description" content="<?= buscarTexto("WEB", "contacto", "cont_description", "", $_SESSION['idioma']); ?>" />
    <meta property="og:image" content="https://personalizacionestextiles.com/images/logo.png" />

    <?php
    include("assets/_partials/header.php");
    ?>

    <main>
        <?php
        include("errores.php");
        ?>

        <section class="overflow">
            <div class="bg-gracias-landing mt-3">
                <div class="container">
                    <div class="row">

                        <div class="col-10 mx-auto cta p-t-50">
                            <div class="text-center">
                                <!-- <img src="img/catalogo.png" alt="logo de Borman"> -->
                                <h2 class="fs-hazte-cliente p-all-10">Rellena el formulario y nos pondremos en contacto contigo para finalizar el proceso de alta</h2>
                            </div>
                            <div class="row div-registro mb-5 color-alert">
                                <div class=" p-all-5 col-lg-12 col-md-12 col-sm-12">

                                    <p><i class="ti-alert" aria-hidden="true" style="font-size: 20px;"></i><span class="h4"> <?= buscarTexto("WEB", "index", "span1", "", $_SESSION['idioma']); ?></span><?= buscarTextoFormularios("WEB", "index", "p1", "", $_SESSION['idioma']); ?></p>
                                </div>
                            </div>


                            <form class="container" id="formulario-haztecliente" action="hazte-clienteDAO.php" method="post" enctype='multipart/form-data'>
                                <input id="ko" name="ko" value="" hidden>
                                <input id="gracias-donde" name="gracias-donde" value="hazte-cliente" hidden>
                                <input id="actividadesSeleccionadas" name="actividadesSeleccionadas[]" value="" hidden>

                                <!--Nombre comercial-->
                                <div class="mb-3">
                                    <label for="nombrecomercial" class="form-label text-label"><?= buscarTextoFormularios("WEB", "index", "label-comercial", "", $_SESSION['idioma']); ?></label>
                                    <input type="text" class="form-control" id="nombrecomercial" name="nombrecomercial" required>
                                </div>

                                <!--Nombre fiscal-->
                                <div class="mb-3">
                                    <label><?= buscarTextoFormularios("WEB", "index", "label-fiscal", "", $_SESSION['idioma']); ?></label>
                                    <input type="text" name="nombrefiscal" id="nombrefiscal" class="form-control" value="">
                                </div>

                                <!--CIF/DNI-->
                                <input hidden name="result_vatno" id="result_vatno">
                                <div class="mb-3">
                                    <div class="mb-3 mt-3">
                                        <label for="vatno" class="form-label text-label"><?= buscarTextoFormularios("WEB", "index", "label-documento", "", $_SESSION['idioma']); ?></label>
                                        <input name="vatno" id="vatno" type="text" size="30" class="form-control" maxlength="16" value="">
                                    </div>
                                </div>

                                <!--Subir documento-->
                                <div class="mb-3">
                                    <div class="mb-3 mt-3">
                                        <label class="form-label text-label"><?= buscarTextoFormularios("WEB", "index", "label-documento-imagen", "", $_SESSION['idioma']); ?></label>
                                        <label id="lblArchivo" for="archivo" class="btn btn-border btn-archivo"><i class="ti-clip" aria-hidden="true"></i><?= buscarTextoFormularios("WEB", "index", "label-adjunto", "", $_SESSION['idioma']); ?></label>
                                        <input style="visibility:hidden;" name="archivo" id="archivo" type="file" /><br>
                                        <img id="imagenPrevisualizacion">
                                        <div id="pdfPrevisualizacion"></div>
                                    </div>
                                </div>

                                <!--Email-->
                                <div class="mb-3">
                                    <label><?= buscarTextoFormularios("WEB", "index", "label-email", "", $_SESSION['idioma']); ?></label>
                                    <input type="email" name="email" id="email" class="form-control" value="" required>
                                    <br><a style="display:none" id="btn-msj-email" href="https://textilforms.com/login.php?web=6"><i class="ti-alert"></i> <?= buscarTextoFormularios("WEB", "errores", "err-email-form", "", $_SESSION['idioma']); ?></a>
                                </div>

                                <!--Teléfono-->
                                <div class="mb-3">
                                    <label for="telefono" class="form-label text-label"><?= buscarTextoFormularios("WEB", "index", "label-tlf", "", $_SESSION['idioma']); ?></label>
                                    <input type="tel" class="form-control" id="telefono" name="telefono">
                                </div>

                                <div class="form-row">
                                    <!--Dirección-->
                                    <div class="mb-3 col-md-8">
                                        <label><?= buscarTextoFormularios("WEB", "index", "label-direcc", "", $_SESSION['idioma']); ?></label>
                                        <input type="text" name="direccion" id="direccion" class="form-control" value="">
                                    </div>

                                    <!--CP-->
                                    <div class="mb-3 col-md-4">
                                        <label><?= buscarTextoFormularios("WEB", "index", "label-cp", "", $_SESSION['idioma']); ?></label>
                                        <input type="text" name="postal" id="postal" class="form-control" value="">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <!--Pais-->
                                    <div class="mb-3 col-md-6">
                                        <label><?= buscarTextoFormularios("WEB", "index", "label-pais", "", $_SESSION['idioma']); ?></label>

                                        <select name="pais" id="pais" class="form-control">
                                            <option value="">---</option>
                                            <?php
                                            try {
                                                $sql = "SELECT * FROM paises order by nombre";
                                                $query = $conn_prgborman->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            } catch (Exception $e) {
                                                header("location: error.php?msg=" . $e->getMessage());
                                            }

                                            foreach ($results as $result) {
                                            ?>
                                                <option value="<?= $result->nombre; ?>"><?= $result->nombre; ?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="text" class="form-control" placeholder="<?= buscarTextoFormularios("WEB", "index", "placeholder-pais", "", $_SESSION['idioma']); ?>" id="input-pais" name="input-pais" style="display:none"></input>
                                        <p class="mensaje-color">*<?= buscarTextoFormularios("WEB", "index", "p-pais", "", $_SESSION['idioma']); ?><span style="cursor:pointer; font-weight: 800;" id="aquiPais"> <?= buscarTextoFormularios("WEB", "errores", "err-email-form2", "", $_SESSION['idioma']); ?></span></p>

                                    </div>

                                    <!--Provincia -->
                                    <div class="mb-3 col-md-6">
                                        <label><?= buscarTextoFormularios("WEB", "index", "label-prov", "", $_SESSION['idioma']); ?></label>

                                        <select class="form-control" id="provincia" name="provincia">
                                        </select>
                                        <input type="text" class="form-control" placeholder="<?= buscarTextoFormularios("WEB", "index", "placeholder-provincia", "", $_SESSION['idioma']); ?>" id="input-provincia" name="input-provincia" style="display:none"></input>
                                        <p class="mensaje-color">*<?= buscarTextoFormularios("WEB", "index", "p-provincia", "", $_SESSION['idioma']); ?><span style="cursor:pointer; font-weight: 800;" id="aquiProvincia"> <?= buscarTextoFormularios("WEB", "errores", "err-email-form2", "", $_SESSION['idioma']); ?></span></p>
                                    </div>
                                </div>

                                <!--Población / localidad / municipio-->
                                <div class="mb-3 mb-2">
                                    <label><?= buscarTextoFormularios("WEB", "index", "label-pobl", "", $_SESSION['idioma']); ?></label>

                                    <select id="poblacion" class="form-control" name="poblacion">
                                    </select>
                                    <input type="text" class="form-control" placeholder="<?= buscarTextoFormularios("WEB", "index", "placeholder-poblacion", "", $_SESSION['idioma']); ?>" id="input-poblacion" name="input-poblacion" style="display:none"></input>
                                    <p class="mensaje-color">*<?= buscarTextoFormularios("WEB", "index", "p-poblacion", "", $_SESSION['idioma']); ?><span style="cursor:pointer; font-weight: 800;" id="aquiPoblacion"> <?= buscarTextoFormularios("WEB", "errores", "err-email-form2", "", $_SESSION['idioma']); ?></span></p>
                                </div>

                                <!--Recargo-->
                                <!--Para España ¿Está sujeto al régimen especial de recargo de equivalencia?-->
                                <!--Para otros paises ¿Es usted un operador intracomunitario?-->
                                <div class="mb-3" style="display:none" id="divRecargo">
                                    <label for="recargo" class="form-label text-label" id="label-texto-recargo"></label>
                                    <select class="form-control" type="text" id="recargoRegistro" name="recargo">
                                        <option value="">---</option>
                                        <option value="1"><?= buscarTextoFormularios("WEB", "index", "si", "", $_SESSION['idioma']); ?></option>
                                        <option value="0"><?= buscarTextoFormularios("WEB", "index", "no", "", $_SESSION['idioma']); ?></option>
                                    </select>
                                </div>

                                <!--Actividad que realiza-->
                                <div class="form-group p-t-30">
                                    <label><?= buscarTextoFormularios("WEB", "index", "label-act", "", $_SESSION['idioma']); ?></label>
                                    <div class="row p-all-30">
                                        <?php
                                        try {
                                            $sql = "SELECT idActividad, descripcion 
                                            FROM actividad_has_webs 
                                            INNER JOIN Actividad ON Actividad.idActividad = actividad_has_webs.actividad_idActividad
                                            WHERE webs_web = 'Personalizaciones textiles'
                                            ORDER BY descripcion";
                                            $query = $conn_prgborman->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        } catch (Exception $e) {
                                            // header("location: error.php?msg=" . $e->getMessage());
                                        } ?>

                                        <?php foreach ($results as $result) {
                                        ?>
                                            <label class="form-check-label col-lg-6 ">
                                                <input type="checkbox" class="form-check-input" name="actividades[]" value="<?= $result->idActividad ?>" required>
                                                <?= buscarTextoFormularios("PRG", "Actividad", $result->idActividad, "descripcion", $_SESSION['idioma']); ?>
                                                </input>
                                            </label>
                                        <?php
                                        } ?>
                                    </div>
                                </div>


                                <!--Como nos has conocido-->
                                <div class="mb-3">
                                    <label for="conocido" class="form-label text-label"><?= buscarTextoFormularios("WEB", "index", "label-conocido", "", $_SESSION['idioma']); ?></label>
                                    <label id="CNC" style="display:none"><?= $comonosconocio ?></label>
                                    <select class="form-control" type="text" id="conocido" name="conocido" required <?= $vieneDeLink ?>>
                                        <option value="">---</option>
                                        <?php
                                        try {
                                            $sql = "SELECT id, descripcion FROM prg_borman.mediodepesca_comonosconocio 
                                            WHERE mediodepesca_comonosconocio.web=1 AND mediodepesca=1 AND marcas_idMarca=13 ORDER BY descripcion";
                                            $query = $conn_prgborman->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        } catch (Exception $e) {
                                            // header("location: error.php?msg=" . $e->getMessage());
                                        }
                                        foreach ($results as $result) {
                                        ?>
                                            <option value="<?= $result->id ?>"><?= buscarTextoFormularios("PRG", "mediodepesca_comonosconocio", $result->id, "descripcion", $_SESSION['idioma']); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <!--Mensaje o consulta-->
                                <div class="mb-3">
                                    <label for="comentariosLanding" class="form-label"><?= buscarTextoFormularios("WEB", "index", "label-mensaje", "", $_SESSION['idioma']); ?></label>
                                    <textarea class="form-control" id="comentariosLanding" name="comentariosLanding" rows=11 cols=50></textarea>
                                </div>

                                <!--Acepta privacidad-->
                                <div class="mb-3 form-check">
                                    <label class="form-check-label privacidad" for="privacidad"><input type="checkbox" class="form-check-input" id="privacidad" name="privacidad" required>
                                        <?= buscarTextoFormularios("WEB", "index", "label-priv", "", $_SESSION['idioma']);  ?></label>
                                </div>


                                <div class="mb-3">
                                    <button <?php /*data-callback="formSubmit" data-size="invisible" data-sitekey="6Lfsty4kAAAAAFSXuiif_RVAasF-3lb7ogU29oDb"*/ ?> class="btn btn-border mb-5 <?php /*btng-recaptcha*/ ?>" id="btnEnviar" type="submit">
                                        <span class="button__text"><?= buscarTextoFormularios("WEB", "index", "btn", "", $_SESSION['idioma']); ?></span>
                                    </button>
                                </div>
                                <nav class=" header-bottom navbar main-nav navbar-expand-lg px-2 px-sm-0 p-y-5 py-lg-0 m-t-50">

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php
    include("assets/_partials/footer.php");
    ?>
    <script type="text/javascript">
        var input = document.getElementById('telefono');
        input.addEventListener('input', function() {
            if (this.value.length > 15)
                this.value = this.value.slice(0, 15);
        })
        $("#email")
            .on("focusout", function() {
                $('#btn-msj-email').hide();
                if ($('#email').val().trim() != "") {
                    $.ajax({ //Peticion de ajax
                        async: false,
                        method: "POST",
                        url: "functions.php",
                        data: {
                            buscarMail: $('#email').val()
                        }
                    }).done(function(response) {
                        if (response.trim() == "1") {
                            $('#btn-msj-email').show();
                        }
                    });
                }
            });


        var file = null;
        // var formData = new FormData();

        $(document).on('change', 'input[type="file"]', function() {
            var fileSize = this.files[0].size;
            const extension = this.files[0].name.split('.').pop().toLowerCase();
            const pdfPreview = document.getElementById('pdfPrevisualizacion');
            if (extension !== 'jpg' && extension !== 'pdf' && extension !== 'png') {
                $('#archivo').val("");
                this.files[0] = null;
                file = null;
                $('#imagenPrevisualizacion').attr('src', '');
                pdfPreview.innerHTML = '';
                alert($('#err-tipoimg').text());
            } else {
                if (fileSize <= 16000000) { //16Megabyte
                    var reader = new FileReader(); //Leemos el contenido
                    reader.onload = function(e) { //Asigno valores
                        if (extension == 'pdf') {
                            $('#imagenPrevisualizacion').attr('src', '');
                            const pdfUrl = e.target.result;
                            const pdfEmbed = document.createElement('embed');
                            pdfEmbed.src = pdfUrl;
                            pdfEmbed.width = '100%';
                            pdfEmbed.height = '300px';

                            // Limpia cualquier vista previa anterior
                            pdfPreview.innerHTML = '';

                            // Agrega el objeto <embed> a la vista previa
                            pdfPreview.appendChild(pdfEmbed);

                        } else {
                            // Limpia cualquier vista previa anterior
                            pdfPreview.innerHTML = '';
                            //Al cargar el contenido lo pasamos como atributo de la imagen 
                            $('#imagenPrevisualizacion').attr('src', e.target.result);
                        }
                    }
                    reader.readAsDataURL(this.files[0]);
                    file = this.files[0];
                } else {
                    $('#archivo').val("");
                    this.files[0] = null;
                    file = null;
                    alert($('#err-mb').text());
                }

            }

        });

        var clicked = false;
        $.validator.setDefaults({
            submitHandler: function(form) {
                $('#btnEnviar').addClass("button--loading");
                $('#btnEnviar').prop("disabled", true);

                var arr = [];
                $("input[name='actividades[]']:checked").each(function() {
                    arr.push($(this).val());
                });

                $('#actividadesSeleccionadas').val(arr); //Asignamos el nuevo array


                this.submit();
            }
        });

        $(document).ready(function() {
            $("#formulario-haztecliente").validate({
                rules: {
                    conocido: "required",
                    privacidad: "required",
                    "actividades[]": "required",
                    nombrecomercial: {
                        required: true,
                        minlength: 2,
                    },
                    nombrefiscal: {
                        minlength: 2,
                    },
                    vatno: {
                        vatno_exists: "#vatno"
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    direccion: {
                        minlength: 2
                    },
                    postal: {
                        minlength: 2,
                    },
                    telefono: {
                        number: true
                    }
                },
                messages: {
                    "actividades[]": $('#err-actividad').text(),
                    privacidad: $('#err-privacidad').text(),
                    conocido: $('#err-conocido').text(),
                    nombrecomercial: {
                        required: $('#err-obligatorio').text(),
                        minlength: $('#err-minimo2').text()
                    },
                    nombrefiscal: {
                        minlength: $('#err-minimo2').text()
                    },
                    email: {
                        required: $('#err-obligatorio').text(),
                        email: $('#err-email').text()
                    },
                    direccion: {
                        minlength: $('#err-minimo2').text()
                    },
                    postal: {
                        minlength: $('#err-minimo2').text()
                    },
                    telefono: {
                        number: $('#err-tel').text()
                    },
                },
                errorElement: "em",
                errorPlacement: function(error, element) {
                    error.addClass("help-block");
                    if (element.prop("type") === "checkbox") {
                        if (element.attr("name") == "actividades[]") {
                            error.insertBefore(element.parent("label").parent("div"));
                        } else {
                            error.insertAfter(element.parent("label"));
                        }
                    } else {
                        error.insertAfter(element);
                    }
                }
            });

            $.validator.addMethod("vatno_exists", function(value, element) {
                "use strict";
                if (this.optional(element)) {
                    return true;
                }
                $.ajax({ //Peticion de ajax
                    async: false,
                    method: "POST",
                    url: "functions.php",
                    data: {
                        CifDniVat: $('#vatno').val()
                    }
                }).done(function(response) {
                    // console.log(response);
                    $("#result_vatno").val(response);
                });
                if ($("#result_vatno").val().trim() == "1") {
                    return false;
                }
                return true;
            }, $('#err-dni-existe2').text() + "<a href='login.php?web=6'>" + $('#err-dni-existe2-1').text() + "</a>.");
        });


        $('#aquiPais').on('click', function() {
            $("select#pais").val('0');
            $("#provincia").empty();
            $("#poblacion").empty();

            $('#input-pais').val("");
            $('#input-provincia').val("");
            $('#input-poblacion').val("");

            $('#input-pais').text("");
            $('#input-provincia').text("");
            $('#input-poblacion').text("");

            if ($('#input-pais').is(":visible")) {
                $('#pais').show();
                $('#input-pais').hide();

                $('#provincia').show();
                $('#input-provincia').hide();

                $('#poblacion').show();
                $('#input-poblacion').hide();
                $('#divRecargo').hide();
            } else {
                $('#divRecargo').show();
                $('#label-texto-recargo').text($('#label-intracomunitario').text());

                $('#pais').hide();
                $('#input-pais').show();

                $('#provincia').hide();
                $('#input-provincia').show();

                $('#poblacion').hide();
                $('#input-poblacion').show();
            }
        });

        $('#aquiProvincia').on('click', function() {
            $("select#provincia").val('0');
            $("#poblacion").empty();

            $('#input-provincia').val("");
            $('#input-poblacion').val("");

            $('#input-provincia').text("");
            $('#input-poblacion').text("");

            if ($('#input-provincia').is(":visible")) {
                $('#provincia').show();
                $('#input-provincia').hide();

                $('#poblacion').show();
                $('#input-poblacion').hide();
            } else {
                $('#provincia').hide();
                $('#input-provincia').show();

                $('#poblacion').hide();
                $('#input-poblacion').show();
            }
        });

        $('#aquiPoblacion').on('click', function() {
            $("select#poblacion").val('0');

            $('#input-poblacion').val("");

            $('#input-poblacion').text("");

            if ($('#input-poblacion').is(":visible")) {
                $('#poblacion').show();
                $('#input-poblacion').hide();
            } else {
                $('#poblacion').hide();
                $('#input-poblacion').show();
            }
        });

        $('#pais').on('change', function() {
            // Al elegir pais, si es España, preguntar recargo de equivalencia
            // Si eligen o escriben otro país, preguntar si es operador intracomunitario
            console.log($('#pais').val());
            if ($('#pais').val() != '') {
                $('#divRecargo').show();
                if ($('#pais').val() == 'ESPAÑA') {
                    $('#label-texto-recargo').text($('#label-recargo').text());
                } else {
                    $('#label-texto-recargo').text($('#label-intracomunitario').text());
                }
            } else {
                $('#label-texto-recargo').show();
                $('#divRecargo').hide();
            }

            $.ajax({ //Peticion de ajax
                method: "POST",
                url: "provincias-poblaciones.php",
                data: {
                    que: "provincia",
                    pais: $(this).val()
                }
            }).done(function(response) {
                //Limpio los select
                $('#provincia').empty();
                $('#poblacion').empty();

                //Obtengo el array de las provincias segun el pais
                var provincias = response.split(',');
                provincias.pop();

                if (provincias.length > 0) { //Asigno valores
                    $('#provincia').append("<option value=''>---</option>");
                    for (let i = 0; i < provincias.length; i++) {
                        $('#provincia').append("<option value='" + provincias[i] + "'>" + provincias[i] + "</option>");
                    }
                    // console.log("if ");
                } else { //Si no encuentra provincias se asigna el nombre del pais a los select

                    // $('#provincia').append("<option value='" + $('#pais').val() + "'>" + $('#pais').val() + "</option>");
                    // $('#poblacion').append("<option value='" + $('#pais').val() + "'>" + $('#pais').val() + "</option>");
                    // console.log("else ");
                }
            });
        });

        $('#provincia').on('change', function() {
            $.ajax({ //Peticion de ajax
                method: "POST",
                url: "provincias-poblaciones.php",
                data: {
                    que: "poblacion",
                    provincia: $(this).val()
                }
            }).done(function(response) {
                $('#poblacion').empty(); //Limpio el select

                //Obtengo el array de las poblaciones segun la provincia
                var poblaciones = response.split(',');
                $('#poblacion').append("<option value=''>---</option>");

                for (let i = 0; i < poblaciones.length; i++) { //Asigno valores
                    $('#poblacion').append("<option value='" + poblaciones[i] + "'>" + poblaciones[i] + "</option>");
                }
            });

        });
    </script>