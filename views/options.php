<?php
  //1. necesitamos saber el nivel de acceso que tiene el usuario
  //revise controlador
  $permisos = $_SESSION['iniciarSesion']['nivelacceso'];

  //2. array con los permisos por cada nivel de acceso
  $opciones = [];

  //S - A
  switch ($permisos) {
    case 'A':
      $opciones = [
        ["menu" => "<i class='fas fa-fw fa-users'></i> Clientes", "url" => "dashboard.php?view=clientes.views.php"],
        ["menu" => "<i class='fas fa-fw fa-bed'></i> Habitaciones", "url" => "habitaciones.views.php"],
        ["menu" => "<i class='fas fa-fw fa-clipboard-list'></i> Reservaciones", "url" => "reservaciones.views.php"]
      ];
    break;
    
    case 'S':
      $opciones = [
        ["menu" => "<i class='fas fa-fw fa-users'></i> Clientes", "url" => "dashboard.php?view=clientes.views.php"],
        ["menu" => "<i class='fas fa-fw fa-bed'></i> Habitaciones", "url" => "habitaciones.views.php"],
        ["menu" => "<i class='fas fa-fw fa-clipboard-list'></i> Reservaciones", "url" => "reservaciones.views.php"]
      ];
    break;
  }

  //reemplazar los items del sidebar
  foreach ($opciones as $item) {
    echo "
      <li class='nav-item'>
        <a class='nav-link' href='{$item['url']}'>
          <span>{$item['menu']}</span>
        </a>
      </li>
    ";
  }
?>