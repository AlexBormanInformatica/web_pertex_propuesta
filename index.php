<?php

/**
 * @author Ana Molina
 * @author Alexandra Serrano 
 * 2022
 */
require_once('includes/config.php');

include("functions.php");
include("includes/idioma.php");
if (!isset($_SESSION['resultadoTraduccionPertex'])) {
    $_SESSION['resultadoTraduccionPertex'] = llamadoInicial($_SESSION['idioma']);
}
?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= buscarTexto("WEB", "index", "idx_tit_seo", "", $_SESSION['idioma']); ?></title>
    <meta name="description" content="<?= buscarTexto("WEB", "index", "idx_description_seo", "", $_SESSION['idioma']); ?>">
    <link rel="canonical" href="https: //personalizacionestextiles.com">

    <meta property="og:locale" content="es_ES">
    <meta property="og:site_name" content="personalizacionestextiles" />
    <meta property="og:url" content="https://personalizacionestextiles.com" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?= buscarTexto("WEB", "index", "idx_og:title_seo", "", $_SESSION['idioma']); ?>" />
    <meta property="og:description" content="<?= buscarTexto("WEB", "index", "idx_og:description_seo", "", $_SESSION['idioma']); ?>" />
    <meta property="og:image" content="https://personalizacionestextiles.com/images/logo.png" />
    <?php include("assets/_partials/header.php"); ?>


    <div class="container-fluid p-0 ">
        <div class="bg-img-22 p-0">
            <div class="row v-escr">
                <div class="col-lg-6">
                    <img class="img-fluid" src="assets/img/img-pertex.png" alt="">
                </div>

                <div class="col-lg-6">
                    <div class="hero-cap-title">
                        <h1 class="title-legal"><?= buscarTexto("WEB", "index", "idx_tit-principal", "", $_SESSION['idioma']); ?></h1>
                    </div>

                    <p class="txt-p-title mb-15"><?= buscarTexto("WEB", "index", "idx_description_seo", "", $_SESSION['idioma']); ?></p>

                    <div class="pb-80 btn-indx">
                        <a href="<?= buscarTexto("WEB", "paginas", "ptp", "", $_SESSION['idioma']); ?>" class="btn btn-lg "><?= buscarTexto("WEB", "index", "idx_btn-personalizar", "", $_SESSION['idioma']); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="d-none d-sm-none d-md-block bg-img-22 ">
        <div class="container">
            <div class="row ">
                <div class="col-lg-12">
                    <div class=" text-center">
                        <h2 class="title-2 pb-50"><?= buscarTexto("WEB", "index", "idx_tit-tecnicas", "", $_SESSION['idioma']); ?></h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <article class="col-lg-fichas">
                    <div class="p-tb-25 shadow p-all-40  caja-height ">
                        <div class="row mb-30">
                            <img class=" m-r-30" src="assets/img/tecnicas/1-8.png" alt="<?= buscarTexto("WEB", "index", "idx_tit-marcajes", "", $_SESSION['idioma']); ?>">
                            <h2 class="p-b-25"><?= buscarTexto("WEB", "index", "idx_tit-marcajes", "", $_SESSION['idioma']); ?></h2>
                        </div>

                        <p class="fs-18 "><?= buscarTexto("WEB", "index", "idx_text-marcajes", "", $_SESSION['idioma']); ?></p>
                        <a href="<?= buscarTexto("WEB", "paginas", "marcajes", "", $_SESSION['idioma']); ?>" class="btn hero-btn"><?= buscarTexto("WEB", "index", "idx_btn-info", "", $_SESSION['idioma']); ?></a>
                    </div>
                </article>

                <article class="col-lg-fichas">
                    <div class="p-tb-25 shadow p-all-40 caja-height  ">
                        <div class="row mb-30">
                            <img class=" m-r-30" src="assets/img/tecnicas/1-3.png" alt="<?= buscarTexto("WEB", "index", "idx_tit-etiquetas", "", $_SESSION['idioma']); ?>">
                            <h2 class="p-b-25"><?= buscarTexto("WEB", "index", "idx_tit-etiquetas", "", $_SESSION['idioma']); ?></h2>
                        </div>

                        <p class="fs-18 "><?= buscarTexto("WEB", "index", "idx_text-etiquetas", "", $_SESSION['idioma']); ?></p>
                        <a href="<?= buscarTexto("WEB", "paginas", "etiquetas", "", $_SESSION['idioma']); ?>" class="btn hero-btn"><?= buscarTexto("WEB", "index", "idx_btn-info", "", $_SESSION['idioma']); ?></a>
                    </div>
                </article>
            </div>

            <div class="row mt-50">
                <article class="col-lg-fichas ">
                    <div class="p-tb-25 shadow p-all-40 caja-height ">
                        <div class="row mb-30">
                            <img class=" m-r-30" src="assets/img/tecnicas/3-galeria.png" alt="<?= buscarTexto("WEB", "index", "idx_tit-modulos", "", $_SESSION['idioma']); ?>">
                            <h2 class="p-b-25"><?= buscarTexto("WEB", "index", "idx_tit-modulos", "", $_SESSION['idioma']); ?></h2>
                        </div>

                        <p class="fs-18"><?= buscarTexto("WEB", "index", "idx_text-modulos", "", $_SESSION['idioma']); ?></p>
                        <a href="<?= buscarTexto("WEB", "paginas", "modulos", "", $_SESSION['idioma']); ?>" class="btn hero-btn"><?= buscarTexto("WEB", "index", "idx_btn-info", "", $_SESSION['idioma']); ?></a>
                    </div>
                </article>

                <article class="col-lg-fichas ">
                    <div class="p-tb-25 shadow p-all-40 caja-height ">
                        <div class="row mb-30">
                            <img class=" m-r-30" src="assets/img/tecnicas/5-galeria.png" alt="<?= buscarTexto("WEB", "index", "idx_tit-tiradores", "", $_SESSION['idioma']); ?>">
                            <h2 class="p-b-25"><?= buscarTexto("WEB", "index", "idx_tit-tiradores", "", $_SESSION['idioma']); ?></h2>
                        </div>

                        <p class="fs-18"><?= buscarTexto("WEB", "index", "idx_text-modulos", "", $_SESSION['idioma']); ?></p>
                        <a href="<?= buscarTexto("WEB", "paginas", "tiradores", "", $_SESSION['idioma']); ?>" class="btn hero-btn"><?= buscarTexto("WEB", "index", "idx_btn-info", "", $_SESSION['idioma']); ?></a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!--           Sección area técnicas   -->
    <section class="d-block d-sm-block">


        <div id="carouselExampleIndicators" class="carousel slide mobilslider" data-ride="carousel">
            <div class="container ">
                <div class="row ">
                    <div class="col-lg-12">
                        <div class=" text-center">
                            <h2 class="title-2 pb-50"><?= buscarTexto("WEB", "index", "idx_tit-tecnicas", "", $_SESSION['idioma']); ?></h2>
                        </div>
                    </div>
                </div>
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                </ol>

                <div class="carousel-inner">
                    <div class="carousel-item active p-all-30">
                        <div class="row">
                            <div class="col-lg-6 ">
                                <div class="text-center ">
                                    <a href="<?= buscarTexto("WEB", "paginas", "marcajes", "", $_SESSION['idioma']); ?>"><img src="assets/img/carrousel/1-8.png" alt="<?= buscarTexto("WEB", "index", "idx_tit-marcajes", "", $_SESSION['idioma']); ?>"></a>
                                </div>
                            </div>

                            <div class="col-lg-6 text-center h-200">
                                <div class="p-t-25 ">
                                    <h2 class="p-b-25"><?= buscarTexto("WEB", "index", "idx_tit-marcajes", "", $_SESSION['idioma']); ?></h2>
                                    <p class="fs-18 txt-alineado "><?= buscarTexto("WEB", "index", "idx_text-marcajes", "", $_SESSION['idioma']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item p-all-30">
                        <div class="row">
                            <div class="col-lg-6 ">
                                <div class="text-center">
                                    <a href="<?= buscarTexto("WEB", "paginas", "etiquetas", "", $_SESSION['idioma']); ?>"><img src="assets/img/carrousel/1-3.png" alt="<?= buscarTexto("WEB", "index", "idx_tit-etiquetas", "", $_SESSION['idioma']); ?>"></a>
                                </div>
                            </div>
                            <div class="col-lg-6 text-center h-200">
                                <div class="p-t-25 ">
                                    <h2 class="p-b-25"><?= buscarTexto("WEB", "index", "idx_tit-etiquetas", "", $_SESSION['idioma']); ?></h2>
                                    <p class="fs-18 txt-alineado"><?= buscarTexto("WEB", "index", "idx_text-etiquetas", "", $_SESSION['idioma']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item p-all-30">
                        <div class="row">
                            <div class="col-lg-6 ">
                                <div class=" text-center">
                                    <a href="<?= buscarTexto("WEB", "paginas", "modulos", "", $_SESSION['idioma']); ?>"><img src="assets/img/carrousel/3-galeria.png" alt="<?= buscarTexto("WEB", "index", "idx_tit-modulos", "", $_SESSION['idioma']); ?>"></a>
                                </div>
                            </div>
                            <div class="col-lg-6 text-center h-200">
                                <div class="p-t-25 ">
                                    <h2 class="p-b-25"><?= buscarTexto("WEB", "index", "idx_tit-modulos", "", $_SESSION['idioma']); ?></h2>
                                    <p class="fs-18 txt-alineado"><?= buscarTexto("WEB", "index", "idx_text-modulos", "", $_SESSION['idioma']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item p-all-30">
                        <div class="row">
                            <div class="col-lg-6 ">
                                <div class="text-center">
                                    <a href="<?= buscarTexto("WEB", "paginas", "tiradores", "", $_SESSION['idioma']); ?>"><img src="assets/img/carrousel/5-galeria.png" alt="<?= buscarTexto("WEB", "index", "idx_tit-tiradores", "", $_SESSION['idioma']); ?>"></a>
                                </div>
                            </div>

                            <div class="col-lg-6 text-center h-200">
                                <div class=" p-t-25 ">
                                    <h2 class="p-b-25"><?= buscarTexto("WEB", "index", "idx_tit-tiradores", "", $_SESSION['idioma']); ?></h2>
                                    <p class="fs-18 txt-alineado"><?= buscarTexto("WEB", "index", "idx_text-tiradores", "", $_SESSION['idioma']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only"></span>
                </a>

                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only"></span>
                </a>
            </div>
        </div>
    </section>
    <!--  Fin Sección area técnicas   -->

    <section class="section_padding p-t-100 p-b-80 bg-img-22">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <div class="feature_part_tittle p-all-40">
                        <h3 class="mb-5 "><?= buscarTexto("WEB", "index", "idx_tit_muestrario", "", $_SESSION['idioma']); ?></h3>
                        <p class="text-cont txt-alineado "><?= buscarTexto("WEB", "index", "idx_text-muestrario", "", $_SESSION['idioma']); ?></p>
                        <a href="<?= buscarTexto("WEB", "paginas", "contacto", "", $_SESSION['idioma']); ?>" class="btn btn-lg "><?= buscarTexto("WEB", "index", "idx_btn-muestrario", "", $_SESSION['idioma']); ?></a>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="">
                        <div class="text-center mb-5">
                            <img alt="<?= buscarTexto("WEB", "infografico", "alt-1", "", $_SESSION['idioma']); ?>" src="iconos/proceso-pedido/PASO-1.png" class="mb-3" width="200px">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Fin  Sección información  -->

    <!-- Sección CTA pedidos -->
    <div class="best-product-area lf-padding bg-pedidos  color-change-2x ">
        <div class="product-wrapper bg-height" style="background-image: url('')">
            <div class="container position-relative reveal rtol">
                <div class="row justify-content-between align-items-end">
                    <div class="product-man position-absolute  d-none d-lg-block">
                        <img src="iconos/proceso-pedido/PASO-6.png" alt="<?= buscarTexto("WEB", "inforgrafico", "alt-6", "", $_SESSION['idioma']); ?>">
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 d-none d-lg-block pb-2">
                        <div class="vertical-text">
                            <span><?= buscarTexto("WEB", "index", "idx_tit-pedidos", "", $_SESSION['idioma']); ?></span>
                        </div>
                    </div>

                    <div class="col-xl-7 col-lg-7">
                        <div class="best-product-caption">
                            <h2><?= buscarTexto("WEB", "index", "idx_subtit1_pedidos", "", $_SESSION['idioma']); ?></h2>
                            <h2><?= buscarTexto("WEB", "index", "idx_subtit2_pedidos", "", $_SESSION['idioma']); ?></h2>
                            <p><?= buscarTexto("WEB", "index", "idx_text-pedidos", "", $_SESSION['idioma']); ?></p>
                            <a href="<?= buscarTexto("WEB", "paginas", "ptp", "", $_SESSION['idioma']); ?>" class="btn"><?= buscarTexto("WEB", "index", "idx_btn-pedido", "", $_SESSION['idioma']); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Sección CTA pedidos -->

    <!--    Sección  información -->
    <section class="bg-img-22">
        <div class="container">
            <div class="row text-center cta-muestra ">
                <div class="col-lg-10 mx-auto">
                    <div class="img-muestr">
                        <img src="imagenes/dots.svg">
                    </div>

                    <div class="p-tb-100 caja-height-up ">
                        <h2 class="text-white txt-muestrario mb-3"><?= buscarTexto("WEB", "index", "idx_info-tit1", "", $_SESSION['idioma']); ?></h2>
                        <p class="text-muestrario-p "> <?= buscarTexto("WEB", "index", "idx_info-p1", "", $_SESSION['idioma']); ?> </p>
                        <a href="<?= buscarTexto("WEB", "paginas", "muestrario", "", $_SESSION['idioma']); ?>" class="btn btn-lg "><?= buscarTexto("WEB", "index", "idx_info-a1", "", $_SESSION['idioma']); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="feature_part section_padding">
        <div class="container  p-rl-30">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <div class="feature_part_tittle p-all-30 ">
                        <h3 class="txt-alineado"><?= buscarTexto("WEB", "nosotros", "nost_text_precios", "", $_SESSION['idioma']); ?></h3>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="feature_part_content p-all-30">
                        <p><?= buscarTexto("WEB", "nosotros", "nost_txt-CTA-2", "", $_SESSION['idioma']); ?></p>
                        <div class="mx-auto">
                            <a  href="hazte-cliente" class="btn"><?= buscarTexto("WEB", "nosotros", "nost_btn-Cta", "", $_SESSION['idioma']); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="p-icons bg-color-cta">
        <div class=" row justify-content-center">
            <div class="col-6 col-lg-3 col-md-6 ">
                <div class="single_feature_part">
                    <img src="iconos/compra-segura.png" alt="<?= buscarTexto("WEB", "index", "alt-compra-segura", "", $_SESSION['idioma']); ?>">
                    <h4 class="mb-3"><?= buscarTexto("WEB", "nosotros", "nost_icono-1", "", $_SESSION['idioma']); ?></h4>
                </div>
            </div>

            <div class=" col-6 col-lg-3 col-md-6">
                <div class="single_feature_part">
                    <img src="iconos/compra-online.png" alt="<?= buscarTexto("WEB", "index", "alt-compra-online", "", $_SESSION['idioma']); ?>">
                    <h4 class="mb-3"><?= buscarTexto("WEB", "nosotros", "nost_icono-2", "", $_SESSION['idioma']); ?></h4>
                </div>
            </div>

            <div class="col-6 col-lg-3 col-md-6">
                <div class="single_feature_part">
                    <img src="iconos/calidad-y-confianza.png" alt="<?= buscarTexto("WEB", "index", "alt-calidad", "", $_SESSION['idioma']); ?>">
                    <h4 class="mb-3"><?= buscarTexto("WEB", "nosotros", "nost_icono-3", "", $_SESSION['idioma']); ?></h4>
                </div>
            </div>

            <div class="col-6 col-lg-3 col-md-6 ">
                <div class="single_feature_part">
                    <img src="iconos/clientes-satisfechos.png" alt="<?= buscarTexto("WEB", "index", "alt-satisfechos", "", $_SESSION['idioma']); ?>">

                    <h4 class="mb-3"><?= buscarTexto("WEB", "nosotros", "nost_icono-4", "", $_SESSION['idioma']); ?></h4>
                </div>
            </div>
        </div>
    </section>

    <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#191d34" fill-opacity="1" d="M0,128L60,154.7C120,181,240,235,360,218.7C480,203,600,117,720,101.3C840,85,960,139,1080,181.3C1200,224,1320,256,1380,272L1440,288L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path></svg> -->
    <section class="subscribe_part section_padding curve ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="subscribe_part_content p-tb-40">
                        <p><?= buscarTexto("WEB", "index", "idx_txt-CTA", "", $_SESSION['idioma']); ?></p>
                        <div>
                            <a href="<?= buscarTexto("WEB", "paginas", "contacto", "", $_SESSION['idioma']); ?>" class="btn"><?= buscarTexto("WEB", "index", "idx_btn-contacta", "", $_SESSION['idioma']); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <?php
    include("assets/_partials/footer.php");
    ?>