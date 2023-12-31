<?php
require_once "ConexionDB_model.php";
class Validaciones{
    private $pdo;
    public function __construct(){
    
        $conexionBD = new ConexionDB;
        $this->pdo = $conexionBD->get_ObtenerConexion();
    }

    public function comprobarUsuario($email){// Metodo comprobar usuario y recibe por parametro un $email
        try{
            $sentencia = $this->pdo->prepare("SELECT * FROM registro WHERE email=?;");
            $sentencia->bindParam(1, $email, PDO::PARAM_STR);
            $sentencia->execute();
            $resultados = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultados;      
            }catch(PDOException $e){
                throw new Exception("Error al comprobar usuario: " . $e->getMessage());
                error_log("Ya esta en la base de datos: ". $e->getMessage());
            }
    }
    
    public function validarEmail($email){// funcción para validar email
            $email = trim($email);//  elimina espacios en blanco al principio y al final
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);//  Elimina carácteres no permitidos
            $resultado = filter_var($email, FILTER_VALIDATE_EMAIL);//  Valida e-mail
            return $resultado;
    }
    
    public function validarContrasenia($contrasenia){// funccion para validar contraseña
        try { 
            $contrasenia = trim($contrasenia);// elimina espacios en blanco
            if (strlen($contrasenia) < 8 || strlen($contrasenia) > 16) {// comprueba que la contraseña tenga al menos 8 caracteres
                throw new Error("La contraseña debe tener más de 7 carácteres y debe tener menos de 16");
            }
            if (!preg_match('/^(?=.*[A-Z]).+$/', $contrasenia)) {// comprueba que la contraseña tenga al menos una letra mayúscula
                throw new Error("La contraseña debe tener al menos una letra mayúscula");
            }
            if (!preg_match('/^(?=.*[a-z]).+$/', $contrasenia)) {//comprueba que la contraseña tenga al menos una letra minúscula
                throw new Error("La contraseña debe tener al menos una letra minúscula");
            }
            if (!preg_match('/^(?=.*[0-9]).+$/', $contrasenia)) {//  comprueba que la contraseña tenga al menos un número
                throw new Error("La contraseña debe tener al menos un número");
            }
            if (!preg_match('/^(?=.*[\W_]).+$/', $contrasenia)) {//  comprueba que la contraseña tenga al menos un carácter especial
                throw new Error("La contraseña debe tener al menos un carácter especial");
            }
            return true;
        } catch (ErrorException $e) {
            echo "Error en la validación de la contraseña: " . $e->getMessage();
        }
    }
    
    public function contraseniaCorrecta($contrasenia, $contrasenaDB){//  funccion contraseña correcta
        $passVerificado = password_verify($contrasenia, $contrasenaDB);
        if ($passVerificado) {
            return true;
        }
    }

    public static function validarNombre($nombre){//validar normbre propiedad
        if(isset($nombre) && !empty($nombre) && strlen($nombre)>=3 && is_string($nombre)){
            return true;
        }else{
            return false;
        }
    }

    public static function validarTamanio($tamanio){//validar tamanio propiedad
        if(isset($tamanio) && !empty($tamanio) && $tamanio>=1 && is_numeric($tamanio)){
            return true;
        }else{
            return false;
        }
    }

    public static function validarDormitorios($dormitorios){//validar $dormitorios propiedad
        if(isset($dormitorios) && !empty($dormitorios) &&  $dormitorios>0 && is_numeric($dormitorios)){
            return true;
        }else{
            return false;
        }
    }

    public static function validarBanios($banios){//validar baños propiedad
        if(isset($banios) && !empty($banios) && $banios>0 && is_numeric($banios)){
            return true;
        }else{
            return false;
        }
    }

    public static function validarPrecio($precio){//validar precio propiedad
        if(isset($precio) && !empty($precio) && $precio>1 && is_numeric($precio)){
            return true;
        }else{
            return false;
        }
    }

    public static function validarTipo($tipo){//validar tipo propiedad
        if(isset($tipo) && !empty($tipo) && strlen($tipo)>=3 && is_string($tipo)){
            return true;
        }else{
            return false;
        }
    }

    public static function validarImg($img){//validar img propiedad
        if(isset($img['name']) && !empty($img['name']) ){
            return true;
        }else{
            return false;
        }
    }

    public static function validarDireccion($direccion){//validar direccion propiedad
        if(isset($direccion) && !empty($direccion) && strlen($direccion)>=3 && is_string($direccion)){
            return true;
        }else{
            return false;
        }
    }

    public static function validarDescripcion($descripcion){//validar descripcion propiedad
        if(isset($descripcion) && !empty($descripcion) && strlen($descripcion)>=10 && is_string($descripcion)){
            return true;
        }else{
            return false;
        }
    }
    
}
?>