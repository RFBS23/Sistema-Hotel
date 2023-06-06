<?php

require_once 'conexion.php';

class Reservaciones extends Conexion{

    private $conexion;

    // Método constructor
    public function __CONSTRUCT(){
        $this->conexion = parent::getConexion();
    }

    //Metodo para traer datos de la BD
    public function recuperar_data($procedure){
        try{
            $query = $this->conexion->prepare($procedure);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function empleado_get(){
        
       $emple = $this->recuperar_data("CALL spu_recuperar_empleados()");
       return $emple;
    }

    public function usuario_get(){
        $user = $this->recuperar_data("CALL spu_recuperar_usuarios()");
        return $user;
    }

    public function habitacion_get(){
        $ht = $this->recuperar_data("CALL spu_recuperar_habitaciones()");
        return $ht;
    }

    public function pagos_get(){
        $pagos = $this->recuperar_data("CALL spu_pagos_get()");
        return $pagos;
    }


    public function reservaciones_get(){
        try{
            $query = $this->conexion->prepare("CALL spu_reservaciones_get()");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);

        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function clientes_buscar(){
        try{
            $query = $this->conexion->prepare("CALL spu_recuperar_clientes()");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
            
        }catch(Exception $e){
            die($e->getMessage());

        }
    }

    public function reservaciones_register($datos = []){

        $response = [
            "status" => false,
            "message" => ""
        ];

        try{
            $query = $this->conexion->prepare("CALL spu_pagos_registrar (?,?,?,?,?,?,?,?)");
            $response["status"] = $query->execute(
                array(
                    $datos["idusuario"],
                    $datos["idhabitacion"],
                    $datos["idcliente"],
                    $datos["idempleado"],
                    $datos["fechaentrada"],
                    $datos["fechasalida"],
                    $datos["tipocomprobante"],
                    $datos["mediopago"]
                    
                )
            );
        }
        catch(Exception $e){
            $response["message"] = "No se completo el proceso. Codigo error: " . $e->getCode();

        }
        return $response; 
    }

    public function reservaciones_eliminar($idreservacion = 0){
        $respuesta = [
            "status" => false,
            "message" => ""
        ];

        try{
            $query = $this->conexion->prepare("CALL spu_reservaciones_eliminar(?)");
            $respuesta["status"] = $query->execute(array($idreservacion));

        }
        catch(Exception $e){
            $respuesta["message"] = "No se ha podido completar el proceso. Codigo error: " . $e->getCode();

        }

        return $respuesta;

    }

    public function reservaciones_update($datos = []){
        $response = [
            "status" => false,
            "message" => ""
        ];

        try{
            $query = $this->conexion->prepare("CALL spu_reservaciones_update(?,?,?,?,?,?,?,?)");
            $response["status"] = $query->execute(
                array(
                    $datos["idreservacion"],
                    $datos["idusuario"],
                    $datos["idhabitacion"],
                    $datos["idcliente"],
                    $datos["idempleado"],
                    $datos["fechaentrada"],
                    $datos["fechasalida"],
                    $datos["tipocomprobante"]                    
                )
            );
        }
        catch(Exception $e){
            $response["message"] = "No se completo el proceso. Codigo error: " . $e->getCode();

        }
        return $response; 


    }

    public function recuperarReserv($idreservacion = 0){
        try{
            $query = $this->conexion->prepare("CALL spu_reservaciones_recuperar(?)");
            $query->execute(array($idreservacion));
            return $query->fetch(PDO::FETCH_ASSOC);

        }
        catch(Exception $e){
            die($e->getMessage());

        }
    }

}
?>