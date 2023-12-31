<?php

// requiere el modelo siguiente
require_once('models/User_model.php');
require_once('models/Propiedades_model.php');

// clase accion controller que es requerida por el index del proyecto
class ControllerPropiedades{

    public function pagInicio(){//metodo que lleva al index y muestra listado de productos tabla
        $propiedad = new Propiedad();
        $resultados = $propiedad->get_Propiedades();
        require_once "views/user/index.php";
    }
    
    public function cargar($usuario){// metodo cargar
        $propiedad = new Propiedad();
        $resultados = $propiedad->get_Cargar($usuario); // cargar propiedades por usuario        
        require_once 'views/propiedad/propiedades.php';        
    }

    
    public function agregar(){// metodo agregar para facilitarnos el formulario
        require_once "views/propiedad/agregar.php";
    }
    public function addPropiedad(){// metodo para agregar a la bbdd una propiedad
        try{
            if(isset($_GET['accion']) && $_POST['addPropiedad']=='salvar'){
                $validacion = new Validaciones();
                $correcto = $validacion->validarNombre($_POST['nombre']);
                $correcto?$nombre = $_REQUEST['nombre']:throw new Exception("valor nombre no valido");
                $correcto = $validacion->validarTamanio($_POST['tamanio']);
                $correcto?$tamanio = $_REQUEST['tamanio']:throw new Exception("valor nombre no valido");
                $correcto = $validacion->validarDormitorios($_POST['dormitorios']);
                $correcto?$dormitorios = $_REQUEST['dormitorios']:throw new Exception("valor nombre no valido");
                $correcto = $validacion->validarBanios($_POST['banios']);
                $correcto?$banios = $_REQUEST['banios']:throw new Exception("valor nombre no valido");
                $correcto = $validacion->validarPrecio($_POST['precio']);
                $correcto?$precio = $_REQUEST['precio']:throw new Exception("valor nombre no valido");
                $correcto = $validacion->validarTipo($_POST['tipo']);
                $correcto?$tipo = $_REQUEST['tipo']:throw new Exception("valor nombre no valido");
                $correcto = $validacion->validarImg($_FILES['img']);                
                if($correcto){
                    $imagen = new Propiedad;
                    $imagen = $imagen->crearImagenes($_FILES['img']);
                }                
                $correcto = $validacion->validarDireccion($_POST['direccion']);
                $correcto?$direccion = $_REQUEST['direccion']:throw new Exception("valor nombre no valido");
                $correcto = $validacion->validarDescripcion($_POST['descripcion']);
                $correcto?$descripcion = $_REQUEST['descripcion']:throw new Exception("valor nombre no valido");
                $idVendedor = $_SESSION['id'];            
                $propiedad = new Propiedad();
                $resultados=$propiedad->set_CrearPropiedad($nombre,$tamanio,$dormitorios,$banios,$precio,$tipo,$imagen,$direccion,$descripcion,$idVendedor);
                if($resultados=true){
                    $propiedades= new ControllerPropiedades;
                    $resultados = $propiedades->cargar($_SESSION['usuario']);// se pueden cargar las propiedades por el id y se reutiliza el codigo
                    //pero para efectos de los requisitos en el metodo cargar se hace un join                    
                    require_once "views/propiedad/propiedades.php";
                }
            }else{echo "Datos de producto faltantes o inválidos";}
        }catch (Exception $e) { 
            throw new Exception("Error al obtener propiedades del usuario: " . $e->getMessage());
                error_log("Error al obtener propiedades del usuario". $e->getMessage());
            }

    }
    // metodo editar
    public static function editar(){//Metodo que muestra los datos de la propiedad para ser editados
        try{
            if(isset($_GET['accion'])&& $_GET['accion']=='editar'){
                $id = $_GET['id'];
                $propiedad = new Propiedad();
                $resultados = $propiedad->get_PropiedadesById($id);
                require_once "views/propiedad/editar.php";
            }
        }
        catch (Exception $e) {
            throw new Exception("Error al editar propiedad: " . $e->getMessage());
            error_log("Error al editar propiedad: ". $e->getMessage());
        }
    }
    
    public static function actualizar(){// metodo actualizar
        try{   
            if(isset($_POST['accion'])&& $_POST['accion']=='Editar'){
                $id = $_POST['id_pro'];
                $nombre = $_POST['nombre_pro'];
                $tamanio = $_POST['tamanio_pro'];
                $dormitorios = $_POST['dormitorios_pro'];
                $banios = $_POST['banios_pro'];
                $precio = $_POST['precio_pro'];
                $tipo = $_POST['tipo_pro'];
                $img = $_POST['img_pro'];
                $direccion = $_POST['direccion_pro'];
                $descripcion = $_POST['descripcion_pro'];
                $idVendedor = $_POST['id_vendedor'];            
                $propiedad = new Propiedad();
                $propiedad->set_PropiedadesById($id, $nombre,$tamanio,$dormitorios,$banios, $precio,$tipo,$img,$direccion, $descripcion, $idVendedor);
                $propiedades= new ControllerPropiedades;
                $resultados = $propiedades->cargar($_SESSION['usuario']);
                require_once "views/propiedad/propiedades.php";

            }else{echo "Datos de producto faltantes o inválidos";}
        }catch (Exception $e) {
            throw new Exception("Error al actualizar propiedad: " . $e->getMessage());
            error_log("Error al actualizar propiedad: ". $e->getMessage());
        }

    }
    
    public static function eliminar(){// metodo eliminar
        try{
            if(isset($_GET['accion'])&& $_GET['accion']=='eliminar'){
                $id = $_GET['id'];  
                $propiedad = new Propiedad();
                $propiedad->delete_PropiedadesById($id);
                $propiedades= new ControllerPropiedades;
                $propiedades->cargar($_SESSION['usuario']);
            }else{echo "Datos de producto faltantes o inválidos";}
        }
        catch (Exception $e) {
            throw new Exception("Error al eliminar propiedad: " . $e->getMessage());
            error_log("Error al eliminar propiedad: ". $e->getMessage());
        }

    }
    
    public function cerrarSession(){// metodo que nos permite cerrar la session
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit;
    }

    public function atras(){// metodo que nos permite ir hacia atras en las vistas de producto
    $propiedades= new ControllerPropiedades;
    $resultados = $propiedades->cargar($_SESSION['usuario']);
    require_once "views/propiedad/propiedades.php";
    }

    public function filtrar(){
        if($_POST['realizar']==="filtro"){
            $filtro = $_POST['filtro'];
            $idVendedor = $_SESSION['id'];
            $propiedad = new Propiedad();
            $resultados = $propiedad->get_PropiedadesByFiltro($filtro,$idVendedor);
            require_once "views/propiedad/propiedades.php";
        }
    }
    public function ver(){
        if(isset($_GET['accion'])&& $_GET['accion']=='ver'){
            $id = $_GET['id'];
            $propiedad = new Propiedad();
            $resultados = $propiedad->get_PropiedadesById($id);
            require_once "views/propiedad/ver.php";
        }
    }

}
?>