<?php
require_once 'models/ConexionDB_model.php';
class Producto
{   private int $id;
    private string $nombre;
    private int $precio;
    private string $descripcion;
    private $pdo;
    private $accion;
    public function __construct()
    {
        $this->pdo = new ConexionDB;
        $this->accion = array();
    }

    // Métodos para acceder y modificar atributos
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
    // metodo para obtener los productos de la base de datos
    function get_Productos(){
        try{
            $pdo = $this->pdo->get_ObtenerConexion();
            $stmt = $pdo->prepare('SELECT * FROM productos');
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;
            
        }catch(PDOException $e){
            echo $e->getMessage();
        }   
    }
    // metodo para caragar la informacion de productos del vendedor
    function get_Cargar($email){
        try{            
            $pdo = $this->pdo->get_ObtenerConexion();
            $stmt = $pdo->prepare('SELECT * FROM productos INNER JOIN registro
                                ON productos.id_vendedor = registro.id WHERE registro.email = :email');
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;
            
        }catch(PDOException $e){
            echo $e->getMessage();
        }   
    }
    public function set_CrearProducto($nombre, $precio, $descripcion, $idVendedor){
        $pdo = $this->pdo->get_ObtenerConexion();
        $stmt = $pdo->prepare("INSERT INTO productos(nombre_pro,precio_pro,descripcion_pro,id_vendedor) VALUES(:nombre_pro,:precio_pro,:descripcion_pro,:id_vendedor)");
        $stmt->bindParam(":nombre_pro", $nombre);
        $stmt->bindParam(":precio_pro", $precio);
        $stmt->bindParam(":descripcion_pro", $descripcion);
        $stmt->bindParam(":id_vendedor", $idVendedor);
        $resultado=$stmt->execute();
        if($resultado){
            return $resultado;            
        }else{echo 'Algo ha fallado';}
    }
    public function get_ProductosById($id){
        $query = $this->pdo->get_ObtenerConexion();
        $stmt = $query->prepare("SELECT * FROM productos WHERE id_pro=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return  $resultados;
    }
    public function set_ProductosById($id, $nombre, $precio, $descripcion, $idVendedor)
    {
        $pdo = $this->pdo->get_ObtenerConexion();
        $stmt = $pdo->prepare("UPDATE productos SET nombre_pro=:nombre,precio_pro=:precio,descripcion_pro=:descripcion,id_vendedor=:idVendedor WHERE id_pro=:id");
        $stmt->bindParam(":id", $id,PDO::PARAM_INT);
        $stmt->bindParam(":nombre", $nombre,PDO::PARAM_STR);
        $stmt->bindParam(":precio", $precio,PDO::PARAM_INT);
        $stmt->bindParam(":descripcion", $descripcion,PDO::PARAM_STR);
        $stmt->bindParam(":idVendedor", $idVendedor,PDO::PARAM_INT);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return  $resultados;
    }
    public function delete_ProductosById($id)
    {
        $query = $this->pdo->get_ObtenerConexion();
        $stmt = $query->prepare("DELETE FROM productos WHERE id_pro=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return  $resultados;
    }
}

?>