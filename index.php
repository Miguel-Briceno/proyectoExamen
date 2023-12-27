<?php
require_once 'config/config.php';//? requerimos template config
require_once 'controllers/User_controller.php';//? requerimos template User_controller
require_once 'controllers/Productos_controller.php';//? requerimos template Productos_controller

// aqui instanciamos la clase ContollerUser
$controller = new ControllerUser;
// Aqui se controlan los envios de la informacion a través de la url, con la super global $_GET en su clave accion.
// esto chequea si extiste un $_GET y si existe el valor de ese $_GET['accion'] lo asigna a un metodo y mediante la funcion
// method_exists() chequea si existe ese metodo en la clase ControllerUser, si existe lo ejecuta sino ejecuta el metodo pagInicio()
if(empty($_SESSION)){
    if (isset($_GET['accion'])) {
        method_exists('ControllerUser', $_GET['accion']) ? $controller->{$_GET['accion']}() : $controller->pagInicio();
    } 

    else {
        $controller->pagInicio(); //! si no hay una intruccion siempre nos va a llevar a la vista index

    }
}
// cuando se presiona login a traves de la url le pasa el valor que formara la estructura del metodo y en el index se encuentra requerido 
// el archivo User_controller.php donde se encuentra la clase ControllerUser y el metodo login() que se ejecuta cuando se presiona login

