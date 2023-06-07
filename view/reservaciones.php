<?php
session_start();

// Comprobamos si el usuario inicio sesión
if(!isset($_SESSION['segurity']) || $_SESSION['segurity']['login'] == false ){
    header('Location:../index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

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
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">
  <!-- estilos de select2   -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../scss/estilos.css">

</head>

<body class="sb-nav-fixed" style="background: #F0F2F7">

  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-secondary">
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 mt-2" style="font-size: 20px;" id="sidebarToggle"
      href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
      <!-- <div class="input-group">
                    <input class="form-control" type="text" placeholder="Buscar..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div> -->
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
          aria-expanded="false"><i class="fas fa-user fa-fw"></i>
          <label for="" class="px-1 ms-xl-3 mt-1 text-white">Bienvenido:
            <?= $_SESSION['segurity']['nombres'] ?>&nbsp;<?= $_SESSION['segurity']['apellidos'] ?></label></a>

        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="404.php">Configuracion</a></li>
          <li>
            <hr class="dropdown-divider" />
          </li>
          <li><a class="dropdown-item" href="../controller/usuario.controller.php?operacion=destroy">cerrar sesion</a>
          </li>

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
            <a class="nav-link text-dark" href="./clientes.php">
              <div class="sb-nav-link-icon"><i class="bi bi-people-fill"></i></div>
              clientes
            </a>
          </div>
        </div>
      </nav>
    </div>
    <div id="layoutSidenav_content">
      <!-- CONTENIDO  -->
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
        <hr>


        <div class="row mb-2">
          <div class="col-md-6">
            <div
              class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
              <div class="col p-4 d-flex flex-column position-static">
                <form action="" id="form-reservaciones" autocomplete="off">
                  <div class="">
                    <strong class="d-inline-block mb-2 text-primary">Registro de Reservaciones</strong>
                    <div class="card-body">
                      <div class="mb-3">
                        <select id="idcliente" class="js-example-responsive form-select" style="width: 100%;">
                          <option selected disabled value=""></option>
                        </select>
                      </div>

                      <div class="mb-3">
                        <label for="idempleado" class="form-label">Empleado</label>
                        <select id="idempleado" class="form-select">
                          <option selected disabled value="">Selección</option>
                        </select>
                      </div>

                      <div class="mb-3">
                        <label for="idusuario" class="form-label">Usuario</label>
                        <select id="idusuario" class="form-select">
                          <option selected disabled value="">Selección</option>
                        </select>
                      </div>

                      <div class="mb-3">
                        <label for="idhabitacion" class="form-label">Habitacion</label>
                        <select id="idhabitacion" class="form-select">
                          <option selected disabled value="">Selección</option>
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
                        <select id="tipocomprobante" class="form-select">
                          <option selected disabled value="">Selección</option>
                          <option value="F">Factura</option>
                          <option value="B">Boleta</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="mediopago" class="form-label">Medio de pago</label>
                        <select id="mediopago" class="form-select">
                          <option selected disabled value="">Seleccion</option>
                          <option value="Efectivo">Efectivo</option>
                          <option value="Tarjeta bancaria">debito</option>
                        </select>
                      </div>
                      <div class="d-grid gap-2">
                        <button class="btn btn-sm btn-primary" id="guardar" type="button">Registrar</button>
                        <button class="btn btn-sm btn-danger" type="reset" id="btnReset">Reiniciar</button>
                      </div>
                    </div>
                  </div>

                </form>


              </div>
            </div>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="buscar-cliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="bi bi-person-lines-fill"></i> Buscar
                    clientes</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <input type="text" class="form-control" id="tabDni" placeholder="Enter para buscar">
                  <div class="container" id="lista">
                    <!-- busqueda de personas -->
                    <ul class="list-group mt-4" id="info">

                    </ul>
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>


          <!-- tabla -->
          <div class="col-md-6">
            <div
              class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
              <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-4 text-success">Tabla de Registro de Reservacion</strong>

                <div class="col-md-4">
                  <div class="d-grid">
                    <button id="exportar" class="btn btn-outline-danger btn-sm mt-1" type="button">
                      <i class="fa-solid fa-file-pdf"></i>
                      Exportar PDF
                    </button>
                  </div>
                </div>

                <table class="table table-striped table-hover table-bordered responsive mt-4" id="table_pagos"
                  width="100%">
                  <colgroup>
                    <col width="40%">
                    <col width="20%">
                    <col width="20%">
                    <col width="20%"> <!-- Comandos -->
                  </colgroup>
                  <thead class="table-primary">
                    <tr>
                      <th>Cliente</th>
                      <th>Fecha pago</th>
                      <th>Pagos</th>
                      <th>precio</th>
                      <th>monto alquiler</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
        <!-- fin tabla -->
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
      crossorigin="anonymous"></script>

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
    <script src="../js/dt-pagos.js"></script>
    <script src="../js/mostrarSelect.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
      integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
    document.addEventListener("DOMContentLoaded", () => {

      //Activa el select2 en clientes
      $("#idcliente").select2();

      const cardDispo = document.querySelector("#H_dispo");
      const cuerpoDispo = cardDispo.querySelector("div");
      const cardOcup = document.querySelector("#H_ocup");
      const cuerpoOcup = cardOcup.querySelector("div");
      const cardLimp = document.querySelector("#H_limp");
      const cuerpoLimp = cardLimp.querySelector("div");

      //Objetos
      const lsEmpleado = document.querySelector("#idempleado");
      const lsUsuario = document.querySelector("#idusuario");
      const lsHabitacion = document.querySelector("#idhabitacion");
      const lsCliente = document.querySelector("#idcliente");
      const btnRegistrar = document.querySelector("#guardar");
      const btnReset = document.querySelector("#btnReset");

      //reporte
      const reporte = document.querySelector("#exportar");


      function registrarReservacion() {
        Swal.fire({
          title: "¿Está seguro de registrar?",
          icon: "question",
          showCancelButton: true,
          confirmButtonText: "Sí",
          cancelButtonText: "Cancelar",
          confirmButtonColor: '#03643a',
          customClass: {
            confirmButton: "spacing",
            cancelButton: "spacing"
          }


        }).then((result) => {
          if (result.isConfirmed) {

            const parameters = new URLSearchParams();
            parameters.append("operacion", "reservacionRegistrar");
            parameters.append("idusuario", document.querySelector("#idusuario").value);
            parameters.append("idhabitacion", document.querySelector("#idhabitacion").value);
            parameters.append("idcliente", document.querySelector("#idcliente").value);
            parameters.append("idempleado", document.querySelector("#idempleado").value);
            parameters.append("fechaentrada", document.querySelector("#fechaentrada").value);
            parameters.append("fechasalida", document.querySelector("#fechasalida").value);
            parameters.append("tipocomprobante", document.querySelector("#tipocomprobante").value);
            parameters.append("mediopago", document.querySelector("#mediopago").value);

            fetch("../controller/reservacion.controller.php", {
                method: 'POST',
                body: parameters
              })
              .then(response => response.json())
              .then(data => {
                console.log(data);
                if (data.status) {
                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Su reservacion a sido exitosa',
                    showConfirmButton: false,
                    timer: 1500
                  })
                  document.querySelector("#form-reservaciones").reset();
                  $("#idcliente").val(null).trigger('change');
                } else {
                  Swal.fire("Error", data.message, "error");
                }
              });

          }
        });
      }

      function getDisponibles() {
        const data = new URLSearchParams();
        data.append("operacion", "hDisponiblesGet");

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

      function getOcupadas() {
        const data = new URLSearchParams();
        data.append("operacion", "hOcupadasGet");

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

      function getMantenimiento() {
        const data = new URLSearchParams();
        data.append("operacion", "hLimpiezaGet");

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
      btnRegistrar.addEventListener("click", registrarReservacion);

      btnReset.addEventListener("click", () => {
        //Resetear el select2
        $("#idcliente").val(null).trigger('change');
      })

    });
    </script>
</body>

</html>