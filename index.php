<?php
session_start(); // Inicia la sesión al comienzo

require_once 'config/config.php';
require_once 'controllers/User_controller.php';
require_once 'controllers/Productos_controller.php';

// Verifica si hay una sesión activa
if (isset($_SESSION['usuario'])) {
    // Si hay una sesión activa, redirige según la acción
    $controllerPro = new ControllerProductos;
    
    if (isset($_GET['accion']) && method_exists('ControllerProductos', $_GET['accion'])) {
        $controllerPro->{$_GET['accion']}();
    } else {
        // Redirige a la página de inicio de productos si no se especifica una acción
        $controllerPro->pagInicio();
    }
} else {
    // Si no hay una sesión activa, redirige a la página de inicio de usuario
    $controller = new ControllerUser;

    if (isset($_GET['accion']) && method_exists('ControllerUser', $_GET['accion'])) {
        $controller->{$_GET['accion']}();
    } else {
        // Redirige a la página de inicio de usuario si no se especifica una acción
        $controller->pagInicio();
    }
}
?>


