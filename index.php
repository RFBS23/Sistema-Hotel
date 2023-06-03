<?php
  session_start();
  if (isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion']['login']) {
    header('Location: views/dashboard.php');
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bienvenido</title>
  <link rel="shortcut icon" href="images/icono.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body style="background-color: #CBE6FC;">
  <section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex align-items-center justify-content-center h-100">
        <div class="col-md-8 col-lg-7 col-xl-6">
          <img src="images/hotel.svg" class="img-fluid" alt="logo">
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
          <div class="text-center">
            <img src="images/icono.png" style="width: 185px;" alt="logo">
            <h4 class="mt-1 mb-5 pb-1">Inicia Sesion</h4>
          </div>
          <form>
            <div class="form-floating mb-3">
              <input type="email" class="form-control rounded-3 " id="email" placeholder="name@example.com" autofocus autocomplete="off" style="background-color: #FCCBF6;">
              <label for="email">Correo Electronico</label>
            </div>
            <div class="form-floating mb-3">
              <input type="password" class="form-control rounded-3" id="password" placeholder="Password" style="background-color: #CBFCDB;">
              <label for="password">contraseña</label>
            </div>
            <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="button" id="iniciar-sesion">Ingresar</button>
          </form>
        </div>
      </div>
      <footer class="sticky-footer ">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Sistema Hotel by Fabrizio Barrios Saavedra - RFBS23</span>
          </div>
        </div>
      </footer>
    </div>
  </section>

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function (){

      let timerInterval

      function login(){
        const datos = {
          "operacion": "iniciarSesion",
          "email"    : $("#email").val(),
          "password" : $("#password").val()
        };

        $.ajax({
          url: 'controllers/usuario.controllers.php',
          type: 'GET',
          data: datos,
          dataType: 'JSON',
          success: function (result){
            if (result.login){
              Swal.fire({
                title: `Bienvenido: ${result.nombres} ${result.apellidos}`,
                text: 'Se le dirigira automaticamente al dashboard',
                timer: 2000,
                timerProgressBar: true,
                allowOutsideClick: false,
                didOpen: () => {
                  Swal.showLoading()
                  const b = Swal.getHtmlContainer().querySelector('b')
                  timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft()
                  }, 100)
                },
                willClose: () => {
                  clearInterval(timerInterval)
                }
              }).then((result) => {
                window.location.href = `views/dashboard.php`;
              })
              //alert(`Bienvenido: ${result.apellidos} ${result.nombres}`);
            }else{
              Swal.fire({
                text: result.mensaje,
                timer: 2000,
                timerProgressBar: true,
              })
              //alert(result.mensaje);
            }
          }
        });
      }

      $("#iniciar-sesion").click(login);
      
      $("#password").keypress(function (evt) {
        if (evt.keyCode == 13){
          login();
        }
      });
    });
  </script>
</body>
</html>