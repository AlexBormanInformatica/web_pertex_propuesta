<?php
require_once('includes/config.php');
include("funciones/functions.php");
include('classes/AES.php');
include("assets/_partials/codigo-idiomas.php");
if (!$user->is_logged_in()) {
    header('Location: login');
    exit();
}

$sql = "SELECT id_diseno, fecha_encargo, subtotal, nombre, cantidad
FROM disenos 
INNER JOIN productos p ON p.id_producto = disenos.id_producto
INNER JOIN usuarios ON usuarios.id = disenos.id_usuario 
WHERE estado = 'Boceto aceptado' AND id_usuario=" . $_SESSION['ID'] . " ORDER BY fecha_encargo DESC";
$query = $conn->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);

?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <title>Carrito | Personalizaciones textiles</title>

    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta property="og:locale" content="es_ES">
    <meta property="og:site_name" content="personalizacionestextiles" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://personalizacionestextiles.com/images/logo.png" />
    <?php
    include("assets/_partials/header.php");
    ?>

    <main>
        <div class="slider-area m-b-20">
            <div class="single-slider  d-flex align-items-center">
                <div class=" container">
                    <div class="row">
                        <div class="col-xl-12 banner-alex">
                            <div class=" p-tb-30 text-center">
                                <h2>Carrito</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <?php
                include("assets/_partials/menu-cuenta.php");
                ?>

                <div class="col-lg-9 col-md-9">
                    <h3>Diseños disponibles para pagar</h3>

                    <!--TABLA DE DISEÑOS-->
                    <div class="table-responsive-sm table-responsive-md table-responsive-lg">
                        <table class="table table-striped table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th style="text-align:center;" scope="col"><input type="checkbox" id="seleccionar-todos"></th>
                                    <th scope="col">Nº diseño</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($results as $result) { ?>
                                    <tr class="">
                                        <td style="text-align:center;"><input type="checkbox" class="seleccionar-fila"></td>
                                        <td><?= $result->id_diseno ?></td>
                                        <td><?= date('d/m/Y H:i', strtotime($result->fecha_encargo)) ?></td>
                                        <td><?= $result->nombre ?></td>
                                        <td>€<?= number_format($result->subtotal, 2, ',', '') ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <!-- SUMA SUBTOTAL -->
                            <tfoot>
                                <tr>
                                    <th colspan="4" style="text-align: right;">SUMA SUBTOTAL</th>
                                    <th><span style="font-weight: bold;" id="sumaSubtotal"></span></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <form action="checkout" method="post" id="formularioPago">
                        <input type="hidden" name="disenos" id="disenosInput">
                        <input type="hidden" name="subtotal" id="subtotalInput">
                        <button class="btn" style="width: -webkit-fill-available;" id="btnPagar" disabled>Pagar</button>
                    </form>
                    <p style="font-size:small;margin:auto;"><a href="infografia" target="_blank" class="pregunta-formulario">
                            <span>➔ Información sobre el proceso y los estados</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>

    </main>
    <?php
    include("assets/_partials/footer.php");
    ?>