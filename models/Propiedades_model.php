<?php
require_once 'models/ConexionDB_model.php';
class Propiedad
{   
    private $id;
    private $nombre;
    private $tamanio;
    private $dormitorios;
    private $banios;
    private $precio;
    private $tipo;
    private $img;
    private $direccion;
    private $descripcion;
    private $idVendedor;    
    private $pdo;
    private $conexionDB;    
    public function __construct()
    {
        $this->conexionDB = new ConexionDB;       
        $this->pdo=$this->conexionDB->get_ObtenerConexion();        
    }
    
    // metodo para obtener los productos de la base de datos
    function get_Propiedades(){
        try{
            $stmt = $this->pdo->prepare('SELECT * FROM propiedades');
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);            
            return $resultados;
            
        }catch(PDOException $e){
            throw new Exception("Error al obtener propiedades: " . $e->getMessage());
            error_log("Error al obtener propiedades: ". $e->getMessage());            
        }   
    }
    // metodo para caragar la informacion de productos del vendedor
    function get_Cargar($email){
        try{       // se hace asi la consulta para no pedir todos los resultados y que traiga los resultados del vendedor     
            $stmt = $this->pdo->prepare('SELECT propiedades.id, propiedades.nombre_pro, 
            propiedades.tamanio_pro, propiedades.dormitorios_pro, propiedades.banios_pro, 
            propiedades.precio_pro, propiedades.tipo_pro, propiedades.img_pro, 
            propiedades.direccion_pro,
            propiedades.descripcion_pro FROM propiedades 
                                    INNER JOIN registro
                                    ON propiedades.id_vendedor = registro.id    
                                    WHERE registro.email = :email');
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);            
            return $resultados;
            
        }catch(PDOException $e){
            throw new Exception("Error al cargar propiedades: " . $e->getMessage());
            error_log("Error al cargar propiedades: ". $e->getMessage());
        }   
    }
    public function set_CrearPropiedad($nombre, $tamanio, $dormitorios, $banios, $precio, $tipo, $imagen, $direccion, $descripcion, $idVendedor){
        try{
        $stmt = $this->pdo->prepare("INSERT INTO propiedades(nombre_pro, tamanio_pro, dormitorios_pro, banios_pro, precio_pro, tipo_pro, img_pro, direccion_pro, descripcion_pro, id_vendedor) 
        VALUES(:nombre_pro,:tamanio_pro,:dormitorios_pro,:banios_pro,:precio_pro,:tipo_pro,:img_pro,:direccion_pro,:descripcion_pro,:id_vendedor)");
        $stmt->bindParam(":nombre_pro", $nombre);
        $stmt->bindParam(":tamanio_pro", $tamanio);
        $stmt->bindParam(":dormitorios_pro", $dormitorios);
        $stmt->bindParam(":banios_pro", $banios);
        $stmt->bindParam(":precio_pro", $precio);
        $stmt->bindParam(":tipo_pro", $tipo);
        $stmt->bindParam(":img_pro", $imagen);
        $stmt->bindParam(":direccion_pro", $direccion);
        $stmt->bindParam(":descripcion_pro", $descripcion);
        $stmt->bindParam(":id_vendedor", $idVendedor);
        $resultado=$stmt->execute();            
        return $resultado;             
        }catch(PDOException $e){
            throw new Exception("Error al crear propiedad: " . $e->getMessage());
            error_log("Error al crear propiedad: ". $e->getMessage());
        }
    }
    public function get_PropiedadesById($id){      
        try{
            $stmt = $this->pdo->prepare("SELECT * FROM propiedades WHERE id=:id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return  $resultados;
        }catch(PDOException $e){
            throw new Exception("Error al obtener propiedad: " . $e->getMessage());
            error_log("Error al obtener propiedad: ". $e->getMessage());
        }
    }
    public function set_PropiedadesById($id, $nombre,$tamanio,$dormitorios,$banios, $precio,$tipo,$img,$direccion, $descripcion, $idVendedor)
    {
        
        try{
            $stmt = $this->pdo->prepare("UPDATE propiedades SET nombre_pro=:nombre,tamanio_pro=:tamanio_pro, dormitorios_pro=:dormitorios_pro,
                                    banios_pro=:banios_pro, precio_pro=:precio,tipo_pro=:tipo_pro, img_pro=:img_pro, direccion_pro=:direccion_pro,descripcion_pro=:descripcion,id_vendedor=:idVendedor WHERE id_pro=:id");
            $stmt->bindParam(":id_pro", $id);
            $stmt->bindParam(":nombre_pro", $nombre);
            $stmt->bindParam(":tamanio_pro", $tamanio);
            $stmt->bindParam(":dormitorios_pro", $dormitorios);
            $stmt->bindParam(":banios_pro", $banios);
            $stmt->bindParam(":precio_pro", $precio);
            $stmt->bindParam(":tipo_pro", $tipo);
            $stmt->bindParam(":img_pro", $img);
            $stmt->bindParam(":direccion_pro", $direccion);
            $stmt->bindParam(":descripcion_pro", $descripcion);
            $stmt->bindParam(":id_vendedor", $idVendedor);
            $stmt->execute();
            $anuncio="Datos cargados con exito";
            echo $anuncio;
        }catch(PDOException $e){
            throw new Exception("Error al actualizar propiedad: " . $e->getMessage());
            error_log("Error al actualizar propiedad: ". $e->getMessage());
        }
    }
    public function delete_PropiedadesById($id){    
        try{
            $stmt = $this->pdo->prepare("DELETE FROM propiedades WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            
        }catch(PDOException $e){
            throw new Exception("Error al eliminar propiedad: " . $e->getMessage());
            error_log("Error al eliminar propiedad: ". $e->getMessage());
        }
    }
    public function get_PropiedadesByFiltro($filtro,$idVendedor){
        try{
            if($filtro==="precio"){
                $sql = "SELECT * FROM propiedades WHERE id_vendedor=:id_vendedor ORDER BY precio_pro";
            }
            elseif ($filtro=="nombre"){
                $sql = "SELECT * FROM propiedades WHERE id_vendedor=:id_vendedor ORDER BY nombre_pro";
            }else{
                $sql = "SELECT * FROM propiedades WHERE id_vendedor=:id_vendedor ORDER BY tipo_pro";
            }
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id_vendedor', $idVendedor);            
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return  $resultados;
        }catch(PDOException $e){
            throw new Exception("Error al obtener propiedad: " . $e->getMessage());
            error_log("Error al obtener propiedad: ". $e->getMessage());
        }
    }

    public function crearImagenes($img){
        $carpeta = 'asset/img/';
        $imagen = md5(uniqid(rand())).'.jpg';
        move_uploaded_file($img['tmp_name'], $carpeta.$imagen);
        return $imagen;    
    }
}

?>