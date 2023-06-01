<?php
  //1. necesitamos saber el nivel de acceso que tiene el usuario
  //revise controlador
  $permisos = $_SESSION['login']['nivelacceso'];
  //2. array con los permisos por cada nivel de acceso
  $opciones = [];
  //S - A
  switch ($permisos) {
    case 'A':
      $opciones = [
        ["menu" => "Clientes", "url" => "index.php?view=clientes.php"],
      ];
    break;
    
    case 'S':
      $opciones = [
        ["menu" => "Clientes", "url" => "index.php?view=clientes.php"],
      ];
    break;
  }
?>