<?php
//header('Content-Type: application/json');
require_once('includes/config.php');
require_once('funciones/functions.php');

require_once('assets/_partials/idioma.php');

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
  <!-- ----------------------------MENU MOVIL-------------------------------------- -->

  <!-- <div class="color-nav m-b-30 ">
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
  </div> -->

  <!-- ---------------------------------FIN MENU MOVIL-------------------------------- -->
  <div class="container p-0">
    <div class="row m-0">
      <div class="col-lg-1 p-0 ">
        <div class="">
          <div class="nav nav-pills flex-column divpills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <!--PASO 1 TECNICA-->
            <div class="primerBoton nav-link active a-color text-center pt-5" id="v-pills-home" data-toggle="pill" href="#tecnicas" role="tab" aria-controls="v-pills-home" aria-selected="true">
              <a class="m-auto" id="a1"><img id="imgtecnica" src="iconos/Tecnica3.png" alt="<?= buscarTexto("WEB", "personaliza-tu-producto", "alt-tecnica", "", $_SESSION['idioma']); ?>"></a>
              <p class="configurator-nav text-center">1. <?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_nav-items-1", "", $_SESSION['idioma']); ?></p>
            </div>

            <!--PASO 2 DISEÑO-->
            <div class="segundoBoton nav-link a-color text-center" id="v-pills-profile" data-toggle="pill" href="#diseno" role="tab" aria-controls="v-pills-profile" aria-selected="false">
              <a id="a2"><img id="imgdiseno" src="iconos/Diseno6.png" alt="<?= buscarTexto("WEB", "personaliza-tu-producto", "alt-diseno", "", $_SESSION['idioma']); ?>"></a>
              <p class="configurator-nav text-center">2. <?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_nav-items-2", "", $_SESSION['idioma']); ?></p>
            </div>

            <!--PASO 3 COMPLEMENTOS-->
            <div class="tercerBoton nav-link a-color text-center" id="v-pills-profile" data-toggle="pill" href="#complementos" role="tab" aria-controls="v-pills-profile" aria-selected="false">
              <a id="a3"><img id="imgcomplementos" src="iconos/Diseno6.png" alt=""></a>
              <p class="configurator-nav text-center">3. Complementos</p>
            </div>

            <!--PASO 4 IMAGEN-->
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
                  <?php
                  try {
                    $sql = "SELECT c.idCategorias, p.idproductos, p.nombre, p.molde, p.max_colores, p.cmyk, p.colores, p.tope, p.imagen, p.idtexto_archivos, 
                    p.alto_min, p.ancho_min, p.ancho_max, p.alto_max
                    FROM categorias c 
                    INNER JOIN productos p ON c.idCategorias = p.categorias_idCategorias
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
                    <p>Seleccione la técnica y la cantidad deseada para comenzar.
                      Los siguientes pasos se cargarán automáticamente con las opciones de personalización disponibles.</p>

                    <div class="row">
                      <div class="col-6">
                        <label for="tecnica" class="fs-configurator">Técnica:</label>
                        <select name="tecnica" id="tecnica" class="nice-select">
                          <option class="" value=""><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_label_paso_1", "", $_SESSION['idioma']); ?>...</option>
                          <?php foreach ($results as $result => $productos) :
                          ?>
                            <optgroup label="<?= buscarTexto("PRG", "categorias", $result, "categoriaNombre", $_SESSION['idioma']); ?>">
                              <?php foreach ($productos as $producto) :
                                if ($producto['idproductos'] != '47') {
                              ?>
                                  <option class="<?= $producto['max_colores']  ?> <?= $producto['molde']  ?> <?= $producto['cmyk']  ?> <?= $producto['colores']  ?> <?= $producto['tope']  ?> <?= $producto['ancho_min']  ?> <?= $producto['alto_min']  ?> <?= $producto['ancho_max']  ?> <?= $producto['alto_max']  ?>" value="<?= $producto['idproductos']  ?>">
                                    <!--
                                    class:[0] maximo de colores -> máximo de colores a elegir 
                                          [1] molde -> es el precio del molde del producto
                                          [2] cmyk -> si el color va por cmyk (no selecciona colores) 
                                          [3] colores -> si tiene colores limitados, debe elegir
                                          //Si no es cmyk ni colores (ambos 0), el color lo subira por pdf con la imagen,
                                          subira imagen y elegira de la paleta, o lo pondra en los comentarios
                                          [4] tope -> si el producto admite tope
                                          [5] ancho minimo
                                          [6] alto minimo
                                          [7] ancho maximo
                                          [8] alto maximo
                                    -->
                                    <?= buscarTexto("PRG", "productos", $producto['idproductos'], "nombre", $_SESSION['idioma']);
                                    ?>
                                  </option>
                              <?php }
                              endforeach ?>
                            </optgroup>
                          <?php
                          endforeach ?>
                        </select>
                        <p>
                          <a id="hrefTecnica" href="" target="_blank" class="pregunta-formulario" style="display: none;">
                            <span>➔Obtén más información sobre </span>
                            <span id="nombreTecnica"></span>
                          </a>
                        </p>
                      </div>

                      <!--Cantidad-->
                      <div class="col-6">
                        <div class="">
                          <label for="cantidad" class="fs-configurator"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_2_cantidad", "", $_SESSION['idioma']); ?></label>
                          <input type="number" id="cantidad" class="nice-select-p ancho-40" name="cantidad">
                          <p style="display:none" class="p-tb-20 fs-configurator-2" id="errorCantidad"></p>
                        </div>
                      </div>
                    </div>

                    <!--Colores producto-->
                    <div class="row col-12 p-all-10" id="divColores" style="display: none;">
                      <p class="fs-configurator">Colores disponibles (selecciona hasta <span id="maximoColores"></span>):</p>
                      <div id="coloresProducto" class="row">
                      </div>
                    </div>
               
                    <!--Colores piel-->
                    <div class="" id="divColoresPiel" style="display: none;">
                      <p class="fs-configurator">Colores disponibles del soporte de piel:</p>
                      <div id="coloresPiel" class="row col-12 p-all-10">
                      </div>
                    </div>
                  
                    <!--Colores metal-->
                    <div class="" id="divColoresMetal" style="display: none;">
                      <p class="fs-configurator">Colores disponibles para el módulo de metal esmaltado:</p>
                      <div id="coloresMetal" class="row col-12 p-all-10">
                      </div>
                    </div>
                  </div>
                </fieldset>
              </div>
            </div>

            <!--Paso 2: Diseño----------------------------------->
            <div id="diseno" class="container tab-pane "><br>
              <div class="pad-mv">
                <fieldset>
                  <p class="p-tb-10 fs-18 mayus title-paso-configurator"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_2_tit", "", $_SESSION['idioma']); ?></p>

                  <div class="mb-5">
                    <!--Ancho x Alto-->
                    <div id="anchoPorAlto" style="display: none;">
                      <div class="form-group">
                        <p>Configura las medidas de tu diseño ingresando el ancho y alto en milímetros:</p>
                        <!--Input ancho-->
                        <div id="divInputAncho" style="display: none;">
                          <label for="anchoProductoInput" class="m-t-20 fs-configurator">Ancho (en milímetros)</label>
                          <input name="anchoProductoInput" type="number" id="anchoProductoInput" class="nice-select-p ancho-40">
                          <p style="display:none" class="p-tb-20 fs-configurator-2" id="errorAnchoProducto"></p>
                        </div>

                        <!--Select ancho-->
                        <div id="divSelectAncho" style="display: none;">
                          <label for="anchoProductoInput" class="m-t-20 fs-configurator">Elige el ancho (en milímetros)</label>
                          <select name="anchoProductoSelect" id="anchoProductoSelect" class="nice-select-p">
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

                        <!--Input alto-->
                        <label for="altoProducto" class="m-t-20 fs-configurator">Alto (en milímetros)</label>
                        <input name="altoProducto" type="number" id="altoProducto" class="nice-select-p ancho-40">
                        <p style="display:none" class="p-tb-20 fs-configurator-2" id="errorAltoProducto"></p>
                      </div>
                    </div>


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
                        <p class="fs-configurator-2"><br>
                          <span class="m-t-10" id="errorForma"></span>
                        </p>
                      </div>


                    </div>

                    <div class="col-md-5">
                      <!--Medidas de la base de tela-->
                      <div style="display: none;" id="divMedidasTela" class="form-group">
                        <p class="fs-configurator"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_2_sup-base", "", $_SESSION['idioma']); ?></p>
                        <label for="num1" class="m-t-20"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_2_ancho-base", "", $_SESSION['idioma']); ?></label>
                        <input type="number" id="cant1" class="nice-select-p ancho-40">
                        <label for="num2" class="m-t-20"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_2_largo-base", "", $_SESSION['idioma']); ?></label>
                        <input type="number" id="cant2" class="nice-select-p ancho-40">
                        <p class="fs-configurator-2"><br>
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
                    </div>
                  </div>
                </fieldset>
              </div>
            </div>

            <!--Paso 3: Complementos----------------------------------->
            <div id="complementos" class="container tab-pane "><br>
              <div class="pad-mv">
                <fieldset>
                  <label for="tecnica" class="title-paso-configurator mayus fs-18 p-b-20">PASO 3: AÑADIR COMPLEMENTOS</label>
                  <p>Los complementos son <b>opcionales</b> y puedes elegirlos según tus preferencias.
                    Si no deseas agregar complementos, puedes continuar al siguiente paso.</p>

                  <div class="p-tb-20">
                    <!--COMPLEMENTO 1: Tope de pulsera-->
                    <div style="display: none;" id="topePulsera">
                      <p class="fs-configurator "><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_1_añadir-tope", "", $_SESSION['idioma']); ?></p>

                      <!--Quiere topes sí/no-->
                      <div class="cc-selector">
                        <input id="siTopePulsera" type="radio" name="tope" value="1" />
                        <?= buscarTexto("WEB", "generico", "si", "", $_SESSION['idioma']); ?><label class="drinkcard-cc contope" for="siTopePulsera"></label>
                        <input id="noTopePulsera" type="radio" name="tope" value="0" checked="checked" />
                        <?= buscarTexto("WEB", "generico", "no", "", $_SESSION['idioma']); ?><label class="drinkcard-cc sintope" for="noTopePulsera"></label>
                      </div>
                      <!--Cantidad de topes-->
                      <div style="display: none;" id="divCantidadTopes" class="form-group">
                        <label for="cantidad" class="m-t-20"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_1_cant-topes", "", $_SESSION['idioma']); ?></label>
                        <input type="number" id="cantidadTopes" class="nice-select m-b-30 ancho-40" name="cantidadTopes">
                      </div>
                    </div>

                    <!--COMPLEMENTO 2: Bases-->
                    <div id="selectBase" style="display: none;">
                      <p class="fs-configurator mb-0">¿Quieres añadir base?</p>
                      <p>
                        <a href="bases-tela-y-cierre" target="_blank" class="pregunta-formulario">
                          <span>➔</span>
                          <span>Obtén más información sobre nuestras bases.</span>
                        </a>
                      </p>
                      <div class="row">
                        <!--Base de tela-->
                        <div id="divTela" class="cc-selector col-3 text-center" style="display: none;">
                          <input id="sitela" type="radio" name="base" value="tela" />
                          <label class="drinkcard-cc base-tela" for="sitela"></label>
                          <p style="font-size:12px; color:#0075BE;">BASE DE TELA</p>
                        </div>

                        <!--Base de cierre gancho-->
                        <div id="divGancho" class="cc-selector col-3 text-center" style="display: none;">
                          <input id="sigancho" type="radio" name="base" value="gancho" />
                          <label class="drinkcard-cc base-gancho" for="sigancho"></label>
                          <p style="font-size:12px; color:#0075BE;">BASE DE CIERRE GANCHO</p>
                        </div>

                        <!--Base de cierre gancho + pelo-->
                        <div id="divGanchoPelo" class="cc-selector col-3 text-center" style="display: none;">
                          <input id="siganchopelo" type="radio" name="base" value="ganchopelo" />
                          <label class="drinkcard-cc base-pelo" for="siganchopelo"></label>
                          <p style="font-size:12px; color:#0075BE;">BASE DE CIERRE GANCHO + PELO</p>
                        </div>

                        <!--Sin base-->
                        <div id="divSinBase" class="cc-selector col-3 text-center seleccionado" style="display: none;">
                          <input id="sinbase" type="radio" name="base" value="sinbase" checked="checked" />
                          <label class="drinkcard-cc singancho" for="sinbase"></label>
                          <p style="font-size:12px; color:#0075BE;">SIN BASE</p>
                        </div>
                      </div>
                    </div>
                    <!--COMPLEMENTO 3: Sin complemento-->
                    <p id="sincomplemento" class="fs-configurator" style="display: none;">No hay complementos disponibles para la técnica seleccionada. Puedes continuar con el siguiente paso.</p>
                  </div>
                </fieldset>
              </div>
            </div>

            <!--Paso 4: Imagen------------------------------------->
            <div id="imagen" class="container tab-pane "><br>
              <div class="pad-mv">
                <fieldset>
                  <div>
                    <p class="p-tb-10 fs-18 mayus title-paso-configurator"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_4_tit", "", $_SESSION['idioma']); ?></p>
                    <p>Opción 1: Personaliza tu diseño a partir de una imagen</p>
                    <p>Opción 2: Proporciona un PDF y detalles exactos</p>

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

      <!--RESUMEN Y PRESUPUESTO-->
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
            <div class="" style="overflow-x: auto;">
              <table class="table table-striped table-bordered" style="font-size: 14px;">
                <!-- PASO 1 TECNICA-->
                <tr>
                  <th rowspan="3">Paso 1<br>
                    <div class="paso1 paso-incompleto">INCOMPLETO</div>
                  </th> <!-- rowspan="3" indica que esta celda abarca 3 filas -->
                  <td>Técnica: <span style="font-weight: bold;" id="resumenTecnica"></span></td>
                  <td></td>
                </tr>
                <tr>
                  <td>Molde del producto</td>
                  <td><span style="font-weight: bold;" id="resumenMoldeProducto"></span></td>
                </tr>
                <tr>
                  <td>Cantidad: <span style="font-weight: bold;" id="resumenCantidad"></span></td>
                  <td></td>
                </tr>

                <!-- PASO 2 DIEÑO-->
                <tr>
                  <th id="paso2_rowspan" rowspan="1">Paso 2<div class="paso2 paso-incompleto">INCOMPLETO</div>
                  </th> <!-- rowspan="3" indica que esta celda abarca 3 filas -->
                  <td>Precio del producto (<span style="font-weight: bold;" id="resumenPPU">0</span>€/ud)</td>
                  <td><span style="font-weight: bold;" id="resumenPrecioProducto"></span></td>
                </tr>
                <tr id="tdAnchoProducto" style="display: none;">
                  <td>Ancho del producto: <span style="font-weight: bold;" id="resumenAnchoProducto"></span></td>
                  <td></td>
                </tr>
                <tr id="tdAltoProducto" style="display: none;">
                  <td>Alto del producto: <span style="font-weight: bold;" id="resumenAltoProducto"></span></td>
                  <td></td>
                </tr>
                <tr id="tdSuperficieProducto" style="display: none;">
                  <td>Superficie: <span style="font-weight: bold;" id="resumenSuperficieProducto"></span></td>
                  <td></td>
                </tr>
                <tr id="tdFormaProducto" style="display: none;">
                  <td>Forma: <span style="font-weight: bold;" id="resumenFormaProducto"></span></td>
                  <td></td>
                </tr>

                <!-- PASO 3 COMPLEMENTOS-->
                <tr>
                  <th id="paso3_rowspan" rowspan="">Paso 3<div class="paso3 paso-completo">COMPLETO</div>
                  </th> <!-- rowspan="3" indica que esta celda abarca 3 filas -->
                  <td id="tdTipoBase" style="display: none;">Tipo de base: <span style="font-weight: bold;" id="resumenTipoBase"></span></td>
                  <td></td>
                </tr>
                <tr id="tdAnchoBase" style="display: none;">
                  <td>Ancho de la base: <span style="font-weight: bold;" id="resumenAnchoBase"></span></td>
                  <td></td>
                </tr>
                <tr id="tdAltoBase" style="display: none;">
                  <td>Alto de la base: <span style="font-weight: bold;" id="resumenAltoBase"></span></td>
                  <td></td>
                </tr>
                <tr id="tdSuperficieBase" style="display: none;">
                  <td>Superficie de la base: <span style="font-weight: bold;" id="resumenSuperficieBase"></span></td>
                  <td></td>
                </tr>
                <tr id="tdColorBase" style="display: none;">
                  <td>Color de la base: <span style="font-weight: bold;" id="resumenColorBase"></span></td>
                  <td></td>
                </tr>
                <tr id="tdMoldeBase" style="display: none;">
                  <td>Molde de la base: <span style="font-weight: bold;" id="resumenMoldeBase"></span></td>
                  <td></td>
                </tr>
                <tr id="tdPrecioBase" style="display: none;">
                  <td>Precio de la base (<span style="font-weight: bold;" id="resumenPPUbase">0</span>€/ud)</td>
                  <td><span style="font-weight: bold;" id="resumenPrecioBase"></span></td>
                </tr>
                <tr id="tdCantidadTopes" style="display: none;">
                  <td>Cantidad de topes: <span style="font-weight: bold;" id="resumenCantidadTopes"></span></td>
                  <td></td>
                </tr>
                <tr id="tdPrecioTopes" style="display: none;">
                  <td>Precio topes (<span style="font-weight: bold;" id="resumenPPUtopes">0</span>€/ud)</td>
                  <td><span style="font-weight: bold;" id="resumenPrecioTopes"></span></td>
                </tr>

                <!-- PASO 4 COLORES-->
                <tr>
                  <th rowspan="">Paso 4<div class="paso-incompleto">INCOMPLETO</div>
                  </th> <!-- rowspan="3" indica que esta celda abarca 3 filas -->
                  <td id="tdColores" style="display: none;">Colores elegidos: <span style="font-weight: bold;" id="resumenColoresElegidos"></span></td>
                  <td></td>
                </tr>
                <tr id="tdColorPiel" style="display: none;">
                  <td>Color piel: <span style="font-weight: bold;" id="resumenColorPiel"></span></td>
                  <td></td>
                </tr>
                <tr id="tdColorMetal" style="display: none;">
                  <td>Color metal: <span style="font-weight: bold;" id="resumenColorMetal"></span></td>
                  <td></td>
                </tr>
            </div>

            <!-- PASO 5-->
            <tr>
              <th rowspan="">Paso 5<div class="paso-incompleto">INCOMPLETO</div>
              </th> <!-- rowspan="3" indica que esta celda abarca 3 filas -->
              <td>Imagen: <span style="font-weight: bold;" id="resumenImagen"></span></td>
              <td></td>
            </tr>

            <!-- SUBTOTAL -->
            <tr>
              <th colspan="2" style="text-align: right;">SUBTOTAL</th> <!-- rowspan="3" indica que esta celda abarca 3 filas -->
              <th><span style="font-weight: bold;" id="resumenSubtotal"></span></th>
            </tr>
            <!-- Otras filas se generan dinámicamente con JavaScript -->
            </table>
        </div>
        </fieldset>
      </div>

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
                  <p style="display:none;" id="ombreDiseno" class="fs-configurator-2">Nombre de diseño ya existe.</p>
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
      // $('#modalPrincipal').modal('show');
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
          case "#complementos":
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
        // $('#imgtecnica')[0].setAttribute("src", "iconos/Tecnica3.png");
        // $('#imgdiseno')[0].setAttribute("src", "iconos/Diseno6.png");
        // $('#imgcolores')[0].setAttribute("src", "iconos/Colores6.png");
        // $('#imgsubirfoto')[0].setAttribute("src", "iconos/Subir-foto6.png");

        nextTab.textContent = $('#ptp_btn-sig').text() + " -> " + $('#nav2').text();
        $('#v-pills-next-tab').show();
        $('#anadirCarrito').hide();
        subir();
      });
      $('.segundoBoton').on('click', function() {
        i = 1;
        // $('#imgtecnica')[0].setAttribute("src", "iconos/Tecnica6.png");
        // $('#imgdiseno')[0].setAttribute("src", "iconos/Diseno3.png");
        // $('#imgcolores')[0].setAttribute("src", "iconos/Colores6.png");
        // $('#imgsubirfoto')[0].setAttribute("src", "iconos/Subir-foto6.png");

        nextTab.textContent = $('#ptp_btn-sig').text() + " -> " + $('#nav3').text();
        $('#v-pills-next-tab').show();
        $('#anadirCarrito').hide();
        subir();
      });
      $('.tercerBoton').on('click', function() {
        i = 2;
        // $('#imgtecnica')[0].setAttribute("src", "iconos/Tecnica6.png");
        // $('#imgdiseno')[0].setAttribute("src", "iconos/Diseno6.png");
        // $('#imgcolores')[0].setAttribute("src", "iconos/Colores3.png");
        // $('#imgsubirfoto')[0].setAttribute("src", "iconos/Subir-foto6.png");

        nextTab.textContent = $('#ptp_btn-sig').text() + " -> " + $('#nav4').text();
        $('#v-pills-next-tab').show();
        $('#anadirCarrito').hide();
        subir();
      });
      $('.cuartoBoton').on('click', function() {
        i = 3;
        // $('#imgtecnica')[0].setAttribute("src", "iconos/Tecnica6.png");
        // $('#imgdiseno')[0].setAttribute("src", "iconos/Diseno6.png");
        // $('#imgcolores')[0].setAttribute("src", "iconos/Colores6.png");
        // $('#imgsubirfoto')[0].setAttribute("src", "iconos/Subir-foto3.png");

        $('#v-pills-next-tab').hide();
        $('#anadirCarrito').show();
        subir();
      });


      //movil
      // $('.primerBotonM').on('click', function() {
      //   i = 0;
      //   $('#imgtecnicam')[0].setAttribute("src", "iconos/Tecnica3.png");
      //   $('#imgdisenom')[0].setAttribute("src", "iconos/Diseno6.png");
      //   $('#imgcoloresm')[0].setAttribute("src", "iconos/Colores6.png");
      //   $('#imgsubirfotom')[0].setAttribute("src", "iconos/Subir-foto6.png");

      //   $('#v-pills-next-tabmv').show();
      //   $('#anadirCarritoMV').hide();
      // });
      // $('.segundoBotonM').on('click', function() {
      //   i = 1;
      //   $('#imgtecnicam')[0].setAttribute("src", "iconos/Tecnica6.png");
      //   $('#imgdisenom')[0].setAttribute("src", "iconos/Diseno3.png");
      //   $('#imgcoloresm')[0].setAttribute("src", "iconos/Colores6.png");
      //   $('#imgsubirfotom')[0].setAttribute("src", "iconos/Subir-foto6.png");

      //   $('#v-pills-next-tabmv').show();
      //   $('#anadirCarritoMV').hide();
      // });
      // $('.tercerBotonM').on('click', function() {
      //   i = 2;
      //   $('#imgtecnicam')[0].setAttribute("src", "iconos/Tecnica6.png");
      //   $('#imgdisenom')[0].setAttribute("src", "iconos/Diseno6.png");
      //   $('#imgcoloresm')[0].setAttribute("src", "iconos/Colores3.png");
      //   $('#imgsubirfotom')[0].setAttribute("src", "iconos/Subir-foto6.png");

      //   $('#v-pills-next-tabmv').show();
      //   $('#anadirCarritoMV').hide();
      // });
      // $('.cuartoBotonM').on('click', function() {
      //   i = 3;
      //   $('#imgtecnicam')[0].setAttribute("src", "iconos/Tecnica6.png");
      //   $('#imgdisenom')[0].setAttribute("src", "iconos/Diseno6.png");
      //   $('#imgcoloresm')[0].setAttribute("src", "iconos/Colores6.png");
      //   $('#imgsubirfotom')[0].setAttribute("src", "iconos/Subir-foto3.png");

      //   $('#v-pills-next-tabmv').hide();
      //   $('#anadirCarritoMV').show();
      // });

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
  <script src="./assets/js/encargar-diseno.js"></script>
  <script src="./assets/js/main.js"></script>
  <script src="./assets/js/historial-pedidos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/pselect.js@4.0.1/dist/pselect.min.js"></script>

  <script>
    $('input[name="base"]').change(function() {
      // Quitar la clase 'seleccionado' de todos los elementos 'input' con 'name="base"'
      $('input[name="base"]').parent().removeClass('seleccionado');
      // Agregar la clase 'seleccionado' solo al elemento actual
      $(this).parent().addClass('seleccionado');
    });
  </script>
</body>

</html>