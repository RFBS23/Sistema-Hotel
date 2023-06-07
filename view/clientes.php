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

    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 mt-2" style="font-size: 20px;" id="sidebarToggle"
      href="#!"><i class="fas fa-bars"></i></button>

    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
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
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <form action="" autocomplete="off" id="form_clientes">
              <div class="card mt-4">
                <div class="card-header">
                  Registro de clientes
                </div>
                <div class="card-body">
                  <div class="mb-3">
                    <label for="nombres" class="form-label">Nombres</label>
                    <input type="text" id="nombres" class="form-control form-control-sm">
                  </div>
                  <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" id="apellidos" class="form-control form-control-sm">
                  </div>
                  <div class="mb-3">
                    <label for="dni" class="form-label">DNI</label>
                    <input type="text" id="dni" class="form-control form-control-sm" maxlength="8">
                  </div>
                  <div class="mb-3">
                    <label for="telefono" class="form-label">Telefono</label>
                    <input type="text" id="telefono" class="form-control form-control-sm" maxlength="9">
                  </div>
                  <div class="mb-3">
                    <label for="fechaNac" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" id="fechaNac" class="form-control form-control-sm">
                  </div>

                  <div class="d-grid gap-2">
                    <button class="btn btn-outline-primary" id="btnRegistrar" type="button">Registrar Clientes</button>
                  </div>
                </div>

              </div>

            </form>
          </div>
          <!-- Tabla -->
          <div class="col-md-8 tableR ">
            <table id="table_clientes" class="table table-bordered border-secondary table-sm display responsive nowrap"
              width="100%">
              <colgroup>
                <col width="20%"> <!-- clientes -->
                <col width="20%"> <!-- fecha entrada -->
                <col width="20%"> <!-- fecha salida -->
                <col width="20%"> <!-- N habitacion -->
                <col width="20%"> <!-- N piso -->
                <col width="20%"> <!-- capacidad -->
                <col width="20%"> <!-- precio -->
                <col width="20%"> <!-- Comandos -->
              </colgroup>
              <thead>
                <tr>
                  <th>Nombres</th>
                  <th>Apellidos</th>
                  <th>DNI</th>
                  <th>Telefono</th>
                  <th>Fecha de Nacimiento</th>
                </tr>
              </thead>
              <tbody>
                <!-- DATOS ASINCRONOS -->
              </tbody>
            </table>
          </div>
        </div>
      </div>

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
  <!-- SweetAlert2 CDN -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
  $(document).ready(function() {
    const cardDispo = document.querySelector("#H_dispo");
    const cuerpoDispo = cardDispo.querySelector("div");
    const cardOcup = document.querySelector("#H_ocup");
    const cuerpoOcup = cardOcup.querySelector("div");
    const cardLimp = document.querySelector("#H_limp");
    const cuerpoLimp = cardLimp.querySelector("div");


    function clientesListar() {
      $.ajax({
        url: '../controller/cliente.controller.php',
        type: 'POST',
        data: {
          'operacion': 'clientesListar'
        },
        success: function(result) {

          var tablaDT = $("#table_clientes").DataTable();
          tablaDT.destroy();

          $("#table_clientes tbody").html(result);

          $("#table_clientes").DataTable({
            dom: 'Bfrtip',
            responsive: true,
            language: {
              url: '../js/Spanish.json'
            }
          });
        }
      });
    }

    function clientesRegistrar() {

      let dataR = {
        'operacion': 'clientesRegistrar',
        'nombres': $("#nombres").val(),
        'apellidos': $("#apellidos").val(),
        'dni': $("#dni").val(),
        'telefono': $("#telefono").val(),
        'fechaNac': $("#fechaNac").val(),
      };

      Swal.fire({
        title: "¿Desea registrar un nuevo cliente?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#28B463",
        cancelButtonColor: "#5DADE2",
        confirmButtonText: "Confirmar",
        cancelButtonText: "Cancelar",

      }).then(function(result) {
        if (result.isConfirmed) {
          $.ajax({
            url: '../controller/cliente.controller.php',
            type: 'POST',
            data: dataR,
            success: function(result) {
              clientesListar();
              $("#form_clientes")[0].reset();


            }
          });
        }
      })

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


    $("#btnRegistrar").click(clientesRegistrar);

    clientesListar();


  });
  </script>

</body>

</html>