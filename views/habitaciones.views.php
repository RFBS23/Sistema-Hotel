<?php
    //require_once 'permisos.php';
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
  <title>Dashboard </title>
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

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    <b>Bienvenido:
                        <?= $_SESSION['iniciarSesion']['nombres']?>&nbsp;<?=$_SESSION['iniciarSesion']['apellidos'] ?></b>
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
            <div class="container-fluid" id="cards">
            <!-- Content Row -->
            <div class="row">
                <!-- Total de habitaciones Card Example -->

            </div>

            <div class="card modal-dialog-scrollable border-primary">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Seleccionar Piso</label>
                        <div class="col-sm-4">
                        <select class="form-control" id="cbopiso"></select>
                        </div>
                    </div>
                    <hr />
                    <div id="habitaciones" class="row">
                        <div class="row">
                        <!-- DATOS ASINCRONOS -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- fin contenido dinamico-->
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
    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- Datatable for BS5 -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const habitacion = document.querySelector("#habitaciones");
            const cuerpohabitacion = habitacion.querySelector("div"); //etiqueta

            const cards = document.querySelector("#cards");
            const cuerpoCard = cards.querySelector("div");

            function mostrarHabitaciones() {
                const data = new URLSearchParams();
                data.append("operacion", "getdataHabitaciones");

                fetch("../controllers/habitaciones.controllers.php", {
                    method: 'POST',
                    body: data
                    })
                    .then(response => response.json())
                    .then(datos => {
                        cuerpohabitacion.innerHTML = ``
                        datos.forEach(element => {
                            let fila = `
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="h5 text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                        Nro° Habitacion: ${element.numhabitacion}
                                                    </div>
                                                    <div class="h6 mb-0 font-weight-bold text-dark">
                                                        Categoria: ${element.descripcion}
                                                    </div>
                                                    <div class="h6 mb-0 font-weight-bold text-success py-2">
                                                        Estado: ${element.estado}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            cuerpohabitacion.innerHTML += fila;
                        });
                    });
            }


            function hdisponible(){
                const data = new URLSearchParams();
                data.append("operacion", "habitacionDisponible");
                fetch("../controllers/habitaciones.controllers.php", {
                    method: 'POST',
                    body: data
                })
                    .then(response => response.json())
                    .then(datos => {
                        cuerpoCard.innerHTML = ``
                        datos.forEach(element => {
                            let fila = `
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-secondary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                                        total de habitaciones
                                                    </div>
                                                    <div class="h5 mb-0 font-weight-bold text-secondary">
                                                        ${element.Disponible}
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-clipboard-list  fa-2x text-secondary"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            cuerpoCard.innerHTML += fila;
                        })
                    })
            }

            function hocupado(){
                const data = new URLSearchParams();
                data.append("operacion", "habitacionOcupada");
                fetch("../controllers/habitaciones.controllers.php", {
                    method: 'POST',
                    body: data
                })
                    .then(response => response.json())
                    .then(datos => {
                        cuerpoCard.innerHTML = ``
                        datos.forEach(element => {
                            let fila = `

                            `;
                            cuerpoCard.innerHTML += fila;
                        })
                    })
            }

            function hlimpieza(){
                const data = new URLSearchParams();
                data.append("operacion", "habitacionLimpieza");
                fetch("../controllers/habitaciones.controllers.php", {
                    method: 'POST',
                    body: data
                })
                    .then(response => response.json())
                    .then(datos => {
                        cuerpoCard.innerHTML = ``
                        datos.forEach(element => {
                            let fila = `
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-secondary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                                        total de habitaciones
                                                    </div>
                                                    <div class="h5 mb-0 font-weight-bold text-secondary">
                                                        ${element.Limpieza}
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-clipboard-list  fa-2x text-secondary"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            cuerpoCard.innerHTML += fila;
                        })
                    })
            }
            hocupado();
            hlimpieza();
            hdisponible();

            mostrarHabitaciones();
        });
    </script>
</body>
</html>