<?php

try {
} catch (PDOException $e) {
  print "¡Error!: " . $e->getMessage() . "<br/>";
  die();
}
?>


<?php
ob_start();
/*
_DISABLED = 0
_NONE = 1
_ACTIVE = 2
*/
if (session_status() == 1) {
  session_start();
}



//set timezone
date_default_timezone_set('Europe/Madrid');

$servername = "192.168.10.20";
// $servername = "localhost";
$username = "usuario";
$password = "Passw0rd$01";

try {
  //CONEXION PERSONALIZACIONES TEXTILES (ECOMMERCE)
  $conn = new PDO("mysql:host=$servername;dbname=ecommerce", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // set the PDO error mode to exception

  //CONEXION PRG_BORMAN
  $conn_prgborman = new PDO("mysql:host=$servername;dbname=prg_borman", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
  $conn_prgborman->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // set the PDO error mode to exception

  //CONEXION FORMULARIOS
  $conn_formularios = new PDO("mysql:host=$servername;dbname=formularios", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
  $conn_formularios->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // set the PDO error mode to exception
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
//include the user class, pass in the database connection
require_once('classes/user.php');
$user = new User($conn_formularios);
?>