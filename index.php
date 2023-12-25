<?php
require_once 'config/config.php';
require_once 'controllers/userNameControler.php';

$controller = new Controller;
if (isset($_GET['accion'])) {
    method_exists('Controller', $_GET['accion']) ? $controller->{$_GET['accion']}() : $controller->pagInicio();
} else {
    $controller->pagInicio();
    
}

