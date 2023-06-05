<?php
  require_once '../models/graficos.models.php';
  
  if (isset($_POST['operacion'])) {

    $grafico = Graficos();

    if($_POST['operacion'] == 'finSemana'){
      $data = $grafico->finSemana();
      if ($data) {
        echo json_encode($data);
      }
    }

    if($_POST['operacion'] == 'montoSemanal'){
      $data = $grafico->montoSemanal();
      if ($data) {
        echo json_encode($data);
      }
    }

  }
?>