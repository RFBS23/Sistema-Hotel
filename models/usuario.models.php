<?php

  require_once 'conexion.php';

  class Usuario extends Conexion{
    private $acceso;
    //constructor
    public function __CONSTRUCT(){
      $this->acceso = parent::getConexion();
    }

    public function iniciarSesion($email = ""){
      try{
        $consulta = $this->acceso->prepare("CALL spu_usuarios_login(?)");
        $consulta->execute(array($email));
  
        return $consulta->fetch(PDO::FETCH_ASSOC);
      }
      catch(Exception $e){
        die($e->getMessage());
      }
    }
  
  }
?>