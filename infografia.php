<?php
require_once('includes/config.php');
include("funciones/functions.php");
include('classes/AES.php');
include("assets/_partials/codigo-idiomas.php");
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= buscarTexto("WEB", "infografia", "info_title_seo", "", $_SESSION['idioma']); ?></title>
    <meta name="description" content="<?= buscarTexto("WEB", "infografia", "info_description_seo", "", $_SESSION['idioma']); ?>">
    <link rel="canonical" href="https://personalizacionestextiles.com/infografia">
    <meta property="og:locale" content="es_ES">
    <meta property="og:site_name" content="personalizacionestextiles" />
    <meta property="og:url" content="https://personalizacionestextiles.com/infografia" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?= buscarTexto("WEB", "infografia", "info_og:title_seo", "", $_SESSION['idioma']); ?>" />
    <meta property="og:description" content="<?= buscarTexto("WEB", "infografia", "info_og:description_seo", "", $_SESSION['idioma']); ?>" />
    <meta property="og:image" content="https://personalizacionestextiles.com/images/logo.png" />
    <?php include("assets/_partials/header.php"); ?>

    <div class="container section_padding">
        <div class="row">
            <div class="col-lg-10 mx-auto p-lr-30">
                <div class="bg-color p-all-20 ">
                    <p class="text-infog text-shadow-drop-tr"><?= buscarTexto("WEB", "infografia", "info_tit-principal", "", $_SESSION['idioma']); ?></p>
                </div>

                <div class="bg-color-2 p-all-50 m-b-20">
                    <p class="text-infor"><?= buscarTexto("WEB", "infografia", "info_p-principal", "", $_SESSION['idioma']); ?></p>
                </div>

                <div class="">
                    <div id="pendiente" class="section-top-border dot">
                        <div class="row">
                            <div class="col-md-4  bord-num-right-1 scale-up-bottom ">
                                <p class="text-estado "><?= buscarTexto("WEB", "infografia", "info_paso1-tit", "", $_SESSION['idioma']); ?></p>
                                <img class="img-proces" src="iconos/proceso-pedido/PASO-1.png" alt="<?= buscarTexto("WEB", "infografia", "alt-1", "", $_SESSION['idioma']); ?>">
                            </div>

                            <div class="col-md-8 mt-sm-20 ">
                                <p class="text-infor-2 mt-3 overflow-hidden"><?= buscarTexto("WEB", "infografia", "info_paso1-p", "", $_SESSION['idioma']); ?> </p>
                            </div>
                        </div>
                    </div>

                    <div id="confirmado" class="section-top-border text-right dot">
                        <div class="row">
                            <div class="col-md-8">
                                <p class="text-right text-infor-2 "><?= buscarTexto("WEB", "infografia", "info_paso2-p", "", $_SESSION['idioma']); ?></p>
                            </div>

                            <div class="col-md-4  bord-num-left-1 scale-up-bottom ">
                                <p class="text-estado "><?= buscarTexto("WEB", "infografia", "info_paso2-tit", "", $_SESSION['idioma']); ?></p>
                                <img class="img-proces" src="iconos/proceso-pedido/PASO-2.png" alt="<?= buscarTexto("WEB", "infografia", "alt-2", "", $_SESSION['idioma']); ?>">
                            </div>
                        </div>
                    </div>

                    <div id="preparacion" class="section-top-border dot">
                        <div class="row">
                            <div class="col-md-4 bord-num-right-2 scale-up-bottom ">
                                <p class="text-estado "><?= buscarTexto("WEB", "infografia", "info_paso3-tit", "", $_SESSION['idioma']); ?></p>
                                <img class="img-proces" src="iconos/proceso-pedido/PASO-3.png" alt="<?= buscarTexto("WEB", "infografia", "alt-3", "", $_SESSION['idioma']); ?>">
                            </div>

                            <div class="col-md-8 mt-sm-20">
                                <p class="text-infor-2 pt-5"><?= buscarTexto("WEB", "infografia", "info_paso3-p", "", $_SESSION['idioma']); ?> </p>
                            </div>
                        </div>
                    </div>

                    <div id="generado" class="section-top-border text-right dot">
                        <div class="row">
                            <div class="col-md-8">
                                <p class="text-right text-infor-2"><?= buscarTexto("WEB", "infografia", "info_paso4-p", "", $_SESSION['idioma']); ?></p>
                                <ul>
                                    <li class="text-infor-2"> <?= buscarTexto("WEB", "infografia", "info_paso4-li1", "", $_SESSION['idioma']); ?></li>
                                    <li class="text-infor-2"> <?= buscarTexto("WEB", "infografia", "info_paso4-li2", "", $_SESSION['idioma']); ?> </li>
                                    <li class="text-infor-2"> <?= buscarTexto("WEB", "infografia", "info_paso4-li3", "", $_SESSION['idioma']); ?></li>
                                </ul>
                            </div>

                            <div class="col-md-4  bord-num-left-2 scale-up-bottom ">
                                <p class="text-estado "> <?= buscarTexto("WEB", "infografia", "info_paso4-tit", "", $_SESSION['idioma']); ?></p>
                                <img class="img-proces" src="iconos/proceso-pedido/PASO-4.png" alt="<?= buscarTexto("WEB", "infografia", "alt-4", "", $_SESSION['idioma']); ?>">
                            </div>
                        </div>
                    </div>

                    <div id="pago" class="section-top-border dot">
                        <div class="row">
                            <div class="col-md-4 bord-num-right-3 scale-up-bottom ">
                                <p class="text-estado "><?= buscarTexto("WEB", "infografia", "info_paso7-tit", "", $_SESSION['idioma']); ?></p>
                                <img class="img-proces" src="iconos/proceso-pedido/paso.png" alt="<?= buscarTexto("WEB", "infografia", "alt-7", "", $_SESSION['idioma']); ?>">
                            </div>

                            <div class="col-md-8 mt-sm-20">
                                <p class=" text-infor-2 pt-3"><?= buscarTexto("WEB", "infografia", "info_paso7-p", "", $_SESSION['idioma']); ?></p>
                            </div>
                        </div>
                    </div>

                    <div id="fabricando" class="section-top-border text-right dot">
                        <div class="row">
                            <div class="col-md-8 mt-sm-20">
                                <p class=" text-infor-2 pt-3"><?= buscarTexto("WEB", "infografia", "info_paso5-p", "", $_SESSION['idioma']); ?></p>
                            </div>

                            <div class="col-md-4 bord-num-right-3 scale-up-bottom ">
                                <p class="text-estado "><?= buscarTexto("WEB", "infografia", "info_paso5-tit", "", $_SESSION['idioma']); ?></p>
                                <img class="img-proces" src="iconos/proceso-pedido/PASO-5.png" alt="<?= buscarTexto("WEB", "infografia", "alt-5", "", $_SESSION['idioma']); ?>">
                            </div>
                        </div>
                    </div>

                    <div id="enviando" class="section-top-border dot">
                        <div class="row">
                            <div class="col-md-4  bord-num-left-3 scale-up-bottom ">
                                <p class="text-estado "> <?= buscarTexto("WEB", "infografia", "info_paso6-tit", "", $_SESSION['idioma']); ?></p>
                                <img class="img-proces" src="iconos/proceso-pedido/PASO-6.png" alt="<?= buscarTexto("WEB", "infografia", "alt-6", "", $_SESSION['idioma']); ?>">
                            </div>

                            <div class="col-md-8">
                                <p class="text-right text-infor-2">
                                    <?= buscarTexto("WEB", "infografia", "info_paso6-p", "", $_SESSION['idioma']); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include("assets/_partials/footer.php");
    ?>