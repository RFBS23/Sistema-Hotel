<?php
  session_start();
  if (!isset($_SESSION['iniciarSesion']) || !$_SESSION['iniciarSesion']['login']){
    header("Location: ");
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Dashboard</title>
  <link rel="shortcut icon" href="../images/icono.png" type="image/x-icon">
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Datatable-->
  <link rel="stylesheet" href="../assets/scss/estilos.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">
</head>
<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <img src="../images/icono.png" alt="" width="40rem;">
        </div>
        <div class="sidebar-brand-text mx-3">SENATI<sup>Hotel</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        GESTION
      </div>
      <?php
        require_once './options.php';
      ?>
      <!-- Nav Item - Pages Collapse Menu -->
      
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        GESTION
      </div>
      
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

      <!-- Sidebar Message -->
      <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="../images/hotel.svg" alt="logo">
        <p class="text-center mb-2">
          Trabajo desarrolado by <strong>Fabrizio Barrios Saavedra</strong>
        </p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Ver mas Proyectos!</a>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- buscador -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar..."
                aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                      aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li>

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">7</span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Message Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Hi there! I am wondering if you can help me with a
                      problem I've been having.</div>
                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                    <div class="status-indicator"></div>
                  </div>
                  <div>
                    <div class="text-truncate">I have the photos that you ordered last month, how
                      would you like them sent to you?</div>
                    <div class="small text-gray-500">Jae Chun · 1d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
                    <div class="status-indicator bg-warning"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Last month's report looks great, I am very happy with
                      the progress so far, keep up the good work!</div>
                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="...">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                      told me that people say this to all dogs, even if they aren't good...</div>
                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- informacion personal -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  <b>Bienvenido: <?= $_SESSION['iniciarSesion']['nombres']?>&nbsp;<?=$_SESSION['iniciarSesion']['apellidos'] ?></b>
                </span>
                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Datos del perfil
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Cambiar Contraseña
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="cerrarsesion.php">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Cerrar sesion
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Content Row -->
          <div class="row">

            <!-- Total de habitaciones Card Example -->
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

            <!-- Habitaciones disponibles Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Habitaciones (Disponibles)</div>
                      <div class="h5 mb-0 font-weight-bold text-success">$215,000</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-boxes fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Habitacion ocupada Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Habitaciones Ocupadas
                      </div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-danger">50%</div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-bed fa-2x text-danger"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- habitaciones en limpieza Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Habitaciones en Limpieza
                      </div>
                      <div class="h5 mb-0 font-weight-bold text-warning">18</div>
                    </div>
                    <div class="col-auto">
                      <i class="fa-solid fa-spray-can-sparkles fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-6">
              <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                  <strong class="d-inline-block mb-2 text-primary">Registro de Reservaciones</strong>
                  <form class="validaciones" novalidate id="registroReserv">
                    <div class="col-md-6 mb-3">
                      <label for="buscarcliente">Buscar Clientes</label>
                      <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
                        Buscar Cliente
                      </button>
                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Buscar Clientes</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              ...
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">cancelar</button>
                              <button type="button" class="btn btn-primary">Seleccionar</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Fin Modal -->
                    </div>
                    <div class="form-row">

                      <div class="col-md-6 mb-3">
                        <label for="cliente">Clientes</label>
                        <select class="custom-select" id="cliente" required>
                        </select>
                        <div class="valid-feedback">
                          campo completado
                        </div>
                        <div class="invalid-feedback">
                          Por favor completa los campos requeridos
                        </div>
                      </div>
                      
                      <div class="col-md-6 mb-3">
                        <label for="empleado">Empleado</label>
                        <select class="custom-select" id="empleado" required>
                        </select>
                        <div class="valid-feedback">
                          campo completado
                        </div>
                        <div class="invalid-feedback">
                          Por favor completa los campos requeridos
                        </div>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label for="nombres">Nombre usuario</label>
                        <select class="custom-select" id="nombres" required>
                        </select>
                        <div class="valid-feedback">
                          campo completado
                        </div>
                        <div class="invalid-feedback">
                          Por favor completa los campos requeridos
                        </div>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label for="categoria">Categoria</label>
                        <select class="custom-select" id="categoria" required>
                        </select>
                        <div class="valid-feedback">
                          campo completado
                        </div>
                        <div class="invalid-feedback">
                          Por favor completa los campos requeridos
                        </div>
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="col-md-6 mb-3">
                        <label for="fechaentrada">Fecha Entrada</label>
                        <input type="date" id="fechaentrada" class="form-control">
                        <div class="valid-feedback">
                          campo completado
                        </div>
                        <div class="invalid-feedback">
                          Por favor completa los campos requeridos
                        </div>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label for="fechasalida">Fecha Salida</label>
                        <input type="date" id="fechasalida" class="form-control">
                        <div class="valid-feedback">
                          campo completado
                        </div>
                        <div class="invalid-feedback">
                          Por favor completa los campos requeridos
                        </div>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label for="comprobante">Comprobante de pago</label>
                        <select class="custom-select" id="comprobante" required>
                          <option selected disabled value=''>Seleccione ...</option>
                          <option value='boleta'>Boleta</option>
                          <option value='factura'>Factura</option>
                        </select>
                        <div class="valid-feedback">
                          campo completado
                        </div>
                        <div class="invalid-feedback">
                          Por favor completa los campos requeridos
                        </div>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label for="pago">Forma de pago</label>
                        <select class="custom-select" id="pago" required>
                          <option selected disabled value=''>Seleccione ...</option>
                          <option value='Debito'>Debito</option>
                          <option value='Efectivo'>Efectivo</option>
                        </select>
                        <div class="valid-feedback">
                          campo completado
                        </div>
                        <div class="invalid-feedback">
                          Por favor completa los campos requeridos
                        </div>
                      </div>

                    </div>
                    <button class="btn btn-outline-primary btn-lg btn-block" type="submit" id="registrar">Registrar Reservaciones</button>
                  </form>

                </div>
              </div>
            </div>
            <!-- tabla -->
            <div class="col-md-6">
              <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                  <strong class="d-inline-block mb-4 text-success-emphasis">Tabla de Registro de Reservacion</strong>
                  <table class="table table-striped table-hover table-bordered" id="mitabla" width="100%">
                    <thead class="table-primary">
                      <tr>
                        <th scope="col">Clientes</th>
                        <th scope="col">Nombre Usuario</th>
                        <th scope="col">Tipo de pago</th>
                        <th scope="col">Comprobante Pago</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- fin tabla -->
          </div>

        </div>

      </div>
      <!-- End of Main Content -->

      <!-- footer -->
      <footer class="sticky-footer bg-light">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Sistema Hotel by Fabrizio Barrios Saavedra - RFBS23</span>
          </div>
        </div>
      </footer>
      <!-- footer -->

    </div>
  <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <!-- Datatable for BS5 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>

  <script>
    /*validacion de cajas*/
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('validaciones');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
    /* fin validaciones* */

    //mostramos los empleados
    document.addEventListener("DOMContentLoaded", () => {
      //objetos
      const empleados = document.querySelector("#empleado");
      const nombres = document.querySelector("#nombres");
      const cliente = document.querySelector("#cliente");
      const categoria = document.querySelector("#categoria");
      const btnregistrar = document.querySelector("#registrar");
      
      //metodos
      function mostrarEmpleado(){
        const parameters = new URLSearchParams();
        parameters.append("operacion", "listarEmpleados");
        fetch("../controllers/reservaciones.controllers.php", {
          method: 'POST',
          body: parameters
        })
        .then(response => response.json())
        .then(data => {
          empleados.innerHTML = "<option selected disabled value=''>Seleccione ...</option>";
          data.forEach(element => {
            const optionTag = document.createElement("option");
            optionTag.value = element.empleados
            optionTag.text = element.nombres;
            empleados.appendChild(optionTag);
          });
        });
      }

      //mostramos usuarios
      function mostrarUsuarios() {
        const parameters = new URLSearchParams();
        parameters.append("operacion", "listarUsuarios");
        fetch("../controllers/reservaciones.controllers.php", {
          method: 'POST',
          body: parameters
        })
        .then(response => response.json())
        .then(data => {
          nombres.innerHTML = "<option selected disabled value=''>Seleccione ...</option>";
          data.forEach(element => {
            const optionTag = document.createElement("option");
            optionTag.value = element.idusuario
            optionTag.text = element.nombres;
            nombres.appendChild(optionTag);
          });
        });
      }

      //mostrar habitaciones
      function mostrarHabitaciones() {
        const parameters = new URLSearchParams();
        parameters.append("operacion", "mostrarHabitacion");
        fetch("../controllers/habitaciones.controllers.php", {
          method: 'POST',
          body: parameters
        })
        .then(response => response.json())
        .then(data => {
          categoria.innerHTML = "<option selected disabled value=''>Seleccione ...</option>";
          data.forEach(element => {
            const optionTag = document.createElement("option");
            optionTag.value = element.idhabitacion
            optionTag.text = element.descripcion;
            categoria.appendChild(optionTag);
          });
        });
      }

      //mostrar clientes
      function mostrarpersonas(){
        const parameters = new URLSearchParams();
        parameters.append("operacion", "listarClientes");
        fetch("../controllers/reservaciones.controllers.php", {
          method: 'POST',
          body: parameters
        })
        .then(response => response.json())
        .then(data => {
          cliente.innerHTML = "<option selected disabled value=''>Seleccione ...</option>";
          data.forEach(element => {
            const optionTag = document.createElement("option");
            optionTag.value = element.idpersona
            optionTag.text = element.clientes;
            cliente.appendChild(optionTag);
          });
        });
      }

      function registroReservaciones() {
        if (confirm("¿SEguro de rgistrar?")) {
          const parameters = new URLSearchParams();
          parameters.append("operacion", "reservacionRegistrar");
          parameters.append("idempleado", document.querySelector("#empleado").value);
          parameters.append("idusuario", document.querySelector("#nombres").value);
          parameters.append("idhabitacion", document.querySelector("#categoria").value);
          parameters.append("idcliente", document.querySelector("#cliente").value);
          parameters.append("fechaentrada", document.querySelector("#fechaentrada").value);
          parameters.append("fechasalida", document.querySelector("#fechasalida").value);
          parameters.append("tipocomprobante", document.querySelector("#comprobante").value);
          parameters.append("formapago", document.querySelector("#pago").value);

          fetch("../controllers/reservaciones.controllers.php", {
            method: 'POST',
            body: parameters
          })
          .then(response => response.json())
          .then(data => {
            console.log(data);
            if(data.status){
              document.querySelector("#registroReserv").reset();                            
            }else{
              alert(data.message);
            }
          });
        }
      }
      //registroReservaciones();

      mostrarpersonas();
      mostrarHabitaciones();
      mostrarEmpleado();
      mostrarUsuarios();
      btnregistrar.addEventListener("click", registroReservaciones);
    });

  </script>

</body>
</html>