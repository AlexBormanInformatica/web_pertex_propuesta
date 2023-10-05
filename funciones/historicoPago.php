<?php
require_once "includes/config.php";
include("pedidos.php");
include("funciones/functions.php");

$metodo = $_POST['metodo'];
$total = $_POST['total'];
$factura = $_POST['factura'];
$nMetodo = "";
$idPedido =  $_POST['nPedido'];

switch ($metodo) {
    case "paypal":
        $nMetodo = "3";
        break;
    case "bizum":
        $nMetodo = "4";
        break;
    case "tarjeta":
        $nMetodo = "1";
        break;
    case "transferenciaBancaria":
        $nMetodo = "2";
        break;
}

estado($conn, $idPedido, "Procesando pago", "");
if ($metodo == "transferenciaBancaria") {
    historico($conn, $idPedido, "INICIO PAGO", "Se ha iniciado el proceso de pago para el pedido [$metodo].");
    historico($conn, $idPedido, 'FIN PAGO', "Total pagado: " . $total);
    enviarCorreo("pago", "", $_SESSION['ID'], $idPedido);
} else {
    historico($conn, $idPedido, "INICIO PAGO", "Se ha iniciado el proceso de pago para el pedido [$metodo].");
}

try {
    $sql = "UPDATE pedidos SET factura=?, metodospago_idMetodosPago=? WHERE idpedidos=?";

    $query = $conn->prepare($sql);
    $query->bindParam(1, $factura, PDO::PARAM_BOOL);
    $query->bindParam(2, $nMetodo, PDO::PARAM_INT);
    $query->bindParam(3, $idPedido, PDO::PARAM_INT);
    $query->execute();
    // echo $factura . " " . $nMetodo . " " . $dirE . " " . $dirF . " " . $persona . " " . $idPedido;
} catch (Exception $e) {
    header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
}

echo $sql;
