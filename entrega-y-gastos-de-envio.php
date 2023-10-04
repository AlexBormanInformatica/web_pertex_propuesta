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
  <title><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_title_seo", "", $_SESSION['idioma']); ?></title>
  <meta name="description" content="<?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_description_seo", "", $_SESSION['idioma']); ?>">
  <link rel="canonical" href="https://personalizacionestextiles.com/entrega-y-gastos-de-envio">
  <meta property="og:locale" content="es_ES">
  <meta property="og:site_name" content="personalizacionestextiles" />
  <meta property="og:url" content="https://personalizacionestextiles.com/entrega-y-gastos-de-envio" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="<?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_title_seo", "", $_SESSION['idioma']); ?>" />
  <meta property="og:description" content="<?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_og:description_seo", "", $_SESSION['idioma']); ?>" />
  <meta property="og:image" content="https://personalizacionestextiles.com/images/logo.png" />

  <?php
  include("assets/_partials/header.php");
  ?>

  <div class="single-slider slider-height2 d-flex align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-xl-12">
          <div class="hero-cap text-center">
            <h1 class="title-product"><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tit-principal", "", $_SESSION['idioma']); ?></h1>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="privacy section pt-0">
    <div class="container">
      <div class="block">
        <div class="policy-item p-lr-30">
          <div class="title mb-20">
          </div>

          <div class="txt-alineado">
            <h4 class="mb-20 mt-50"><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tit-entrega-sistemas", "", $_SESSION['idioma']); ?></h4>
            <p><strong><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tit-th-30-dias", "", $_SESSION['idioma']); ?></strong></p>
            <h5><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tit-th-2", "", $_SESSION['idioma']); ?></h5>
            <p><?= buscarTexto("PRG", "envios", "1", "descripcion", $_SESSION['idioma']); ?></p>

            <p><strong><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tit-th-15dias", "", $_SESSION['idioma']); ?></strong></p>
            <h5><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tit-th-2", "", $_SESSION['idioma']); ?></h5>
            <p><?= buscarTexto("PRG", "envios", "2", "descripcion", $_SESSION['idioma']); ?></p>

            <p><strong><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tit-th-bases", "", $_SESSION['idioma']); ?></strong></p>
            <h5><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tit-th-2", "", $_SESSION['idioma']); ?></h5>
            <p><?= buscarTexto("PRG", "envios", "3", "descripcion", $_SESSION['idioma']); ?></p>
          </div>

          <h4 class="mb-20"><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tit-entrega", "", $_SESSION['idioma']); ?></h4>
          <div class="policy-details txt-alineado">
            <p><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_p1-entrega", "", $_SESSION['idioma']); ?></p>
            <p><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_p2-entrega", "", $_SESSION['idioma']); ?></p>
            <p><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_p4-entrega", "", $_SESSION['idioma']); ?></p>
            <p><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_p5-entrega", "", $_SESSION['idioma']); ?> <a href="mailto:ventas@personalizacionestextiles.com" class="links"><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_p5.1-entrega", "", $_SESSION['idioma']); ?></a></p>
            <p><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_p6-entrega", "", $_SESSION['idioma']); ?></p>
          </div>

          <!-- tabla gastos de envío -->
          <h4 class="mb-20 mt-50"><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_p1-transporte", "", $_SESSION['idioma']); ?></h4>
          <div class="table-responsive mb-5">
            <table class="table table-striped">
              <thead>
                <tr class="table-success">
                  <th scope="col"><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-th1", "", $_SESSION['idioma']); ?></th>
                  <th scope="col">&lt; <?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-th2", "", $_SESSION['idioma']); ?></th>
                  <th scope="col"><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-th3", "", $_SESSION['idioma']); ?></th>
                  <th scope="col"><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-th4", "", $_SESSION['idioma']); ?></th>
                  <th scope="col"><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-th5", "", $_SESSION['idioma']); ?></th>
                  <th scope="col"><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-th6", "", $_SESSION['idioma']); ?></th>
                  <th scope="col"><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-th7", "", $_SESSION['idioma']); ?></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row"><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-row1", "", $_SESSION['idioma']); ?></th>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-row1-td1", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-row1-td2", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-row1-td3", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-row1-td4", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-row1-td5", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-row1-td6", "", $_SESSION['idioma']); ?></td>
                </tr>
                <tr>
                  <th scope="row"><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-row2", "", $_SESSION['idioma']); ?></th>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-row2-td1", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-row2-td2", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-row2-td3", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-row2-td4", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-row2-td5", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-row2-td6", "", $_SESSION['idioma']); ?></td>
                </tr>
                <tr>
                  <th scope="row"><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-row3", "", $_SESSION['idioma']); ?></th>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-row3-td1", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-row3-td2", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-row3-td3", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-row3-td4", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-row3-td5", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-row3-td6", "", $_SESSION['idioma']); ?></td>
                </tr>
                <tr>
                  <th scope="row"><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-row4", "", $_SESSION['idioma']); ?></th>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-row4-td1", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-row4-td2", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-row4-td3", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-row4-td4", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-row4-td5", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb1-row4-td6", "", $_SESSION['idioma']); ?></td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="table-responsive mb-5">
            <table class="table table-striped">
              <thead>
                <tr class="table-success">
                  <th scope="col"><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-th1", "", $_SESSION['idioma']); ?></th>
                  <th scope="col">&lt; <?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-th2", "", $_SESSION['idioma']); ?></th>
                  <th scope="col"><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-th3", "", $_SESSION['idioma']); ?></th>
                  <th scope="col"><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-th4", "", $_SESSION['idioma']); ?></th>
                  <th scope="col"><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-th5", "", $_SESSION['idioma']); ?></th>
                  <th scope="col"><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-th6", "", $_SESSION['idioma']); ?></th>
                  <th scope="col"><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-th7", "", $_SESSION['idioma']); ?></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row"><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row1", "", $_SESSION['idioma']); ?></th>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row1-td1", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row1-td2", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row1-td3", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row1-td4", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row1-td5", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row1-td6", "", $_SESSION['idioma']); ?></td>
                </tr>
                <tr>
                  <th scope="row"><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row2", "", $_SESSION['idioma']); ?></th>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row2-td1", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row2-td2", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row2-td3", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row2-td4", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row2-td5", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row2-td6", "", $_SESSION['idioma']); ?></td>
                </tr>
                <tr>
                  <th scope="row"><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row3", "", $_SESSION['idioma']); ?></th>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row3-td1", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row3-td2", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row3-td3", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row3-td4", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row3-td5", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row3-td6", "", $_SESSION['idioma']); ?></td>
                </tr>
                <tr>
                  <th scope="row"><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row4", "", $_SESSION['idioma']); ?></th>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row4-td1", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row4-td2", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row4-td3", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row4-td4", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row4-td5", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row4-td6", "", $_SESSION['idioma']); ?></td>
                </tr>
                <tr>
                  <th scope="row"><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row5", "", $_SESSION['idioma']); ?></th>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row5-td1", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row5-td2", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row5-td3", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row5-td4", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row5-td5", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row5-td6", "", $_SESSION['idioma']); ?></td>
                </tr>
                <tr>
                  <th scope="row"><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row6", "", $_SESSION['idioma']); ?></th>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row6-td1", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row6-td2", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row6-td3", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row6-td4", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row6-td5", "", $_SESSION['idioma']); ?></td>
                  <td><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_tb2-row6-td6", "", $_SESSION['idioma']); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- fin tabla gastos de envío -->

          <p><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_p2-transporte", "", $_SESSION['idioma']); ?></p>
          <p><?= buscarTexto("WEB", "entrega-y-gastos-de-envio", "eygde_p3-transporte", "", $_SESSION['idioma']); ?></p>
        </div>
      </div>
    </div>
  </section>

  <?php
  include("assets/_partials/footer.php");
  ?>