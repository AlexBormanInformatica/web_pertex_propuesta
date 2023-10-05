<?php
require_once "includes/config.php";
include("funciones/functions.php");
require_once "assets/_partials/idioma.php";

?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?= buscarTexto("WEB", "contacto", "cont_og:title_seo", "", $_SESSION['idioma']); ?></title>
  <meta name="description" content="<?= buscarTexto("WEB", "contacto", "cont_description", "", $_SESSION['idioma']); ?>">
  <meta property="og:locale" content="es_ES">
  <meta property="og:site_name" content="personalizacionestextiles" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="<?= buscarTexto("WEB", "contacto", "cont_og:title_seo", "", $_SESSION['idioma']); ?>" />
  <meta property="og:description" content="<?= buscarTexto("WEB", "contacto", "cont_description", "", $_SESSION['idioma']); ?>" />
  <meta property="og:image" content="https://personalizacionestextiles.com/images/logo.png" />

  <?php
  include("assets/_partials/header.php");
  ?>

  <main>

    <?php
    include("funciones/errores.php");
    ?>

    <section>
      <div class="container-fluid p-0">
        <div class=" p-tb-50">
          <div class="row">
            <div class="col-xl-12">
              <div class="text-center p-b-50 max-width ">
                <h1 class="title-product"><?= buscarTexto("WEB", "contacto", "cont_title-principal", "", $_SESSION['idioma']); ?></h1>
                <img src="imagenes/contacto.png" alt="<?= buscarTexto("WEB", "contacto", "alt-contacto", "", $_SESSION['idioma']); ?>">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="container">
      <form class="row m-0 border-form  container white-bg p-all-30 " id="formulariocontacto" action="DAOs/contactoDAO.php" method="post">
        <input id="ko" name="ko" value="" hidden>
        <?php if (!$user->is_logged_in()) { ?>
          <div class="col-lg-6 col-md-6 ">
            <h3 class="mb-3 tit-form"><?= buscarTexto("WEB", "contacto", "cont_tit-form", "", $_SESSION['idioma']); ?></h3>
            <!--Nombre-->
            <div class="mb-3">
              <label for="nombre" class="form-label text-label"><?= buscarTextoFormularios("WEB", "index", "label-comercial", "", $_SESSION['idioma']); ?></label>
              <input type="text" class="form-control" id="nombrecomercial" name="nombrecomercial" value="" required>
            </div>

            <!--Email-->
            <div class="mb-3">
              <label for="email" class="form-label text-label"><?= buscarTextoFormularios("WEB", "index", "label-email", "", $_SESSION['idioma']); ?></label>
              <input type="email" class="form-control" id="email" name="email" value="" required>
              <a style="display:none" id="btn-msj-email" href="https://textilforms.com/login.php?web=13" class="btn-email"><i class="ti-alert"></i> <?= buscarTextoFormularios("WEB", "errores", "err-email-form", "", $_SESSION['idioma']); ?></a>
            </div>

            <!--Telefono-->
            <div class="mb-3">
              <label for="telefono" class="form-label text-label"><?= buscarTextoFormularios("WEB", "index", "label-tlf", "", $_SESSION['idioma']); ?></label>
              <input type="tel" class="form-control" id="telefono" name="telefono" value="">
            </div>

            <!--Como nos has conocido-->
            <div class="mb-3">
              <label for="conocido" class="form-label text-label"><?= buscarTextoFormularios("WEB", "index", "label-conocido", "", $_SESSION['idioma']); ?></label>
              <select class="form-control" id="conocido" name="conocido" required>
                <option value="">---</option>
                <?php
                try {
                  $sql = "SELECT id, descripcion FROM prg_borman.mediodepesca_comonosconocio WHERE mediodepesca_comonosconocio.web=1 AND marcas_idMarca=13 ORDER BY descripcion";
                  $query = $conn->prepare($sql);
                  $query->execute();
                  $results = $query->fetchAll(PDO::FETCH_OBJ);
                } catch (Exception $e) {
                  header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
                }
                foreach ($results as $result) {
                ?>
                  <option value="<?= $result->id; ?>"><?= buscarTextoFormularios("PRG", "mediodepesca_comonosconocio", $result->id, "descripcion", $_SESSION['idioma']); ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

          <!--Actividad que realiza-->
          <div class="col-lg-6 col-md-6 p-all">
            <div class="form-group p-t-30">
              <label><?= buscarTextoFormularios("WEB", "index", "label-act", "", $_SESSION['idioma']); ?></label>
              <div class="row p-all-30">
                <?php
                try {
                  $sql = "SELECT idActividad, descripcion 
                    FROM actividad_has_webs 
                    INNER JOIN Actividad ON Actividad.idActividad = actividad_has_webs.actividad_idActividad
                    WHERE webs_web = 'Personalizaciones textiles'
                    ORDER BY descripcion";
                  $query = $conn_prgborman->prepare($sql);
                  $query->execute();
                  $results = $query->fetchAll(PDO::FETCH_OBJ);
                } catch (Exception $e) {
                  header("location: " . buscarTextoConReturn('WEB', 'paginas', 'error', '', $_SESSION['idioma']) . "?msg=" . $e->getCode());
                }
                foreach ($results as $result) {
                ?>
                  <label class="form-check-label col-lg-6 "> <input type="checkbox" class="form-check-input" name="actividades[]" value="<?= $result->idActividad; ?>" required>
                    <?= buscarTextoFormularios("PRG", "Actividad", $result->idActividad, "descripcion", $_SESSION['idioma']); ?> </label><br>
                <?php } ?>
              </div>
            </div>

            <!--Comentario/mensaje-->
            <div class="mb-3">
              <label for="comentarios" class="form-label"><?= buscarTextoFormularios("WEB", "index", "label-mensaje", "", $_SESSION['idioma']); ?></label>
              <textarea class="form-control" id="comentarios" name="comentarios" rows=11 cols=50></textarea>
            </div>

            <!--Acepta privacidad-->
            <div class="mb-3 form-check">
              <label class="form-check-label" for="privacidad"><input type="checkbox" class="form-check-input" id="privacidad" name="privacidad" required>
                <?= buscarTextoFormularios("WEB", "index", "label-priv", "", $_SESSION['idioma']); ?></label>
            </div>

            <div class="loading-dock">
              <svg id="load-b" x="0px" y="0px" viewBox="0 0 150 150">
                <circle class="loading-inner" cx="75" cy="75" r="60" />
              </svg>

              <svg id="load" x="0px" y="0px" viewBox="0 0 150 150">
                <circle class="loading-inner" cx="75" cy="75" r="60" />
              </svg>

              <button data-callback="formSubmit" data-size="invisible" data-sitekey="6Le8UoMkAAAAALmqYyAs8L4dBYMQL6N4lhSqvCld" class="btnEnviarMail submit  btng-recaptcha">
                <?= buscarTexto("WEB", "generico", "btn-enviar", "", $_SESSION['idioma']); ?>
              </button>

              <svg id="check" style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="white" d="M9,20.42L2.79,14.21L5.62,11.38L9,14.77L18.88,4.88L21.71,7.71L9,20.42Z" />
              </svg>
            </div>
          </div>
        <?php } else { ?>
          <div class="col-lg-12 col-md-12">
            <h3 class="mb-3 tit-form"><?= buscarTexto("WEB", "contacto", "cont_tit-form", "", $_SESSION['idioma']); ?></h3>
            <!--Comentario/mensaje-->
            <div class="form-group p-t-30">
              <label for="comentarios" class="form-label"><?= buscarTextoFormularios("WEB", "index", "label-mensaje", "", $_SESSION['idioma']); ?></label>
              <textarea class="form-control" id="comentarios" name="comentarios" rows=11 cols=50></textarea>
            </div>

            <div class="loading-dock">
              <svg id="load-b" x="0px" y="0px" viewBox="0 0 150 150">
                <circle class="loading-inner" cx="75" cy="75" r="60" />
              </svg>

              <svg id="load" x="0px" y="0px" viewBox="0 0 150 150">
                <circle class="loading-inner" cx="75" cy="75" r="60" />
              </svg>

              <button data-callback="formSubmit" data-size="invisible" data-sitekey="6Le8UoMkAAAAALmqYyAs8L4dBYMQL6N4lhSqvCld" class="btnEnviarMail submit btn g-recaptcha">
                <?= buscarTexto("WEB", "generico", "btn-enviar", "", $_SESSION['idioma']); ?>
              </button>
              <!-- <button type="submit"><?= buscarTexto("WEB", "contactanos", "contactanos_btn", "", $_SESSION['idioma']); ?></button> -->


              <svg id="check" style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="white" d="M9,20.42L2.79,14.21L5.62,11.38L9,14.77L18.88,4.88L21.71,7.71L9,20.42Z" />
              </svg>
            </div>
          </div>
        <?php } ?>
      </form>
    </div>

    <div class="container-fluid p-0">
      <div class="row  mx-auto bg-color-cta m-t-100">
        <section class="p-all-30 mx-auto container-fluid">
          <div class="row">
            <div class="p-all-50 text-center col-lg-4 col-md-4 col-sm-6">
              <span class="contact-info__icon"><img src="iconos/Ubicacion_1.png" alt="<?= buscarTexto("WEB", "contacto", "alt-ubicacion", "", $_SESSION['idioma']); ?>"></span>
              <h4><?= buscarTexto("WEB", "contacto", "cont_nuestra-direccion", "", $_SESSION['idioma']); ?></h4>
              <p><?= buscarTexto("WEB", "contacto", "cont_direccion", "", $_SESSION['idioma']); ?><br>
                50197 <?= buscarTexto("WEB", "contacto", "cont_direccion_zgz", "", $_SESSION['idioma']); ?></p>
            </div>

            <div class=" p-all-50 text-center col-lg-4 col-md-6 col-sm-6">
              <span class="contact-info__icon"><img src="iconos/Telefono_1.png" alt="<?= buscarTexto("WEB", "contacto", "alt-telefono", "", $_SESSION['idioma']); ?>"></span>
              <h4><?= buscarTexto("WEB", "contacto", "cont_llamanos", "", $_SESSION['idioma']); ?></h4>
              <h4><a style="color:black" href="tel:0034976125159">(+34) 976 12 51 59 </a></h4>
              <p><?= buscarTexto("WEB", "contacto", "cont_horario", "", $_SESSION['idioma']); ?></p>
            </div>

            <div class=" p-all-50 text-center col-lg-4 col-md-4 col-sm-6">
              <span class="contact-info__icon"><img src="iconos/Mail_1.png" alt="<?= buscarTexto("WEB", "contacto", "alt-mail", "", $_SESSION['idioma']); ?>"></span>
              <a style="color: black" href="mailto:ventas@personalizacionestextiles.com">
                <h4><?= buscarTexto("WEB", "contacto", "cont_envia-email", "", $_SESSION['idioma']); ?></h4>
              </a>
            </div>
          </div>
        </section>
      </div>
    </div>

  </main>

  <?php
  include("assets/_partials/footer.php");
  ?>
  <script type="text/javascript">
    var input = document.getElementById('telefono');
    input.addEventListener('input', function() {
      if (this.value.length > 15)
        this.value = this.value.slice(0, 15);
    })

    $("#email")
      .on("focusout", function() {
        if ($('#email').val().trim() != "") {
          $.ajax({ //Peticion de ajax
            async: false,
            method: "POST",
            url: "functions.php",
            data: {
              buscarMail: $('#email').val()
            }
          }).done(function(response) {
            if (response.trim() == "1") {
              $('#btn-msj-email').show();
            } else {
              $('#btn-msj-email').hide();
            }
          });
        }
      });
  </script>
  <script type="text/javascript">
    function formSubmit(response) {
      // submit the form which now includes a g-recaptcha-response input
      $("#formulariocontacto").submit();
      return true;
    }

    var clicked = false;
    var submit = document.querySelector('.submit');
    $.validator.setDefaults({
      submitHandler: function() {
        // Make sure user cannot click button again until it has been reset
        if (!clicked) {
          clicked = true;
          submit.classList.remove("return");
          submit.blur();
          document.querySelector('.loading-dock').classList.add('loaded');
          document.getElementById('load').style.display = 'initial';
          document.getElementById('load-b').style.display = 'initial';
          setTimeout(function() {
            document.getElementById('load').style.opacity = 1;
          }, 750);
          setTimeout(function() {
            document.getElementById('load-b').style.opacity = 1;
          }, 900);
          setTimeout(function() {
            let submit = document.querySelector('.submit');
            submit.classList.add("popout");
            submit.innerHTML = "";
            setTimeout(function() {
              document.getElementById('check').style.display = "block";
            }, 300);
          }, 3600);

          //reset all
          setTimeout(function() {
            submit.classList.remove("popout");
            submit.classList.add("return");
            submit.innerHTML = $("#btn-enviar").text();
            document.getElementById('check').style.display = "none";
            clicked = false;
          }, 5300);

          var arr = [];
          $("input[name='actividades[]']:checked").each(function() {
            arr.push($(this).val());
          });
          var strActividades = JSON.stringify(arr);

          grecaptcha.ready(function() {
            grecaptcha.execute("6Le8UoMkAAAAALmqYyAs8L4dBYMQL6N4lhSqvCld", {}).then(function(token) {
              $.ajax({ //Peticion de ajax
                method: "POST",
                url: "DAOs/contactoDAO.php",
                data: {
                  nombrecomercial: $('#nombrecomercial').val(),
                  email: $('#email').val(),
                  telefono: $('#telefono').val(),
                  conocido: $('#conocido').val(),
                  actividades: strActividades,
                  mensaje: $('#comentarios').val()
                }
              }).done(function(response) {
                window.location = "gracias";
              });
              //console.log("submitted");
            });
          });
        }
      }
    });

    $(document).ready(function() {
      $("#formulariocontacto").validate({
        rules: {
          conocido: "required",
          privacidad: "required",
          "actividades[]": "required",
          nombrecomercial: {
            required: true,
            minlength: 2
          },
          email: {
            required: true,
            email: true
          },
          telefono: {
            required: false,
            number: true
          }
        },
        messages: {
          "actividades[]": $('#err-actividad').text(),
          privacidad: $('#err-privacidad').text(),
          conocido: $('#err-conocido').text(),
          nombrecomercial: {
            required: $('#err-obligatorio').text(),
            minlength: $('#err-minimo2').text()
          },
          nombrefiscal: {
            minlength: $('#err-minimo2').text()
          },
          email: {
            required: $('#err-obligatorio').text(),
            email: $('#err-email').text()
          },
          telefono: {
            number: $('#err-tel').text()
          },

        },
        errorElement: "em",
        errorPlacement: function(error, element) {
          error.addClass("help-block");
          if (element.prop("type") === "checkbox") {
            if (element.attr("name") == "actividades[]") {
              error.insertBefore(element.parent("label").parent("div"));
            } else {
              error.insertAfter(element.parent("label"));
            }
          } else {
            error.insertAfter(element);
          }
        }
      });
    });
  </script>