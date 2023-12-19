<?php
require_once('../includes/config.php');
require_once "functions.php";
include('../classes/AES.php');

$cadena = "";
if (!empty($_SERVER['QUERY_STRING'])) {
    $cadena = $_SERVER['QUERY_STRING'];

    //Desencripto la URL
    $cadena = PHP_AES_Cipher::decrypt($cadena);

    // Obtengo el string desencriptado del objeto
    $cadena = strval($cadena);

    // Inicializo un array para almacenar los parámetros
    $parametros = array();

    // Utilizo parse_str para analizar la cadena y almacenar los resultados en $parametros
    parse_str($cadena, $parametros);

    $idioma = $parametros['idioma'];
    $enlace_redireccion = $parametros['pag'];

    $_SESSION['resultadoTraduccionPertex'] = llamadoInicial($idioma, $conn);
    $_SESSION['idioma'] = $idioma;

    $sql = "SELECT * FROM traducciones WHERE identificador='paginas' AND texto='" . $enlace_redireccion . "'";
    $query = $conn->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    
    $tipo = "";
    $identificador = "";
    $subidentificador1 = "";
    $subidentificador2 = "";
    foreach ($results as $result) {
        $tipo = $result->tipo;
        $identificador = $result->identificador;
        $subidentificador1 = $result->subidentificador1;
    }

    $sql = "SELECT texto FROM traducciones WHERE idioma='" . $_SESSION['idioma'] . "' AND tipo='" . $tipo . "' AND identificador='" . $identificador . "' AND subidentificador1='" . $subidentificador1 . "'";
    $query = $conn->prepare($sql);
    $query->execute();
    $paginaTraducida = $query->fetchColumn();
    if ($paginaTraducida == "") {
        header('Location: ../index');
    } else {
        header('Location: ../' . $paginaTraducida);
    }
} else {
    header('Location: ../404');
}
