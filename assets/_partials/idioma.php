<?php
//Verificar si existe un idioma
//Sino, se hace un llamado inicial con el español
if (isset($_GET['idioma']) && !isset($_SESSION['idioma'])) {
  $_SESSION['idioma'] = $_GET['idioma'];
} else if (isset($_SESSION['idioma'])) {
} else {
  $_SESSION['idioma'] = 'ES';
}

if (!isset($_SESSION['resultadoTraduccionPertex'])) {
  $_SESSION['resultadoTraduccionPertex'] = llamadoInicial($_SESSION['idioma']);
} else if ($_SESSION['idioma'] != "ES") {
  $_SESSION['resultadoTraduccionPertex'] = llamadoInicial($_SESSION['idioma']);
}