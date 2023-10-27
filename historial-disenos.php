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
WHERE estado <> 'Anulado' AND id_usuario=" . $_SESSION['ID'] . " ORDER BY fecha_encargo DESC";
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
                    <div class="search-container">
                        <form>
                            <input class="pl-20" type="text" id="busquedaEncargo" placeholder="Buscar número nº diseño...">
                        </form>
                        <!--FILTRO POR PRODUCTO-->
                        <select id="filtroProducto">
                            <option value="">Todos los productos</option>
                        </select>
                    </div>

                    <!--TABLA DE DISEÑOS-->
                    <div class="table-responsive-sm table-responsive-md table-responsive-lg">
                        <!-- Controles de paginación -->
                        <div id="paginationControls">
                            <button id="prevPage"><i style="font-size: 14px;" class="ti-angle-left" aria-hidden="true"></i> </button>
                            <span id="currentPage"></span>
                            <button id="nextPage"> <i style="font-size: 14px;" class="ti-angle-right" aria-hidden="true"></i></button>
                        </div>

                        <p style="font-size:small;margin:auto;"><a href="infografia" target="_blank" class="pregunta-formulario">
                                <span>➔ Información sobre el proceso y los estados</span>
                            </a>
                        </p>
                        <p style="font-size:small;margin:auto;"><a href="#" target="_blank" class="pregunta-formulario">
                                <span>➔ Información sobre las acciones</span>
                            </a>
                        </p>
                        <table class="tablesorter-blackice" id="tablaEncargos">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Nº diseño</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="the_table_body">
                                <?php foreach ($results as $result) { ?>
                                    <tr class="fila_hc">
                                        <td><?= $result->id_encargo ?></td>
                                        <td><?= $result->estado ?></td>
                                        <td><?= date('d/m/Y H:i', strtotime($result->fecha_encargo)) ?></td>
                                        <td>€<?= number_format($result->subtotal, 2, ',', '') ?></td>
                                        <td><?= $result->nombre ?></td>
                                        <td><?= $result->cantidad ?></td>
                                        <td>
                                            <button class="mr-10 anular-encargo zoom" data-encargo-id="<?= $result->id_encargo ?>"><i style="color:black" class="ti-na" aria-hidden="true"></i></button>
                                            <button class="mr-10 modificar-boceto-encargo zoom" data-encargo-id="<?= $result->id_encargo ?>"><i style="color:black" class="ti-ruler-pencil" aria-hidden="true"></i></button>
                                            <button class="aceptar-boceto-encargo zoom" data-encargo-id="<?= $result->id_encargo ?>"><i style="color:black" class="ti-check" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                    <!-- Fila de detalles oculta -->
                                    <tr class="no-hover" style="display: none;vertical-align:top">
                                        <td id="celdaDetalles<?= $result->id_encargo ?>" colspan="3">
                                        </td>
                                        <td id="" style="background-color:#F0F0F0" colspan="4">
                                            <h4 class="text-center m-0">Mensajes del equipo PERTEX:</h4>
                                            <p style="font-size:small"><b>27/10/2023</b> Se agrega 1cm más porque necesita un borde. No cambia el presupuesto.</p>
                                            <p style="font-size:small"><b>27/10/2023</b> Se agrega 1cm más porque necesita un borde. No cambia el presupuesto.</p>
                                            <p style="font-size:small"><b>27/10/2023</b> Se agrega 1cm más porque necesita un borde. No cambia el presupuesto.</p>
                                            <p style="font-size:small"><b>27/10/2023</b> Se agrega 1cm más porque necesita un borde. No cambia el presupuesto.</p>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <p style="font-size:small;margin:auto;">*Selecciona un diseño para ver los detalles</p> <!--Mensaje sobre la tabla-->
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    include("assets/_partials/footer.php");
    ?>