<?php

// requiere el modelo siguiente
require_once('models/User_model.php');
require_once('models/Productos_model.php');

// clase accion controller que es requerida por el index del proyecto
class ControllerProductos{

    public function pagInicio(){
        $producto = new Producto();
        $resultados = $producto->get_Productos();
        require_once "views/user/index.php";
    }
     //public function index(){
     //   $producto = new Producto();
     //   $resultados = $producto->get_Productos();        
    //}
    // metodo cargar
    public function cargar($usuario){
        $producto = new Producto();
        $resultados = $producto->get_Cargar($usuario);
        return $resultados;
        require_once 'views/producto/productos.php';        
    }

    // metodo agregar
    public function agregar(){
        require_once "views/producto/agregar.php";
    }
    public function addProducto(){
        if(isset($_GET['accion']) && $_POST['addProducto']=='salvar'){
            $nombre = $_REQUEST['nombre'];
            $precio = $_REQUEST['precio'];
            $descripcion = $_REQUEST['descripcion'];
            $idVendedor = $_SESSION['id'];            
            $producto = new Producto();
            $resultados=$producto->set_CrearProducto($nombre,$precio,$descripcion,$idVendedor);
            if($resultados=true){
                $productos= new ControllerProductos;
                $resultados = $productos->cargar($_SESSION['usuario']);                    
                require_once "views/producto/productos.php";
            }
        }else{echo "Datos de producto faltantes o inválidos";}

    }
    //? metodo editar
    public static function editar(){
        if(isset($_GET['accion'])&& $_GET['accion']=='editar')
        {$id = $_GET['id_pro'];
        $producto = new Producto();
        $resultados = $producto->get_ProductosById($id);
        require_once "views/producto/editar.php";}
    }

    //? metodo actualizar
    public static function actualizar(){
        if(isset($_POST['accion'])&& $_POST['accion']=='Editar'){
            $id = $_POST['id_pro'];
            $nombre = $_POST['nombre_pro'];
            $precio = $_POST['precio_pro'];
            $descripcion = $_POST['descripcion_pro'];
            $idVendedor = $_POST['id_vendedor'];            
            $producto = new Producto();
            $producto->set_ProductosById($id, $nombre, $precio, $descripcion, $idVendedor);
            $productos= new ControllerProductos;
            $resultados = $productos->cargar($_SESSION['usuario']);
            require_once "views/producto/productos.php";

        }else{echo "Datos de producto faltantes o inválidos";}

    }
    //? metodo eliminar
    public static function eliminar(){
        if(isset($_GET['accion'])&& $_GET['accion']=='eliminar'){
            $id = $_GET['id_pro'];  
            $producto = new Producto();
            $resultados = $producto->delete_ProductosById($id);
            $productos= new ControllerProductos;
            $resultados = $productos->cargar($_SESSION['usuario']);
            require_once "views/producto/productos.php";
        }else{echo "Datos de producto faltantes o inválidos";}

    }
}




?>