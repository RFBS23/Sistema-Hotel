<?php
  require_once '../models/reservaciones.models.php';

  //si existe una conexion
  if(isset($_POST['operacion'])){
    //instanciamos la clase reservaciones
    $empleados = new Empleados();

    if ($_POST['operacion'] == 'listarEmpleados') {
      $data = $empleados->listarEmpleados();
      if ($data) {
        echo json_encode($data);
      }
    }

    if ($_POST['operacion'] == 'listarUsuarios') {
      $data = $empleados->listarUsuarios();
      if ($data) {
        echo json_encode($data);
      }
    }

    if ($_POST['operacion'] == 'listarPagos') {
      $data = $empleados->listarPagos();
      if ($data) {
        echo json_encode($data);
      }
    }

    if ($_POST['operacion'] == 'listarClientes') {
      $data = $empleados->listarClientes();
      if ($data) {
        echo json_encode($data);
      }
    }

    if ($_POST['operacion'] == 'registroReservaciones') {
      $datos = [
        "cliente" => $_POST['idcliente'],
        "empleado" => $_POST['idempleado'],
        "nombres" => $_POST['idusuario'],
        "categoria" => $_POST['idhabitacion'],
        "fechaentrada" => $_POST['fechaentrada'],
        "fechasalida" => $_POST['fechasalida'],
        "comprobante" => $_POST['tipocomprobante'],
        "pago" => $_POST['formapago']
      ];
      /*
      $data = $empleados->registroReservaciones($datos);
      if ($data) {
        echo json_encode($data);
      }
      */
      
      $response = $empleados->registroReservaciones($datos);
      echo json_encode($response);
    }

  }
?>