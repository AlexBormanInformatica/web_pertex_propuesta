<?php

// Comprobamos la variable get
if (@$_GET["idioma"]) {
    switch ($_GET["idioma"]) {
            // español
        case 'ES':
            // frances
        case 'FR':
            // italiano
        case 'IT':
            // portugues
        case 'PT':
            $_SESSION["idioma"] = $_GET["idioma"];
            break;
            // si no existe lo ponemos en español
        default:
            $_SESSION["idioma"] = "ES";
            break;
    }
} else if (isset($_SESSION["idioma"])) {
} else {
    // Si el get no existe definimos el español
    $_SESSION["idioma"] = "ES";  
}
?>