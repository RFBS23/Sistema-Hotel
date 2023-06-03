<?php
  require_once '../models/habitaciones.models.php';

  //si existe una conexion
  if(isset($_POST['operacion'])){

    //instanciamos la clase habitaciones
    $habitaciones = new Habitaciones();

    if($_POST['operacion'] == 'listarHabitaciones') {
      $data = $habitaciones->listarHabitaciones();
      if ($data) {
        echo json_encode($data);
      }
    }

    if($_POST['operacion'] == 'mostrarHabitacion') {
      $data = $habitaciones->mostrarHabitacion();
      if ($data) {
        echo json_encode($data);
      }
    }
  }
?>