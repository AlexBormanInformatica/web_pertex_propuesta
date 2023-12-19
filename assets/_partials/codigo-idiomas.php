<?php
$cadena = "";
$idioma = "";
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
  // print_r($parametros);

  $idioma = isset($parametros['idioma']) ? $parametros['idioma'] : "ES";
} else {
  $idioma = "ES";
}

//Verificar si existe un idioma
//Sino, se hace un llamado inicial con el español
if ($idioma != "" && !isset($_SESSION['idioma'])) {
  $_SESSION['idioma'] = $idioma;
} else if (isset($_SESSION['idioma'])) {
} else {
  $_SESSION['idioma'] = 'ES';
}

if (!isset($_SESSION['resultadoTraduccionPertex']) || !isset($_SESSION['resultadoTraduccionPertex'])) {
  $_SESSION['resultadoTraduccionPertex'] = llamadoInicial($_SESSION["idioma"], $conn_formularios);
} else if ($_SESSION['idioma'] != "ES") {
  $_SESSION['resultadoTraduccionPertex'] = llamadoInicial($_SESSION["idioma"], $conn_formularios);
}
