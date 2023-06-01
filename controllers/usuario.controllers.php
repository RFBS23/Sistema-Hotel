<?php

  //Iniciamos/heredamos la sesión
  session_start();
  
  //La sesión contendrá datos del login en formato de arreglo
  $_SESSION["iniciarSesion"] = [];

  require_once '../models/usuario.models.php';

  //Si existe una operacion (INTENCIÓN DEL USUARIO)
  if (isset($_GET['operacion'])){

    //Instancia clase Usuario
    $usuario = new Usuario();

    if ($_GET['operacion'] == 'iniciarSesion'){

      $acceso = [
        "login"       => false,
        "apellidos"   => "",
        "nombres"     => "",
        "nivelacceso" => "",
        "mensaje"     => ""
      ];

      $data = $usuario->iniciarSesion($_GET['email']);
      $claveIngresada = $_GET['password']; //No está encriptada

      if ($data){
        if (password_verify($claveIngresada, $data["claveacceso"])){        
          //Registrar datos de acceso
          $acceso["login"] = true;
          $acceso["apellidos"] = $data["apellidos"];
          $acceso["nombres"] = $data["nombres"];
          $acceso["nivelacceso"] = $data["nivelacceso"];
        }else{
          $acceso["mensaje"] = "Error en la contraseña";
        }
      }else{
        $acceso["mensaje"] = "Usuario no encontrado";
      }

      $_SESSION["iniciarSesion"] = $acceso;
      //Enviar el objeto $acceso a la vista
      echo json_encode($acceso);
    } //Fin operacion = iniciarSesion
  }

?>