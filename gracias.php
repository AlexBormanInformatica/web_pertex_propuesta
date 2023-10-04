<?php
require_once('includes/config.php');
include("functions.php");
include("includes/idioma.php");
$_SESSION['resultadoTraduccionPertex'] = llamadoInicial($_SESSION['idioma']);

?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= buscarTexto("WEB", "gracias", "gracias-tit", "", $_SESSION['idioma']); ?> | Personalizaciones textiles</title>
    <meta name="robots" content="noindex, follow">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon-1.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="plugins/fancybox/jquery.fancybox.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/util.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/mi.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-SECVFXMNWB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-SECVFXMNWB');
</script>
</head>

<body>
    <div>
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


        <section class="coming-soon text-center p-t-200">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="block">
                            <div class="p-tb-25 shadow  caja-height-404 p-all-30">
                                <h1 class=" fs-pag m-b-25"><?= buscarTexto("WEB", "gracias", "gracias-tit", "", $_SESSION['idioma']); ?></h1>
                                <h2 class="fs-pag"><?= buscarTexto("WEB", "gracias", "gracias-subtit", "", $_SESSION['idioma']); ?></h2>
                                <p class=" m-t-40"><?= buscarTexto("WEB", "gracias", "gracias-p1", "", $_SESSION['idioma']); ?></p>
                                <a href="." class="btn hero-btn"><?= buscarTexto("WEB", "gracias", "gracias-a", "", $_SESSION['idioma']); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/jquery.slicknav.min.js"></script>
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>
    <script src="./assets/js/jquery.scrollUp.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="./assets/js/plugins.js"></script>
    <script src="plugins/fancybox/jquery.fancybox.min.js"></script>
    <script src="./assets/js/personalizar.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/historial-pedidos.js"></script>
    <script src="./assets/js/direcciones.js"></script>
    <script src="./assets/js/personas-contacto.js"></script>
    <script src="./assets/js/pasarela-pago.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pselect.js@4.0.1/dist/pselect.min.js"></script>
</body>

</html>