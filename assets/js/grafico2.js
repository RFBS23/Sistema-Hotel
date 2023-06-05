document.addEventListener("DOMContentLoaded", () => {
  const lienzo2 = document.querySelector("#grafico2");
  const graficoCircular = new Chart(lienzo2, {
    type: 'pie',
    data: {
      labels: [],
      datasets: [
        {
          borderColor: '#E74C3C',
          background: ['#2E86C1','#1D8348','#909497','#F1C40F'],
          label: 'Puntos',
          data: [],
        }
      ]
    }
  });
  function grafico2(datos = []) {
    let etiquetas = [];
    let data = [];

    datos.forEach(element => {
      etiquetas.push(element.dias);
      data.push(element.monto);
    });

    graficoCircular.data.labels = etiquetas;
    graficoCircular.data.datasets[0].data = data;
    graficoCircular.update();
  }

  function cargarCirculo() {
    const parameter = new URLSearchParams();
    parameter.append("operacion", "montoSemanal");
    fetch(`../controllers/graficos.controllers.php`, {
      method: 'POST',
      body: parameter
    })
    .then(response => response.json())
    .then(data => {
      grafico2(data);
    });
  }
  cargarCirculo();
})
