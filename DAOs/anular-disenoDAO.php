<?php
require_once('../includes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Variables para cada campo del formulario
    $id_diseno = 0;
    $comentarios = "";

    if (isset($_POST['id_disenoAnular'])) {
        $id_diseno = $_POST['id_disenoAnular'];
    }

    if (isset($_POST['comentarioAnular'])) {
        $comentarios = $_POST['comentarioAnular'];
    }

    $fecha = date("Y-m-d H:i:s", time());
    $estado = "Anulado";
    $descripcion = "ENCARGO ANULADO";

    try {
        // UPDATE EN LA TABLA ENCARGOS
        $sql = "UPDATE encargos SET estado=? WHERE id_diseno=?";
        $sentencia = $conn->prepare($sql);
        $sentencia->bindParam(1, $estado, PDO::PARAM_STR);
        $sentencia->bindParam(2, $id_diseno, PDO::PARAM_INT);
        $sentencia->execute();

        //INSERT EN LA TABLA HISTORIAL
        $sql = "INSERT INTO historial_pertex (usuario, descripcion, anotaciones, fecha, id_diseno) VALUES (?, ?, ?, ?, ?)";
        $sentencia = $conn->prepare($sql);
        $sentencia->bindParam(1, $_SESSION['ID'], PDO::PARAM_INT);
        $sentencia->bindParam(2, $descripcion, PDO::PARAM_STR);
        $sentencia->bindParam(3, $comentarios, PDO::PARAM_STR);
        $sentencia->bindParam(4, $fecha, PDO::PARAM_STR);
        $sentencia->bindParam(5, $id_diseno, PDO::PARAM_INT);
        $sentencia->execute();

        header("location: ../historial-disenos?ok&anulado=" . $id_diseno);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
