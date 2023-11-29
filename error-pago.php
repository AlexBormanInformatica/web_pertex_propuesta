  <?php
  include_once 'api/apiRedsys.php';
  require_once('includes/config.php');
  include("funciones/functions.php");
  include('classes/AES.php');
  include("assets/_partials/codigo-idiomas.php");
  include("assets/_partials/header.php");
  ?>

  <!doctype html>
  <html class="no-js" lang="zxx">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Error en proceso de pago</title>
    <meta name="description" content="E">


    <?php

    /*Importar el fichero principal de la librería, tal y como se muestra
      a continuación. El comercio debe decidir si la importación desea hacerla con la
      función “include” o “required”, según los desarrollos realizados.*/

    /*Definir un objeto de la clase principal de la librería, tal y como se
      muestra a continuación:*/
    $miObj = new RedsysAPI;

    /*Capturar los parámetros de la notificación on-line:*/
    $version = $_GET["Ds_SignatureVersion"];
    $params = $_GET["Ds_MerchantParameters"];
    $signatureRecibida = $_GET["Ds_Signature"];

    /*Decodificar el parámetro Ds_MerchantParameters. Para llevar
      a cabo la decodificación de este parámetro, se debe llamar a la
      función de la librería “decodeMerchantParameters()”, tal y como
      se muestra a continuación:*/
    $decodec = $miObj->decodeMerchantParameters($params);

    /*Una vez se ha realizado la llamada a la función
      “decodeMerchantParameters()”, se puede obtener el valor de
      cualquier parámetro que sea susceptible de incluirse en la
      notificación on-line. Para llevar a cabo la obtención del valor de un
      parámetro se debe llamar a la función “getParameter()” de la
      librería con el nombre de parámetro, tal y como se muestra a
      continuación para obtener el código de respuesta:*/
    $codigoRespuesta = $miObj->getParameter("Ds_Response");
    $merchCode = $miObj->getParameter("Ds_Order");
    $total = $miObj->getParameter("Ds_Amount");

    /* NOTA IMPORTANTE: Es importante llevar a cabo la
      validación de todos los parámetros que se envían en la
      comunicación. Para actualizar el estado del pedido de
      forma on-line NO debe usarse esta comunicación, sino la
      notificación on-line descrita en los otros apartados, ya que
      el retorno de la navegación depende de las acciones del
      cliente en su navegador.*/

    /*Validar el parámetro Ds_Signature. Para llevar a cabo la
      validación de este parámetro se debe calcular la firma y
      compararla con el parámetro Ds_Signature capturado. Para ello
      se debe llamar a la función de la librería
      “createMerchantSignatureNotif()” con la clave obtenida del
      módulo de administración y el parámetro
      Ds_MerchantParameters capturado, tal y como se muestra a
      continuación:*/
    $claveModuloAdmin = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';
    $signatureCalculada = $miObj->createMerchantSignatureNotif($claveModuloAdmin, $params);

    /*Una vez hecho esto, ya se puede validar si el valor de la firma
      enviada coincide con el valor de la firma calculada, tal y como se
      muestra a continuación:*/

    $mensaje = "";

    $idPedido = ($merchCode);
    echo ($signatureCalculada === $signatureRecibida);
    echo $miObj->getParameter("Ds_Order");
    ?>

    <div class="container gray-bg p-tb-50">
      <div class=" m-tb-50 text-center ">
        <h1 class='theme-color mb-5'><?= $codigoRespuesta ?></h1>
        <div class='fs-20 mb-5'>Por favor, contacta con nosotros e indicanos el numero de error.</div>
      </div>

      <?php
      include("assets/_partials/footer.php");
      ?>