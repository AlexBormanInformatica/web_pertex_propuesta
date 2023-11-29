<?php
require_once('includes/config.php');
include("funciones/functions.php");
include('classes/AES.php');
include("assets/_partials/codigo-idiomas.php");

if (!$user->is_logged_in()) {
    // echo "e " . $_SESSION['loggedin'];
    header('Location: login');
    exit();
}
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <title><?= buscarTexto("WEB", "mi-cuenta", "cuenta_li-1", "", $_SESSION['idioma']); ?></title>

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
                                <h2><?= buscarTexto("WEB", "mi-cuenta", "cuenta_li-1", "", $_SESSION['idioma']); ?></h2>
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

                <div class="col-lg-6 col-md-6">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <p class="mb-0">
                                    <button type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <img src="iconos/Tus_datos_4.png" alt="<?= buscarTexto("WEB", "mi-cuenta", "alt-tus-datos", "", $_SESSION['idioma']); ?>"><span class="m-l-20 text-cuenta"><?= buscarTexto("WEB", "mi-cuenta", "cuenta_tit-datos", "", $_SESSION['idioma']); ?></span>
                                    </button>
                                </p>
                            </div>

                            <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <form>
                                        <?php
                                        try {
                                            $sql = "SELECT * FROM fichaempresametas WHERE email = '" . $_SESSION["email"] . "'";
                                            $query = $conn_formularios->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        } catch (Exception $e) {
                                            // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
                                        }

                                        foreach ($results as $result) { ?>
                                            <!--Nombre fiscal-->
                                            <label><?= buscarTexto("WEB", "mi-cuenta", "cuenta_datos-fiscal", "", $_SESSION['idioma']); ?></label>
                                            <input type="text" name="nombrefiscal" class="single-input mb-3" value="<?php echo $result->nombreFiscal == null ? "-" : $result->nombreFiscal; ?>" readonly>

                                            <!--CIF DNI VAT-->
                                            <label><?= buscarTexto("WEB", "mi-cuenta", "cuenta_datos-dni", "", $_SESSION['idioma']); ?></label>
                                            <input type="text" name="vatno" class="single-input mb-3" value="<?php echo $result->CifDniVat == null ? "-" : $result->CifDniVat; ?>" readonly>

                                            <!--Email-->
                                            <label>Email</label>
                                            <input type="text" name="vatno" class="single-input mb-3" value="<?php echo $result->email == null ? "-" : $result->email; ?>" readonly>

                                            <!--Recargo de equivalencia-->
                                            <label><?= buscarTexto("WEB", "mi-cuenta", "cuenta_datos-re", "", $_SESSION['idioma']); ?></label>
                                            <input type="text" name="recargo" class="single-input mb-3" value="<?php echo $result->TieneRecargoEquivalencia == 1 ? "Sí" : "No"; ?>" readonly>
                                        <?php } ?>
                                        <br><br>
                                        <!--Datos reales textilforms-->
                                        <a target="_blank" href="https://www.textilforms.com/login.php?web=13&idioma=<?= $_SESSION['idioma'] ?>" class="btn btn-primary"><?= buscarTexto("WEB", "mi-cuenta", "btn-ver-datos", "", $_SESSION['idioma']); ?></a>
                                    </form>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <p class="mb-0">
                                        <button class=" collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <img src="iconos/Cambiar_contraseña_4.png" alt="<?= buscarTexto("WEB", "mi-cuenta", "alt-cambiar-pw", "", $_SESSION['idioma']); ?>"><span class="m-l-20 text-cuenta"><?= buscarTexto("WEB", "mi-cuenta", "cuenta_tit-password", "", $_SESSION['idioma']); ?></span>
                                        </button>
                                    </p>
                                </div>
                                <div id="collapseTwo" class="collapse <?= isset($_POST['enviar']) ? "show" : "" ?>" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <?php
                                        $error = "";
                                        if (isset($_POST['enviar'])) {
                                            if ($_POST['password'] != $_POST['usuario_clave_conf']) {
                                                $error = buscarTextoConReturn("WEB", "mi-cuenta", "cuenta-pass-txtNoCoincide", "", $_SESSION['idioma']);
                                            } else {
                                                include('classes/AES.php');
                                                $usuario_clave = PHP_AES_Cipher::encrypt($_POST["password"]);
                                                try {
                                                    $sql = "UPDATE `fichaempresametas` SET `password` = '" .  $usuario_clave . "'  WHERE `email` = '" . $_SESSION["email"] . "'";
                                                    $query = $conn_formularios->prepare($sql);
                                                    $query->execute();
                                                } catch (Exception $e) {
                                                    header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?". PHP_AES_Cipher::encrypt("msg=" . $e->getCode()));
                                                }
                                                if ($sql) {  ?>
                                                    <div class='fs-18  alert alert-success'> <?php echo buscarTexto("WEB", "mi-cuenta", "cuenta-pass-txtCorrecto", "", $_SESSION['idioma']); ?></div>
                                        <?php
                                                } else {
                                                    $error = buscarTextoConReturn("WEB", "mi-cuenta", "cuenta-pass-txtError", "", $_SESSION['idioma']);
                                                }
                                            }
                                        }
                                        ?>

                                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                                            <?php if ($error != "") { ?>
                                                <p class="help-block"><?= $error; ?></p><br>
                                            <?php } ?>
                                            <label><?= buscarTexto("WEB", "mi-cuenta", "cuenta_pass-nueva", "", $_SESSION['idioma']); ?></label><br />
                                            <input type="password" class="single-input" name="password" /><br />
                                            <label><?= buscarTexto("WEB", "mi-cuenta", "cuenta_pass-conf", "", $_SESSION['idioma']); ?></label><br />
                                            <input type="password" class="single-input" name="usuario_clave_conf" /><br />
                                            <input class="btn" type="submit" name="enviar" value="<?= buscarTexto("WEB", "generico", "btn-enviar", "", $_SESSION['idioma']); ?>" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    include("assets/_partials/footer.php");
    ?>