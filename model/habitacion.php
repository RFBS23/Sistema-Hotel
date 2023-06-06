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


}


?>