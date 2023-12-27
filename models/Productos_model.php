<?php
require_once 'ConexionDB_model.php';
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

    public function obtenerPrecioConImpuestos($impuesto)
    {
        $precioConImpuestos = $this->precio * (1 + ($impuesto / 100));
        return $precioConImpuestos;
    }






    

    public function set_CrearProducto($nombre, $marca, $fabricado, $precio)
    {
        $query = $this->pdo->get_ObtenerConexion();
        $stmt = $query->prepare("INSERT INTO productos(nombre_pro,marca,fabricado,precio) VALUES(:nombre,:marca,:fabricado,:precio)");
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":marca", $marca);
        $stmt->bindParam(":fabricado", $fabricado);
        $stmt->bindParam(":precio", $precio);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return  $resultados;
    }
    public function get_ProductosById($id)
    {
        $query = $this->pdo->get_ObtenerConexion();
        $stmt = $query->prepare("SELECT * FROM productos WHERE id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return  $resultados;
    }
    public function set_ProductosById($id, $nombre, $marca, $fabricado, $precio)
    {
        $query = $this->pdo->get_ObtenerConexion();
        $stmt = $query->prepare("UPDATE productos SET nombre_pro=:nombre,marca=:marca,fabricado=:fabricado,precio=:precio WHERE id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":marca", $marca);
        $stmt->bindParam(":fabricado", $fabricado);
        $stmt->bindParam(":precio", $precio);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return  $resultados;
    }
    public function delete_ProductosById($id)
    {
        $query = $this->pdo->get_ObtenerConexion();
        $stmt = $query->prepare("DELETE FROM productos WHERE id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return  $resultados;
    }
}

?>