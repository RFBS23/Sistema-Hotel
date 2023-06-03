<?php
  session_start();
  //1.- obteniendo nivel de acceso (LOGIN)
  $nivelacceso = $_SESSION['iniciarSesion']['nivelacceso'];
  //$nivelacceso = "ADM";

  //.2- obtener el nombre de la vista
  $url = $_SERVER['REQUEST_URI'];
  $url_array = explode("/", $url);
  $vistaActiva = $url_array[count($url_array) - 1];
  //var_dump($vistaActiva);

  //3.- definir los permisos
  $permisos = [
    "A" => ["clientes.views.php", "habitaciones.views.php", "reservaciones.views.php"],
    "S" => ["clientes.views.php", "habitaciones.views.php", "reservaciones.views.php"]
  ];

  //4.- validar el acceso 
  $autorizado = false;
  
  //5.- comprobar los permisos
  $vistasPermitidas = $permisos[$nivelacceso];
  foreach($vistasPermitidas as $item){
    if ($item == $vistaActiva){
      $autorizado = true;
    }
  }
  if (!$autorizado) {
    //cargar una vista
    //echo "<h1>Acceso Restringido</h1>";
    require_once '404.php';
    exit();
  }
?>