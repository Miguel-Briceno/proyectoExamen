<?php
require_once 'config/DBconfig.php';
class ConexionDB
{
    //* atributos de la clase

    private $host;
    private $user;
    private $password;
    private $dbname;
    private $conexion;

    //* metodo contructor de la clase se ejecuta cada vez que se cree un nuevo objeto
    public function __construct()
    {
        //* variable que guarda la cadena de conexion a la base de datos
        $this->host = HOST;
        $this->user = USER;
        $this->password = PASSWORD;
        $this->dbname = DBNAME;
        //* Metodo try cacth para tratar las distintas exepciones
        try {
            //* variable conexion que guarda el nuevo obejo de conexion a la base datos
            $this->conexion = new PDO('mysql:host=' . $this->host . '; dbname=' . $this->dbname, $this->user, $this->password);
            //* configuracion de los valores de los atributos para el manejo de errores 
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //* desactiva la emulacion de preparacion de consultas los errores son capturados
            //* por el bloque cacth
            $this->conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            throw new Exception("Error al conectar a la base de datos: " . $e->getMessage());
        }
    }
    //? metodo de la clase para conectarse
    public function get_ObtenerConexion()
    {
        return $this->conexion;
    }
    //? metodo de la clase para cerrar la conexion
    public function cerrarConexion()
    {
        $this->conexion = null;
    }
}
?>