<?php require_once('includes/config.php');
include("funciones/functions.php");
include('classes/AES.php');
include("assets/_partials/codigo-idiomas.php");
$user->logout();
header('Location: funciones/cambioIdioma.php?'  .  PHP_AES_Cipher::encrypt("idioma=" . $_SESSION['idioma']));
