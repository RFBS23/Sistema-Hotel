<?php
    require_once 'conexion.php';

    class Registro extends Conexion{
        private $acceso;

        public function __CONSTRUCT(){
            $this->acceso = parent::getConexion();
        }

        public function listarUsuario(){
            try {
                $consulta = $this->acceso->prepare("CALL spu_usuarios_listar()");
                $consulta->execute();
                $datosObtenidos = $consulta->fetchAll(PDO::FETCH_ASSOC);
                return $datosObtenidos;
            } catch (Exception $e){
                die($e->getMessage());
            }
        }

        //utilizara el spu_usuarios_registrar
        public function registrarUsuario($datos = []){
            try {
                $consulta = $this->acceso->prepare("CALL spu_usuarios_registrar(?,?,?,?,?,?)");
                $consulta->execute(
                    array(
                        $datos['apellidos'],
                        $datos['nombres'],
                        $datos['telefono'],
                        $datos['email'],
                        $datos['claveacceso'],
                        $datos['nivelacceso']
                    )
                );
            } catch (Exception $e){
                die($e->getMessage());
            }
        }
    }
?>