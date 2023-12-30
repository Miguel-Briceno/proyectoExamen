<?php
//* Se requiere el modelo User
require_once('models/User_model.php');
require_once('models/Productos_model.php');
class ControllerUser{

    // metodo que nos lleva a la vista index
    public function pagInicio(){
        $producto = new Producto();
        $resultados = $producto->get_Productos();
        require_once "views/user/index.php";
    }
    // metodo que nos lleva a la vista login
    public function inicioSession(){
        require_once "views/user/login.php";
    }
    // metodo que nos permite loguearnos
    public function login(){
        // primero se chequea el metodo post que sale por el formulario con clave inicioSession
        if (isset($_POST['inicioSession'])) {
            // una vez que existe procedemos a tomar el valor que viene en el array POST
            $email = $_POST['email'];
            $contrasenia = $_POST['contrasenia'];
            $usuario = new User($email, $contrasenia); // se crea un objeto User
            $usuarioExiste = $usuario->comprobarUsuario($email); // y con el objeto llamamos a el metodo 
            // este metodo comprueba si existe este usuario en la base de datos o no
            if (!$usuarioExiste) {
                echo "<p>Usuario no existe</p>";
            } else {// si el usuario existe comprobamos la contraseña que esta en la base de datos 
                // con la contraseña que ingresa el usuario y si coinciden se inicia sessión
                $contraseniaDB = $usuarioExiste['contrasenia'];
                if ($contrasenia == $contraseniaDB) {                                         
                    $_SESSION['usuario'] = $email;
                    $_SESSION['id'] = $usuario->getId($email);
                    // se crea la clave usuario en el array $_SESSION
                    // que nos permite guardar el usuario durante la session
                    // definimos la cokies con el usuario qu ha accedido
                    setcookie("usuario", $email, time() + 3600);
                    
                    $productos= new ControllerProductos;
                    $resultados = $productos->cargar($email);                    
                    require_once "views/producto/productos.php";                   
                } else {
                    echo "<p>Contraseña no Valida</p>";
                }
            }
        }
    }
    
}

?>