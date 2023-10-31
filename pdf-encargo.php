<?php
require_once('includes/config.php');
require_once('funciones/functions.php');
require_once('assets/_partials/idioma.php');

$fecha = date("d/m/Y H:i", time());
// Obtengo el id del pedido y sus datos

$sql = "SELECT e.id_diseno, e.subtotal, e.nota, e.ancho_cm, e.alto_cm, 
e.cantidad, e.ancho_cm_base, e.alto_cm_base, e.cantidad_topes, p.nombre as producto, p.colores_limitados, f.nombre as formas, c.nombre as complemento,
id_color_complemento, id_color_metal, id_color_piel
FROM disenos e
INNER JOIN productos p ON p.id_producto = e.id_producto
LEFT JOIN formas f ON e.id_forma = f.id_forma
LEFT JOIN complementos c ON e.id_complemento = c.id_complemento
WHERE id_diseno = ?";
$query = $conn->prepare($sql);
$query->bindParam(1, $_SESSION['id_ultimo_diseno'], PDO::PARAM_INT);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);

$id = $producto = $comentarios = $ancho = $alto = $forma = $subtotal = $cantidad = $anchoBase = $altoBase = $cantidadTopes = $complemento = "";
$id_color_complemento = $id_color_metal = $id_color_piel = null;
$colores_limitados = 0;
foreach ($results as $result) {
    $id = $result->id_diseno;
    $producto = $result->producto;
    $comentarios = $result->nota;
    $ancho = $result->ancho_cm;
    $alto = $result->alto_cm;
    $forma = $result->formas;
    $subtotal = $result->subtotal;
    $cantidad = $result->cantidad;
    $anchoBase = $result->ancho_cm_base;
    $altoBase = $result->alto_cm_base;
    $cantidadTopes = $result->cantidad_topes;
    $complemento = $result->complemento;
    $id_color_complemento = $result->id_color_complemento;
    $id_color_metal = $result->id_color_metal;
    $id_color_piel = $result->id_color_piel;
    $colores_limitados = $result->colores_limitados;
}

//Colores
$lista_colores = [];
if ($colores_limitados = 1) {
    //obtengo los id color
    $sql = "SELECT idColor FROM disenos_has_colores WHERE id_diseno=?";
    $query = $conn->prepare($sql);
    $query->bindParam(1, $id, PDO::PARAM_INT);
    $query->execute();
    $results_colores = $query->fetchAll(PDO::FETCH_OBJ);

    foreach ($results_colores as $idcolor) {
        try {
            //busco los colores 
            $sql = "SELECT nombre
            FROM colores WHERE idColor=?";
            $query = $conn_prgborman->prepare($sql);
            $query->bindParam(1, $idcolor->idColor, PDO::PARAM_INT);
            $query->execute();
            // Agregar los resultados al array
            $lista_colores[] = $query->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
        }
    }
}

$color_complemento = "";
$color_metal = "";
$color_piel = "";

//Color complemento
if ($id_color_complemento != null) {
    try {
        //busco los colores 
        $sql = "SELECT nombre
            FROM colores WHERE idColor=?";
        $query = $conn_prgborman->prepare($sql);
        $query->bindParam(1, $id_color_complemento, PDO::PARAM_INT);
        $query->execute();
        $color_complemento = $query->fetchColumn();
    } catch (Exception $e) {
    }
}

//Color piel
if ($id_color_piel != null) {
    try {
        //busco los colores 
        $sql = "SELECT nombre
            FROM colores WHERE idColor=?";
        $query = $conn_prgborman->prepare($sql);
        $query->bindParam(1, $id_color_piel, PDO::PARAM_INT);
        $query->execute();
        $color_piel = $query->fetchColumn();
    } catch (Exception $e) {
    }
}

//Color metal
if ($id_color_metal != null) {
    //obtengo los id color
    try {
        //busco los colores 
        $sql = "SELECT nombre
            FROM colores WHERE idColor=?";
        $query = $conn_prgborman->prepare($sql);
        $query->bindParam(1, $id_color_metal, PDO::PARAM_INT);
        $query->execute();
        $color_metal = $query->fetchColumn();
    } catch (Exception $e) {
    }
}

// Incluye la biblioteca TCPDF
require_once('TCPDF/tcpdf.php');

// Crea una instancia de TCPDF
$pdf = new TCPDF();
$pdf->setPrintHeader(false);

// Agrega una página al PDF
$pdf->AddPage();

// Define el contenido del PDF
$content = "";

$content .= '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">';
$content .= '<link rel="stylesheet" href="assets/css/bootstrap.min.css">';
$content .= '<style>';
$content .= '.container {';
$content .= 'width: 100%;';
$content .= '}';
$content .= 'h3 {';
$content .= 'text-align: center;';
$content .= '}';
$content .= 'table {';
$content .= 'width: 100%;';
$content .= 'border-collapse: collapse;';
$content .= '}';
$content .= '.img-fluid {';
$content .= 'max-width: 100%;';
$content .= 'height: auto;';
$content .= 'display: block;';
$content .= 'margin: 0 auto;';
$content .= '}';
$content .= '.styled-table {';
$content .= 'margin-bottom: 20px;';
$content .= '}';
$content .= '.styled-table td {';
$content .= 'border: 1px solid #dee2e6;';
$content .= 'border-spacing: 30px;';
$content .= 'vertical-align: center;';
$content .= '}';
$content .= '.styled-table .table-heading {';
$content .= 'font-weight: bold;';
$content .= '}';
$content .= '.styled-table tr:ntd-child(even) {';
$content .= 'background-color: #f2f2f2;';
$content .= '}';
$content .= '.styled-table img {';
$content .= 'display: block;';
$content .= 'margin: 0 auto;';
$content .= '}';
$content .= '.tabla-cabecera {';
$content .= 'margin-bottom: 100px;';
$content .= 'font-size: 7px;';
$content .= '}';
$content .= '.tabla-cabecera td td {';
$content .= 'border: 1px solid transparent;';
$content .= 'vertical-align: center;';
$content .= '}';
$content .= '</style>';
$content .= '<div class="container">';
$content .= '<table class="tabla-cabecera">';
$content .= '<tbody>';
$content .= '<tr>';
$content .= '<td><img width="100px" height="60px" src="assets/img/logo/logo.png" alt=""></td>';
$content .= '<td>BORMAN INDUSTRIA TEXTIL, S.L.<br>C.I.F - B99117996<br>c/ Burtina, nº12 - Pol. Ind. Plaza<br>50197 - Zaragoza (España)</td>';
$content .= '<td>Tel. (34) 976 125 159<br>ventas@personalizacionestextiles.com<br>www.personalizacionestextiles.com</td>';
$content .= '<td style="text-align: right;">' . $fecha . '</td>';
$content .= '</tr>';
$content .= '</tbody>';
$content .= '</table>';
//Numero encargo
$content .= '<h3>Número de encargo: ' . $id . '</h3>';
//Subtotal encargo
$content .= '<p>Subtotal: €' .  str_replace(".", ",", $subtotal) . '</p>';
$content .= '<table class="styled-table">';
$content .= '<tbody>';
//Tecnica
$content .= '<tr>';
$content .= '<td>Técnica</td>';
$content .= '<td>' . $producto . '</td>';
$content .= '</tr>';
//Cantidad de producto
$content .= '<tr>';
$content .= '<td>Cantidad</td>';
$content .= '<td>' . $cantidad . '</td>';
$content .= '</tr>';
//Colores (limitados)
if (count($lista_colores) > 0) {
    $content .= '<tr>';
    $content .= '<td>Colores elegidos</td>';
    $content .= '<td>';
    foreach ($lista_colores as $color) {
        $content .= $color[0]->nombre . ', '; // Accede a la propiedad "nombre"
    }
    $content = rtrim($content, ', '); // Elimina la última coma y el espacio en blanco
    $content .= '</td>';
    $content .= '</tr>';
}

if ($color_piel != "") {
    //Color piel
    $content .= '<tr>';
    $content .= '<td>Color piel</td>';
    $content .= '<td>' . $color_piel . '</td>';
    $content .= '</tr>';
}

if ($color_metal != "") {
    //Color metal
    $content .= '<tr>';
    $content .= '<td>Color metal</td>';
    $content .= '<td>' . $color_metal . '</td>';
    $content .= '</tr>';
}

if ($ancho != "") {
    //Ancho
    $content .= '<tr>';
    $content .= '<td>Ancho</td>';
    $content .= '<td>' . number_format($ancho, 2, ',', '') . 'cm</td>';
    $content .= '</tr>';
}

if ($alto != "") {
    //Alto
    $content .= '<tr>';
    $content .= '<td>Alto</td>';
    $content .= '<td>' . number_format($alto, 2, ',', '') . 'cm</td>';
    $content .= '</tr>';
}

if ($forma != "") {
    //Forma
    $content .= '<tr>';
    $content .= '<td>Forma</td>';
    $content .= '<td>' . $forma . '</td>';
    $content .= '</tr>';
}

if ($complemento != "") {
    //Complemento
    $content .= '<tr>';
    $content .= '<td>Complemento</td>';
    $content .= '<td>' . $complemento . '</td>';
    $content .= '</tr>';
}

if ($anchoBase != "") {
    //Ancho cm base de tela
    $content .= '<tr>';
    $content .= '<td>Ancho base de tela</td>';
    $content .= '<td>' . number_format($anchoBase, 2, ',', '') . 'cm</td>';
    $content .= '</tr>';
}

if ($altoBase != "") {
    //Alto cm base de tela
    $content .= '<tr>';
    $content .= '<td>Alto base de tela</td>';
    $content .= '<td>' . number_format($altoBase, 2, ',', '') . 'cm</td>';
    $content .= '</tr>';
}

if ($color_complemento != "") {
    //Color complemento
    $content .= '<tr>';
    $content .= '<td>Color base</td>';
    $content .= '<td>' . $color_complemento . '</td>';
    $content .= '</tr>';
}

if ($cantidadTopes != "") {
    //Cantidad de topes
    $content .= '<tr>';
    $content .= '<td>Cantidad de topes</td>';
    $content .= '<td>' . $cantidadTopes . '</td>';
    $content .= '</tr>';
}

$imagePath = "imagenes_bocetos/D$id.jpg";
if (file_exists($imagePath)) {
    // Verificar si la imagen existe
    $content .= '<tr>';
    $content .= '<td colspan="2" style="text-align: center;">Boceto</td>';
    $content .= '</tr>';
    $content .= '<tr>';
    $content .= '<td colspan="2">';
    // La imagen existe, muestra la imagen real
    $content .= '<img class="img-fluid" src="' . $imagePath . '" alt="">';
    // $content .= '<img class="img-fluid" src="imagenes_bocetos/D' . $id . '.jpg" alt="">';
    $content .= '</td>';
    $content .= '</tr>';
}
$content .= '</tbody>';
$content .= '</table>';
$content .= '</div>';
$content .= '<script src="./assets/js/bootstrap.min.js"></script>';

// echo $content;
// Agrega el contenido al PDF
$pdf->writeHTML($content, true, false, true, false, '');

// Genera el PDF en memoria
$pdfData = $pdf->Output('', 'S'); // 'S' indica que se generará en memoria

// Envía el PDF al navegador para descargar
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="encargo_PERTEX.pdf"');
header('Cache-Control: private, max-age=0, must-revalidate');
header('Pragma: public');
echo $pdfData;
