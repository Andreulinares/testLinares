// Función para obtener y mostrar los puntos actuales
function obtenerYMostrarPuntos() {
    fetch('http://testlinares.com/Foodrus/index.php?controller=API&action=apiPuntos', {
        method: 'POST',
        body: new URLSearchParams({
            accion: 'obtener_puntos',  
        }),
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);

        // Mostrar los puntos actuales en alguna parte de la página
        const puntosActuales = data.puntos; 
        document.getElementById('puntos-actuales').textContent = `Puntos actuales: ${puntosActuales}`;
    })
    .catch(error => {
        console.error('Error al obtener puntos:', error);
    });
}

function actualizarPuntos() {
    fetch('http://testlinares.com/Foodrus/index.php?controller=API&action=apiPuntos', {
        method: 'POST',
        body: new URLSearchParams({
            accion: 'actualizar_puntos',
        }),
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
    })
    .catch(error => {
        console.error('Error al actualizar los puntos:', error);
    });
}