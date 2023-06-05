<?php
  require_once 'permisos.php';
?>

<div class="card mt-4 border-primary">
  <div class="card-body">
    <div>
      <h5 class="card-title font-weight-bold text-primary">Clientes Registrados</h5>
        <div style="text-align: right">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-success" id="abrir-modal-registro" data-toggle="modal" data-target="#modal-registro-clientes">
                <i class="fa-solid fa-user-plus"></i> Nuevo Cliente
            </button>
            <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#modal-buscador">
                <i class="fa-solid fa-magnifying-glass"></i> Buscar Clientes
            </button>
        </div>
      <table class="table border table-hover table-striped display responsive nowrap row-border order-column mt-4" id="clientes" width="100%">
        <colgroup>
          <col width="30%"> <!-- clientes -->
          <col width="20%"> <!-- dni -->
          <col width="20%"> <!-- telefono -->
          <col width="20%"> <!-- fecha nacimiento -->
          <col width="10%"> <!-- Comandos -->
        </colgroup>
        <thead class="border-danger table-success">
          <tr>
            <th>Cliente</th>
            <th>Dni</th>
            <th>Telefono</th>
            <th>Fecha Nacimiento</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- modales -->
<!-- registro clientees -->
<div class="modal fade novalidate" id="modal-registro-clientes" tabindex="-1" data-bs-backdrop="static"  data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
    <div class="modal-content">
      <div id="modal-registro-header" class="modal-header bg-primary text-light" >
        <h5 class="modal-title" id="modal-registro-titulo">REGISTRAR CLIENTES</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card border-primary">
          <div class="card-body">
            <form action="" autocomplete="off" id="formulario-clientes">
              <div class="mt-3">
                <label for="nombres" class="form-label bold">Nombres:</label>
                <input type="text" class="form-control" id="nombres" onkeypress="return SoloLetras(event);" required>
              </div>
              <div class="mt-3">
                <label for="apellidos" class="form-label bold">Apellidos:</label>
                <input type="text" class="form-control" id="apellidos" onkeypress="return SoloLetras(event);" required>
              </div>
              <div class="mt-3">
                <label for="dni" class="form-label">DNI:</label>
                <input type="text" id="dni" class="form-control" maxlength="8" onkeypress="return SoloNumeros(event);" required>
              </div>
              <div class="mt-3">
                <label for="telefono" class="form-label">Telefono: </label>
                <input type="text" id="telefono" class="form-control" maxlength="9" onkeypress="return SoloNumeros(event);" required>
              </div>
              <div class="mt-3">
                <label for="fechanac" class="form-label bold">Fecha Nacimiento:</label>
                <input type="date" class="form-control" id="fechanac" required>
              </div>
            </form>

          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-outline-success" id="guardar">Registrar Cliente</button>
      </div>
    </div>
  </div>
</div>
<!-- buscar clientes -->
<div class="modal fade" id="modal-buscador" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success text-light">
        <h5 class="modal-title" id="modalTitleId">Buscar clientes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card border-primary">
          <div class="card-body">
            <form action="" id="formulario-busqueda-clientes" autocomplete="off">
              <div class="row mt-3">
                <label for="b-dni" class="col-form-label col-sm-3 bold">Escriba DNI</label>
                <div class="col-sm-9">
                  <input type="search" class="form-control" id="b-dni" placeholder="Enter buscar" maxlength="8" onkeypress="return SoloNumeros(event);">
                </div>
              </div>
              <div class="mt-3">
                <label for="b-nombres" class="form-label bold">Nombres:</label>
                <input type="text" class="form-control" id="b-nombres" onkeypress="return SoloLetras(event);" required readonly>
              </div>
              <div class="mt-3">
                <label for="b-apellidos" class="form-label bold">Apellidos:</label>
                <input type="text" class="form-control" id="b-apellidos" onkeypress="return SoloLetras(event);" required readonly>
              </div>
              <div class="mt-3">
                <label for="b-telefono" class="form-label">Telefono: </label>
                <input type="text" id="b-telefono" class="form-control" maxlength="9" onkeypress="return SoloNumeros(event);" required readonly>
              </div>
              <div class="mt-3">
                <label for="b-fechanac" class="form-label bold">Fecha Nacimiento:</label>
                <input type="date" class="form-control" id="b-fechanac" readonly>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!--fin modales -->

<!--
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
-->

<script>
  $(document).ready(function() {

    //Global
    let datosNuevos = true;
    let idpersona = 0; //Actualizar - Eliminar

    function mostrarClientes() {
      $.ajax({
        url: '../controllers/clientes.controllers.php',
        type: 'GET',
        data: { 'operacion': 'listarClientes' },
        success: function (result) {
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
              buttons: [
                  {
                      "extend": "pdf",
                      "text": "Generar Reporte <i class='fa-solid fa-file-pdf'></i>",
                      exportOptions: { columns: [0,1,2,3] },
                      "className": "btn btn-danger"
                  },
                  {
                      "extend": "",
                      "text": "",
                      "className": "btn btn-light"
                  },
                  {
                      "extend": "colvis",
                      "text": "Visualizar Opciones <i class='fa-solid fa-eye'></i>",
                      "className": "btn btn-success"
                  }
              ],
            language: {
              url: '../assets/js/Spanish.json'
            }
          });
        }
      });
    }

    //Este método, permitirá: DATOS NUEVOS / ACTUALIZADOS
    function registrarCliente(){
      //Array asociativo en JS (todo esto se recupera en el controlador)
      //utilizando $_GET['']
      let datosEnviar = {
        'operacion': 'registrarCliente',
        'nombres': $("#nombres").val(),
        'apellidos': $("#apellidos").val(),
        'dni': $("#dni").val(),
        'telefono': $("#telefono").val(),
        'fechanacimiento': $("#fechanac").val()
      };
      //Actualización...
      //... si no son datos nuevos ...
      if (!datosNuevos){
        datosEnviar["operacion"] = "actualizaClientes";
        datosEnviar["idpersona"] = idpersona;
      }

      if (confirm("¿Está seguro de realizar esta acción?")) {
        $.ajax({
          url: '../controllers/clientes.controllers.php',
          type: 'GET',
          data: datosEnviar,
          success: function(result){
            //Reiniciar el formulario
            $("#formulario-clientes")[0].reset();
            
            //recargamos la tabla empleado
            mostrarClientes();

            $("#modal-registro-clientes").modal('hide');
          }
        });
      }
    }
    
    function buscarClientes(){
      let dni = $("#b-dni").val();
      
      if (dni.length == 8) {
        $.ajax({
          url: '../controllers/clientes.controllers.php',
          type: 'GET',
          dataType: 'JSON',
          data: {
            'operacion' : 'buscarClientes',
            'dni' : dni
          },
          success: function(result){
            if (!result) {
              $("#formulario-busqueda-clientes")[0].reset();
              Swal.fire({
              title: 'Alerta',
              text: 'Cliente no Encontrado',
              icon: 'error',
              backdrop: 'true',
              timer: 2000,
              timerProgressBar: 'true',
              toast: true,
              showCancelButton: false,
              showConfirmButton: false,
              position: 'top-end'
              });
            }else{
              Swal.fire({
              title: 'Alerta',
              text: 'Cliente Encontrado',
              icon: 'success',
              backdrop: 'true',
              timer: 2000,
              timerProgressBar: 'true',
              toast: true,
              showCancelButton: false,
              showConfirmButton: false,
              position: 'top-end'
              });
              $("#b-nombres").val(result.nombres);
              $("#b-apellidos").val(result.apellidos);
              $("#b-telefono").val(result.telefono);
              $("#b-fechanac").val(result.fechanacimiento);
            }
          }
        });
      }
    }

    function eliminarClientes(id){
      if(confirm("¿Estas seguro de eliminar al cliente?")){
        $.ajax({
          url: '../controllers/clientes.controllers.php',
          type: 'GET',
          data: {
            'operacion' : 'eliminarClientes',
            'idpersona' : id
          },
          success: function(){
            mostrarClientes();
          }
        });
      }
      Swal.fire({
        title: 'Alerta',
        text: 'Eliminado Correctamente',
        icon: 'error',
        backdrop: 'true',
        timer: 2000,
        timerProgressBar: 'true',
        toast: true,
        showCancelButton: false,
        showConfirmButton: false,
        position: 'top-end'
      });
    }

    function mostrarDatos(id){
      $("#formulario-clientes")[0].reset();
      $.ajax({
        url: '../controllers/clientes.controllers.php',
        type: 'GET',
        data: {
          'operacion' : 'getData',
          'idpersona' : id
        },
        dataType: 'JSON',
        success: function (result){
          $("#nombres").val(result.nombres);
          $("#apellidos").val(result.apellidos);
          $("#dni").val(result.dni);
          $("#telefono").val(result.telefono);
          $("#fechanac").val(result.fechanacimiento);
        }
      });

      //3. abrir modal
      $("#modal-registro-titulo").html("Actualizacion de datos");
      $("#modal-registro-header").removeClass("bg-primary");
      $("#modal-registro-header").addClass("bg-success");
      $("#guardar").html("Actualizar");
      datosNuevos = false;
      $("#modal-registro-clientes").modal("show");
    }

    //proceso nuevo registro
    function abrirModalRegistro(){
      $("#modal-registro-titulo").html("Registro de Clientes");
      $("#modal-registro-header").removeClass("bg-success");
      $("#modal-registro-header").addClass("bg-primary");
      $("#guardar").html("Registrar");
      datosNuevo = true;
    }

    //Eventos de modal
    //Cuando el modal sea aperturado, enviaremos el enfoque a la primera caja de texto
    const modalBusqueda = document.getElementById("modal-buscador");
    modalBusqueda.addEventListener('shown.bs.modal', event => {
      $("#b-dni").focus();
    });
   
    //Proceso de eliminación (Componente ASÍNCRONOS)
    //on asigna un evento a un objeto/grupo de objetos determinado
    $("#clientes tbody").on("click", ".eliminar", function (){
      idpersona = $(this).data("ideliminar");
      eliminarClientes(idpersona);
    });

    //editar
    $("#clientes tbody").on("click", ".editar", function (){
      idpersona = $(this).data("ideditar");
      mostrarDatos(idpersona);
    });

    $("#abrir-modal-registro").click(abrirModalRegistro);

    //funciones asociadas a eventos
    $("#guardar").click(registrarCliente);

    //Al pulsar enter se ejecuta la función
    $("#b-dni").keypress(function (event){
      if (event.keyCode == 13){
        buscarClientes();
      }
    });

    //ejecutamos cuando la vista es mostrada
    mostrarClientes();
  });
</script>