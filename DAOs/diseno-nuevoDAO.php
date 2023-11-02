<?php
require_once('../includes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Variables para cada campo del formulario
    $tecnica = $cantidad = $ancho = $alto = $comentarios = "";
    $colores = [];
    $imagen = $colorPiel = $colorMetal =  $forma = $complemento = $cantidadTopes =
        $colorBase = $anchoBase = $altoBase = $nullValue = null;
    $subtotal = $moldes = 0;

    //Obtengo los campos ocultos
    //<input> moldes
    if (isset($_POST['precioMoldes'])) {
        $moldes = $_POST['precioMoldes']; // Precio de los moldes, si se tuvieran que quitar, lo uso para restar al subtotal
    }

    //<input> subtotal
    if (isset($_POST['precioSubtotal'])) {
        $subtotal = $_POST['precioSubtotal'];
    }
    // Obtengo todos los campos del formulario
    /*PASO 1*/
    //<select> tecnica 
    if (isset($_POST['tecnica']) && $_POST['tecnica'] != "") {
        $tecnica = $_POST['tecnica']; // Id del producto / técnica
    }

    //<input> cantidad
    if (isset($_POST['cantidad']) && $_POST['cantidad'] != "") {
        $cantidad = $_POST['cantidad']; // Cantidad de producto
    }

    //<input type="checkbox"> colores_limitados 
    if (isset($_POST["colores"])) {
        $colores = $_POST['colores']; // Array de colores
    }

    //<input type="checkbox"> color piel 
    if (isset($_POST['colorpiel'])) {
        $colorPiel = $_POST['colorpiel'];
    }

    //<input type="checkbox"> color metal 
    if (isset($_POST['colormetal'])) {
        $colorMetal = $_POST['colormetal'];
    }

    /*PASO 2*/
    //<input> ancho producto 
    if (isset($_POST['anchoProductoInput']) && $_POST['anchoProductoInput'] != "0.000" && $_POST['anchoProductoInput'] != "") {
        $ancho = number_format($_POST['anchoProductoInput'] / 10, 2);
    } else if (isset($_POST['anchoProductoSelect']) && $_POST['anchoProductoSelect'] != "") {
        //<select> ancho producto 
        $ancho = number_format($_POST['anchoProductoSelect'] / 10, 2);
    }

    //<input> alto producto 
    if (isset($_POST['altoProducto']) && $_POST['altoProducto'] != "0.000"   && $_POST['altoProducto'] != "") {
        $alto = number_format($_POST['altoProducto'] / 10, 2);
    }

    //<input type="checkbox"> formas
    if (isset($_POST['formas'])  && $_POST['formas'] != "") {
        $forma = $_POST['formas']; //Id de la forma elegida
    }

    /*PASO 3*/
    //<input type="checkbox"> base
    if (isset($_POST['base']) && $_POST['base'] != "sinbase") {
        $complemento = $_POST['base'];
    }

    //<input> ancho base tela
    if (isset($_POST['anchoBaseInput']) && $_POST['anchoBaseInput'] != "0.000" && $_POST['anchoBaseInput'] != "") {
        $anchoBase = number_format($_POST['anchoBaseInput'] / 10, 2);
    }

    //<input> alto base tela
    if (isset($_POST['altoBaseInput']) && $_POST['altoBaseInput'] != "0.000" && $_POST['altoBaseInput'] != "") {
        $altoBase = number_format($_POST['altoBaseInput'] / 10, 2);
    }

    //<input type="checkbox"> color base
    if (isset($_POST['colorbase'])) {
        $colorBase = $_POST['colorbase'];
    }

    //<input type="checkbox"> tope
    if (isset($_POST['tope']) && $_POST['tope'] == "1") {
        $complemento = 4;
        $cantidadTopes = $_POST['cantidadTopes'];
    }

    /*PASO 4*/
    // Definimos la carpeta destino
    // Guardamos la imagen luego de guardar el diseño en la BBDD
    $carpetaDestino = "../imagenes_bocetos/";

    //<input> comentarios / notas
    if (isset($_POST['comentariosDiseno']) && $_POST['comentariosDiseno'] != "") {
        $comentarios = $_POST['comentariosDiseno'];
    }

    $fecha = date("Y-m-d H:i:s", time());
    $estado = "Boceto pendiente";
    $strVacio = "";
    $cero = 0;
    /*//Por defecto desde la web siempre será 0
    El tipo puede ser:
    0 : El pedido es nuevo
    1 : El pedido es repetido, pero no está registrado en el sistema
    2 : El pedido es repetido desde el sistema
    */

    // INSERT EN LA TABLA DISENOS
    try {
        $sql = "INSERT INTO disenos (tipo, fecha_encargo, precio_moldes, subtotal, id_usuario, estado, nota, nombre_diseno, 
        id_producto, ancho_cm, alto_cm, cantidad, id_forma, id_complemento, id_color_complemento, id_color_metal, id_color_piel, 
        ancho_cm_base, alto_cm_base, cantidad_topes, num_referencia, num_fabricacion, id_pedido_envio) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $sentencia = $conn->prepare($sql);
        $sentencia->bindParam(1, $cero, PDO::PARAM_INT);
        $sentencia->bindParam(2, $fecha, PDO::PARAM_STR);
        $sentencia->bindParam(3, $moldes, PDO::PARAM_STR);
        $sentencia->bindParam(4, $subtotal, PDO::PARAM_STR);
        $sentencia->bindParam(5, $_SESSION['ID'], PDO::PARAM_INT);
        $sentencia->bindParam(6, $estado, PDO::PARAM_STR);
        $sentencia->bindParam(7, $comentarios, PDO::PARAM_STR);
        $sentencia->bindParam(8, $strVacio, PDO::PARAM_STR);
        $sentencia->bindParam(9, $tecnica, PDO::PARAM_INT);
        $sentencia->bindParam(10, $ancho, PDO::PARAM_STR);
        $sentencia->bindParam(11, $alto, PDO::PARAM_STR);
        $sentencia->bindParam(12, $cantidad, PDO::PARAM_INT);
        $sentencia->bindParam(13, $forma, PDO::PARAM_INT);
        $sentencia->bindParam(14, $complemento, PDO::PARAM_INT);
        $sentencia->bindParam(15, $colorBase, PDO::PARAM_INT);
        $sentencia->bindParam(16, $colorMetal, PDO::PARAM_INT);
        $sentencia->bindParam(17, $colorPiel, PDO::PARAM_INT);
        $sentencia->bindParam(18, $anchoBase, PDO::PARAM_STR);
        $sentencia->bindParam(19, $altoBase, PDO::PARAM_STR);
        $sentencia->bindParam(20, $cantidadTopes, PDO::PARAM_INT);
        $sentencia->bindParam(21, $strVacio, PDO::PARAM_STR);
        $sentencia->bindParam(22, $strVacio, PDO::PARAM_STR);
        $sentencia->bindParam(23, $nullValue, PDO::PARAM_NULL);
        $sentencia->execute();

        // echo "FECHA ". $fecha ."<br>";
        // echo "MOLDE ". $moldes ."<br>";
        // echo "SUBTOTAL ". $subtotal ."<br>";
        // echo "ID ". $_SESSION['ID'] ."<br>";
        // echo "ESTADO ". $estado ."<br>";
        // echo "COMENTARIO ". $comentarios ."<br>";
        // echo "TECNICA ". $tecnica ."<br>";
        // echo "ANCHO ". $ancho ."<br>";
        // echo "ALTO ". $alto ."<br>";
        // echo "CANTIDAD ". $cantidad ."<br>";
        // echo "FORMA ". $forma ."<br>";
        // echo "COMPLEMENTO ". $complemento ."<br>";
        // echo "COLOR BASE ". $colorBase ."<br>";
        // echo "COLOR METAL ". $colorMetal ."<br>";
        // echo "COLOR PIEL ". $colorPiel ."<br>";
        // echo "ANCHO BASE ". $anchoBase ."<br>";
        // echo "ALTO BASE ". $altoBase ."<br>";
        // echo "CANTIDAD TOPES ". $cantidadTopes ."<br>";

        //Id del encargo agregado
        $id_diseno_nuevo = $conn->lastInsertId();
        $_SESSION['id_ultimo_diseno'] = $id_diseno_nuevo;

        //Ahora guardo la imagen
        // Si hay algun archivo que subir
        if (isset($_FILES["archivo"]) && $_FILES["archivo"]["name"]) {
            $path = $_FILES['archivo']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            // Si exsite la carpeta o se ha creado
            if (file_exists($carpetaDestino) || @mkdir($carpetaDestino)) {
                $origen = $_FILES["archivo"]["tmp_name"];
                $destino = $carpetaDestino . $_FILES["archivo"]["name"];

                // movemos el archivo
                if (@move_uploaded_file($origen, $destino)) {
                    // Renombrar el archivo con el id del diseño y una C de prefijo que nos indica que es del Cliente
                    $oldname = "../imagenes_bocetos/" . $_FILES["archivo"]["name"];
                    $newname = "../imagenes_bocetos/C" . $id_diseno_nuevo . "." . $ext;
                    rename($oldname, $newname);
                }
            }
        }

        // INSERT EN LA TABLA HISTORIAL
        $descripcion = "DISEÑO ENCARGADO";
        $anotaciones = "";
        $sql = "INSERT INTO historial_pertex (usuario, descripcion, anotaciones, fecha, id_diseno) 
        VALUES (?,?,?,?,?)";

        $sentencia = $conn->prepare($sql);
        $sentencia->bindParam(1, $_SESSION['ID'], PDO::PARAM_INT);
        $sentencia->bindParam(2, $descripcion, PDO::PARAM_STR);
        $sentencia->bindParam(3, $anotaciones, PDO::PARAM_STR);
        $sentencia->bindParam(4, $fecha, PDO::PARAM_STR);
        $sentencia->bindParam(5, $id_diseno_nuevo, PDO::PARAM_INT);
        $sentencia->execute();

        header("location: ../gracias-por-tu-encargo");
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
