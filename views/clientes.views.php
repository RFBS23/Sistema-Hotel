<?php
  require_once 'permisos.php';
?>

<div class="card border-primary">
  <div class="card-body">
    <form action="" autocomplete="off" id="formulario-clientes">
      <div class="row">
        <div class="col-md-6 mt-3">
          <label for="nombres" class="form-label bold">Nombres:</label>
          <input type="text" class="form-control" id="nombres" required>
        </div>
        <div class="col-md-6 mt-3">
          <label for="apellidos" class="form-label bold">Apellidos:</label>
          <input type="text" class="form-control" id="apellidos" required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mt-3">
          <label for="fechaentrada" class="form-label">Fecha Entrada:</label>
          <input type="date" id="fechaentrada" class="form-control">
        </div>
        <div class="col-md-6 mt-3">
          <label for="fechasalida" class="form-label">Fecha Salida:</label>
          <input type="date" id="fechasalida" class="form-control">
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 mt-3">
          <label for="dni" class="form-label bold">NRO° Habitacion:</label>
          <select class="custom-select" id="categoria" required></select>
        </div>
        <div class="col-md-4 mt-3">
          <label for="piso" class="form-label">Piso del Cuarto:</label>
          <input type="text" class="form-control" id="piso" required>
        </div>
        <div class="col-md-4 mt-3">
          <label for="direccion" class="form-label">Dirección:</label>
          <input type="text" class="form-control" id="direccion" placeholder="Campo opcional">
        </div>
      </div>
    </form>
    <div class="mt-3">
      <button type="button" class="btn btn-outline-success" id="guardar">Registrar Cliente</button>
    </div>
  </div>
</div>


<div class="card mt-4 border-primary">
  <div class="card-body">
    <div>
      <h5 class="card-title font-weight-bold text-primary">Clientes Registrados</h5>
      <table class="table border table-striped display responsive nowrap row-border order-column" id="clientes"
        width="100%">
        <thead class="border-danger table-success">
          <tr>
            <th>Cliente</th>
            <th>Fecha entrada</th>
            <th>Fecha Salida</th>
            <th>N° habitacion</th>
            <th>Piso</th>
            <th>Capacidad</th>
            <th>Precio</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>
  </div>
</div>


<script>
$(document).ready(function() {
  function mostrarClientes() {
    $.ajax({
      url: '../controllers/clientes.controllers.php',
      type: 'GET',
      data: {
        'operacion': 'listarClientes'
      },
      success: function(result) {
        //referencia al objeto 
        var tabla = $("#clientes").DataTable();
        //Destruirlo
        tabla.destroy();

        //pblar el cuerpo de la tabla
        $("#clientes tbody").html(result);

        //reconstruimos la tabla
        $("#clientes").DataTable({
          dom: 'Bfrtip',
          responsive: true,
          language: {
            url: '../assets/js/Spanish.json'
          }
        });
      }
    });
  }

  //ejecutamos cuando la vista es mostrada
  mostrarClientes();
});
</script>