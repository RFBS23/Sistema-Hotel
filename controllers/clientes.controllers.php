<?php
  require_once '../models/clientes.models.php';

  //si existe una conexion
  if(isset($_GET['operacion'])){
    //instanciamos la clase reservaciones
    $clientes = new Clientes();

    if ($_GET['operacion'] == 'listarClientes') {
      $data = $clientes->listarClientes();
      if($data){
        foreach ($data as $registro) {
          echo "
            <tr>
              <td>{$registro['cliente']}</td>
              <td>{$registro['fechaentrada']}</td>
              <td>{$registro['fechasalida']}</td>
              <td>{$registro['numhabitacion']}</td>
              <td>{$registro['piso']}</td>
              <td>{$registro['capacidad']}</td>
              <td>{$registro['precio']}</td> 
            </tr>
          ";
        }
      }
    }

    if ($_GET['operacion'] == 'listarEmpleados') {
      echo json_encode($clientes->listarEmpleados());
    }
  }
?>