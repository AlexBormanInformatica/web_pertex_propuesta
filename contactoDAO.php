<?php
require_once('includes/config.php');
if ($_POST['ko'] == "") {
    //Datos del formulario contacto
    $nombrecomercial = $_POST['nombrecomercial'];
    $email = $_POST['email'];
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;
    $conocido = $_POST['conocido'];
    $actividades = json_decode($_POST['actividades']);
    $mensaje = $_POST['mensaje'];
    $fecha = date("Y-m-d H:i:s", time());

    $sql = "INSERT INTO fichaempresametas (nombreComercial, email, telefono) VALUES (?,?,?)";
    $sentencia = $conn_formularios->prepare($sql);
    $sentencia->bindParam(1, $nombrecomercial, PDO::PARAM_STR);
    $sentencia->bindParam(2, $email, PDO::PARAM_STR);
    $sentencia->bindParam(3, $telefono, PDO::PARAM_STR);
    $sentencia->execute();

    $idfichanueva = $conn_formularios->lastInsertId(); //https://www.php.net/manual/es/pdo.lastinsertid.php

    //insert en marcas_has_fichaempresametas
    $sql = "INSERT INTO marcas_has_fichaempresametas (marcas_idMarca, marcas_idEmpresa, fichaempresametas_idfichaempresa, isMetaAutorizado) VALUES (13,2,?,1)";
    $sentencia = $conn_formularios->prepare($sql);
    $sentencia->bindParam(1, $idfichanueva, PDO::PARAM_INT);
    $sentencia->execute();

    //insert en mediodepesca_comonosconocio_has_fichaempresametas
    $sql = "INSERT INTO mediodepesca_comonosconocio_has_fichaempresametas (mediodepesca_comonosconocio_id, fichaempresametas_idfichaempresa, fecha) VALUES (?,?,?)";
    $sentencia = $conn_formularios->prepare($sql);
    $sentencia->bindParam(1, $conocido, PDO::PARAM_INT);
    $sentencia->bindParam(2, $idfichanueva, PDO::PARAM_INT);
    $sentencia->bindParam(3, $fecha, PDO::PARAM_STR);
    $sentencia->execute();

    //insert en actividad_has_fichaempresametas
    $i = 0;
    foreach ($actividades as $actividad) {
        $sql = "INSERT INTO actividad_has_fichaempresametas (actividad_idActividad, fichaempresametas_idfichaempresa) VALUES (?,?)";
        $sentencia = $conn_formularios->prepare($sql);
        $sentencia->bindParam(1, $actividad, PDO::PARAM_INT);
        $sentencia->bindParam(2, $idfichanueva, PDO::PARAM_INT);
        $sentencia->execute();
        $i++;
    }

    //insert en mensajesmeta
    $sql = "INSERT INTO mensajesmetas (mensaje, fichaempresametas_idfichaempresa, fecha) VALUES (?,?,?)";
    $sentencia = $conn_formularios->prepare($sql);
    $sentencia->bindParam(1, $mensaje, PDO::PARAM_STR);
    $sentencia->bindParam(2, $idfichanueva, PDO::PARAM_INT);
    $sentencia->bindParam(3, $fecha, PDO::PARAM_STR);
    $sentencia->execute();
}
