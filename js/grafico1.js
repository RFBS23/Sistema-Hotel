document.addEventListener("DOMContentLoaded", () => {

    const grafico = document.querySelector("#graficoReservaciones");

    const graficoBarras = new Chart(grafico, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [
                {
                    backgroundColor: ['#18BC51','#FF4343','#BB62E3','#62E3AD','#3259EA'],
                    label: 'graficoReservaciones',
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
            etiquetas.push(element.diasReservacion);
            data.push(element.cantReservaciones);
        });

        //Asignamos los datos al grafico
        graficoBarras.data.labels = etiquetas;
        graficoBarras.data.datasets[0].data = data;
        graficoBarras.update();

    }

    function loadData(){
        const parameter = new URLSearchParams();
        parameter.append("operacion", "diasReservaciones");

        fetch(`../controller/grafico.controller.php`,{
            method: 'POST',
            body: parameter
        })
            .then(response => response.json())
            .then(datos => {
                renderGrafico(datos);
            });
    }


    loadData();


})