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

$sql = "SELECT id_diseno, fecha_encargo, subtotal, estado, nombre, cantidad
FROM disenos 
INNER JOIN productos p ON p.id_producto = disenos.id_producto
INNER JOIN usuarios ON usuarios.id = disenos.id_usuario 
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
                        <?php if (isset($_GET['ok'])) {
                            //Mensaje de OK cuando actualiza la ficha
                        ?>
                            <div id="divOk" class="fs-18 alert alert-success">
                                <button id="cerrarDiv" style="float: right;"><i class="ti-close" style="color:black;"></i></button>
                                <div><?php
                                        if (isset($_GET['anulado'])) {
                                            echo "Encargo número " . $_GET['anulado'] . " anulado.";
                                        }

                                        ?>
                                </div>
                            </div>
                        <?php } ?>
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
                                        <td><?= $result->id_diseno ?></td>
                                        <td><?= $result->estado ?></td>
                                        <td><?= date('d/m/Y H:i', strtotime($result->fecha_encargo)) ?></td>
                                        <td>€<?= number_format($result->subtotal, 2, ',', '') ?></td>
                                        <td><?= $result->nombre ?></td>
                                        <td><?= $result->cantidad ?></td>
                                        <td>
                                            <button data-toggle="modal" data-target="#" class="mr-10 aceptar-boceto-encargo zoom" data-encargo-id="<?= $result->id_diseno ?>"><i style="font-size:20px" class="ti-check" aria-hidden="true"></i></button>
                                            <button data-toggle="modal" data-target="#modificarEncargo" class="mr-10 modificar-boceto-encargo zoom" data-encargo-id="<?= $result->id_diseno ?>"><i style="font-size:20px" class="ti-pencil" aria-hidden="true"></i></button>
                                            <button data-toggle="modal" data-target="#anularEncargo" class="ml-10 mr-10 anular-encargo zoom" data-encargo-id="<?= $result->id_diseno ?>"><i style="font-size:20px" class="ti-na" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                    <!-- Fila de detalles oculta -->
                                    <tr class="no-hover" style="display: none;vertical-align:top">
                                        <td id="celdaDetalles<?= $result->id_diseno ?>" colspan="3">
                                        </td>
                                        <td id="mensajesEquipoPertex" colspan="4">
                                            <h4 class="text-center m-0">Modificaciones del diseño:</h4>
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

    <!--MODAL ANULAR ENCARGO-->
    <div class="modal fade" id="anularEncargo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1000px;">
            <div class="modal-content modal-aviso">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="text-center p-all-10">
                    <h3>¿Deseas anular el encargo?</h3>
                </div>

                <div class="modal-body">
                    <p class="mb-3" style="color:#EA4A00;font-weight: bold;">Si decides anularlo, no se continuará el proceso y ya no lo verás en tus diseños.</p>
                    <p class="mb-3">Si tienes alguna pregunta, no dudes en contactar con nuestro servicio de atención al cliente.</p>
                    <p class="mb-3">Por favor, indica el motivo por el que deseas anularlo.</p>
                    <form id="formularioAnular" action="DAOs/anular-disenoDAO.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input hidden value="" id="id_disenoAnular" name="id_disenoAnular">
                            <textarea class="form-control mb-2" id="comentarioAnular" name="comentarioAnular" rows=5 cols=50 required></textarea>
                        </div>
                        <button id="submitDelFormularioAnular" class="btn btn-primary">ANULAR DISEÑO</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!--MODAL MODIFICAR ENCARGO-->
    <div class="modal fade" id="modificarEncargo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1000px;">
            <div class="modal-content modal-aviso">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="text-center p-all-10">
                    <h3>¿Deseas modificar el encargo?</h3>
                </div>

                <div class="modal-body">
                    <p class="mb-3">Ten en cuenta las modificaciones que se pueden realizar sobre un diseño:</p>
                    <ul class="mb-3">
                        <li>Cambio de colores</li>
                        <li>Cambio de medidas (puede afectar el presupuesto)</li>
                        <li>Cambio de forma (puede afectar el presupuesto)</li>
                    </ul>
                    <p class="mb-3">Si tienes alguna pregunta, no dudes en contactar con nuestro servicio de atención al cliente.</p>
                    <p class="mb-3">Por favor, indica los cambios en tu diseño.</p>
                    <form id="formularioModificar" action="DAOs/modificar-disenoDAO.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input hidden value="" id="id_disenoModificar" name="id_disenoModificar">
                            <textarea class="form-control mb-2" id="comentarioModificar" name="comentarioModificar" rows=5 cols=50 required></textarea>
                        </div>
                        <button id="submitDelFormularioModificar" class="btn btn-primary">MODIFICAR DISEÑO</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!--MODAL ACEPTAR ENCARGO-->
    <div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1000px;">
            <div class="modal-content modal-aviso">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="text-center p-all-10">
                    <h3>¡Casi listo!</h3>
                </div>

                <div class="modal-body">
                    <p class="mb-3">Por favor, revisa tus datos de diseño y asegúrate de que todo esté correcto antes de enviar.</p>
                    <p>Tu diseño será entregado a nuestros diseñadores, y recibirás información sobre el proceso en tu correo electrónico.</p>

                    <button id="submitDelFormularioEncargo" class="btn btn-primary">ENCARGAR DISEÑO</button>
                </div>
            </div>
        </div>
    </div>
    <?php
    include("assets/_partials/footer.php");
    ?>