<?php
require_once('includes/config.php');
include("funciones/functions.php");

require_once "assets/_partials/idioma.php";
 ?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <title><?= buscarTexto("WEB", "muestrario", "seo_title", "", $_SESSION['idioma']); ?>" /></title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="<?= buscarTexto("WEB", "muestrario", "seo_desc", "", $_SESSION['idioma']); ?>">
    <link rel="canonical" href="https://personalizacionestextiles.com/muestrario">
    <meta property="og:locale" content="es_ES">
    <meta property="og:site_name" content="personalizacionestextiles" />
    <meta property="og:url" content="https://personalizacionestextiles.com/muestrario" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?= buscarTexto("WEB", "muestrario", "seo_title", "", $_SESSION['idioma']); ?>" />
    <meta property="og:description" content="<?= buscarTexto("WEB", "muestrario", "seo_desc", "", $_SESSION['idioma']); ?>" />
    <meta property="og:image" content="https://personalizacionestextiles.com/images/logo.png" />

    <?php
    include("assets/_partials/header.php");
    ?>

    <main class="p-tb-50 ">

        <?php
        include("funciones/errores.php");
        ?>

        <div>
            <div class="single-slider  d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class=" text-center">
                                <h1 class="title-product"><?= buscarTexto("WEB", "muestrario", "muestrario-tit", "", $_SESSION['idioma']); ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row mt-50 m-fichas">
                <div class="col-lg-5  p-all-40 shadow m-muestrario mr-5">
                    <div class=" text-center mb-5">
                        <img id="img1" src="imagenes/Personalizaciones.jpg" alt="">
                    </div>

                    <div class="text-center">
                        <h2 class="title-product mayus p-b-30"><?= buscarTexto("WEB", "muestrario", "muestrario-producto-1", "", $_SESSION['idioma']); ?></h2>
                        <p class="fs-32"><?= buscarTexto("WEB", "muestrario", "muestrario-producto-1-pr", "", $_SESSION['idioma']); ?> <span class="precio-muestra"><?= buscarTexto("WEB", "muestrario", "muestrario-producto-1-pr-euros", "", $_SESSION['idioma']); ?></span></p>
                        <p><?= buscarTexto("WEB", "muestrario", "muestrario-producto-1-p", "", $_SESSION['idioma']); ?></p>
                        <?php
                        if ($user->is_logged_in()) {
                        ?>
                            <button name="muestras" type="button" data-toggle="modal" data-target="#elegirPedidoMuestrario" class="btn mb5"><?= buscarTexto("WEB", "muestrario", "muestrario-producto-1-btn", "", $_SESSION['idioma']); ?></button>
                        <?php } else { ?>
                            <p class="fs-configurator-2"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_btn-login", "", $_SESSION['idioma']); ?></p>
                            <a href="login" class="btn mb-3"><?= buscarTexto("WEB", "header", "header_top-3", "", $_SESSION['idioma']); ?></a>
                        <?php } ?>
                    </div>
                </div>

                <form class="form-group" id="formMuestrario" method="post" action="DAOs/historial-pedidosDAO.php?pag=<?= buscarTexto("WEB", "paginas", "historial-pedidos", "", $_SESSION['idioma']); ?>"">
                    <input id="idPedidoME" name="idPedidoME" value="" type="hidden">
                    <!--Modal a que pedido agregar MUESTRARIO-->
                    <?php
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != "") {
                    ?>
                        <div class="modal fade" id="elegirPedidoMuestrario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1000px;">
                                <div class="modal-content modal-aviso">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="text-center p-all-30">
                                        <h3><?= buscarTexto("WEB", "muestrario", "modal-muestrario-tit", "", $_SESSION['idioma']); ?></h3>
                                    </div>

                                    <div class="modal-body">
                                        <div id="divNombres">
                                            <p class="mb-3"><?= buscarTexto("WEB", "muestrario", "modal-muestrario-p1", "", $_SESSION['idioma']); ?></p>
                                            <div class="row">

                                                <div class="col-lg-6 col-md-6 ">
                                                    <h5 class="text-center"><?= buscarTexto("WEB", "muestrario", "modal-muestrario-nuevo", "", $_SESSION['idioma']); ?></h5><br>
                                                    <p class="mb-3 verde-color"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_mensaje-add", "", $_SESSION['idioma']); ?></p>
                                                    <p class="mb-3 text-modal"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_nomped", "", $_SESSION['idioma']); ?>:</p>
                                                    <input class="nice-select-p" id="pstNombrePed2" name="pstNombrePed" value="">
                                                    <p class="p-tb-20 fs-configurator-2" id="nombre_repetido2" style="display:none;"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_mensaje-existe", "", $_SESSION['idioma']); ?></p>
                                                    <br>
                                                    <button type="button" onclick="document.forms['formMuestrario'].submit();" id="btnPedidoNuevoM" class="btn mb-4">
                                                        <span class="button__text"><?= buscarTexto("WEB", "muestrario", "modal-muestrario-nuevo-btn", "", $_SESSION['idioma']); ?></span>
                                                    </button>
                                                </div>

                                                <div class="col-lg-6 col-md-6 caja-height-2 p-3">
                                                    <h5 class="text-center"><?= buscarTexto("WEB", "muestrario", "modal-muestrario-existente", "", $_SESSION['idioma']); ?></h5><br>
                                                    <!-- <p class="mb-3 text-modal" id="txtModalEP"></p> -->
                                                    <ul class="list-group list-group-flush ">
                                                        <?php
                                                        try {
                                                            $sql = "SELECT pedidos.* FROM pedidos
                                                            WHERE estado = 'Pendiente' AND usuarios_id = " . $_SESSION['ID'];
                                                            $query = $conn->query($sql);
                                                            $r_lista = $query->fetchAll(PDO::FETCH_OBJ);
                                                        } catch (Exception $e) {
                                                            header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
                                                        }
                                                        ?>
                                                        <?php
                                                        foreach ($r_lista as $result) {
                                                            echo "<li class=''><a class='text-black' href='#' onclick='submitFormME($result->idpedidos)'>Agregar al pedido $result->idpedidos - $result->nombrepedido</a></li>";
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </form>

                <div class="col-lg-5  p-all-40 shadow m-muestrario mr-5">
                    <div>
                        <div class="text-center mb-5">
                            <img id="img2" src="imagenes/muestras-individuales.jpg" alt="">
                        </div>

                        <form class="form-group" id="formMuestraIndividual" method="post" action="DAOs/historial-pedidosDAO.php?pag=<?= buscarTexto("WEB", "paginas", "historial-pedidos", "", $_SESSION['idioma']); ?>">
                            <div class="text-center">
                                <h2 class="title-product mayus"><?= buscarTexto("WEB", "muestrario", "muestrario-producto-2", "", $_SESSION['idioma']); ?></h2>

                                <?php
                                try {
                                    $sql = "SELECT c.id_categoria, p.id_producto, p.nombre, p.molde, p.max_colores, p.cmyk, p.colores, p.tope, p.imagen, p.idtexto_archivos, 
                                p.alto_min, p.ancho_min, fp.id_forma, fp.ancho_max, fp.alto_max
                                FROM categorias c 
                                INNER JOIN productos p ON c.id_categoria = p.categorias_id_categoria
                                INNER JOIN formas_has_productos fp ON fp.id_producto = p.id_producto
                                WHERE p.id_producto != 43 AND p.id_producto != 44 AND p.id_producto != 50 AND p.id_producto != 49
                                GROUP BY nombre";
                                    $query = $conn->query($sql);
                                    $results = $query->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);
                                } catch (Exception $e) {
                                    header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
                                }
                                ?>

                                <input id="idPedidoMIE" name="idPedidoMIE" value="" hidden>
                                <label for="tecnica_muestra" class="m-t-20 fs-20"><?= buscarTexto("WEB", "muestrario", "muestrario-producto-2-tc", "", $_SESSION['idioma']); ?></label>
                                <select name="pstid_producto" id="tecnica_muestra" class="nice-select m-b-30 mx-auto" required>
                                    <option class="" value=""><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_label_paso_1", "", $_SESSION['idioma']); ?>...</option>
                                    <?php foreach ($results as $result => $productos) :
                                    ?>
                                        <optgroup label="<?= buscarTexto("PRG", "categorias", $result, "categoriaNombre", $_SESSION['idioma']); ?>">
                                            <?php foreach ($productos as $producto) :
                                                if ($producto['id_producto'] != '47') {
                                            ?>
                                                    <option class="" value="<?= $producto['id_producto']  ?>">
                                                        <?= buscarTexto("PRG", "productos", $producto['id_producto'], "nombre", $_SESSION['idioma']);
                                                        ?>
                                                    </option>
                                            <?php }
                                            endforeach ?>
                                        </optgroup>
                                    <?php endforeach ?>
                                </select>
                                <?php
                                if ($user->is_logged_in()) {
                                ?>
                                    <p><?= buscarTexto("WEB", "muestrario", "muestrario-producto-2-p", "", $_SESSION['idioma']); ?></p>
                                    <button disabled name="muestras" id="btnAg" type="button" data-toggle="modal" data-target="#elegirPedidoMuestra" class="btn mb5"><?= buscarTexto("WEB", "muestrario", "muestrario-producto-2-btn", "", $_SESSION['idioma']); ?></button>
                                <?php } else { ?>
                                    <p class="fs-configurator-2"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_btn-login", "", $_SESSION['idioma']); ?></p>
                                    <a href="login" class="btn mb-3"><?= buscarTexto("WEB", "header", "header_top-3", "", $_SESSION['idioma']); ?></a>
                                <?php } ?>
                                <!--Modal a que pedido agregar MUESTRA INDIVIDUAL-->
                                <?php
                                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != "") {
                                ?>
                            </div>
                            <div class="modal fade" id="elegirPedidoMuestra" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1000px;">
                                    <div class="modal-content modal-aviso">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="text-center p-all-30">
                                            <h3><?= buscarTexto("WEB", "muestrario", "modal-muestra-tit", "", $_SESSION['idioma']); ?></h3>
                                        </div>

                                        <div class="modal-body">
                                            <div id="divNombres">
                                                <p class="mb-3"><?= buscarTexto("WEB", "muestrario", "modal-muestra-p1", "", $_SESSION['idioma']); ?></p>
                                                <div class="row">

                                                    <div class="col-lg-6 col-md-6 ">
                                                        <h5 class="text-center"><?= buscarTexto("WEB", "muestrario", "modal-muestrario-nuevo", "", $_SESSION['idioma']); ?></h5><br>
                                                        <p class="mb-3 verde-color"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_mensaje-add", "", $_SESSION['idioma']); ?></p>
                                                        <p class="mb-3 text-modal"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_nomped", "", $_SESSION['idioma']); ?>:</p>
                                                        <input class="nice-select-p" id="pstNombrePed3" name="pstNombrePed" value="">
                                                        <p class="p-tb-20 fs-configurator-2" id="nombre_repetido3" style="display:none;"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_mensaje-existe", "", $_SESSION['idioma']); ?></p>

                                                        <br>
                                                        <button type="button" onclick="document.forms['formMuestraIndividual'].submit();" id="btnPedidoNuevoMI" class="btn">
                                                            <span class="button__text"><?= buscarTexto("WEB", "muestrario", "modal-muestrario-nuevo-btn", "", $_SESSION['idioma']); ?></span>
                                                        </button>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6 color p-3">
                                                        <h5 class="text-center"><?= buscarTexto("WEB", "muestrario", "modal-muestrario-existente", "", $_SESSION['idioma']); ?></h5><br>
                                                        <!-- <p class="mb-3 text-modal" id="txtModalEP"></p> -->
                                                        <ul class="list-group list-group-flush">
                                                            <?php
                                                            try {
                                                                $sql = "SELECT pedidos.* FROM pedidos
                                                                WHERE estado = 'Pendiente' AND usuarios_id = " . $_SESSION['ID'];
                                                                $query = $conn->query($sql);
                                                                $r_lista = $query->fetchAll(PDO::FETCH_OBJ);
                                                            } catch (Exception $e) {
                                                                header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
                                                            }
                                                            ?>
                                                            <?php
                                                            foreach ($r_lista as $result) {
                                                                echo "<li class=''><a class='text-black' href='#' onclick='submitFormMIE($result->idpedidos)'>Agregar al pedido $result->idpedidos - $result->nombrepedido</a></li>";
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                }
                            ?>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php
    include("assets/_partials/footer.php");
    ?>

    <script type="text/javascript">
        $(document).on('click', '#btnPedidoNuevoM', function() {
            $('#btnPedidoNuevoM').addClass("button--loading");
            $('#btnPedidoNuevoM').prop("disabled", true);
        });

        $(document).on('click', '#btnPedidoNuevoMI', function() {
            $('#btnPedidoNuevoMI').addClass("button--loading");
            $('#btnPedidoNuevoMI').prop("disabled", true);
        });

        function submitFormMIE(id) {
            $('#idPedidoMIE').val(id);
            $('#formMuestraIndividual').submit();
        }

        function submitFormME(id) {
            $('#idPedidoME').val(id);
            $('#formMuestrario').submit();
        }
        $(document).ready(function() {

            $("#tecnica_muestra").on('change', function() {
                if ($('select[name="pstid_producto"] :selected').val() != 0) {
                    $('#btnAg').attr('disabled', false);
                } else {
                    $('#btnAg').attr('disabled', true);
                }
            });

            $('#muestraAgregada').on('hidden.bs.modal', function() {
                window.location.reload();
            });
        });
    </script>