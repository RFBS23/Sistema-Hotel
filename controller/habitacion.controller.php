<?php

require_once '../model/habitacion.php';

if(isset($_POST['operacion'])){

    $habitacion = new Habitaciones();

    if($_POST['operacion'] == 'habitacionGet'){
        $dataObtenida = $habitacion->habitacionesGet();
        if($dataObtenida){
            echo json_encode($dataObtenida);
        }  
    }

    if($_POST['operacion'] == 'hDisponiblesGet'){
        $dataO = $habitacion->habitacionesDispo();
        if($dataO){
            echo json_encode($dataO);
        }

    }

    if($_POST['operacion'] == 'hOcupadasGet'){
        $dataO = $habitacion->habitacionesOcup();
        if($dataO){
            echo json_encode($dataO);
        }

    }

    if($_POST['operacion'] == 'hLimpiezaGet'){
        $dataO = $habitacion->habitacionesLimp();
        if($dataO){
            echo json_encode($dataO);
        }

    }


}

?>