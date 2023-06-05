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

    public function  listarHabitaciones(){
        try {
            $consulta = $this->acceso->prepare("CALL spu_habitaciones_listar()");
            $consulta->execute();
            $datosObtenidos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datosObtenidos;
        } catch (Exception $e){
            die($e->getMessage());
        }
    }
      public function listarPagos(){
          try{
              $consulta = $this->acceso->prepare("CALL spu_detpagos_getdata()");
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

    public function registroReservacion($datos = []){
      $response = [
        "status" => false,
        "message" => ""
      ];

      try {
        $consulta = $this->acceso->prepare("CALL spu_detallespagos_registro (?,?,?,?,?,?,?,?)");
        $response["status"] = $consulta->execute(
          array(
            $datos["idusuario"],
            $datos["idhabitacion"],
            $datos["idcliente"],
            $datos["idempleado"],
            $datos["fechaentrada"],
            $datos["fechasalida"],
            $datos["tipocomprobante"],
            $datos["formapago"]
          )
        );
      } catch (Exception $e) {
        $response["message"] = "No se completo el proceso. Codigo error: " . $e->getCode();
      }
      return $response;
    }

    public function eliminarReservaciones($idreservacion = 0){
        $respuesta = [
            "status" => false,
            "message" => ""
        ];
        try {
            $consulta = $this->acceso->prepare("CALL spu_reservaciones_eliminar(?)");
            $respuesta["status"] = $consulta->execute(array($idreservacion));
        } catch (Exception $e){
            $respuesta["message"] = "No se ha podido completar el proceso. Codigo error: " . $e->getCode();
        }
        return $respuesta;
    }

    public function actualizarReservaciones($datos = []){
        $response = [
            "status" => false,
            "message" => ""
        ];
        try {
            $consulta = $this->acceso->prepare("CALL spu_reservaciones_actualizar(?, ?, ?, ?, ?, ?, ?, ?)");
            $response["status"] = $consulta->execute(
                array(
                    $datos["idreservacion"],
                    $datos["idusuario"],
                    $datos["idhabitacion"],
                    $datos["idcliente"],
                    $datos["idempleado"],
                    $datos["fechaentrada"],
                    $datos["fechasalida"],
                    $datos["tipocomprobante"],
                )
            );
        } catch (Exception $e){
            $response["message"] = "No se ha podido completar el proceso. Codigo error: " . $e->getCode();
        }
        return $response;
    }

    public function getdataReservaciones($idreservacion = 0){
        try {
            $consulta = $this->acceso->prepare("CALL spu_reservaciones_getdata(?)");
            $consulta->execute(array($idreservacion));
            return $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e){
            die($e->getMessage());
        }
    }
  }
?>