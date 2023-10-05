<?php
require_once "includes/config.php";
include("funciones/functions.php");

require_once "assets/_partials/idioma.php";
 ?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= buscarTexto("WEB", "formas-de-pago", "fdp_title_seo", "", $_SESSION['idioma']); ?></title>
    <meta name="description" content="<?= buscarTexto("WEB", "formas-de-pago", "fdp_description_seo", "", $_SESSION['idioma']); ?>">
    <link rel="canonical" href="https://personalizacionestextiles.com/formas-de-pago">
    <meta property="og:locale" content="es_ES">
    <meta property="og:site_name" content="personalizacionestextiles" />
    <meta property="og:url" content="https://personalizacionestextiles.com/formas-de-pago" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?= buscarTexto("WEB", "formas-de-pago", "fdp_og:title_seo", "", $_SESSION['idioma']); ?>" />
    <meta property="og:description" content="<?= buscarTexto("WEB", "formas-de-pago", "fpd_og:description_seo", "", $_SESSION['idioma']); ?>" />
    <meta property="og:image" content="https://personalizacionestextiles.com/images/logo.png" />

    <?php
    include("assets/_partials/header.php");
    ?>

    <div class="single-slider slider-height2 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h1 class="title-product"><?= buscarTexto("WEB", "formas-de-pago", "fdp_tit-principal", "", $_SESSION['idioma']); ?></h1>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="privacy section pt-0">
        <div class="container">
            <div class="block p-lr-30">
                <div id="datos" class="policy-item">
                    <!-- <div class="title mb-20">
                        <h3><?= buscarTexto("WEB", "formas-de-pago", "fdp_tit-secundario", "", $_SESSION['idioma']); ?></h3>
                    </div> -->

                    <div class="policy-details txt-alineado">
                        <p><?= buscarTexto("WEB", "formas-de-pago", "fdp_p1-secundario", "", $_SESSION['idioma']); ?></p>
                        <p><?= buscarTexto("WEB", "formas-de-pago", "fdp_p2-secundario", "", $_SESSION['idioma']); ?></p>
                        <p><?= buscarTexto("WEB", "formas-de-pago", "fdp_p3-secundario", "", $_SESSION['idioma']); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    include("assets/_partials/footer.php");
    ?>