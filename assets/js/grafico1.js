document.addEventListener("DOMContentLoaded", () => {
  const lienzo = document.querySelector("#grafico1");
  const graficoBarras = new Chart(lienzo, {
    type: 'bar',
    data: {
      labels: [],
      datasets: [
        {
          borderColor: '#E74C3C',
          background: ['#2E86C1','#1D8348','#909497','#F1C40F'],
          label: 'Puntos',
          data: [],
          borderWidth: 1
        }
      ]
    }
  });

  function graficos(datos = []) {
    let etiquetas = [];
    let data = [];

    datos.forEach(element => {
      etiquetas.push(element.dias);
      data.push(element.cantidad);
    });

    graficoBarras.data.labels = etiquetas;
    graficoBarras.data.datasets[0].data = data;
    graficoBarras.update();
  }

  function cargarDatos(){
    const parameter = new URLSearchParams();
    parameter.append("operacion", "finSemana");
    fetch(`../controllers/graficos.controllers.php`, {
      method: 'POST',
      body: parameter
    })
    .then(response => response.json())
    .then(datos => {
      graficos(datos);
    })
  }
  cargarDatos();
})
