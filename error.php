<?php
require_once "includes/config.php";
include("functions.php");
include("includes/idioma.php");
if (!isset($_SESSION['resultadoTraduccionPertex'])) {
    $_SESSION['resultadoTraduccionPertex'] = llamadoInicial($_SESSION['idioma']);
} ?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= buscarTexto("WEB", "faq", "faq_title_seo", "", $_SESSION['idioma']); ?></title>


    <?php
    include("assets/_partials/header.php");
    ?>

    <div class="single-slider slider-height2 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h1 class="title-product"><?= buscarTexto("WEB", "respuestaPago", "rp_error", "", $_SESSION['idioma']); ?> <?= $_GET['msg'] ?></h1>
                        <h4 class="title-product"><?= buscarTexto("WEB", "error", "error_txt", "", $_SESSION['idioma']); ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include("assets/_partials/footer.php");
    ?>