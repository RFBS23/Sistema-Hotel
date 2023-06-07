<?php
require_once 'conexion.php';

class Habitaciones extends Conexion{

    private $conexion;

    //Método constructor
    public function __CONSTRUCT(){
        $this->conexion = parent::getConexion();
    }
    //Método para mostrar habitaciones
    public function habitacionesGet(){
        try{
            $query = $this->conexion->prepare("CALL spu_habitaciones_data()");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);

        }
        catch(Exception $e){
            die($e->getMessage());

        }
    }

    public function habitacionesDispo(){
        try{
            $query = $this->conexion->prepare("CALL spu_haDisponibles_mostrar()");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);

        }
        catch(Exception $e){
            die($e->getMessage());

        }
    }


    public function habitacionesOcup(){
        try{
            $query = $this->conexion->prepare("CALL spu_haOcupadas_mostrar()");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);

        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }

    
    public function habitacionesLimp(){
        try{
            $query = $this->conexion->prepare("CALL spu_haLimpieza_mostrar()");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);

        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function habitaciones_register($datos = []){

        $response = [
            "status" => false,
            "message" => ""
        ];

        try{
            $query = $this->conexion->prepare("CALL spu_habitaciones_registrar(?,?,?,?,?,?)");
            $response["status"] = $query->execute(
                array(
                    $datos["idtipohabitacion"],
                    $datos["numcamas"],
                    $datos["numhabitacion"],
                    $datos["piso"],
                    $datos["capacidad"],
                    $datos["precio"]                    
                    
                )
            );
        }
        catch(Exception $e){
            $response["message"] = "No se completo el proceso. Codigo error: " . $e->getCode();

        }
        return $response; 
    }


    public function mostrarTipoH(){
        try{
            $query = $this->conexion->prepare("CALL spu_mostrar_tipoH()");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);

        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }


}


?>