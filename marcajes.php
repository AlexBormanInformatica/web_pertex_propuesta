<?php
require_once('includes/config.php');
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
    <title><?= buscarTexto("WEB", "marcajes", "marcajes_title_seo", "", $_SESSION['idioma']); ?></title>
    <meta name="description" content="<?= buscarTexto("WEB", "marcajes", "marcajes_description_seo", "", $_SESSION['idioma']); ?>">
    <link rel="canonical" href="https://personalizacionestextiles.com/marcajes">
    <meta property="og:locale" content="es_ES">
    <meta property="og:site_name" content="personalizacionestextiles" />
    <meta property="og:url" content="https://personalizacionestextiles.com/marcajes" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?= buscarTexto("WEB", "marcajes", "marcajes_og:title_seo", "", $_SESSION['idioma']); ?>" />
    <meta property="og:description" content="<?= buscarTexto("WEB", "marcajes", "marcajes_og:description_seo", "", $_SESSION['idioma']); ?>" />
    <meta property="og:image" content="https://personalizacionestextiles.com/images/logo.png" />

    <?php
    include("assets/_partials/header.php");
    try {
        $sql = "SELECT * FROM productos p INNER JOIN consejoslavado co ON  co.idconsejoslavado = p.consejoslavado_idconsejoslavado WHERE categorias_idCategorias = 2 order by nombre";
        $query = $conn->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (Exception $e) {
        header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
    }
    ?>

    <main>
        <div class="single-slider slider-height2 d-flex align-items-center bg-dark" data-background="imagenes/banner-marcajes.png" style="background-image: url(&quot;imagenes/banner-marcajes.png&quot;);">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h1 class="title-product  overflow-hidden"><?= buscarTexto("WEB", "marcajes", "marcajes_tit-principal", "", $_SESSION['idioma']); ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="bg0 p-t-23">
            <div class="container">
                <div class="row  p-all-40">
                    <?php foreach ($results as $result) { ?>
                        <div class="section-top-border">
                            <div class="row model-product p-lr-10">
                                <div class="col-md-3 ">
                                    <img alt="<?= buscarTexto("PRG", "productos", $result->idproductos, "nombre", $_SESSION['idioma']) ?>" class="img-fluid" src="data:image/png;base64,<?= base64_encode($result->imagen) ?>" />
                                </div>

                                <div class="col-md-8 mt-sm-20">
                                    <h2 class="mb-30 overflow-hidden"><?= buscarTexto("PRG", "productos", $result->idproductos, "nombre", $_SESSION['idioma']); ?></h2>
                                    <h4 class="card-text mb-3 overflow-hidden txt-alineado"><?= buscarTexto("PRG", "productos", $result->idproductos, "desc_corta", $_SESSION['idioma']); ?></h4>
                                    <p class="card-text overflow-hidden txt-alineado"><?= buscarTexto("PRG", "productos", $result->idproductos, "desc_larga", $_SESSION['idioma']); ?></p>

                                    <button type="button" class="mb-4 consejos" data-toggle="modal" data-target="#consejosLavado_<?= $result->idproductos ?>">
                                        <?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_tit-consejos", "", $_SESSION['idioma']); ?>
                                    </button>

                                    <!-- Modal consejos de lavado -->
                                    <div class="modal fade" id="consejosLavado_<?= $result->idproductos ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_tit-consejos", "", $_SESSION['idioma']); ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <!--                                                   Aplicación                                               -->
                                                    <?php
                                                    if (existe("PRG", "consejoslavado", "$result->idconsejoslavado.1", "descripcion", $_SESSION['idioma']) != null) {
                                                    ?>
                                                        <div class="titulo_consejos titulo_consejo_<?= $result->idproductos ?>">
                                                            <p class="fs-configurator"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_titConsejos1", "", $_SESSION['idioma']); ?></p>
                                                        </div>
                                                        <div class=" descripciones_consejos descripcionconsejos_<?= $result->idproductos ?> ">
                                                            <p><?= buscarTexto("PRG", "consejoslavado", "$result->idconsejoslavado.1", "descripcion", $_SESSION['idioma']); ?></p>
                                                        </div>
                                                    <?php
                                                    } ?>

                                                    <!--                                                   Almacenaje                                        -->
                                                    <?php
                                                    if (existe("PRG", "consejoslavado", "$result->idconsejoslavado.2", "descripcion", $_SESSION['idioma']) != null) {
                                                    ?>
                                                        <div class="titulo_consejos titulo_consejo_<?= $result->idproductos ?>">
                                                            <p class="fs-configurator"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_titConsejos2", "", $_SESSION['idioma']); ?></p>
                                                        </div>
                                                        <div class=" descripciones_consejos descripcionconsejos_<?= $result->idproductos ?> ">
                                                            <p><?= buscarTexto("PRG", "consejoslavado", "$result->idconsejoslavado.2", "descripcion", $_SESSION['idioma']); ?></p>
                                                        </div>
                                                    <?php
                                                    } ?>

                                                    <!--                                               Instrucciones de lavado y planchado                             -->
                                                    <?php
                                                    if (existe("PRG", "consejoslavado", "$result->idconsejoslavado.3", "descripcion", $_SESSION['idioma']) != null) {
                                                    ?>
                                                        <div class="titulo_consejos titulo_consejo_<?= $result->idproductos ?>">
                                                            <p class="fs-configurator"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_titConsejos3", "", $_SESSION['idioma']); ?></p>
                                                        </div>
                                                        <div class=" descripciones_consejos descripcionconsejos_<?= $result->idproductos ?> ">
                                                            <p><?= buscarTexto("PRG", "consejoslavado", "$result->idconsejoslavado.3", "descripcion", $_SESSION['idioma']); ?></p>
                                                        </div>
                                                    <?php
                                                    } ?>

                                                    <!--                                               Resitencia al roce y desgarro                                      -->
                                                    <?php
                                                    if (existe("PRG", "consejoslavado", "$result->idconsejoslavado.4", "descripcion", $_SESSION['idioma']) != null) {
                                                    ?>
                                                        <div class="titulo_consejos titulo_consejo_<?= $result->idproductos ?>">
                                                            <p class="fs-configurator"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_titConsejos4", "", $_SESSION['idioma']); ?></p>
                                                        </div>
                                                        <div class=" descripciones_consejos descripcionconsejos_<?= $result->idproductos ?> ">
                                                            <p><?= buscarTexto("PRG", "consejoslavado", "$result->idconsejoslavado.4", "descripcion", $_SESSION['idioma']); ?></p>
                                                        </div>
                                                    <?php
                                                    } ?>

                                                    <!--                                                  Degradación de colores                                     -->
                                                    <?php
                                                    if (existe("PRG", "consejoslavado", "$result->idconsejoslavado.5", "descripcion", $_SESSION['idioma']) != null) {
                                                    ?>
                                                        <div class="titulo_consejos titulo_consejo_<?= $result->idproductos ?>">
                                                            <p class="fs-configurator"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_titConsejos5", "", $_SESSION['idioma']); ?></p>
                                                        </div>
                                                        <div class=" descripciones_consejos descripcionconsejos_<?= $result->idproductos ?> ">
                                                            <p><?= buscarTexto("PRG", "consejoslavado", "$result->idconsejoslavado.5", "descripcion", $_SESSION['idioma']); ?></p>
                                                        </div>
                                                    <?php
                                                    } ?>

                                                    <!--                                                 Resistencia a los lavados                                -->
                                                    <?php
                                                    if (existe("PRG", "consejoslavado", "$result->idconsejoslavado.6", "descripcion", $_SESSION['idioma']) != null) {
                                                    ?>
                                                        <div class="titulo_consejos titulo_consejo_<?= $result->idproductos ?>">
                                                            <p class="fs-configurator"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_titConsejos6", "", $_SESSION['idioma']); ?></p>
                                                        </div>
                                                        <div class=" descripciones_consejos descripcionconsejos_<?= $result->idproductos ?> ">
                                                            <p><?= buscarTexto("PRG", "consejoslavado", "$result->idconsejoslavado.6", "descripcion", $_SESSION['idioma']); ?></p>
                                                        </div>
                                                    <?php
                                                    } ?>

                                                    <!--                                                      Estiramiento                                         -->
                                                    <?php
                                                    if (existe("PRG", "consejoslavado", "$result->idconsejoslavado.7", "descripcion", $_SESSION['idioma']) != null) {
                                                    ?>
                                                        <div class="titulo_consejos titulo_consejo_<?= $result->idproductos ?>">
                                                            <p class="fs-configurator"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_titConsejos7", "", $_SESSION['idioma']); ?></p>
                                                        </div>
                                                        <div class=" descripciones_consejos descripcionconsejos_<?= $result->idproductos ?> ">
                                                            <p><?= buscarTexto("PRG", "consejoslavado", "$result->idconsejoslavado.7", "descripcion", $_SESSION['idioma']); ?></p>
                                                        </div>
                                                    <?php
                                                    } ?>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= buscarTexto("WEB", "contacto", "cont_form_modal_btn", "", $_SESSION['idioma']); ?></button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <a href="<?= buscarTexto("WEB", "paginas", "ptp", "", $_SESSION['idioma']); ?>?prd=<?= $result->idproductos ?>" id="<?= $result->idproductos ?>" class="btnRedirigir genric-btn primary-border circle"><?= buscarTexto("WEB", "general", "btn-personalizar", "", $_SESSION['idioma']); ?> <?= buscarTexto("PRG", "productos", $result->idproductos, "nombre", $_SESSION['idioma']); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
    </main>

    <?php
    include("assets/_partials/footer.php");
    ?>