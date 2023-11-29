<?php
//Declaramos la conexion con el servidor de base de datos
use LDAP\Result;
require_once('includes/config.php');
include("funciones/functions.php");
include('classes/AES.php');
include("assets/_partials/codigo-idiomas.php");
if (!$user->is_logged_in()) {
    header('Location: login');
    exit();
}

$email = $nombrecomercial = $nombrefiscal = $intracomunitario = $vatno = $direccion =
    $postal = $pais = $provincia = $poblacion = $telefono = $movil = $actividades = $recargo = $conocido = "";

$sql_ficha = "SELECT * FROM fichaempresametas WHERE email=?";
$query_ficha = $conn_formularios->prepare($sql_ficha);
$query_ficha->bindParam(1, $_SESSION['email'], PDO::PARAM_STR);
$query_ficha->execute();
$results = $query_ficha->fetchAll(PDO::FETCH_OBJ);
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
    <title>Autorización de uso de la propiedad intelectual | Personalizaciones textiles</title>

    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta property="og:locale" content="es_ES">
    <meta property="og:site_name" content="personalizacionestextiles" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://personalizacionestextiles.com/images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon-1.png">
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
        <div class="container p-b-150 p-t-50">
            <div class="row">
                <div class="col-lg-7 mx-auto p-tb-40">
                    <h2 class="text-center mb-5">FORMULARIO DE AUTORIZACIÓN DE USO DE LA PROPIEDAD INTELECTUAL</h2>
                    <div>
                        Don/Doña <strong><?= $nombrecomercial ?></strong>
                        <br>en representación de <strong><?= $nombrefiscal ?></strong>
                        <br>con C.I.F, nº <strong><?= $vatno ?></strong>
                        <br>y domicilio en <strong><?= $direccion ?>, <?= $pais ?>, <?= $provincia ?>,
                            <?= $poblacion ?>, <?= $postal ?></strong>
                    </div>
                    <div>
                        <br>Declara que el pedido encargado a la compañía <strong>Borman Industria Textil, S.L.</strong>,
                        con C.I.F. <strong>B99117996</strong> para la fabricación de<br>
                        <strong><?= $_POST['cantidad_diseno'] ?>uds:</strong><br>
                        <img class="img-fluid mx-auto" src="imagenes_bocetos/D<?= $_POST['id_diseno'] ?>.jpg"><br>
                    </div>

                    <div>
                        se realiza bajo su entera responsabilidad en todo lo relacionado con la propiedad intelectual,
                        debido a que posee todos los registros y/o autorizaciones necesarias para la reproducción y/o uso
                        del logo, marca o diseño encargado.
                    </div>
                    <div>
                        <div class="txt-alineado">
                            <h4 class="mb-20 mt-50">Le recordamos nuestros <a target="__blank" style="color:#00953E" href="entrega-y-gastos-de-envio">plazos de entrega</a> por sistema: </h4>
                            <h5><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tit-th-30-dias", "", $_SESSION['idioma']); ?></h5>
                            <p><?= buscarTexto("PRG", "envios", "1", "descripcion", $_SESSION['idioma']); ?></p>

                            <h5><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tit-th-15dias", "", $_SESSION['idioma']); ?></h5>
                            <p><?= buscarTexto("PRG", "envios", "2", "descripcion", $_SESSION['idioma']); ?></p>

                            <h5><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tit-th-bases", "", $_SESSION['idioma']); ?></h5>
                            <p><?= buscarTexto("PRG", "envios", "3", "descripcion", $_SESSION['idioma']); ?></p>
                        </div>
                    </div>


                    <br>Fecha: <span id="spanfecha"></span>

                    <div class="form-group">
                        <form action="DAOs/acepta-propiedadDAO.php" method="POST">
                            <div class="mt-3 mb-3 form-check">
                                <label class="form-check-label" for="propiedad_intelectual">
                                    <input type="checkbox" class="form-check-input" id="propiedad_intelectual" name="propiedad_intelectual" required>
                                    Autoriza a la compañía <strong>Borman Industria Textil, S.L.</strong>, con C.I.F. <strong>B99117996</strong>
                                    a la utilización de dicho logo, marca o diseño para la realización del pedido encargado.
                                </label>
                            </div>
                            <input name="id_diseno" value="<?= $_POST['id_diseno'] ?>" hidden>
                            <button class="btn" id="btnPropiedad" type="submit" disabled>
                                Enviar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
    <script src="./assets/js/historial-disenos.js"></script>
    <script src="./assets/js/carrito.js"></script>
    <script>
        // Obtenemos la fecha actual
        const fecha = new Date();

        const language = "<?= strtolower($_SESSION['idioma']) ?>";
        // Configuramos el formateador de fecha en el idioma correspondiente
        const options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        const dateFormater = new Intl.DateTimeFormat(language, options);

        // Formateamos la fecha
        const fechaFormateada = dateFormater.format(fecha);

        // Mostramos la fecha en el elemento HTML
        document.getElementById("spanfecha").textContent = fechaFormateada;
    </script>

    <script>
        // Obtén una referencia al checkbox y al botón
        const checkbox = document.getElementById("propiedad_intelectual");
        const boton = document.getElementById("btnPropiedad");

        // Escucha el evento "change" del checkbox
        checkbox.addEventListener("change", function() {
            // Si el checkbox está marcado, habilita el botón; de lo contrario, desactívalo.
            if (checkbox.checked) {
                boton.disabled = false;
            } else {
                boton.disabled = true;
            }
        });
    </script>
</body>

</html>