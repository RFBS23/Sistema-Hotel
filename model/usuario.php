<?php
require_once 'conexion.php';

class Usuario extends Conexion{

    //Objeto
    private $acceso;

    // Método Constructor 
    public function __CONSTRUCT(){
        $this->acceso = parent::getConexion();
    }

    public function iniciarSesion($email = ""){
        //Instrución try-catch
        try{
            $consulta = $this->acceso->prepare("CALL spu_usuarios_iniciarS(?)");
            $consulta->execute(array($email));

            return $consulta->fetch(PDO::FETCH_ASSOC);

        }
        catch(Exception $e){
            die($e->getMessage());

        }
    }


}


?>