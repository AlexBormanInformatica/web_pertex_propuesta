<?php
//header('Content-Type: application/json');
require_once "includes/config.php";

include("funciones/functions.php");

require_once "assets/_partials/idioma.php";

?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>

  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_title_seo", "", $_SESSION['idioma']); ?></title>
  <meta name="description" content="<?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_description_seo", "", $_SESSION['idioma']); ?>">
  <link rel="canonical" href="https://personalizacionestextiles.com/personaliza-tu-producto">
  <meta property="og:locale" content="es_ES">
  <meta property="og:site_name" content="personalizacionestextiles" />
  <meta property="og:url" content="https://personalizacionestextiles.com/personaliza-tu-producto" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="<?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_og:title_seo", "", $_SESSION['idioma']); ?>" />
  <meta property="og:description" content="<?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_og:description_seo", "", $_SESSION['idioma']); ?>" />
  <meta property="og:image" content="https://personalizacionestextiles.com/images/logo.png" />

  <?php include("assets/_partials/header-personalizar.php");
  include("funciones/errores.php");
  ?>

<body>
  <!-- Modal principal con breve explicacion de los pasos -->
  <div class="modal fade " id="modalPrincipal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="background-color: #d8f3ea;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="text-center">
          <h3 class="modal-title" id="exampleModalCenterTitle"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_modal1-tit", "", $_SESSION['idioma']); ?></h3>
        </div>

        <div class="modal-body">
          <div class="row mb-20">
            <div class="col-lg-12 col-md-12 text-center ">
              <div class="caja-tarjeta p-3">
                <?php if (!$user->is_logged_in()) { ?>
                  <p class="fs-configurator-2"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_btn-login", "", $_SESSION['idioma']); ?></p>
                  <a href="login" class="btn btn-lg mb-5"><?= buscarTexto("WEB", "header", "header_top-3", "", $_SESSION['idioma']); ?></a>
                <?php }  ?>
                <p class="fs-15"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_modal1-txt5", "", $_SESSION['idioma']); ?></p>
              </div>
            </div>
          </div>

          <div class="row mb-20">
            <div class="col-lg-6 col-md-6 text-center mb-3">
              <div class="caja-tarjeta p-3">
                <img class="mb-3" width="25%" src="iconos/iconos/Tecnica 4.png" alt="<?= buscarTexto("WEB", "personaliza-tu-producto", "alt-pasos", "", $_SESSION['idioma']); ?>">
                <h5><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_modal-paso1", "", $_SESSION['idioma']); ?></h5><br>
                <p class="fs-15"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_modal-t1-p1", "", $_SESSION['idioma']); ?></p>
                <p class="fs-15"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_modal-t1-p2", "", $_SESSION['idioma']); ?></p>
              </div>
            </div>

            <div class="col-lg-6 col-md-6 text-center mb-3">
              <div class="caja-tarjeta p-3"> <img class="mb-3" width="25%" src="iconos/iconos/Diseño 4.png" alt="<?= buscarTexto("WEB", "personaliza-tu-producto", "alt-pasos", "", $_SESSION['idioma']); ?>">
                <h5><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_modal-paso2", "", $_SESSION['idioma']); ?></h5><br>
                <p class="fs-15"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_modal-t2-p1", "", $_SESSION['idioma']); ?></p>
                <p class="fs-15"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_modal-t2-p2", "", $_SESSION['idioma']); ?></p>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6 col-md-6 text-center  mb-3">
              <div class="caja-tarjeta p-3"> <img class="mb-3" width="25%" src="iconos/iconos/Colores 4.png" alt="<?= buscarTexto("WEB", "personaliza-tu-producto", "alt-siguiente", "", $_SESSION['idioma']); ?>">
                <h5><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_modal-paso3", "", $_SESSION['idioma']); ?></h5><br>
                <p class="fs-15"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_modal-t3-p1", "", $_SESSION['idioma']); ?></p>
                <p class="fs-15"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_modal-t3-p2", "", $_SESSION['idioma']); ?></p>
              </div>
            </div>

            <div class="col-lg-6 col-md-6 text-center  mb-3">
              <div class="caja-tarjeta p-3"> <img class="mb-3" width="35%" src="iconos/iconos/Subir foto 4.png" alt="<?= buscarTexto("WEB", "personaliza-tu-producto", "alt-siguiente", "", $_SESSION['idioma']); ?>">
                <h5><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_modal-paso4", "", $_SESSION['idioma']); ?></h5><br>
                <p class="fs-15"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_modal-t4-p1", "", $_SESSION['idioma']); ?></p>
                <p class="fs-15"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_modal1-txt3", "", $_SESSION['idioma']); ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= buscarTexto("WEB", "contacto", "cont_form_modal_btn", "", $_SESSION['idioma']); ?></button>

        </div>

      </div>
    </div>
  </div>


  <!-- ----------------------------MENU MOVIL-------------------------------------- -->

  <div class="color-nav m-b-30 ">
    <div class="nav nav-pills-mv divpills2 evenly" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <div class="primerBotonM nav-link active a-color text-center" id="v-pills-home" data-toggle="pill" href="#tecnicas" role="tab" aria-controls="v-pills-home" aria-selected="true">
        <a class="m-auto"><img id="imgtecnicam" src="iconos/Tecnica3.png" alt="<?= buscarTexto("WEB", "personaliza-tu-producto", "alt-tecnica", "", $_SESSION['idioma']); ?>"></a>
      </div>

      <div class="segundoBotonM nav-link a-color text-center" id="v-pills-profile" data-toggle="pill" href="#diseno" role="tab" aria-controls="v-pills-profile" aria-selected="false">
        <a><img id="imgdisenom" src="iconos/Diseno6.png" alt="<?= buscarTexto("WEB", "personaliza-tu-producto", "alt-diseno", "", $_SESSION['idioma']); ?>"></a>
      </div>

      <div class="tercerBotonM nav-link a-color text-center" id="v-pills-messages" data-toggle="pill" href="#colores" role="tab" aria-controls="v-pills-messages" aria-selected="false">
        <a><img id="imgcoloresm" src="iconos/Colores6.png" alt="<?= buscarTexto("WEB", "personaliza-tu-producto", "alt-colores", "", $_SESSION['idioma']); ?>"></a>
      </div>

      <div class="cuartoBotonM nav-link a-color text-center" id="v-pills-settings" data-toggle="pill" href="#imagen" role="tab" aria-controls="v-pills-settings" aria-selected="false">
        <a><img id="imgsubirfotom" src="iconos/Subir-foto6.png" alt="<?= buscarTexto("WEB", "personaliza-tu-producto", "alt-foto", "", $_SESSION['idioma']); ?>"></a>
      </div>
    </div>
  </div>

  <!-- ---------------------------------FIN MENU MOVIL-------------------------------- -->
  <div class="container p-0">
    <div class="row m-0">
      <div class="col-lg-1 p-0 ">
        <div class="">
          <div class="nav nav-pills flex-column divpills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <div class="primerBoton nav-link active a-color text-center pt-5" id="v-pills-home" data-toggle="pill" href="#tecnicas" role="tab" aria-controls="v-pills-home" aria-selected="true">
              <a class="m-auto" id="a1"><img id="imgtecnica" src="iconos/Tecnica3.png" alt="<?= buscarTexto("WEB", "personaliza-tu-producto", "alt-tecnica", "", $_SESSION['idioma']); ?>"></a>
              <p class="configurator-nav text-center">1. <?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_nav-items-1", "", $_SESSION['idioma']); ?></p>
            </div>

            <div class="segundoBoton nav-link a-color text-center" id="v-pills-profile" data-toggle="pill" href="#diseno" role="tab" aria-controls="v-pills-profile" aria-selected="false">
              <a id="a2"><img id="imgdiseno" src="iconos/Diseno6.png" alt="<?= buscarTexto("WEB", "personaliza-tu-producto", "alt-diseno", "", $_SESSION['idioma']); ?>"></a>
              <p class="configurator-nav text-center">2. <?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_nav-items-2", "", $_SESSION['idioma']); ?></p>
            </div>

            <div class="tercerBoton nav-link a-color text-center" id="v-pills-messages" data-toggle="pill" href="#colores" role="tab" aria-controls="v-pills-messages" aria-selected="false">
              <a id="a3"><img id="imgcolores" src="iconos/Colores6.png" alt="<?= buscarTexto("WEB", "personaliza-tu-producto", "alt-colores", "", $_SESSION['idioma']); ?>"></a>
              <p class="configurator-nav text-center">3. <?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_nav-items-3", "", $_SESSION['idioma']); ?></p>
            </div>

            <div class="cuartoBoton nav-link a-color text-center" id="v-pills-settings" data-toggle="pill" href="#imagen" role="tab" aria-controls="v-pills-settings" aria-selected="false">
              <a id="a4"><img id="imgsubirfoto" src="iconos/Subir-foto6.png" alt="<?= buscarTexto("WEB", "personaliza-tu-producto", "alt-foto", "", $_SESSION['idioma']); ?>"></a>
              <p class="configurator-nav text-center">4. <?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_nav-items-4", "", $_SESSION['idioma']); ?></p>
            </div>
          </div>
        </div>
      </div>


      <div class="col-lg-7 este pad-mv" id="inicioScroll">
        <!--Formulario-->
        <form id="formularioPersonalizar" action="DAOs/historial-pedidosDAO.php?pag=<?= buscarTextoConReturn("WEB", "paginas", "historial-pedidos", "", $_SESSION['idioma']); ?>" method="POST" enctype="multipart/form-data">
          <div class="tab-content p-0">
            <!--Paso 1: Tecnica------------------------------------------------>
            <div id="tecnicas" class="container tab-pane active "><br>
              <div class="pad-mv">
                <fieldset>
                  <label id="prd" style="display:none"><?= $_GET["prd"] ?></label>
                  <?php
                  try {
                    $sql = "SELECT c.idCategorias, p.idproductos, p.nombre, p.molde, p.max_colores, p.cmyk, p.colores, p.tope, p.imagen, p.idtexto_archivos, 
                    p.alto_min, p.ancho_min, fp.formas_id_formas, p.ancho_max, p.alto_max
                    FROM categorias c 
                    INNER JOIN productos p ON c.idCategorias = p.categorias_idCategorias
                    LEFT JOIN formas_has_productos fp ON fp.productos_idproductos = p.idproductos
                    WHERE personalizable = 1
                    GROUP BY nombre";
                    $query = $conn->query($sql);
                    $results = $query->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);
                  } catch (Exception $e) {
                    // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
                  }
                  ?>

                  <!--Tecnicas por categoria-->
                  <div class="form-group ">
                    <label for="tecnica" class="title-paso-configurator mayus fs-18 p-b-20"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_tit_paso_1", "", $_SESSION['idioma']); ?></label>
                    <p><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_p_paso_1", "", $_SESSION['idioma']); ?></p>

                    <div class="row">
                      <div class="col-md-4">
                        <div>
                          <div id="informacionDeLaTecnica" style="display:none" type="button" class="btn-modal mb-2 zoom" data-toggle="modal" data-target="#informacion">
                            <span class=""><i class="ti-info-alt"></i></span>
                          </div>

                          <select name="tecnica" id="tecnica" class="nice-select mb-5 ">
                            <option class="" value=""><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_label_paso_1", "", $_SESSION['idioma']); ?>...</option>
                            <?php foreach ($results as $result => $productos) :
                              //if ($result != 6) {
                            ?>
                              <optgroup label="<?= buscarTexto("PRG", "categorias", $result, "categoriaNombre", $_SESSION['idioma']); ?>">
                                <?php foreach ($productos as $producto) :
                                  if ($producto['idproductos'] != '47') {
                                ?>
                                    <option class="<?= $producto['max_colores']  ?> <?= $producto['molde']  ?> <?= $producto['idtexto_archivos']  ?> <?= $producto['formas_id_formas']  ?> <?= $producto['cmyk']  ?> <?= $producto['colores']  ?> <?= $producto['tope']  ?> <?= $producto['ancho_min']  ?> <?= $producto['alto_min']  ?> <?= $producto['alto_max']  ?> <?= $producto['alto_max']  ?>" value="<?= $producto['idproductos']  ?>">
                                      <!--
                                    class:[0] maximo de colores
                                          [1] molde
                                          [2] €
                                          [3] id texto archivos
                                          [4] id formas
                                          [5] cmyk
                                          [6] colores
                                          [7] tope
                                          [8] ancho minimo
                                          [9] alto minimo
                                          [10] ancho maximo
                                          [11] alto maximo
                                    -->
                                      <?= buscarTexto("PRG", "productos", $producto['idproductos'], "nombre", $_SESSION['idioma']);
                                      ?>
                                    </option>
                                <?php }
                                endforeach ?>
                              </optgroup>
                            <?php //}
                            endforeach ?>
                          </select>
                        </div>
                      </div> <!-- fin col6 -->

                      <div class="col-md-8">
                        <!--Tope de pulsera-->
                        <div class="p-tb-20">
                          <div style="display: none;" id="topePulsera">
                            <p class="fs-configurator "><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_1_añadir-tope", "", $_SESSION['idioma']); ?></p>

                            <!--Boton modal info sobre topes-->
                            <div type="button" class="btn-modal zoom" data-toggle="modal" data-target="#infoTopes">
                              <span class="mr-2"><i class="ti-info-alt"></i></span>
                            </div>

                            <div class="cc-selector">
                              <input id="siTopePulsera" type="radio" name="tope" value="1" />
                              <?= buscarTexto("WEB", "generico", "si", "", $_SESSION['idioma']); ?><label class="drinkcard-cc contope" for="siTopePulsera"></label>
                              <input id="noTopePulsera" type="radio" name="tope" value="0" checked="checked" />
                              <?= buscarTexto("WEB", "generico", "no", "", $_SESSION['idioma']); ?><label class="drinkcard-cc sintope" for="noTopePulsera"></label>
                            </div>
                          </div>
                        </div>

                        <!--Cantidad de topes de pulsera-->
                        <div style="display: none;" id="divCantidadTopes" class="form-group">
                          <label for="cantidad" class="m-t-20"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_1_cant-topes", "", $_SESSION['idioma']); ?></label>
                          <input type="number" id="cantidadTopes" class="nice-select m-b-30 ancho-40" name="cantidadTopes">
                          <button class="btn p-t-50" id="añadirTopes"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_1_cant-topes_btn", "", $_SESSION['idioma']); ?></button>
                        </div>

                        <!--Modulos x producto-->
                        <?php
                        try {
                          $sql = "SELECT m.idmodulo, pm.productos_idproductos, m.descripcion FROM modulo as m
                          INNER JOIN productos_has_modulo as pm on pm.modulo_idmodulo = m.idmodulo
                          INNER JOIN colores as c ON c.idColor = pm.colores_idColor
                         WHERE c.idColor=1584 AND m.idmodulo <> 3";
                          $query = $conn->query($sql);
                          $results = $query->fetchAll(PDO::FETCH_OBJ);
                        } catch (Exception $e) {
                          // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
                        }
                        ?>
                        <div id="productoModulo">
                          <?php foreach ($results as $result) : ?>
                            <div style="display: none;" class="<?= $result->idmodulo ?>" id="<?= $result->productos_idproductos; ?>">
                              <?= $result->descripcion; //1 = metal, 2 = piel, 3 sin modulo
                              ?>
                            </div>
                          <?php endforeach ?>
                        </div>
                      </div> <!-- fin col-6 -->
                    </div> <!-- fin row -->
                </fieldset>
              </div>
            </div>

            <!--Paso 2: Diseño----------------------------------->
            <div id="diseno" class="container tab-pane "><br>
              <div class="pad-mv">
                <fieldset>
                  <p class="p-tb-10 fs-18 mayus title-paso-configurator"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_2_tit", "", $_SESSION['idioma']); ?></p>
                  <p><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_2_p", "", $_SESSION['idioma']); ?></p>

                  <div class="mb-5 row">
                    <p class="col-12 text-result fs-configurator" id="mensajeDisenoFijo"></p>
                    <div class="col-md-7" id="divMedidas" style="display: none;">
                      <?php //Formas fijas = tiene para escoger la forma y tienen unas medidas fijas
                      try {
                        $sql1 = "SELECT f.id_formas, f.formas, f.imagen, p.idproductos FROM formas f 
                        INNER JOIN formas_has_productos fp ON f.id_formas = fp.formas_id_formas
                        INNER JOIN productos p ON fp.productos_idproductos = p.idproductos";
                        $query = $conn->query($sql1);
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                      } catch (Exception $e) {
                        // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
                      }
                      ?>

                      <!--Diseño fijo-->
                      <div class="diseno_fijo cc-selector" id="disenoFijo" style="display: none;">
                        <p class='p-b-20 fs-configurator' id="mensajeDisenoFijo2"></p>
                        <?php foreach ($results as $result) : ?>
                          <input id="formas_fijas_<?= $result->idproductos ?>_<?= $result->id_formas ?>" class="<?= $result->id_formas ?> <?= buscarTexto("PRG", "formas", $result->id_formas, "formas", $_SESSION['idioma']); ?>" type="radio" name="formas_fijas" value="formas_fijas" />
                          <label class="radios rdbtn_<?= $result->idproductos ?> drinkcard-cc forma_<?= $result->id_formas ?>" for="formas_fijas_<?= $result->idproductos ?>_<?= $result->id_formas ?>" data-title="<?= buscarTexto("PRG", "formas", $result->id_formas, "formas", $_SESSION['idioma']); ?>"></label>
                        <?php endforeach ?>
                        <p class="resultado fs-configurator-2"><br>
                          <span class="m-t-10" id="errorForma"></span>
                        </p>
                      </div>

                      <!--Diseño NO fijo-->
                      <div id="disenoNoFijo" style="display: none;">
                        <!--Superficie-->
                        <div class="form-group">
                          <p class="fs-configurator"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_2-calcula-super", "", $_SESSION['idioma']); ?></p>
                          <label for="num1" class="m-t-20"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_2_ancho", "", $_SESSION['idioma']); ?></label>

                          <div id="ancho_superficie">
                            <input name="ancho" type="number" id="num1" class="nice-select-p ancho-40">
                          </div>

                          <div style="display: none;" id="ancho_select">
                            <select name="ancho_fijo" id="ancho_fijo" class="nice-select-p">
                              <option value=""><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_2_ancho-select", "", $_SESSION['idioma']); ?>...</option>
                              <option value="15">15</option>
                              <option value="20">20</option>
                              <option value="25">25</option>
                              <option value="30">30</option>
                              <option value="35">35</option>
                              <option value="40">40</option>
                              <option value="45">45</option>
                              <option value="50">50</option>
                            </select>
                          </div>

                          <label for="num2" class="m-t-20"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_2_largo", "", $_SESSION['idioma']); ?></label>
                          <input name="alto" type="number" id="num2" class="nice-select-p ancho-40">
                          <p class="resultado fs-configurator-2"><br>
                            <span class="m-t-10" id="superficie"></span>
                          </p>
                        </div>
                      </div>
                    </div> <!-- fin col-6 -->

                    <div class="col-md-5">
                      <!--Medidas de la base de tela-->
                      <div style="display: none;" id="divMedidasTela" class="form-group">
                        <p class="fs-configurator"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_2_sup-base", "", $_SESSION['idioma']); ?></p>
                        <label for="num1" class="m-t-20"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_2_ancho-base", "", $_SESSION['idioma']); ?></label>
                        <input type="number" id="cant1" class="nice-select-p ancho-40">
                        <label for="num2" class="m-t-20"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_2_largo-base", "", $_SESSION['idioma']); ?></label>
                        <input type="number" id="cant2" class="nice-select-p ancho-40">
                        <p class="resultado fs-configurator-2"><br>
                          <span class="m-t-10" id="superficieBaseTela"></span>
                        </p>
                      </div>

                      <!--Formas-->
                      <?php
                      try {
                        $sql_formas = "SELECT f.fijo, fp.ancho_forma, fp.alto_forma, fp.productos_idproductos, f.formas 
                        FROM formas f INNER JOIN formas_has_productos fp 
                        ON f.id_formas = fp.formas_id_formas";
                        $query_formas = $conn->query($sql_formas);
                        $results_formas = $query_formas->fetchAll(PDO::FETCH_ASSOC);
                      } catch (Exception $e) {
                        // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
                      }
                      ?>
                      <div style="display: none;" class="form-group">
                        <?php foreach ($results_formas as $result) : ?>
                          <div style="display: none;" class="fijo_<?= $result['fijo']; ?> ancho_<?= $result['ancho_forma']; ?> alto_<?= $result['alto_forma']; ?>" id="idF_<?= $result['productos_idproductos']; ?>">
                            <?= $result['formas']; ?>
                          </div>
                        <?php endforeach ?>
                      </div>

                      <!--Cantidad-->
                      <div class="p-0">
                        <div class="form-group">
                          <label for="cantidad" class="resultado fs-configurator"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_2_cantidad", "", $_SESSION['idioma']); ?></label>
                          <input type="number" id="cantidad" class="nice-select-p ancho-40" name="cantidad">
                          <div class="m-t-20">
                            <button class="btn m-t-25" id="añadir"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_2_cantidad-btn-+", "", $_SESSION['idioma']); ?></button>
                            <p style="display:none" class="resultado p-tb-20 fs-configurator-2" id="errorCantidad"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </fieldset>
              </div>
            </div>

            <!--Paso 3: Colores------------------------------------->
            <div id="colores" class="container tab-pane"><br>
              <div class="pad-mv">
                <fieldset>
                  <p class="p-tb-10 fs-18 mayus title-paso-configurator" id="tituloColores"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_3_tit", "", $_SESSION['idioma']); ?></p>
                  <p id="p-txt-colores"></p>

                  <!--Colores del diseño-->
                  <div class="m-b-50">
                    <?php
                    try {
                      $sql = "SELECT p.idproductos, cp.idColor, c.nombre, c.idTipoColor, c.pantone, c.francia, c.portugal, c.italia, c.hexadecimal FROM productos as p
                      INNER JOIN colores_has_productos as cp on cp.productos_idproductos = p.idproductos
                      INNER JOIN colores as c ON c.idColor = cp.idColor WHERE c.idColor<>1584 ORDER BY c.pantone";
                      $query = $conn->prepare($sql);
                      $query->execute();
                      $results = $query->fetchAll(PDO::FETCH_OBJ);
                    } catch (Exception $e) {
                      // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
                    }
                    ?>

                    <div style="display: none;" class="divColoresDiseno p-all-10" id="colorDiseno">
                      <div class="row">
                        <div class="col-4" id="texto_columna">
                          <label for="" class="fs-configurator p-b-20"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_3_colores", "", $_SESSION['idioma']); ?></label>
                          <label class="fs-configurator p-b-20" id="contadorColores"></label>
                        </div>

                        <div class="col-8" id="buscador_colores">
                          <label class="fs-configurator p-b-5"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_buscador", "", $_SESSION['idioma']); ?></label>
                          <input type="text" id="pantone" placeholder="<?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_placeholder-buscador", "", $_SESSION['idioma']); ?>" class="nice-select m-b-30">
                        </div>
                      </div>

                      <div class="row" id="div_colores">
                        <?php foreach ($results as $result) { ?>
                          <div style="display: none;" class="colores color_<?= $result->idproductos ?> col-lg-color col-md-4 col-sm-6" id="<?= $result->idColor ?>">
                            <label class="cuadrado" data-title="<?php if ($_SESSION['idioma'] == 'ES') {
                                                                  echo $result->nombre . PHP_EOL . "PANTONE " . $result->pantone;
                                                                } else if ($_SESSION['idioma'] == 'FR' && $result->francia != null) {
                                                                  echo $result->francia . PHP_EOL . "PANTONE " . $result->pantone;
                                                                } else if ($_SESSION['idioma'] == 'PT' && $result->portugal != null) {
                                                                  echo $result->portugal . PHP_EOL . "PANTONE " . $result->pantone;
                                                                } else if ($_SESSION['idioma'] == 'IT' && $result->italia != null) {
                                                                  echo $result->italia . PHP_EOL . "PANTONE " . $result->pantone;
                                                                } else {
                                                                  echo $result->nombre . PHP_EOL . "PANTONE " . $result->pantone;
                                                                } ?>">
                              <input name="colores" id="checkColoresDiseno" value="<?= $result->nombre ?>" type="checkbox">
                              <span class="checkmark" style="background-color:#<?= $result->hexadecimal ?>"></span>
                            </label>
                          </div>
                        <?php } ?>
                      </div>
                    </div>

                    <!--Colores del módulo de metal-->
                    <?php
                    try {
                      $sql = "SELECT pm.productos_idproductos, c.idColor, c.nombre, c.pantone, c.francia, c.portugal, c.italia, c.hexadecimal FROM modulo as m
                      INNER JOIN productos_has_modulo as pm on pm.modulo_idmodulo = m.idmodulo
                      INNER JOIN colores as c ON c.idColor = pm.colores_idColor 
                      WHERE c.idColor<>1584 AND m.idmodulo = 1 ORDER BY c.pantone"; //1=metal
                      $query = $conn->prepare($sql);
                      $query->execute();
                      $results = $query->fetchAll(PDO::FETCH_OBJ);
                    } catch (Exception $e) {
                      // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
                    }
                    ?>
                    <div style="display: none;" class="p-all-10" id="colorMetal">
                      <label for="" class="fs-configurator p-b-20"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_3_colores-metal", "", $_SESSION['idioma']); ?></label>
                      <div class="row">

                        <?php foreach ($results as $result) { ?>
                          <div style="display: none;" class="metalicos metal_<?= $result->productos_idproductos ?> col-lg-color col-md-4 col-sm-6" id="<?= $result->idColor ?>">
                            <label class="cuadrado" data-title="<?php if ($_SESSION['idioma'] == 'ES') {
                                                                  echo $result->nombre . PHP_EOL . "PANTONE " . $result->pantone;
                                                                } else if ($_SESSION['idioma'] == 'FR' && $result->francia != null) {
                                                                  echo $result->francia . PHP_EOL . "PANTONE " . $result->pantone;
                                                                } else if ($_SESSION['idioma'] == 'PT' && $result->portugal != null) {
                                                                  echo $result->portugal . PHP_EOL . "PANTONE " . $result->pantone;
                                                                } else if ($_SESSION['idioma'] == 'IT' && $result->italia != null) {
                                                                  echo $result->italia . PHP_EOL . "PANTONE " . $result->pantone;
                                                                } else {
                                                                  echo $result->nombre . PHP_EOL . "PANTONE " . $result->pantone;
                                                                } ?>">
                              <input id="checkColoresMetal" value="<?= $result->nombre ?>" type="checkbox">
                              <span class="checkmark" style="background-color:#<?= $result->hexadecimal ?>"></span>
                            </label>
                          </div>
                        <?php } ?>
                      </div>
                    </div>

                    <!--Colores del módulo de piel-->
                    <?php
                    try {
                      $sql = "SELECT pm.productos_idproductos, c.idColor, c.nombre, c.pantone, c.francia, c.portugal, c.italia, c.hexadecimal FROM modulo as m
                      INNER JOIN productos_has_modulo as pm on pm.modulo_idmodulo = m.idmodulo
                      INNER JOIN colores as c ON c.idColor = pm.colores_idColor 
                      WHERE c.idColor<>1584 AND m.idmodulo = 2 ORDER BY c.pantone"; //2=piel
                      $query = $conn->prepare($sql);
                      $query->execute();
                      $results = $query->fetchAll(PDO::FETCH_OBJ);
                    } catch (Exception $e) {
                      // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
                    }
                    ?>
                    <div style="display: none;" class="p-all-10" id="colorPiel">
                      <label for="" class="fs-configurator p-b-20"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_3_colores-piel", "", $_SESSION['idioma']); ?></label>
                      <div class="row">

                        <?php foreach ($results as $result) { ?>
                          <div style="display: none;" class="pieles piel_<?= $result->productos_idproductos ?> col-lg-color col-md-4 col-sm-6" id="<?= $result->idColor ?>">
                            <label class="cuadrado" data-title="<?php if ($_SESSION['idioma'] == 'ES') {
                                                                  echo $result->nombre . PHP_EOL . "PANTONE " . $result->pantone;
                                                                } else if ($_SESSION['idioma'] == 'FR' && $result->francia != null) {
                                                                  echo $result->francia . PHP_EOL . "PANTONE " . $result->pantone;
                                                                } else if ($_SESSION['idioma'] == 'PT' && $result->portugal != null) {
                                                                  echo $result->portugal . PHP_EOL . "PANTONE " . $result->pantone;
                                                                } else if ($_SESSION['idioma'] == 'IT' && $result->italia != null) {
                                                                  echo $result->italia . PHP_EOL . "PANTONE " . $result->pantone;
                                                                } else {
                                                                  echo $result->nombre . PHP_EOL . "PANTONE " . $result->pantone;
                                                                } ?>">
                              <input id="checkColoresPiel" value="<?= $result->nombre ?>" type="checkbox">
                              <span class="checkmark" style="background-color:#<?= $result->hexadecimal ?>"></span>
                            </label>
                          </div>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </fieldset>
              </div>
            </div>

            <!--Paso 4: Imagen------------------------------------->
            <?php
            try {
              $sql_texto = "SELECT idtexto_archivos, descripcion FROM texto_archivos";
              $query_texto = $conn->prepare($sql_texto);
              $query_texto->execute();
              $results_texto = $query_texto->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
              // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
            }
            ?>
            <div id="imagen" class="container tab-pane "><br>
              <div class="pad-mv">
                <fieldset>
                  <div>
                    <p class="p-tb-10 fs-18 mayus title-paso-configurator"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_4_tit", "", $_SESSION['idioma']); ?></p>
                    <!-- <p class="fs-configurator p-b-20 mayus title-paso-configurator"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_4_p", "", $_SESSION['idioma']); ?></p> -->
                    <?php
                    $x = 1;
                    foreach ($results_texto as $result) { ?>
                      <div id="id_<?= $result->idtexto_archivos ?>" class="textoArchivo" style="display:none">
                        <p><i style="color:#00953E" class="ti-hand-point-right mr-5"></i><?= buscarTexto("PRG", "texto_archivos", $x . "", "descripcion", $_SESSION['idioma']); ?></p>
                        <p><i style="color:#00953E" class="ti-hand-point-right mr-5"></i><?= buscarTexto("PRG", "texto_archivos", $x . ".1", "descripcion", $_SESSION['idioma']); ?></p>
                        <p><i style="color:#00953E" class="ti-hand-point-right mr-5"></i><?= buscarTexto("PRG", "texto_archivos", $x . ".2", "descripcion", $_SESSION['idioma']); ?></p>
                        <p><i style="color:#00953E" class="ti-hand-point-right mr-5"></i><?= buscarTexto("PRG", "texto_archivos", $x . ".3", "descripcion", $_SESSION['idioma']); ?></p>
                      </div>
                    <?php
                      $x++;
                    } ?>
                    <p><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_4_p-indicaciones", "", $_SESSION['idioma']); ?></p>

                    <div>
                      <label for="archivo" class="btn mt-2"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_confirma-prop-intelectual-btn", "", $_SESSION['idioma']); ?></label>
                      <input style="visibility:hidden;" name="archivo" id="archivo" type="file" /><br>
                    </div>
                    <div class="limit-w m-tb-50">
                      <img id="imagenPrevisualizacion">
                    </div>

                  </div>
                </fieldset>
              </div>
            </div>
          </div>

          <div class="nav  nav-pills" id="h-pills-tab" role="tablist" style="float:right">
            <a class="btn mb-5" id="v-pills-next-tab" data-toggle="pill" href="#" role="tab" aria-controls="v-pills-profile" aria-selected="false"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_btn-sig-diseno", "", $_SESSION['idioma']); ?></a>
            <a class="btn mb-5" id="v-pills-next-tabmv" data-toggle="pill" href="#" role="tab" aria-controls="v-pills-profile" aria-selected="false"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_btn-sig", "", $_SESSION['idioma']); ?></a>
            <?php if ($user->is_logged_in()) { ?>
              <button style="display:none" id="anadirCarrito" type="button" data-toggle="modal" data-target="#elegirPedido" class="btn mb5"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_confirma-añadir", "", $_SESSION['idioma']); ?></button>
              <button class="btn mb-5" style="display:none" id="anadirCarritoMV" type="button" data-toggle="modal" data-target="#elegirPedido"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_confirma-añadir", "", $_SESSION['idioma']); ?></button>
            <?php } ?>
          </div>
      </div>

      <div class="col-md-4  p-0">
        <div id="tu-producto" class="container tab-pane fade active show">
          <div class="caja-confirma">
            <p class="p-t-20 fs-20 mayus confirma-text"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_confirma_title", "", $_SESSION['idioma']); ?></p>
          </div>

          <?php
          try {
            $sql = "SELECT p.idproductos, p.desc_larga, p.desc_corta, p.imagen,   i.descripcion as info, e.descripcion as entrega, cl.descripcion as lavado FROM productos as p
            INNER JOIN informacion as i ON i.idinformacion = p.informacion_idinformacion
            INNER JOIN envios as e ON e.idenvios = p.envios_idenvios
            INNER JOIN consejoslavado as cl ON cl.idconsejoslavado = p.consejoslavado_idconsejoslavado ";
            $query = $conn->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
          } catch (Exception $e) {
            // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
          }
          ?>

          <fieldset>
            <div class="p-all-10">
              <?php if (isset($_SESSION['interno']) && $_SESSION['interno']) { ?>
                <label for="quitarMolde">
                  <input type="checkbox" class="" id="quitarMolde" name="quitarMolde">
                  Quitar molde
                </label>
              <?php } ?>
              <div class="text-pedido"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_confirma-tecnica", "", $_SESSION['idioma']); ?><span class="text-result m-l-5" id="tecnicaTuProducto"></span></div>
              <div class="text-pedido"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_confirma-cant", "", $_SESSION['idioma']); ?><span class="text-result m-l-5" id="cantidadTuProducto"></span></div>
              <div style="display: none;" class="text-pedido" id="rowSuperficie" class="text-pedido"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_confirma-superficie", "", $_SESSION['idioma']); ?><span class="text-result m-l-5" id="superficieTuProducto"></span></div>
              <div style="display: none;" class="text-pedido" id="rowSuperficieBase" class="text-pedido"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_confirma-superficie-base", "", $_SESSION['idioma']); ?> <span class="text-result m-l-5" id="superficieBaseTuProducto"></span></div>
              <div style="display: none;" class="text-pedido" id="rowTopes"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_confirma-topes", "", $_SESSION['idioma']); ?><span class="text-result m-l-5" id="pTopesTuProducto"></span></div>
              <div class="text-pedido"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_confirma-precio-molde", "", $_SESSION['idioma']); ?><span class="text-result m-l-5" id="pMoldeTuProducto"></span></div>
              <div style="display: none;" class="text-pedido" id="rowMoldeBase"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_confirma-precio-molde-base", "", $_SESSION['idioma']); ?><span class="text-result m-l-5" id="pMoldeBaseTuProducto"></span></div>
              <div class="text-pedido"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_confirma-precio-ud", "", $_SESSION['idioma']); ?><span class="text-result m-l-5" id="pPxuTuProducto"></span></div>
              <div style="display: none;" class="text-pedido" id="rowPxuBase"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_confirma-precio-ud-base", "", $_SESSION['idioma']); ?><span class="text-result m-l-5" id="pPxuBaseTuProducto"></span></div>
              <div style="display: none;" class="text-pedido" id="rowPxuPelo"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_confirma-precio-ud-pelo", "", $_SESSION['idioma']); ?><span class="text-result m-l-5" id="pPxuPeloTuProducto"></span></div>
              <div style="display: none;" class="text-pedido" id="rowColores" class="text-pedido"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_confirma-colores", "", $_SESSION['idioma']); ?><div class="text-result row m-tb-20 row m-l-1" id="coloresTuProducto"></div>
              </div>
              <div class="text-pedido">
                <?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_confirma-img", "", $_SESSION['idioma']); ?>
                <div class="m-tb-20"><img id="imagenTuProducto" src=""></div>
              </div>
              <div style="display: none;" id="rowForma" class="text-pedido"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_confirma-forma", "", $_SESSION['idioma']); ?><span class="text-result m-l-5" id="formaTuProducto"></span></div>
              <div style="display: none;" id="rowColoresBase" class="text-pedido"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_confirma-color-base", "", $_SESSION['idioma']); ?><div class="text-result m-tb-20 row m-l-1" id="cBaseTuProducto"></div>
              </div>
              <div style="display: none;" id="rowColoresMetal" class="text-pedido"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_confirma-color-modu-mt", "", $_SESSION['idioma']); ?><div class="text-result m-tb-20 row m-l-1" id="cMetalTuProducto"></div>
              </div>
              <div style="display: none;" id="rowColoresPiel" class="text-pedido"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_confirma-color-modu-piel", "", $_SESSION['idioma']); ?><div class="text-result m-tb-20 row m-l-1" id="cPielTuProducto"></div>
              </div>
              <div class="mayus text-pedido"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_confirma-subtotal", "", $_SESSION['idioma']); ?>&nbsp;<span class="text-result m-all-20 fs-configurator2" id="totalTuProducto"></span></div></br>
              <?php if ($user->is_logged_in()) { ?>
              <?php } else { ?>
                <a href="login" class="btn btn-lg"><?= buscarTexto("WEB", "header", "header_top-3", "", $_SESSION['idioma']); ?></a>
                <p class="fs-configurator-2"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_btn-login", "", $_SESSION['idioma']); ?></p>
              <?php } ?>
            </div>
          </fieldset>
        </div>

        <!--Valores que se pasaran por post al hacer submit del formulario-->
        <!--Id producto-->
        <input id="pstIdProducto" name="pstIdProducto" value="" hidden>
        <!--Ancho-->
        <input id="pstAncho" name="pstAncho" value="" hidden>
        <!--Largo-->
        <input id="pstLargo" name="pstLargo" value="" hidden>
        <!--Superficie-->
        <input id="pstSuperficie" name="pstSuperficie" value="" hidden>
        <!--Cantidad-->
        <input id="pstCantidad" name="pstCantidad" value="" hidden>
        <!--colores_has_productos_id-->
        <input id="pstIdColoresProducto" name="pstIdColoresProducto[]" value="" hidden>
        <!--formas_id_formas-->
        <input id="pstIdForma" name="pstIdForma" value="" hidden>
        <!--base_has_colores_idbase-->
        <input id="pstIdBase" name="pstIdBase" value="6" hidden>
        <!--base_has_colores_idcolor-->
        <input id="pstIdColorBase" name="pstIdColorBase" value="" hidden>
        <!--idcolor_piel-->
        <input id="pstIdColorPiel" name="pstIdColorPiel" value="" hidden>
        <!--idcolor_metal-->
        <input id="pstIdColorMetal" name="pstIdColorMetal" value="" hidden>
        <!--ancho_base-->
        <input id="pstAnchoBase" name="pstAnchoBase" value="" hidden>
        <!--largo_base-->
        <input id="pstLargoBase" name="pstLargoBase" value="" hidden>
        <!--pelo-->
        <input id="pstPelo" name="pstPelo" value="" hidden>
        <!--cantidad_topes-->
        <input id="pstCantidadTopes" name="pstCantidadTopes" value="" hidden>
        <!--imagen-->
        <img id="pstImagen" name="pstImagen" value="" hidden>
        <!--idpedido-->
        <input id="pstIdPedido" name="pstIdPedido" value="" hidden>
        <!--precio por unidad producto-->
        <input id="pstPxuProducto" name="pstPxuProducto" value="" hidden>
        <!--precio por unidad base-->
        <input id="pstPxuBase" name="pstPxuBase" value="" hidden>
        <!--precio por unidad pelo-->
        <input id="pstPxuPelo" name="pstPxuPelo" value="" hidden>
        <!--precio molde producto-->
        <input id="pstMoldeProducto" name="pstMoldeProducto" value="" hidden>
        <!--precio molde base-->
        <input id="pstMoldeBase" name="pstMoldeBase" value="" hidden>
        <!--precio molde pelo-->
        <!-- <input id="pstMoldePelo" name="pstMoldePelo" value="" hidden> -->
        <!--precio topes de pulsera-->
        <input id="pstPrecioTopes" name="pstPrecioTopes" value="" hidden>
        <!--subtotal-->
        <input id="pstSubtotal" name="pstSubtotal" value="" hidden>

        <!--Modal a que pedido agregar-->
        <div class="modal fade" id="elegirPedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1000px;">
            <div class="modal-content modal-aviso">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div id="divPTPMal" class="text-center p-all-10">
                <i id="icono-modal-agregar" class="fa fa-info-circle fa-4x"></i>
              </div>
              <div id="divPTPBien" class="text-center p-all-10">
                <h3><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_modal-ped-tit", "", $_SESSION['idioma']); ?></h3>
                <p class="mb-3"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_modal-ped-p1", "", $_SESSION['idioma']); ?></p>
              </div>

              <div class="modal-body">
                <p class="mb-3 text-modal text-center" id="txtModalEP" style="display: none;"></p>
                <div id="divNombres">
                  <div class="mb-3 text-center p-all-10">
                    <p class="text-center">
                      <span class="numeros">1</span>
                    </p>
                    <h4 class="mb-3"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_modal-ped-subtit1", "", $_SESSION['idioma']); ?></h4>
                    <p class="mb-3 verde-color"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_mensaje-add", "", $_SESSION['idioma']); ?></p>
                    <p class="mb-3 text-modal"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_nomper", "", $_SESSION['idioma']); ?></p>
                    <p id="contador1">0 / 45</p>
                    <input class="nice-select-p mx-auto" id="pstNombrePer" name="pstNombrePer" value="" maxlength="45" onkeyup="countChars(this);"><br>
                    <p style="display:none;" id="resultadoNombreDiseno" class="resultado fs-configurator-2">Nombre de diseño ya existe.</p>
                  </div>
                  <div class="mb-3 text-center p-all-10">
                    <p class="text-center">
                      <span class="numeros">2</span>
                    </p>
                    <h4 class="mb-3 text-center"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_modal-ped-subtit2", "", $_SESSION['idioma']); ?></h4>
                    <div class="row justify-content-center">
                      <p class="mb-3"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_modal-ped-p2", "", $_SESSION['idioma']); ?></p>
                      <div class="col-lg-6 col-md-6p-4">
                        <h5 class="text-center"><?= buscarTexto("WEB", "muestrario", "modal-muestrario-nuevo", "", $_SESSION['idioma']); ?></h5><br>
                        <p class="mb-3 verde-color "><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_mensaje-add", "", $_SESSION['idioma']); ?></p>
                        <p class="mb-3 text-modal"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_nomped", "", $_SESSION['idioma']); ?>:</p>
                        <p id="contador2">0 / 45</p>
                        <input class="nice-select-p mx-auto" id="pstNombrePed" name="pstNombrePed" value="" maxlength="45" onkeyup="countChars2(this);">
                        <p class="p-tb-20 fs-configurator-2" id="nombre_repetido" style="display:none;"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_mensaje-existe", "", $_SESSION['idioma']); ?></p>
                        <br>

                        <button type="button" onclick="document.forms['formularioPersonalizar'].submit();" id="btnPedidoNuevo" class="btn">
                          <span class="button__text"><?= buscarTexto("WEB", "muestrario", "modal-muestrario-nuevo-btn", "", $_SESSION['idioma']); ?></span>
                        </button>
                      </div>

                      <div class="col-lg-6 col-md-6  caja-height p-4">
                        <h5 class="text-center"><?= buscarTexto("WEB", "muestrario", "modal-muestrario-existente", "", $_SESSION['idioma']); ?></h5><br>
                        <!-- <p class="mb-3 text-modal" id="txtModalEP"></p> -->
                        <div id="divLinkAddPedido" style="display: none;">
                          <ul class="list-group list-group-flush" id="ulLinkAddPedido">
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        </form>

        <!-- Modal info de bases -->
        <div class="modal fade" id="infoBases" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">
                <div>
                  <h4 class="mb-5"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_modal_tit-bases", "", $_SESSION['idioma']); ?></h4>
                  <p><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_modal_info-bases", "", $_SESSION['idioma']); ?></p>
                  <h3 class="fs-20"><?php echo buscarTexto("PRG", "productos", 43, "nombre", $_SESSION['idioma']); ?></h3>
                  <p><?php echo buscarTexto("PRG", "productos", 43, "desc_larga", $_SESSION['idioma']); ?></p>
                  <ul class="fs-16">
                    <li><strong><?php echo buscarTexto("PRG", "productos", 22, "nombre", $_SESSION['idioma']); ?> :</strong><?php echo buscarTexto("PRG", "productos", 43.1, "desc_larga", $_SESSION['idioma']); ?></li>
                    <li><strong> <?php echo buscarTexto("PRG", "productos", 24, "nombre", $_SESSION['idioma']); ?> :</strong> <?php echo buscarTexto("PRG", "productos", 43.2, "desc_larga", $_SESSION['idioma']); ?></li>
                    <li><strong> <?php echo buscarTexto("PRG", "productos", 25, "nombre", $_SESSION['idioma']); ?>: </strong> <?php echo buscarTexto("PRG", "productos", 43.3, "desc_larga", $_SESSION['idioma']); ?></li>
                    <li><strong> <?php echo buscarTexto("PRG", "productos", 23, "nombre", $_SESSION['idioma']); ?>: </strong><?php echo buscarTexto("PRG", "productos", 43.4, "desc_larga", $_SESSION['idioma']); ?></li>
                    <li><strong> <?php echo buscarTexto("PRG", "productos", 27, "nombre", $_SESSION['idioma']); ?>: </strong><?php echo buscarTexto("PRG", "productos", 43.5, "desc_larga", $_SESSION['idioma']); ?></li>
                    <li><strong> <?php echo buscarTexto("PRG", "productos", 28, "nombre", $_SESSION['idioma']); ?>: </strong> <?php echo buscarTexto("PRG", "productos", 43.6, "desc_larga", $_SESSION['idioma']); ?></li>
                    <li><strong> <?php echo buscarTexto("PRG", "productos", 29, "nombre", $_SESSION['idioma']); ?>: </strong> <?php echo buscarTexto("PRG", "productos", 43.7, "desc_larga", $_SESSION['idioma']); ?></li>
                    <li><strong> <?php echo buscarTexto("PRG", "productos", 31, "nombre", $_SESSION['idioma']); ?>: </strong> <?php echo buscarTexto("PRG", "productos", 43.8, "desc_larga", $_SESSION['idioma']); ?></li>
                    <li><strong> <?php echo buscarTexto("PRG", "productos", 32, "nombre", $_SESSION['idioma']); ?>: </strong> <?php echo buscarTexto("PRG", "productos", 43.9, "desc_larga", $_SESSION['idioma']); ?></li>
                  </ul>
                </div><br>

                <div>
                  <h3 class="fs-20"><?php echo buscarTexto("PRG", "productos", 44, "nombre", $_SESSION['idioma']); ?></h3>
                  <p><?php echo buscarTexto("PRG", "productos", 44, "desc_larga", $_SESSION['idioma']); ?></p>
                  <ul class="fs-16">
                    <li><strong><?php echo buscarTexto("PRG", "productos", 31, "nombre", $_SESSION['idioma']); ?> :</strong><?php echo buscarTexto("PRG", "productos", 44.1, "desc_larga", $_SESSION['idioma']); ?></li>
                    <li><strong> <?php echo buscarTexto("PRG", "productos", 3, "nombre", $_SESSION['idioma']); ?> :</strong> <?php echo buscarTexto("PRG", "productos", 44.2, "desc_larga", $_SESSION['idioma']); ?></li>
                    <li><strong> <?php echo buscarTexto("PRG", "productos", 4, "nombre", $_SESSION['idioma']); ?>: </strong> <?php echo buscarTexto("PRG", "productos", 44.3, "desc_larga", $_SESSION['idioma']); ?></li>
                    <li><strong> <?php echo buscarTexto("PRG", "productos", 5, "nombre", $_SESSION['idioma']); ?>: </strong><?php echo buscarTexto("PRG", "productos", 44.4, "desc_larga", $_SESSION['idioma']); ?></li>
                    <li><strong> <?php echo buscarTexto("PRG", "productos", 7, "nombre", $_SESSION['idioma']); ?>: </strong><?php echo buscarTexto("PRG", "productos", 44.5, "desc_larga", $_SESSION['idioma']); ?></li>
                    <li><strong> <?php echo buscarTexto("PRG", "productos", 34, "nombre", $_SESSION['idioma']); ?>: </strong> <?php echo buscarTexto("PRG", "productos", 44.6, "desc_larga", $_SESSION['idioma']); ?></li>
                  </ul>
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= buscarTexto("WEB", "contacto", "cont_form_modal_btn", "", $_SESSION['idioma']); ?></button>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal info pelo -->
        <div class="modal fade" id="infoPelo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalCenterTitle"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_modal_tit-pelo", "", $_SESSION['idioma']); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">
                <div class="fs-16">
                  <?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_modal_txt-pelo", "", $_SESSION['idioma']); ?>
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= buscarTexto("WEB", "contacto", "cont_form_modal_btn", "", $_SESSION['idioma']); ?></button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal info condint -->
      <?php
      try {
        $sql = "SELECT idproductos, desc_corta, desc_larga FROM productos WHERE idproductos = 47";
        $query = $conn->query($sql);
        $results = $query->fetchAll(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
      }
      ?>
      <div class="modal fade" id="infoTopes" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <h3>Condint</h3>
              <?php foreach ($results as $result) { ?>
                <div>
                  <?= buscarTexto("PRG", "productos", $result->idproductos, "desc_larga", $_SESSION['idioma']); ?>
                </div>
              <?php } ?>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= buscarTexto("WEB", "contacto", "cont_form_modal_btn", "", $_SESSION['idioma']); ?></button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal informacion-->
      <div class="modal fade" id="informacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_tit-info-prod", "", $_SESSION['idioma']); ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <?php
              try {
                $sql = "SELECT  p.idproductos, p.nombre, p.desc_larga, p.desc_corta, p.molde, p.max_colores, i.idinformacion, 
                i.descripcion, e.idenvios, e.descripcion as desc_envios, co.idconsejoslavado, co.descripcion as desc_consejos, p.imagen, 
                f.imagen as imagen_forma,  p.idtexto_archivos, fp.formas_id_formas
                FROM productos p 
                INNER JOIN formas_has_productos fp ON fp.productos_idproductos = p.idproductos
                INNER JOIN formas f ON  f.id_formas = fp.formas_id_formas
                INNER JOIN informacion i ON  i.idinformacion = p.informacion_idinformacion
                INNER JOIN envios e ON  e.idenvios = p.envios_idenvios
                INNER JOIN consejoslavado co ON  co.idconsejoslavado = p.consejoslavado_idconsejoslavado
                GROUP BY nombre";
                $query = $conn->query($sql);
                $results = $query->fetchAll(PDO::FETCH_OBJ);
              } catch (Exception $e) {
                // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
              }
              ?>
              <div>
                <h3 class="text-result" id=""></h3>
                <?php foreach ($results as $result) { ?>
                  <div>
                    <div class="row">
                      <div class="col-md-6">
                        <img alt="<?= buscarTexto("WEB", "personaliza-tu-producto", "alt-info-producto1", "", $_SESSION['idioma']); ?>" style="display: none;" class="imagenes imagen_<?= $result->idproductos ?> img-fluid" src="data:image/png;base64,<?= base64_encode($result->imagen) ?>" />
                      </div>

                      <div class="col-md-6">
                        <img alt="<?= buscarTexto("WEB", "personaliza-tu-producto", "alt-info-producto2", "", $_SESSION['idioma']); ?>" style="display: none;" class="text-center imagenesforma imagenforma_<?= $result->idproductos ?> img-fluid" src=" data:image/png;base64,<?= base64_encode($result->imagen_forma) ?>" />
                      </div>
                    </div>

                    <div class="">
                      <h4 style="display: none;" class=" fs-18 descripciones_cortas descripcioncorta_<?= $result->idproductos ?> mb-3"><?= buscarTexto("PRG", "productos", $result->idproductos, "desc_corta", $_SESSION['idioma']); ?></h4>
                      <p style="display: none;" class="descripciones_largas descripcionlarga_<?= $result->idproductos ?> "><?= buscarTexto("PRG", "productos", $result->idproductos, "desc_larga", $_SESSION['idioma']); ?></p>
                      <div style="display: none;" class="descripciones_info descripcioninfo_<?= $result->idproductos ?>  resumen">
                        <p>
                          <?= buscarTexto("PRG", "informacion", $result->idinformacion, "descripcion", $_SESSION['idioma']); ?>
                        </p>
                        <p>
                          <?= buscarTexto("PRG", "informacion", $result->idinformacion, "descripcion1", $_SESSION['idioma']); ?>
                        </p>
                        <p>
                          <?= buscarTexto("PRG", "informacion", $result->idinformacion, "descripcion2", $_SESSION['idioma']); ?>
                        </p>
                        <p>
                          <?= buscarTexto("PRG", "informacion", $result->idinformacion, "descripcion3", $_SESSION['idioma']); ?>
                        </p>
                      </div>
                    </div>
                  <?php } ?>
                  </div></br>
              </div>
            </div><!-- modal body -->
          </div>
        </div>
      </div>
    </div> <!-- row-principal -->
  </div><!-- fin-container -->

  <script>
    function subir() {
      $("html, body").animate({
        scrollTop: 0
      }, "slow");
      $("#inicioScroll").animate({
        scrollTop: 0
      }, "slow");
    }

    var i = 0;
    window.addEventListener("load", function() {
      $('#modalPrincipal').modal('show');
      let tabs = document.querySelectorAll(".divpills a");
      let tabsMovil = document.querySelectorAll(".divpills2 a");
      let nextTab = document.getElementById("v-pills-next-tab");
      let nextTabMovil = document.getElementById("v-pills-next-tabmv");
      let tab1 = document.getElementById("a1");
      let tab2 = document.getElementById("a2");
      let tab3 = document.getElementById("a3");
      let tab4 = document.getElementById("a4");
      nextTab.addEventListener("click", function() {
        i = (i == (tabs.length - 1)) ? 0 : i + 1;
        tabs[i].click();
        //imprimir ventana modal principal
        $('#printButton').on('click', function() {
          if ($('.modal').is(':visible')) {
            var modalId = $(event.target).closest('.modal').attr('id');
            $('body').css('visibility', 'hidden');
            $("#" + modalId).css('visibility', 'visible');
            $('#' + modalId).removeClass('modal');
            window.print();
            $('body').css('visibility', 'visible');
            $('#' + modalId).addClass('modal');
          } else {
            window.print();
          }
        });

        switch ($('.nav-link[aria-selected="true"]').eq(1).attr("href")) {
          case "#tecnicas":
            i = 0;
            break;
          case "#diseno":
            i = 1;
            break;
          case "#colores":
            i = 2;
            break;
          case "#imagen":
            i = 3;
            break;
        }
        subir();
      }, false);

      nextTabMovil.addEventListener("click", function() {
        i = (i == (tabsMovil.length - 1)) ? 0 : i + 1;
        tabsMovil[i].click();
        subir();
      }, false);

      ////////////////////iconos tabs//////////////////////
      $('.primerBoton').on('click', function() {
        i = 0;
        $('#imgtecnica')[0].setAttribute("src", "iconos/Tecnica3.png");
        $('#imgdiseno')[0].setAttribute("src", "iconos/Diseno6.png");
        $('#imgcolores')[0].setAttribute("src", "iconos/Colores6.png");
        $('#imgsubirfoto')[0].setAttribute("src", "iconos/Subir-foto6.png");

        nextTab.textContent = $('#ptp_btn-sig').text() + " -> " + $('#nav2').text();
        $('#v-pills-next-tab').show();
        $('#anadirCarrito').hide();
        subir();
      });
      $('.segundoBoton').on('click', function() {
        i = 1;
        $('#imgtecnica')[0].setAttribute("src", "iconos/Tecnica6.png");
        $('#imgdiseno')[0].setAttribute("src", "iconos/Diseno3.png");
        $('#imgcolores')[0].setAttribute("src", "iconos/Colores6.png");
        $('#imgsubirfoto')[0].setAttribute("src", "iconos/Subir-foto6.png");

        nextTab.textContent = $('#ptp_btn-sig').text() + " -> " + $('#nav3').text();
        $('#v-pills-next-tab').show();
        $('#anadirCarrito').hide();
        subir();
      });
      $('.tercerBoton').on('click', function() {
        i = 2;
        $('#imgtecnica')[0].setAttribute("src", "iconos/Tecnica6.png");
        $('#imgdiseno')[0].setAttribute("src", "iconos/Diseno6.png");
        $('#imgcolores')[0].setAttribute("src", "iconos/Colores3.png");
        $('#imgsubirfoto')[0].setAttribute("src", "iconos/Subir-foto6.png");

        nextTab.textContent = $('#ptp_btn-sig').text() + " -> " + $('#nav4').text();
        $('#v-pills-next-tab').show();
        $('#anadirCarrito').hide();
        subir();
      });
      $('.cuartoBoton').on('click', function() {
        i = 3;
        $('#imgtecnica')[0].setAttribute("src", "iconos/Tecnica6.png");
        $('#imgdiseno')[0].setAttribute("src", "iconos/Diseno6.png");
        $('#imgcolores')[0].setAttribute("src", "iconos/Colores6.png");
        $('#imgsubirfoto')[0].setAttribute("src", "iconos/Subir-foto3.png");

        $('#v-pills-next-tab').hide();
        $('#anadirCarrito').show();
        subir();
      });

      //movil
      $('.primerBotonM').on('click', function() {
        i = 0;
        $('#imgtecnicam')[0].setAttribute("src", "iconos/Tecnica3.png");
        $('#imgdisenom')[0].setAttribute("src", "iconos/Diseno6.png");
        $('#imgcoloresm')[0].setAttribute("src", "iconos/Colores6.png");
        $('#imgsubirfotom')[0].setAttribute("src", "iconos/Subir-foto6.png");

        $('#v-pills-next-tabmv').show();
        $('#anadirCarritoMV').hide();
      });
      $('.segundoBotonM').on('click', function() {
        i = 1;
        $('#imgtecnicam')[0].setAttribute("src", "iconos/Tecnica6.png");
        $('#imgdisenom')[0].setAttribute("src", "iconos/Diseno3.png");
        $('#imgcoloresm')[0].setAttribute("src", "iconos/Colores6.png");
        $('#imgsubirfotom')[0].setAttribute("src", "iconos/Subir-foto6.png");

        $('#v-pills-next-tabmv').show();
        $('#anadirCarritoMV').hide();
      });
      $('.tercerBotonM').on('click', function() {
        i = 2;
        $('#imgtecnicam')[0].setAttribute("src", "iconos/Tecnica6.png");
        $('#imgdisenom')[0].setAttribute("src", "iconos/Diseno6.png");
        $('#imgcoloresm')[0].setAttribute("src", "iconos/Colores3.png");
        $('#imgsubirfotom')[0].setAttribute("src", "iconos/Subir-foto6.png");

        $('#v-pills-next-tabmv').show();
        $('#anadirCarritoMV').hide();
      });
      $('.cuartoBotonM').on('click', function() {
        i = 3;
        $('#imgtecnicam')[0].setAttribute("src", "iconos/Tecnica6.png");
        $('#imgdisenom')[0].setAttribute("src", "iconos/Diseno6.png");
        $('#imgcoloresm')[0].setAttribute("src", "iconos/Colores6.png");
        $('#imgsubirfotom')[0].setAttribute("src", "iconos/Subir-foto3.png");

        $('#v-pills-next-tabmv').hide();
        $('#anadirCarritoMV').show();
      });

      $(document).on('click', '#btnPedidoNuevo', function() {
        $('#btnPedidoNuevo').addClass("button--loading");
        $('#btnPedidoNuevo').prop("disabled", true);
      });
    }, false);

    function submitDelForm(id) {
      $('#ulLinkAddPedido').hide();
      $('#pstIdPedido').val(id);

      $('#formularioPersonalizar').submit();
    }

    function countChars(obj) {
      document.getElementById("contador1").innerHTML = obj.value.length + ' / 45';
    }

    function countChars2(obj) {
      document.getElementById("contador2").innerHTML = obj.value.length + ' / 45';
    }
  </script>
  <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
  <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
  <script src="./assets/js/popper.min.js"></script>
  <script src="./assets/js/bootstrap.min.js"></script>
  <script src="./assets/js/jquery.slicknav.min.js"></script>
  <script src="./assets/js/jquery.scrollUp.min.js"></script>
  <script src="./assets/js/jquery.form.js"></script>
  <script src="./assets/js/jquery.validate.min.js"></script>
  <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
  <script src="./assets/js/cookies.js"></script>
  <script src="./assets/js/personalizar.js"></script>
  <script src="./assets/js/main.js"></script>
  <script src="./assets/js/historial-pedidos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/pselect.js@4.0.1/dist/pselect.min.js"></script>
</body>

</html>