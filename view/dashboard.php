<?php
session_start();

// Comprobamos si el usuario inicio sesión

if(!isset($_SESSION['segurity']) || $_SESSION['segurity']['login'] == false ){
    header('Location:../index.php');
}

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard</title>
        <link rel="shortcut icon" href="../img/icono.png" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../style/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="../style/inicio.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
          <!-- Datatable for BS5 -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
             <!-- estilos de select2   -->
             <link rel="stylesheet" href="../scss/estilos.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    </head>
    <body class="sb-nav-fixed" style="background: #F0F2F7">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-secondary">

            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 mt-2" style="font-size: 20px;" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i>
                    <label for="" class="px-1 ms-xl-3 mt-1 text-white">Bienvenido: <?= $_SESSION['segurity']['nombres'] ?>&nbsp;<?= $_SESSION['segurity']['apellidos'] ?></label></a>
                    
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="404.php">Configuracion</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="../controller/usuario.controller.php?operacion=destroy">cerrar sesion</a></li>
                        
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark bg-primary" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">                        
                            <a class="nav-link mt-4 text-dark" href="./dashboard.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-house-fill text-dark"></i></div>
                                Inicio
                            </a>
                            <a class="nav-link text-dark" href="./reservaciones.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area text-dark"></i></div>
                                Reservaciones
                            </a>
                            <a class="nav-link text-dark" href="./habitaciones.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-door-open text-dark"></i></div>
                                Habitaciones
                            </a>
                            <div class="sb-sidenav-menu-heading text-dark">Complementos</div>
                            
                                                                              
                            <a class="nav-link text-dark" href="./graficos.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-graph-up text-dark"></i></div>
                                Graficos
                            </a>                     
                        </div>
                    </div>
                </nav>
            </div>
            
            <div id="layoutSidenav_content">
                <!-- CONTENIDO -->

                <div class="container mt-3">
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-secondary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                            total de habitaciones
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-secondary">
                                            $40,000
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-list  fa-2x text-secondary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4" id="H_dispo">
                        <div class="card border-left-success shadow h-100 py-2">
                            <!-- DATOS ASINCRONOS -->
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4" id="H_ocup">
                        <div class="card border-left-danger shadow h-100 py-2">
                            <!-- DATOS ASINCRONOS -->
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4" id="H_limp">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <!-- DATOS ASINCRONOS -->
                        </div>
                    </div>
                </div>
                </div>

 <hr>
                <!-- Tabla -->
                <div class=" tableR mt-5">
                <table id="table_reservaciones" class="table table-bordered border-secondary table-sm display responsive nowrap table-hover"  width="100%" >
                    <thead class="table-success">
                      <tr>                  
                        <th>Cliente</th>
                        <th>Fecha entrada</th>
                        <th>Fecha Salida</th>
                        <th>N° habitacion</th>
                        <th>Piso</th>
                        <th>Capacidad</th>
                        <th>Precio</th>                        
                        <th>Operaciones</th> 
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
            
                <!-- Modal Body -->
                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                <div class="modal fade" id="modal-actualizar" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered " role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitleId">Actualizar reservacion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form action="" id="form-reservaciones" autocomplete="off">
                                      
                                        <div class="mb-3">
                                            <label for="idcliente" class="form-label">Cliente</label>
                                            <select  id="idcliente" class="form-select" disabled>
                                                <option value="">Selección</option>
                                            </select>
                                        </div> 
                                        <div class="mb-3">
                                            <label for="idempleado" class="form-label">Empleado</label>
                                            <select  id="idempleado" class="form-select" disabled>
                                                <option value="">Selección</option>
                                            </select>
                                        </div>                                       
                                        <div class="mb-3">
                                            <label for="idusuario" class="form-label">Usuario</label>
                                            <select  id="idusuario" class="form-select" disabled>
                                                <option value="">Selección</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="idhabitacion" class="form-label">Habitacion</label>
                                            <select  id="idhabitacion" class="form-select">
                                                <option value="">Selección</option>
                                            </select>            
                                        </div>                                       
                                        <div class="mb-3">
                                            <label for="fechaentrada" class="form-label">Fecha de entrada</label>
                                            <input type="date" id="fechaentrada" class="form-control form-control-sm">
                                        </div>
                                        <div class="mb-3">
                                            <label for="fechasalida" class="form-label">Fecha de salida</label>
                                            <input type="date" id="fechasalida" class="form-control form-control-sm">
                                        </div>
                                        <div class="mb-3">
                                            <label for="tipocomprobante" class="form-label">Tipo de comprobante (FACTURA - BOLETA)</label>
                                            <select  id="tipocomprobante" class="form-select">
                                                <option value="">Selección</option>
                                                <option value="F">Factura</option>
                                                <option value="B">Boleta</option>
                                            </select>                                                        
                                        </div>                                                                           
                                                          
                            </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-success" id="btnActualizar">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <footer class="py-4  mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Sistema Hotel by Fabrizio Barrios Saavedra - RFBS23</span>
          </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
          <!-- Datatable for BS5 -->
        <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
        <!-- select2 -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
          <!-- CDN sweetAlert2 -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- CDN para crear graficos -->
        <script src="../js/mostrarSelect.js"></script>
  
        <script>
                    
          $(document).ready(function (){
            const cardDispo = document.querySelector("#H_dispo");
            const cuerpoDispo = cardDispo.querySelector("div");
            const cardOcup = document.querySelector("#H_ocup");
            const cuerpoOcup = cardOcup.querySelector("div");
            const cardLimp = document.querySelector("#H_limp");
            const cuerpoLimp = cardLimp.querySelector("div");
             //Activa el select2 en clientes
            $("#cliente").select2();

            let idreservacion = 0;

            function get_reservaciones(){
              $.ajax({
                url:'../controller/reservacion.controller.php',
                type: 'POST',
                data: {'operacion' : 'reservacionesGet'},
                success: function (result){

                  var tablaDT = $("#table_reservaciones").DataTable();
                  tablaDT.destroy();

                  $("#table_reservaciones tbody").html(result);

                  $("#table_reservaciones").DataTable({
                    dom: 'Bfrtip',
                    responsive:true,
                    language: {
                        url: '../js/Spanish.json'
                    }
                  });
                }
              });
            }

            function reservacionEliminar(id){
                Swal.fire({
                    title: "¿Está seguro de eliminar la reservación?",
                    text: "Esta acción no se puede deshacer",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Eliminar",
                    cancelButtonText: "Cancelar",

                }).then(function (result){
                    if(result.isConfirmed){
                        $.ajax({
                        url: '../controller/reservacion.controller.php',
                        type: 'POST',
                        data: {
                            'operacion' : 'reservacionEliminar',
                            'idreservacion' : id
                        },
                        success: function(){
                            get_reservaciones();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Eliminando reservacion',
                                showConfirmButton: false,
                                timer: 1500
                                })
                        }
                    });

                    }
                });
                   
                
            }

            
            function reservacionesUpdate(){

                let enviar = {
                    'operacion'         : 'reservacionUpdate',  
                    'idreservacion'     : idreservacion,                  
                    'idcliente'         : $("#idcliente").val(),
                    'idempleado'        : $("#idempleado").val(),
                    'idusuario'         : $("#idusuario").val(),
                    'idhabitacion'      : $("#idhabitacion").val(),
                    'fechaentrada'      : $("#fechaentrada").val(),
                    'fechasalida'       : $("#fechasalida").val(),
                    'tipocomprobante'   : $("#tipocomprobante").val(),

                }

                Swal.fire({
                    title: "¿Está seguro de realizar esta acción?",
                    text: "Esta acción no se puede deshacer",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Confirmar",
                    cancelButtonText: "Cancelar",

                }).then(function (result){
                    if(result.isConfirmed){
                        $.ajax({
                        url: '../controller/reservacion.controller.php',
                        type: 'POST',
                        data:enviar,
                        success: function(result){
                            get_reservaciones();

                            $("#modal-actualizar").modal('hide');
                        }
                    });
                    }
                })
                   

                

            }

            function recuperarReser(id){
                $("#form-reservaciones")[0].reset();

                $.ajax({
                    url: '../controller/reservacion.controller.php',
                    type: 'POST',
                    data: {
                        'operacion' : 'recuperarDatos',
                        'idreservacion' : id                       
                    },
                    dataType: 'JSON',
                    success: function(result){
                        $("#idcliente").val(result.idcliente);
                        $("#idempleado").val(result.idempleado);
                        $("#idusuario").val(result.idusuario);
                        $("#idhabitacion").val(result.idhabitacion);
                        $("#fechaentrada").val(result.fechaentrada);
                        $("#fechasalida").val(result.fechasalida);
                        $("#tipocomprobante").val(result.tipocomprobante);
                    }
                });

                $("#modal-actualizar").modal('show');

            }


            //Eventos
            $("#table_reservaciones tbody").on("click", ".eliminar", function(){
                idreservacion = $(this).data("ideliminar");
                reservacionEliminar(idreservacion);

            });

            $("#table_reservaciones tbody").on("click", ".editar", function(){
                idreservacion = $(this).data("ideditar");
                recuperarReser(idreservacion);
            })

            $("#btnActualizar").click(reservacionesUpdate);

           
            function getDisponibles(){
                const data = new URLSearchParams();
                data.append("operacion" , "hDisponiblesGet");

                fetch("../controller/habitacion.controller.php", {
                    method: 'POST',
                    body: data
                })
                .then(response => response.json())
                .then(datos => {
                    cuerpoDispo.innerHTML = ``
                    datos.forEach(element => {
                        let row = `
                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">HABITACIONES (DISPONIBLES)</div>
                                                    <div class="h4 mb-0 font-weight-bold text-success">${element.habitaciones_disponibles}</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-boxes  fa-2x text-success"></i>
                                                </div>
                                            </div>
                                        </div>
                                                                              
                        `;
                        cuerpoDispo.innerHTML += row;
                    });
                });
            }

            function getOcupadas(){
                const data = new URLSearchParams();
                data.append("operacion" , "hOcupadasGet");

                fetch("../controller/habitacion.controller.php", {
                    method: 'POST',
                    body: data
                })
                .then(response => response.json())
                .then(datos => {
                    cuerpoOcup.innerHTML = ``
                    datos.forEach(element => {
                        let row = `
                        <div class="card-body">
                                      <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                          <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">HABITACIONES OCUPADAS</div>
                                          <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                              <div class="h4 mb-0 mr-3 font-weight-bold text-danger">${element.habitaciones_ocupadas}</div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-auto">
                                          <i class="fas fa-bed fa-2x text-danger"></i>
                                        </div>
                                      </div>
                                    </div>                                               
                        `;
                        cuerpoOcup.innerHTML += row;
                    });
                });
            }

            function getMantenimiento(){
                const data = new URLSearchParams();
                data.append("operacion" , "hLimpiezaGet");

                fetch("../controller/habitacion.controller.php", {
                    method: 'POST',
                    body: data
                })
                .then(response => response.json())
                .then(datos => {
                    cuerpoLimp.innerHTML = ``
                    datos.forEach(element => {
                        let row = `
                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                        HABITACIONES EN LIMPIEZA
                                                    </div>
                                                    <div class="h4 mb-0 font-weight-bold text-warning">
                                                    ${element.habitaciones_Limpieza}
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-spray-can-sparkles fa-2x text-warning"></i>
                                                </div>
                                            </div>
                                        </div>                                                    
                        `;
                        cuerpoLimp.innerHTML += row;
                    });
                });
            }

            getDisponibles();
            getOcupadas();
            getMantenimiento();

            get_reservaciones();
            mostrarCliente();
            mostrarEmpleados();

          });
        </script>

    </body>
</html>
