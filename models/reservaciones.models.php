<?php
  require_once 'conexion.php';
  class Empleados extends Conexion{
    private $acceso;
    //metodo constructor
    public function __CONSTRUCT(){
      $this->acceso = parent::getConexion();
    }

    //metodo para traer datos de reservaciones
    public function listarEmpleados(){
      try {
        $consulta = $this->acceso->prepare("CALL spu_empleados_listar()");
        $consulta->execute();
        $datosObtenidos = $consulta->fetchAll(PDO::FETCH_ASSOC); //arreglo asociativo
        return $datosObtenidos;
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    public function listarUsuarios(){
      try{
        $consulta = $this->acceso->prepare("CALL spu_usuarios_listar()");
        $consulta->execute();
        $datosObtenidos = $consulta->fetchAll(PDO::FETCH_ASSOC); //arreglo asociativo
        return $datosObtenidos;
      } catch (Exception $e) {
        die ($e->getMessage());
      }
    }

    public function listarClientes(){
      try{
        $consulta = $this->acceso->prepare("CALL spu_personas_listar()");
        $consulta->execute();
        $datosObtenidos = $consulta->fetchAll(PDO::FETCH_ASSOC); //arreglo asociativo
        return $datosObtenidos;
      } catch (Exception $e) {
        die ($e->getMessage());
      }
    }

    public function listarReservaciones(){
      try{
        $consulta = $this->acceso->prepare("CALL spu_reservaciones_listar()");
        $consulta->execute();
        $datosObtenidos = $consulta->fetchAll(PDO::FETCH_ASSOC); //arreglo asociativo
        return $datosObtenidos;
      } catch (Exception $e) {
        die ($e->getMessage());
      }
    }

    public function listarPagos(){
      try{
        $consulta = $this->acceso->prepare("CALL spu_detallespagos_listar()");
        $consulta->execute();
        $datosObtenidos = $consulta->fetchAll(PDO::FETCH_ASSOC); //arreglo asociativo
        return $datosObtenidos;
      } catch (Exception $e) {
        die ($e->getMessage());
      }
    }

    public function registroReservaciones($datos = []){
      $response = [
        "status" => false,
        "message" => ""
      ];
      try {
        $consulta = $this->acceso->prepare("CALL spu_reservaciones_registrar(?,?,?,?,?,?,?)");
        $response["status"] = $consulta->execute(
          array(
            $datos['idempleado'],
            $datos['idusuario'],
            $datos['idhabitacion'],
            $datos['numhabitacion'],
            $datos['fechaentrada'],
            $datos['fechasalida'],
            $datos['tipocomprobante']
          )
        );
      } catch (Exception $e) {
        //die($e->getMessage());
        /*
          el objeto $e (Exception) tiene los siguientes metodos:
          getcode() - getFile() - getMessage() - getPrevious() - gettraceAsString()
        */
        $response["message"] = "No se completo el proceso. Codigo error: " . $e->getCode();
      }
      return $response;
    }

  }
?>