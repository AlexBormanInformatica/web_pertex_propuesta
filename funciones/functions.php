<?php
//Funcion inicial y llamado para los textos--------------------------------------------------------------------
/**
 * Recoge todos los textos del idioma seleccionado, por defecto será el español 
 */
function  llamadoInicial($idiomaselect)
{
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
 * Busca el precio del producto indicado segun la cantidad y superficie
 */
if (isset($_POST['precio'])) {
    require "../includes/config.php";
    $sqlCantidad = 0;
    $cantidad = $_POST['cantidad'];
    $superficie = $_POST['superficie'];

    $id_producto = isset($_POST['id_producto']) ? $_POST['id_producto'] : 0;
    $id_complemento = isset($_POST['id_complemento']) ? $_POST['id_complemento'] : 0;

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

    if ($id_producto != 0) {
        try {
            $sql = "SELECT `" . $sqlCantidad . "` FROM `precios`  WHERE `id_producto`= ? ";
            if ($superficie != null) {
                $sql .= " AND superficie > ? ";
                $sql .= " ORDER BY superficie ASC LIMIT 1;";
            }
            $query = $conn->prepare($sql);
            $query->bindParam(1, $id_producto, PDO::PARAM_INT);
            if ($superficie != null) {
                $query->bindParam(2, $superficie, PDO::PARAM_STR);
            }
            $query->execute();
            echo $query->fetchColumn();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } else if ($id_complemento != 0) {
        try {
            $sql = "SELECT `" . $sqlCantidad . "` FROM `precios`  WHERE `id_complemento`= ? AND superficie > ? ORDER BY superficie ASC LIMIT 1;";
            $query = $conn->prepare($sql);
            $query->bindParam(1, $id_complemento, PDO::PARAM_INT);
            $query->bindParam(2, $superficie, PDO::PARAM_STR);
            $query->execute();
            echo $query->fetchColumn();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

if (isset($_POST['precioTopes'])) {
    require "../includes/config.php";

    try {
        $sql = "SELECT `fijo` FROM `precios`  WHERE `id_complemento`= 4";
        $query = $conn->prepare($sql);
        $query->execute();
        echo $query->fetchColumn();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

/**
 * Busca el precio por forma
 */
if (isset($_POST['precioPorForma'])) {
    require "../includes/config.php";
    $sqlCantidad = 0;
    $cantidad = $_POST['cantidad'];
    $id_forma = $_POST['id_forma'];
    $id_producto = $_POST['id_producto'];

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
        $sql = "SELECT `" . $sqlCantidad . "` FROM `precios`  WHERE `id_producto`= ? AND id_forma=?";
        $query = $conn->prepare($sql);
        $query->bindParam(1, $id_producto, PDO::PARAM_INT);
        $query->bindParam(2, $id_forma, PDO::PARAM_STR);
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
        END AS primera_columna_no_nula  FROM precios  WHERE id_producto = ? limit 1;";
        $query = $conn->prepare($sql);
        $query->bindParam(1, $_POST['id_producto'], PDO::PARAM_INT);
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
    $id = $_POST['id_producto'];

    $sql = "SELECT c.id_complemento FROM pertex.complementos c
    INNER JOIN productos_has_complementos pc ON pc.id_complemento = c.id_complemento
    INNER JOIN productos p ON p.id_producto = pc.id_producto
    WHERE id_producto=?";
    $query = $conn->prepare($sql);
    $query->bindParam(1, $id, PDO::PARAM_INT);
    $query->execute();
    $jsonData = json_encode($query->fetchAll(PDO::FETCH_OBJ));
    // Envía la respuesta JSON
    echo $jsonData;
}


if (isset($_POST['buscarFormas'])) {
    require "../includes/config.php";
    $id = $_POST['id_producto'];

    $sql = "SELECT f.id_forma FROM pertex.formas f
    INNER JOIN productos_has_formas fp ON fp.id_forma = f.id_forma
    INNER JOIN productos p ON p.id_producto = fp.id_producto
    WHERE id_producto=?";
    $query = $conn->prepare($sql);
    $query->bindParam(1, $id, PDO::PARAM_INT);
    $query->execute();
    $jsonData = json_encode($query->fetchAll(PDO::FETCH_OBJ));
    // Envía la respuesta JSON
    echo $jsonData;
}


if (isset($_POST['buscarColores'])) {
    require "../includes/config.php";
    $id = $_POST['id_producto'];
    $coloresData = []; // Un array para almacenar los datos de colores

    //obtengo los id color
    $sql = "SELECT idColor FROM productos_has_colores WHERE id_producto=?";
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
    $id = $_POST['id_producto'];
    $coloresData = []; // Un array para almacenar los datos de colores

    //obtengo los id color
    $sql = "SELECT idColor FROM productos_has_modulo WHERE id_producto=? AND id_modulo=1";
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

if (isset($_POST['buscarPiel'])) {
    require "../includes/config.php";
    $id = $_POST['id_producto'];
    $coloresData = []; // Un array para almacenar los datos de colores

    //obtengo los id color
    $sql = "SELECT idColor FROM productos_has_modulo WHERE id_producto=? AND id_modulo=2";
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

if (isset($_POST['buscarColorBase'])) {
    require "../includes/config.php";
    $id = $_POST['idbase'];
    $coloresData = []; // Un array para almacenar los datos de colores

    //obtengo los id color
    $sql = "SELECT idColor FROM complementos_has_colores WHERE id_complemento=?";
    $query = $conn->prepare($sql);
    $query->bindParam(1, $id, PDO::PARAM_INT);
    $query->execute();
    $results_colores = $query->fetchAll(PDO::FETCH_OBJ);

    foreach ($results_colores as $idcolor) {
        //busco los colores 
        $sql = "SELECT rgb_R, rgb_G, rgb_B, nombre, idColor
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

if (isset($_POST['buscarMoldeBase'])) {
    require "../includes/config.php";
    $id = $_POST['idbase'];

    $sql = "SELECT molde FROM complementos WHERE id_complemento=?";
    $query = $conn->prepare($sql);
    $query->bindParam(1, $id, PDO::PARAM_INT);
    $query->execute();
    echo $query->fetchColumn();
}

if (isset($_POST['detallesEncargoSeleccionado'])) {
    require "../includes/config.php";
    $id = $_POST['numDiseno'];

    $sql = "SELECT e.nota, e.ancho_cm, e.alto_cm, e.ancho_cm_base, e.alto_cm_base, e.cantidad_topes, 
    p.nombre as producto, p.colores_limitados, f.nombre as formas, c.nombre as complemento, nota
    id_color_complemento, id_color_metal, id_color_piel
    FROM disenos e
    INNER JOIN productos p ON p.id_producto = e.id_producto
    LEFT JOIN formas f ON e.id_forma = f.id_forma
    LEFT JOIN complementos c ON e.id_complemento = c.id_complemento
    WHERE id_diseno = ?";
    $query = $conn->prepare($sql);
    $query->bindParam(1, $id, PDO::PARAM_INT);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    $producto = $comentarios = $ancho = $alto = $forma = $subtotal = $cantidad = $anchoBase = $altoBase = $cantidadTopes = $complemento = $nota = "";
    $id_color_complemento = $id_color_metal = $id_color_piel = null;
    $colores_limitados = 0;
    foreach ($results as $result) {
        $comentarios = $result->nota;
        $ancho = $result->ancho_cm;
        $alto = $result->alto_cm;
        $forma = $result->formas;
        $anchoBase = $result->ancho_cm_base;
        $altoBase = $result->alto_cm_base;
        $cantidadTopes = $result->cantidad_topes;
        $complemento = $result->complemento;
        $nota = $result->nota;
        $id_color_complemento = $result->id_color_complemento;
        $id_color_metal = $result->id_color_metal;
        $id_color_piel = $result->id_color_piel;
        $colores_limitados = $result->colores_limitados;
    }

    //Colores
    $lista_colores = [];
    if ($colores_limitados = 1) {
        //obtengo los id color
        $sql = "SELECT idColor FROM disenos_has_colores WHERE id_diseno=?";
        $query = $conn->prepare($sql);
        $query->bindParam(1, $id, PDO::PARAM_INT);
        $query->execute();
        $results_colores = $query->fetchAll(PDO::FETCH_OBJ);

        foreach ($results_colores as $idcolor) {
            try {
                //busco los colores 
                $sql = "SELECT nombre
                FROM colores WHERE idColor=?";
                $query = $conn_prgborman->prepare($sql);
                $query->bindParam(1, $idcolor->idColor, PDO::PARAM_INT);
                $query->execute();
                // Agregar los resultados al array
                $lista_colores[] = $query->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
            }
        }
    }

    $color_complemento = "";
    $color_metal = "";
    $color_piel = "";

    //Color complemento
    if ($id_color_complemento != null) {
        try {
            //busco los colores 
            $sql = "SELECT nombre
                FROM colores WHERE idColor=?";
            $query = $conn_prgborman->prepare($sql);
            $query->bindParam(1, $id_color_complemento, PDO::PARAM_INT);
            $query->execute();
            $color_complemento = $query->fetchColumn();
        } catch (Exception $e) {
        }
    }

    //Color piel
    if ($id_color_piel != null) {
        try {
            //busco los colores 
            $sql = "SELECT nombre
                FROM colores WHERE idColor=?";
            $query = $conn_prgborman->prepare($sql);
            $query->bindParam(1, $id_color_piel, PDO::PARAM_INT);
            $query->execute();
            $color_piel = $query->fetchColumn();
        } catch (Exception $e) {
        }
    }

    //Color metal
    if ($id_color_metal != null) {
        //obtengo los id color
        try {
            //busco los colores 
            $sql = "SELECT nombre
                FROM colores WHERE idColor=?";
            $query = $conn_prgborman->prepare($sql);
            $query->bindParam(1, $id_color_metal, PDO::PARAM_INT);
            $query->execute();
            $color_metal = $query->fetchColumn();
        } catch (Exception $e) {
        }
    }

    $stringDetalles = "";
    $stringDetalles .= '<h4 class="text-center m-0">Detalles</h4>';
    //Colores (limitados)
    if (count($lista_colores) > 0) {
        $stringDetalles .= '<p class="m-0"><b>Colores elegidos: </b>';
        foreach ($lista_colores as $color) {
            $stringDetalles .= $color[0]->nombre . ', ';
        }
        $stringDetalles = rtrim($stringDetalles, ', '); // Elimina la última coma y el espacio en blanco
        $stringDetalles .= '</p>';
    }

    if ($color_piel != "") {
        //Color piel
        $stringDetalles .= '<p class="m-0"><b>Color piel: </b>';
        $stringDetalles .= $color_piel . '</p>';
    }

    if ($color_metal != "") {
        //Color metal
        $stringDetalles .= '<p class="m-0"><b>Color metal: </b>';
        $stringDetalles .= $color_metal . '</p>';
    }

    if ($ancho != "") {
        //Ancho
        $stringDetalles .= '<p class="m-0"><b>Ancho: </b>';
        $stringDetalles .= number_format($ancho, 2, ',', '') . 'cm</p>';
    }

    if ($alto != "") {
        //Alto
        $stringDetalles .= '<p class="m-0"><b>Alto: </b>';
        $stringDetalles .= number_format($alto, 2, ',', '') . 'cm</p>';
    }

    if ($forma != "") {
        //Forma
        $stringDetalles .= '<p class="m-0"><b>Forma: </b>';
        $stringDetalles .= $forma . '</p>';
    }

    if ($complemento != "") {
        //Complemento
        $stringDetalles .= '<p class="m-0"><b>Complemento: </b>';
        $stringDetalles .= $complemento . '</p>';
    }

    if ($anchoBase != "") {
        //Ancho cm base de tela
        $stringDetalles .= '<tr>';
        $stringDetalles .= '<p class="m-0"><b>Ancho base de tela: </b>';
        $stringDetalles .= number_format($anchoBase, 2, ',', '') . 'cm</p>';
        $stringDetalles .= '</tr>';
    }

    if ($altoBase != "") {
        //Alto cm base de tela
        $stringDetalles .= '<p class="m-0"><b>Alto base de tela: </b>';
        $stringDetalles .= number_format($altoBase, 2, ',', '') . 'cm</p>';
    }

    if ($color_complemento != "") {
        //Color complemento
        $stringDetalles .= '<p class="m-0"><b>Color base: </b>';
        $stringDetalles .= $color_complemento . '</p>';
    }

    if ($cantidadTopes != "") {
        //Cantidad de topes
        $stringDetalles .= '<p class="m-0"><b>Cantidad de topes: </b>';
        $stringDetalles .= $cantidadTopes . '</p>';
    }

    if ($nota != "") {
        //Comentarios
        $stringDetalles .= '<p class="m-0"><b>Instrucciones detalladas o comentarios adicionales: </b>';
        $stringDetalles .= $nota . '</p>';
    }

    $imagePath = "imagenes_bocetos/D$id.jpg";
    if (file_exists($imagePath)) {
        // Verificar si la imagen existe
        $stringDetalles .= '<p class="m-0 text-center"><b>Boceto</b></p>';
        $stringDetalles .= '<p class="m-0">';
        // La imagen existe, muestra la imagen real
        $stringDetalles .= '<img class="img-fluid" src="' . $imagePath . '" alt="">';
        // $stringDetalles .= '<img class="img-fluid" src="imagenes_bocetos/D' . $id . '.jpg" alt="">';
        $stringDetalles .= '</p>';
    }

    echo $stringDetalles;
}
