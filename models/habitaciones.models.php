<?php
  require_once 'conexion.php';

  class Habitaciones extends Conexion{

    private $acceso;

    //metodo constructor
    public function __CONSTRUCT(){
      $this->acceso = parent::getConexion();
    }

    //metodo para mostrar habitaciones
    public function listarHabitaciones(){
      try{
        $consulta = $this->acceso->prepare("CALL spu_habitaciones_listar()");
        $consulta->execute();
        $datosObtenidos = $consulta->fetchAll(PDO::FETCH_ASSOC); // arreglo asociativo
        return $datosObtenidos;
      } catch(Exception $e){
        die($e->getMessage());
      }
    }

    public function mostrarHabitacion(){
      try{
        $consulta = $this->acceso->prepare("CALL spu_habitaciones_mostrar()");
        $consulta->execute();
        $datosObtenidos = $consulta->fetchAll(PDO::FETCH_ASSOC); // arreglo asociativo
        return $datosObtenidos;
      } catch(Exception $e){
        die($e->getMessage());
      }
    }

  }
?>