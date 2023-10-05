<?php
require_once('includes/config.php');
include("funciones/functions.php");

require_once "assets/_partials/idioma.php";
 ?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= buscarTexto("WEB", "bases-tela-y-velcro", "bases_title_seo", "", $_SESSION['idioma']); ?></title>
    <meta name="description" content="<?= buscarTexto("WEB", "bases-tela-y-velcro", "bases_description_seo", "", $_SESSION['idioma']); ?>">
    <link rel="canonical" href="https://personalizacionestextiles.com/bases-tela-y-cierre">
    <meta property="og:locale" content="es_ES">
    <meta property="og:site_name" content="personalizacionestextiles" />
    <meta property="og:url" content="https://personalizacionestextiles.com/bases-tela-y-cierre" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?= buscarTexto("WEB", "bases-tela-y-velcro", "bases_og:title_seo", "", $_SESSION['idioma']); ?>" />
    <meta property="og:description" content="<?= buscarTexto("WEB", "bases-tela-y-velcro", "bases_og:description_seo", "", $_SESSION['idioma']); ?>" />
    <meta property="og:image" content="https://personalizacionestextiles.com/images/logo.png" />

    <?php
    include("assets/_partials/header.php");
    ?>

    <main>
        <div class="single-slider slider-height2 d-flex align-items-center bg-dark" data-background="imagenes/banner-bases.png" style="background-image: url(&quot;imagenes/banner-marcajes.png&quot;);">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h1 class="title-product overflow-hidden"><?= buscarTexto("WEB", "bases-tela-y-velcro", "bases_tit-principal", "", $_SESSION['idioma']); ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="bg0">
            <div class="container">
                <div class="row  p-all-40">
                    <div class="section-top-border">
                        <div class="row model-product p-lr-10">
                            <div class="col-md-3 ">
                                <img class="img-fluid" src="imagenes/base-tela.png" alt="<?= buscarTexto("WEB", "bases-tela-y-cierre", "alt-tela", "", $_SESSION['idioma']); ?>">
                            </div>

                            <div class="col-md-8 mt-sm-20">
                                <h2 class="mb-30"><?= buscarTexto("PRG", "productos", 43, "nombre", $_SESSION['idioma']); ?></h2>
                                <h4 class="card-text mb-3 txt-alineado"><?= buscarTexto("PRG", "productos", 43, "desc_corta", $_SESSION['idioma']); ?></h4>
                                <p class="card-text txt-alineado"><?= buscarTexto("PRG", "productos", 43, "desc_larga", $_SESSION['idioma']); ?></p>
                                <div class="mayus overflow-hidden"><strong><?= buscarTexto("WEB", "bases-tela-y-velcro", "bases_subtit", "", $_SESSION['idioma']); ?></strong><br></div>
                                <ul>
                                    <li><strong><?= buscarTexto("PRG", "productos", 22, "nombre", $_SESSION['idioma']); ?>: </strong><?= buscarTexto("PRG", "productos", 43.1, "desc_larga", $_SESSION['idioma']); ?></li>
                                    <li><strong> <?= buscarTexto("PRG", "productos", 24, "nombre", $_SESSION['idioma']); ?>: </strong> <?= buscarTexto("PRG", "productos", 43.2, "desc_larga", $_SESSION['idioma']); ?></li>
                                    <li><strong> <?= buscarTexto("PRG", "productos", 25, "nombre", $_SESSION['idioma']); ?>: </strong> <?= buscarTexto("PRG", "productos", 43.3, "desc_larga", $_SESSION['idioma']); ?></li>
                                    <li><strong> <?= buscarTexto("PRG", "productos", 23, "nombre", $_SESSION['idioma']); ?>: </strong><?= buscarTexto("PRG", "productos", 43.4, "desc_larga", $_SESSION['idioma']); ?></li>
                                    <li><strong> <?= buscarTexto("PRG", "productos", 27, "nombre", $_SESSION['idioma']); ?>: </strong><?= buscarTexto("PRG", "productos", 43.5, "desc_larga", $_SESSION['idioma']); ?></li>
                                    <li><strong> <?= buscarTexto("PRG", "productos", 28, "nombre", $_SESSION['idioma']); ?>: </strong> <?= buscarTexto("PRG", "productos", 43.6, "desc_larga", $_SESSION['idioma']); ?></li>
                                    <li><strong> <?= buscarTexto("PRG", "productos", 46, "nombre", $_SESSION['idioma']); ?>: </strong> <?= buscarTexto("PRG", "productos", 43.66, "desc_larga", $_SESSION['idioma']); ?></li>
                                    <li><strong> <?= buscarTexto("PRG", "productos", 29, "nombre", $_SESSION['idioma']); ?>: </strong> <?= buscarTexto("PRG", "productos", 43.7, "desc_larga", $_SESSION['idioma']); ?></li>
                                    <li><strong> <?= buscarTexto("PRG", "productos", 31, "nombre", $_SESSION['idioma']); ?>: </strong> <?= buscarTexto("PRG", "productos", 43.8, "desc_larga", $_SESSION['idioma']); ?></li>
                                    <li><strong> <?= buscarTexto("PRG", "productos", 32, "nombre", $_SESSION['idioma']); ?>: </strong> <?= buscarTexto("PRG", "productos", 43.9, "desc_larga", $_SESSION['idioma']); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="section-top-border">
                        <div class="row model-product p-lr-10">
                            <div class="col-md-3 ">
                                <img class="img-fluid" src="imagenes/base-cierre.png" alt="<?= buscarTexto("WEB", "bases-tela-y-cierre", "alt-cierre", "", $_SESSION['idioma']); ?>">
                            </div>

                            <div class="col-md-8 mt-sm-20 mb-5">
                                <h2 class="mb-30 overflow-hidden"><?= buscarTexto("PRG", "productos", 44, "nombre", $_SESSION['idioma']); ?></h2>
                                <h4 class="card-text mb-3 overflow-hidden txt-alineado"><?= buscarTexto("PRG", "productos", 44, "desc_corta", $_SESSION['idioma']); ?></h4>
                                <p class="card-text overflow-hidden txt-alineado"><?= buscarTexto("PRG", "productos", 44, "desc_larga", $_SESSION['idioma']); ?></p>
                                <div class="mayus overflow-hidden"><strong><?= buscarTexto("WEB", "bases-tela-y-velcro", "bases_subtit", "", $_SESSION['idioma']); ?></strong><br></div>
                                <ul>
                                    <li><strong><?= buscarTexto("PRG", "productos", 31, "nombre", $_SESSION['idioma']); ?>: </strong><?= buscarTexto("PRG", "productos", 44.1, "desc_larga", $_SESSION['idioma']); ?></li>
                                    <li><strong> <?= buscarTexto("PRG", "productos", 3, "nombre", $_SESSION['idioma']); ?>: </strong> <?= buscarTexto("PRG", "productos", 44.2, "desc_larga", $_SESSION['idioma']); ?></li>
                                    <li><strong> <?= buscarTexto("PRG", "productos", 4, "nombre", $_SESSION['idioma']); ?>: </strong> <?= buscarTexto("PRG", "productos", 44.3, "desc_larga", $_SESSION['idioma']); ?></li>
                                    <li><strong> <?= buscarTexto("PRG", "productos", 5, "nombre", $_SESSION['idioma']); ?>: </strong><?= buscarTexto("PRG", "productos", 44.4, "desc_larga", $_SESSION['idioma']); ?></li>
                                    <li><strong> <?= buscarTexto("PRG", "productos", 7, "nombre", $_SESSION['idioma']); ?>: </strong><?= buscarTexto("PRG", "productos", 44.5, "desc_larga", $_SESSION['idioma']); ?></li>
                                    <li><strong> <?= buscarTexto("PRG", "productos", 34, "nombre", $_SESSION['idioma']); ?>: </strong> <?= buscarTexto("PRG", "productos", 44.6, "desc_larga", $_SESSION['idioma']); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="section-top-border">
                        <div class="row model-product p-lr-10">
                            <div class="col-md-3 ">
                                <img class="img-fluid" src="imagenes/pelo.png" alt="<?= buscarTexto("WEB", "bases-tela-y-cierre", "alt-cierre", "", $_SESSION['idioma']); ?>">
                            </div>

                            <div class="col-md-8 mt-sm-20">
                                <h2 class="mb-30 overflow-hidden"><?= buscarTexto("PRG", "productos", 48, "nombre", $_SESSION['idioma']); ?></h2>
                                <h4 class="card-text mb-3 overflow-hidden txt-alineado"><?= buscarTexto("PRG", "productos", 48, "desc_corta", $_SESSION['idioma']); ?></h4>
                                <p class="card-text overflow-hidden txt-alineado"><?= buscarTexto("PRG", "productos", 48, "desc_larga", $_SESSION['idioma']); ?></p>
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