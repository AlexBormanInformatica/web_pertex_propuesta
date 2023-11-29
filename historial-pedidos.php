<?php
//Declaramos la conexion con el servidor de base de datos
use LDAP\Result;

require_once('includes/config.php');
include("pedidos.php");
include("funciones/functions.php");
include('classes/AES.php');
include("assets/_partials/codigo-idiomas.php");
if (!$user->is_logged_in()) {
    header('Location: login');
    exit();
}

$sql = "SELECT * FROM pertex.pedido_envio
INNER JOIN disenos ON disenos.id_pedido_envio = pedido_envio.id_pedido_envio 
INNER JOIN metodos_pago ON metodos_pago.id_metodo_pago = pedido_envio.id_metodo_pago 
WHERE id_usuario=" . $_SESSION['ID'] . "
GROUP BY pedido_envio.id_pedido_envio ORDER BY fecha DESC";
$query = $conn->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);

?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <title>Mis pedidos | Personalizaciones textiles</title>

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
                                <h2>Mis pedidos</h2>
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
                    <!--BUSCADOR DE PEDIDOS -->
                    <div class="search-container">
                        <form>
                            <input class="pl-20 busqueda" type="text" id="busquedaPedido" placeholder="Buscar número nº pedido...">
                        </form>
                    </div>

                    <!--TABLA DE PEDIDOS    -->
                    <div class="table-responsive-sm table-responsive-md table-responsive-lg">
                        <!-- Controles de paginación -->
                        <div id="paginationControls">
                            <button id="prevPage_pedidos"><i style="font-size: 14px;" class="ti-angle-left" aria-hidden="true"></i> </button>
                            <span id="currentPage_pedidos"></span>
                            <button id="nextPage_pedidos"> <i style="font-size: 14px;" class="ti-angle-right" aria-hidden="true"></i></button>
                        </div>
                        <table class="tablesorter-blackice table-bordered" id="tablaPedidos">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Nº pedido</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Método de pago</th>
                                </tr>
                            </thead>
                            <tbody id="the_table_body">
                                <?php foreach ($results as $result) { ?>
                                    <tr class="fila_hc">
                                        <td><?= $result->id_pedido_envio ?></td>
                                        <td><?= date('d/m/Y H:i', strtotime($result->fecha)) ?></td>
                                        <td><?= $result->nombre ?></td>
                                    </tr>
                                    <!-- Fila de detalles oculta -->
                                    <tr class="no-hover" style="display: none;vertical-align:top">
                                        <td id="" colspan="3">
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <p style="font-size:small;margin:auto;">*Selecciona un pedido para ver los diseños </p> <!--Mensaje sobre la tabla-->
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    include("assets/_partials/footer.php");
    ?>