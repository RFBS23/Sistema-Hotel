<?php
  require_once 'conexion.php';

  class Clientes extends Conexion{
    private $acceso;
    //metodo constructor
    public function __CONSTRUCT(){
      $this->acceso = parent::getConexion();
    }
    //metodo para traer datos de reservaciones
    public function listarClientes(){
      try {
        $consulta = $this->acceso->prepare("CALL spu_reservaciones_listar()");
        $consulta->execute();
        $datosObtenidos = $consulta->fetchAll(PDO::FETCH_ASSOC); //arreglo asociativo
        return $datosObtenidos;
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }
  }
  
?>