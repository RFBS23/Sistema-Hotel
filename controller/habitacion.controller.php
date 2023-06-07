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


    if($_POST['operacion'] == 'habitacionRegistrar'){
        $dataSave = [
            "idtipohabitacion"  => $_POST['idtipohabitacion'],
            "numcamas"          => $_POST['numcamas'],
            "numhabitacion"     => $_POST['numhabitacion'],
            "piso"              => $_POST['piso'],
            "capacidad"         => $_POST['capacidad'],
            "precio"            => $_POST['precio']

        ];

        $response = $habitacion->habitaciones_register($dataSave);
        echo json_encode($response);
    }

    if($_POST['operacion'] == 'mostrarTipoH'){
        $dataO = $habitacion->mostrarTipoH();
        if($dataO){
            echo json_encode($dataO);
        }

    }

}

?>