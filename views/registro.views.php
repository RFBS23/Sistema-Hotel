<?php
  require_once 'permisos.php';
?>
<div class="row mb-2">
    <div class="col-md-6">
        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-primary">Registro de Personal</strong>
                <form action="" autocomplete="off" id="formulario-clientes">
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <label for="nombre" class="form-label bold">Nombres:</label>
                            <input type="text" class="form-control" id="nombre" onkeypress="return SoloLetras(event);" required>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="apellidos" class="form-label bold">Apellidos:</label>
                            <input type="text" class="form-control" id="apellidos" onkeypress="return SoloLetras(event);" required>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="telefono" class="form-label bold">Telefono:</label>
                            <input type="text" class="form-control" id="telefono" maxlength="9" onkeypress="return SoloNumeros(event);" required>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="nivel" class="form-label bold">Nivel de Acceso:</label>
                            <select class="custom-select" id="nivel" required>
                                <option selected disabled value=''>Seleccione ...</option>
                                <option selected value='Standar'>Estandar</option>
                                <option selected value='Administrador'>Administrador</option>
                            </select>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="email" class="form-label bold">Email:</label>
                            <input type="text" class="form-control" id="email" required>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="password" class="form-label bold">Contraseña:</label>
                            <input type="text" class="form-control" id="password" required>
                        </div>
                    </div>
                </form>
                <div class="mt-3">
                    <button type="button" class="btn btn-outline-success" id="guardar">Registrar Cliente</button>
                </div>
            </div>
        </div>
    </div>

    <!-- tabla -->
    <div class="col-md-6">
        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-4 text-success">Tabla de Personal</strong>

                <table class="table table-striped table-hover table-bordered table-striped display responsive" id="tablausuarios" width="100%">
                    <colgroup>
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%"><!-- Comandos -->
                    </colgroup>
                    <thead class="table-primary">
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Telefono</th>
                        <th>Acceso</th>
                        <th>correo electronico</th>
                        <th>Eliminar</th>
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

<script>
    $(document).ready(function (){
        let datosNuevos = true;
        let idusuario = 0;

        function mostrarUsuario(){
            $.ajax({
                url: '../controllers/registro.controllers.php',
                type: 'GET',
                data: {'operacion' : 'listarUsuario'},
                success: function (result){
                    //refereancia al objeto DT
                    var tabla = $("#tablausuarios").DataTable();
                    //destruimos la tabla
                    tabla.destroy();

                    $("#tablausuarios tbody").html(result);

                    //reconstruimos la tabla
                    $("#tablausuarios").DataTable({
                        responsive: true,
                        language: {
                            url: '../assets/js/Spanish.json'
                        }
                    });
                }
            });
        }

        function registrarUsuario(){
            let datosEnviar = {
                'operacion' : 'registrarUsuario',
                'apellidos' : $("#apellidos").val(),
                'nombres' : $("#nombres").val(),
                'telefono' : $("#telefono").val(),
                'email' : $("#email").val(),
                'claveacceso' : $("#password").val(),
                'nivelacceso' : $("#nivel").val()
            };
            if (confirm("¿Esta seguro de registrar?")){
                $.ajax({
                    url: '../controllers/registro.controllers.php',
                    type: 'GET',
                    data: datosEnviar,
                    success: function (result){
                        mostrarUsuario();
                    }
                })
            }
        }

        $("#guardar").click(registrarUsuario);
        mostrarUsuario();
    });
</script>