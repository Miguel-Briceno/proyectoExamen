<?php
//* Se requiere el modelo User
require_once('models/User_model.php');
class Controller
{


    public function pagInicio()
    {
        require_once "views/user/index.php";
    }
    public function inicioSession()
    {
        require_once "views/user/login.php";
    }
    public function login()
    {

        if (isset($_POST['inicioSession'])) {

            $email = $_POST['email'];
            $contrasenia = $_POST['contrasenia'];
            $usuario = new User($email, $contrasenia);
            $usuarioExiste = $usuario->comprobarUsuario($email);

            if (!$usuarioExiste) {
                echo "<p>Usuario no existe</p>";
            } else {

                $contraseniaDB = $usuarioExiste['contrasenia'];
                if ($contrasenia == $contraseniaDB) {

                    session_start();
                    $_SESSION['usuario'] = $email;
                    // definir la cokies
                    setcookie("usuario", $email, time() + (86400 * 30), "/");
                    require_once "views/user/productos.php";
                } else {
                    echo "<p>Contraseña no Valida</p>";
                }
            }
        }
    }
}
