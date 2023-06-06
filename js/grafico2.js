document.addEventListener("DOMContentLoaded", () =>{

    const grafico = document.querySelector("#graficoMonto");

    const graficoPie = new Chart(grafico, {
        type: 'pie',
        data: {
            labels: [],
            datasets: [
                {
                    backgroundColor: ['#18BC51','#4F62D1','#FF4343','#E232EA', '#EA7832'],
                    label: 'Monto total de ventas a la semana',
                    data: []
                }
            ]
        }
    })

    function renderGrafico(datos = []){
        let etiquetas = [];
        let data = [];

        datos.forEach(element =>{
            //Enviamos los datos a los arreglos
            etiquetas.push(element.dia_semana);
            data.push(element.monto_venta);
        });

        //Asignamos los datos al grafico
        graficoPie.data.labels = etiquetas;
        graficoPie.data.datasets[0].data = data;
        graficoPie.update();
    }

    function loadData(){
        const parameter = new URLSearchParams();
        parameter.append("operacion", "montoSemanal");

        fetch(`../controller/grafico.controller.php`, {
            method: 'POST',
            body: parameter
        })
        .then(response => response.json())
        .then(data => {
            renderGrafico(data);
        });
    }

    loadData();

})