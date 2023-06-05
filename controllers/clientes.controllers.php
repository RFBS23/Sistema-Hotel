<?php
  require_once '../models/clientes.models.php';

  //si existe una conexion
  if(isset($_GET['operacion'])){
    //instanciamos la clase reservaciones
    $clientes = new Clientes();

    if ($_GET['operacion'] == 'listarClientes') {
      $data = $clientes->listarClientes();
      if($data){
        //Enviamos datos para que la vista RENDERICE
        foreach ($data as $registro) {
          echo "
            <tr>
              <td>{$registro['clientes']}</td>
              <td>{$registro['dni']}</td>
              <td>{$registro['telefono']}</td>
              <td>{$registro['fechanacimiento']}</td>
              <td>
                <a href='#' data-ideliminar='{$registro['idpersona']}' class='btn btn-outline-danger eliminar'>Borrar &nbsp;<i class='fa-solid fa-trash'></i></a>
                <a href='#' data-ideditar='{$registro['idpersona']}' class='btn btn-outline-info editar'>Editar &nbsp;<i class='fa-solid fa-pencil'></i></a>
              </td>
            </tr>
          ";
        }
      }
    }

    /*
    if ($_GET['operacion'] == 'listarEmpleados') {
      echo json_encode($clientes->listarEmpleados());
    }*/

    if ($_GET['operacion'] == 'registrarCliente') {
      //Debemos recuperar los datos que nos envía la vista
      //Estos datos lo guardamos en un ARRAY ASOCIATIVO
      //Recuerda: El modelo NO solicita 7 variables, sino, 1 solo objeto
      $datos = [
        "nombres" => $_GET['nombres'],
        "apellidos" => $_GET['apellidos'],
        "dni" => $_GET['dni'],
        "telefono" => $_GET['telefono'],
        "fechanacimiento" => $_GET['fechanacimiento']
      ];
      //El array ya recibió los datos de la vista, procedemos a guardar
      $clientes->registrarCliente($datos);
    }

    if ($_GET['operacion'] == 'actualizaClientes') {
      $datos = [
        "idpersona" => $_GET['idpersona'],
        "nombres" => $_GET['nombres'],
        "apellidos" => $_GET['apellidos'],
        "dni" => $_GET['dni'],
        "telefono" => $_GET['telefono'],
        "fechanacimiento" => $_GET['fechanacimiento']
      ];
      $clientes->actualizaClientes($datos);
    }

    if($_GET['operacion'] == 'buscarClientes'){
      $data = $clientes->buscarClientes($_GET['dni']);
      echo json_encode($data);
    }

    if ($_GET['operacion'] == 'eliminarClientes'){
      $clientes->eliminarClientes($_GET['idpersona']);
    }

    if ($_GET['operacion'] == 'getData') {
      $data = $clientes->getData($_GET['idpersona']);
      echo json_encode($data);
    }
  }
?>