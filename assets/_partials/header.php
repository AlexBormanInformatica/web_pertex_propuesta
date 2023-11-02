<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<link rel="icon" type="image/png" sizes="16x16" href="assets/favicons/favicon-16x16.png">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">
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
<link rel="stylesheet" href="assets/css/tablesorter.css">
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-SECVFXMNWB"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-SECVFXMNWB');
</script>
</head>

<body>
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
                <div class="header-top top-bg  d-lg-block">
                    <div class="container-fluid">
                        <div class="col-xl-3">
                        </div>

                        <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-left d-flex">
                                    <a class="none-mv" href="tel:0034976125159">(+34) 976 12 51 59</a>&nbsp; &nbsp;&nbsp;<a class="none-mv" href="mailto:ventas@personalizacionestextiles.com">ventas@personalizacionestextiles.com</a>
                                </div>

                                <div class="header-info-right">
                                    <ul class="text-white">

                                        <?php if ((isset($_SESSION['email'])) && ($_SESSION['email'] != "")) { ?>
                                            <li>
                                                <?php
                                                  $sql = "SELECT COUNT(id_diseno) FROM disenos WHERE estado = 'Boceto aceptado' ";
                                                  $query = $conn->prepare($sql);
                                                  $query->execute();
                                                  $count_disenos = $query->fetchColumn();
                                                ?>
                                                <a href="carrito"><i class="fas fa-shopping-cart"></i>  <span><?= $count_disenos ?></span></a>
                                            </li>
                                            <li>
                                                <a href="<?= buscarTexto("WEB", "paginas", "cuenta", "", $_SESSION['idioma']); ?>"><?= buscarTexto("WEB", "header", "header_top-4", "", $_SESSION['idioma']); ?></a>
                                            </li>
                                            <li>
                                                <div class="shopping-card" title="<?= buscarTexto("WEB", "header", "header_top-5_title", "", $_SESSION['idioma']); ?>">
                                                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
                                                </div>
                                            </li>
                                        <?php } else { ?>
                                            <li>
                                                <a href="login"><?= buscarTexto("WEB", "header", "header_top-2", "", $_SESSION['idioma']); ?> | <?= buscarTexto("WEB", "header", "header_top-3", "", $_SESSION['idioma']); ?></a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="header-bottom">
                    <div class="container-fluid">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-xl-3 col-lg-3 col-md-1 col-sm-3">
                                <div class="logo">
                                    <a href="."><img src="assets/img/logo/logo.png" alt=""></a>
                                    <div class="btn-movil ml-2">
                                        <a href="https://www.clustertextilzgz.com/CatalogoPersonalizacionesTextiles/index.html" class="btn-mv-nav">Catálogo</a>
                                        <!-- <a href="https://bormantextil.com/catalogo-borman/es-web/" class="btn-mv-nav">Hazte cliente</a> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="<?= buscarTexto("WEB", "paginas", "nosotros", "", $_SESSION['idioma']); ?>"><?= buscarTexto("WEB", "nav", "nav_nosotros", "", $_SESSION['idioma']); ?></a></li>
                                            <li><a href="#"><?= buscarTexto("WEB", "nav", "nav_tecnicas", "", $_SESSION['idioma']); ?></a>
                                                <ul class="submenu">
                                                    <li><a href="<?= buscarTexto("WEB", "paginas", "marcajes", "", $_SESSION['idioma']); ?>"><?= buscarTexto("WEB", "nav", "nav_sub-marcajes", "", $_SESSION['idioma']); ?></a></li>
                                                    <li><a href="<?= buscarTexto("WEB", "paginas", "modulos", "", $_SESSION['idioma']); ?>"><?= buscarTexto("WEB", "nav", "nav_sub-modulos", "", $_SESSION['idioma']); ?></a></li>
                                                    <li><a href="<?= buscarTexto("WEB", "paginas", "etiquetas", "", $_SESSION['idioma']); ?>"><?= buscarTexto("WEB", "nav", "nav_sub-etique", "", $_SESSION['idioma']); ?></a></li>
                                                    <li><a href="<?= buscarTexto("WEB", "paginas", "tiradores", "", $_SESSION['idioma']); ?>"><?= buscarTexto("WEB", "nav", "nav_sub-tirad", "", $_SESSION['idioma']); ?></a></li>
                                                    <li><a href="<?= buscarTexto("WEB", "paginas", "pulseras", "", $_SESSION['idioma']); ?>"><?= buscarTexto("WEB", "nav", "nav_sub-pulse", "", $_SESSION['idioma']); ?></a></li>
                                                    <li><a href="<?= buscarTexto("WEB", "paginas", "bases", "", $_SESSION['idioma']); ?>"><?= buscarTexto("WEB", "nav", "nav_sub-bases", "", $_SESSION['idioma']); ?></a></li>
                                                </ul>
                                            </li>

                                            <li><a href="https://www.clustertextilzgz.com/CatalogoPersonalizacionesTextiles/index.html" target="_blank"><?= buscarTexto("WEB", "nav", "nav_catalogo", "", $_SESSION['idioma']); ?></a></li>
                                            <li><a href="encargar-diseno"><?= buscarTexto("WEB", "general", "btn-personalizar", "", $_SESSION['idioma']); ?></a></li>
                                            <?php if ($_SESSION['idioma'] == "ES") { ?>
                                                <li><a class="pb-2" href='cambioIdioma.php?idioma=ES&name=<?php echo basename($_SERVER['REQUEST_URI']) ?>'><img src="imagenes/es.png" alt="<?= buscarTexto("WEB", "nav", "nav_altEspana", "", $_SESSION['idioma']); ?>" class="mr-3"></a>
                                                    <ul class="flag">
                                                        <li></li>
                                                        <li><a href='cambioIdioma.php?idioma=FR&name=<?php echo basename($_SERVER['REQUEST_URI']) ?>'><img src="imagenes/fr.png" alt="<?= buscarTexto("WEB", "nav", "nav_altFrancia", "", $_SESSION['idioma']); ?>" class="mr-3"></a></li>
                                                        <li><a href='cambioIdioma.php?idioma=IT&name=<?php echo basename($_SERVER['REQUEST_URI']) ?>'><img src="imagenes/it.png" alt="<?= buscarTexto("WEB", "nav", "nav_altItalia", "", $_SESSION['idioma']); ?>" class="mr-3"></a></li>
                                                        <li><a href='cambioIdioma.php?idioma=PT&name=<?php echo basename($_SERVER['REQUEST_URI']) ?>'><img src="imagenes/pt.png" alt="<?= buscarTexto("WEB", "nav", "nav_altPortugal", "", $_SESSION['idioma']); ?>" class="mr-3"></a></li>
                                                    </ul>
                                                </li>
                                            <?php } else if ($_SESSION['idioma'] == "FR") { ?>
                                                <li><a class="pb-2" href='cambioIdioma.php?idioma=FR&name=<?php echo basename($_SERVER['REQUEST_URI']) ?>'><img src="imagenes/fr.png" alt="<?= buscarTexto("WEB", "nav", "nav_altFrancia", "", $_SESSION['idioma']); ?>" class="mr-3"></a>
                                                    <ul class="flag">
                                                        <li></li>
                                                        <li><a href='cambioIdioma.php?idioma=ES&name=<?php echo basename($_SERVER['REQUEST_URI']) ?>'><img src="imagenes/es.png" alt="<?= buscarTexto("WEB", "nav", "nav_altEspana", "", $_SESSION['idioma']); ?>" class="mr-3"></a></li>
                                                        <li><a href='cambioIdioma.php?idioma=IT&name=<?php echo basename($_SERVER['REQUEST_URI']) ?>'><img src="imagenes/it.png" alt="<?= buscarTexto("WEB", "nav", "nav_altItalia", "", $_SESSION['idioma']); ?>" class="mr-3"></a></li>
                                                        <li><a href='cambioIdioma.php?idioma=PT&name=<?php echo basename($_SERVER['REQUEST_URI']) ?>'><img src="imagenes/pt.png" alt="<?= buscarTexto("WEB", "nav", "nav_altPortugal", "", $_SESSION['idioma']); ?>" class="mr-3"></a></li>
                                                    </ul>
                                                </li>
                                            <?php } else if ($_SESSION['idioma'] == "IT") { ?>
                                                <li><a class="pb-2" href='cambioIdioma.php?idioma=IT&name=<?php echo basename($_SERVER['REQUEST_URI']) ?>'><img src="imagenes/it.png" alt="<?= buscarTexto("WEB", "nav", "nav_altItalia", "", $_SESSION['idioma']); ?>" class="mr-3"></a>
                                                    <ul class="flag">
                                                        <li></li>
                                                        <li><a href='cambioIdioma.php?idioma=ES&name=<?php echo basename($_SERVER['REQUEST_URI']) ?>'><img src="imagenes/es.png" alt="<?= buscarTexto("WEB", "nav", "nav_altEspana", "", $_SESSION['idioma']); ?>" class="mr-3"></a></li>
                                                        <li><a href='cambioIdioma.php?idioma=FR&name=<?php echo basename($_SERVER['REQUEST_URI']) ?>'><img src="imagenes/fr.png" alt="<?= buscarTexto("WEB", "nav", "nav_altFrancia", "", $_SESSION['idioma']); ?>" class="mr-3"></a></li>
                                                        <li><a href='cambioIdioma.php?idioma=PT&name=<?php echo basename($_SERVER['REQUEST_URI']) ?>'><img src="imagenes/pt.png" alt="<?= buscarTexto("WEB", "nav", "nav_altPortugal", "", $_SESSION['idioma']); ?>" class="mr-3"></a></li>
                                                    </ul>
                                                </li>
                                            <?php } else if ($_SESSION['idioma'] == "PT") { ?>
                                                <li><a class="pb-2" href='cambioIdioma.php?idioma=PT&name=<?php echo basename($_SERVER['REQUEST_URI']) ?>'><img src="imagenes/pt.png" alt="<?= buscarTexto("WEB", "nav", "nav_altPortugal", "", $_SESSION['idioma']); ?>" class="mr-3"></a>
                                                    <ul class="flag">
                                                        <li></li>
                                                        <li><a href='cambioIdioma.php?idioma=ES&name=<?php echo basename($_SERVER['REQUEST_URI']) ?>'><img src="imagenes/es.png" alt="<?= buscarTexto("WEB", "nav", "nav_altEspana", "", $_SESSION['idioma']); ?>" class="mr-3"></a></li>
                                                        <li><a href='cambioIdioma.php?idioma=FR&name=<?php echo basename($_SERVER['REQUEST_URI']) ?>'><img src="imagenes/fr.png" alt="<?= buscarTexto("WEB", "nav", "nav_altFrancia", "", $_SESSION['idioma']); ?>" class="mr-3"></a></li>
                                                        <li><a href='cambioIdioma.php?idioma=IT&name=<?php echo basename($_SERVER['REQUEST_URI']) ?>'><img src="imagenes/it.png" alt="<?= buscarTexto("WEB", "nav", "nav_altItalia", "", $_SESSION['idioma']); ?>" class="mr-3"></a></li>
                                                    </ul>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </nav>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>