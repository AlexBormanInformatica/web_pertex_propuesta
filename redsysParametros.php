<?php
require_once "includes/config.php";
include("functions.php");
/* Importar el fichero principal de la librería, tal y como se muestra a
continuación: */
include_once 'api/apiRedsys.php';
//El comercio debe decidir si la importación desea hacerla con la función “include” o “required”, según los desarrollos realizados.
/* Definir un objeto de la clase principal de la librería, tal y como se
muestra a continuación: */
$miObj = new RedsysAPI;
/* Calcular el parámetro Ds_MerchantParameters. Para llevar a cabo el cálculo
de este parámetro, inicialmente se deben añadir todos los parámetros de la
petición de pago que se desea enviar, tal y como se muestra a continuación: */

// Valores de entrada
//DS_MERCHANT_AMOUNT = Las últimas posiciones hacen referencia a los decimales de la moneda.Ejemplo: En el caso del EURO 43,45 Euros habría que indicar 4345.
$amount = $_POST['amount'];

//DS_MERCHANT_CURRENCY = Se debe enviar el código numérico de la moneda según el ISO-4217.
$currency = "978"; // Euro

//DS_MERCHANT_MERCHANTCODE = Código FUC asignado al comercio.(Nº de comercio)
$merchantCode = "014409783";

//DS_MERCHANT_ORDER = Se recomienda, por posibles problemas en el proceso de liquidación, que los 4 primeros dígitos sean numéricos. 
//Para los dígitos restantes solo utilizar los siguientes caracteres ASCII:
// Del 48 = 0 al 57 = 9
// Del 65 = A al 90 = Z
// Del 97 = a al 122 = z
$order = $_POST['order'];

//Relleno con 0s el numero de pedido para que tenga un minimo de 4 digitos, sino da Redsys devuelve error
if (strlen($order) == 1) {
    $order = "000" . $order;
} else if (strlen($order) == 2) {
    $order = "00" . $order;
}

//DS_MERCHANT_TERMINAL = Número de terminal que le asignará su banco.
$terminal = "002";

//DS_MERCHANT_TRANSACTIONTYPE = Tipo de operación.
$trans = "0"; // AUTORIZADO 

//DS_MERCHANT_PAYMETHODS
$paymethod = $_POST['paymethod']; //En el caso que se apliquen mas metodos que la tarjeta (por ej. Bizum o Paypal)

//URL del comercio para la notificación "on-line"	
// $url = "https://personalizacionestextiles.com/checkout"; 

//DS_MERCHANT_URLOK = URL en la que se enviará una petición HTTP get cuando el resultado de la transacción sea OK.
$urlOK = "https://personalizacionestextiles.com/gracias-por-comprar";

//DS_MERCHANT_URLKO = URL en la que se enviará una petición HTTP get cuando el resultado de la transacción sea KO.
$urlKO = "https://personalizacionestextiles.com/error-pago";

$miObj->setParameter("DS_MERCHANT_AMOUNT", $amount);
$miObj->setParameter("DS_MERCHANT_CURRENCY", $currency);
$miObj->setParameter("DS_MERCHANT_MERCHANTCODE", $merchantCode);
// $miObj->setParameter("DS_MERCHANT_MERCHANTURL", $url);
$miObj->setParameter("DS_MERCHANT_ORDER", $order);
$miObj->setParameter("DS_MERCHANT_TERMINAL", $terminal);
$miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE", $trans);
$miObj->setParameter("DS_MERCHANT_URLOK", $urlOK);
$miObj->setParameter("DS_MERCHANT_URLKO", $urlKO);
// if ($paymethod != "" && $paymethod != null) {
//     switch ($paymethod) {
//         case "bizum":
// $miObj->setParameter("DS_MERCHANT_PAYMETHODS", "z");
//             break;
//         case "paypal":
//             $miObj->setParameter("DS_MERCHANT_PAYMETHODS", "p");
//             break;
//     }
// }
/*Por último, para calcular el parámetro Ds_MerchantParameters, se debe
llamar a la función de la librería “createMerchantParameters()”, tal y como
se muestra a continuación: */
$params = $miObj->createMerchantParameters();
/* Calcular el parámetro Ds_Signature. Para llevar a cabo el cálculo de
este parámetro, se debe llamar a la función de la librería
“createMerchantSignature()” con la clave SHA-256 del comercio (obteniendola
en el panel del módulo de administración), tal y como se muestra a
continuación: */
$claveSHA256 = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';
$firma = $miObj->createMerchantSignature($claveSHA256);
/* Una vez obtenidos los valores de los parámetros Ds_MerchantParameters y
Ds_Signature , se debe rellenar el formulario de pago con dichos valores, tal
y como se muestra a continuación: */

//Resultado
//Devuelvo Ds_MerchantParameters y Ds_Signature ya codificado para hacer la redirección a Redsys
echo $params . " " . $firma;
// echo $miObj->getParameter("DS_MERCHANT_AMOUNT") . " " .
//     $miObj->getParameter("DS_MERCHANT_CURRENCY") . " " .
//     $miObj->getParameter("DS_MERCHANT_MERCHANTCODE") . " " .
//     $miObj->getParameter("DS_MERCHANT_MERCHANTURL") . " " .
//     $miObj->getParameter("DS_MERCHANT_ORDER") . " " .
//     $miObj->getParameter("DS_MERCHANT_TERMINAL") . " " .
//     $miObj->getParameter("DS_MERCHANT_TRANSACTIONTYPE") . " " .
//     $miObj->getParameter("DS_MERCHANT_URLOK") . " " .
//     $miObj->getParameter("DS_MERCHANT_URLKO");
