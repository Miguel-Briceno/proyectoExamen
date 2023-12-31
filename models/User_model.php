<?php
require_once "Validaciones_model.php";
require_once "ConexionDB_model.php";
// clase usuario para el login y registro 
class User
{
    private $email;
    private $contrasenia;
    private $pdo;
    public function __construct($email, $contrasenia)
    {
        $this->email = $email;
        $this->contrasenia = $contrasenia;
        $this->pdo = new ConexionDB;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function getContrasenia()
    {
        return $this->contrasenia;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setContrasenia($contrasenia)
    {
        $this->contrasenia = $contrasenia;
    }
    
    // Metodo para devolver id
    public function getId($email){
        $pdo = $this->pdo->get_ObtenerConexion();
        $sentencia = $pdo->prepare("SELECT id FROM registro WHERE email=?;");
        $sentencia->bindParam(1, $email, PDO::PARAM_STR);
        $sentencia->execute();
        $resultados = $sentencia->fetch(PDO::FETCH_ASSOC);
        if ($resultados) {
            return $resultados['id'];
        }
    }

    public function set_registrar(){ // regitrar
        try{
            $pdo = $this->pdo->get_ObtenerConexion();
            $stmt = $pdo->prepare("INSERT INTO registro(email, contrasenia) VALUES(:email,:contrasenia)");
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":contrasenia", $this->contrasenia);
            $resultado=$stmt->execute();
            if($resultado){
                return $resultado;            
            }else{echo 'Algo ha fallado';}
        }catch(Exception $e){
            throw new Exception("Error al registrar usuario: " . $e->getMessage());
            error_log("Error al registrar usuario: ". $e->getMessage());
        }
    }

    public function validarUsuario(){ // metodo para validar usuario y contraseña
        try{
            $validar = new Validaciones(); // objeto validaciones
            $res = $validar->validarEmail($this->email); //validacion de email
            $res ? $this->email :error_log("debe ingresar un email valido");//asignacion de $email
            $res = $validar->validarContrasenia($this->contrasenia);//validacion de contraseña
            $res ? $this->contrasenia = $_POST['contrasenia']:error_log("debe ingresar una contraseña valida");//asignacion de $contrasenia
            }
            catch(Exception $e) {
                throw new Exception("Error al validar usuario: " . $e->getMessage());
                error_log("Error al validar usuario: ". $e->getMessage());
            }
    }
}
