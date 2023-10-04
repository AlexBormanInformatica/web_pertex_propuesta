<?php
require_once('includes/config.php');

$numpersonalizacion = $_POST["numPer"];
$numpedido = $_POST["numPed"];

# definimos la carpeta destino
$carpetaDestino = "imagenes_bocetos/";

# si hay algun archivo que subir
if (isset($_FILES["boceto_D"]) && $_FILES["boceto_D"]["name"]) {
    $path = $_FILES['boceto_D']['name'];

    # si exsite la carpeta o se ha creado
    $origen = $_FILES["boceto_D"]["tmp_name"];
    $destino = $carpetaDestino . $_FILES["boceto_D"]["name"];

    # movemos el archivo
    if (@move_uploaded_file($origen, $destino)) {
        // Renombrar el archivo
        $oldname = "imagenes_bocetos/" . $_FILES["boceto_D"]["name"];
        $newname = "imagenes_bocetos/D" . $numpedido . "-" . $numpersonalizacion . ".jpg";
        rename($oldname, $newname);
    }
}
header('Location: subir-boceto.php?nped=' . $numpedido);
