<?php
include('password.php');
class User extends Password
{
    private $_pdo;

    function __construct($pdo)
    {
        parent::__construct();

        $this->_pdo = $pdo;
    }

    private function get_user_hash($email)
    {

        try {
            $stmt = $this->_pdo->prepare('SELECT idfichaempresa, email, marcas_idMarca, password FROM fichaempresametas f
            INNER JOIN marcas_has_fichaempresametas m ON m.fichaempresametas_idfichaempresa = f.idfichaempresa
            WHERE /*isCliente = 1 AND */ isBloqueado = 0 /*AND marcas_idMarca = 13*/ AND email = :email');
            $stmt->execute(array('email' => $email));

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo '<p class="text-danger">' . $e->getMessage() . '</p>';
        }
    }

    public function login($email, $password, $conn)
    {
        include('AES.php');
        $row = $this->get_user_hash($email);
        if ($row != false || $row != null) {
            $marca13Encontrada = false; // Variable para rastrear si se encuentra la marca 13
            $sqlPW = $sqlIdFicha = $sqlEmail = "";

            foreach ($row as $user) {
                $sqlPW = $user->password;
                $sqlIdFicha = $user->idfichaempresa;
                $sqlEmail = $user->email;
                // Verifica si la marca es igual a 13 en cada fila
                if ($user->marcas_idMarca == 13) {
                    $marca13Encontrada = true;
                    break; // Si se encuentra la marca 13, sal del bucle
                }
            }
            if ($marca13Encontrada) {
                if (PHP_AES_Cipher::encrypt($password) ==  $sqlPW) {
                    // require_once('../includes/config.php');
                    $_SESSION['idfichaempresa'] =  $sqlIdFicha;
                    $_SESSION['email'] = $sqlEmail;
                    $_SESSION['loggedin'] = true;

                    //Busco el usuario por el email en pertex               
                    $sql = "SELECT id FROM usuarios WHERE correo='" . $_SESSION['email'] . "'";
                    $query = $conn->prepare($sql);
                    $query->execute();
                    $_SESSION['ID'] = $query->fetchColumn();

                    if ($_SESSION['ID'] == "") {
                        //Si no existe el usuario en pertex, creo el usuario
                        $sql = "INSERT INTO usuarios (correo, id_fichaempresameta) 
                        VALUES (?, ?)";
                        $sentencia = $conn->prepare($sql);
                        $sentencia->bindParam(1, $email, PDO::PARAM_STR);
                        $sentencia->bindParam(2, $_SESSION['id_fichaempresameta'], PDO::PARAM_INT);
                        $sentencia->execute();
                        $_SESSION['ID'] = $conn->lastInsertId();
                    }

                    return true;
                } else {
                    echo "Contraseña incorrecta.";
                    $_SESSION['email'] = "";
                    $_SESSION['loggedin'] = false;
                }
            } else {
                // No se encontró ninguna fila con la marca 13
                echo "No estás registrado en Personalizaciones Textiles. Haz click <a target='_blank' href='https://www.textilforms.com/login.php?web=13&idioma=" . $_SESSION['idioma'] . "' class='links'>aquí</a> para poder acceder.";
            }
        } else {
            echo "Email incorrecto.";
        }
    }

    public function logout()
    {
        session_destroy();
    }

    public function is_logged_in()
    {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            return true;
        }
    }
}
