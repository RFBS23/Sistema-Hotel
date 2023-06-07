<?php
require_once  'conexion.php';

class Clientes extends Conexion{

    private $conexion;

    public function __CONSTRUCT(){
        $this->conexion = parent::getConexion();
    }

    public function clientes_listar(){
        try{
            $query = $this->conexion->prepare("CALL spu_cliente_listar()");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);

        }
        catch(Exception $e){
            die($e->getMessage());

        }
    }

    public function clientes_registrar($data = []){

        $response = [
            "status" => false,
            "message" => ""
        ];

        try{
            $query = $this->conexion->prepare("CALL spu_cliente_registrar(?,?,?,?,?)");
            $response["status"] = $query->execute(array(

                $data['nombres'],
                $data['apellidos'],
                $data['dni'],
                $data['telefono'],
                $data['fechaNac']

            ));

        }
        catch(Exception $e){
            $response["message"] = "No se completo el proceso. Codigo error: " . $e->getCode();

        }
        return $response;
    }
}


?>