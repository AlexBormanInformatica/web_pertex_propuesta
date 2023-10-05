<?php
require_once "includes/config.php";
include("funciones/functions.php");
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <title><?= buscarTexto("PRG", "metodospago", "2", "DescripcionPago", $_SESSION['idioma']); ?></title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">

    <?php
    include("assets/_partials/header.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    ?>
        <main>
            <div class="container">
                <div class="m-all-20 text-center">
                    <h3 class="mb-4 "><?= buscarTexto("WEB", "transferencia", "trans_tit-1", "", $_SESSION['idioma']); ?> <span class=" theme-color "> # <?= $_POST['nPedido'] ?></span></h3>
                </div>

                <div id="div_imprimir" class="row p-all-20">
                    <div class="col-md-6">
                        <div class="p-3 txt-alineado p-t-50">
                            <h4 class="mb-5"><?= buscarTexto("WEB", "transferencia", "trans_tit-3", "", $_SESSION['idioma']); ?></h4>
                            <p class=""><?= buscarTexto("WEB", "transferencia", "trans_tit-2-p1", "", $_SESSION['idioma']); ?></p>
                            <p><?= buscarTexto("WEB", "transferencia", "trans_tit-3-p1", "", $_SESSION['idioma']); ?></p>
                            <p><a class="links" href="mailto:contabilidad@bormantextil.com">contabilidad@bormantextil.com</a></p>
                            <p><?= buscarTexto("WEB", "transferencia", "trans_tit-3-p2", "", $_SESSION['idioma']); ?></p>

                            <div class="mb-5">
                                <a class="links" href="javascript:imprSelec('div_imprimir')"><i class="fas fa-print"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="bg-marino">
                            <div class="pad-tra txt-alineado">
                                <h4 class="mb-5 text-white"><?= buscarTexto("WEB", "transferencia", "trans_tit-2", "", $_SESSION['idioma']); ?></h4>
                                <p class="text-white"><?= buscarTexto("WEB", "transferencia", "trans_tit-2-p2", "", $_SESSION['idioma']); ?><strong><span id="precio"> <?= $_POST['strTotal'] ?> €</span></strong></p>
                                <p class="text-white"><?= buscarTexto("WEB", "transferencia", "trans_tit-2-p3", "", $_SESSION['idioma']); ?></p>
                                <p class="text-white"><?= buscarTexto("WEB", "transferencia", "trans_tit-2-p4", "", $_SESSION['idioma']); ?></p>
                                <p class="text-white"><?= buscarTexto("WEB", "transferencia", "trans_tit-2-p5", "", $_SESSION['idioma']); ?> <strong><?= buscarTexto("WEB", "historial-pedidos", "pdf_tit1", "", $_SESSION['idioma']); ?> #<?= $_POST['nPedido'] ?></strong></p>
                                <p class="text-white"><?= buscarTexto("WEB", "transferencia", "trans_tit-2-p6", "", $_SESSION['idioma']); ?></p>
                                <p class="text-white"><?= buscarTexto("WEB", "transferencia", "trans_tit-2-p7", "", $_SESSION['idioma']); ?></p>
                                <p class="text-white"><?= buscarTexto("WEB", "transferencia", "trans_tit-2-p8", "", $_SESSION['idioma']); ?></p>
                                <p class="text-white"><?= buscarTexto("WEB", "transferencia", "trans_tit-2-p9", "", $_SESSION['idioma']); ?></p>
                                <p class="text-white"><?= buscarTexto("WEB", "transferencia", "trans_tit-2-p10", "", $_SESSION['idioma']); ?></p>
                                <p class="text-white"><?= buscarTexto("WEB", "transferencia", "trans_tit-2-p11", "", $_SESSION['idioma']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    <?php
    } else {
        header("Location: 404");
    }
    include("assets/_partials/footer.php");
    ?>
    <script>
        function imprSelec(detalles) {
            var ficha = document.getElementById(detalles);

            var d = new Date();
            var p = document.getElementById('txt');
            var fecha = d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' ' + d.getHours() + ':' + d.getMinutes();

            var ventimp = window.open('Personalizaciones-textiles', '_blank', 'height=400,width=600');
            ventimp.document.write("<html>" +
                "<head>" +
                "<link rel=stylesheet href=assets/css/mi.css>" +
                "<link rel=stylesheet href=assets/css/style.css>" +
                "<link rel=stylesheet href=assets/css/util.css>" +
                "<link rel=stylesheet href=assets/css/bootstrap.min.css>" +
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
                "<div class='row'>" +
                "<div class='col-6'>" +
                "<img src='assets/img/logo/logo.png' alt=''>" +
                "</div>" +
                "<div class='col-6 flex-container'>" +
                "<p id='txt'>" + fecha + "</p>" +
                "</div>" +
                "</div>" +
                "<div class=''>" +
                "<div class='p-3 txt-alineado p-t-50'>" +
                "<h4 class='mb-5'><?= buscarTexto('WEB', 'transferencia', 'trans_tit-3', '', $_SESSION['idioma']); ?></h4>" +
                "<p class=''><?= buscarTexto('WEB', 'transferencia', 'trans_tit-2-p1', '', $_SESSION['idioma']); ?></p>" +
                "<p><?= buscarTexto('WEB', 'transferencia', 'trans_tit-3-p1', '', $_SESSION['idioma']); ?></p>" +
                "<p><a class='links' href='mailto:contabilidad@bormantextil.com'>contabilidad@bormantextil.com</a></p>" +
                "<p><?= buscarTexto('WEB', 'transferencia', 'trans_tit-3-p2', '', $_SESSION['idioma']); ?></p>" +
                "</div>" +
                "</div>" +
                "<div class=''>" +
                "<div>" +
                "<div class='pad-tra txt-alineado'>" +
                "<h4 class='mb-5'><?= buscarTexto('WEB', 'transferencia', 'trans_tit-2', '', $_SESSION['idioma']); ?></h4>" +
                "<p><?= buscarTexto('WEB', 'transferencia', 'trans_tit-2-p2', '', $_SESSION['idioma']); ?><strong> " + $('#precio').text() + "</strong> </p>" +
                "<p><?= buscarTexto('WEB', 'transferencia', 'trans_tit-2-p3', '', $_SESSION['idioma']); ?></p>" +
                "<p><?= buscarTexto('WEB', 'transferencia', 'trans_tit-2-p4', '', $_SESSION['idioma']); ?></p>" +
                "<p><?= buscarTexto('WEB', 'transferencia', 'trans_tit-2-p5', '', $_SESSION['idioma']); ?> <strong> <?= buscarTexto("WEB", "historial-pedidos", "pdf_tit1", "", $_SESSION['idioma']); ?> #<?= $_POST['nPedido'] ?></strong></p>" +
                "<p><?= buscarTexto('WEB', 'transferencia', 'trans_tit-2-p6', '', $_SESSION['idioma']); ?></p>" +
                "<p><?= buscarTexto('WEB', 'transferencia', 'trans_tit-2-p7', '', $_SESSION['idioma']); ?></p>" +
                "<p><?= buscarTexto('WEB', 'transferencia', 'trans_tit-2-p8', '', $_SESSION['idioma']); ?></p>" +
                "<p><?= buscarTexto('WEB', 'transferencia', 'trans_tit-2-p9', '', $_SESSION['idioma']); ?></p>" +
                "<p><?= buscarTexto('WEB', 'transferencia', 'trans_tit-2-p10', '', $_SESSION['idioma']); ?></p>" +
                "<p><?= buscarTexto('WEB', 'transferencia', 'trans_tit-2-p11', '', $_SESSION['idioma']); ?></p>" +
                "</div>" +
                "</div>" +
                "</div>" +
                "</div>" +
                "</body>" +
                "<script type='text/javascript'>" +
                "var d = new Date();" +
                "var p = document.getElementById('txt');" +
                "p.textContent = d.getDate() + '-' + d.getMonth() + '-' + d.getFullYear() + ' ' + d.getHours() + ':' + d.getMinutes();");
            ventimp.document.close();
            ventimp.focus();
            ventimp.print();
            // ventimp.close();
            return true;
        }
    </script>