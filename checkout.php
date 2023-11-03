<?php
require_once('includes/config.php');
include("funciones/functions.php");
if (!$user->is_logged_in()) {
    header('Location: login');
    exit();
}
$id_nuevo_pedido = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["disenos"]) && isset($_POST["subtotal"])) {
        //Creo el nuevo pedido para tener el número (id)
        $fechaAhora = date("Y-m-d H:i:s", time());
        $sql = "INSERT INTO pedido_envio (fecha) VALUES (?)";
        $sentencia = $conn->prepare($sql);
        $sentencia->bindParam(1, $fechaAhora, PDO::PARAM_STR);
        $sentencia->execute();

        // Obtengo el ID 
        $id_nuevo_pedido = $conn->lastInsertId();

        $idsDisenos = explode(",", $_POST["disenos"]);
        $subtotal = floatval($_POST["subtotal"]);
        // Ahora $idsDisenos es un array con los números de diseño seleccionados.
        // $subtotal contiene el subtotal.
        foreach ($idsDisenos as $idDiseno) {
            // Agrego el numero de pedido a cada diseño
            $sql = "UPDATE disenos SET id_pedido_envio=? WHERE id_diseno=?";
            $sentencia = $conn->prepare($sql);
            $sentencia->bindParam(1, $id_nuevo_pedido, PDO::PARAM_INT);
            $sentencia->bindParam(2, $idDiseno, PDO::PARAM_INT);
            $sentencia->execute();
        }
    } else {
        echo "Datos de diseño no encontrados en la solicitud POST.";
    }
}

$email = $nombrecomercial = $nombrefiscal = $intracomunitario = $vatno = $direccion =
    $postal = $pais = $provincia = $poblacion = $telefono = $movil = $actividades = $recargo = $conocido = "";
$sql = "SELECT * FROM fichaempresametas WHERE idfichaempresa=?";
$query = $conn_formularios->prepare($sql);
$query->bindParam(1, $_SESSION['idfichaempresa'], PDO::PARAM_STR);
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/imprimir.css" media="print">
    <link rel="stylesheet" href="assets/css/util.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/mi.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/formulario-diseno.css">
</head>

<body>
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/logo.png" alt="">
                </div>
            </div>
        </div>
    </div>

    <main>
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

                                    <!-- <label><?= buscarTexto("WEB", "checkout", "checkout_factura", "", $_SESSION['idioma']); ?></label>
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
                                    </div> -->
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="order_box">
                                <h2><?= buscarTexto("WEB", "checkout", "checkout_tit2", "", $_SESSION['idioma']); ?> #<?= $id_nuevo_pedido ?></h2>
                                <ul class="list list_2">
                                    <li>
                                        <a style="cursor:auto" href="#"><?= buscarTexto("WEB", "checkout", "checkout_tit2-li1", "", $_SESSION['idioma']); ?>
                                            <span id="subtotal" val="<?= str_replace(',', '.', $_POST['subtotal']) ?>"><?= str_replace('.', ',', $_POST['subtotal']) ?></span>
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
                                <form id="formulariopago" action="https://sis-t.redsys.es:25443/sis/realizarPago" method="POST">
                                    <!--Datos Redsys-->
                                    <input type="hidden" name="Ds_SignatureVersion" value="HMAC_SHA256_V1" />
                                    <input type="hidden" name="Ds_MerchantParameters" value="" />
                                    <input type="hidden" name="Ds_Signature" value="" />

                                    <!--Otros datos necesarios para la gestión del pedido por nuestra parte-->
                                    <input type="hidden" name="nPedido" value="<?= $id_nuevo_pedido ?>" />
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
    <script src="https://www.google.com/recaptcha/api.js?render=6Le8UoMkAAAAALmqYyAs8L4dBYMQL6N4lhSqvCld"></script>
    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/jquery.scrollUp.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/jquery.slicknav.min.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="./assets/js/cookies.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pselect.js@4.0.1/dist/pselect.min.js"></script>
    <script type="text/javascript" src="https://mottie.github.io/tablesorter/js/jquery.tablesorter.js"></script>
    <script type="text/javascript" src="https://mottie.github.io/tablesorter/js/jquery.tablesorter.widgets.js"></script>
    <script type="text/javascript" src="https://mottie.github.io/tablesorter/addons/pager/jquery.tablesorter.pager.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=reCAPTCHA_site_key"></script>
    <script src="./assets/js/checkout.js"></script>