<?php

require_once '../model/graficos.php';

if(isset($_POST['operacion'])){

    $grafico = new Graficos();

    if($_POST['operacion'] == 'diasReservaciones'){
        $datos = $grafico->getTotalSemana();
        if($datos){
            echo json_encode($datos);
        }

    }

    if($_POST['operacion'] == 'montoSemanal'){
        $datos = $grafico->getMontoSemana();
        if($datos){
            echo json_encode($datos);
        }
    }
}



?>