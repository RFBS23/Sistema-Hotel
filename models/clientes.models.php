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
        $consulta = $this->acceso->prepare("CALL spu_personas_listar()");
        $consulta->execute();

        $datosObtenidos = $consulta->fetchAll(PDO::FETCH_ASSOC); //arreglo asociativo
        return $datosObtenidos;
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Enviaremos un solo elemento (ARRAY ASOCIATIVO) conteniendo los 7 valores requeridos por el SPU
    public function registrarCliente($datos = []){
      try {
        $consulta = $this->acceso->prepare("CALL spu_personas_registrar(?, ?, ?, ?, ?)");
        $consulta->execute(
          array(
            $datos['nombres'],
            $datos['apellidos'],
            $datos['dni'],
            $datos['telefono'],
            $datos['fechanacimiento']
          )
        );
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    public function actualizaClientes($datos = []){
      try {
        $consulta = $this->acceso->prepare("CALL spu_personas_actualizar(?, ?, ?, ?, ?, ?)");
        $consulta->execute(
          array(
            $datos['idpersona'],
            $datos['nombres'],
            $datos['apellidos'],
            $datos['dni'],
            $datos['telefono'],
            $datos['fechanacimiento']
          )
        );
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    public function buscarClientes($dni = ''){
      try{
        $consulta = $this->acceso->prepare("CALL spu_personas_buscar_dni(?)");
        $consulta->execute(array($dni));

        //se utiliza solo fetch en lugar de fetchall por que solo esperamos como maximo 1 registro
        return $consulta->fetch(PDO::FETCH_ASSOC);
      } catch(Exception $e){
        die($e->getMessage());
      }
    }

    public function eliminarClientes($idpersona = 0){
      try {
        $consulta = $this->acceso->prepare("CALL spu_personas_eliminar(?)");
        $consulta->execute(array($idpersona));
      } catch (Exception $e) {
        die($e->getMEssage());
      }
    }

    public function getData($idpersona = 0){
      try {
        $consulta = $this->acceso->prepare("CALL spu_personas_getdata(?)");
        $consulta->execute(array($idpersona));
        return $consulta->fetch(PDO::FETCH_ASSOC);
        
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

  }
  
?>