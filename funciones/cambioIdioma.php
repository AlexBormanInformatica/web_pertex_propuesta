<?php
require_once('../includes/config.php');
include("functions.php");

$_SESSION['resultadoTraduccionPertex'] = llamadoInicial($_GET['idioma']);
$_SESSION['resultadoTraduccionFormularios'] = llamadoInicialFormularios($_GET["idioma"]);
$_SESSION['idioma'] = $_GET['idioma'];

$pagina = "";

if (
    $_GET["name"] == "Proyecto-personalizar" ||
    $_GET["name"] == "index" ||
    $_GET["name"] == "" ||
    !isset($_GET["name"])
) {
    $pagina = "../";
    $paginaTraducida = $pagina;
} else {
    $pagina = $_GET['name'];

    $sql = "SELECT * FROM traducciones WHERE identificador='paginas' AND texto='" . $pagina . "'";
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
}

if ($_GET["name"] == "login") {
    $paginaTraducida = "login";
}

header('Location: ' . $paginaTraducida);
