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
?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <title><?= buscarTexto("WEB", "mi-cuenta", "cuenta_li-3", "", $_SESSION['idioma']); ?> | Personalizaciones textiles</title>

    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta property="og:locale" content="es_ES">
    <meta property="og:site_name" content="personalizacionestextiles" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://personalizacionestextiles.com/images/logo.png" />
    <?php
    include("assets/_partials/header.php");
    ?>
    <main>
        <?php
        include("funciones/errores.php");
        $rep = false;
        ?>
        <div class="slider-area m-b-20">
            <div class="single-slider  d-flex align-items-center">
                <div class=" container text-center">
                    <div class="row ">
                        <div class="col-xl-12">
                            <div class=" p-tb-30 text-center">
                                <h2><?= buscarTexto("WEB", "mi-cuenta", "cuenta_tit_principal", "", $_SESSION['idioma']); ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="p-b-50 p-t-20">
                <div class="row">

                    <div class="col-lg-3 col-md-3  p-l-30 mb-3"> <img alt="<?= buscarTexto("WEB", "mi-cuenta", "alt-mi-cuenta", "", $_SESSION['idioma']); ?>" src="iconos/Mi_cuenta_2.png"><span class="m-l-10"><a class="text-black" href="<?= buscarTexto("WEB", "paginas", "cuenta", "", $_SESSION['idioma']); ?>"><?= buscarTexto("WEB", "mi-cuenta", "cuenta_li-1", "", $_SESSION['idioma']); ?></a></span></div>
                    <div class="col-lg-3 col-md-3  p-l-30 mb-3"><img alt="<?= buscarTexto("WEB", "mi-cuenta", "alt-historial", "", $_SESSION['idioma']); ?>" src="iconos/Historial_pedidos_2.png"><span class="m-l-10"><a class="text-black" href="<?= buscarTexto("WEB", "paginas", "historial-pedidos", "", $_SESSION['idioma']); ?>"><?= buscarTexto("WEB", "mi-cuenta", "cuenta_li-3", "", $_SESSION['idioma']); ?></a></span></div>
                    <div class="col-lg-3 col-md-3  p-l-30 mb-3"><img alt="<?= buscarTexto("WEB", "mi-cuenta", "alt-cerrar-sesion", "", $_SESSION['idioma']); ?>" src="iconos/Cerrar_sesion_2.png"><span class="m-l-10"><a class="text-black" href="logout.php"><?= buscarTexto("WEB", "mi-cuenta", "cuenta_li-5", "", $_SESSION['idioma']); ?></a></span></div>

                </div>
            </div>
        </div>
        <div class="container">
            <div class=" p-tb-50 text-center">
                <form>
                    <label class="fs-20"><?= buscarTexto("WEB", "historial-pedidos", "hp_busca2", "", $_SESSION['idioma']); ?></label>
                    <input class="pl-20" type="text" id="q" placeholder="<?= buscarTexto("WEB", "historial-pedidos", "hp_busca", "", $_SESSION['idioma']); ?>">
                </form>
            </div>

            <div>
                <p class="fs-14">* <?= buscarTexto("WEB", "historial-pedidos", "hp_selec", "", $_SESSION['idioma']); ?></p>
            </div>
            <div class="row">
                <?php
                try {
                    $sql = "SELECT pedidos.*
                    FROM pedidos INNER JOIN usuarios ON usuarios.id = pedidos.usuarios_id 
                    WHERE estado <> 'Anulado' AND usuarios.username='" . $_SESSION['email'] . "' ORDER BY idpedidos DESC";
                    $query = $conn->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                } catch (Exception $e) {
                    // header("location: error?msg=" . $e->getCode());
                    // header("location: error?msg=" . $e->getMessage());
                }
                ?>
                <div class="col-lg-12 scrollTabla" id="div_tabla1">
                    <div class="table-responsive-sm table-responsive-md table-responsive-lg">
                        <!--Tabla de pedidos-->
                        <table class="tablesorter m-b-100" id="tablaHistorial">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col"><?= buscarTexto("WEB", "historial-pedidos", "hp_celda-1", "", $_SESSION['idioma']); ?></th>
                                    <th scope="col"><?= buscarTexto("WEB", "historial-pedidos", "hp_celda-1.1", "", $_SESSION['idioma']); ?></th>
                                    <th scope="col"><?= buscarTexto("WEB", "historial-pedidos", "hp_celda-2", "", $_SESSION['idioma']); ?></th>
                                    <th scope="col"><?= buscarTexto("WEB", "historial-pedidos", "hp_celda-4", "", $_SESSION['idioma']); ?></th>
                                    <th scope="col"><?= buscarTexto("WEB", "historial-pedidos", "hp_celda-5", "", $_SESSION['idioma']); ?></th>
                                    <th scope="col"><?= buscarTexto("WEB", "historial-pedidos", "hp_celda-6", "", $_SESSION['idioma']); ?></th>
                                    <th scope="col" hidden></th>
                                </tr>
                            </thead>
                            <tbody id="the_table_body">
                                <?php foreach ($results as $result) { ?>
                                    <tr class="fila_hc">
                                        <!--[0]-->
                                        <td scope="row"><b><?= $result->idpedidos ?></b></td>
                                        <!--[1]-->
                                        <td scope="row"><b><?= $result->nombrepedido ?></b></td>
                                        <!--[2]-->
                                        <td><?php $date = new DateTime($result->fechaPedido);
                                            echo $date->format('d-m-y');
                                            ?></td>
                                        <!--[3]-->
                                        <td><?= str_replace('.', ',', $result->precioTotal) ?> €</td>
                                        <!--[4]-->
                                        <td class="estadoPedido">
                                            <?php
                                            if ($result->estado == "Enviando") {
                                                $rep = true;
                                            }
                                            switch ($result->estado) {
                                                case "Validado":
                                                    echo "Confirmado";
                                                    break;
                                                case "Pendiente fabricar":
                                                    echo "Pago confirmado";
                                                    break;
                                                default:
                                                    echo $result->estado;
                                                    break;
                                            }
                                            ?>
                                            <button id="btn-modal-ines" type="button" class="zoom btn-modal mb-2" data-toggle="modal" data-target="#informacion-estado">
                                                <span class=""><i class="ti-info-alt"></i></span>
                                            </button>
                                        </td>
                                        <!--[5]-->
                                        <td>
                                            <!--Botón ver boceto, abre ventana modal donde el cliente puede ver el boceto del pedido y pasar a pagar o pedir modificaciones-->
                                            <?php // if (isset($_SESSION['interno']) && $_SESSION['interno']) { 
                                            ?>
                                            <!-- <button type="button" class="zoom btnVerBoceto verBoceto_<?= $result->idpedidos ?> btn-boceto mb-2" data-toggle="modal" data-target="#confirmaRepetido" data-title=""><img src="iconos/mi-cuenta/confirmar.png" alt="<?= buscarTexto("WEB", "historial-pedidos", "alt-ver-boceto", "", $_SESSION['idioma']); ?>"></button> -->
                                            <?php //} else { 
                                            ?>
                                            <button type="button" class="zoom btnVerBoceto verBoceto_<?= $result->idpedidos ?> btn-boceto mb-2" data-toggle="modal" data-target="#boceto" data-title="<?= buscarTexto("WEB", "historial-pedidos", "hp_tooltip-bcto", "", $_SESSION['idioma']); ?>"><img src="iconos/mi-cuenta/ver-boceto.png" alt="<?= buscarTexto("WEB", "historial-pedidos", "alt-ver-boceto", "", $_SESSION['idioma']); ?>"></button>
                                            <?php // } 
                                            ?>

                                            <!--Botón para confirmar el pedido y que pase a las comerciales a su validacion, y posteriormente a los diseñadores para que comiencen el boceto-->
                                            <button type="button" class="zoom btnConfirmarPedido confirmarPedido_<?= $result->idpedidos ?> btn-confirmar mb-2 parpadea" data-toggle="modal" data-target="#estasSeguroConfirmar" data-title="<?= buscarTexto("WEB", "historial-pedidos", "hp_tooltip-confirmar", "", $_SESSION['idioma']); ?>"><img src="iconos/mi-cuenta/confirmar.png" alt="<?= buscarTexto("WEB", "historial-pedidos", "alt-confirmar", "", $_SESSION['idioma']); ?>"></button>

                                            <!--Botón para eliminar el pedido, cuando aun no se ha confirmado-->
                                            <button type="button" class="zoom btnEliminarPedido eliminarPedido_<?= $result->idpedidos ?> btn-rechazar mb-2" data-toggle="modal" data-target="#estasSeguroEliminar" data-title="<?= buscarTexto("WEB", "historial-pedidos", "hp_tooltip-eliminar", "", $_SESSION['idioma']); ?>"><img src="iconos/mi-cuenta/eliminar.png" alt="<?= buscarTexto("WEB", "historial-pedidos", "alt-eliminar", "", $_SESSION['idioma']); ?>"></button>

                                            <!--Botón para anular el pedido, cuando aun no se ha pagado-->
                                            <button type="button" class="zoom btnAnularPedido anularPedido_<?= $result->idpedidos ?> btn-anular mb-2" data-toggle="modal" data-target="#estasSeguroAnular" data-title="<?= buscarTexto("WEB", "historial-pedidos", "hp_tooltip-anular", "", $_SESSION['idioma']); ?>"><img src="iconos/mi-cuenta/anular.png" alt="<?= buscarTexto("WEB", "historial-pedidos", "alt-anular", "", $_SESSION['idioma']); ?>"></button>
                                        </td>
                                        <!--[6]-->
                                        <td hidden><?= $result->numeroPedido ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="col-lg-4 scroll" id="detalles_pedido" style="display: none;">
                    <h3><?= buscarTexto("WEB", "historial-pedidos", "hp_celda-deta", "", $_SESSION['idioma']); ?></h3>
                    <?php
                    try {
                        $sql = "SELECT pedidos.idpedidos, pedidos.numeroPedido, pedidos.nombrepedido, pedidos.fechaPedido, pedidos.precioTotal, pedidos.estado, productos.id_producto, productos.nombre, 
                        lineapedido.nombrepersonalizacion, lineapedido.idlineaPedido, lineapedido.ancho, lineapedido.largo, lineapedido.superficie, lineapedido.cantidad, formas.id_forma, 
                        formas.formas, pedidos.notas, base.idBase, base.Tipo_base, lineapedido.subtotal, lineapedido.ancho_base, lineapedido.largo_base,
                        lineapedido.pelo, lineapedido.cantidad_topes
                        FROM pedidos 
                        INNER JOIN lineapedido ON lineapedido.pedidos_idpedidos = pedidos.idpedidos
                        INNER JOIN productos_has_colores ON productos_has_colores.id = lineapedido.productos_has_colores_id
                        INNER JOIN productos ON productos.id_producto = productos_has_colores.id_producto
                        INNER JOIN formas ON formas.id_forma = lineapedido.id_forma
                        INNER JOIN base_has_colores ON base_has_colores.idBase = lineapedido.base_has_colores_idbase
                        INNER JOIN base ON base.idBase = base_has_colores.idBase
                        INNER JOIN usuarios ON usuarios.id = pedidos.usuarios_id 
                        WHERE usuarios.username = '" . $_SESSION['email'] . "'
                        GROUP BY lineapedido.idlineaPedido";
                        $query = $conn->prepare($sql);
                        $query->execute();
                        $results_h = $query->fetchAll(PDO::FETCH_OBJ);
                    } catch (Exception $e) {
                        header("location: error?msg=" . $e->getCode());
                        // header("location: error?msg=" . $e->getMessage());
                    }
                    ?>
                    <?php
                    foreach ($results_h as $result) { ?>
                        <div class="divsLP div_idLP_<?= $result->idpedidos ?>">
                            <a class="links" href="javascript:imprSelec('detalles_pedido_imprimir_<?= $result->idlineaPedido ?>')"><i class="fas fa-print"></i><?= buscarTexto("WEB", "historial-pedidos", "hp_celda-impr", "", $_SESSION['idioma']); ?></a>
                        </div>
                        <div class="divsLP div_idLP_<?= $result->idpedidos ?>">
                            <table id="detalles" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col"><?= buscarTexto("WEB", "historial-pedidos", "hp_celda-carac", "", $_SESSION['idioma']); ?></th>
                                        <th scope="col"><?= buscarTexto("WEB", "historial-pedidos", "hp_celda-deta", "", $_SESSION['idioma']); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="col"><b><?= buscarTexto("WEB", "historial-pedidos", "hp_celda-numper", "", $_SESSION['idioma']); ?></b></td>
                                        <td scope="col"><b><?= $result->idlineaPedido ?></b></td>
                                    </tr>
                                    <tr>
                                        <td scope="row"><b><?= buscarTexto("WEB", "historial-pedidos", "hp_celda-nomper", "", $_SESSION['idioma']); ?></b></th>
                                        <td><b><?= $result->nombrepersonalizacion ?></b></td>
                                    </tr>
                                    <tr>
                                        <td scope="row"><?= buscarTexto("WEB", "historial-pedidos", "hp_celda-4", "", $_SESSION['idioma']); ?></th>
                                        <td><?= str_replace('.', ',', $result->subtotal) ?>€</td>
                                    </tr>

                                    <?php if ($result->nombrepersonalizacion != "Muestrario") { ?>
                                        <tr>
                                            <td scope="row"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_detll-producto", "", $_SESSION['idioma']); ?></th>
                                            <td><?= buscarTexto("PRG", "productos", $result->id_producto, "nombre", $_SESSION['idioma']); ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td scope="row"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_detll-cant", "", $_SESSION['idioma']); ?></th>
                                        <td><?= $result->cantidad ?></td>
                                    </tr>
                                    <tr>
                                        <td scope="row"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_detll-medidas", "", $_SESSION['idioma']); ?></td>
                                        <?php if ($result->ancho == '0' || $result->largo == '0') { ?>
                                            <td><?= buscarTexto("WEB", "generico", "na", "", $_SESSION['idioma']); ?></td>
                                        <?php } else { ?>
                                            <td><?= str_replace('.', ',', $result->ancho) ?>cm X <?= str_replace('.', ',', $result->largo) ?>cm = <?= str_replace('.', ',', $result->superficie) ?>cm<sup style="inherit">2</sup></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <?php
                                        try {
                                            $sql_color = "SELECT nombre, hexadecimal, francia, portugal, italia
                                            FROM colorlineapedidoelegido
                                            INNER JOIN colores ON colores.idColor = colorlineapedidoelegido.idcolor
                                            WHERE idlineapedido = " . $result->idlineaPedido;
                                            $query_color = $conn->prepare($sql_color);
                                            $query_color->execute();
                                            $result_color = $query_color->fetchAll(PDO::FETCH_OBJ);
                                        } catch (Exception $e) {
                                            header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
                                        }
                                        ?>
                                        <td scope="row"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_detll-colores", "", $_SESSION['idioma']); ?></td>
                                        <td>
                                            <?php foreach ($result_color as $color) { ?>
                                                <?php if ($_SESSION['idioma'] == 'ES') {
                                                    echo $color->nombre == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->nombre;
                                                } else if ($_SESSION['idioma'] == 'FR' && $color->francia != null) {
                                                    echo $color->francia == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->francia;
                                                } else if ($_SESSION['idioma'] == 'PT' && $color->portugal != null) {
                                                    echo $color->portugal == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->portugal;
                                                } else if ($_SESSION['idioma'] == 'IT' && $color->italia != null) {
                                                    echo $color->italia == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->italia;
                                                } else {
                                                    echo $color->nombre == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->nombre;
                                                } ?>
                                                <br>
                                            <?php
                                            } ?>
                                        </td>
                                    </tr>



                                    <?php
                                    try {
                                        $sql_color = "SELECT nombre, hexadecimal, francia, portugal, italia
                                        FROM lineapedido
                                        INNER JOIN colores ON colores.idColor = lineapedido.idcolor_modulo
                                        WHERE idlineapedido = " . $result->idlineaPedido;
                                        $query_color = $conn->prepare($sql_color);
                                        $query_color->execute();
                                        $result_color = $query_color->fetchAll(PDO::FETCH_OBJ);
                                    } catch (Exception $e) {
                                        header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
                                    }
                                    ?>
                                    <?php foreach ($result_color as $color) {
                                        if ($color->nombre != "NO COLOR") { ?>
                                            <tr>
                                                <td scope="row"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_detll-cmetal", "", $_SESSION['idioma']); ?></td>
                                                <td>
                                                <?php if ($_SESSION['idioma'] == 'ES') {
                                                    echo $color->nombre == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->nombre;
                                                } else if ($_SESSION['idioma'] == 'FR' && $color->francia != null) {
                                                    echo $color->francia == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->francia;
                                                } else if ($_SESSION['idioma'] == 'PT' && $color->portugal != null) {
                                                    echo $color->portugal == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->portugal;
                                                } else if ($_SESSION['idioma'] == 'IT' && $color->italia != null) {
                                                    echo $color->italia == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->italia;
                                                } else {
                                                    echo $color->nombre == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->nombre;
                                                }
                                            } ?>
                                                </td>
                                            </tr>
                                        <?php } ?>

                                        <?php
                                        try {
                                            $sql_color = "SELECT nombre, hexadecimal, francia, portugal, italia
                                            FROM lineapedido
                                            INNER JOIN colores ON colores.idColor = lineapedido.idcolor_piel
                                            WHERE idlineapedido = " . $result->idlineaPedido;
                                            $query_color = $conn->prepare($sql_color);
                                            $query_color->execute();
                                            $result_color = $query_color->fetchAll(PDO::FETCH_OBJ);
                                        } catch (Exception $e) {
                                            header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
                                        }
                                        ?>
                                        <?php foreach ($result_color as $color) {
                                            if ($color->nombre != "NO COLOR") {
                                        ?>
                                                <tr>
                                                    <td scope="row"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_detll-cpiel", "", $_SESSION['idioma']); ?></td>
                                                    <td>
                                                    <?php if ($_SESSION['idioma'] == 'ES') {
                                                        echo $color->nombre == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->nombre;
                                                    } else if ($_SESSION['idioma'] == 'FR' && $color->francia != null) {
                                                        echo $color->francia == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->francia;
                                                    } else if ($_SESSION['idioma'] == 'PT' && $color->portugal != null) {
                                                        echo $color->portugal == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->portugal;
                                                    } else if ($_SESSION['idioma'] == 'IT' && $color->italia != null) {
                                                        echo $color->italia == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->italia;
                                                    } else {
                                                        echo $color->nombre == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->nombre;
                                                    }
                                                } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>

                                            <?php if ($result->id_forma != 15) { ?>
                                                <tr>
                                                    <td scope="row"> <?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_detll-forma", "", $_SESSION['idioma']); ?></td>
                                                    <td><?= buscarTexto("PRG", "formas", $result->id_forma, "formas", $_SESSION['idioma']); ?></td>
                                                </tr>
                                            <?php } ?>

                                            <?php if ($result->idBase != 6) { ?>
                                                <tr>
                                                    <td scope="row"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_detll-tipob", "", $_SESSION['idioma']); ?></td>
                                                    <td><?= buscarTexto("PRG", "base", $result->idBase, "Tipo_base", $_SESSION['idioma']); ?></td>
                                                </tr>

                                                <?php if ($result->pelo != '0') { ?>
                                                    <tr>
                                                        <td scope="row"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_detll-pelo", "", $_SESSION['idioma']); ?></td>
                                                        <td><?php if ($result->pelo == '0') {
                                                                echo buscarTexto("WEB", "generico", "na", "", $_SESSION['idioma']);
                                                            } else {
                                                                echo buscarTexto("WEB", "generico", "si", "", $_SESSION['idioma']);
                                                            } ?></td>
                                                    </tr>
                                                <?php }
                                                try {
                                                    $sql_color = "SELECT nombre, hexadecimal, francia, portugal, italia
                                                    FROM lineapedido
                                                    INNER JOIN colores ON colores.idColor = lineapedido.base_has_idColor
                                                    WHERE idlineapedido = " . $result->idlineaPedido;
                                                    $query_color = $conn->prepare($sql_color);
                                                    $query_color->execute();
                                                    $result_color = $query_color->fetchAll(PDO::FETCH_OBJ);
                                                } catch (Exception $e) {
                                                    header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
                                                }
                                                ?>
                                                <?php foreach ($result_color as $color) {
                                                    if ($color->nombre != "NO COLOR") { ?>
                                                        <tr>
                                                            <td scope="row"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_detll-cbase", "", $_SESSION['idioma']); ?></td>
                                                            <td>
                                                                <?php if ($_SESSION['idioma'] == 'ES') {
                                                                    echo $color->nombre == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->nombre;
                                                                } else if ($_SESSION['idioma'] == 'FR' && $color->francia != null) {
                                                                    echo $color->francia == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->francia;
                                                                } else if ($_SESSION['idioma'] == 'PT' && $color->portugal != null) {
                                                                    echo $color->portugal == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->portugal;
                                                                } else if ($_SESSION['idioma'] == 'IT' && $color->italia != null) {
                                                                    echo $color->italia == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->italia;
                                                                } else {
                                                                    echo $color->nombre == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->nombre;
                                                                } ?>
                                                            </td>
                                                        </tr>
                                                    <?php }
                                                }
                                                if ($result->idBase == 1) { ?>
                                                    <tr>
                                                        <td scope="row"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_detll-anchob", "", $_SESSION['idioma']); ?></td>
                                                        <td>
                                                            <?php if ($result->ancho_base == '0') {
                                                                echo buscarTexto("WEB", "generico", "na", "", $_SESSION['idioma']);
                                                            } else {
                                                                echo str_replace('.', ',', $result->ancho_base) . "cm";
                                                            } ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_detll-largob", "", $_SESSION['idioma']); ?></td>
                                                        <td>
                                                            <?php if ($result->largo_base == '0') {
                                                                echo buscarTexto("WEB", "generico", "na", "", $_SESSION['idioma']);
                                                            } else {
                                                                echo  str_replace('.', ',', $result->largo_base) . "cm";
                                                            } ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } ?>


                                            <?php if ($result->cantidad_topes != '0') { ?>
                                                <tr>
                                                    <td scope="row"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_detll-topes", "", $_SESSION['idioma']); ?></td>
                                                    <td>
                                                        <?php if ($result->cantidad_topes == '0') {
                                                            echo buscarTexto("WEB", "generico", "na", "", $_SESSION['idioma']);
                                                        } else {
                                                            echo $result->cantidad_topes;
                                                        } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>

                                            <?php if ($result->nombrepersonalizacion != "Muestra individual" && $result->nombrepersonalizacion != "Muestrario") { ?>
                                                <!-- <tr>
                                                    <td scope="row"><?= buscarTexto("WEB", "historial-pedidos", "hp_celda-imagen", "", $_SESSION['idioma']); ?></td>
                                                    <td class="image-detalle">
                                                        <div>
                                                            <img onclick="imagenAbrirModal2(this)" onError="this.onerror=null;this.src='imagenes_bocetos/C<?= $result->idpedidos ?>-<?= $result->idlineaPedido ?>.png';" class="myImg img-fluid mx-auto" src="imagenes_bocetos/C<?= $result->idpedidos ?>-<?= $result->idlineaPedido ?>.jpg">
                                                        </div>
                                                    </td>
                                                </tr> -->
                                            <?php } ?>

                                            <?php if (
                                                $result->estado != "Pendiente" && $result->estado != "Confirmado" && $result->estado != "Validado" &&
                                                $result->estado != "Preparando boceto" &&
                                                $result->estado != "Boceto generado" && $result->estado != "Boceto no aceptado" && $result->estado != "No aceptado" &&
                                                $result->nombrepersonalizacion != "Muestra individual" && $result->nombrepersonalizacion != "Muestrario"
                                            ) { ?>
                                                <tr>
                                                    <td scope="row"><?= buscarTexto("WEB", "historial-pedidos", "hp_celda-boceto", "", $_SESSION['idioma']); ?></td>
                                                    <td class="image-detalle">
                                                        <div>
                                                            <img onclick="imagenAbrirModal2(this)" class="myImg img-fluid mx-auto" src="imagenes_bocetos/D<?= $result->idpedidos ?>-<?= $result->idlineaPedido ?>.jpg">
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                </tbody>
                            </table>

                        </div>
                        <div class="detallesimpr" id="detalles_pedido_imprimir_<?= $result->idlineaPedido ?>" hidden>
                            <h3><?= buscarTexto("WEB", "historial-pedidos", "pdf_tit1", "", $_SESSION['idioma']); ?> <?= $result->idpedidos ?></h3>
                            <h3><?= buscarTexto("WEB", "historial-pedidos", "pdf_tit2", "", $_SESSION['idioma']); ?> <?= $result->nombrepedido ?></h3>
                            <p><?= buscarTexto("WEB", "historial-pedidos", "pdf_p1", "", $_SESSION['idioma']); ?> <?= str_replace('.', ',', $result->precioTotal) ?>€</p>
                            <p><?= buscarTexto("WEB", "historial-pedidos", "pdf_p2", "", $_SESSION['idioma']); ?> <?= $result->estado ?></p>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row"><?= buscarTexto("WEB", "historial-pedidos", "hp_celda-numper", "", $_SESSION['idioma']); ?></th>
                                        <td><b><?= $result->idlineaPedido ?></b></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= buscarTexto("WEB", "historial-pedidos", "hp_celda-nomper", "", $_SESSION['idioma']); ?></th>
                                        <td><b><?= $result->nombrepersonalizacion ?></b></td>
                                    </tr>
                                    <?php if ($result->nombrepersonalizacion != "Muestrario") { ?>
                                        <tr>
                                            <td scope="row"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_detll-producto", "", $_SESSION['idioma']); ?></td>
                                            <td><?= buscarTexto("PRG", "productos", $result->id_producto, "nombre", $_SESSION['idioma']); ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td scope="row"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_detll-cant", "", $_SESSION['idioma']); ?></td>
                                        <td><?= $result->cantidad ?></td>
                                    </tr>
                                    <?php if ($result->ancho != '0' || $result->largo != '0') { ?>
                                        <tr>
                                            <td scope="row"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_detll-medidas", "", $_SESSION['idioma']); ?></td>
                                            <?php if ($result->ancho == '0' || $result->largo == '0') { ?>
                                                <td><?= buscarTexto("WEB", "generico", "na", "", $_SESSION['idioma']); ?></td>
                                            <?php } else { ?>
                                                <td><?= str_replace('.', ',', $result->ancho) ?>cm X <?= str_replace('.', ',', $result->largo) ?>cm = <?= str_replace('.', ',', $result->superficie) ?>cm<sup style="inherit">2</sup></td>
                                            <?php } ?>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <?php
                                        try {
                                            $sql_color = "SELECT nombre, hexadecimal, francia, portugal, italia
                                            FROM colorlineapedidoelegido
                                            INNER JOIN colores ON colores.idColor = colorlineapedidoelegido.idcolor
                                            WHERE idlineapedido = " . $result->idlineaPedido;
                                            $query_color = $conn->prepare($sql_color);
                                            $query_color->execute();
                                            $result_color = $query_color->fetchAll(PDO::FETCH_OBJ);
                                        } catch (Exception $e) {
                                            header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
                                        }
                                        ?>
                                        <td scope="row"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_detll-colores", "", $_SESSION['idioma']); ?></td>
                                        <td>
                                            <?php foreach ($result_color as $color) { ?>
                                                <?php if ($_SESSION['idioma'] == 'ES') {
                                                    echo $color->nombre == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->nombre;
                                                } else if ($_SESSION['idioma'] == 'FR' && $color->francia != null) {
                                                    echo $color->francia == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->francia;
                                                } else if ($_SESSION['idioma'] == 'PT' && $color->portugal != null) {
                                                    echo $color->portugal == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->portugal;
                                                } else if ($_SESSION['idioma'] == 'IT' && $color->italia != null) {
                                                    echo $color->italia == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->italia;
                                                } else {
                                                    echo $color->nombre == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->nombre;
                                                } ?>
                                            <?= "<br>";
                                            } ?>
                                        </td>
                                    </tr>
                                    <?php
                                    try {
                                        $sql_color = "SELECT nombre, hexadecimal, francia, portugal, italia
                                        FROM lineapedido
                                        INNER JOIN colores ON colores.idColor = lineapedido.base_has_idColor
                                        WHERE idlineapedido = " . $result->idlineaPedido;
                                        $query_color = $conn->prepare($sql_color);
                                        $query_color->execute();
                                        $result_color = $query_color->fetchAll(PDO::FETCH_OBJ);
                                    } catch (Exception $e) {
                                        header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
                                    }
                                    ?>
                                    <?php foreach ($result_color as $color) {
                                        if ($color->nombre != "NO COLOR") { ?>
                                            <tr>
                                                <td scope="row"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_detll-cbase", "", $_SESSION['idioma']); ?></td>
                                                <td>
                                                    <?php if ($_SESSION['idioma'] == 'ES') {
                                                        echo $color->nombre == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->nombre;
                                                    } else if ($_SESSION['idioma'] == 'FR' && $color->francia != null) {
                                                        echo $color->francia == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->francia;
                                                    } else if ($_SESSION['idioma'] == 'PT' && $color->portugal != null) {
                                                        echo $color->portugal == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->portugal;
                                                    } else if ($_SESSION['idioma'] == 'IT' && $color->italia != null) {
                                                        echo $color->italia == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->italia;
                                                    } else {
                                                        echo $color->nombre == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->nombre;
                                                    } ?>
                                                </td>
                                            </tr>

                                    <?php }
                                    } ?>

                                    <?php
                                    try {
                                        $sql_color = "SELECT nombre, hexadecimal, francia, portugal, italia
                                        FROM lineapedido
                                        INNER JOIN colores ON colores.idColor = lineapedido.idcolor_modulo
                                        WHERE idlineapedido = " . $result->idlineaPedido;
                                        $query_color = $conn->prepare($sql_color);
                                        $query_color->execute();
                                        $result_color = $query_color->fetchAll(PDO::FETCH_OBJ);
                                    } catch (Exception $e) {
                                        header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
                                    }
                                    ?>
                                    <?php foreach ($result_color as $color) {
                                        if ($color->nombre != "NO COLOR") { ?>
                                            <tr>
                                                <td scope="row"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_detll-cmetal", "", $_SESSION['idioma']); ?></td>
                                                <td>
                                                <?php if ($_SESSION['idioma'] == 'ES') {
                                                    echo $color->nombre == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->nombre;
                                                } else if ($_SESSION['idioma'] == 'FR' && $color->francia != null) {
                                                    echo $color->francia == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->francia;
                                                } else if ($_SESSION['idioma'] == 'PT' && $color->portugal != null) {
                                                    echo $color->portugal == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->portugal;
                                                } else if ($_SESSION['idioma'] == 'IT' && $color->italia != null) {
                                                    echo $color->italia == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->italia;
                                                } else {
                                                    echo $color->nombre == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->nombre;
                                                }
                                            } ?>

                                                </td>
                                            </tr>
                                        <?php } ?>

                                        <?php
                                        try {
                                            $sql_color = "SELECT nombre, hexadecimal, francia, portugal, italia
                                            FROM lineapedido
                                            INNER JOIN colores ON colores.idColor = lineapedido.idcolor_piel
                                            WHERE idlineapedido = " . $result->idlineaPedido;
                                            $query_color = $conn->prepare($sql_color);
                                            $query_color->execute();
                                            $result_color = $query_color->fetchAll(PDO::FETCH_OBJ);
                                        } catch (Exception $e) {
                                            header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
                                        }
                                        ?>
                                        <?php foreach ($result_color as $color) {
                                            if ($color->nombre != "NO COLOR") {
                                        ?>
                                                <tr>
                                                    <td scope="row"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_detll-cpiel", "", $_SESSION['idioma']); ?></td>
                                                    <td>
                                                    <?php if ($_SESSION['idioma'] == 'ES') {
                                                        echo $color->nombre == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->nombre;
                                                    } else if ($_SESSION['idioma'] == 'FR' && $color->francia != null) {
                                                        echo $color->francia == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->francia;
                                                    } else if ($_SESSION['idioma'] == 'PT' && $color->portugal != null) {
                                                        echo $color->portugal == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->portugal;
                                                    } else if ($_SESSION['idioma'] == 'IT' && $color->italia != null) {
                                                        echo $color->italia == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->italia;
                                                    } else {
                                                        echo $color->nombre == "NO COLOR" ? buscarTextoConReturn("WEB", "generico", "na", "", $_SESSION['idioma']) : $color->nombre;
                                                    }
                                                } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>

                                            <?php if ($result->id_forma != 15) { ?>
                                                <tr>
                                                    <td scope="row"> <?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_detll-forma", "", $_SESSION['idioma']); ?></td>
                                                    <td><?= buscarTexto("PRG", "formas", $result->id_forma, "formas", $_SESSION['idioma']); ?></td>
                                                </tr>
                                            <?php } ?>

                                            <?php if ($result->idBase != 6) { ?>
                                                <tr>
                                                    <td scope="row"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_detll-tipob", "", $_SESSION['idioma']); ?></td>
                                                    <td><?= buscarTexto("PRG", "base", $result->idBase, "Tipo_base", $_SESSION['idioma']); ?></td>
                                                </tr>

                                                <tr>
                                                    <td scope="row"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_detll-anchob", "", $_SESSION['idioma']); ?></td>
                                                    <td>
                                                        <?php if ($result->ancho_base == '0') {
                                                            echo buscarTexto("WEB", "generico", "na", "", $_SESSION['idioma']);
                                                        } else {
                                                            echo str_replace('.', ',', $result->ancho_base);
                                                        } ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td scope="row"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_detll-largob", "", $_SESSION['idioma']); ?></td>
                                                    <td>
                                                        <?php if ($result->largo_base == '0') {
                                                            echo buscarTexto("WEB", "generico", "na", "", $_SESSION['idioma']);
                                                        } else {
                                                            echo  str_replace('.', ',', $result->largo_base);
                                                        } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>

                                            <?php if ($result->pelo != '0') { ?>
                                                <tr>
                                                    <td scope="row"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_detll-pelo", "", $_SESSION['idioma']); ?></td>
                                                    <td><?php if ($result->pelo == '0') {
                                                            echo buscarTexto("WEB", "generico", "na", "", $_SESSION['idioma']);
                                                        } else {
                                                            echo buscarTexto("WEB", "generico", "si", "", $_SESSION['idioma']);
                                                        } ?></td>
                                                </tr>
                                            <?php } ?>

                                            <?php if ($result->cantidad_topes != '0') { ?>
                                                <tr>
                                                    <td scope="row"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_detll-topes", "", $_SESSION['idioma']); ?></td>
                                                    <td>
                                                        <?php if ($result->cantidad_topes == '0') {
                                                            echo buscarTexto("WEB", "generico", "na", "", $_SESSION['idioma']);
                                                        } else {
                                                            echo $result->cantidad_topes;
                                                        } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td scope="row" colspan="2" class="text-center"><?= buscarTexto("WEB", "historial-pedidos", "hp_celda-boceto", "", $_SESSION['idioma']); ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" colspan="2"> <img class="myImg img-fluid mx-auto" src="imagenes_bocetos/D<?= $result->idpedidos ?>-<?= $result->idlineaPedido ?>.jpg"></td>
                                            </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                </div>
                <!-- Boton  ¿Qué significan los iconos?-->
                <button type="button" class="btn btn-primary mt-5 ml-3" data-toggle="modal" data-target="#exampleModalLong">
                    <?= buscarTexto("WEB", "historial-pedidos", "hp_btn-modal_iconos", "", $_SESSION['idioma']); ?>
                </button>

                <?php if ($rep || (isset($_SESSION['interno']) && $_SESSION['interno'])) { ?>
                    <!-- Botón Repetir -->
                    <button type="button" class="btnRepetir mt-5 ml-3" data-toggle="modal" data-target="#repetirPedido">
                        <img src="iconos/mi-cuenta/repetir.png" alt=""> <?= buscarTexto("WEB", "historial-pedidos", "hp_tooltip-repetir", "", $_SESSION['idioma']); ?>
                    </button>
                <?php } ?>

            </div>
        </div>
    </main>
    <?php
    include("assets/_partials/footer.php");
    ?>

    <!-- Ventana modal explicación de los iconos -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><?= buscarTexto("WEB", "historial-pedidos", "hp_modal_iconos-tit", "", $_SESSION['idioma']); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- <div><img class="mr-2" src="iconos/mi-cuenta/detalles.png" alt="<?= buscarTexto("WEB", "historial-pedidos", "alt-detalles", "", $_SESSION['idioma']); ?>"><strong><?= buscarTexto("WEB", "historial-pedidos", "hp_modal_iconos-txt1", "", $_SESSION['idioma']); ?></strong>
                        <p class="pl-2"><?= buscarTexto("WEB", "historial-pedidos", "hp_modal_iconos-txt1-2", "", $_SESSION['idioma']); ?> </p>
                    </div> -->

                    <!--Confirmar pedido-->
                    <div><img class="mr-2" src="iconos/mi-cuenta/confirmar.png" alt="<?= buscarTexto("WEB", "historial-pedidos", "alt-confirmar", "", $_SESSION['idioma']); ?>"><strong> <?= buscarTexto("WEB", "historial-pedidos", "hp_modal_iconos-txt2", "", $_SESSION['idioma']); ?></strong>
                        <p class="pl-2"><?= buscarTexto("WEB", "historial-pedidos", "hp_modal_iconos-txt2-2", "", $_SESSION['idioma']); ?></p>
                    </div>

                    <!--Eliminar lineas de pedido-->
                    <div><img class="mr-2" src="iconos/mi-cuenta/eliminar.png" alt="<?= buscarTexto("WEB", "historial-pedidos", "alt-eliminar", "", $_SESSION['idioma']); ?>"> <strong><?= buscarTexto("WEB", "historial-pedidos", "hp_modal_iconos-txt3", "", $_SESSION['idioma']); ?></strong>
                        <p class="pl-2"><?= buscarTexto("WEB", "historial-pedidos", "hp_modal_iconos-txt3-2", "", $_SESSION['idioma']); ?></p>
                    </div>

                    <!--Ver bocetos pedido-->
                    <div><img class="mr-2" src="iconos/mi-cuenta/ver-boceto.png" alt="<?= buscarTexto("WEB", "historial-pedidos", "alt-ver-boceto", "", $_SESSION['idioma']); ?>"><strong><?= buscarTexto("WEB", "historial-pedidos", "hp_modal_iconos-txt4", "", $_SESSION['idioma']); ?></strong>
                        <p class="pl-2"><?= buscarTexto("WEB", "historial-pedidos", "hp_modal_iconos-txt4-2", "", $_SESSION['idioma']); ?> </p>
                    </div>

                    <!--Repetir pedido-->
                    <div><img class="mr-2" src="iconos/mi-cuenta/repetir.png" alt="<?= buscarTexto("WEB", "historial-pedidos", "alt-repetir", "", $_SESSION['idioma']); ?>"><strong> <?= buscarTexto("WEB", "historial-pedidos", "hp_modal_iconos-txt5", "", $_SESSION['idioma']); ?></strong>
                        <p class="pl-2"><?= buscarTexto("WEB", "historial-pedidos", "hp_modal_iconos-txt5-2", "", $_SESSION['idioma']); ?></p>
                    </div>

                    <!--Anular pedido-->
                    <div><img class="mr-2" src="iconos/mi-cuenta/anular.png" alt="<?= buscarTexto("WEB", "historial-pedidos", "alt-anular", "", $_SESSION['idioma']); ?>"><strong><?= buscarTexto("WEB", "historial-pedidos", "hp_modal_iconos-txt6", "", $_SESSION['idioma']); ?></strong>
                        <p class="pl-2"><?= buscarTexto("WEB", "historial-pedidos", "hp_modal_iconos-txt6-2", "", $_SESSION['idioma']); ?></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_detll-btn", "", $_SESSION['idioma']); ?></button>

                </div>
            </div>
        </div>
    </div>

    <!--Modal ver boceto/s-->
    <div class="modal fade" id="boceto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-boceto">
                    <h5 class="modal-title" id="exampleModalLongTitle"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_bcto-tit", "", $_SESSION['idioma']); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  container">
                    <div class="">
                        <p class="mb-3">
                            <?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_bcto-p-2", "", $_SESSION['idioma']); ?>
                        </p>
                        <p class="mb-3">
                            <?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_bcto-p-3", "", $_SESSION['idioma']); ?>
                        </p>
                    </div>
                    <?php
                    $i = 0;
                    foreach ($results_h as $result) {
                        if ($result->estado == "Boceto generado" && $result->nombrepersonalizacion != "Muestrario") { ?>
                            <div class="accordion divBocetos lpBoceto_<?= $result->idpedidos ?>" id="accordionExample">
                                <div class="card">
                                    <button id="heading<?= $i ?>" class="card-header collapsed" type="button" data-toggle="collapse" data-target="#collapse<?= $i ?>" aria-expanded="false" aria-controls="collapse<?= $i ?>">
                                        <p style="text-align: center;" scope="col"><i class="ti-angle-down"></i> #<?= $result->idlineaPedido ?> - <?= $result->nombrepersonalizacion ?> </p>
                                    </button>

                                    <div id="collapse<?= $i ?>" class="collapse " aria-labelledby="heading<?= $i ?>" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="image-detalle">
                                                <img alt="<?= buscarTexto("WEB", "historial-pedidos", "alt-boceto", "", $_SESSION['idioma']); ?>" onError="this.onerror=null;this.src='imagenes_bocetos/D<?= $result->idpedidos ?>-<?= $result->idlineaPedido ?>.png';" onclick="imagenAbrirModal(this)" class="myImg img-fluid mx-auto" src="imagenes_bocetos/D<?= $result->idpedidos ?>-<?= $result->idlineaPedido ?>.jpg" alt="<?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_bcto-alt1", "", $_SESSION['idioma']); ?> <?= $result->idpedidos ?> - <?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_bcto-alt2", "", $_SESSION['idioma']); ?> <?= $result->idlineaPedido ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    <?php
                            $i++;
                        }
                    } ?>
                    <div class="mt-5" id="divFormRechazoBoceto" style="display: none;">
                        <form id="formrechazoBoceto" action="DAOs/historial-pedidosDAO.php?pag=<?= basename($_SERVER['REQUEST_URI']) ?>" method="post">
                            <label><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_bcto-?modificar", "", $_SESSION['idioma']); ?></label>
                            <input type="text" name="idPedido" id="idPedido" value="" hidden>
                            <input type="text" name="anotaciones" class="single-textarea" value="" required>
                            <br><input type="submit" class="btn btn-primary mt-3" value="<?= buscarTexto("WEB", "generico", "btn-enviar", "", $_SESSION['idioma']); ?>">
                        </form>
                    </div>
                </div>

                <div id="footModal" class="modal-footer">
                    <form id="formconfirma" action="propiedad-intelectual?pag=<?= buscarTexto("WEB", "paginas", "historial-pedidos", "", $_SESSION['idioma']); ?>" method="post">
                        <input type="text" name="idPedidos" id="idPedidos" value="" hidden>
                        <input type="text" name="total" id="total" value="" hidden>
                        <?php
                        try {
                            $sql = "SELECT isAutorizado FROM fichaempresametas INNER JOIN marcas_has_fichaempresametas
                                    ON marcas_has_fichaempresametas.fichaempresametas_idfichaempresa = fichaempresametas.idfichaempresa
                                     WHERE email = '" . $_SESSION["email"] . "' group by fichaempresametas_idfichaempresa";
                            $query = $conn_formularios->prepare($sql);
                            $query->execute();
                            $results = $query->fetchColumn();
                        } catch (Exception $e) {
                            // header("location: error?msg=" . $e->getCode());
                            // header("location: error?msg=" . $e->getMessage());
                        }
                        if ($results == '1' || (isset($_SESSION['interno']) && $_SESSION['interno'])) {
                        ?>
                            <button type="submit" class="confirmar confirma_<?= $result->idpedidos ?> btn btn-primary"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_bcto-btn-1", "", $_SESSION['idioma']); ?></button>
                            <button type="button" id="btnRechazarBoceto" class="btn btn-rechazar-pedidos"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_bcto-btn-2", "", $_SESSION['idioma']); ?></button>
                        <?php } else { ?>
                            <p class="help-block"><?= buscarTexto("WEB", "historial-pedidos", "hp_msj-noverif", "", $_SESSION['idioma']); ?></p>
                            <!--Datos reales textilforms-->
                            <p><?= buscarTexto("WEB", "historial-pedidos", "hp_verficha", "", $_SESSION['idioma']); ?> <a target="_blank" href="https://www.textilforms.com/login.php?web=13&idioma=<?= $_SESSION['idioma'] ?>" class="links"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_detped-p1.1", "", $_SESSION['idioma']); ?></a>.</p>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal para ver la imagen del boceto del diseñador ampliada -->
        <!-- El modal del diseñador debe estar dentro del modal de boceto para que se superponga-->
        <div id="myModal" class="modal-imagen">
            <span onclick="cerrarModal()" class="close-img-modal">&times;</span>
            <img alt="<?= buscarTexto("WEB", "historial-pedidos", "alt-boceto", "", $_SESSION['idioma']); ?>" class="modal-content-imagen" id="img01">
            <div id="caption_img"></div>
        </div>
    </div>


    <!-- Modal para ver la imagen del boceto del cliente ampliada -->
    <!-- El modal del cliente debe estar fuera para que se vea-->
    <div id="myModal2" class="modal-imagen">
        <span onclick="cerrarModal2()" class="close-img-modal">&times;</span>
        <img alt="<?= buscarTexto("WEB", "historial-pedidos", "alt-boceto", "", $_SESSION['idioma']); ?>" class="modal-content-imagen" id="img02">
        <div id="caption_img2"></div>
    </div>


    <!--Modal estas seguro de confirmar?-->
    <div class="modal fade" id="estasSeguroConfirmar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  container">
                    <div class="">
                        <p class="mb-3">
                            <?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_confirmar-p", "", $_SESSION['idioma']); ?>
                        </p>
                        <p class="title-paso-configurator"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_confirmar-p3", "", $_SESSION['idioma']); ?></p>

                    </div>

                    <?php //Si es INTERNO 
                    if (isset($_SESSION['interno']) && $_SESSION['interno']) { ?>
                        <div id="divInterno">

                            <!--Usuario comercial-->
                            <div class="m-b-30">
                                <p class="fs-configurator p-b-20 mayus title-paso-configurator">Selecciona tu usuario</p>
                                <select class="form-control" id="comercial" name="comercial" required>
                                    <?php
                                    try {
                                        $sql = "SELECT `trabajadores_idtrabajadores`, `username` FROM `departamentos_has_trabajadores`
                                    INNER JOIN trabajadoesadministradorprograma tap ON
                                    tap.departamentos_has_trabajadores_trabajadores_idtrabajadores = departamentos_has_trabajadores.trabajadores_idtrabajadores
                                    WHERE `programas_versiones_id`= 34  AND username <>'VICTOR' ORDER BY `username`";
                                        $query = $conn_prgborman->query($sql);
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    } catch (Exception $e) {
                                        header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
                                    }
                                    foreach ($results as $result) {
                                    ?>
                                        <option value="<?= $result->trabajadores_idtrabajadores; ?>"><?= $result->username ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <!--Cliente-->
                            <div class="m-b-30">
                                <p class="fs-configurator p-b-20 mayus title-paso-configurator">Selecciona el cliente</p>
                                <select class="form-control" id="clienteFP" name="clienteFP" required>
                                    <?php
                                    try {
                                        // $sql = "SELECT nombreFiscal FROM fichaempresametas ORDER BY nombreFiscal";
                                        // $query = $conn_formularios->query($sql);

                                        //De momento saco lista clientes factura plus ya que ficha empresa aun no esta en funcionamiento (26/05/23)
                                        $sql = "SELECT clienteFacturaPlus FROM clientefacturaplus ORDER BY clienteFacturaPlus";
                                        $query = $conn_prgborman->query($sql);
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    } catch (Exception $e) {
                                        header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
                                    }
                                    foreach ($results as $result) {
                                    ?>
                                        <option value="<?= $result->clienteFacturaPlus; ?>"><?= $result->clienteFacturaPlus ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <!--Anticipo-->
                            <div class="m-b-30">
                                <p class="fs-configurator p-b-20 mayus title-paso-configurator">Anticipo</p>
                                <!--Si o no tiene anticipo-->
                                <div class="row">
                                    <div class="col-2">
                                        <label for="sianticipo"><input type="radio" id="sianticipo" name="anticipo" value="1" />
                                            <?= buscarTexto("WEB", "generico", "si", "", $_SESSION['idioma']); ?></label>
                                        <label for="noanticipo"><input type="radio" id="noanticipo" name="anticipo" value="0" checked />
                                            <?= buscarTexto("WEB", "generico", "no", "", $_SESSION['idioma']); ?></label>
                                    </div>
                                    <div class="col-10">
                                        <!--Porcentaje (decimal) del anticipo-->
                                        <input type="text" class="form-control" id="porcentajeAnticipo" name="porcentajeAnticipo" placeholder="Ejemplo: 0.1" value="" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php  } ?>
                    <!--¿Necesitas comentarnos algo?-->
                    <div class="m-b-30">
                        <p class="fs-configurator p-b-20 mayus title-paso-configurator"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_confirmar-p2", "", $_SESSION['idioma']); ?></p>
                        <textarea class="single-textarea" id="comentario" name="comentario"></textarea>
                    </div>
                    <button type="button" id="btnSiConfirma" class="btn btn-primary mt-2 text-white">
                        <span class="button__text"> <?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_confirmar-btn", "", $_SESSION['idioma']); ?></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!--Modal estas seguro de confirmar pedido repetido interno?-->
    <div class="modal fade" id="confirmaRepetido" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  container">
                    <div class="">
                        <p class="mb-3">
                            <?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_confirmar-p", "", $_SESSION['idioma']); ?>
                        </p>
                        <p class="title-paso-configurator"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_confirmar-p3", "", $_SESSION['idioma']); ?></p>

                    </div>
                    <!--Usuario comercial-->
                    <div class="m-b-30">
                        <p class="fs-configurator p-b-20 mayus title-paso-configurator">Selecciona tu usuario</p>
                        <select class="form-control" id="comercialrep" name="comercialrep" required>
                            <?php
                            try {
                                $sql = "SELECT `trabajadores_idtrabajadores`, `username` FROM `departamentos_has_trabajadores`
                                    INNER JOIN trabajadoesadministradorprograma tap ON
                                    tap.departamentos_has_trabajadores_trabajadores_idtrabajadores = departamentos_has_trabajadores.trabajadores_idtrabajadores
                                    WHERE `programas_versiones_id`= 34  ORDER BY `username`";
                                $query = $conn_prgborman->query($sql);
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                            } catch (Exception $e) {
                                header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
                            }
                            foreach ($results as $result) {
                            ?>
                                <option value="<?= $result->trabajadores_idtrabajadores; ?>"><?= $result->username ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <!--Cliente-->
                    <div class="m-b-30">
                        <p class="fs-configurator p-b-20 mayus title-paso-configurator">Selecciona el cliente</p>
                        <select class="form-control" id="clienteFPrep" name="clienteFPrep" required>
                            <?php
                            try {
                                $sql = "SELECT nombreFiscal FROM fichaempresametas ORDER BY nombreFiscal";
                                $query = $conn_formularios->query($sql);
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                            } catch (Exception $e) {
                                header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
                            }
                            foreach ($results as $result) {
                            ?>
                                <option value="<?= $result->nombreFiscal; ?>"><?= $result->nombreFiscal ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <!--Anticipo-->
                    <div class="m-b-30">
                        <p class="fs-configurator p-b-20 mayus title-paso-configurator">Anticipo</p>
                        <!--Si o no tiene anticipo-->
                        <div class="row">
                            <div class="col-2">
                                <label for="sianticiporep"><input type="radio" id="sianticiporep" name="anticiporep" value="1" />
                                    <?= buscarTexto("WEB", "generico", "si", "", $_SESSION['idioma']); ?></label>
                                <label for="noanticiporep"><input type="radio" id="noanticiporep" name="anticiporep" value="0" checked />
                                    <?= buscarTexto("WEB", "generico", "no", "", $_SESSION['idioma']); ?></label>
                            </div>
                            <div class="col-10">
                                <!--Porcentaje (decimal) del anticipo-->
                                <input type="text" class="form-control" id="porcentajeAnticipoRep" name="porcentajeAnticipoRep" placeholder="Ejemplo: 0.1" value="" disabled>
                            </div>
                        </div>
                    </div>
                    <!--¿Necesitas comentarnos algo?-->
                    <div class="m-b-30">
                        <p class="fs-configurator p-b-20 mayus title-paso-configurator"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_confirmar-p2", "", $_SESSION['idioma']); ?></p>
                        <textarea class="single-textarea" id="comentariorep" name="comentariorep"></textarea>
                    </div>
                    <button type="button" id="btnSiConfirmaRepetido" class="btn btn-primary mt-2 text-white">
                        <span class="button__text"> <?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_confirmar-btn", "", $_SESSION['idioma']); ?></span>
                    </button>
                </div>
            </div>
        </div>
    </div>



    <!--Modal estas seguro de eliminar pedido?-->
    <div class="modal fade" id="estasSeguroEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>


                </div>
                <div class="modal-body  container">
                    <form id="formEliminar" action="DAOs/historial-pedidosDAO.php?pag=<?= buscarTexto("WEB", "paginas", "historial-pedidos", "", $_SESSION['idioma']); ?>" method="POST">
                        <div class="">
                            <p class="mb-3"><?= buscarTexto("WEB", "historial-pedidos", "hp_modal_p1", "", $_SESSION['idioma']); ?></p>
                            <p class="mb-3 help-block"><?= buscarTexto("WEB", "errores", "txt-info-eliminartodo", "", $_SESSION['idioma']); ?></p>

                            <input name="idPedidoEliminar" id="idPedidoEliminar" value="" hidden>
                            <?php foreach ($results_h as $result) { ?>
                                <div class="lineasEliminar lineaEliminar_<?= $result->idpedidos ?>">
                                    <input checked id="checkLineasEliminar" type="checkbox" class="form-check-input checkLineasEliminar checkLineaEliminar_<?= $result->idpedidos ?>" name="checkLineasEliminar[]" type="checkbox" value="<?= $result->idlineaPedido ?>"><?= $result->nombrepersonalizacion ?>
                                    <br>
                                </div>
                            <?php } ?>
                        </div>
                        <div id="footModal" class="modal-footer">
                            <button id="btnEliminar" type="btn" class="btn-rechazar-pedidos mt-2 text-white">
                                <span class="button__text"> <?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_eliminar-btn", "", $_SESSION['idioma']); ?></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Modal informacion del estado-->
    <div class="modal fade" id="informacion-estado" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-body  container">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="">
                        <p id="texto-m-estado" class="mb-3"></p>
                        <p id="texto-m-estado-2" class="mb-3"></p>
                        <p id="texto-m-estado-3" class="mb-3"></p>
                        <p id="texto-m-estado-4" class="mb-3"></p>
                        <p class="mb-3">
                            <?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_detped-p1", "", $_SESSION['idioma']); ?> <a class="links" id="link_ancla" href="infografia"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_detped-p1.1", "", $_SESSION['idioma']); ?></a>.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--Modal estas seguro de anular?-->
    <div class="modal fade" id="estasSeguroAnular" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body  container">
                    <div class="">
                        <p class="mb-3">
                            <?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_anular-p", "", $_SESSION['idioma']); ?>
                        </p>
                        <form id="formanular" action="DAOs/historial-pedidosDAO.php?pag=<?= basename($_SERVER['REQUEST_URI']) ?>" method="post">
                            <label><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_bcto-?anular", "", $_SESSION['idioma']); ?></label>
                            <input type="text" name="idPedidoA" id="idPedidoA" value="" hidden>
                            <input type="text" name="anotacionesA" class="single-textarea" value="" required><br>
                            <button id="btnAnular" type="submit" class="btn btn-primary m-3">
                                <span class="button__text"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_anular-btn", "", $_SESSION['idioma']); ?></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Modal repetir pedido?-->
    <?php
    try {
        $sql = "SELECT pedidos.numeroPedido, pedidos.nombrepedido, lineapedido.* 
        FROM lineapedido 
        INNER JOIN pedidos ON lineapedido.pedidos_idpedidos = pedidos.idpedidos 
        WHERE pedidos.estado = 'Enviando' AND lineapedido.nombrepersonalizacion <> 'Muestrario' AND lineapedido.nombrepersonalizacion <> 'Muestra individual'
        AND pedidos.numeroPedido <> 'repetido' ";
        if (!(isset($_SESSION['interno']) && $_SESSION['interno'])) {
            $sql .= " AND usuarios_id=" . $_SESSION['ID'];
        }
        $query = $conn->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        // header("location: error?msg=" . $e->getCode());
        // header("location: error?msg=" . $e->getMessage());
    }
    $cantidad_minima = 0;
    $cantidad_maxima = 0;
    ?>
    <div class="modal fade" id="repetirPedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>


                </div>
                <div class="modal-body  container">
                    <div class="">
                        <p class="mb-3">
                            <?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_repetir-p", "", $_SESSION['idioma']); ?>
                        </p>
                        <p class="mb-3">
                            <?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_repetir-p-2", "", $_SESSION['idioma']); ?>
                        </p>
                    </div>
                    <div class="text-center">
                        <label class="p-b-5">Busca por nombre o número de diseño</label>
                        <input type="text" id="repetir" placeholder="<?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_placeholder-buscador", "", $_SESSION['idioma']); ?>" class="nice-select m-b-30">
                    </div>
                    <form id="formrepetir" action="DAOs/historial-pedidosDAO.php?pag=<?= basename($_SERVER['REQUEST_URI']) ?>" method="post">
                        <div class="row">
                            <div id="masDeUnaLinea" class="col-lg-6 col-md-6 este" style="height:auto">
                                <p class="fs-configurator"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_repetir-p1", "", $_SESSION['idioma']); ?></p>
                                <?php foreach ($results as $result => $pedidos) {                        ?>
                                    <div class="pedidosFinalizados pedido_<?= $result ?> m-l-30 mb-5">
                                        <?php foreach ($pedidos as $pedido) {
                                            switch ($pedido['productos_has_colores_id']) {
                                                case '1676':
                                                case '2138':
                                                case '2292':
                                                case '2446':
                                                case '2600':
                                                case '3784':
                                                case '2908':
                                                case '2754':
                                                case '3681':
                                                case '3672':
                                                case '3062':
                                                case '3216':
                                                    $cantidad_minima = 100;
                                                    $cantidad_maxima = 2999;
                                                    break;
                                                case '1984':
                                                case '3679':
                                                case '3680':
                                                case '3524':
                                                case '306':
                                                case '1830':
                                                case '3370':
                                                    $cantidad_minima = 100;
                                                    break;
                                                case '3709':
                                                case '3736':
                                                case '3763':
                                                case '3775':
                                                case '3776':
                                                case '3783':
                                                case '3655':
                                                case '3781':
                                                case '3782':
                                                case '3783':
                                                    $cantidad_minima = 20;
                                                    $cantidad_maxima = 999;
                                                    break;
                                                case '3785':
                                                    $cantidad_minima = 1;
                                                    $cantidad_maxima = 5999;
                                                case '3786':
                                                    $cantidad_minima = 100;
                                                    $cantidad_maxima = 5999;
                                                    break;
                                                case '3780':
                                                    $cantidad_minima = 50;
                                                    $cantidad_maxima = 2999;
                                                    break;
                                            }
                                        ?>
                                            <label class="idlbl form-check-label mb-5" data-title="<?= $pedido['nombrepersonalizacion'] ?> #<?= $pedido['idlineaPedido'] ?>">
                                                <input type="checkbox" class="lpCheck form-check-input " name="lpCheck[]" type="checkbox" value="<?= $pedido['idlineaPedido'] ?>" required>
                                                <?= $pedido['nombrepersonalizacion'] ?> #<?= $pedido['idlineaPedido'] ?>
                                                <br><br>Cantidad:
                                                <input disabled required id="input_<?= $pedido['idlineaPedido'] ?>" min="<?= $cantidad_minima ?>" <?= $cantidad_maxima != 0 ? "max=\"$cantidad_maxima\"" : "" ?> type="number" class="nice-select cantidadRepetir" name="cantidadRepetir[]">
                                                <br>Nombre diseño:
                                                <input disabled id="input2_<?= $pedido['idlineaPedido'] ?>" class="nice-select nombredisenorep" name="nombredisenorep[]">
                                                <p style="display:none;" id="resultadoNombreDiseno2" class="resultado fs-configurator-2">Nombre de diseño ya existe.</p>
                                            </label>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="col-lg-6 col-md-6 ">
                                <p class="mb-3 verde-color"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_mensaje-add", "", $_SESSION['idioma']); ?></p>
                                <p class="mb-3 text-modal"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_nomped", "", $_SESSION['idioma']); ?>:</p>
                                <input class="nice-select-p" id="pstNombrePed" name="pstNombrePed" value="">
                                <p class="p-tb-20 fs-configurator-2" id="nombre_repetido" style="display:none;"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_mensaje-existe", "", $_SESSION['idioma']); ?></p>
                            </div>
                            <div id="footModal" class="modal-footer">
                                <button type="submit" id="btnSiRepetir" class="btn btn-primary mt-2 text-white">
                                    <span class="button__text"><?= buscarTexto("WEB", "historial-pedidos", "hp_v-modal_repetir-btn", "", $_SESSION['idioma']); ?></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#sianticipo').on('click', function() {
            if ($('#sianticipo').is(':checked')) {
                $('#porcentajeAnticipo').prop('disabled', false);
            } else {
                $('#porcentajeAnticipo').prop('disabled', true);
            }
        });

        $('#noanticipo').on('click', function() { //Reinicio valores
            if ($('#sianticipo').is(':checked')) {
                $('#porcentajeAnticipo').prop('disabled', false);
            } else {
                $('#porcentajeAnticipo').prop('disabled', true);
            }
        });

        $('#sianticiporep').on('click', function() {
            if ($('#sianticiporep').is(':checked')) {
                $('#porcentajeAnticipoRep').prop('disabled', false);
            } else {
                $('#porcentajeAnticipoRep').prop('disabled', true);
            }
        });

        $('#noanticiporp').on('click', function() { //Reinicio valores
            if ($('#sianticiporep').is(':checked')) {
                $('#porcentajeAnticipoRep').prop('disabled', false);
            } else {
                $('#porcentajeAnticipoRep').prop('disabled', true);
            }
        });


        $("#repetir").keyup(function() {
            input = document.getElementById("repetir");
            filter = input.value.toUpperCase();
            div = document.getElementsByClassName("idlbl");

            //Recorriendo elementos a filtrar mediante los "div"
            for (i = 0; i < div.length; i++) {
                textValue = div[i].getAttribute('data-title'); //El valor de lo que busco

                if (textValue.toUpperCase().indexOf(filter) > -1) {
                    div[i].style.display = "";
                } else {
                    div[i].style.display = "none";
                }
            }
        });
        $("#pstNombrePed").keyup(function() {
            $.ajax({ //Peticion de ajax
                method: "POST",
                url: "functions.php",
                data: {
                    nombrePedidoExiste: $("#pstNombrePed").val()
                }
            }).done(function(response) {
                // console.log("Re: " + response);
                if (response.trim() == "1") { //true = nombre ya existe, saco error
                    $('#nombre_repetido').show();
                    $('#btnSiRepetir').prop("disabled", true);
                } else {
                    $('#nombre_repetido').hide();
                    $('#btnSiRepetir').prop("disabled", false);
                }
            });
        });

        //nombre personalizacion
        $(".nombredisenorep").keyup(function(event) {
            $.ajax({ //Peticion de ajax
                method: "POST",
                url: "functions.php",
                data: {
                    nombreDisenoExiste: $(".nombredisenorep").val()
                }
            }).done(function(response) {
                // console.log("Re: " + response);
                if (response.trim() == "1") { //true = nombre ya existe, saco error
                    $('#resultadoNombreDiseno2').show();
                    $('#btnSiRepetir').prop("disabled", true);
                } else {
                    $('#resultadoNombreDiseno2').hide();
                    $('#btnSiRepetir').prop("disabled", false);
                }
            });
        });

        $.validator.setDefaults({
            submitHandler: function() {
                $('#btnAnular').addClass("button--loading");
                $('#btnAnular').prop("disabled", true);

                $('#btnSiRepetir').addClass("button--loading");
                $('#btnSiRepetir').prop("disabled", true);

                $('#formanular').submit();
                $('#formrepetir').submit();
            }
        });


        //Modal diseñador------------------------------------------------------------------------------
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption_img");

        function imagenAbrirModal(imgMdl) {
            modal.style.display = "block";
            modalImg.src = imgMdl.src;
            captionText.innerHTML = imgMdl.alt;
        }

        // Get the <span> element that closes the modal
        // When the user clicks on <span> (x), close the modal
        function cerrarModal() {
            modal.style.display = "none";
        }
        //Modal cliente------------------------------------------------------------------------------
        var modal2 = document.getElementById("myModal2");
        var modalImg2 = document.getElementById("img02");
        var captionText2 = document.getElementById("caption_img2");

        function imagenAbrirModal2(imgMdl) {
            modal2.style.display = "block";
            modalImg2.src = imgMdl.src;
            captionText2.innerHTML = imgMdl.alt;
        }

        function cerrarModal2() {
            modal2.style.display = "none";
        }

        $(document).ready(function() {

            $("#formanular").validate({
                rules: {
                    anotacionesA: "required",
                },
                messages: {
                    anotacionesA: $('#err_anular').text(),
                },
                errorElement: "em",
                errorPlacement: function(error, element) {
                    // Add the `help-block` class to the error element
                    error.addClass("help-block");

                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.parent("label"));
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).parents(".col-sm-5").addClass("has-error").removeClass("has-success");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).parents(".col-sm-5").addClass("has-success").removeClass("has-error");
                }
            });

            $("#formrepetir").validate({
                rules: {
                    "lpCheck[]": "required",
                    "cantidadRepetir[]": {
                        required: true
                    }
                },
                messages: {
                    "lpCheck[]": $('#err_checkper').text() + "<br>",
                    "cantidadRepetir[]": {
                        required: $('#err_cantper').text(),
                        min: jQuery.validator.format($('#err_cant2').text() + " {0}"),
                        max: jQuery.validator.format($('#err_cant1').text() + " {0}")
                    }
                },
                errorElement: "em",
                errorPlacement: function(error, element) {
                    // Add the `help-block` class to the error element
                    error.addClass("help-block");
                    error.insertBefore(element);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).parents(".col-sm-5").addClass("has-error").removeClass("has-success");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).parents(".col-sm-5").addClass("has-success").removeClass("has-error");
                }
            });
        });

        $('.lpCheck').on('click', function() {
            if ($(this).is(':checked')) {
                $('#input_' + $(this).val()).prop('disabled', false);
                $('#input2_' + $(this).val()).prop('disabled', false);
            } else {
                $('#input_' + $(this).val()).prop('disabled', true);
                $('#input2_' + $(this).val()).prop('disabled', true);
            }
        });
        // https://parzibyte.me/blog/2018/01/22/imprimir-contenido-div-html-javascript/
        function imprSelec(detalles) {
            var documento = "";

            var ficha = document.getElementById(detalles);

            var d = new Date();
            var p = document.getElementById('txt');
            var fecha = d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' ' + d.getHours() + ':' + d.getMinutes();

            var ventimp = window.open('Personalizaciones-textiles', '_blank', 'height=400,width=600');
            ventimp.document.write("<!DOCTYPE html><html><head><title>Personalizaciones textiles</title>" +
                "<link rel='stylesheet' href='assets/css/mi.css'>" +
                "<link rel='stylesheet' href='assets/css/style.css'>" +
                "<link rel='stylesheet' href='assets/css/util.css'>" +
                "<link rel='stylesheet' href='assets/css/bootstrap.min.css'>" +
                "<style>" +
                ".flex-container {" +
                "display: flex;" +
                "flex-flow: column wrap;" +
                "align-content: flex-end;" +
                "}" +
                ".flex-container > div {" +
                "width: 100px;" +
                "margin: 10px;" +
                "text-align: center;" +
                "line-height: 75px;" +
                "font-size: 30px;" +
                "}" +
                "</style>" +
                "</head>" +
                "<body>" +
                "<div class='container'>" +
                "<div class='row pb-20'>" +
                "<div class='col-2'>" +
                "<img src='assets/img/logo/logo.png' alt=''>" +
                "</div>" +
                "<div class='col-4 cabeceraPdf'>" +
                "<p>BORMAN INDUSTRIA TEXTIL, S.L." +
                "<br>C.I.F - B99117996" +
                "<br>c/ Burtina, nº12 - Pol. Ind. Plaza" +
                "<br>50197 - Zaragoza (España)" +
                "</p>" +
                "</div>" +
                "<div class='col-4 cabeceraPdf'>" +
                "<p>Tel. (34) 976 125 159" +
                "<br>ventas@personalizacionestextiles.com" +
                "<br>www.personalizacionestextiles.com" +
                "</p>" +
                "</div>" +
                "<div class='col-2 flex-container'>" +
                "<p id='txt'>" + fecha + "</p>" +
                "</div>" +
                "</div>" +
                ficha.innerHTML +
                "</div>" +
                "</body></html>");
            ventimp.document.close();
            ventimp.focus();
            ventimp.print();
            // ventimp.close();
            return true;

        }


        $('.fila_hc').on('click', function() { //Mantener coloreada la fila que se selecciona
            $(".fila_hc").removeClass("fila_hc_seleccionada");
            $(this).addClass("fila_hc_seleccionada");

            $('#div_tabla1').removeClass("col-lg-12").addClass("col-lg-8");
        });

        $(document).on('click', '#btnEliminar', function() {
            $('#btnEliminar').addClass("button--loading");
            $('#btnEliminar').prop("disabled", true);

            $('#formEliminar').submit();
        });
    </script>
    <script>
        /* Documentation for this tablesorter FORK can be found at
         * http://mottie.github.io/tablesorter/docs/
         */
        $(function() {
            $('table').tablesorter({

                // *** APPEARANCE ***
                // Add a theme - 'blackice', 'blue', 'dark', 'default', 'dropbox',
                // 'green', 'grey' or 'ice' stylesheets have all been loaded
                // to use 'bootstrap' or 'jui', you'll need to include "uitheme"
                // in the widgets option - To modify the class names, extend from
                // themes variable. Look for "$.extend($.tablesorter.themes.jui"
                // at the bottom of this window
                // this option only adds a table class name "tablesorter-{theme}"
                theme: 'blackice',

                // fix the column widths
                widthFixed: false,

                // Show an indeterminate timer icon in the header when the table
                // is sorted or filtered
                showProcessing: false,

                // header layout template (HTML ok); {content} = innerHTML,
                // {icon} = <i/> (class from cssIcon)
                headerTemplate: '{content}{icon}',

                // return the modified template string
                onRenderTemplate: null, // function(index, tmpl){ return tmpl; },

                // called after each header cell is rendered, use index to target
                // the column customize header HTML
                onRenderHeader: function(index) {
                    // the span wrapper is added by default
                    $(this)
                        .find('div.tablesorter-header-inner')
                        .addClass('roundedCorners');
                },

                // *** FUNCTIONALITY ***
                // prevent text selection in header
                cancelSelection: true,

                // add tabindex to header for keyboard accessibility
                tabIndex: true,

                // other options: "ddmmyyyy" & "yyyymmdd"
                dateFormat: "mmddyyyy",

                // The key used to select more than one column for multi-column
                // sorting.
                sortMultiSortKey: "shiftKey",

                // key used to remove sorting on a column
                sortResetKey: 'ctrlKey',

                // false for German "1.234.567,89" or French "1 234 567,89"
                usNumberFormat: true,

                // If true, parsing of all table cell data will be delayed
                // until the user initializes a sort
                delayInit: false,

                // if true, server-side sorting should be performed because
                // client-side sorting will be disabled, but the ui and events
                // will still be used.
                serverSideSorting: false,

                // default setting to trigger a resort after an "update",
                // "addRows", "updateCell", etc has completed
                resort: true,

                // *** SORT OPTIONS ***
                // These are detected by default,
                // but you can change or disable them
                // these can also be set using data-attributes or class names
                headers: {
                    // set "sorter : false" (no quotes) to disable the column
                    0: {
                        sorter: "text"
                    },
                    1: {
                        sorter: "text"
                    }
                },

                // ignore case while sorting
                ignoreCase: true,

                // forces the user to have this/these column(s) sorted first
                sortForce: null,
                // initial sort order of the columns,
                // example sortList: [[0,0],[1,0]],
                // [[columnIndex, sortDirection], ... ]
                sortList: [

                ],
                // default sort that is added to the end of the users sort
                // selection.
                sortAppend: null,

                // when sorting two rows with exactly the same content,
                // the original sort order is maintained
                sortStable: false,

                // starting sort direction "asc" or "desc"
                sortInitialOrder: "desc",

                // Replace equivalent character (accented characters) to allow
                // for alphanumeric sorting
                sortLocaleCompare: false,

                // third click on the header will reset column to default - unsorted
                sortReset: false,

                // restart sort to "sortInitialOrder" when clicking on previously
                // unsorted columns
                sortRestart: false,

                // sort empty cell to bottom, top, none, zero, emptyMax, emptyMin
                emptyTo: "bottom",

                // sort strings in numerical column as max, min, top, bottom, zero
                stringTo: "max",

                // colspan cells in the tbody will have duplicated content in the
                // cache for each spanned column
                duplicateSpan: true,

                // extract text from the table
                textExtraction: {
                    0: function(node, table) {
                        // this is how it is done by default
                        return $(node).attr(table.config.textAttribute) ||
                            node.textContent ||
                            node.innerText ||
                            $(node).text() ||
                            '';
                    },
                    1: function(node) {
                        return $(node).text();
                    }
                },

                // data-attribute that contains alternate cell text
                // (used in default textExtraction function)
                textAttribute: 'data-text',

                // use custom text sorter
                // function(a,b){ return a.sort(b); } // basic sort
                textSorter: null,

                // choose overall numeric sorter
                // function(a, b, direction, maxColumnValue)
                numberSorter: null,

                // *** WIDGETS ***
                // apply widgets on tablesorter initialization
                initWidgets: true,

                // table class name template to match to include a widget
                widgetClass: 'widget-{name}',

                // include zebra and any other widgets, options:
                // 'columns', 'filter', 'stickyHeaders' & 'resizable'
                // 'uitheme' is another widget, but requires loading
                // a different skin and a jQuery UI theme.
                widgets: ['zebra', 'columns'],

                widgetOptions: {

                    // *** COLUMNS WIDGET ***
                    // change the default column class names primary is the 1st column
                    // sorted, secondary is the 2nd, etc
                    columns: [
                        "primary",
                        "secondary",
                        "tertiary"
                    ],

                    // If true, the class names from the columns option will also be added
                    // to the table tfoot
                    columns_tfoot: true,

                    // If true, the class names from the columns option will also be added
                    // to the table thead
                    columns_thead: true,

                    // *** FILTER WIDGET ***
                    // css class name added to the filter cell (string or array)
                    filter_cellFilter: '',

                    // If there are child rows in the table (rows with class name from
                    // "cssChildRow" option) and this option is true and a match is found
                    // anywhere in the child row, then it will make that row visible;
                    // default is false
                    filter_childRows: false,

                    // ( filter_childRows must be true ) if true = search
                    // child rows by column; false = search all child row text grouped
                    filter_childByColumn: false,

                    // if true, include matching child row siblings
                    filter_childWithSibs: true,

                    // if true, allows using '#:{query}' in AnyMatch searches
                    // ( column:query )
                    filter_columnAnyMatch: true,

                    // If true, a filter will be added to the top of each table column.
                    filter_columnFilters: true,

                    // css class name added to the filter row & each input in the row
                    // (tablesorter-filter is ALWAYS added)
                    filter_cssFilter: '',

                    // data attribute in the header cell that contains the default (initial)
                    // filter value
                    filter_defaultAttrib: 'data-value',

                    // add a default column filter type "~{query}" to make fuzzy searches
                    // default; "{q1} AND {q2}" to make all searches use a logical AND.
                    filter_defaultFilter: {},

                    // filters to exclude, per column
                    filter_excludeFilter: {},

                    // jQuery selector string (or jQuery object)
                    // of external filters
                    filter_external: '',

                    // class added to filtered rows; needed by pager plugin
                    filter_filteredRow: 'filtered',

                    // add custom filter elements to the filter row
                    filter_formatter: null,

                    // Customize the filter widget by adding a select dropdown with content,
                    // custom options or custom filter functions;
                    // see http://goo.gl/HQQLW for more details
                    filter_functions: null,

                    // hide filter row when table is empty
                    filter_hideEmpty: true,

                    // Set this option to true to hide the filter row initially. The row is
                    // revealed by hovering over the filter row or giving any filter
                    // input/select focus.
                    filter_hideFilters: false,

                    // Set this option to false to keep the searches case sensitive
                    filter_ignoreCase: true,

                    // if true, search column content while the user types (with a delay)
                    // or, set a minimum number of characters that must be present before
                    // a search is initiated
                    filter_liveSearch: true,

                    // global query settings ('exact' or 'match'); overridden by
                    // "filter-match" or "filter-exact" class
                    filter_matchType: {
                        'input': 'exact',
                        'select': 'exact'
                    },

                    // a header with a select dropdown & this class name will only show
                    // available (visible) options within the drop down
                    filter_onlyAvail: 'filter-onlyAvail',

                    // default placeholder text (overridden by any header
                    // "data-placeholder" setting)
                    filter_placeholder: {
                        search: '',
                        select: ''
                    },

                    // jQuery selector string of an element used to reset the filters.
                    filter_reset: null,

                    // Reset filter input when the user presses escape
                    // normalized across browsers
                    filter_resetOnEsc: true,

                    // Use the $.tablesorter.storage utility to save the most recent filters
                    filter_saveFilters: false,

                    // Delay in milliseconds before the filter widget starts searching;
                    // This option prevents searching for every character while typing
                    // and should make searching large tables faster.
                    filter_searchDelay: 300,

                    // allow searching through already filtered rows in special
                    // circumstances; will speed up searching in large tables if true
                    filter_searchFiltered: true,

                    // include a function to return an array of values to be added to the
                    // column filter select
                    filter_selectSource: null,

                    // filter_selectSource array text left of the separator is added to
                    // the option value, right into the option text
                    filter_selectSourceSeparator: '|',

                    // Set this option to true if filtering is performed on the
                    // server-side.
                    filter_serversideFiltering: false,

                    // Set this option to true to use the filter to find text from the
                    // start of the column. So typing in "a" will find "albert" but not
                    // "frank", both have a's; default is false
                    filter_startsWith: false,

                    // If true, ALL filter searches will only use parsed data. To only
                    // use parsed data in specific columns, set this option to false
                    // and add class name "filter-parsed" to the header
                    filter_useParsedData: false,

                    // *** RESIZABLE WIDGET ***
                    // If this option is set to false, resized column widths will not
                    // be saved. Previous saved values will be restored on page reload
                    resizable: true,

                    // If this option is set to true, a resizing anchor
                    // will be included in the last column of the table
                    resizable_addLastColumn: false,

                    // Set this option to the starting & reset header widths
                    resizable_widths: [],

                    // Set this option to throttle the resizable events
                    // set to true (5ms) or any number 0-10 range
                    resizable_throttle: false,

                    // When true, the last column will be targeted for resizing,
                    // which is the same has holding the shift and resizing a column
                    resizable_targetLast: false,

                    // *** SAVESORT WIDGET ***
                    // If this option is set to false, new sorts will not be saved.
                    // Any previous saved sort will be restored on page reload.
                    saveSort: true,

                    // *** STICKYhEADERS WIDGET ***
                    // stickyHeaders widget: extra class name added to the sticky header
                    // row
                    stickyHeaders: '',

                    // jQuery selector or object to attach sticky header to
                    stickyHeaders_attachTo: null,

                    // jQuery selector or object to monitor horizontal scroll position
                    // (defaults: xScroll > attachTo > window)
                    stickyHeaders_xScroll: null,

                    // jQuery selector or object to monitor vertical scroll position
                    // (defaults: yScroll > attachTo > window)
                    stickyHeaders_yScroll: null,

                    // number or jquery selector targeting the position:fixed element
                    stickyHeaders_offset: 0,

                    // scroll table top into view after filtering
                    stickyHeaders_filteredToTop: true,

                    // added to table ID, if it exists
                    stickyHeaders_cloneId: '-sticky',

                    // trigger "resize" event on headers
                    stickyHeaders_addResizeEvent: true,

                    // if false and a caption exist, it won't be included in the
                    // sticky header
                    stickyHeaders_includeCaption: true,

                    // The zIndex of the stickyHeaders, allows the user to adjust this
                    // to their needs
                    stickyHeaders_zIndex: 2,

                    // *** STORAGE WIDGET ***
                    // allows switching between using local & session storage
                    storage_useSessionStorage: false,
                    // alternate table id (set if grouping multiple tables together)
                    storage_tableId: '',
                    // table attribute to get the table ID, if storage_tableId
                    // is undefined
                    storage_group: '', // defaults to "data-table-group"
                    // alternate url to use (set if grouping tables across
                    // multiple pages)
                    storage_fixedUrl: '',
                    // table attribute to get the fixedUrl, if storage_fixedUrl
                    // is undefined
                    storage_page: '',

                    // *** ZEBRA WIDGET ***
                    // class names to add to alternating rows
                    // [ "even", "odd" ]
                    zebra: [
                        "even",
                        "odd"
                    ]

                },

                // *** CALLBACKS ***
                // function called after tablesorter has completed initialization
                initialized: null, // function (table) {}

                // *** extra css class names
                tableClass: '',
                cssAsc: '',
                cssDesc: '',
                cssNone: '',
                cssHeader: '',
                cssHeaderRow: '',
                // processing icon applied to header during sort/filter
                cssProcessing: '',

                // class name indiciating that a row is to be attached to its
                // parent
                cssChildRow: 'tablesorter-childRow',
                // don't sort tbody with this class name
                // (only one class name allowed here!)
                cssInfoBlock: 'tablesorter-infoOnly',
                // class name added to element inside header; clicking on it
                // won't cause a sort
                cssNoSort: 'tablesorter-noSort',
                // header row to ignore; cells within this row will not be added
                // to table.config.$headers
                cssIgnoreRow: 'tablesorter-ignoreRow',

                // if this class does not exist, the {icon} will not be added from
                // the headerTemplate
                cssIcon: 'tablesorter-icon',
                // class name added to the icon when there is no column sort
                cssIconNone: '',
                // class name added to the icon when the column has an ascending sort
                cssIconAsc: '',
                // class name added to the icon when the column has a descending sort
                cssIconDesc: '',

                // *** header events ***
                pointerClick: 'click',
                pointerDown: 'mousedown',
                pointerUp: 'mouseup',

                // *** SELECTORS ***
                // jQuery selectors used to find the header cells.
                selectorHeaders: '> thead th, > thead td',

                // jQuery selector of content within selectorHeaders
                // that is clickable to trigger a sort.
                selectorSort: "th, td",

                // rows with this class name will be removed automatically
                // before updating the table cache - used by "update",
                // "addRows" and "appendCache"
                selectorRemove: ".remove-me",

                // *** DEBUGING ***
                // send messages to console
                debug: false

            });
        });

        // Extend the themes to change any of the default class names
        // this example modifies the jQuery UI theme class names
        $.extend($.tablesorter.themes.jui, {
            /* change default jQuery uitheme icons - find the full list of icons
            here: http://jqueryui.com/themeroller/
            (hover over them for their name)
            */
            // table classes
            table: 'ui-widget ui-widget-content ui-corner-all',
            caption: 'ui-widget-content',
            // *** header class names ***
            // header classes
            header: 'ui-widget-header ui-corner-all ui-state-default',
            sortNone: '',
            sortAsc: '',
            sortDesc: '',
            // applied when column is sorted
            active: 'ui-state-active',
            // hover class
            hover: 'ui-state-hover',
            // *** icon class names ***
            // icon class added to the <i> in the header
            icons: 'ui-icon',
            // class name added to icon when column is not sorted
            iconSortNone: 'ui-icon-carat-2-n-s',
            // class name added to icon when column has ascending sort
            iconSortAsc: 'ui-icon-carat-1-n',
            // class name added to icon when column has descending sort
            iconSortDesc: 'ui-icon-carat-1-s',
            filterRow: '',
            footerRow: '',
            footerCells: '',
            // even row zebra striping
            even: 'ui-widget-content',
            // odd row zebra striping
            odd: 'ui-state-default'
        });
    </script>