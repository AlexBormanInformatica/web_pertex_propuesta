<?php
// Include config file
require_once "includes/config.php";
include("funciones/functions.php");

include('includes/AES.php');

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['ko'] != "") {
        header("Location: index");
    } else {
        $idweb = 6;

        $email = $nombrecomercial = $nombrefiscal = $intracomunitario = $vatno =
            $archivo = $direccion = $postal = $pais = $provincia = $poblacion = $pais_mal = $provincia_mal = $poblacion_mal = $telefono =
            $actividades = $recargo  = $conocido = $mensaje = $catalogoLanding = "";

        $completo = true;
        $dni = false;

        if (isset($_POST['email']) && $_POST['email'] != "") {
            $email = $_POST['email'];
        } else {
            $completo = false;
        }

        if (isset($_POST['nombrecomercial']) && $_POST['nombrecomercial'] != "") {
            $nombrecomercial = $_POST['nombrecomercial'];
        } else {
            $completo = false;
        }

        if (isset($_POST['nombrefiscal']) && $_POST['nombrefiscal'] != "") {
            $nombrefiscal = $_POST['nombrefiscal'];
        } else {
            $completo = false;
        }

        if (isset($_POST['vatno']) && $_POST['vatno'] != "") {
            $vatno = $_POST['vatno'];
        } else {
            $completo = false;
        }

        $nombrenuevo = PHP_AES_Cipher::encrypt(rand(1000, 9999));
        $nombrenuevo = substr($nombrenuevo . "", 0, 16);
        $array = array("\\", "/", ":", "*", "?", "\"", "<", ">", "|");
        $nombrenuevo = str_replace($array, "", $nombrenuevo);

        $ext = "";
        $contenido = null;
        if (isset($_FILES["archivo"]) && $_FILES["archivo"]["name"]) {
            $archivo = $_FILES["archivo"]["tmp_name"];
            $tamano = $_FILES["archivo"]["size"];
            $path = $_FILES['archivo']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);

            $contenido = file_get_contents($archivo);

            $dni = true;
        } else {
            $completo = false;
        }

        if (isset($_POST['direccion']) && $_POST['direccion'] != "") {
            $direccion = $_POST['direccion'];
        } else {
            $completo = false;
        }

        if (isset($_POST['postal']) && $_POST['postal'] != "") {
            $postal = $_POST['postal'];
        } else {
            $completo = false;
        }

        /**PAIS PROVINCIA POBLACION******************/
        //Verifico si viene del select o del input.
        //Si es select lo introduzco normal
        //Si es input lo introduzco como pais_mal, provincia_mal, etc

        if (isset($_POST['pais']) && $_POST['pais'] != "") {
            $pais = $_POST['pais'];
            $pais_mal = false;
        } else if (isset($_POST['input-pais']) && $_POST['input-pais'] != "") {
            $pais = $_POST['input-pais'];
            $pais_mal = true;
        } else {
            $completo = false;
        }

        if (isset($_POST['provincia']) && $_POST['provincia'] != "") {
            $provincia = $_POST['provincia'];
            $provincia_mal = false;
        } else if (isset($_POST['input-provincia']) && $_POST['input-provincia'] != "") {
            $provincia = $_POST['input-provincia'];
            $provincia_mal = true;
        } else {
            $completo = false;
        }

        if (isset($_POST['poblacion']) && $_POST['poblacion'] != "") {
            $poblacion = $_POST['poblacion'];
            $poblacion_mal = false;
        } else if (isset($_POST['input-poblacion']) && $_POST['input-poblacion'] != "") {
            $poblacion = $_POST['input-poblacion'];
            $poblacion_mal = true;
        } else {
            $completo = false;
        }
        /******************** */

        if (isset($_POST['telefono']) && $_POST['telefono'] != "") {
            $telefono = $_POST['telefono'];
        } else {
            $completo = false;
        }

        if (isset($_POST['actividadesSeleccionadas']) && $_POST['actividadesSeleccionadas'] != "") {
            $actividades = $_POST['actividadesSeleccionadas'];
        } else {
            $completo = false;
        }

        if (isset($_POST['recargo']) && $_POST['recargo'] != "") {
            //Si es ESPAÑA
            if ($pais == "ESPAÑA") {
                //¿Está sujeto al régimen especial de recargo de equivalencia? -> SÍ / NO (Esta pregunta solo es cuando eligen pais España)
                $recargo = $_POST['recargo'];

                if ($provincia == "CEUTA" || $provincia == "MELILLA" || $provincia == "PALMAS (LAS)" || $provincia == "SANTA CRUZ DE TENERIFE") {
                    //Si es ESPAÑA y es CEUTA, MELILLA, PALMAS (LAS), SANTA CRUZ DE TENERIFE el IVA es Exento = 3
                    //y el R.E. será NO = 0
                    $intracomunitario = "3";
                    $recargo = "0";
                } else {
                    //Si es ESPAÑA y es otra provincia de España el IVA es General = 1
                    //y el R.E. será el seleccionado
                    $intracomunitario = "1";
                }
            } else if ($pais == "") {
                //Si no ha elegido país, el IVA y R.E. es nulo
                $intracomunitario = "1";
                $recargo = "0";
            } else {
                //Si NO es ESPAÑA
                //¿Es operador intracomunitario? -> SÍ / NO
                //N/A El recargo de equivalencia para otros paises, es 0
                $recargo = "0";
                //Si ha marcado el campo como SI (si es operador intracomunitario), el IVA es 2 = Intracomunitario
                //Si ha marcado el campo como NO (no es operador intracomunitario), el IVA es 1 = General
                $intracomunitario = $_POST['recargo']== "1" ? "2" : "1";
            }
        } else {
            $recargo = "0";
            $intracomunitario = "1";
            $completo = false;
        }


        if (isset($_POST['conocido']) && $_POST['conocido'] != "") {
            $conocido = $_POST['conocido'];
        } else {
            $completo = false;
        }

        if (isset($_POST['catalogoLanding']) && $_POST['catalogoLanding'] != "") {
            $catalogoLanding = $_POST['catalogoLanding'];
        } else {
            $completo = false;
        }

        if (isset($_POST['comentariosLanding']) && $_POST['comentariosLanding'] != "") {
            $mensaje = ($catalogoLanding == "1" ? "¿Quieres recibir nuestro catálogo? = Sí \n" : "¿Quieres recibir nuestro catálogo? = No \n") . $_POST['comentariosLanding'];
        }

        if (!$dni) {
            $dni = tieneDNI();

            if ($completo) {
                $completo = $dni ? true : false;
            }
        }

        $fecha = date("Y-m-d H:i:s", time());

        try {
            /**
             * Es nuevo meta autorizado.
             * Se grega en la tabla de fichaempresametas y sus correspondientes relaciones.
             */
            //insert meta----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
            $sql = "INSERT INTO fichaempresametas (nombreFiscal, nombreComercial, direccion, codigoPostal, poblacion, provincia, pais,
                CifDniVat, paginaWeb, telefono, email, TieneRecargoEquivalencia, TieneIvaExentoIntracomunitario, idioma, tieneDNI, 
                tieneFormulario, poblacion_mal, provincia_mal, pais_mal)
                 VALUES (?,?,?,?,?,?,?,?,'',?,?,?,?,?,?,?,?,?,?)";
            $sentencia = $conn_formularios->prepare($sql);
            $sentencia->bindParam(1, $nombrefiscal, PDO::PARAM_STR);
            $sentencia->bindParam(2, $nombrecomercial, PDO::PARAM_STR);
            $sentencia->bindParam(3, $direccion, PDO::PARAM_STR);
            $sentencia->bindParam(4, $postal, PDO::PARAM_STR);
            $sentencia->bindParam(5, $poblacion, PDO::PARAM_STR);
            $sentencia->bindParam(6, $provincia, PDO::PARAM_STR);
            $sentencia->bindParam(7, $pais, PDO::PARAM_STR);
            $sentencia->bindParam(8, $vatno, PDO::PARAM_STR);
            $sentencia->bindParam(9, $telefono, PDO::PARAM_STR);
            $sentencia->bindParam(10, $email, PDO::PARAM_STR);
            $sentencia->bindParam(11, $recargo, PDO::PARAM_INT);
            $sentencia->bindParam(12, $intracomunitario, PDO::PARAM_INT);
            $sentencia->bindParam(13, $_SESSION['idioma'], PDO::PARAM_STR);
            $sentencia->bindParam(14, $dni, PDO::PARAM_INT);
            $sentencia->bindParam(15, $completo, PDO::PARAM_INT);
            $sentencia->bindParam(16, $poblacion_mal, PDO::PARAM_INT);
            $sentencia->bindParam(17, $provincia_mal, PDO::PARAM_INT);
            $sentencia->bindParam(18, $pais_mal, PDO::PARAM_INT);
            $sentencia->execute();

            $idfichanueva = $conn_formularios->lastInsertId(); //https://www.php.net/manual/es/pdo.lastinsertid.php

            //insert en marcas_has_fichaempresametas
            $sql = "INSERT INTO marcas_has_fichaempresametas (marcas_idMarca, marcas_idEmpresa, fichaempresametas_idfichaempresa, isMeta, isMetaAutorizado) VALUES (?,2,?,0,1)";
            $sentencia = $conn_formularios->prepare($sql);
            $sentencia->bindParam(1, $idweb, PDO::PARAM_INT);
            $sentencia->bindParam(2, $idfichanueva, PDO::PARAM_INT);
            $sentencia->execute();

            //insert en mediodepesca_comonosconocio_has_fichaempresametas

            $sql = "INSERT INTO mediodepesca_comonosconocio_has_fichaempresametas (mediodepesca_comonosconocio_id, fichaempresametas_idfichaempresa, fecha) VALUES (?,?,?)";
            $sentencia = $conn_formularios->prepare($sql);
            $sentencia->bindParam(1, $conocido, PDO::PARAM_INT);
            $sentencia->bindParam(2, $idfichanueva, PDO::PARAM_INT);
            $sentencia->bindParam(3, $fecha, PDO::PARAM_STR);
            $sentencia->execute();

            //insert en actividad_has_fichaempresametas
            $str = strval($actividades[0]);
            $arr = explode(",", $str);
            foreach ($arr as $actividad) {
                $sql = "INSERT INTO actividad_has_fichaempresametas (actividad_idActividad, fichaempresametas_idfichaempresa) VALUES (?,?)";
                $sentencia = $conn_formularios->prepare($sql);
                $sentencia->bindParam(1, $actividad, PDO::PARAM_INT);
                $sentencia->bindParam(2, $idfichanueva, PDO::PARAM_INT);
                $sentencia->execute();
            }

            if ($mensaje != "") {
                //insert en mensajesmetas

                $sql = "INSERT INTO mensajesmetas (mensaje, fichaempresametas_idfichaempresa, fecha) VALUES (?,?,?)";
                $sentencia = $conn_formularios->prepare($sql);
                $sentencia->bindParam(1, $mensaje, PDO::PARAM_STR);
                $sentencia->bindParam(2, $idfichanueva, PDO::PARAM_INT);
                $sentencia->bindParam(3, $fecha, PDO::PARAM_STR);
                $sentencia->execute();
            }

            //insert en documentosmeta
            if ($dni) {
                $sql = "INSERT INTO documentosmeta (fichero, tipo, fichaempresametas_idfichaempresa, extension, imagen) VALUES (?,'D',?,?,?)";
                $sentencia = $conn_formularios->prepare($sql);
                $sentencia->bindParam(1, $nombrenuevo, PDO::PARAM_STR);
                $sentencia->bindParam(2, $idfichanueva, PDO::PARAM_INT);
                $sentencia->bindParam(3, $ext, PDO::PARAM_STR);
                $sentencia->bindParam(4, $contenido, PDO::PARAM_LOB);
                $sentencia->execute();
            }
        } catch (Exception $e) {
            echo "error: " . $e->getMessage();
        }
        if ($_POST['gracias-donde'] == "hazte-cliente") {
            //Viene de hazte cliente (general)
            header("Location: " . buscarTextoConReturn("WEB", "paginas", "gracias-por-hacerte-cliente", "", $_SESSION['idioma']));
        } else {
            //Viene de unete a nosotros (landings)
            header("Location: " . buscarTextoConReturn("WEB", "paginas", "gracias-landing", "", $_SESSION['idioma']));
        }
    }
}
