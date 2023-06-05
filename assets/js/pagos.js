$(document).ready(function (){
  function listarPago(){
    $.ajax({
      url: '../controllers/reservaciones.controllers.php',
      type: 'POST',
      data: {'operacion' : 'listarPagos'},
      success: function (result) {
        var tabla = $("#tablapagos").DataTable();
        tabla.destroy();
        $("#tablapagos tbody").html(result);
        $("#tablapagos").DataTable({
          dom: 'Bfrtip',
          responsive: true,
          language: {
            url: '../assets/js/Spanish.json'
          }
        })
      }
    })
  }
  listarPago();
})