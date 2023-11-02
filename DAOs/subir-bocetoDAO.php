<?php
require_once('../includes/config.php');

# definimos la carpeta destino
$carpetaDestino = "../imagenes_bocetos/";

# si hay algun archivo que subir
if (isset($_FILES["archivo"]) && $_FILES["archivo"]["name"]) {
    $archivo =  $_FILES['archivo'];
    // Verificamos si no hay errores en la subida
    if ($archivo['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo  = $archivo['name'];
        $rutaDestino = $carpetaDestino . $nombreArchivo;
        $origen = $archivo["tmp_name"];

        # movemos el archivo
        if (@move_uploaded_file($origen, $rutaDestino)) {
            // Renombrar el archivo
            $oldname = "../imagenes_bocetos/" . $_FILES["archivo"]["name"];
            $newname = "../imagenes_bocetos/" . $_FILES["archivo"]["name"] . ".jpg";
            rename($oldname, $newname);
            echo "Imagen subida correctamente.";
        } else {
            echo "Error al mover el archivo.";
        }
    } else {
        echo "Error en la subida del archivo.";
    }
} else {
    echo "No se ha seleccionado ningún archivo para subir.";
}
