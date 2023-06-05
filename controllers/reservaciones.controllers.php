<?php
    session_start();
  require_once '../models/reservaciones.models.php';

  //si existe una conexion
  if(isset($_POST['operacion'])){
    //instanciamos la clase reservaciones
    $empleados = new Empleados();

    // cliente buscar
    if ($_POST['operacion'] == 'listarClientes'){
        $data = $empleados->listarClientes();
        if ($data) {
            echo json_encode($empleados->listarClientes());
        }
    }

    if ($_POST['operacion'] == 'listarReservaciones'){
        $data = $empleados->listarReservaciones();
        if ($data){
            foreach ($data as $registro){
                echo "
                    <tr>
                        <td>{$registro['idreservacion']}</td>                    
                        <td>{$registro['cliente']}</td>
                        <td>{$registro['fechaentrada']}</td>
                        <td>{$registro['fechasalida']}</td>
                        <td>{$registro['numhabitacion']}</td>
                        <td>{$registro['piso']}</td>
                        <td>{$registro['capacidad']}</td>
                        <td>{$registro['precio']}</td> 
                        <td>
                        <a href='#' data-ideditar='{$registro['idreservacion']}' class='btn btn-sm btn-success editar'><i class='fa-solid fa-pen-to-square'></i></a>                          
                        <a href='#' data-ideliminar='{$registro['idreservacion']}' class='btn btn-sm btn-danger eliminar'><i class='fa-solid fa-trash'></i></a>                
                        </td>                   
                    </tr>
                ";
            }
        }
    }

      if ($_POST['operacion'] == 'listarPagos') {
          $data = $empleados->listarPagos();
          if ($data) {
              foreach($data as $registro){
                  echo "<tr>
            <td>{$registro['cliente']}</td>
            <td>{$registro['diapago']}</td>
            <td>{$registro['formapago']}</td>
            <td>{$registro['precioTotal']}</td>
            <td>{$registro['montoTotal']}</td>
          </tr>";
              }

          }
      }

      if($_POST['operacion'] == 'registroReservacion'){
          $datosObtenidos = [
              "idusuario"         => $_POST['idusuario'],
              "idhabitacion"      => $_POST['idhabitacion'],
              "idcliente"         => $_POST['idcliente'],
              "idempleado"        => $_POST['idempleado'],
              "fechaentrada"      => $_POST['fechaentrada'],
              "fechasalida"       => $_POST['fechasalida'],
              "tipocomprobante"   => $_POST['tipocomprobante'],
              "formapago"         => $_POST['formapago']
          ];

          $response = $empleados->registroReservacion($datosObtenidos);
          echo json_encode($response);
      }

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

    if ($_POST['operacion'] == 'listarHabitaciones'){
        $data = $empleados->listarHabitaciones();
        if ($data) {
            echo  json_encode($empleados->listarHabitaciones());
        }
    }

    if ($_POST['operacion'] == 'eliminarReservaciones'){
        $data = $empleados->eliminarReservaciones();
        if ($data) {
            echo json_encode($empleados->eliminarReservaciones());
        }
    }

    if ($_POST['operacion'] == 'actualizarReservaciones'){
        $datosActualizados = [
            "idreservacion" => $_POST["idreservacion"],
            "idusuario" => $_POST["idusuario"],
            "idhabitacion" => $_POST["idhabitacion"],
            "idcliente" => $_POST["idcliente"],
            "idempleado" => $_POST["idempleado"],
            "fechaentrada" => $_POST["fechaentrada"],
            "fechasalida" => $_POST["fechasalida"],
            "tipocomprobante" => $_POST["tipocomprobante"],
        ];
        $data = $empleados->actualizarReservaciones($datosActualizados);
        echo json_encode($data);
    }

    if ($_POST['operacion'] == 'getdataReservaciones'){
        $data = $empleados->getdataReservaciones($_POST['idreservacion']);
        if ($data) {
            echo json_encode($data);
        }
    }


  }
?>