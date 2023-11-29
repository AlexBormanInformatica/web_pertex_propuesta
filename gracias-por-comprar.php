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
  <title><?= buscarTexto("WEB", "gracias-por-comprar", "gpc_title", "", $_SESSION['idioma']) ?></title>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-SECVFXMNWB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-SECVFXMNWB');
</script>

  <?php
  include_once 'api/apiRedsys.php';
  include("pedidos.php");
  include("assets/_partials/header-personalizar.php");
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

    $idPedido = $merchCode;
    if ($signatureCalculada === $signatureRecibida) {
      $merchCode = $miObj->getParameter("Ds_Order");
      if ((intval($codigoRespuesta) >= 0 && intval($codigoRespuesta) <= 99) && (substr($codigoRespuesta, 0, 3) != "SIS" && substr($codigoRespuesta, 0, 3) != "XML")) {
        $mensaje = buscarTextoConReturn("WEB", "respuestaPago", "rp_autorizada", "", $_SESSION['idioma']);
        historico($conn, $idPedido, 'FIN PAGO', "Total pagado: " . $total);
        enviarCorreo("pago", "", $_SESSION['ID'], $merchCode);
      } else {
        switch ($codigoRespuesta) {
          case "101":
          case "102":
          case "125":
          case "180":
          case "202":
          case "9093":
            $mensaje = buscarTextoConReturn("WEB", "respuestaPago", "rp_error-tarjeta", "", $_SESSION['idioma']) . " #$codigoRespuesta";
            break;
          case "172":
          case "173":
          case "174":
            $mensaje = buscarTextoConReturn("WEB", "respuestaPago", "rp_error", "", $_SESSION['idioma']) . " $codigoRespuesta: " . buscarTextoConReturn("WEB", "respuestaPago", "rp_error-denegada", "", $_SESSION['idioma']);
            break;
          case "184":
            $mensaje = buscarTextoConReturn("WEB", "respuestaPago", "rp_error", "", $_SESSION['idioma']) . " $codigoRespuesta: " . buscarTextoConReturn("WEB", "respuestaPago", "rp_error-autenticacion", "", $_SESSION['idioma']);
            break;
          case "190":
            $mensaje = buscarTextoConReturn("WEB", "respuestaPago", "rp_error", "", $_SESSION['idioma']) . " $codigoRespuesta: " . buscarTextoConReturn("WEB", "respuestaPago", "rp_error-emisor", "", $_SESSION['idioma']);
            break;
          case "191":
            $mensaje = buscarTextoConReturn("WEB", "respuestaPago", "rp_error", "", $_SESSION['idioma']) . " $codigoRespuesta: " . buscarTextoConReturn("WEB", "respuestaPago", "rp_error-caducidad", "", $_SESSION['idioma']);
            break;
          case "909":
            $mensaje = buscarTextoConReturn("WEB", "respuestaPago", "rp_error", "", $_SESSION['idioma']) . " $codigoRespuesta: " . buscarTextoConReturn("WEB", "respuestaPago", "rp_error-sistema", "", $_SESSION['idioma']);
            break;
          case "912":
          case "9912":
            $mensaje = buscarTextoConReturn("WEB", "respuestaPago", "rp_error", "", $_SESSION['idioma']) . " $codigoRespuesta: " . buscarTextoConReturn("WEB", "respuestaPago", "rp_error-no-disponible", "", $_SESSION['idioma']);
            break;
          case "9915":
            $mensaje = buscarTextoConReturn("WEB", "respuestaPago", "rp_error-cancelado", "", $_SESSION['idioma']);
            break;
          default:
            $mensaje = buscarTextoConReturn("WEB", "respuestaPago", "rp_error", "", $_SESSION['idioma']) . " $codigoRespuesta: " . buscarTextoConReturn("WEB", "respuestaPago", "rp_error-contacte", "", $_SESSION['idioma']);
            break;
        }

        historico($conn, $idPedido, 'FIN PAGO', "ERROR1: estado devuelto - " . $codigoRespuesta);
        estado($conn, $idPedido, "Boceto generado", "");
      }
    } else {
      $mensaje = buscarTextoConReturn("WEB", "respuestaPago", "rp_error-firma", "", $_SESSION['idioma']);
      historico($conn, $idPedido, 'FIN PAGO', "ERROR2: estado devuelto - " . $codigoRespuesta);
      estado($conn, $idPedido, "Boceto generado", "");
    }

  ?>
    <section class="coming-soon bg-img-1 text-center">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <div class="block">
              <div class="p-tb-25 shadow  caja-height-404 ">
                <h2 class="theme-color text-center title-legal"><?= buscarTexto("WEB", "gracias-por-comprar", "tit", "", $_SESSION['idioma']) ?></h2>
                <h2 class="text-center m-tb-50"><?= $mensaje ?></h2>
                <div class="text-center">
                  <p><?= buscarTexto("WEB", "gracias-por-comprar", "p2", "", $_SESSION['idioma']) ?></p>

                  <div class="mx-auto">
                    <a href="<?= buscarTexto("WEB", "paginas", "historial-pedidos", "", $_SESSION['idioma']); ?>" class="btn"><?= buscarTexto("WEB", "gracias-por-comprar", "btn-ver", "", $_SESSION['idioma']) ?></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/jquery.slicknav.min.js"></script>
    <script src="./assets/js/jquery.scrollUp.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="./assets/js/cookies.js"></script>
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/personalizar.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/historial-pedidos.js"></script>
    <script src="./assets/js/direcciones.js"></script>
    <script src="./assets/js/personas-contacto.js"></script>
    <script src="./assets/js/pasarela-pago.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pselect.js@4.0.1/dist/pselect.min.js"></script>
    </body>

</html>

<?php
  } else {
    header("Location: 404");
  }
?>