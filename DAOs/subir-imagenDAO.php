<?php
require_once('includes/config.php');
require_once('classes/AES.php');

$numpersonalizacion = $_POST["numPer"];
$numpedido = $_POST["numPed"];

# definimos la carpeta destino
$carpetaDestino = "imagenes_bocetos/";

# si hay algun archivo que subir
if (isset($_FILES["imagen_cc"]) && $_FILES["imagen_cc"]["name"]) {
    $path = $_FILES['imagen_cc']['name'];

    # si exsite la carpeta o se ha creado
    $origen = $_FILES["imagen_cc"]["tmp_name"];
    $destino = $carpetaDestino . $_FILES["imagen_cc"]["name"];

    # movemos el archivo
    if (@move_uploaded_file($origen, $destino)) {
        // Renombrar el archivo
        $oldname = "imagenes_bocetos/" . $_FILES["imagen_cc"]["name"];
        $newname = "imagenes_bocetos/C" . $numpedido . "-" . $numpersonalizacion . ".jpg";
        rename($oldname, $newname);
    }
}
header('Location: subir-imagen.php?nped=' . $numpedido);
