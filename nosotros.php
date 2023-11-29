<?php require_once('includes/config.php');
include("funciones/functions.php");
include('classes/AES.php');
include("assets/_partials/codigo-idiomas.php");
 ?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= buscarTexto("WEB", "index", "nost_title_seo", "", $_SESSION['idioma']); ?></title>
    <meta name="description" content="<?= buscarTexto("WEB", "nosotros", "nost_description_seo", "", $_SESSION['idioma']); ?>">
    <link rel="canonical" href="https://personalizacionestextiles.com/nosotros">
    <meta property="og:locale" content="es_ES">
    <meta property="og:site_name" content="personalizacionestextiles" />
    <meta property="og:url" content="https://personalizacionestextiles.com/nosotros" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?= buscarTexto("WEB", "nosotros", "nost_og:title_seo", "", $_SESSION['idioma']); ?>" />
    <meta property="og:description" content="<?= buscarTexto("WEB", "nosotros", "nost_og:description_seo", "", $_SESSION['idioma']); ?>" />
    <meta property="og:image" content="https://personalizacionestextiles.com/images/logo.png" />

    <?php
    include("assets/_partials/header.php");
    ?>

    <main>
        <div class="slider-area pb-5">
            <div class="single-slider slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h1 class="title-product"><?= buscarTexto("WEB", "nosotros", "nost_tit-principal", "", $_SESSION['idioma']); ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="about_us p-lr-30">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="about_us_content">
                            <h5><?= buscarTexto("WEB", "nosotros", "nost_tit-mision", "", $_SESSION['idioma']); ?></h5>
                            <h3 class=" txt-alineado"><?= buscarTexto("WEB", "nosotros", "nost_text-mision", "", $_SESSION['idioma']); ?></h3>
                            <p class=" txt-alineado"><?= buscarTexto("WEB", "nosotros", "nost_text-p", "", $_SESSION['idioma']); ?></p>

                            <div class="about_us_video text-center">
                                <img src="imagenes/1.png" alt="<?= buscarTexto("WEB", "nosotros", "alt-youtube", "", $_SESSION['idioma']); ?>" class="img-fluid">
                                <a target="_blank" class="about_video_icon popup-youtube" href="https://www.youtube.com/watch?v=RwJ2_XK_TGc"></a>
                            </div>
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
                                <a href="hazte-cliente" class="btn"><?= buscarTexto("WEB", "nosotros", "nost_btn-Cta", "", $_SESSION['idioma']); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
        include("assets/_partials/cta-icons.php");
        ?>

        <section class="subscribe_part section_padding curve ">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="subscribe_part_content p-t-40">
                            <p><?= buscarTexto("WEB", "index", "idx_txt-CTA", "", $_SESSION['idioma']); ?></p>
                            <div>
                                <a href="<?= buscarTexto("WEB", "paginas", "contacto", "", $_SESSION['idioma']); ?>" class="btn"><?= buscarTexto("WEB", "index", "idx_btn-contacta", "", $_SESSION['idioma']); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 250">
            <path fill="#191d34" fill-opacity="1" d="M0,128L48,144C96,160,192,192,288,192C384,192,480,160,576,138.7C672,117,768,107,864,138.7C960,171,1056,245,1152,240C1248,235,1344,149,1392,106.7L1440,64L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
        </svg>
    </main>

    <?php
    include("assets/_partials/footer.php");
    ?>