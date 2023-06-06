<?php
require_once 'conexion.php';

class Graficos extends Conexion{

  private $conexion;
  
     //Método constructor
     public function __CONSTRUCT(){
      $this->conexion = parent::getConexion();
  }

    public function getTotalSemana(){
      try{
        $query = $this->conexion->prepare("CALL spu_mostrarNventas_grafico()");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);

      }
      catch(Exception $e){
        die($e->getMessage());
      }
    }


    public function getMontoSemana(){
      try{
        $query = $this->conexion->prepare("CALL spu_montoTotal_grafico()");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);

      }
      catch(Exception $e){
        die($e->getMessage());

      }
    }


}

?>