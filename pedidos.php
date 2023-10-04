<?php
//________________________Repetir pedido_________________________________________________________________________________________________________________________________________________________________//
$idPedidoNuevoRepetido = 0;
/**
 * Crea el pedido nuevo con los datos necesarios de un pedido repetido.
 */
function crearPedidoRepetido($conn, $nomper)
{
    global $idPedidoNuevoRepetido;
    $fechaAhora = generarFechaActual($conn);
    $numeroDePedidoNuevo = generarNumeroPedido($conn);
    $nombrepedido = $nomper == '' ? "Repetido " . $numeroDePedidoNuevo : $nomper;

    //Crear el pedido nuevo
    try {
        $sql = "INSERT INTO pedidos (fechaPedido, precioTotal, metodoPago, factura, usuarios_id, metodospago_idMetodosPago, 
        estado, notas, nombrepedido, personasdecontacto_id, direccionEnvio, direcionFacturacion, numeroPedido)
            VALUES (?, 0, '', 0, ?, 2, 'Pendiente fabricar', '', ?, 0, 0, 0, 'repetido')";
        $sentencia = $conn->prepare($sql);
        $sentencia->bindParam(1, $fechaAhora, PDO::PARAM_STR);
        $sentencia->bindParam(2, $_SESSION['ID'], PDO::PARAM_INT);
        $sentencia->bindParam(3, $nombrepedido, PDO::PARAM_STR);
        $sentencia->execute();
        $idPedidoNuevoRepetido = $conn->lastInsertId(); //https://www.php.net/manual/es/pdo.lastinsertid.php
    } catch (Exception $e) {
        echo $e->getMessage();
        // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
    }
}

/**
 * Agrega la linea de pedido repetida al pedido repetido, agregar colores, precios, etc
 */
function agregarLineaRepetida($conn, $linea, $cantidad, $nombre)
{
    global $idPedidoNuevoRepetido;
    $idpedido = getNumPedidoByLinea($conn, $linea);    
    $sql = "UPDATE pedidos SET cliente_interno=(SELECT cliente_interno FROM pedidos WHERE idpedidos=".$idpedido."), 
    idcomercial=(SELECT idcomercial FROM pedidos WHERE idpedidos=".$idpedido.")
    WHERE idpedidos=".$idPedidoNuevoRepetido;
    $query = $conn->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    //Insertar las lineas de pedido 
    $sql = "SELECT * FROM lineapedido WHERE idlineaPedido=" . $linea;
    $query = $conn->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    foreach ($results as $result) {
        try {
            echo "INSERT INTO lineapedido (Ancho, Largo, Superficie, Cantidad, pedidos_idpedidos, colores_has_productos_id, formas_id_formas, base_has_colores_idbase, 
            base_has_colores_idcolor, idcolor_piel, idcolor_modulo, ancho_base, largo_base, pelo, cantidad_topes, numFabricacion, numReferencia, subtotal, preciomolde, 
            nombrepersonalizacion)
            SELECT Ancho, Largo, Superficie," . $cantidad . ", " . $idPedidoNuevoRepetido . ", colores_has_productos_id, formas_id_formas, base_has_colores_idbase, 
            base_has_colores_idcolor, idcolor_piel, idcolor_modulo, ancho_base, largo_base, pelo, cantidad_topes, null, numReferencia, 0, 0, '" . $nombre . "'
            FROM lineapedido
            WHERE idlineaPedido=" . $result->idlineaPedido;

            $sql = "INSERT INTO lineapedido (Ancho, Largo, Superficie, Cantidad, pedidos_idpedidos, colores_has_productos_id, formas_id_formas, base_has_colores_idbase, 
            base_has_colores_idcolor, idcolor_piel, idcolor_modulo, ancho_base, largo_base, pelo, cantidad_topes, numFabricacion, numReferencia, subtotal, preciomolde, 
            nombrepersonalizacion)
            SELECT Ancho, Largo, Superficie," . $cantidad . ", " . $idPedidoNuevoRepetido . ", colores_has_productos_id, formas_id_formas, base_has_colores_idbase, 
            base_has_colores_idcolor, idcolor_piel, idcolor_modulo, ancho_base, largo_base, pelo, cantidad_topes, null, numReferencia, 0, 0, '" . $nombre . "'
            FROM lineapedido
            WHERE idlineaPedido=" . $result->idlineaPedido;
            $sentencia = $conn->prepare($sql);
            $sentencia->execute();
        } catch (Exception $e) {
            // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
        }

        //Obtenemos el id de la linea agregada
        $idLineaNueva = $conn->lastInsertId();

        //Insertar colores
        try {
            $sql_color = "SELECT * FROM colorlineapedidoelegido WHERE idlineapedido=" . $result->idlineaPedido;
            $query_color = $conn->prepare($sql_color);
            $query_color->execute();
            $results_color = $query_color->fetchAll(PDO::FETCH_OBJ);
            foreach ($results_color as $result_color) {
                $sql_2 = "INSERT INTO colorlineapedidoelegido (idlineapedido, idcolor) VALUES ($idLineaNueva, $result_color->idcolor)";
                $sentencia_2 = $conn->prepare($sql_2);
                $sentencia_2->execute();
            }
        } catch (Exception $e) {
            // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
        }

        //Sumar subtotal
        $total = getPrecioPedido($conn, $idPedidoNuevoRepetido);
        try {
            $sql_subtotal = "SELECT colores_has_productos_id, Superficie, Cantidad, formas_id_formas, base_has_colores_idbase, ancho_base, largo_base, pelo, cantidad_topes 
        FROM lineapedido WHERE idlineapedido=" . $idLineaNueva;
            $query_subtotal = $conn->prepare($sql_subtotal);
            $query_subtotal->execute();
            $results_subtotal = $query_subtotal->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
        }

        //Buscar tarifas y calcular subtotal de linea de pedido
        //Dependera de la tecnica, si quiere base, etc etc
        foreach ($results_subtotal as $result_subtotal) {
            $colores_has_productos_id = $result_subtotal->colores_has_productos_id;
            $sup = $result_subtotal->Superficie;
            $formas_id_formas = $result_subtotal->formas_id_formas;
            $base_has_colores_idbase = $result_subtotal->base_has_colores_idbase;
            $ancho_base = $result_subtotal->ancho_base;
            $largo_base = $result_subtotal->largo_base;
            $pelo = $result_subtotal->pelo;
            $cantidad_topes = $result_subtotal->cantidad_topes;
            $cant = $result_subtotal->Cantidad;

            $producto = 0;
            $condint = 0;
            $base = 0;
            $preciopelo = 0;

            //Calculo precio producto x unidad
            $idprod = getIdProductoByCHP($conn, $colores_has_productos_id);
            if (
                $colores_has_productos_id == '3370' || $colores_has_productos_id == '3524' || $colores_has_productos_id == '3780' ||
                $colores_has_productos_id == '3786'
            ) { //Si es un producto fijo (crematex, cremajet, cremaglass, papertick)
                if ($colores_has_productos_id == '3786') { //Si tiene eleccion de forma (papertick)
                    $producto = getTarifa($conn, 41, $formas_id_formas, $cant);
                } else {
                    $producto = getTarifa($conn, $idprod, $sup, $cant);
                }
            } else {
                $producto = getTarifa($conn, $idprod, $sup, $cant);
            }

            //Si es pulseras precio de los topes
            if ($colores_has_productos_id == '3787') {
                $condint = getTarifa($conn, 47, 47, $cantidad_topes);
            }

            //Si hay base, precio de la base
            if ($base_has_colores_idbase == '1') { //Tela
                $supbase = (float)$ancho_base * (float)$largo_base;
                $base = getTarifa($conn, 43, $supbase, $cant);
            } else if ($base_has_colores_idbase == '2') { //Velcro
                $base = getTarifa($conn, 44, $sup, $cant);
            }

            //Si hay pelo precio del pelo
            if ($pelo == '1') {
                $preciopelo = getTarifa($conn, 48, $sup, $cant);
            }

            $subtotal_linea = (float)$producto + (float)$condint + (float)$base + (float)$preciopelo;
            $total = (float)$total + (float)$subtotal_linea;

            try {
                //Hacemos update del precio de la linea
                $sql_4 = "UPDATE lineapedido SET subtotal=? WHERE idlineapedido=?";
                $sentencia_4 = $conn->prepare($sql_4);
                $sentencia_4->bindParam(1, $subtotal_linea, PDO::PARAM_STR);
                $sentencia_4->bindParam(2, $idLineaNueva, PDO::PARAM_INT);
                $sentencia_4->execute();

                //Update precio del pedido
                $sql_3 = "UPDATE pedidos SET precioTotal=? WHERE idpedidos=?";
                $sentencia_3 = $conn->prepare($sql_3);
                $sentencia_3->bindParam(1, $total, PDO::PARAM_STR);
                $sentencia_3->bindParam(2, $idPedidoNuevoRepetido, PDO::PARAM_INT);
                $sentencia_3->execute();
            } catch (Exception $e) {
                // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
            }
        }

        //Busco el id y el numero necesarios para copiar la imagen
        $numeroDePedidoCopiar = getNumPedidoByLinea($conn, $linea);
        //Copiar boceto del diseño
        $origen = "imagenes_bocetos/D" . $numeroDePedidoCopiar . "-" . $linea . ".jpg";
        $destino = "imagenes_bocetos/D" . $idPedidoNuevoRepetido . "-" . $idLineaNueva . ".jpg";
        $origen2 = "imagenes_bocetos/C" . $numeroDePedidoCopiar . "-" . $linea . ".jpg";
        $destino2 = "imagenes_bocetos/C" . $idPedidoNuevoRepetido . "-" . $idLineaNueva . ".jpg";
        copy($origen, $destino);
        copy($origen2, $destino2);
    }
}

//________________________Agregar linea de pedido a un pedido existente_________________________________________________________________________________________________________________________________________________________________//
/**
 * Agrega una linea de pedido (nueva personalización) a un pedido ya existente.
 */
function lineaPedidoExistente(
    $conn,
    $ancho,
    $largo,
    $superficie,
    $cantidad,
    $pedidos_idpedidos,
    $formas_id_formas,
    $base_has_colores_idbase,
    $base_has_colores_idcolor,
    $idcolor_piel,
    $idcolor_modulo,
    $ancho_base,
    $largo_base,
    $pelo,
    $cantidad_topes,
    $colores_has_productos_id,
    $idProducto,
    $subtotal,
    $preciomolde,
    $nombre_personalizacion
) {
    try {
        $nomper = $nombre_personalizacion == '' ? "Diseño - " . $pedidos_idpedidos : $nombre_personalizacion;

        $sql = "SELECT colores_has_productos.id FROM colores_has_productos
        INNER JOIN productos ON productos.idproductos = colores_has_productos.productos_idproductos
        WHERE colores_has_productos.idColor = 1584 AND productos_idproductos=$idProducto";
        $query = $conn->prepare($sql);
        $query->execute();
        $id_colorProducto = $query->fetchColumn();

        $sql = "INSERT INTO lineapedido (Ancho, Largo, Superficie, cantidad, pedidos_idpedidos, colores_has_productos_id, formas_id_formas, 
            base_has_colores_idbase, base_has_colores_idcolor, idcolor_piel, idcolor_modulo, ancho_base, largo_base, pelo, cantidad_topes, 
            subtotal, preciomolde, nombrepersonalizacion) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $sentencia = $conn->prepare($sql);
        $sentencia->bindParam(1, $ancho, PDO::PARAM_STR);
        $sentencia->bindParam(2, $largo, PDO::PARAM_STR);
        $sentencia->bindParam(3, $superficie, PDO::PARAM_STR);
        $sentencia->bindParam(4, $cantidad, PDO::PARAM_STR);
        $sentencia->bindParam(5, $pedidos_idpedidos, PDO::PARAM_INT);
        $sentencia->bindParam(6, $id_colorProducto, PDO::PARAM_INT);
        $sentencia->bindParam(7, $formas_id_formas, PDO::PARAM_STR);
        $sentencia->bindParam(8, $base_has_colores_idbase, PDO::PARAM_STR);
        $sentencia->bindParam(9, $base_has_colores_idcolor, PDO::PARAM_STR);
        $sentencia->bindParam(10, $idcolor_piel, PDO::PARAM_STR);
        $sentencia->bindParam(11, $idcolor_modulo, PDO::PARAM_STR);
        $sentencia->bindParam(12, $ancho_base, PDO::PARAM_STR);
        $sentencia->bindParam(13, $largo_base, PDO::PARAM_STR);
        $sentencia->bindParam(14, $pelo, PDO::PARAM_STR);
        $sentencia->bindParam(15, $cantidad_topes, PDO::PARAM_STR);
        $sentencia->bindParam(16, $subtotal, PDO::PARAM_STR);
        $sentencia->bindParam(17, $preciomolde, PDO::PARAM_STR);
        $sentencia->bindParam(18, $nomper, PDO::PARAM_STR);

        $sentencia->execute();
    } catch (Exception $e) {
        // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
    }

    //Obtenemos el id de la linea de pedido que agregamos
    $id_lineapedido_nuevo = $conn->lastInsertId(); //https://www.php.net/manual/es/pdo.lastinsertid.php

    //Agregar los colores de la linea de pedido
    $str = strval($colores_has_productos_id[0]);
    $arr = explode(",", $str);
    foreach ($arr as $idcolor) {
        try {
            $sql = "INSERT INTO colorlineapedidoelegido (idlineapedido, idcolor) 
             VALUES (?, ?)";
            $sentencia = $conn->prepare($sql);
            $sentencia->bindParam(1, $id_lineapedido_nuevo, PDO::PARAM_STR);
            $sentencia->bindParam(2, $idcolor, PDO::PARAM_STR);
            $sentencia->execute();
        } catch (Exception $e) {
            // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
        }
    }

    # definimos la carpeta destino
    $carpetaDestino = "imagenes_bocetos/";

    # si hay algun archivo que subir
    if (isset($_FILES["archivo"]) && $_FILES["archivo"]["name"]) {
        $path = $_FILES['archivo']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        # si exsite la carpeta o se ha creado
        if (file_exists($carpetaDestino) || @mkdir($carpetaDestino)) {
            $origen = $_FILES["archivo"]["tmp_name"];
            $destino = $carpetaDestino . $_FILES["archivo"]["name"];

            # movemos el archivo
            if (@move_uploaded_file($origen, $destino)) {

                // Renombrar el archivo
                $oldname = "imagenes_bocetos/" . $_FILES["archivo"]["name"]; // . "." . $_FILES["archivo"]["type"];
                $newname = "imagenes_bocetos/C" . $pedidos_idpedidos . "-" . $id_lineapedido_nuevo . "." . $ext; // . "." . $_FILES["archivo"]["type"];
                rename($oldname, $newname);
            }
        }
    }

    //Sumamos el subtotal de la linea de pedido a añadir al subtotal del pedido
    $total = getPrecioPedido($conn, $pedidos_idpedidos);
    $total = (float)$total + (float)$subtotal;

    try {
        $sql = "UPDATE pedidos SET precioTotal=? WHERE idpedidos=$pedidos_idpedidos";
        $query = $conn->prepare($sql);
        $query->bindParam(1, $total, PDO::PARAM_STR);
        $query->execute();
    } catch (Exception $e) {
        // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
    }
}

//________________________Agregar linea de pedido a un pedido nuevo_________________________________________________________________________________________________________________________________________________________________//
/**
 * Agrega una linea de pedido (nueva personalización) a un pedido nuevo.
 */
function lineaPedidoNuevo(
    $conn,
    $ancho,
    $largo,
    $superficie,
    $cantidad,
    $formas_id_formas,
    $base_has_colores_idbase,
    $base_has_colores_idcolor,
    $idcolor_piel,
    $idcolor_modulo,
    $ancho_base,
    $largo_base,
    $pelo,
    $cantidad_topes,
    $colores_has_productos_id,
    $idProducto,
    $subtotal,
    $preciomolde,
    $nombre_pedido,
    $nombre_personalizacion
) {
    $numeroDePedidoNuevo = generarNumeroPedido($conn);
    $fechaAhora = generarFechaActual($conn);
    $nomped = $nombre_pedido == '' ? "Pedido - " . $numeroDePedidoNuevo : $nombre_pedido;

    try {
        $sql = "SELECT colores_has_productos.id FROM colores_has_productos
        INNER JOIN productos ON productos.idproductos = colores_has_productos.productos_idproductos
        WHERE colores_has_productos.idColor = 1584 AND productos_idproductos=$idProducto";
        $query = $conn->prepare($sql);
        $query->execute();
        $id_colorProducto = $query->fetchColumn();

        $sql = "INSERT INTO pedidos (fechaPedido, precioTotal, metodoPago, factura, usuarios_id, metodospago_idMetodosPago, estado, notas, 
        nombrepedido, personasdecontacto_id, direccionEnvio, direcionFacturacion, numeroPedido) 
        VALUES (?, ?, '', 0, ?, 2, 'Pendiente', '', ?, 0, 0, 0, '')";

        $sentencia = $conn->prepare($sql);
        $sentencia->bindParam(1, $fechaAhora, PDO::PARAM_STR);
        $sentencia->bindParam(2, $subtotal, PDO::PARAM_STR);
        $sentencia->bindParam(3, $_SESSION['ID'], PDO::PARAM_STR);
        $sentencia->bindParam(4, $nomped, PDO::PARAM_STR);
        $sentencia->execute();
    } catch (Exception $e) {
        // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
    }
    //Obtenemos el id del pedido que agregamos
    $id_pedido_nuevo = $conn->lastInsertId(); //https://www.php.net/manual/es/pdo.lastinsertid.php

    historico($conn, $id_pedido_nuevo, 'PEDIDO CREADO', "");

    $nomper = $nombre_personalizacion == '' ? "Diseño - " . $numeroDePedidoNuevo : $nombre_personalizacion;

    //Agregar la linea de pedido al pedido que se ha creado
    try {
        $sql = "INSERT INTO lineapedido (Ancho, Largo, Superficie, cantidad, pedidos_idpedidos, colores_has_productos_id, formas_id_formas, 
        base_has_colores_idbase, base_has_colores_idcolor, idcolor_piel, idcolor_modulo, ancho_base, largo_base, pelo, cantidad_topes, subtotal,
        preciomolde, nombrepersonalizacion) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $sentencia = $conn->prepare($sql);
        $sentencia->bindParam(1, $ancho, PDO::PARAM_STR);
        $sentencia->bindParam(2, $largo, PDO::PARAM_STR);
        $sentencia->bindParam(3, $superficie, PDO::PARAM_STR);
        $sentencia->bindParam(4, $cantidad, PDO::PARAM_STR);
        $sentencia->bindParam(5, $id_pedido_nuevo, PDO::PARAM_INT);
        $sentencia->bindParam(6, $id_colorProducto, PDO::PARAM_INT);
        $sentencia->bindParam(7, $formas_id_formas, PDO::PARAM_STR);
        $sentencia->bindParam(8, $base_has_colores_idbase, PDO::PARAM_STR);
        $sentencia->bindParam(9, $base_has_colores_idcolor, PDO::PARAM_STR);
        $sentencia->bindParam(10, $idcolor_piel, PDO::PARAM_STR);
        $sentencia->bindParam(11, $idcolor_modulo, PDO::PARAM_STR);
        $sentencia->bindParam(12, $ancho_base, PDO::PARAM_STR);
        $sentencia->bindParam(13, $largo_base, PDO::PARAM_STR);
        $sentencia->bindParam(14, $pelo, PDO::PARAM_STR);
        $sentencia->bindParam(15, $cantidad_topes, PDO::PARAM_STR);
        $sentencia->bindParam(16, $subtotal, PDO::PARAM_STR);
        $sentencia->bindParam(17, $preciomolde, PDO::PARAM_STR);
        $sentencia->bindParam(18, $nomper, PDO::PARAM_STR);

        $sentencia->execute();
    } catch (Exception $e) {
        // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
    }
    //Obtenemos el id de la linea de pedido que agregamos
    $id_lineapedido_nuevo = $conn->lastInsertId(); //https://www.php.net/manual/es/pdo.lastinsertid.php

    //Agregar los colores de la linea de pedido
    $str = strval($colores_has_productos_id[0]);
    $arr = explode(",", $str);
    foreach ($arr as $idcolor) {
        try {
            $sql = "INSERT INTO colorlineapedidoelegido (idlineapedido, idcolor) 
                 VALUES (?, ?)";
            $sentencia = $conn->prepare($sql);

            $sentencia->bindParam(1, $id_lineapedido_nuevo, PDO::PARAM_STR);
            $sentencia->bindParam(2, $idcolor, PDO::PARAM_STR);

            $sentencia->execute();
        } catch (Exception $e) {
            // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
        }
    }

    # definimos la carpeta destino
    $carpetaDestino = "imagenes_bocetos/";

    # si hay algun archivo que subir
    if (isset($_FILES["archivo"]) && $_FILES["archivo"]["name"]) {
        $path = $_FILES['archivo']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        # si exsite la carpeta o se ha creado
        if (file_exists($carpetaDestino) || @mkdir($carpetaDestino)) {
            $origen = $_FILES["archivo"]["tmp_name"];
            $destino = $carpetaDestino . $_FILES["archivo"]["name"];

            # movemos el archivo
            if (@move_uploaded_file($origen, $destino)) {

                // Renombrar el archivo
                $oldname = "imagenes_bocetos/" . $_FILES["archivo"]["name"]; // . "." . $_FILES["archivo"]["type"];
                $newname = "imagenes_bocetos/C" . $id_pedido_nuevo . "-" . $id_lineapedido_nuevo . "." . $ext; // . "." . $_FILES["archivo"]["type"];
                rename($oldname, $newname);
            }
        }
    }
}

//________________________historico_________________________________________________________________________________________________________________________________________________________________//
/**
 * Insertará en el historico el mensaje correspondiente.
 * "mensaje" corresponde al campo descripcion de la tabla
 * En el caso que el "mensaje" sea VENTA_VALORADA se buscará el id de la venta para hacer el insert correspondiente.
 */
function historico($conn, $idPedido, $mensaje, $anotaciones)
{
    $idventa = null;

    $fechaAhora = date("Y-m-d H:i:s", time());

    try {
        $sql = "INSERT INTO historicopedidoventa (usuario, descripcion, anotaciones, fecha, idpedidos, idventas) VALUES (?, ?, ?, ?, ?, ?)";
        $sentencia = $conn->prepare($sql);

        $sentencia->bindParam(1, $_SESSION['ID'], PDO::PARAM_STR);
        $sentencia->bindParam(2, $mensaje, PDO::PARAM_STR);
        $sentencia->bindParam(3, $anotaciones, PDO::PARAM_STR);
        $sentencia->bindParam(4, $fechaAhora, PDO::PARAM_STR);
        $sentencia->bindParam(5, $idPedido, PDO::PARAM_INT);
        $sentencia->bindParam(6, $idventa, PDO::PARAM_INT);
        $sentencia->execute();
    } catch (Exception $e) {
        // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
    }
}

//________________________cambiar estado_________________________________________________________________________________________________________________________________________________________________//
/**
 * Cambia el pedido al estado indicado
 * En el caso que el estado sea VALORADO se actualizará también el estado en la tabla ventas
 */
function estado($conn, $idPedido, $estado, $comentario)
{
    try {
        if ($estado == "Confirmado") {
            $sql = "UPDATE pedidos SET estado=?, notas=? WHERE idpedidos=?";
            $sentencia = $conn->prepare($sql);

            $sentencia->bindParam(1, $estado, PDO::PARAM_STR);
            $sentencia->bindParam(2, $comentario, PDO::PARAM_STR);
            $sentencia->bindParam(3, $idPedido, PDO::PARAM_INT);

            $sentencia->execute();
        } else {
            $sql = "UPDATE pedidos SET estado=? WHERE idpedidos=?";
            $sentencia = $conn->prepare($sql);

            $sentencia->bindParam(1, $estado, PDO::PARAM_STR);
            $sentencia->bindParam(2, $idPedido, PDO::PARAM_INT);

            $sentencia->execute();
        }
    } catch (Exception $e) {
        // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
    }
}


//____________Generar numero de pedido______________________________________________________________________________________________________________________________________________________________//
/**
 * Genera un numero random entre 1000 y 9999 (esto porque Redsys no admite numeros de pedido de 3 digitos o menos)
 * Verifica que el numero generado no esté repetido dentro de la tabla de pedido. Generará numeros random hasta que 
 * no esté repetido.
 */
function generarNumeroPedido($conn)
{
    $numeroDePedidoNuevo = 0;
    $bool = true;
    while ($bool) { //Verificamos que el numero de pedido (que es un numero random) no exista ya
        $bool = false;
        $numeroDePedidoNuevo = rand(1000, 9999);

        try {
            $sql = "SELECT * FROM pedidos WHERE numeroPedido =" . $numeroDePedidoNuevo;
            $query = $conn->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
        }
        foreach ($results as $result) {
            $bool = true;
        }
    }
    return $numeroDePedidoNuevo;
}


//______Generar fecha actual________________________________________________________________________________________________________________________________________________________________________//
/**
 * funcion date() genera formato de fecha sin hora
 */
function generarFechaActual()
{
    $fechaAhora = date("Ymd");
    return $fechaAhora;
}

//______Generar fecha y hora actual________________________________________________________________________________________________________________________________________________________________________//
/**
 * funcion date() genera formato de fecha con hora
 */
function generarFechaHoraActual()
{
    $fechaAhora = date("Y-m-d H:i:s");
    return $fechaAhora;
}

//______Obtener total pedido________________________________________________________________________________________________________________________________________________________________________//
/**
 * Busca el campo precioTotal del pedido indicado
 */
function getPrecioPedido($conn, $idpedido)
{
    try {
        $sql = "SELECT precioTotal FROM pedidos WHERE idpedidos=$idpedido";
        $query = $conn->prepare($sql);
        $query->execute();
        return $query->fetchColumn();
    } catch (Exception $e) {
        // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
    }
}

//______Obtener subtotal linea pedido________________________________________________________________________________________________________________________________________________________________________//
/**
 * Busca el campo subtotal de la linea de pedido indicada
 */
function getPrecioLineaPedido($conn, $idlineaPedido)
{
    try {
        $sql = "SELECT subtotal FROM lineapedido WHERE idlineaPedido=$idlineaPedido";
        $query = $conn->prepare($sql);
        $query->execute();
        return $query->fetchColumn();
    } catch (Exception $e) {
        // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
    }
}

//______Obtener tarifa del producto________________________________________________________________________________________________________________________________________________________________________//
/**
 * Busca el precio del producto indicado segun la cantidad y superficie
 */
function getTarifa($conn, $id, $superficie, $cantidad)
{
    $cantidadSQL = 0;
    $superficieSQL = 0;

    $cantidadSQL = getCantidadSQL($cantidad);

    if ($id == '47') {
        $superficieSQL = 47;
    } else if ($superficie == '0') {
        $superficieSQL = $id;
    } else if ($id == '41') {
        $superficieSQL = $superficie;
    } else {
        $superficieSQL = getSuperficieSQL($superficie);
    }

    try {
        $sql = "SELECT `" . $cantidadSQL . "` FROM precios 
        WHERE superficie='$superficieSQL' AND productos_idproductos =$id";
        $query = $conn->prepare($sql);
        $query->execute();
        $tarifa = $query->fetchColumn();
    } catch (Exception $e) {
        // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
    }

    if ($tarifa == "" || $tarifa == null) {
        return 0;
    } else {
        //tarifa * cantidad para obtener el subtotal
        return ((float)$tarifa * (float)$cantidad);
    }
}

//______Obtener id del producto________________________________________________________________________________________________________________________________________________________________________//
/**
 * Buscar id del producto por el id del color_has_producto
 */
function getIdProductoByCHP($conn, $colores_has_productos_id)
{
    try {
        $sql = "SELECT productos_idproductos FROM colores_has_productos 
        WHERE id=" . $colores_has_productos_id . " GROUP BY productos_idproductos";
        $query = $conn->prepare($sql);
        $query->execute();
        return $query->fetchColumn();
    } catch (Exception $e) {
        // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
    }
}

//______________________________________________________________________________________________________________________________________________________________________________//
/**
 * Buscar id del producto por el id del color_has_producto
 */
function getNumPedidoByLinea($conn, $idlinea)
{
    try {
        $sql = "SELECT idpedidos FROM pedidos 
        INNER JOIN lineapedido  ON lineapedido.pedidos_idpedidos = pedidos.idpedidos
        WHERE idlineaPedido=" . $idlinea;
        $query = $conn->prepare($sql);
        $query->execute();
        return $query->fetchColumn();
    } catch (Exception $e) {
        // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
    }
}

//______Eliminar pedido________________________________________________________________________________________________________________________________________________________________________//
/**
 * Elimina el pedido y todo lo relacionado.
 * 1) Elimina colores elegidos
 * 2) Elimina las lineas de pedido
 * 3) Elimina bocetos del cliente
 * 4) Elimina el pedido
 * OJO: el pedido solo puede ser eliminado en su primer estado (PENDIENTE)
 */
function eliminarPedido($conn, $idPedido)
{
    //buscamos las lineas de pedido
    try {
        $sql = "SELECT * FROM lineapedido WHERE pedidos_idpedidos=" . $idPedido;
        $query = $conn->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);


        foreach ($results as $result) {
            //Elimina los colores de las lineas de pedido
            $sql = "DELETE FROM colorlineapedidoelegido WHERE idlineapedido=" . $result->idlineaPedido;
            $sentencia = $conn->prepare($sql);
            $sentencia->execute();

            //Elimina las lineas de pedido
            $sql = "DELETE FROM lineapedido WHERE idlineaPedido=" . $result->idlineaPedido;
            $sentencia = $conn->prepare($sql);
            $sentencia->execute();

            //Eliminar imagenes
            // Ruta del directorio donde están los archivos
            $path  = '/imagenes_bocetos';
            // Arreglo con todos los nombres de los archivos
            $files = array_diff(scandir(__DIR__ . $path), array('.', '..'));
            foreach ($files as $file) {
                // Divides en dos el nombre de tu archivo utilizando el . 
                $data = explode(".", $file);
                // Nombre del archivo
                $fileName = $data[0];
                // Extensión del archivo 
                $fileExtension = $data[1];

                if (("C" . $idPedido . "-" . $result->idlineaPedido) == $fileName) {
                    // echo $fileName;
                    unlink(__DIR__ . $path . "/" . $fileName . "." . $fileExtension);
                    // Realizamos un break para que el ciclo se interrumpa
                    break;
                }
            }
        }

        //Elimina el pedido
        $sql = "DELETE FROM pedidos WHERE idpedidos=" . $idPedido;
        $sentencia = $conn->prepare($sql);
        $sentencia->execute();
    } catch (Exception $e) {
        // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
    }
}

//______Eliminar linea de pedido________________________________________________________________________________________________________________________________________________________________________//
/**
 * Elimina las lineas de pedido indicadas.
 * En el caso que se eliminen todas las lineas, se elimina tambien el pedido
 * 1) Elimina colores elegidos
 * 2) Elimina la linea de pedido
 * 3) Resta el coste de la linea de pedido al coste total del pedido
 * OJO: solo pueden ser eliminadas en su primer estado (PENDIENTE)
 */
function eliminarLineaPedido($conn, $idLineaPedido, $idpedido)
{
    //Obtenemos el subtotal correspondiente a esa linea de pedido para restarla al total del pedido
    $total = getPrecioPedido($conn, $idpedido);
    $subtotal = getPrecioLineaPedido($conn, $idLineaPedido);
    $countLP = 0;
    try {
        $sql = "SELECT COUNT(idlineaPedido) FROM lineapedido WHERE pedidos_idpedidos=$idpedido";
        $query = $conn->prepare($sql);
        $query->execute();
        $countLP = $query->fetchColumn();

        //Elimina los colores de la linea de pedido
        $sql = "DELETE FROM colorlineapedidoelegido WHERE idlineapedido=" . $idLineaPedido;
        $sentencia = $conn->prepare($sql);
        $sentencia->execute();

        //Elimina la linea
        $sql = "DELETE FROM lineapedido WHERE idlineaPedido=" . $idLineaPedido;
        $sentencia = $conn->prepare($sql);
        $sentencia->execute();
    } catch (Exception $e) {
        // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
    }
    //Eliminar imagenes
    // Ruta del directorio donde están los archivos
    $path  = '/imagenes_bocetos';
    // Arreglo con todos los nombres de los archivos
    $files = array_diff(scandir(__DIR__ . $path), array('.', '..'));
    foreach ($files as $file) {
        // Divides en dos el nombre de tu archivo utilizando el . 
        $data = explode(".", $file);
        // Nombre del archivo
        $fileName = $data[0];
        // Extensión del archivo 
        $fileExtension = $data[1];

        if (("C" . $idpedido . "-" . $idLineaPedido) == $fileName) {
            // echo $fileName;
            unlink(__DIR__ . $path . "/" . $fileName . "." . $fileExtension);
            // Realizamos un break para que el ciclo se interrumpa
            break;
        }
    }

    //Si solo queda una personalizacion (la que se va a eliminar) se elimina tambien el pedido
    if ($countLP == 1) {
        //Elimina el pedido
        try {
            $sql = "DELETE FROM pedidos WHERE idpedidos=" . $idpedido;
            $sentencia = $conn->prepare($sql);
            $sentencia->execute();
        } catch (Exception $e) {
            // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
        }
    } else {
        $total = (float)$total - (float)$subtotal;

        try {
            $sql = "UPDATE pedidos SET precioTotal=? WHERE idpedidos=$idpedido";
            $query = $conn->prepare($sql);
            $query->bindParam(1, $total, PDO::PARAM_STR);
            $query->execute();
        } catch (Exception $e) {
            // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
        }
    }
}

//______Obtener la cantidad correspondiente para  poder buscar la tarifa del producto________________________________________________________________________________________________________________________//
/**
 * Devuelve el valor del rango al que pertenece la cantidad escogida por el usuario.
 * Este valor es solo para buscar el campo adecuado en la tabla tarifas 
 */
function getCantidadSQL($cantidad)
{
    if ($cantidad == 1) { //Asignamos valor a variable que servira para la consulta SQL
        return 1;
    } else if ($cantidad > 1 && $cantidad <= 4) {
        return 4;
    } else if ($cantidad > 4 && $cantidad <= 9) {
        return 9;
    } else if ($cantidad > 9 && $cantidad <= 19) {
        return 19;
    } else if ($cantidad > 19 && $cantidad <= 34) {
        return 34;
    } else if ($cantidad > 34 && $cantidad <= 49) {
        return 49;
    } else if ($cantidad > 49 && $cantidad <= 99) {
        return 99;
    } else if ($cantidad > 99 && $cantidad <= 199) {
        return 199;
    } else if ($cantidad > 199 && $cantidad <= 349) {
        return 349;
    } else if ($cantidad > 349 && $cantidad <= 499) {
        return 499;
    } else if ($cantidad > 499 && $cantidad <= 749) {
        return 749;
    } else if ($cantidad > 749 && $cantidad <= 999) {
        return 999;
    } else if ($cantidad > 999 && $cantidad <= 1499) {
        return 1499;
    } else if ($cantidad > 1499 && $cantidad <= 1999) {
        return 1999;
    } else if ($cantidad > 1999 && $cantidad <= 2999) {
        return 2999;
    } else if ($cantidad > 2999 && $cantidad <= 3999) {
        return 3999;
    } else if ($cantidad > 3999 && $cantidad <= 5999) {
        return 5999;
    } else if ($cantidad > 5999 && $cantidad <= 7999) {
        return 7999;
    } else if ($cantidad > 7999 && $cantidad <= 9999) {
        return 9999;
    } else if ($cantidad > 9999) {
        return 10000;
    }
}

//______Obtener la superficie correspondiente para  poder buscar la tarifa del producto__________________________________________________________________________________________________________________________//
/**
 * Devuelve el valor del rango al que pertenece la superficie escogida por el usuario.
 * Este valor es solo para buscar el campo adecuado en la tabla tarifas 
 */
function getSuperficieSQL($superficie)
{
    if ($superficie > 0 && $superficie <= 20) { //Superficie para consulta SQL
        return 20;
    } else if ($superficie > 20 && $superficie <= 30) {
        return 30;
    } else if ($superficie > 30 && $superficie <= 40) {
        return 40;
    } else if ($superficie > 40 && $superficie <= 50) {
        return 50;
    } else if ($superficie > 50 && $superficie <= 65) {
        return 65;
    } else if ($superficie > 65 && $superficie <= 80) {
        return 80;
    } else if ($superficie > 80 && $superficie <= 100) {
        return 100;
    } else if ($superficie > 100 && $superficie <= 125) {
        return 125;
    } else if ($superficie > 125 && $superficie <= 150) {
        return 150;
    } else if ($superficie > 150 && $superficie <= 200) {
        return 200;
    } else if ($superficie > 200 && $superficie <= 250) {
        return 250;
    } else if ($superficie > 250 && $superficie <= 300) {
        return 300;
    } else if ($superficie > 300 && $superficie <= 350) {
        return 350;
    } else if ($superficie > 350 && $superficie <= 400) {
        return 400;
    } else if ($superficie > 400 && $superficie <= 500) {
        return 500;
    } else if ($superficie > 500 && $superficie <= 600) {
        return 600;
    } else if ($superficie > 600 && $superficie <= 700) {
        return 700;
    } else if ($superficie > 700 && $superficie <= 800) {
        return 800;
    } else if ($superficie > 800 && $superficie <= 900) {
        return 900;
    } else if ($superficie > 900 && $superficie <= 1000) {
        return 1000;
    }
}

/**
 * Busca la existencia de numero de pedido almacen (Borman), devolviendo true si existe.
 */
if (isset($_POST['numped_exist'])) {
    require "includes/config.php";
    $numeroPedidoAlmacen = $_POST['numped_exist'];
    try {
        $sql = "SELECT NumPedido FROM pedidoalmacen 
        WHERE NumPedido=?";
        $sentencia = $conn_prgborman->prepare($sql);
        $sentencia->bindParam(1, $numeroPedidoAlmacen, PDO::PARAM_STR);
        $sentencia->execute();
        $results = $sentencia->fetchColumn();
    } catch (Exception $e) {
        header("location: error.php?msg=" . $e->getCode());
    }

    if ($sentencia->rowCount() >= 1) {
        echo true;
    }
    echo false;
}

/**
 * Busca la existencia de numero de fabricación (Borman), devolviendo true si existe.
 */
if (isset($_POST['numfab_exist'])) {
    require "includes/config.php";
    $numeroFabricacion = $_POST['numfab_exist'];
    try {
        $sql = "SELECT numFabricacion FROM fabricaciones 
        WHERE numFabricacion=?";
        $sentencia = $conn_prgborman->prepare($sql);
        $sentencia->bindParam(1, $numeroFabricacion, PDO::PARAM_STR);
        $sentencia->execute();
        $results = $sentencia->fetchColumn();
    } catch (Exception $e) {
        header("location: error.php?msg=" . $e->getCode());
    }

    if ($sentencia->rowCount() >= 1) {
        echo true;
    }
    echo false;
}
