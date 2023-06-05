<?php
  require_once 'conexion.php';
  class Graficos extends Conexion{
    private $acceso;
    //metodo constructor
    public function __CONSTRUCT(){
      $this->acceso = parent::getConexion();
    }
    public function finSemana(){
      try {
        $consulta = $this->acceso->prepare("CALL spu_grafico_finsemana()");
        $consulta->execute();
        $datosObtenidos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $datosObtenidos;
      } catch (Exception $e) {
        die ($e->getMessage());
      }
    }
    public function montoSemanal(){
      try {
        $consulta = $this->acceso->prepare("CALL spu_grafico_total()");
        $consulta->execute();
        $datosObtenidos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $datosObtenidos;
      } catch (Exception $e) {
        die ($e->getMessage());
      }
    }
  }
?>