<?php
require_once('../includes/config.php');

use PHPMailer\PHPMailer\PHPMailer;

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

        // ENVIO CORREO
        //Se envía un correo al cliente por encargar un diseño explicandole qué sigue

        require_once '../vendor/autoload.php';
        $mail = new PHPMailer();

        $mail->CharSet = "UTF-8";
        $mail->SetFrom('alexandra.serrano.chacon@gmail.com', "Alexandra");
        $mail->IsHTML(true);
        $mail->SMTPDebug = 2;

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'alexandra.serrano.chacon@gmail.com';
        $mail->Password = 'wnye mdqz eaid ztme';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->addAddress("alexandra.serrano.chacon@gmail.com", '');
        $mail->Subject = "¡Gracias por tu encargo! 🎉";
        $mail->Body = "<!DOCTYPE html>
            <html lang='en' xmlns='http://www.w3.org/1999/xhtml' xmlns:o='urn:schemas-microsoft-com:office:office'>
            
            <head>
                <meta charset='utf-8'>
                <meta name='viewport' content='width=device-width,initial-scale=1'>
                <meta name='x-apple-disable-message-reformatting'>
                <title></title>
                <!--[if mso]>
                        <noscript>
                            <xml>
                                <o:OfficeDocumentSettings>
                                    <o:PixelsPerInch>96</o:PixelsPerInch>
                                </o:OfficeDocumentSettings>
                            </xml>
                        </noscript>
                        <![endif]-->
                <style>
                    table,
                    td,
                    div,
                    h1,
                    p {
                        font-family: Arial, sans-serif;
                    }
                </style>
            </head>
            
            <body style='margin:0;padding:0;text-align: justify;'>
                <table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;'>
                    <tr>
                        <td align='center' style='padding:0;'>
                            <img src='https://personalizacionestextiles.com/assets/img/logo/logo.png' alt='' width='150' style='height:auto;display:block;padding:30px;' />
                            <table role='presentation' style='width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;'>
                                <tr>
                                    <td align='center' style='padding:40px 0 30px 0;background:#00953e'>
                                        <h1 style='font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;color:#FFF;'>Personalizaciones textiles</h1>
                                    </td>
                                </tr>
                                <tr>
                                    <td style='padding:36px 30px 42px 30px;'>
                                        <table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;'>
                                            <tr>
                                                <td style='padding:0 0 36px 0;color:#191D34;'>
                                                    <h1 style='font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;'>Encargo del diseño Nº" . $id_diseno_nuevo . "</h1>
                                                    <p style='margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'>Gracias por elegirnos para realizar vuestro diseño.</p>
                                                    <p style='margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'>El diseño está ahora en estado \"Boceto pendiente\". Esto significa que nuestro equipo de Personalizaciones Textiles está trabajando en él.</p>
                                                    <p style='margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'>En breve, recibirás un correo electrónico con los siguientes pasos del proceso. También puedes ver la lista de tus diseños en la sección <a href='http://localhost/web_pertex_propuesta/historial-disenos' style='color:#00953e;'>Mis diseños</a> de tu cuenta.</p>
                                                    <p style='margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'>¿Tienes alguna pregunta? No dudes en contactarnos.</p>
                                                    <a href='https://personalizacionestextiles.com/' style='color:#00953e;'>personalizacionestextiles.com</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style='padding:30px;background:#191D34;'>
                                        <table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;'>
                                            <tr>
                                                <td style='padding:0;' align='center'>
                                                    <h2 style='font-size:18px;margin:0 0 20px 0;font-family:Arial,sans-serif;color:#ffffff;'>¿Cómo es el proceso?</h2>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style='padding:0;' align='center'>
                                                    <p style='margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'><a href='https://personalizacionestextiles.com/infografia' style='background-color:#00953E;padding:10px 30px 10px 30px;border-radius:20px;color:#fff;text-decoration: none;'>Ver</a></p>
                                                </td>
            
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style='padding:30px;background:#eeee;'>
                                        <table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;'>
                                            <tr>
                                                <td style='padding:0;width:50%;' align='center'>
                                                    <p style='margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#000;'>
                                                        &reg; Personalizaciones textiles 2022<br /><a href='https://personalizacionestextiles.com/aviso-legal' style='color:#000;text-decoration:underline;'>Aviso legal</a> | <a href='https://personalizacionestextiles.com/politica-privacidad' style='color:#000;text-decoration:underline;'>Política de privacidad</a>
                                                    </p>
            
                                                </td>
            
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </body>
            
            </html>";

        if ($mail->send()) {
        } else {
        }

        header("location: ../gracias-por-tu-encargo");
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
