<?php
//Declaramos la conexion con el servidor de base de datos
require_once('includes/config.php');
include("funciones/functions.php");
require_once "assets/_partials/idioma.php";

if (!$user->is_logged_in()) {
?>

    <!doctype html>
    <html class="no-js" lang="zxx">

    <head>
        <meta charset="utf-8">
        <title>Login</title>

        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta property="og:locale" content="es_ES">
        <meta property="og:site_name" content="personalizacionestextiles" />
        <meta property="og:type" content="website" />
        <meta property="og:image" content="https://personalizacionestextiles.com/images/logo.png" />
        <?php
        include("assets/_partials/header.php");
        ?>
        <main>
            <div class="container">
                <p class="m-t-30  fs-18 text-danger">
                    <?php
                    //Enviar correo recuperacion contraseña
                    if (isset($_POST['emailRecuperar'])) {
                        //Busca que exista el correo, si existe se envía el correo, sino se devuelve un mensaje de error por correo no encontrado en la base de datos
                        try {
                            $sql = "SELECT * FROM usuarios WHERE username='" . $_POST['emailRecuperar'] . "'";
                            $query = $conn->query($sql);
                            $results = $query->fetchAll(PDO::FETCH_OBJ);

                            if ($results) {
                                foreach ($results as $result) {
                                    enviarCorreo("recuperacion", $_POST['emailRecuperar'], 1, null);
                                }
                            } else {
                                echo buscarTexto("WEB", "login", "log-err-correo", "", $_SESSION['idioma']);
                            }
                        } catch (Exception $e) {
                            // header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
                        }
                    }
                    //Verifica el formulario
                    else if (isset($_POST['submit'])) {
                        $email = $_POST['email'];
                        if (!isset($_POST['password'])) {
                            $error[] = buscarTexto("WEB", "login", "log-err-ingresar", "", $_SESSION['idioma']);
                        }
                        $password = $_POST['password'];
                        if ($user->login($email, $password)) {
                            header('Location:' . buscarTextoConReturn("WEB", "paginas", "cuenta", "", $_SESSION['idioma']));
                        } else {
                            $error[] = buscarTexto("WEB", "login", "log-err-incorr", "", $_SESSION['idioma']);
                        }
                    } //end if submit
                    ?>
                </p>
            </div>

            <section class="login_part section_padding ">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-6">
                            <div class="login_part_form">
                                <div class="">
                                    <h3><?= buscarTexto("WEB", "login", "log-inicia-sesion", "", $_SESSION['idioma']); ?></h3>
                                    <form class="row contact_form form-control-sm" action="login" method="post" id="form-login">
                                        <div class=" col-md-12 p_star form-group">
                                            <label><?= buscarTexto("WEB", "checkout", "checkout_subtit-1-div5", "", $_SESSION['idioma']); ?></label>
                                            <input type="text" name="email" id="email" class="form-control input-lg" value="" tabindex="1">
                                        </div>
                                        <?php
                                        if (isset($error)) {
                                            foreach ($error as $error) {
                                                echo '<p class="text-danger">' . $error . '</p>';
                                            }
                                        }
                                        ?>
                                        <div class="campo form-group col-md-12 p_star <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                            <label><?= buscarTexto("WEB", "login", "log-lab-password", "", $_SESSION['idioma']); ?></label>
                                            <input type="password" name="password" id="password" class="form-control input-lg" tabindex="2">
                                            <span class="fa  fa-eye-slash"></span>
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <button type="submit" name="submit" value="" class="btn_3" tabindex="3">
                                                <span class="button__text"><?= buscarTexto("WEB", "login", "log-inicia-sesion", "", $_SESSION['idioma']); ?></span>
                                            </button>
                                            <button type="button" class="btn-modal mt-2" data-toggle="modal" data-target="#recuperar">
                                                <span class="mr-2"></span><?= buscarTexto("WEB", "login", "log-lab-?password", "", $_SESSION['idioma']); ?>
                                            </button>
                                        </div>
                                    </form>

                                    <!-- Modal email-->
                                    <div class="modal fade" id="recuperar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered-info" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body ">
                                                    <div class="row">
                                                        <div class="col-lg-8 mx-auto">
                                                            <p><?= buscarTexto("WEB", "login", "log-modal-p1", "", $_SESSION['idioma']); ?></p>
                                                            <form class="form-group" action="login" method="post" id="form-restablecer">
                                                                <!-- <div class="form-group col-md-12 p_star">
                                                                    <input type="text" name="userRecuperar" class="form-control input-lg" required placeholder="User">
                                                                </div> -->
                                                                <div class="form-group col-md-12 p_star">
                                                                    <input type="text" name="emailRecuperar" class="form-control input-lg" required placeholder="Email">
                                                                </div>

                                                                <button id="boton_formulario_restablecer" onclick="restablecer()" class="btn">
                                                                    <span class="button__text"><?= buscarTexto("WEB", "generico", "btn-enviar", "", $_SESSION['idioma']); ?></span>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="login_part_text text-center">
                                <div class="login_part_text_iner">
                                    <h2><?= buscarTexto("WEB", "login", "log-title", "", $_SESSION['idioma']); ?></h2>
                                    <p><?= buscarTexto("WEB", "login", "log-p", "", $_SESSION['idioma']); ?></p>
                                    <a target="_blank" href="hazte-cliente" class="btn_3"><?= buscarTexto("WEB", "login", "log-btn-registrate", "", $_SESSION['idioma']); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <?php
        include("assets/_partials/footer.php");
        ?>

        <script>
            function login() {
                $('#boton_formulario_login').addClass("button--loading");
                $('#boton_formulario_login').prop("disabled", true);
                $('#form-login').submit();
            }

            function restablecer() {
                $('#boton_formulario_restablecer').addClass("button--loading");
                $('#boton_formulario_restablecer').prop("disabled", true);
                $('#form-restablecer').submit();
            }
            document.querySelector('.campo span').addEventListener('click', e => {
                const passwordInput = document.querySelector('#password');
                if (e.target.classList.contains('show')) {
                    e.target.classList.remove('show');
                    e.target.classList.add('fa-eye');
                    e.target.classList.remove('fa-eye-slash');
                    passwordInput.type = 'text';
                } else {
                    e.target.classList.add('show');
                    e.target.classList.add('fa-eye-slash');
                    e.target.classList.remove('fa-eye');
                    passwordInput.type = 'password';
                }
            });
        </script>
    <?php } else {
    header("Location: 404");
} ?>