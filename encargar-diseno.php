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

  <div class="color-nav m-b-30 ">
    <!--  <div class="nav nav-pills-mv divpills2 evenly" id="v-pills-tab" role="tablist" aria-orientation="vertical">
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
    </div>-->
  </div>

  <!-- ---------------------------------FIN MENU MOVIL-------------------------------- -->
  <div class="container p-0">
    <div class="row m-0">
      <div class="col-lg-1 p-0 ">
        <div class="">
          <div class="nav nav-pills flex-column divpills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <!--PASO 1 TECNICA-->
            <div class="primerBoton nav-link active a-color text-center pt-5" id="nav-paso1" data-toggle="pill" href="#tecnicas" role="tab" aria-controls="nav-paso1" aria-selected="true">
              <a class="m-auto" id="a1"><img id="imgtecnica" src="iconos/Tecnica3.png" alt="<?= buscarTexto("WEB", "personaliza-tu-producto", "alt-tecnica", "", $_SESSION['idioma']); ?>"></a>
              <p class="configurator-nav text-center">1. <?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_nav-items-1", "", $_SESSION['idioma']); ?></p>
            </div>

            <!--PASO 2 DISEÑO-->
            <div class="segundoBoton nav-link a-color text-center" id="nav-paso2" data-toggle="pill" href="#diseno" role="tab" aria-controls="nav-paso2" aria-selected="false">
              <a id="a2"><img id="imgdiseno" src="iconos/Diseno6.png" alt="<?= buscarTexto("WEB", "personaliza-tu-producto", "alt-diseno", "", $_SESSION['idioma']); ?>"></a>
              <p class="configurator-nav text-center">2. <?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_nav-items-2", "", $_SESSION['idioma']); ?></p>
            </div>

            <!--PASO 3 COMPLEMENTOS-->
            <div class="tercerBoton nav-link a-color text-center" id="nav-paso3" data-toggle="pill" href="#complementos" role="tab" aria-controls="nav-paso3" aria-selected="false">
              <a id="a3"><img id="imgcomplementos" src="iconos/Diseno6.png" alt=""></a>
              <p class="configurator-nav text-center">3. Complementos</p>
            </div>

            <!--PASO 4 IMAGEN-->
            <div class="cuartoBoton nav-link a-color text-center" id="nav-paso4" data-toggle="pill" href="#imagen" role="tab" aria-controls="nav-paso4" aria-selected="false">
              <a id="a4"><img id="imgsubirfoto" src="iconos/Subir-foto6.png" alt="<?= buscarTexto("WEB", "personaliza-tu-producto", "alt-foto", "", $_SESSION['idioma']); ?>"></a>
              <p class="configurator-nav text-center">4. <?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_nav-items-4", "", $_SESSION['idioma']); ?></p>
            </div>
          </div>
        </div>
      </div>


      <div class="col-lg-7 este pad-mv" id="inicioScroll">
        <!--Formulario-->
        <form id="formularioPersonalizar" action="DAOs/diseno-nuevoDAO.php?pag=<?= buscarTextoConReturn("WEB", "paginas", "historial-pedidos", "", $_SESSION['idioma']); ?>" method="POST" enctype="multipart/form-data">
          <div class="tab-content p-0">
            <!--Paso 1: Tecnica------------------------------------------------>
            <div id="tecnicas" class="container tab-pane active "><br>
              <div class="pad-mv">
                <fieldset>
                  <?php
                  try {
                    $sql = "SELECT c.idCategorias, p.idproductos, p.nombre, p.molde, p.max_colores, p.cmyk, 
                    p.colores_pantone, p.colores_limitados, p.tope, p.alto_min, p.ancho_min, p.ancho_max, p.alto_max
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
                              ?>
                                <option class="<?= $producto['max_colores']  ?> <?= $producto['molde']  ?> <?= $producto['cmyk']  ?> <?= $producto['colores_limitados']  ?> <?= $producto['tope']  ?> <?= $producto['ancho_min']  ?> <?= $producto['alto_min']  ?> <?= $producto['ancho_max']  ?> <?= $producto['alto_max']  ?> <?= $producto['colores_pantone']  ?>" value="<?= $producto['idproductos']  ?>">
                                  <!--
                                    class:[0] maximo de colores -> máximo de colores a elegir 
                                          [1] molde -> es el precio del molde del producto
                                          [2] cmyk -> si el color va por cmyk (no selecciona colores) 
                                          [3] colores_limitados -> si tiene colores limitados, debe elegir en el paso 1
                                          //Si no es cmyk ni colores (ambos 0), el color lo subira por pdf con la imagen,
                                          subira imagen y elegira de la paleta, o lo pondra en los comentarios
                                          [4] tope -> si el producto admite tope
                                          [5] ancho minimo
                                          [6] alto minimo
                                          [7] ancho maximo
                                          [8] alto maximo
                                          [9] colores_pantone -> si tiene colores, debe elegir en el paso 4
                                    -->
                                  <?= buscarTexto("PRG", "productos", $producto['idproductos'], "nombre", $_SESSION['idioma']);
                                  ?>
                                </option>
                              <?php
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
                      <p class="fs-configurator">Colores disponibles (selecciona hasta <span class="maximoColores"></span>):</p>
                      <div id="coloresProducto" class="row">
                      </div>
                    </div>
                    <!--Campo con los seleccionados-->


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
                          <select name="anchoProductoSelect" id="anchoProductoSelect" class="nice-select-p ancho-40">
                            <option value="0"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_2_ancho-select", "", $_SESSION['idioma']); ?>...</option>
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

                    <!--Formas-->
                    <div id="divFormas" style="display: none;">
                      <p>Selecciona la forma que mejor se adapte a tu diseño</p>
                      <p class='p-b-20 fs-configurator'>Formas disponibles:</p>
                      <?php
                      try {
                        $sql1 = "SELECT * FROM pertex.formas;";
                        $query = $conn->query($sql1);
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                      } catch (Exception $e) {
                        // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
                      }
                      ?>
                      <div class="row">
                        <?php foreach ($results as $result) { ?>
                          <div class="cc-selector divCadaForma text-center col-3" id="forma<?= $result->id_formas ?>">
                            <input type="radio" name="formas" value="<?= $result->id_formas ?>" id="forma_<?= $result->id_formas ?>" />
                            <label class="drinkcard-cc mb-0  forma_<?= $result->id_formas ?>" for="forma_<?= $result->id_formas ?>"></label>
                            <p style="font-size:12px;color:#0075BE;"><?= $result->formas ?></p>
                          </div>
                        <?php } ?>
                      </div>
                    </div>

                    <!--Mensaje en caso de productos que no llevan medidas ni forma-->
                    <div id="divMensajeDiseno" style="display: none;">
                      <p class='p-b-20 fs-configurator'>La técnica seleccionada tiene un diseño fijo. Puedes continuar con el siguiente paso.</p>
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
                      <!--¿Quiere topes?-->
                      <p class="fs-configurator mb-0 "><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_1_añadir-tope", "", $_SESSION['idioma']); ?></p>
                      <p>
                        <a href="pulseras" target="_blank" class="pregunta-formulario">
                          <span>➔</span>
                          <span>Obtén más información sobre Condint.</span>
                        </a>
                      </p>

                      <div class="row">
                        <!--Sí-->
                        <div class="cc-selector col-3 text-center">
                          <input id="siTopePulsera" type="radio" name="tope" value="1" />
                          <label class="drinkcard-cc mb-0 contope" for="siTopePulsera"></label>
                          <p style="color:#0075BE;">SÍ</p>
                        </div>

                        <!--No-->
                        <div id="divNoTopePulsera" class="cc-selector col-3 text-center seleccionado">
                          <input id="noTopePulsera" type="radio" name="tope" value="0" checked="checked" />
                          <label class="drinkcard-cc mb-0 sintope" for="noTopePulsera"></label>
                          <p style="color:#0075BE;">NO</p>
                        </div>
                      </div>

                      <!--Cantidad de topes-->
                      <div style="display: none;" id="divCantidadTopes" class="form-group mt-10">
                        <label for="cantidadTopes" class="fs-configurator"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_paso_1_cant-topes", "", $_SESSION['idioma']); ?></label>
                        <input type="number" id="cantidadTopes" class="nice-select-p ancho-40" name="cantidadTopes">
                      </div>
                    </div>

                    <!--COMPLEMENTO 2: Bases-->
                    <div id="selectBase" style="display: none;">
                      <p class="fs-configurator mb-0 ">¿Quieres añadir base?</p>
                      <p>
                        <a href="bases-tela-y-cierre" target="_blank" class="pregunta-formulario">
                          <span>➔</span>
                          <span>Obtén más información sobre nuestras bases.</span>
                        </a>
                      </p>
                      <div class="row">
                        <!--Base de tela-->
                        <div id="divTela" class="cc-selector col-3 text-center" style="display: none;">
                          <input id="sitela" type="radio" name="base" value="1" />
                          <label class="drinkcard-cc mb-0 base-tela" for="sitela"></label>
                          <p style="font-size:12px; color:#0075BE;">BASE DE TELA</p>
                        </div>

                        <!--Base de cierre gancho-->
                        <div id="divGancho" class="cc-selector col-3 text-center" style="display: none;">
                          <input id="sigancho" type="radio" name="base" value="2" />
                          <label class="drinkcard-cc mb-0 base-gancho" for="sigancho"></label>
                          <p style="font-size:12px; color:#0075BE;">BASE DE CIERRE GANCHO</p>
                        </div>

                        <!--Base de cierre gancho + pelo-->
                        <div id="divGanchoPelo" class="cc-selector col-3 text-center" style="display: none;">
                          <input id="siganchopelo" type="radio" name="base" value="3" />
                          <label class="drinkcard-cc mb-0 base-pelo" for="siganchopelo"></label>
                          <p style="font-size:12px; color:#0075BE;">BASE DE CIERRE GANCHO + PELO</p>
                        </div>

                        <!--Sin base-->
                        <div id="divSinBase" class="cc-selector col-3 text-center seleccionado" style="display: none;">
                          <input id="sinbase" type="radio" name="base" value="sinbase" checked="checked" />
                          <label class="drinkcard-cc mb-0 singancho" for="sinbase"></label>
                          <p style="font-size:12px; color:#0075BE;">SIN BASE</p>
                        </div>
                      </div>

                      <!--Medidas de la base de tela-->
                      <div style="display: none;" id="divMedidasTela" class="form-group">
                        <!--Ancho-->
                        <label for="anchoBaseInput" class="m-t-20 fs-configurator">Ancho (en milímetros)</label>
                        <input name="anchoBaseInput" type="number" id="anchoBaseInput" class="nice-select-p ancho-40">
                        <p style="display:none" class="p-tb-20 fs-configurator-2" id="errorAnchoBase">El ancho de la base debe ser igual o mayor que el ancho del diseño</p>
                        <!--Alto-->
                        <label for="altoBaseInput" class="m-t-20 fs-configurator">Alto (en milímetros)</label>
                        <input name="altoBaseInput" type="number" id="altoBaseInput" class="nice-select-p ancho-40">
                        <p style="display:none" class="p-tb-20 fs-configurator-2" id="errorAltoBase">El alto de la base debe ser igual o mayor que el alto del diseño</p>
                      </div>

                      <!--Colores de la base-->
                      <div class="row col-12 p-all-10" id="divColoresBase" style="display: none;">
                        <p class="fs-configurator">Colores disponibles para la base:</p>
                        <div id="coloresBase" class="row">
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
                    <p>Carga tu diseño en la <b>mayor calidad y resolución</b> disponible.</p>

                    <p id="textoPantone" style="display: none;">Para la técnica seleccionada, especifica los colores de una de las siguientes maneras:</p>
                    <p id="textoCMYK" style="display: none;">Para la técnica seleccionada se definirán los colores en CMYK por el contenido del archivo subido de una de las siguientes maneras:</p>

                    <p id="txtImagen1" class="fs-configurator"><i class="ti-hand-point-right" aria-hidden="true"></i> Imagen en formato png o jpg.</p>
                    <p id="txtImagen2" class="fs-configurator"><i class="ti-hand-point-right" aria-hidden="true"></i> PDF con las imágenes necesarias. Puede incluir instruccies adicionales.</p>
                    <p id="txtImagen3" class="fs-configurator"><i class="ti-hand-point-right" aria-hidden="true"></i> Diseño vectorizado en formato ai, eps o svg.</p>

                    <label for="archivo" class="btn mt-2">Selecciona</label>
                    <input style="visibility:hidden;" name="archivo" id="archivo" type="file" /><br>

                    <div style="display:none;" id="extension-incorrecta" class="p-2 imagen-error" style="font-size: 16px;">
                      <i class="mr-10 ti-face-sad" aria-hidden="true"></i>Ha ocurrido un error. Extensión incorrecta
                    </div>
                    <div style="display:none;" id="tamano-incorrecto" class="p-2 imagen-error" style="font-size: 16px;">
                      <i class="mr-10 ti-face-sad" aria-hidden="true"></i>Ha ocurrido un error. Tamaño máximo 100MB
                    </div>
                    <div style="display:none;" id="imagen-correcta" class="p-2 imagen-buena" style="font-size: 16px;">
                      <i class="mr-10 ti-face-smile" aria-hidden="true"></i>Imagen subida correctamente
                    </div>

                    <div class="mt-3 mb-3">
                      <label for="comentariosDiseno" class="form-label">Instrucciones detalladas o comentarios adicionales<span id="textoCodigosColor">. Puedes indicar códigos de color específicos (CMYK, PANTONE, etc.)</span>:</label>
                      <textarea class="form-control" id="comentariosDiseno" name="comentariosDiseno" rows=5 cols=50></textarea>
                    </div>

                    <div id="divTxtAdvertenciaColores" class="color-alert p-2" style="font-size: 16px;">
                      <i class="ti-alert" aria-hidden="true"></i> De no especificar los colores, nuestros diseñadores los elegirán basados en la imagen proporcionada y se utilizará el hilo más similar.
                    </div>

                  </div>
                </fieldset>
              </div>
            </div>
          </div>

          <div class="nav  nav-pills" id="h-pills-tab" role="tablist" style="float:right">
            <!--ORDENADOR-->
            <button class="btn mb-5" id="v-pills-next-tab" type="button" disabled>FALTAN CAMPOS POR COMPLETAR</button>
            <button style="display:none" id="encargarDiseno" type="button" data-toggle="modal" data-target="#encargarModal" class="btn mt-5" disabled>FALTAN CAMPOS POR COMPLETAR</button>

            <!--MOVIL-->
            <button class="btn mb-5" id="v-pills-next-tabmv" type="button" disabled>FALTAN CAMPOS POR COMPLETAR</button>
            <button class="btn mb-5" style="display:none" id="encargarDisenoMV" type="button" data-toggle="modal" data-target="#encargarModal"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_confirma-añadir", "", $_SESSION['idioma']); ?></button>
          </div>
      </div>

      <!--RESUMEN Y PRESUPUESTO-->
      <div class="col-md-4 este2 p-0">
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
              <!--Input oculto con la suma de los moldes-->
              <input id="precioMoldes" name="precioMoldes" value="" hidden>
              <!--Input oculto con el subtotal (la suma de todo)-->
              <input id="precioSubtotal" name="precioSubtotal" value="" hidden>

              <table class="table table-bordered" style="font-size: 14px;">
                <!-- PASO 1 TECNICA-->
                <tr>
                  <th rowspan="3" id="paso1_rowspan">Paso 1<br>
                    <div class="paso1 paso-incompleto">INCOMPLETO</div>
                  </th>
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
                <tr id="tdColores" style="display: none;">
                  <td>Colores: <span style="font-weight: bold;" id="resumenColores"></span></td>
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

                <!-- PASO 2 DIEÑO-->
                <tr>
                  <th id="paso2_rowspan" rowspan="1">Paso 2<div class="paso2 paso-incompleto">INCOMPLETO</div>
                  </th>
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
                  </th>
                  <td id="tdPrecioComplemento" style="display: none;">Precio del complemento (<span style="font-weight: bold;" id="resumenPPUComplemento">0</span>€/ud)</td>
                  <td><span style="font-weight: bold;" id="resumenPrecioComplemento"></span></td>
                </tr>
                <tr id="tdTipoBase" style="display: none;">
                  <td>Tipo de base: <span style="font-weight: bold;" id="resumenTipoBase"></span></td>
                  <td></td>
                </tr>
                <tr id="tdMoldeBase" style="display: none;">
                  <td>Molde de la base</td>
                  <td><span style="font-weight: bold;" id="resumenMoldeBase"></span></td>
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
                <tr id="tdCantidadTopes" style="display: none;">
                  <td>Cantidad de topes: <span style="font-weight: bold;" id="resumenCantidadTopes"></span></td>
                  <td></td>
                </tr>

                <!-- PASO 4-->
                <tr>
                  <th>Paso 4<div class="paso4 paso-incompleto">COMPLETO</div>
                  </th>
                  <td>Imagen: <span style="font-weight: bold;" id="resumenImagen"></span></td>
                  <td></td>
                </tr>

                <!-- SUBTOTAL -->
                <tfoot>
                  <tr>
                    <th colspan="2" style="text-align: right;">SUBTOTAL</th>
                    <th><span style="font-weight: bold;" id="resumenSubtotal"></span></th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </fieldset>
        </div>

        <!--Modal a que pedido agregar-->
        <div class="modal fade" id="encargarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1000px;">
            <div class="modal-content modal-aviso">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="text-center p-all-10">
                <h3>¡Casi listo!</h3>
              </div>

              <div class="modal-body">
                <p class="mb-3">Por favor, revisa tus datos de diseño y asegúrate de que todo esté correcto antes de enviar.</p>
                <p>Tu diseño será entregado a nuestros diseñadores, y recibirás información sobre el proceso en tu correo electrónico.</p>

                <button type="submit" class="btn btn-primary">ENCARGAR DISEÑO</button>
              </div>
            </div>
          </div>
        </div>
        </form>
      </div> <!-- row-principal -->
    </div><!-- fin-container -->

    <script>
      /*
      Funcion para que al cambiar de paso, suba el scroll al inicio del fieldset correspondiente.
      Esto evita que al pasar de paso quede el scroll muy abajo y no se aprecie bien donde inicia el siguiente paso (generaba confusión)
       */
      function subir() {
        $("html, body").animate({
          scrollTop: 0
        }, "slow");
        $("#inicioScroll").animate({
          scrollTop: 0
        }, "slow");
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
    <script src="./assets/js/manejo-tabs.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pselect.js@4.0.1/dist/pselect.min.js"></script>
    <script>
      $(document).ready(function() {
        /*ESTE SCRIPT GESTIONA LOS INPUT TYPE RADIO DEL FORMULARIO*/
        //Bases
        $('input[name="base"]').change(function() {
          // Quitar la clase 'seleccionado' de todos los elementos 'input' con 'name="base"'
          $('input[name="base"]').parent().removeClass('seleccionado');
          // Agregar la clase 'seleccionado' solo al elemento actual
          $(this).parent().addClass('seleccionado');
        });

        //Topes
        $('input[name="tope"]').change(function() {
          // Quitar la clase 'seleccionado' de todos los elementos 'input' con 'name="tope"'
          $('input[name="tope"]').parent().removeClass('seleccionado');
          // Agregar la clase 'seleccionado' solo al elemento actual
          $(this).parent().addClass('seleccionado');
        });

        //Formas
        $('input[name="formas"]').change(function() {
          // Quitar la clase 'seleccionado' de todos los elementos 'input' con 'name="formas"'
          $('input[name="formas"]').parent().removeClass('seleccionado');
          // Agregar la clase 'seleccionado' solo al elemento actual
          $(this).parent().addClass('seleccionado');
        });
      });
    </script>
    <script>
      /* CONTROL DE BOTONES SIGUIENTE Y ENCARGAR*/
      const formulario = document.getElementById('formularioPersonalizar');
      const botonEnviar = document.getElementById('encargarDiseno');

      formulario.addEventListener('submit', function(event) {
        event.preventDefault(); // Evitar el envío del formulario al presionar Enter
      });

      botonEnviar.addEventListener('click', function() {
        formulario.submit(); // Enviar el formulario cuando se hace clic en el botón
      });

      const enlace = document.getElementById('v-pills-next-tab');
      enlace.addEventListener('click', function(event) {
        if (enlace.getAttribute('disabled') === 'true') {
          event.preventDefault(); // Evitar la acción predeterminada del enlace
        }
      });
    </script>
</body>

</html>