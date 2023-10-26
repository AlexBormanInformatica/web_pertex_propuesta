<?php
//Declaramos la conexion con el servidor de base de datos
use LDAP\Result;

require_once('includes/config.php');
include("pedidos.php");

include("funciones/functions.php");
if (!$user->is_logged_in()) {
    header('Location: login');
    exit();
}

$sql = "SELECT id_encargo, fecha_encargo, subtotal, estado, nombre, cantidad
FROM encargos 
INNER JOIN productos p ON p.idproductos = encargos.idproductos
INNER JOIN usuarios ON usuarios.id = encargos.id_usuario 
WHERE estado <> 'Anulado' AND usuarios.correo='" . $_SESSION['email'] . "' ORDER BY id_encargo DESC";
$query = $conn->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);

?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <title>Mis diseños | Personalizaciones textiles</title>

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
                                <h2>Mis diseños</h2>
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
                    <!--BUSCADOR DE DISEÑOS-->
                    <div class="text-center">
                        <form>
                            <!-- <label class="fs-20"><?= buscarTexto("WEB", "historial-pedidos", "hp_busca2", "", $_SESSION['idioma']); ?></label> -->
                            <input class="pl-20" type="text" id="q" placeholder="<?= buscarTexto("WEB", "historial-pedidos", "hp_busca", "", $_SESSION['idioma']); ?>">
                        </form>
                    </div>

                    <!--TABLA DE DISEÑOS-->
                    <div class="table-responsive-sm table-responsive-md table-responsive-lg">
                        <p style="font-size:small;margin:auto;">Selecciona un diseño para ver los detalles</p> <!--Mensaje sobre la tabla-->
                        <table class="tablesorter m-b-100" id="tablaEncargos">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Nº diseño</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Cantidad</th>
                                </tr>
                            </thead>
                            <tbody id="the_table_body">
                                <?php foreach ($results as $result) { ?>
                                    <tr class="fila_hc">
                                        <!--[0] Número de diseño-->
                                        <td><?= $result->id_encargo ?></td>

                                        <!--[2] Estado-->
                                        <td><?= $result->estado ?></td>

                                        <!--[3] Fecha-->
                                        <td><?= date('d/m/Y H:i', strtotime($result->fecha_encargo)) ?></td>

                                        <!--[4] Subtotal-->
                                        <td><?= $result->subtotal ?></td>

                                        <!--[5] Producto-->
                                        <td><?= $result->nombre ?></td>

                                        <!--[6] Cantidad-->
                                        <td><?= $result->cantidad ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    include("assets/_partials/footer.php");
    ?>