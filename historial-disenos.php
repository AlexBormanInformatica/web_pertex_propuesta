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
                            <input class="pl-20 busqueda" type="text" id="busquedaEncargo" placeholder="Buscar número nº diseño...">
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
                        <p style="font-size:small;margin:auto;"><button data-toggle="modal" data-target="#infoAcciones" class="pregunta-formulario">
                                <span>➔ Información sobre las acciones</span>
                            </button>
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
                        <table class="tablesorter-blackice table-bordered">
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
                                            <?php
                                            if ($result->estado == "Boceto disponible") {
                                            ?>
                                                <button data-toggle="modal" data-target="#verBoceto" class="mr-10 ver-boceto-encargo zoom" data-encargo-id="<?= $result->id_diseno ?>"><i style="font-size:20px" class="ti-eye" aria-hidden="true"></i></button>
                                                <form method="POST" action="aceptar-propiedad-intelectual" style="display: contents;">
                                                    <input hidden name="id_diseno" value="<?= $result->id_diseno ?>">
                                                    <input hidden name="cantidad_diseno" value="<?= $result->cantidad ?>">
                                                    <button class="mr-10 btn-check zoom" style="<?= $escliente == 0 ? "cursor:not-allowed" : "" ?>" <?= $escliente == 0 ? "disabled" : "" ?>><i style="font-size:20px" class="ti-check" aria-hidden="true"></i></button>
                                                </form>
                                                <button data-toggle="modal" data-target="#modificarBoceto" class="mr-10 zoom" data-encargo-id="<?= $result->id_diseno ?>"><i style="font-size:20px" class="ti-pencil" aria-hidden="true"></i></button>
                                            <?php
                                            }
                                            if (
                                                $result->estado == "Boceto pendiente" || $result->estado == "Preparando boceto"
                                                || $result->estado == "Boceto disponible" || $result->estado == "Boceto aceptado"
                                                || $result->estado == "Boceto modificado" || $result->estado == "Boceto no posible"
                                            ) {
                                            ?>
                                                <button data-toggle="modal" data-target="#anularEncargo" class="ml-10 mr-10 anular-encargo zoom" data-encargo-id="<?= $result->id_diseno ?>"><i style="font-size:20px" class="ti-na" aria-hidden="true"></i></button>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <!-- Fila de detalles oculta -->
                                    <tr class="no-hover" style="display: none;vertical-align:top">
                                        <td id="celdaDetalles<?= $result->id_diseno ?>" colspan="3">
                                        </td>
                                        <td id="mensajesEquipoPertex<?= $result->id_diseno ?>" colspan="4" style="background-color: #f0f0f0 ">
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


    <!--MODAL VER BOCETO-->
    <div class="modal fade" id="verBoceto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1000px;">
            <div class="modal-content modal-ver-boceto">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="bocetoImage" src="" alt="Boceto">
                </div>
            </div>
        </div>
    </div>

    <!--MODAL MODIFICAR BOCETO-->
    <div class="modal fade" id="modificarBoceto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1000px;">
            <div class="modal-content modal-aviso">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="text-center p-all-10">
                    <h3>¿Deseas modificar el boceto?</h3>
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

    <!--MODAL INFORMACION SOBRE LAS ACCIONES-->
    <div class="modal fade" id="infoAcciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1000px;">
            <div class="modal-content modal-aviso">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="text-center p-all-10">
                    <h3>Información sobre las acciones</h3>
                </div>

                <div class="modal-body row">
                    <div class="col-6">
                        <h4 class="text-center"><i style="font-size:30px" class="ti-eye" aria-hidden="true"></i> <b>Icono ver boceto</b></h4>
                        <ul class="mb-5">
                            <li>Estado: Boceto disponible</li>
                            <li>Acción: Muestra el boceto del diseño</li>
                        </ul>

                        <h4 class="text-center"><i style="font-size:30px" class="ti-check" aria-hidden="true"></i> <b>Icono aceptar boceto</b></h4>
                        <ul class="mb-5">
                            <li>Estado: Boceto disponible</li>
                            <li>Acción: Redireccionar a un formulario para confirmar que acepta la propiedad intelectual del boceto</li>
                        </ul>
                    </div>

                    <div class="col-6">
                        <h4 class="text-center"><i style="font-size:30px" class="ti-pencil" aria-hidden="true"></i> <b>Icono modificar boceto</b></h4>
                        <ul class="mb-5">
                            <li>Estado: Boceto disponible</li>
                            <li>Acción: Solicitar los cambios del boceto</li>
                        </ul>

                        <h4 class="text-center"><i style="font-size:30px" class="ti-na" aria-hidden="true"></i> <b>Icono anular encargo</b></h4>
                        <ul class="mb-5">
                            <li>Estados: Boceto pendiente, preparando boceto, boceto disponible, boceto aceptado.</li>
                            <li>Acción: Indicar los motivos de anulación del encargo</li>
                        </ul>
                    </div>
                    <br>
                    <p class="mb-3">Si tienes alguna pregunta, no dudes en contactar con nuestro servicio de atención al cliente.</p>
                    <a href="infografia" target="_blank" class="btn"> Información sobre el proceso y los estados</span> </a>
                </div>
            </div>
        </div>
    </div>

    <?php
    include("assets/_partials/footer.php");
    ?>