<?php
//Funcion inicial y llamado para los textos--------------------------------------------------------------------
/**
 * Recoge todos los textos del idioma seleccionado, por defecto será el español 
 */
function  llamadoInicial($idiomaselect)
{
    require "includes/config.php";
    //  $_SESSION['idioma'] = $idiomaselect;
    try {
        global $conn;
        $query2 = $conn->prepare("SELECT * FROM traducciones WHERE (idioma= '" .  $idiomaselect . "' AND correcto=1) or idioma='ES' ORDER BY tipo, subidentificador1, subidentificador2, FIELD(idioma, '" .  $idiomaselect . "') DESC;");
        $query2->execute();
        return $query2->fetchAll(PDO::FETCH_OBJ);
    } catch (Exception $e) {
        // header("location: error?msg=" . $e->getCode());
        // header("location: error?msg=" . $e->getMessage());
    }
}

/**
 * Con el resultado de la llamada inicial esta función busca el texto deseado para imprimirlo en pantalla.
 * Si no se encontrara el texto correcto para el idioma seleccionado, será por defecto español
 */
function buscarTexto($tipo, $identificador, $subidentificador1, $subidentificador2, $idiomaselect)
{
    foreach ($_SESSION['resultadoTraduccionPertex'] as $result) {
        if (($result->tipo == $tipo && $result->identificador == $identificador &&
            $result->subidentificador1 == $subidentificador1 && $result->subidentificador2 == $subidentificador2) && ($result->idioma == $idiomaselect && $result->idioma != "ES")) {
            echo $result->texto;
            break;
        } else if (
            $result->tipo == $tipo && $result->identificador == $identificador &&
            $result->subidentificador1 == $subidentificador1 && $result->subidentificador2 == $subidentificador2 && ($result->idioma == "ES")
        ) {

            echo $result->texto;
        }
    }
}

/**
 * Con el resultado de la llamada inicial esta función busca el texto deseado para devolverlo por return.
 * A diferencia de la funcion anterior, este no lo imprime directamente. Utilizado en casos que se necesite
 * hacer algo con ese texto ANTES de imprimirlo.
 * Si no se encontrara el texto correcto para el idioma seleccionado, será por defecto español
 * */
function buscarTextoConReturn($tipo, $identificador, $subidentificador1, $subidentificador2, $idiomaselect)
{
    foreach ($_SESSION['resultadoTraduccionPertex'] as $result) {
        if (($result->tipo == $tipo && $result->identificador == $identificador &&
            $result->subidentificador1 == $subidentificador1 && $result->subidentificador2 == $subidentificador2) && ($result->idioma == $idiomaselect && $result->idioma != "ES")) {
            return $result->texto;
            break;
        } else if (
            $result->tipo == $tipo && $result->identificador == $identificador &&
            $result->subidentificador1 == $subidentificador1 && $result->subidentificador2 == $subidentificador2 && ($result->idioma == "ES")
        ) {

            return $result->texto;
        }
    }
}

/**
 * Recoge todos los textos del idioma seleccionado, por defecto será el español 
 */
function  llamadoInicialFormularios($idiomaselect)
{
    require "../includes/config.php";
    try {
        global $conn_formularios;
        $query2 = $conn_formularios->prepare("SELECT * FROM traducciones WHERE (idioma= '" .  $idiomaselect . "' AND correcto=1 ) or idioma='ES' ORDER BY tipo, subidentificador1, subidentificador2, FIELD(idioma, '" .  $idiomaselect . "') DESC;");
        $query2->execute();
        return $query2->fetchAll(PDO::FETCH_OBJ);
    } catch (Exception $e) {
        //Mensaje de error o redirección
    }
}


/**
 * Con el resultado de la llamada inicial esta función busca el texto deseado para imprimirlo en pantalla.
 * Si no se encontrara el texto correcto para el idioma seleccionado, será por defecto español
 */
function buscarTextoFormularios($tipo, $identificador, $subidentificador1, $subidentificador2, $idiomaselect)
{
    foreach ($_SESSION['resultadoTraduccionFormularios'] as $result) {
        if (($result->tipo == $tipo && $result->identificador == $identificador &&
            $result->subidentificador1 == $subidentificador1 && $result->subidentificador2 == $subidentificador2) && ($result->idioma == $idiomaselect && $result->idioma != "ES")) {
            echo $result->texto;
            break;
        } else if (
            $result->tipo == $tipo && $result->identificador == $identificador &&
            $result->subidentificador1 == $subidentificador1 && $result->subidentificador2 == $subidentificador2 && ($result->idioma == "ES")
        ) {
            echo $result->texto;
        }
    }
}


/**
 * Verifica la existencia de un texto por medio de sus identificadores
 */
function existe($tipo, $identificador, $subidentificador1, $subidentificador2, $idiomaselect)
{
    foreach ($_SESSION['resultadoTraduccionPertex'] as $result) {
        if (($result->tipo == $tipo && $result->identificador == $identificador &&
            $result->subidentificador1 == $subidentificador1 && $result->subidentificador2 == $subidentificador2) && ($result->idioma == $idiomaselect && $result->idioma != "ES")) {
            return true;
            break;
        } else if (
            $result->tipo == $tipo && $result->identificador == $identificador &&
            $result->subidentificador1 == $subidentificador1 && $result->subidentificador2 == $subidentificador2 && ($result->idioma == "ES")
        ) {
            return true;
        }
    }
    return false;
}

/**
 * Busca la existencia del nombre de personalización/diseño por usuario, devuelve true si existe.
 */
if (isset($_POST['nombreDisenoExiste'])) {
    require "../includes/config.php";
    $nombre = $_POST["nombreDisenoExiste"];

    try {
        $sql = "SELECT nombrepersonalizacion FROM lineapedido INNER JOIN pedidos ON pedidos.idpedidos = lineapedido.pedidos_idpedidos
         WHERE nombrepersonalizacion = ? AND usuarios_id=?";
        $sentencia = $conn->prepare($sql);
        $sentencia->bindParam(1, $nombre, PDO::PARAM_STR);
        $sentencia->bindParam(2, $_SESSION['ID'], PDO::PARAM_INT);
        $sentencia->execute();
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    if ($sentencia->rowCount() == 1) {
        echo true;
    }
    echo false;
}
/**
 * Busca la existencia del nombre de pedido por usuario, devuelve true si existe.
 */
if (isset($_POST['nombrePedidoExiste'])) {
    require "../includes/config.php";
    $nombre = $_POST["nombrePedidoExiste"];

    try {
        $sql = "SELECT nombrepedido FROM pedidos WHERE UPPER(nombrepedido) = UPPER(?) AND usuarios_id=?";
        $sentencia = $conn->prepare($sql);
        $sentencia->bindParam(1, $nombre, PDO::PARAM_STR);
        $sentencia->bindParam(2, $_SESSION['ID'], PDO::PARAM_INT);
        $sentencia->execute();
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    if ($sentencia->rowCount() == 1) {
        echo true;
    }
    echo false;
}

/**
 * Busca la existencia del nombre de personalización/diseño, devuelve true si existe.
 */
function datosCompletos()
{
    require "../includes/config.php";
    try {
        $sql = "SELECT sepuedemodificar
        FROM fichaempresametas
        WHERE email=?";
        $sentencia = $conn_formularios->prepare($sql);
        $sentencia->bindParam(1, $_SESSION['email'], PDO::PARAM_STR);
        $sentencia->execute();
        $results = $sentencia->fetchColumn();
        if ($results == 0) {
            return true;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

/**
 * Busca el precio del producto indicado segun la cantidad y superficie
 */
if (isset($_POST['precio'])) {
    require "../includes/config.php";
    $sqlCantidad = 0;
    $cantidad = $_POST['cantidad'];
    $superficie = $_POST['superficie'];
    $idproducto = $_POST['idproducto'];

    if ($cantidad == 1) { // Asignamos valor a variable que servira para la consulta SQL
        $sqlCantidad = 1;
    } else if ($cantidad > 1 && $cantidad <= 4) {
        $sqlCantidad = 4;
    } else if ($cantidad > 4 && $cantidad <= 9) {
        $sqlCantidad = 9;
    } else if ($cantidad > 9 && $cantidad <= 19) {
        $sqlCantidad = 19;
    } else if ($cantidad > 19 && $cantidad <= 34) {
        $sqlCantidad = 34;
    } else if ($cantidad > 34 && $cantidad <= 49) {
        $sqlCantidad = 49;
    } else if ($cantidad > 49 && $cantidad <= 99) {
        $sqlCantidad = 99;
    } else if ($cantidad > 99 && $cantidad <= 199) {
        $sqlCantidad = 199;
    } else if ($cantidad > 199 && $cantidad <= 349) {
        $sqlCantidad = 349;
    } else if ($cantidad > 349 && $cantidad <= 499) {
        $sqlCantidad = 499;
    } else if ($cantidad > 499 && $cantidad <= 749) {
        $sqlCantidad = 749;
    } else if ($cantidad > 749 && $cantidad <= 999) {
        $sqlCantidad = 999;
    } else if ($cantidad > 999 && $cantidad <= 1499) {
        $sqlCantidad = 1499;
    } else if ($cantidad > 1499 && $cantidad <= 1999) {
        $sqlCantidad = 1999;
    } else if ($cantidad > 1999 && $cantidad <= 2999) {
        $sqlCantidad = 2999;
    } else if ($cantidad > 2999 && $cantidad <= 3999) {
        $sqlCantidad = 3999;
    } else if ($cantidad > 3999 && $cantidad <= 5999) {
        $sqlCantidad = 5999;
    } else if ($cantidad > 5999 && $cantidad <= 7999) {
        $sqlCantidad = 7999;
    } else if ($cantidad > 7999 && $cantidad <= 9999) {
        $sqlCantidad = 9999;
    } else if ($cantidad > 9999) {
        $sqlCantidad = 10000;
    }
    try {
        $sql = "SELECT `" . $sqlCantidad . "` FROM `precios`  WHERE `productos_idproductos`= ? AND superficie > ? ORDER BY superficie ASC LIMIT 1;";
        $query = $conn->prepare($sql);
        $query->bindParam(1, $idproducto, PDO::PARAM_INT);
        $query->bindParam(2, $superficie, PDO::PARAM_STR);
        $query->execute();
        echo $query->fetchColumn();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

/**
 * Busca el precio del producto indicado segun la $cantidad y superficie
 */
if (isset($_POST['cantidadMinima'])) {
    require "../includes/config.php";
    try {
        $sql = "SELECT  CASE    WHEN `1` IS NOT NULL THEN '1'  WHEN `4` IS NOT NULL THEN '2' 
        WHEN `9` IS NOT NULL THEN '5'  WHEN `19` IS NOT NULL THEN '10' 
        WHEN `34` IS NOT NULL THEN '20'  WHEN `49` IS NOT NULL THEN '35' 
        WHEN `99` IS NOT NULL THEN '50'  WHEN `199` IS NOT NULL THEN '100' 
        WHEN `349` IS NOT NULL THEN '200'  WHEN `499` IS NOT NULL THEN '350' 
        WHEN `749` IS NOT NULL THEN '500'  WHEN `999` IS NOT NULL THEN '750' 
        WHEN `1499` IS NOT NULL THEN '1000'  WHEN `1999` IS NOT NULL THEN '1500' 
        WHEN `2999` IS NOT NULL THEN '2000'  WHEN `3999` IS NOT NULL THEN '3000' 
        WHEN `5999` IS NOT NULL THEN '4000'  WHEN `7999` IS NOT NULL THEN '6000' 
        WHEN `9999` IS NOT NULL THEN '8000'  WHEN `10000` IS NOT NULL THEN '10000'  ELSE 'fijo' 
        END AS primera_columna_no_nula  FROM precios  WHERE productos_idproductos = ? limit 1;";
        $query = $conn->prepare($sql);
        $query->bindParam(1, $_POST['idproducto'], PDO::PARAM_INT);
        $query->execute();
        echo $query->fetchColumn();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}


/**
 * Si existe el email
 */
if (isset($_POST['buscarMail'])) {
    require "../includes/config.php";
    $email = $_POST['buscarMail'];

    $sql = "SELECT idfichaempresa FROM fichaempresametas WHERE email =?";
    $query = $conn_formularios->prepare($sql);
    $query->bindParam(1, $email, PDO::PARAM_STR);
    $query->execute();
    $count1 = $query->rowCount();

    $sql2 = "SELECT idpersonaDeContacto FROM personadecontactometa WHERE email =? AND numCliFP is not null";
    $query2 = $conn_formularios->prepare($sql2);
    $query2->bindParam(1, $email, PDO::PARAM_STR);
    $query2->execute();
    $count2 = $query2->rowCount();
    if (($count2 + $count1) > 0) {
        echo "1";
    } else {
        echo "0";
    }
}


if (isset($_POST['buscarBases'])) {
    require "../includes/config.php";
    $id = $_POST['idproducto'];

    $sql = "SELECT c.id_complementos FROM pertex.complementos c
    INNER JOIN productos_has_complementos pc ON pc.id_complementos = c.id_complementos
    INNER JOIN productos p ON p.idproductos = pc.id_productos
    WHERE idproductos=?";
    $query = $conn->prepare($sql);
    $query->bindParam(1, $id, PDO::PARAM_INT);
    $query->execute();
    $jsonData = json_encode($query->fetchAll(PDO::FETCH_OBJ));
    // Envía la respuesta JSON
    echo $jsonData;
}


if (isset($_POST['buscarFormas'])) {
    require "../includes/config.php";
    $id = $_POST['idproducto'];

    $sql = "SELECT f.id_formas FROM pertex.formas f
    INNER JOIN formas_has_productos fp ON fp.formas_id_formas = f.id_formas
    INNER JOIN productos p ON p.idproductos = fp.productos_idproductos
    WHERE idproductos=?";
    $query = $conn->prepare($sql);
    $query->bindParam(1, $id, PDO::PARAM_INT);
    $query->execute();
    $jsonData = json_encode($query->fetchAll(PDO::FETCH_OBJ));
    // Envía la respuesta JSON
    echo $jsonData;
}


if (isset($_POST['buscarColores'])) {
    require "../includes/config.php";
    $id = $_POST['idproducto'];
    $coloresData = []; // Un array para almacenar los datos de colores

    //obtengo los id color
    $sql = "SELECT idColor FROM colores_has_productos WHERE productos_idproductos=?";
    $query = $conn->prepare($sql);
    $query->bindParam(1, $id, PDO::PARAM_INT);
    $query->execute();
    $results_colores = $query->fetchAll(PDO::FETCH_OBJ);

    foreach ($results_colores as $idcolor) {
        //busco los colores 
        $sql = "SELECT rgb_R, rgb_G, rgb_B, nombre
        FROM colores WHERE idColor=?";
        $query = $conn_prgborman->prepare($sql);
        $query->bindParam(1, $idcolor->idColor, PDO::PARAM_INT);
        $query->execute();
        // Agregar los resultados al array
        $coloresData[] = $query->fetchAll(PDO::FETCH_OBJ);
    }
    $jsonData = json_encode($coloresData);
    // Envía la respuesta JSON
    echo $jsonData;
}

if (isset($_POST['buscarMetal'])) {
    require "../includes/config.php";
    $id = $_POST['idproducto'];
    $coloresData = []; // Un array para almacenar los datos de colores

    //obtengo los id color
    $sql = "SELECT colores_idColor FROM productos_has_modulo WHERE productos_idproductos=? AND modulo_idmodulo=1";
    $query = $conn->prepare($sql);
    $query->bindParam(1, $id, PDO::PARAM_INT);
    $query->execute();
    $results_colores = $query->fetchAll(PDO::FETCH_OBJ);

    foreach ($results_colores as $idcolor) {
        //busco los colores 
        $sql = "SELECT rgb_R, rgb_G, rgb_B, nombre
        FROM colores WHERE idColor=?";
        $query = $conn_prgborman->prepare($sql);
        $query->bindParam(1, $idcolor->colores_idColor, PDO::PARAM_INT);
        $query->execute();
        // Agregar los resultados al array
        $coloresData[] = $query->fetchAll(PDO::FETCH_OBJ);
    }
    $jsonData = json_encode($coloresData);
    // Envía la respuesta JSON
    echo $jsonData;
}

if (isset($_POST['buscarPiel'])) {
    require "../includes/config.php";
    $id = $_POST['idproducto'];
    $coloresData = []; // Un array para almacenar los datos de colores

    //obtengo los id color
    $sql = "SELECT colores_idColor FROM productos_has_modulo WHERE productos_idproductos=? AND modulo_idmodulo=2";
    $query = $conn->prepare($sql);
    $query->bindParam(1, $id, PDO::PARAM_INT);
    $query->execute();
    $results_colores = $query->fetchAll(PDO::FETCH_OBJ);

    foreach ($results_colores as $idcolor) {
        //busco los colores 
        $sql = "SELECT rgb_R, rgb_G, rgb_B, nombre
        FROM colores WHERE idColor=?";
        $query = $conn_prgborman->prepare($sql);
        $query->bindParam(1, $idcolor->colores_idColor, PDO::PARAM_INT);
        $query->execute();
        // Agregar los resultados al array
        $coloresData[] = $query->fetchAll(PDO::FETCH_OBJ);
    }
    $jsonData = json_encode($coloresData);
    // Envía la respuesta JSON
    echo $jsonData;
}

if (isset($_POST['buscarColorBase'])) {
    require "../includes/config.php";
    $id = $_POST['idbase'];
    $coloresData = []; // Un array para almacenar los datos de colores

    //obtengo los id color
    $sql = "SELECT idColor FROM complementos_has_colores WHERE id_complementos=?";
    $query = $conn->prepare($sql);
    $query->bindParam(1, $id, PDO::PARAM_INT);
    $query->execute();
    $results_colores = $query->fetchAll(PDO::FETCH_OBJ);

    foreach ($results_colores as $idcolor) {
        //busco los colores 
        $sql = "SELECT rgb_R, rgb_G, rgb_B, nombre
        FROM colores WHERE idColor=?";
        $query = $conn_prgborman->prepare($sql);
        $query->bindParam(1, $idcolor->idColor, PDO::PARAM_INT);
        $query->execute();
        // Agregar los resultados al array
        $coloresData[] = $query->fetchAll(PDO::FETCH_OBJ);
    }
    $jsonData = json_encode($coloresData);
    // Envía la respuesta JSON
    echo $jsonData;
}
