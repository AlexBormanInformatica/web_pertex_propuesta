  <?php
  include_once 'api/apiRedsys.php';
  require_once "includes/config.php";
  include("funciones/functions.php");
  include("pedidos.php");
  include("assets/_partials/header.php");
  ?>

  <!doctype html>
  <html class="no-js" lang="zxx">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= buscarTexto("WEB", "error-pago", "errpago_title", "", $_SESSION['idioma']); ?></title>
    <meta name="description" content="E">


    <?php
    if (
      $_SERVER["REQUEST_METHOD"] == "GET" &&
      isset($_GET["Ds_SignatureVersion"]) &&
      isset($_GET["Ds_MerchantParameters"]) &&
      isset($_GET["Ds_Signature"])
    ) {
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
      if ($signatureCalculada === $signatureRecibida) {
        $merchCode = $miObj->getParameter("Ds_Order");
        if ((intval($codigoRespuesta) >= 0 && intval($codigoRespuesta) <= 99) && (substr($codigoRespuesta, 0, 3) != "SIS" && substr($codigoRespuesta, 0, 3) != "XML")) {
          $mensaje = buscarTextoConReturn("WEB", "respuestaPago", "rp_autorizada", "", $_SESSION['idioma']);
          historico($conn, $idPedido, 'FIN PAGO', "Total pagado: " . $total);
        } else {
          switch ($codigoRespuesta) {
            case "101":
            case "102":
            case "125":
            case "180":
            case "202":
            case "9093":
              $mensaje = "<h1 class='theme-color mb-5'>" . buscarTextoConReturn("WEB", "respuestaPago", "rp_error-tarjeta", "", $_SESSION['idioma']) . " #$codigoRespuesta" . "</h1>";
              break;
            case "172":
            case "173":
            case "174":
              $mensaje = "<h1 class='theme-color mb-5'>" . buscarTextoConReturn("WEB", "respuestaPago", "rp_error", "", $_SESSION['idioma']) . " $codigoRespuesta " . "</h1>" .  "<div class='fs-20 mb-5'>" . buscarTextoConReturn("WEB", "respuestaPago", "rp_error-contacte", "", $_SESSION['idioma']) . "</div>" .  "<div class='fs-18 mb-5'>" . buscarTextoConReturn("WEB", "respuestaPago", "rp_error-denegada", "", $_SESSION['idioma']) . "</div>";
              break;
            case "184":
              $mensaje = "<h1 class='theme-color mb-5'>" . buscarTextoConReturn("WEB", "respuestaPago", "rp_error", "", $_SESSION['idioma']) . " $codigoRespuesta " . "</h1>"  .  "<div class='fs-20 mb-5'>" . buscarTextoConReturn("WEB", "respuestaPago", "rp_error-contacte", "", $_SESSION['idioma']) . "</div>" .  "<div class='fs-18 mb-5'>" . buscarTextoConReturn("WEB", "respuestaPago", "rp_error-autenticacion", "", $_SESSION['idioma']) . "</div>";
              break;
            case "190":
              $mensaje = "<h1 class='theme-color mb-5'>" . buscarTextoConReturn("WEB", "respuestaPago", "rp_error", "", $_SESSION['idioma']) . " $codigoRespuesta " . "</h1>"  .  "<div class='fs-20 mb-5'>" . buscarTextoConReturn("WEB", "respuestaPago", "rp_error-contacte", "", $_SESSION['idioma']) . "</div>" .  "<div class='fs-18 mb-5'>" . buscarTextoConReturn("WEB", "respuestaPago", "rp_error-emisor", "", $_SESSION['idioma']) . "</div>";
              break;
            case "191":
              $mensaje = "<h1 class='theme-color mb-5'>" . buscarTextoConReturn("WEB", "respuestaPago", "rp_error", "", $_SESSION['idioma']) . " $codigoRespuesta " . "</h1>"  .  "<div class='fs-20 mb-5'>" . buscarTextoConReturn("WEB", "respuestaPago", "rp_error-contacte", "", $_SESSION['idioma']) . "</div>" .  "<div class='fs-18 mb-5'>" . buscarTextoConReturn("WEB", "respuestaPago", "rp_error-caducidad", "", $_SESSION['idioma']) . "</div>";
              break;
            case "909":
              $mensaje = "<h1 class='theme-color mb-5'>" . buscarTextoConReturn("WEB", "respuestaPago", "rp_error", "", $_SESSION['idioma']) . " $codigoRespuesta "  . "</h1>" . "<div class='fs-20 mb-5'>" . buscarTextoConReturn("WEB", "respuestaPago", "rp_error-contacte", "", $_SESSION['idioma']) . "</div>" .  "<div class='fs-18 mb-5'>" .  buscarTextoConReturn("WEB", "respuestaPago", "rp_error-sistema", "", $_SESSION['idioma']) . "</div>";
              break;
            case "912":
            case "9912":
              $mensaje = "<h1 class='theme-color mb-5'>" . buscarTextoConReturn("WEB", "respuestaPago", "rp_error", "", $_SESSION['idioma']) . " $codigoRespuesta " . "</h1>"  . "<div class='fs-20 mb-5'>" . buscarTextoConReturn("WEB", "respuestaPago", "rp_error-contacte", "", $_SESSION['idioma']) . "</div>" .  "<div class='fs-18 mb-5'>" . buscarTextoConReturn("WEB", "respuestaPago", "rp_error-no-disponible", "", $_SESSION['idioma']) . "</div>";
              break;
            case "9915":
            case "9673":
              $mensaje = "<h1 class='theme-color mb-5'>" . buscarTextoConReturn("WEB", "respuestaPago", "rp_error-cancelado", "", $_SESSION['idioma']) . "</h1>";
              break;
            default:
              $mensaje = "<h1 class='theme-color mb-5'>" . buscarTextoConReturn("WEB", "respuestaPago", "rp_error", "", $_SESSION['idioma']) . " $codigoRespuesta " . "</h1>" . "<div class='fs-20 mb-5'>" . buscarTextoConReturn("WEB", "respuestaPago", "rp_error-contacte", "", $_SESSION['idioma']) . "</div>" .  "<div class='fs-18 mb-5'>" . buscarTextoConReturn("WEB", "respuestaPago", "rp_error-contacte-2", "", $_SESSION['idioma']) . "</div>";
              break;
          }

          historico($conn, $idPedido, 'FIN PAGO', "ERROR1: estado devuelto - " . $codigoRespuesta);
          estado($conn, $idPedido, "Boceto generado", "");
        }
      } else {

        historico($conn, $idPedido, 'FIN PAGO', "ERROR2: estado devuelto - " . $codigoRespuesta);
        estado($conn, $idPedido, "Boceto generado", "");
        $mensaje = buscarTextoConReturn("WEB", "respuestaPago", "rp_error-firma", "", $_SESSION['idioma']);
      }

    ?>

      <div class="container gray-bg p-tb-50">
        <div class=" m-tb-50 text-center ">
          <?= $mensaje ?>
        </div>
      </div>

    <?php
      include("assets/_partials/footer.php");
    } else {
      header("Location: 404");
    }
    ?>