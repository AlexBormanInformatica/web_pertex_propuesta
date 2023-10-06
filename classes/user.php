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
            $stmt = $this->_pdo->prepare('SELECT email, password FROM fichaempresametas WHERE email = :email  ');
            $stmt->execute(array('email' => $email));

            return $stmt->fetch();
        } catch (PDOException $e) {
            echo '<p class="text-danger">' . $e->getMessage() . '</p>';
        }
    }

    public function login($email, $password)
    {
        include('AES.php');
        $row = $this->get_user_hash($email);
        if ($row != false || $row != null) {
            if (PHP_AES_Cipher::encrypt($password) == $row['password']) {
                $_SESSION['email'] = $row['email'];
                $_SESSION['loggedin'] = true;

                require_once('../includes/config.php');
               
                $sql = "SELECT id FROM usuarios WHERE username='" . $_SESSION['email'] . "'";
                $query = $conn->prepare($sql);
                $query->execute();
                $_SESSION['ID'] = $query->fetchColumn();

                $sql = "SELECT clienteinterno FROM usuarios WHERE username='" . $_SESSION['email'] . "'";
                $query = $conn->prepare($sql);
                $query->execute();
                $_SESSION['interno'] = $query->fetchColumn();

                if ($_SESSION['ID'] == "") {
                     //Crear usuario
                     $sql = "INSERT INTO usuarios (username, password, nombrecomercial, nombrefiscal, cif, recargo, mediodepesca_comonosconocio, comentarios) 
                    VALUES (?, '', '', '', '', '', '', '')";
                    $sentencia = $conn->prepare($sql);
                    $sentencia->bindParam(1, $email, PDO::PARAM_STR);
                    $sentencia->execute();
                    $_SESSION['ID'] = $conn->lastInsertId();

                }

                return true;
            } else {
                $_SESSION['email'] = "";
                $_SESSION['loggedin'] = false;
            }
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
