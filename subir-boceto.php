<?php
require_once('includes/config.php');
include("pedidos.php");
include("functions.php");
include("includes/idioma.php");
if (!isset($_SESSION['resultadoTraduccionPertex'])) {
    $_SESSION['resultadoTraduccionPertex'] = llamadoInicial($_SESSION['idioma']);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
?>

    <!doctype html>
    <html class="no-js" lang="zxx">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon-1.png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/flaticon.css">
        <link rel="stylesheet" href="assets/css/slicknav.css">
        <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="assets/css/themify-icons.css">
        <link rel="stylesheet" href="assets/css/nice-select.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/imprimir.css" media="print">
        <link rel="stylesheet" href="assets/css/util.css">
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="assets/css/mi.css">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>

    <body>
        <?php
        include("errores.php");
        ?>
        <div id="preloader-active">
            <div class="preloader d-flex align-items-center justify-content-center">
                <div class="preloader-inner position-relative">
                    <div class="preloader-circle"></div>
                    <div class="preloader-img pere-text">
                        <img src="assets/img/logo/logo.png" alt="">
                    </div>
                </div>
            </div>
        </div>

        <header>
            <div class="header-area">
                <div class="main-header ">
                    <div class="header-bottom">
                        <div class="container-fluid">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-3">
                                    <div class="logo">
                                        <a href="."><img src="assets/img/logo/logo.png" alt=""></a>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="mobile_menu d-block d-lg-none"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="container mt-30 p-all-30">
            <?php
            $sql = "SELECT idlineaPedido, numReferencia
            FROM lineapedido WHERE pedidos_idpedidos = " . $_GET['nped'];
            $query = $conn->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ); ?>
            <h2 class="text-center mb-5">Sube los bocetos del PEDIDO #<?= $_GET['nped'] ?></h2><br>
            <form id="formSubirBoceto" action="subir-bocetoDAO.php" method="post" enctype="multipart/form-data">
                <div class="row ">
                    <input name="numPed" id="numPed" type="text" value="<?= $_GET['nped'] ?>" hidden>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <!--Numero de diseño-->
                                <label class="mb-5" for="numPer">Número de diseño:</label>
                            </div>
                            <div class="col-md-6">
                                <select class="mb-3 nice-select" required name="numPer" id="numPer" type="text">
                                    <option value="">---</option>
                                    <?php
                                    foreach ($results as $result) {
                                    ?>
                                        <option value="<?= $result->idlineaPedido ?>" class="<?= $result->numReferencia ?>"><?= $result->idlineaPedido ?></option>
                                    <?php } ?>
                                </select>
                                <input hidden name="result_linea" id="result_linea">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!--Boceto-->
                        <label class="mb-3">Boceto del diseño (.jpg):</label>
                        <label for="boceto_D" class="btn-fino mt-2"><?= buscarTexto("WEB", "personaliza-tu-producto", "ptp_confirma-prop-intelectual-btn", "", $_SESSION['idioma']); ?></label>
                        <input style="visibility:hidden;" name="boceto_D" id="boceto_D" type="file" accept=".jpg" />
                        <div class="m-tb-10">
                            <img style="max-width: 100px;" id="pre_boceto">
                        </div>
                    </div>
                    <div class="p-all-30">
                        <button type="submit" class="btn-fino  mt-20">Subir boceto</button>
                    </div>
                </div>
            </form>
        </div>

        <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
        <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="./assets/js/popper.min.js"></script>
        <script src="./assets/js/bootstrap.min.js"></script>
        <script src="./assets/js/jquery.slicknav.min.js"></script>
        <script src="./assets/js/jquery.scrollUp.min.js"></script>
        <script src="./assets/js/jquery.form.js"></script>
        <script src="./assets/js/jquery.validate.min.js"></script>
        <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
        <script src="./assets/js/cookies.js"></script>
        <script src="./assets/js/personalizar.js"></script>
        <script src="./assets/js/main.js"></script>
        <script src="./assets/js/historial-pedidos.js"></script>
        <script src="./assets/js/direcciones.js"></script>
        <script src="./assets/js/personas-contacto.js"></script>
        <script src="./assets/js/pasarela-pago.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/pselect.js@4.0.1/dist/pselect.min.js"></script>
        <script type="text/javascript" src="https://mottie.github.io/tablesorter/js/jquery.tablesorter.js"></script>
        <script type="text/javascript" src="https://mottie.github.io/tablesorter/js/jquery.tablesorter.widgets.js"></script>
        <script type="text/javascript" src="https://mottie.github.io/tablesorter/addons/pager/jquery.tablesorter.pager.js"></script>
        <script>
            $('#numPer').on('change', function() {
                $('#numRef').val($('select[name="numPer"] :selected').attr('class'));
            });
            $.validator.setDefaults({
                submitHandler: function() {
                    $("#formSubirBoceto").submit();
                }
            });

            $(document).ready(function() {
                $("#formSubirBoceto").validate({
                    rules: {
                        numPer: {
                            required: true
                        }
                    },
                    messages: {
                        numPer: {
                            required: "Indica el número de diseño."
                        },
                    },
                    errorElement: "em",
                    errorPlacement: function(error, element) {
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

            });
            //Verifica el archivo subido
            $(document).on('change', 'input[type="file"]', function() {
                var error = false;
                var fileName = this.files[0].name;
                var fileSize = this.files[0].size;

                if (fileSize > 1e+8) { //Tamaño del archivo
                    alert($('#err_p1').text());
                    this.value = '';
                    this.files[0].name = '';
                    error = true;
                } else {
                    var ext = fileName.split('.').pop();
                    ext = ext.toLowerCase();
                    switch (ext) { //Extensiones permitidas
                        case 'jpg':
                            break;
                        default:
                            alert($('#err_p2').text());
                            this.value = ''; // reset del valor
                            this.files[0].name = '';
                            error = true;
                    }
                }

                if (error == false) {
                    var reader = new FileReader(); //Leemos el contenido
                    reader.onload = function(e) { //Asigno valores
                        //Al cargar el contenido lo pasamos como atributo de la imagen de arriba
                        $('#pre_boceto').attr('src', e.target.result);
                        ///////////////////////////////////////////////////
                        $('#imagenPrevMsj').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        </script>
    </body>

    </html>
<?php
} else {
    header('Location: 404');
    exit();
}
?>