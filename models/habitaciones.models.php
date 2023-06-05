<?php
  require_once 'conexion.php';

  class Habitaciones extends Conexion{

    private $acceso;

    //metodo constructor
    public function __CONSTRUCT(){
      $this->acceso = parent::getConexion();
    }

    //metodo para mostrar habitaciones
      public function getdataHabitaciones(){
          try {
              $consulta = $this->acceso->prepare("CALL spu_habitaciones_getdata");
              $consulta->execute();
              return $consulta->fetchAll(PDO::FETCH_ASSOC);
          } catch (Exception $e){
              die($e->getMessage());
          }
      }
      public function habitacionDisponible(){
          try {
              $consulta = $this->acceso->prepare("CALL spu_habitaciones_disponible()");
              $consulta->execute();
              return $consulta->fetchAll(PDO::FETCH_ASSOC);
          } catch (Exception $e){
              die($e->getMessage());
          }
      }
      public function habitacionOcupada(){
          try {
              $consulta = $this->acceso->prepare("CALL spu_habitaciones_ocupadas()");
              $consulta->execute();
              return $consulta->fetchAll(PDO::FETCH_ASSOC);
          } catch (Exception $e){
              die($e->getMessage());
          }
      }
      public function habitacionLimpieza(){
          try {
              $consulta = $this->acceso->prepare("CALL spu_habitaciones_limpieza()");
              $consulta->execute();
              return $consulta->fetchAll(PDO::FETCH_ASSOC);
          } catch (Exception $e){
              die($e->getMessage());
          }
      }

  }
?>