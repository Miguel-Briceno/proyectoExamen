<?php

//! requiere el modelo siguiente
require_once('models/User_model.php');

//! clase accion controller que es requerida por el index del proyecto
class ControllerProductos{
    //! definimos variable privada
    private $accion; 
    //! constructor de la clase   
    public function __construct(){
        $this->accion = new Producto();
    }
    //! metodos estaticos mostrar
    public function index(){
        $producto = new Producto();
        $resultados = $producto->get_Productos();        
    }
    //! metodo cargar
    public function cargar($usuario){
        $producto = new Producto();
        $resultados = $producto->get_Cargar($usuario);
        return $resultados;
        require_once 'views/producto/productos.php';        
    }

    //! metodo agregar
    public function agregar(){
        require_once "view/agregar.php";
    }
    public function salvar(){
        if(isset($_POST['accion'])&&$_POST['accion']=='Salvar'){            
            $nombre = $_REQUEST['nombre_pro'];
            $marca = $_REQUEST['marca'];
            $fabricado = $_REQUEST['fabricado'];
            $precio = $_REQUEST['precio'];            
            $producto = new Producto();
            $resultados = $producto->set_CrearProducto($nombre,$marca,$fabricado,$precio);

            exit;
        }else{echo "Datos de producto faltantes o inválidos";}

    }
    //? metodo editar
    public static function editar(){
        if(isset($_GET['accion'])&& $_GET['accion']=='editar')
        {$id = $_GET['id'];
        $producto = new Producto();
        $resultados = $producto->get_ProductosById($id);
        require_once "view/editar.php";}
    }

    //? metodo actualizar
    public static function actualizar(){
        if(isset($_POST['accion'])&& $_POST['accion']=='Editar'){
            $id = $_POST['id'];
            $nombre = $_POST['nombre_pro'];
            $marca = $_POST['marca'];
            $fabricado = $_POST['fabricado'];
            $precio = $_POST['precio'];            
            $producto = new Producto();
            $resultados = $producto->set_ProductosById($id, $nombre, $marca, $fabricado, $precio);
            

        }else{echo "Datos de producto faltantes o inválidos";}

    }
    //? metodo eliminar
    public static function eliminar(){
        if(isset($_GET['accion'])&& $_GET['accion']=='eliminar'){
            $id = $_GET['id'];  
            $producto = new Producto();
            $resultados = $producto->delete_ProductosById($id);


        }else{echo "Datos de producto faltantes o inválidos";}

    }
}




?>