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
  <link rel="stylesheet" href="../style/cardH.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <!-- Datatable for BS5 -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
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
        <hr>

        <button type="button" class="btn btn-outline-primary" id="btnRegistrarH" data-bs-toggle="modal"
          data-bs-target="#modal-registro">Registrar</button>

        <div class="mt-3" id="cardH">
          <div class="row">
            <!-- DATOS ASINCRONOS -->
          </div>
        </div>

      </div>
    </div>
  </div>

  <!--modale del registro -->
  <div class="modal fade" id="modal-registro" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTitleId">Registrar habitacion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" autocomplete="off" id="form_habitacion">
            <div class="mb-3">
              <label for="tipoHabitacion" class="form-label">Tipo de habitacion</label>
              <select id="tipoHabitacion" class="form-select">
                <option value="">Selección</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="numcamas" class="form-label">Numero de camas</label>
              <input type="number" id="numcamas" class="form-control form-control-sm">
            </div>
            <div class="mb-3">
              <label for="numhabitacion" class="form-label">Numero de habitacion</label>
              <input type="number" id="numhabitacion" class="form-control form-control-sm">
            </div>
            <div class="mb-3">
              <label for="piso" class="form-label">Piso</label>
              <input type="number" id="piso" class="form-control form-control-sm">
            </div>
            <div class="mb-3">
              <label for="capacidad" class="form-label">Capacidad</label>
              <input type="number" id="capacidad" class="form-control form-control-sm">
            </div>
            <div class="mb-3">
              <label for="precio" class="form-label">Precio</label>
              <input type="number" id="precio" class="form-control form-control-sm">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn " style="background-color: #27AE60 ;" id="btnR">Guardar</button>
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

  <script>
  document.addEventListener("DOMContentLoaded", () => {
    const cardH = document.querySelector("#cardH");
    const cuerpoCard = cardH.querySelector("div");
    const cardDispo = document.querySelector("#H_dispo");
    const cuerpoDispo = cardDispo.querySelector("div");
    const cardOcup = document.querySelector("#H_ocup");
    const cuerpoOcup = cardOcup.querySelector("div");
    const cardLimp = document.querySelector("#H_limp");
    const cuerpoLimp = cardLimp.querySelector("div");

    const lsTipoH = document.querySelector("#tipoHabitacion");
    const btnRegistrar = document.querySelector("#btnR")

    function getHabitaciones() {
      const data = new URLSearchParams();
      data.append("operacion", "habitacionGet");

      fetch("../controller/habitacion.controller.php", {
          method: 'POST',
          body: data
        })
        .then(response => response.json())
        .then(datos => {
          cuerpoCard.innerHTML = ``
          datos.forEach(element => {
            let row = `
                  <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="h5 text-xs font-weight-bold text-dark text-uppercase mb-1">
                                        Nro° Habitacion: ${element.numhabitacion}
                                    </div>
                                    <div class="h6 mb-0 font-weight-bold text-dark">
                                        Categoria: ${element.tipo}
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
            cuerpoCard.innerHTML += row;
          });
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
            let row = ` <div class="card-body">
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

    function mostrarTipoH() {
      const parameters = new URLSearchParams();
      parameters.append("operacion", "mostrarTipoH");

      fetch("../controller/habitacion.controller.php", {
          method: 'POST',
          body: parameters
        })
        .then(response => response.json())
        .then(data => {
          lsTipoH.innerHTML = "<option value=''>Seleccione</option>";
          data.forEach(element => {
            const optionTag = document.createElement("option");
            optionTag.value = element.idtipohabitacion
            optionTag.text = element.tipo;
            lsTipoH.appendChild(optionTag);
          });
        });

    }

    function registrarHabitacion() {
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
          parameters.append("operacion", "habitacionRegistrar");
          parameters.append("idtipohabitacion", document.querySelector("#tipoHabitacion").value);
          parameters.append("numcamas", document.querySelector("#numcamas").value);
          parameters.append("numhabitacion", document.querySelector("#numhabitacion").value);
          parameters.append("piso", document.querySelector("#piso").value);
          parameters.append("capacidad", document.querySelector("#capacidad").value);
          parameters.append("precio", document.querySelector("#precio").value);

          fetch("../controller/habitacion.controller.php", {
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
                  title: 'Nueva habitacion registrada',
                  showConfirmButton: false,
                  timer: 1500
                })
                document.querySelector("#form_habitacion").reset();
                $("#modal-registro").modal('hide');
              } else {
                Swal.fire("Error", data.message, "error");
              }
            });

        }
      });
    }

    getHabitaciones();
    getDisponibles();
    getOcupadas();
    getMantenimiento();
    mostrarTipoH();
    btnRegistrar.addEventListener("click", registrarHabitacion);

  });
  </script>


</body>

</html>