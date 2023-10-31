<?php
require_once('includes/config.php');
include("pedidos.php");
include("funciones/functions.php");
?>
<?php
$anotaciones = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['pstid_producto']) || isset($_POST['idPedidoMIE']) || isset($_POST['idPedidoME'])) { //Nueva linea de pedido (viene de ptp) o muestra/muestrario
        $nombre_pedido = $nombre_personalizacion = $id_producto = $ancho = $largo = $superficie = $cantidad = $productos_has_colores_id =
            $id_forma =
            $ancho_base = $largo_base = $pelo = "";

        $pxuProducto = $pxuBase = $pMoldeProducto = $pMoldeBase = $pPrecioTopes = $subtotal =  $cantidad_topes = 0;

        $base_has_idColor = $idcolor_piel = $idcolor_modulo = $base_has_colores_idbase = 1584;

        $arr = ['1584'];

        if (isset($_POST['pstPelo'])) {
            $pelo = $_POST['pstPelo'] == '' ? "0" : $_POST['pstPelo'];
        } else {
            $pelo = "0";
        }

        if (isset($_POST['pstNombrePed'])) {
            $nombre_pedido = $_POST['pstNombrePed'] == '' ? '' : $_POST['pstNombrePed'];
        }

        if (isset($_POST['pstNombrePer'])) {
            $nombre_personalizacion = $_POST['pstNombrePer'] == '' ? '' : $_POST['pstNombrePer'];
        }

        if (isset($_POST['pstid_producto'])) {
            $id_producto = $_POST['pstid_producto'];
        }

        if (isset($_POST['pstAncho'])) {
            $ancho = $_POST['pstAncho'] == '' ? 0 : $_POST['pstAncho'];
        } else {
            $ancho = 0;
        }

        if (isset($_POST['pstLargo'])) {
            $largo = $_POST['pstLargo'] == '' ? 0 : $_POST['pstLargo'];
        } else {
            $largo = 0;
        }

        if (isset($_POST['pstSuperficie'])) {
            $superficie = $_POST['pstSuperficie'] == '' ? 0 : $_POST['pstSuperficie'];
        } else {
            $superficie = 0;
        }

        if (isset($_POST['pstIdColoresProducto'])) {
            $productos_has_colores_id = $_POST['pstIdColoresProducto'][0] == "" ? $arr : $_POST['pstIdColoresProducto'];
        } else {
            $productos_has_colores_id = $arr;
        }

        if (isset($_POST['pstid_forma'])) {
            $id_forma = $_POST['pstid_forma'] == '' ? 15 : $_POST['pstid_forma'];
        } else {
            $id_forma = 15;
        }

        if (isset($_POST['pstCantidad'])) {
            $cantidad = $_POST['pstCantidad'];
        } else {
            $cantidad = 1;
        }

        if (isset($_POST['pstIdBase'])) {
            $base_has_colores_idbase = $_POST['pstIdBase'] == '' ? 6 : $_POST['pstIdBase'];
        } else {
            $base_has_colores_idbase = 6;
        }

        if (isset($_POST['pstIdColorBase'])) {
            $base_has_idColor = $_POST['pstIdColorBase'] == '' ? 1584 : $_POST['pstIdColorBase'];
        } else {
            $base_has_idColor = 1584;
        }

        if (isset($_POST['pstIdColorPiel'])) {
            $idcolor_piel = $_POST['pstIdColorPiel'] == '' ? 1584 : $_POST['pstIdColorPiel'];
        } else {
            $idcolor_piel = 1584;
        }

        if (isset($_POST['pstIdColorMetal'])) {
            $idcolor_modulo = $_POST['pstIdColorMetal'] == '' ? 1584 : $_POST['pstIdColorMetal'];
        } else {
            $idcolor_modulo = 1584;
        }

        if (isset($_POST['pstAnchoBase'])) {
            $ancho_base = $_POST['pstAnchoBase'] == '' ? 0 : $_POST['pstAnchoBase'];
        } else {
            $ancho_base = 0;
        }

        if (isset($_POST['pstLargoBase'])) {
            $largo_base = $_POST['pstLargoBase'] == '' ? 0 : $_POST['pstLargoBase'];
        } else {
            $largo_base = 0;
        }

        if (isset($_POST['pstPxuBase'])) {
            $pxuBase = $_POST['pstPxuBase'] == '' ? 0 : $_POST['pstPxuBase'];
        } else {
            $pxuBase = 0;
        }

        if (isset($_POST['pstPxuProducto'])) {
            $pxuProducto = $_POST['pstPxuProducto'];
        }

        if (isset($_POST['pstPxuProducto'])) {
            $pMoldeProducto = $_POST['pstMoldeProducto'] == '' ? 0 : $_POST['pstMoldeProducto'];
        }

        if (isset($_POST['pstPxuProducto'])) {
            $pMoldeBase = $_POST['pstMoldeBase'] == '' ? 0 : $_POST['pstMoldeBase'];
        }

        if (isset($_POST['pstPxuProducto'])) {
            $pPrecioTopes = $_POST['pstPrecioTopes'] == '' ? 0 : $_POST['pstPrecioTopes'];
        }

        if (isset($_POST['pstPxuProducto'])) {
            $subtotal = $_POST['pstSubtotal'];
        }

        $preciomolde = intval($pMoldeProducto) + intval($pMoldeBase);

        if (isset($_POST['pstIdPedido']) && $_POST['pstIdPedido'] != '') { //Si viene id pedido se agregara a este pedido, sino sera un pedido nuevo
            $pedidos_idpedidos = $_POST['pstIdPedido'];
            echo 1;

            lineaPedidoExistente(
                $conn,
                $ancho,
                $largo,
                $superficie,
                $cantidad,
                $pedidos_idpedidos,
                $id_forma,
                $base_has_colores_idbase,
                $base_has_idColor,
                $idcolor_piel,
                $idcolor_modulo,
                $ancho_base,
                $largo_base,
                $pelo,
                $cantidad_topes,
                $productos_has_colores_id,
                $id_producto,
                $subtotal,
                $preciomolde,
                $nombre_personalizacion
            );
            // historico($conn, $pedidos_idpedidos, 'LINEAPEDIDO_NUEVA', "");
        } else if (isset($_POST['idPedidoMIE']) && $_POST['idPedidoMIE'] != '') { //Si viene id pedido MIE (Muestra Individual Existente) se agregara a este pedido, sino sera un pedido nuevo
            $pedidos_idpedidos = $_POST['idPedidoMIE'];
            echo "2";

            lineaPedidoExistente(
                $conn,
                $ancho,
                $largo,
                $superficie,
                $cantidad,
                $pedidos_idpedidos,
                $id_forma,
                $base_has_colores_idbase,
                $base_has_idColor,
                $idcolor_piel,
                $idcolor_modulo,
                $ancho_base,
                $largo_base,
                $pelo,
                $cantidad_topes,
                $productos_has_colores_id,
                $id_producto,
                2,
                $preciomolde,
                "Muestra individual"
            );
            // historico($conn, $pedidos_idpedidos, 'LINEAPEDIDO_NUEVA', "Muestra individual");
        } else if (isset($_POST['idPedidoME']) && $_POST['idPedidoME'] != '') { //Si viene id pedido ME (Muestrario Existente) se agregara a este pedido, sino sera un pedido nuevo
            $pedidos_idpedidos = $_POST['idPedidoME'];
            $id_producto = 1;

            echo "3";
            lineaPedidoExistente(
                $conn,
                $ancho,
                $largo,
                $superficie,
                $cantidad,
                $pedidos_idpedidos,
                $id_forma,
                $base_has_colores_idbase,
                $base_has_idColor,
                $idcolor_piel,
                $idcolor_modulo,
                $ancho_base,
                $largo_base,
                $pelo,
                $cantidad_topes,
                $productos_has_colores_id,
                $id_producto,
                50,
                $preciomolde,
                "Muestrario"
            );
            // historico($conn, $pedidos_idpedidos, 'LINEAPEDIDO_NUEVA', "Muestrario");
        } else {
            if (isset($_POST['idPedidoMIE'])) {
                $subtotal = 2;
                $nombre_personalizacion = "Muestra individual";
            } else if (isset($_POST['idPedidoME'])) {
                $subtotal = 50;
                $nombre_personalizacion = "Muestrario";
                $id_producto = 1;
            }
            lineaPedidoNuevo(
                $conn,
                $ancho,
                $largo,
                $superficie,
                $cantidad,
                $id_forma,
                $base_has_colores_idbase,
                $base_has_idColor,
                $idcolor_piel,
                $idcolor_modulo,
                $ancho_base,
                $largo_base,
                $pelo,
                $cantidad_topes,
                $productos_has_colores_id,
                $id_producto,
                $subtotal,
                $preciomolde,
                $nombre_pedido,
                $nombre_personalizacion
            );
        }
        header("Location: " . $_GET['pag']);
    } else if (isset($_POST["idPedidoA"])) { //Anular pedido
        $anotaciones = $_POST["anotacionesA"];
        $idPedido = $_POST["idPedidoA"];

        estado($conn, $idPedido, "Anulado", "");
        historico($conn, $idPedido, 'PEDIDO ANULADO', $anotaciones);
        enviarCorreo("anulado", "", $_SESSION['ID'], $idPedido);
        header("Location: " . $_GET['pag']);
    } else if (isset($_POST["lpCheck"])) { //Repetir pedido
        $cantidades = $_POST['cantidadRepetir'];
        $cantidades = array_filter($cantidades); //Elimina elementos vacios del array
        $cantidades = array_values($cantidades); //Reordena el array 

        $nombre = $_POST['nombredisenorep'];
        $nombre = array_filter($nombre); //Elimina elementos vacios del array
        $nombre = array_values($nombre); //Reordena el array 


        $lineas = $_POST['lpCheck'];

        $nombre_pedido = $_POST['pstNombrePed'];

        crearPedidoRepetido($conn, $nombre_pedido);

        $i = 0;
        foreach ($lineas as $linea) {
            $nombre[$i] = $nombre[$i] ?? "Repetido " . rand(1000, 9999);
            agregarLineaRepetida($conn, $linea, $cantidades[$i], $nombre[$i]);
            $i++;
        }

        historico($conn, $idPedido, 'PEDIDO REPETIDO', "");
        enviarCorreo("repetir", "", $_SESSION['ID'], "");
        header("Location: " . $_GET['pag']);
    } else if (isset($_GET['clienteInterno'])) { //Acepta boceto cliente interno
        $idPedido = $_POST['idPedidos'];
        estado($conn, $idPedido, "Pago confirmado", "");
        historico($conn, $idPedido, "BOCETO ACEPTADO", "");
        // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'pedido-interno', '', $_SESSION['idioma']) . "?idped=" . $idPedido);
        header("Location: " . $_GET['pag']);
    } else if (isset($_POST['idPedidoEliminar'])) { // Eliminar lineas de pedido
        $idPedido = $_POST['idPedidoEliminar'];
        $lineas = $_POST['checkLineasEliminar'];

        foreach ($lineas as $linea) {
            eliminarLineaPedido($conn, $linea, $idPedido);
        }

        header("Location: " . $_GET['pag']);
    } else if (isset($_POST['anotaciones'])) { //Rechazar pedido
        $anotaciones = $_POST["anotaciones"];
        $idPedido = $_POST["idPedido"];

        estado($conn, $idPedido, "No aceptado", "");
        historico($conn, $idPedido, "NO ACEPTADO", $anotaciones);
        enviarCorreo("no aceptado", "", $_SESSION['ID'], $idPedido);
        header("Location: " . $_GET['pag']);
    } else if (isset($_POST['prop-int'])) { //Acepta bocetos y PI

        $idpedido = $_POST['idPedidos'];
        $idcomercial = 0;
        $porcentajeanticipo = "";

        //Si el pedido es interno, es decir, tiene una comercial asignada, NO pasa al checkout
        //Si tiene anticipo se cambia el estado como esperando anticipo, sino como esperando pago
        //Si el pedido es externo, es decir, el cliente es el que realiza el pedido solo, pasa al checkout

        //Busco la comercial y el anticipo
        $sql = "SELECT idcomercial, porcentajeanticipo FROM pedidos WHERE idpedidos=?";
        $query = $conn->prepare($sql);
        $query->bindParam(1, $idpedido, PDO::PARAM_INT);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        foreach ($results as $result) {
            $idcomercial = $result->idcomercial;
            $porcentajeanticipo = $result->porcentajeanticipo;
        }

        if ($idcomercial != "0") {
            //NO paga por la web
            if ($porcentajeanticipo == "0.00") {
                //Si no tiene anticipo pasa a procesando pago
                estado($conn, $idpedido, "Procesando pago", "");
                historico($conn, $idpedido, 'BOCETO ACEPTADO', "Boceto+Propiedad Intelectual aceptado. En espera de proceso de pago.");
            } else {
                //Si tiene anticipo pasa a esperando anticipo
                estado($conn, $idpedido, "Esperando anticipo", "");
                historico($conn, $idpedido, 'BOCETO ACEPTADO', "Boceto+Propiedad Intelectual aceptado. En espera de pagar anticipo de " . $porcentajeanticipo);
            }

            header("Location: " . $_GET['pag']);
        } else {
            //SI paga por la web
            historico($conn, $idpedido, 'BOCETO ACEPTADO', "Boceto+Propiedad Intelectual aceptado. Pasa al área de pago de la web.");
            header("Location: checkout?check=" . $idpedido);
        }
    }
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['scnf'])) { //Confirmar pedido
        $idPedido = $_GET['scnf'];
        $comentario = $_GET['comentario'] == "" ? "" : $_GET['comentario'];
        $comercial = $_GET['comercial'];
        $nombredecomercial = $_GET['nombredecomercial'];
        $cliente = $_GET['cliente'];
        $anticipo = $_GET['anticipo'];
        $porcentajeanticipo = $_GET['porcentajeanticipo'] == "" ? "0.00" : $_GET['porcentajeanticipo'];

        if (isset($_SESSION['interno']) && $_SESSION['interno'] == '1') {
            $email = "";
            // $idusuario = 0;
            $molde = "0.00";
            //Busco el usuario en fichaempresameta
            // $sql = "SELECT email FROM fichaempresametas WHERE nombreFiscal=?";
            // $query = $conn_formularios->prepare($sql);
            // $query->bindParam(1, $cliente, PDO::PARAM_STR);
            // $query->execute();
            // $email = $query->fetchColumn();

            // $sql = "SELECT id FROM usuarios WHERE username=?";
            // $query = $conn->prepare($sql);
            // $query->bindParam(1, $email, PDO::PARAM_STR);
            // $query->execute();
            // $idusuario = $query->fetchColumn();

            // //Creo el usuario si no existe
            // if ($idusuario == 0) {
            //     $sql = "INSERT INTO usuarios (username, password, nombrecomercial, nombrefiscal, cif, recargo, mediodepesca_comonosconocio, comentarios) 
            //     VALUES (?, '', '', '', '', '', '', '')";
            //     $sentencia = $conn->prepare($sql);
            //     $sentencia->bindParam(1, $email, PDO::PARAM_STR);
            //     $sentencia->execute();
            //     $idusuario = $conn->lastInsertId();
            // }

            $sql = "SELECT preciomolde FROM lineapedido WHERE pedidos_idpedidos=?";
            $query = $conn->prepare($sql);
            $query->bindParam(1, $idPedido, PDO::PARAM_STR);
            $query->execute();
            $molde = $query->fetchColumn();

            if ($molde == "0.00") { //Si el pedido es repetido, es decir, la comercial le quita el molde.
                //Lo asigno como Preparando Boceto para que diseño suba los bocetos (para que quede registrado, asi la proxima vez poder repetirlo)
                //Diseño lo pasa directamente a pagado. El cliente no tiene que aceptar porpiedad intelectual cuando es repetido
                //Le asigno el pedido al cliente
                $sql = "UPDATE pedidos SET /*usuarios_id=?, */ cliente_interno=?, estado='Preparando boceto', notas=?, anticipo=?, porcentajeanticipo=?,
                idcomercial=? WHERE idpedidos=?";
                $sentencia = $conn->prepare($sql);

                // $sentencia->bindParam(1, $idusuario, PDO::PARAM_INT);
                $sentencia->bindParam(1, $cliente, PDO::PARAM_STR);
                $sentencia->bindParam(2, $comentario, PDO::PARAM_STR);
                $sentencia->bindParam(3, $anticipo, PDO::PARAM_STR);
                $sentencia->bindParam(4, $porcentajeanticipo, PDO::PARAM_STR);
                $sentencia->bindParam(5, $comercial, PDO::PARAM_STR);
                $sentencia->bindParam(6, $idPedido, PDO::PARAM_INT);
                $sentencia->execute();

                historico($conn, $idPedido, 'PEDIDO VALIDADO', "PEDIDO REPETIDO, NO COBRA MOLDE. Comercial que realiza el pedido: " . $nombredecomercial . " para el cliente: " . $cliente . ". Comentario del pedido: " . $comentario);
            } else {
                //Si es un pedido normal, nuevo. Lo asigno como Validado, para que lo vea la comercial inicialmente
                $sql = "UPDATE pedidos SET /*usuarios_id=?, */ cliente_interno=?, estado='Validado', notas=?, anticipo=?, porcentajeanticipo=?,
                idcomercial=? WHERE idpedidos=?";
                $sentencia = $conn->prepare($sql);

                // $sentencia->bindParam(1, $idusuario, PDO::PARAM_INT);
                $sentencia->bindParam(1, $cliente, PDO::PARAM_STR);
                $sentencia->bindParam(2, $comentario, PDO::PARAM_STR);
                $sentencia->bindParam(3, $anticipo, PDO::PARAM_STR);
                $sentencia->bindParam(4, $porcentajeanticipo, PDO::PARAM_STR);
                $sentencia->bindParam(5, $comercial, PDO::PARAM_STR);
                $sentencia->bindParam(6, $idPedido, PDO::PARAM_INT);
                $sentencia->execute();

                historico($conn, $idPedido, 'PEDIDO VALIDADO', "Comercial que realiza el pedido: " . $nombredecomercial .
                    " para el cliente: " . $cliente . ". Anticipo: " . ($anticipo == "1" ? ("Sí, de " . $porcentajeanticipo) : "No") . ". Comentario del pedido: " . $comentario);
            }
        } else {
            estado($conn, $idPedido, "Confirmado", $comentario);
            historico($conn, $idPedido, 'PEDIDO CONFIRMADO', $comentario);
            enviarCorreo("confirmar", "", $_SESSION['ID'], $idPedido);
        }

        header("Location: " . $_GET['pag']);
    } else if (isset($_GET['scnf2'])) { //Confirmar pedido repetido
        $idPedido = $_GET['scnf2'];
        $comentario = $_GET['comentario'] == "" ? "" : $_GET['comentario'];
        $comercial = $_GET['comercial'];
        $nombredecomercial = $_GET['nombredecomercial'];
        $cliente = $_GET['cliente'];
        $anticipo = $_GET['anticipo'];
        $porcentajeanticipo = $_GET['porcentajeanticipo'] == "" ? "" : $_GET['porcentajeanticipo'];

        $email = "";
        // $idusuario = 0;
        $molde = "0.00";
        //Busco el usuario en fichaempresameta
        // $sql = "SELECT email FROM fichaempresametas WHERE nombreFiscal=?";
        // $query = $conn_formularios->prepare($sql);
        // $query->bindParam(1, $cliente, PDO::PARAM_STR);
        // $query->execute();
        // $email = $query->fetchColumn();

        // $sql = "SELECT id FROM usuarios WHERE username=?";
        // $query = $conn->prepare($sql);
        // $query->bindParam(1, $email, PDO::PARAM_STR);
        // $query->execute();
        // $idusuario = $query->fetchColumn();

        // Creo el usuario si no existe
        // if ($idusuario == 0) {
        //     $sql = "INSERT INTO usuarios (username, password, nombrecomercial, nombrefiscal, cif, recargo, mediodepesca_comonosconocio, comentarios) 
        //         VALUES (?, '', '', '', '', '', '', '')";
        //     $sentencia = $conn->prepare($sql);
        //     $sentencia->bindParam(1, $email, PDO::PARAM_STR);
        //     $sentencia->execute();
        //     $idusuario = $conn->lastInsertId();
        // }

        $sql = "UPDATE pedidos SET /*usuarios_id=?, */ cliente_interno=?, estado='Pendiente fabricar', notas=?, anticipo=?, porcentajeanticipo=?,
                idcomercial=? WHERE idpedidos=?";
        $sentencia = $conn->prepare($sql);

        // $sentencia->bindParam(1, $idusuario, PDO::PARAM_INT);
        $sentencia->bindParam(1, $cliente, PDO::PARAM_STR);
        $sentencia->bindParam(2, $comentario, PDO::PARAM_STR);
        $sentencia->bindParam(3, $anticipo, PDO::PARAM_STR);
        $sentencia->bindParam(4, $porcentajeanticipo, PDO::PARAM_STR);
        $sentencia->bindParam(5, $comercial, PDO::PARAM_STR);
        $sentencia->bindParam(6, $idPedido, PDO::PARAM_INT);
        $sentencia->execute();

        historico($conn, $idPedido, 'PEDIDO REPETIDO CONFIRMADO', "Comercial que realiza el pedido: " . $nombredecomercial . " para el cliente: " . $cliente . ". Comentario del pedido: " . $comentario);
        header("Location: " . $_GET['pag']);
    }
}
?>