<?php
require_once 'conexion.php';

class Users extends Conexion{

  private $conexion;

      // Método constructor
    public function __CONSTRUCT(){
        $this->conexion = parent::getConexion();
    }

    public function usuarios_get(){
        try{
            $query = $this->conexion->prepare("CALL spu_listar_usuarios()");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);

        }
        catch(Exception $e){
            die($e->getMessage());
        }

    }



}

?>