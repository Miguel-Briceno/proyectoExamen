<?php
// Se requiere el modelo User
require_once('models/User_model.php');
require_once('models/Propiedades_model.php');
require_once('models/Validaciones_model.php');

class ControllerUser{
    public function pagInicio(){// metodo que nos lleva a la vista index y carga las propiedades en la vista index
        $propiedad = new Propiedad();
        $resultados = $propiedad->get_Propiedades();
        require_once "views/user/index.php";
    }
    
    public function inicioSession(){  // metodo que nos lleva a la vista login
        require_once "views/user/login.php";
    }
    
    public function login(){// metodo que nos permite loguearnos
        if (isset($_POST['inicioSession'])) {//  se chequea el metodo post que sale por el formulario con clave inicioSession
            $usuario = new User($_POST['email'],$_POST['contrasenia']);// una vez que existe procedemos a tomar el valor que viene en el array POST
            $usuario->validarUsuario();
            $email = $_POST['email'];
            $contrasenia = $_POST['contrasenia'];
            $validar = new Validaciones();
            $usuarioExiste = $validar->comprobarUsuario($email); // validacion si existe o no en la bbdd
            if (!$usuarioExiste) {
                echo "<p>Usuario no existe</p>";
            } 
            else {// si el usuario existe comprobamos la contraseña que esta en la base de datos 
                $contraseniaDB = $usuarioExiste['contrasenia'];// con la contraseña que ingresa el usuario y si coinciden se inicia sessión
                if ($contrasenia == $contraseniaDB) {                                         
                    $_SESSION['usuario'] = $email;// se crea la clave usuario en el array $_SESSION
                    $_SESSION['id'] = $usuarioExiste['id'];// se crea la clave id en el array $_SESSION
                    setcookie("usuario", $email, time() + 3600);   // definimos la cokies con el usuario qu ha accedido                  
                    $propiedades= new ControllerPropiedades;
                    $resultados = $propiedades->cargar($email);                    
                    require_once "views/propiedad/propiedades.php";                   
                } else {
                    echo "<p>Contraseña no Valida</p>";
                }
            }
        }
    }
    
    public function registro(){// metodo que nos lleva a la vista registro
        require_once "views/user/registro.php";
    }

    public function registrar(){      // metodo que nos resgistra al usuario  
        if (isset($_POST['registrar'])) {
            $email = $_POST['email'];
            $contrasenia = $_POST['contrasenia'];
            $contrasenia2 = $_POST['conContrasenia'];
            if($contrasenia===$contrasenia2){
                $usuario = new User($email, $contrasenia);
                $usuario->validarUsuario();
                $validar = new Validaciones();                
                $usuarioExiste = $validar->comprobarUsuario($email);
                if ($usuarioExiste) {
                    echo "<p>Usuario ya existe</p>";
                } else {
                    $usuario->set_Registrar($email, $contrasenia);
                    require_once 'views/user/registro.php';
                    echo "<p>Usuario registrado</p>";
                }
            }else{echo "<p>Contraseñas no coinciden</p>";}
        }
        
    }
    
}

?>