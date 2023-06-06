

    //Objetos
    const lsEmpleado = document.querySelector("#idempleado");
    const lsUsuario = document.querySelector("#idusuario");
    const lsHabitacion = document.querySelector("#idhabitacion");
    const lsCliente = document.querySelector("#idcliente");
    const btnRegistrar = document.querySelector("#guardar");
    const btnReset = document.querySelector("#btnReset");
    
    //reporte
    const reporte = document.querySelector("#exportar");

    /*
    function generarPDF(){
        const data = new URLSearchParams();
        data.append("operacion", "recuperarDatos", parseInt() )
    }*/

    //Métodos
    function mostrarEmpleado(){
        const parameters = new URLSearchParams();
        parameters.append("operacion", "empleadosGet");

        fetch("../controller/reservacion.controller.php", {
            method: 'POST',
            body: parameters
        })
        .then(response => response.json())
        .then(data => {
            lsEmpleado.innerHTML = "<option value=''>Seleccione</option>";
            data.forEach(element => {
                const optionTag = document.createElement("option");
                optionTag.value = element.idempleado
                optionTag.text = element.nombres;
                lsEmpleado.appendChild(optionTag);                        
            });
        });
    }

    function mostrarUsuario(){
        const parameters = new URLSearchParams();
        parameters.append("operacion", "usuariosGet");

        fetch("../controller/reservacion.controller.php", {
            method: 'POST',
            body: parameters
        })
        .then(response => response.json())
        .then(data => {
            lsUsuario.innerHTML = "<option value=''>Seleccione</option>";
            data.forEach(element => {
                const optionTag = document.createElement("option");
                optionTag.value = element.idusuario
                optionTag.text = element.nombreusuario;
                lsUsuario.appendChild(optionTag);                        
            });
        });
    }

    function mostrarHabitacion(){
        const parameters = new URLSearchParams();
        parameters.append("operacion", "habitacionesGet");

        fetch("../controller/reservacion.controller.php", {
            method: 'POST',
            body: parameters
        })
        .then(response => response.json())
        .then(data => {
            lsHabitacion.innerHTML = "<option value=''>Seleccione</option>";
            data.forEach(element => {
                const optionTag = document.createElement("option");
                optionTag.value = element.idhabitacion
                optionTag.text = element.habitacion;
                lsHabitacion.appendChild(optionTag);                        
            });
        });
    }

    function mostrarCliente(){
        const parameters = new URLSearchParams();
        parameters.append("operacion", "clientesBuscar");                

        fetch("../controller/reservacion.controller.php", {
            method: 'POST',
            body: parameters
        })
        .then(response => response.json())
        .then(data => {                        
            lsCliente.innerHTML = "<option value=''>Buscar cliente..</option>";
            data.forEach(element => {
                const optionTag = document.createElement("option");
                optionTag.value = element.idpersona
                optionTag.text = element.clientes;
                lsCliente.appendChild(optionTag);                        
            });
        });
    }

    mostrarEmpleado();
    mostrarUsuario();
    mostrarHabitacion();
    mostrarCliente();

    btnRegistrar.addEventListener("click", registrarReservacion); 
    btnReset.addEventListener("click", () => {
        //Resetear el select2
        $("#idcliente").val(null).trigger('change');            
    })           
    
