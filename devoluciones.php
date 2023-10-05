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
    <title><?= buscarTexto("WEB", "devoluciones", "dv_title_seo", "", $_SESSION['idioma']); ?></title>
    <meta name="description" content="<?= buscarTexto("WEB", "devoluciones", "seo_description", "", $_SESSION['idioma']); ?>">
    <link rel="canonical" href="https://personalizacionestextiles.com/devolucione/">
    <meta property="og:locale" content="es_ES">
    <meta property="og:site_name" content="personalizacionestextiles" />
    <meta property="og:url" content="https://personalizacionestextiles.com/devoluciones" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?= buscarTexto("WEB", "bases-tela-y-velcro", "dv_title_seo", "", $_SESSION['idioma']); ?>" />
    <meta property="og:description" content="<?= buscarTexto("WEB", "bases-tela-y-velcro", "seo_description", "", $_SESSION['idioma']); ?>" />
    <meta property="og:image" content="https://personalizacionestextiles.com/images/logo.png" />

    <?php
    include("assets/_partials/header.php");
    ?>

    <div class="single-slider slider-height2 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h1 class="title-product"><?= buscarTexto("WEB", "devoluciones", "dv_tit-principal", "", $_SESSION['idioma']); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="privacy section pt-0">
        <div class="container">
            <div class="block">
                <div id="datos" class="policy-item p-lr-30">
                    <div class="title mb-20">
                    </div>

                    <!-- <h4 class="mb-20"><?= buscarTexto("WEB", "devoluciones", "dv_tit-secundario", "", $_SESSION['idioma']); ?></h4> -->
                    <div class="policy-details txt-alineado">
                        <p><?= buscarTexto("WEB", "devoluciones", "dv_p1", "", $_SESSION['idioma']); ?> <a href="mailto:ventas@personalizacionestextiles.com" class="links fs-16"><?= buscarTexto("WEB", "devoluciones", "dv_p1-c", "", $_SESSION['idioma']); ?></a></p>
                        <p><?= buscarTexto("WEB", "devoluciones", "dv_p1.1", "", $_SESSION['idioma']); ?></p>
                        <p><?= buscarTexto("WEB", "devoluciones", "dv_p2", "", $_SESSION['idioma']); ?></p>
                        <p><?= buscarTexto("WEB", "devoluciones", "dv_p3", "", $_SESSION['idioma']); ?></p>
                        <p><?= buscarTexto("WEB", "devoluciones", "dv_p4", "", $_SESSION['idioma']); ?></p>
                        <p><?= buscarTexto("WEB", "devoluciones", "dv_p5", "", $_SESSION['idioma']); ?></p>
                        <p><?= buscarTexto("WEB", "devoluciones", "dv_p6", "", $_SESSION['idioma']); ?></p>
                        <p><?= buscarTexto("WEB", "devoluciones", "dv_p7", "", $_SESSION['idioma']); ?></p>
                        <a href="assets/formularios/<?= strtolower($_SESSION['idioma']) ?>/borman-<?= buscarTexto("WEB", "devoluciones", "desistimiento", "", $_SESSION['idioma']); ?>.docx" download class="btn"><?= buscarTexto("WEB", "devoluciones", "dv_btn-form", "", $_SESSION['idioma']); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    include("assets/_partials/footer.php");
    ?>