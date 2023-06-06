$(document).ready(function (){

  function get_pagos(){
    $.ajax({
      url: '../controller/reservacion.controller.php',
      type: 'POST',
      data: {'operacion' : 'pagosGet'},
      success: function (result){

        var tablaDT = $("#table_pagos").DataTable();
        tablaDT.destroy();

        $("#table_pagos tbody").html(result);

        $("#table_pagos").DataTable({
          dom: 'Bfrtip',
          responsive:true,
          language: {
            url: '../js/Spanish.json'
          }
        });
      }
    });
  }
  get_pagos();
});