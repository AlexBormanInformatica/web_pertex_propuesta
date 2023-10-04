<?php require_once('includes/config.php');
include("functions.php");
$user->logout();
header('Location: cambioIdioma.php?idioma=' . $_SESSION['idioma']);
exit;
