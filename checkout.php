<?php
require_once('includes/config.php');
include("funciones/functions.php");
include("pedidos.php");

if (!$user->is_logged_in()) {
    header('Location: login');
    exit();
}

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
$amount = 0;
$numeroPedido  = "";

$numeroPedido = isset($_POST['idPedidos'])?$_POST['idPedidos']:$_GET['check'];

try {
    $sql = "SELECT precioTotal FROM pedidos 
    WHERE idpedidos=?";
    $query = $conn->prepare($sql);
    $query->bindParam(1, $numeroPedido, PDO::PARAM_STR);
    $query->execute();
    $amount = $query->fetchColumn();
} catch (Exception $e) {
    header("location: error.php?msg=" . $e->getCode());
}

$recargo = ""; //recargo de equivalencia


?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= buscarTexto("WEB", "checkout", "checkout_title", "", $_SESSION['idioma']); ?> | Personalizaciones textiles</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:locale" content="es_ES">
    <meta property="og:site_name" content="Personalizaciones textiles" />
    <meta property="og:url" content="https://personalizacionestextiles.com/checkout" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Finalizar compra | Personalizaciones textiles" />
    <meta property="og:image" content="https://personalizacionestextiles.com/images/logo.png" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <?php
    include("assets/_partials/header-personalizar.php");
    ?>

    <main>

        <?php
        include("funciones/errores.php");

        $email = $nombrecomercial = $nombrefiscal = $intracomunitario = $vatno = $direccion =
            $postal = $pais = $provincia = $poblacion = $telefono = $movil = $actividades = $recargo = $conocido = "";

        try {
            $sql = "SELECT * FROM fichaempresametas 
            WHERE email=?";
            $query = $conn_formularios->prepare($sql);
            $query->bindParam(1, $_SESSION['email'], PDO::PARAM_STR);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            foreach ($results as $result) {
                $nombrefiscal = $result->nombreFiscal;
                $nombrecomercial = $result->nombreComercial;
                $direccion  = $result->direccion;
                $postal = $result->codigoPostal;
                $poblacion = $result->poblacion;
                $provincia = $result->provincia;
                $pais = $result->pais;
                $vatno = $result->CifDniVat;
                $telefono = $result->telefono;
                $movil = $result->telefono;
                $email = $result->email;
                $intracomunitario = $result->TieneIvaExentoIntracomunitario;
                $recargo = $result->TieneRecargoEquivalencia;
            }
        } catch (Exception $e) {
            header("location: error.php?msg=" . $e->getCode());
        }
        ?>

        <section class="checkout_area section_padding">
            <div class="container">
                <div class="billing_details">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="section-dtll">
                                <h2><?= buscarTexto("WEB", "checkout", "checkout_subtit-1", "", $_SESSION['idioma']); ?></h2><br>
                                <div class="row col-md-12 form-group p_star">
                                    <input type="text" name="web" id="web" class="form-control" value="<?= $idweb ?>" hidden>
                                    <!--Nombre y apellidos o nombre comercial-->
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label><?= buscarTexto("WEB", "checkout", "checkout_subtit-1-div1", "", $_SESSION['idioma']); ?></label>
                                            <input type="text" name="nombrecomercial" id="nombrecomercial" class="form-control" value="<?= $nombrecomercial ?>" disabled>
                                        </div>

                                        <!--Nombre fiscal-->
                                        <div class="form-group col-md-6">
                                            <label><?= buscarTexto("WEB", "checkout", "checkout_subtit-1-div0", "", $_SESSION['idioma']); ?></label>
                                            <input type="text" name="nombrefiscal" id="nombrefiscal" class="form-control" value="<?= $nombrefiscal ?>" disabled>
                                        </div>
                                    </div>

                                    <!--CIF/DNI/VAT-->
                                    <div class="form-row">
                                        <div class="form-group col-md-6 ">
                                            <!--Intracomunitario-->
                                            <div class="mb-3 mt-3">
                                                <label for="intracomunitario" class="form-label text-label"><?= buscarTexto("WEB", "checkout", "checkout_subtit-1-div3", "", $_SESSION['idioma']); ?></label>
                                                <input disabled class="form-control" value="<?php if ($intracomunitario == 3) {
                                                                                                echo "Sí";
                                                                                            } else if ($intracomunitario == 1) {
                                                                                                echo "No";
                                                                                            } ?>">
                                            </div>
                                        </div>

                                        <!--CIF/DNI-->
                                        <div class="form-group col-md-6 ">
                                            <div class="mb-3 mt-3">
                                                <label for="vatno" class="form-label text-label"><?= buscarTexto("WEB", "checkout", "checkout_subtit-1-div2", "", $_SESSION['idioma']); ?></label>
                                                <input name="vatno" id="vatno" type="text" size="30" class="form-control" maxlength="16" value="<?= $vatno ?>" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Email-->
                                    <div class="form-row">
                                        <div class="col-md-6 form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" id="email" class="form-control" value="<?= $email ?>" required disabled>
                                        </div>

                                        <!--Teléfono-->
                                        <div class="col-md-6 form-group">
                                            <label for="telefono" class="form-label text-label"><?= buscarTexto("WEB", "checkout", "checkout_subtit-1-div6", "", $_SESSION['idioma']); ?></label>
                                            <input type="tel" class="form-control" id="telefono" name="telefono" value="<?= $telefono ?>" disabled>
                                        </div>
                                    </div>

                                    <div class="form-row">

                                        <!--Dirección-->
                                        <div class="form-group col-md-8">
                                            <label><?= buscarTexto("WEB", "checkout", "checkout_subtit-2-div1", "", $_SESSION['idioma']); ?></label>
                                            <input type="text" name="direccion" id="direccion" class="form-control" value="<?= $direccion ?>" disabled>
                                        </div>

                                        <!--CP-->
                                        <div class="form-group col-md-4">
                                            <label><?= buscarTexto("WEB", "checkout", "checkout_subtit-2-div5", "", $_SESSION['idioma']); ?></label>
                                            <input type="text" name="postal" id="postal" class="form-control" value="<?= $postal ?>" disabled>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <!--Pais-->
                                        <div class="form-group col-md-6">
                                            <label><?= buscarTexto("WEB", "checkout", "checkout_subtit-2-div2", "", $_SESSION['idioma']); ?></label>
                                            <input id="pais" class="form-control" disabled value="<?= $pais; ?>">
                                        </div>

                                        <!--Provincia -->
                                        <div class="form-group col-md-6">
                                            <label><?= buscarTexto("WEB", "checkout", "checkout_subtit-2-div3", "", $_SESSION['idioma']); ?></label>
                                            <input id="provincia" class="form-control" disabled value="<?= $provincia; ?>">
                                        </div>
                                    </div>

                                    <!--Población / localidad / municipio-->
                                    <div class="form-row ">
                                        <div class="form-group col-md-6">
                                            <label><?= buscarTexto("WEB", "checkout", "checkout_subtit-2-div4", "", $_SESSION['idioma']); ?></label>
                                            <input id="poblacion" class="form-control" disabled value="<?= $poblacion; ?>">
                                        </div>

                                        <!--Recargo-->
                                        <div class="mb-3 col-md-6">
                                            <label for="recargo" class="form-label text-label"><?= buscarTexto("WEB", "checkout", "checkout_tit2-li3", "", $_SESSION['idioma']); ?></label>
                                            <input id="inputRecargo" disabled class="form-control" value="<?php if ($recargo == 1) {
                                                                                                                echo "Sí";
                                                                                                            } else if ($recargo == 0) {
                                                                                                                echo "No";
                                                                                                            } ?>">
                                        </div>
                                    </div>

                                    <label><?= buscarTexto("WEB", "checkout", "checkout_factura", "", $_SESSION['idioma']); ?></label>
                                    <div class="payment_item active">
                                        <div class="radion_btn">
                                            <input type="radio" id="sifac" name="factura" value="sifactura" />
                                            <label for="sifac"><?= buscarTexto("WEB", "generico", "si", "", $_SESSION['idioma']); ?></label>
                                            <div class="check"></div>
                                        </div>
                                    </div>

                                    <div class="payment_item active">
                                        <div class="radion_btn">
                                            <input type="radio" id="nofac" name="factura" value="nofactura" checked />
                                            <label for="nofac"><?= buscarTexto("WEB", "generico", "no", "", $_SESSION['idioma']); ?></label>
                                            <div class="check"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="order_box">
                                <h2><?= buscarTexto("WEB", "checkout", "checkout_tit2", "", $_SESSION['idioma']); ?> #<?= $numeroPedido ?></h2>
                                <ul class="list list_2">
                                    <li>
                                        <a style="cursor:auto" href="#"><?= buscarTexto("WEB", "checkout", "checkout_tit2-li1", "", $_SESSION['idioma']); ?>
                                            <span id="subtotal" val="<?= str_replace(',', '.', $amount) ?>"><?= str_replace('.', ',', $amount) ?></span>
                                        </a>
                                    </li>

                                    <li>
                                        <a style="cursor:auto" href="#"><?= buscarTexto("WEB", "checkout", "checkout_tit2-li2", "", $_SESSION['idioma']); ?>
                                            <span id="envio" val="50">50 €</span>
                                        </a>
                                    </li>

                                    <?php if ($recargo == "1") { ?>
                                        <li>
                                            <a style="cursor:auto" href="#"><?= buscarTexto("WEB", "checkout", "checkout_tit2-li3", "", $_SESSION['idioma']); ?> (5,2%)
                                                <span id="recargo" val="50">50 €</span>
                                            </a>
                                        </li>
                                    <?php  } ?>

                                    <li>
                                        <a style="cursor:auto" href="#"><?= buscarTexto("WEB", "checkout", "checkout_tit2-li4", "", $_SESSION['idioma']); ?> (21%)
                                            <span id="iva" val="50">50 €</span>
                                        </a>
                                    </li>

                                    <li id="liGestionDua">
                                        <a style="cursor:auto" href="#"><?= buscarTexto("WEB", "checkout", "checkout_tit2-li5", "", $_SESSION['idioma']); ?>
                                            <span id="gestionDua" val="50">50 €</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a style="cursor:auto" href="#"><?= buscarTexto("WEB", "checkout", "checkout_tit2-li6", "", $_SESSION['idioma']); ?>
                                            <strong><span id="totalAmount" class="fs-18" val=""></span></strong>
                                        </a>
                                    </li>
                                </ul>

                                <div>
                                    <h2><?= buscarTexto("WEB", "checkout", "checkout_tit3", "", $_SESSION['idioma']); ?></h2>
                                    <p><?= buscarTexto("WEB", "checkout", "checkout_tit3-p1", "", $_SESSION['idioma']); ?></p>
                                </div>

                                <!--Pago // https://pagosonline.redsys.es/conexion-redireccion.html //---------------------------------------------------------------------------------------------------------->
                                <div>
                                    <div class="payment_item">
                                        <div class="payment_item active">
                                            <div style="float: left;padding-left: 20px;padding-right: 2px;"> <img style="float: left;" height="18" width="18" src="assets/img/pago/banco.png" alt="<?= buscarTexto("WEB", "checkout", "alt-banco", "", $_SESSION['idioma']); ?>" /></div>
                                            <div class="radion_btn">
                                                <input type="radio" id="transferencia" name="metodoPago" value="transferenciaBancaria" checked />
                                                <label style="padding-top: 3px;" for="transferencia"><?= buscarTexto("WEB", "checkout", "checkout_metodopago1", "", $_SESSION['idioma']); ?></label>
                                                <div class="check"></div>
                                            </div>
                                        </div>

                                        <div style="float: left;padding-left: 20px;padding-right: 2px;"> <img style="float: left;" height="15" width="25" src="assets/img/pago/tarjeta.png" alt="<?= buscarTexto("WEB", "checkout", "alt-tarjeta", "", $_SESSION['idioma']); ?>" /></div>

                                        <div class="radion_btn">
                                            <input type="radio" id="tarjeta" name="metodoPago" value="tarjeta" />
                                            <label for="tarjeta"><?= buscarTexto("WEB", "checkout", "checkout_metodopago2", "", $_SESSION['idioma']); ?></label>
                                            <div class="check"></div>
                                        </div>

                                        <!-- <div class="payment_item">
                                                <div style="float: left;padding-left: 20px;padding-right: 2px;"> <img style="float: left;" height="25" width="18" src="assets/img/pago/bizum.png" alt="<?= buscarTexto("WEB", "checkout", "alt-bizum", "", $_SESSION['idioma']); ?>" /></div>
                                                <div class="radion_btn">
                                                    <input type="radio" id="bizum" name="metodoPago" value="bizum">
                                                    <label for="bizum"><?= buscarTexto("WEB", "checkout", "checkout_metodopago3", "", $_SESSION['idioma']); ?></label>
                                                    <div class="check"></div>
                                                </div>
                                            </div>

                                            <div style="float: left;padding-left: 20px;padding-right: 2px;"> <img style="float: left;" height="18" width="18" src="assets/img/pago/paypal.png" alt="<?= buscarTexto("WEB", "checkout", "alt-paypa", "", $_SESSION['idioma']); ?>" /></div>
                                            <div class="radion_btn">
                                                <input type="radio" id="paypal" name="metodoPago" value="paypal" />
                                                <label for="paypal"><?= buscarTexto("WEB", "checkout", "checkout_metodopago4", "", $_SESSION['idioma']); ?></label>
                                                <div class="check"></div>
                                            </div> -->
                                    </div>

                                    <p class="fs-12">
                                        <?= buscarTexto("WEB", "checkout", "checkout_metodopago-p1", "", $_SESSION['idioma']); ?>
                                    </p>
                                </div>

                                <!--action Redsys de prueba: https://sis-t.redsys.es:25443/sis/realizarPago -->
                                <!--action Redsys real: https://sis.redsys.es/sis/realizarPago -->
                                <form id="formulariopago" action="https://sis.redsys.es/sis/realizarPago" method="POST">
                                    <!--Términos y condiciones / Propiedad intelectual-->
                                    <div class="creat_account">
                                        <label><input required type="checkbox" name="privacidad" id="input-privacidad" class="m-r-5" /><span class="fs-12"><?= buscarTexto("WEB", "checkout", "checkout_terminos1", "", $_SESSION['idioma']); ?> *</span>
                                            <a target="_blank" href="<?= buscarTexto("WEB", "paginas", "privacidad", "", $_SESSION['idioma']); ?>" class="fs-12"><?= buscarTexto("WEB", "checkout", "checkout_terminos2", "", $_SESSION['idioma']); ?></a>
                                        </label><br>

                                        <label><input required type="checkbox" name="intelectual" id="input-intelectual" class="m-r-5" /><span class="fs-12"><?= buscarTexto("WEB", "checkout", "checkout_propiedad1", "", $_SESSION['idioma']); ?> *</span>
                                            <a target="_blank" href="<?= buscarTexto("WEB", "paginas", "intelectual", "", $_SESSION['idioma']); ?>" class="fs-12"><?= buscarTexto("WEB", "checkout", "checkout_propiedad2", "", $_SESSION['idioma']); ?></a>
                                        </label>
                                    </div>

                                    <!--Datos Redsys-->
                                    <input type="hidden" name="Ds_SignatureVersion" value="HMAC_SHA256_V1" />
                                    <input type="hidden" name="Ds_MerchantParameters" value="" />
                                    <input type="hidden" name="Ds_Signature" value="" />

                                    <!--Otros datos necesarios para la gestión del pedido por nuestra parte-->
                                    <input type="hidden" name="nPedido" value="<?= $numeroPedido ?>" />
                                    <input type="hidden" name="quiereFactura" value="" />
                                    <input type="hidden" name="total" id="total" value="" />
                                    <input type="hidden" name="strTotal" id="strTotal" value="" />

                                    <button class="btn" type="submit" id="boton_formulario_checkout">
                                        <span class="button__text"><?= buscarTexto("WEB", "checkout", "checkout_btn-pagar", "", $_SESSION['idioma']); ?></span>
                                    </button>
                                </form>
                            </div>
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
        $.validator.setDefaults({
            submitHandler: function() {
                $('#boton_formulario_checkout').addClass("button--loading");
                $('#boton_formulario_checkout').prop("disabled", true);
                var amount = $('#total').val();
                var order = $('input[name=nPedido]').val();
                var paymethod = $('input[name=metodoPago]:checked').val();
                var factura = $('#sifac').is(':checked') ? 1 : 0;

                submitDelForm(amount, order, paymethod, factura);
            }
        });

        var x = false;

        function submitDelForm(paymethod, order, paymethod, factura) {
            if (!x) {
                $.ajax({ //Peticion de ajax
                    method: "POST",
                    url: "historicoPago.php",
                    data: {
                        nPedido: order,
                        metodo: paymethod,
                        factura: factura,
                        total: suma.toFixed(2)
                    }
                }).done(function(response) {
                    // console.log("re=" + response);
                });
                x = true;
            }
            if (paymethod == "transferenciaBancaria") {
                $('#quiereFactura').val($('#sifac').is(':checked') ? 1 : 0);

                $('#formulariopago').attr('action', "transferencia");
                $('#formulariopago').submit();
            } else {
                $('#formulariopago').attr('action', "https://sis.redsys.es/sis/realizarPago");

                if ($('input[name=Ds_MerchantParameters]').val() != "" && $('input[name=Ds_Signature]').val() != "") {
                    $('#formulariopago').submit();
                }
            }
        }

        $(document).ready(function() {
            $("#formulariopago").validate({
                rules: {
                    privacidad: "required",
                    intelectual: "required"
                },
                messages: {
                    privacidad: $('#valida-privacidad').text(),
                    intelectual: $('#valida-intelectual').text()
                },
                errorElement: "em",
                errorPlacement: function(error, element) {
                    error.addClass("help-block");

                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.parent("label"));
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).parents(".col-sm-5").addClass("has-error").removeClass("has-success");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).parents(".col-sm-5").addClass("has-success").removeClass("has-error");
                }
            });
        });

        var acc = document.getElementsByClassName("accordionPA");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                var icono = this.firstChild.firstChild;

                if (panel.style.display === "block") {
                    panel.style.display = "none";
                } else {
                    panel.style.display = "block";
                }

                if (icono.className === "fa fa-plus") {
                    icono.className = "fa fa-minus";
                } else {
                    icono.className = "fa fa-plus";
                }
            });
        }
        /////////////////////////////////////////////////ENVIO//////////////////////////////////////////////////////////////////////////////
        $(document).ready(function() {
            calcularPrecio();
        })
        var suma = 0;

        function calcularPrecio() {
            var pais = $('#pais').val();
            var provincia = $('#provincia').val();

            //Booleanos para saber que sumar
            var nacional = false;
            var peninsula = false;
            var baleares = false;
            var ceutaYmelilla = false;
            var canarias = false;

            var corcega = false;
            var siciliaYcerdana = false;
            var azoresYmadeira = false;

            nacional = pais == "ESPAÑA" ? true : false;
            baleares = provincia == "Balears (Illes)" ? true : false;
            ceutaYmelilla = provincia == "Ceuta" ? true : provincia == "Melilla" ? true : false;
            canarias = provincia == "Palmas (Las)" ? true : provincia == "Santa Cruz de Tenerife" ? true : false;

            corcega = provincia == "Córcega" ? true : false;
            siciliaYcerdana = provincia == "Sicilia" ? true : provincia == "Cerdeña" ? true : false;
            azoresYmadeira = provincia == "Azores" ? true : provincia == "Madeira" ? true : false;

            var suplementoDua = 20.50;
            var vat = $('#intracomunitario').val() == 'Sí' ? true : false; //Si es 1 esta excento de iva (es intracomunitario), si es 0 se cobra el iva con normalidad
            var precio = ($('#subtotal').text().split(' ')[0]).replace(",", ".");
            var recargo = $('#inputRecargo').val() == 'Sí' ? (precio * 5.2) / 100 : 0;
            var iva = canarias ? 0 : ceutaYmelilla ? 0 : vat ? 0 : (precio * 21) / 100;
            var envio = 0;

            var precioMasIva = parseFloat(precio) + parseFloat(iva);

            if (nacional && (!baleares && !ceutaYmelilla && !canarias)) {
                peninsula = true;
            }

            if (nacional) {
                if (peninsula) {
                    if (precioMasIva < 25) {
                        envio = 5;
                    } else if (precioMasIva < 99) {
                        envio = 8;
                    } else if (precioMasIva < 199) {
                        envio = 11;
                    } else if (precioMasIva < 399) {
                        envio = 14;
                    } else if (precioMasIva < 1000) {
                        envio = 0;
                    } else if (precioMasIva > 1000) {
                        envio = 0;
                    }
                } else if (baleares) {
                    if (precioMasIva < 25) {
                        envio = 10;
                    } else if (precioMasIva < 99) {
                        envio = 16;
                    } else if (precioMasIva < 199) {
                        envio = 23;
                    } else if (precioMasIva < 399) {
                        envio = 30;
                    } else if (precioMasIva < 1000) {
                        envio = 50;
                    } else if (precioMasIva > 1000) {
                        envio = 75;
                    }
                } else if (ceutaYmelilla) {
                    if (precioMasIva < 25) {
                        envio = 30;
                    } else if (precioMasIva < 99) {
                        envio = 39;
                    } else if (precioMasIva < 199) {
                        envio = 48;
                    } else if (precioMasIva < 399) {
                        envio = 55;
                    } else if (precioMasIva < 1000) {
                        envio = 75;
                    } else if (precioMasIva > 1000) {
                        envio = 110;
                    }
                } else if (canarias) {
                    if (precioMasIva < 25) {
                        envio = 40;
                    } else if (precioMasIva < 99) {
                        envio = 50;
                    } else if (precioMasIva < 199) {
                        envio = 63;
                    } else if (precioMasIva < 399) {
                        envio = 75;
                    } else if (precioMasIva < 1000) {
                        envio = 110;
                    } else if (precioMasIva > 1000) {
                        envio = 180;
                    }
                }
            } else {
                if (pais == "FRANCIA") {
                    if (corcega) {
                        if (precioMasIva < 50) {
                            envio = 40;
                        } else if (precioMasIva < 149) {
                            envio = 60;
                        } else if (precioMasIva < 299) {
                            envio = 80;
                        } else if (precioMasIva < 499) {
                            envio = 120;
                        } else if (precioMasIva < 1000) {
                            envio = 180;
                        } else if (precioMasIva > 1000) {
                            envio = 260;
                        }
                    } else {
                        if (precioMasIva < 50) {
                            envio = 12;
                        } else if (precioMasIva < 149) {
                            envio = 19;
                        } else if (precioMasIva < 299) {
                            envio = 25;
                        } else if (precioMasIva < 499) {
                            envio = 30;
                        } else if (precioMasIva < 1000) {
                            envio = 50;
                        } else if (precioMasIva > 1000) {
                            envio = 90;
                        }
                    }
                } else if (pais == "ITALIA") {
                    if (siciliaYcerdana) {
                        if (precioMasIva < 50) {
                            envio = 40;
                        } else if (precioMasIva < 149) {
                            envio = 60;
                        } else if (precioMasIva < 299) {
                            envio = 80;
                        } else if (precioMasIva < 499) {
                            envio = 120;
                        } else if (precioMasIva < 1000) {
                            envio = 180;
                        } else if (precioMasIva > 1000) {
                            envio = 260;
                        }
                    } else {
                        if (precioMasIva < 50) {
                            envio = 15;
                        } else if (precioMasIva < 149) {
                            envio = 22;
                        } else if (precioMasIva < 299) {
                            envio = 32;
                        } else if (precioMasIva < 499) {
                            envio = 40;
                        } else if (precioMasIva < 1000) {
                            envio = 65;
                        } else if (precioMasIva > 1000) {
                            envio = 110;
                        }
                    }
                } else if (pais == "PORTUGAL") {
                    if (azoresYmadeira) {
                        if (precioMasIva < 50) {
                            envio = 70;
                        } else if (precioMasIva < 149) {
                            envio = 90;
                        } else if (precioMasIva < 299) {
                            envio = 130;
                        } else if (precioMasIva < 499) {
                            envio = 190;
                        } else if (precioMasIva < 1000) {
                            envio = 260;
                        } else if (precioMasIva > 1000) {
                            envio = 320;
                        }
                    } else {
                        if (precioMasIva < 50) {
                            envio = 10;
                        } else if (precioMasIva < 149) {
                            envio = 13;
                        } else if (precioMasIva < 299) {
                            envio = 16;
                        } else if (precioMasIva < 499) {
                            envio = 20;
                        } else if (precioMasIva < 1000) {
                            envio = 30;
                        } else if (precioMasIva > 1000) {
                            envio = 0;
                        }
                    }
                }

            }

            suma = (parseFloat(precio) + parseFloat(recargo) + parseFloat(iva) + parseFloat(envio));

            if (canarias) {
                suma += (suma => 3000 ? parseFloat(suplementoDua) : 0);
                $('#liGestionDua').show();
            } else if (ceutaYmelilla) {
                suma += parseFloat(suplementoDua);
                $('#liGestionDua').show();
            } else {
                suplementoDua = 0;
                $('#liGestionDua').hide();
            }

            var strSuma = suma.toFixed(2).replace(".", ",");

            // console.log(precio + " + " + recargo + " + " + iva + " + " + envio);
            $("#gestionDua").text(suplementoDua.toFixed(2).replace(".", ","));
            $("#envio").text(envio.toFixed(2).replace(".", ","));
            $("#recargo").text(recargo.toFixed(2).replace(".", ","));
            $("#iva").text(iva.toFixed(2).replace(".", ","));
            $('#total').val(suma.toFixed(2).replace(".", ""));
            $('#totalAmount').text(strSuma);
            $('#strTotal').val(strSuma);
        }

        $('#input-privacidad').on('click', function() {
            var amount = $('#total').val();
            var order = $('input[name=nPedido]').val();
            var paymethod = $('input[name=metodoPago]:checked').val();
            if ($('#input-privacidad').is(':checked') && $('#input-intelectual').is(':checked')) {
                $.ajax({ //Peticion de ajax
                    method: "POST",
                    url: "redsysParametros.php",
                    data: {
                        amount: amount,
                        paymethod: paymethod,
                        order: order
                    }
                }).done(function(response) {
                    // console.log("re1=" + response);

                    var params = response.split(' ')[0];
                    var firma = response.split(' ')[1];

                    $('input[name=Ds_MerchantParameters]').val(params);
                    $('input[name=Ds_Signature]').val(firma);
                });
            }
        });

        $('#input-intelectual').on('click', function() {
            var amount = $('#total').val();
            var order = $('input[name=nPedido]').val();
            var paymethod = $('input[name=metodoPago]:checked').val();
            if ($('#input-privacidad').is(':checked') && $('#input-intelectual').is(':checked')) {
                $.ajax({ //Peticion de ajax
                    method: "POST",
                    url: "redsysParametros.php",
                    data: {
                        amount: amount,
                        paymethod: paymethod,
                        order: order
                    }
                }).done(function(response) {
                    // console.log("re2=" + response);

                    var params = response.trim().split(' ')[0];
                    var firma = response.trim().split(' ')[1];

                    $('input[name=Ds_MerchantParameters]').val(params);
                    $('input[name=Ds_Signature]').val(firma);
                });
            }
        });
    </script>

    <?php /*} else {
    header("Location: 404");
}*/
    ?>