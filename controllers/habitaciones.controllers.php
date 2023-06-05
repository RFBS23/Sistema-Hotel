<?php
  require_once '../models/habitaciones.models.php';

  //si existe una conexion
  if(isset($_POST['operacion'])){

    //instanciamos la clase habitaciones
    $habitaciones = new Habitaciones();

    if ($_POST['operacion'] == 'getdataHabitaciones'){
        $datosObtenidos = $habitaciones->getdataHabitaciones();
        if ($datosObtenidos){
            echo json_encode($datosObtenidos);
        }
    }

    if ($_POST['operacion'] == 'habitacionDisponible'){
        $datosObtenidos = $habitaciones->habitacionDisponible();
        if ($datosObtenidos){
            echo json_encode($datosObtenidos);
        }
    }

    if ($_POST['operacion'] == 'habitacionOcupada'){
        $datosObtenidos = $habitaciones->habitacionOcupada();
        if ($datosObtenidos){
            echo json_encode($datosObtenidos);
        }
    }

    if ($_POST['operacion'] == 'habitacionLimpieza'){
        $datosObtenidos = $habitaciones->habitacionLimpieza();
        if ($datosObtenidos){
            echo json_encode($datosObtenidos);
        }
    }

  }
?>