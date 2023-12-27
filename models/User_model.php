<?php

require_once "ConexionDB_model.php";
//* clase usuario para el login y registro 
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
    //! Metodo comprobar usuario y recibe por parametro un $email
    function comprobarUsuario($email){
    
        $pdo = $this->pdo->get_ObtenerConexion();
        $sentencia = $pdo->prepare("SELECT * FROM registro WHERE email=?;");
        $sentencia->bindParam(1, $email, PDO::PARAM_STR);
        $sentencia->execute();
        $resultados = $sentencia->fetch(PDO::FETCH_ASSOC);
        if ($resultados) {
            return $resultados;
        }
    }
    //* funcción para validar email
    function validarEmail($email){
        try {
            //  elimina espacios en blanco al principio y al final
            $email = trim($email);
            //  Elimina carácteres ilegales
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            //  Valida e-mail
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return $email;
            } else {
                throw new Error("El $email no es un email valido");
            }
            //  retorna email            
            return $email;
        } catch (ErrorException $e) {
            echo "Error en la validación del Email: " . $e->getMessage();
        }
    }
    // * funccion para validar contraseña
    function validarContrasenia($contrasenia){
    
        try { // elimina espacios en blanco
            $contrasenia = trim($contrasenia);
            // comprueba que la contraseña tenga al menos 8 caracteres
            if (strlen($contrasenia) < 8 || strlen($contrasenia) > 16) {
                throw new Error("La contraseña debe tener más de 7 carácteres y debe tener menos de 16");
            }
            // comprueba que la contraseña tenga al menos una letra mayúscula
            if (!preg_match('/^(?=.*[A-Z]).+$/', $contrasenia)) {
                throw new Error("La contraseña debe tener al menos una letra mayúscula");
            }
            //comprueba que la contraseña tenga al menos una letra minúscula    
            if (!preg_match('/^(?=.*[a-z]).+$/', $contrasenia)) {
                throw new Error("La contraseña debe tener al menos una letra minúscula");
            }
            //  comprueba que la contraseña tenga al menos un número
            if (!preg_match('/^(?=.*[0-9]).+$/', $contrasenia)) {
                throw new Error("La contraseña debe tener al menos un número");
            }
            //  comprueba que la contraseña tenga al menos un carácter especial
            if (!preg_match('/^(?=.*[\W_]).+$/', $contrasenia)) {
                throw new Error("La contraseña debe tener al menos un carácter especial");
            }
            return $contrasenia;
        } catch (ErrorException $e) {
            echo "Error en la validación de la contraseña: " . $e->getMessage();
        }
    }
    // * funccion contraseña correcta
    function contraseniaCorrecta($contrasenia, $contrasenaDB){
    
        $passVerificado = password_verify($contrasenia, $contrasenaDB);
        if ($passVerificado) {
            return true;
        }
    }
}
