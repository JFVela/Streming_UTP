document.addEventListener('DOMContentLoaded', function() {
    fetch('/controllers/admin/obtenerGraficaAnomalias.php')
        .then(response => response.json())
        .then(data => {
            const montos = data.map(item => item.monto);
            const puntuaciones_z = data.map(item => item.puntuacion_z);

            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'scatter',
                data: {
                    datasets: [{
                        label: 'Donaciones vs Puntuaciones Z',
                        data: data.map(item => ({
                            x: item.monto,
                            y: item.puntuacion_z
                        })),
                        backgroundColor: '#C80036', // Verde claro
                        borderColor: '#0C1844', // Verde oscuro
                        borderWidth: 2, // Tamaño del borde
                        pointRadius: 10, // Tamaño del punto (círculo)
                        pointHoverRadius: 5, // Tamaño del punto al pasar el mouse
                    }]
                },
                options: {
                    scales: {
                        x: {
                            type: 'linear',

                            position: 'bottom',

                            title: {
                                display: true,
                                text: 'Monto ($)'
                            },
                            grid: {
                                color: '#FF6969' // Color del eje x
                            },
                            ticks: {
                                color: '#0C1844' // Color de las etiquetas del eje x
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Puntuación Z'
                            },
                            ticks: {
                                color: '#0C1844' // Color del eje x
                            },
                            grid: {
                                color: '#FF6969', // Color del eje x
                                drawOnChartArea: true // Asegurarse de que la cuadrícula se dibuje dentro del área del gráfico
                            }
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error:', error));
});