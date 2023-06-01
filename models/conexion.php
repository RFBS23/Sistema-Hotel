<?php
  class Conexion{
    //Objeto que almacena la conexión
    protected $pdo;

    //Método que accede al servidor y BD
    public function Conectar(){
      $conexion = new PDO("mysql:host=localhost;port=3306;dbname=hotel;charset=utf8", "root", "");
      return $conexion;
    }

    //Método que retorna el acceso(conexión)
    public function getConexion(){
      try{
        //Almacenamos la conexión
        $pdo = $this->Conectar();

        //Controlar excepciones
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Retorno de la conexión
        return $pdo;
      }
      catch(Exception $e){
        die($e->getMessage());
      }
    }
  }
  
?>