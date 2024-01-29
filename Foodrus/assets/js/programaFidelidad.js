// Función para obtener y mostrar los puntos actuales
function mostrarPuntos() {
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

/*function actualizarPuntos() {
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
}*/

document.addEventListener('DOMContentLoaded', function() {
    let formulario = document.getElementById('form-compra');

    formulario.addEventListener('submit', function (event) {
        event.preventDefault();

        const cantidadTotal = document.getElementById('cantidadTotal').value;

        const datos = {
            accion: 'actualizar_puntos',
            cantidadTotal: cantidadTotal
        };

        fetch('http://testlinares.com/Foodrus/index.php?controller=API&action=apiPuntos',{
            method: 'POST',
            body: JSON.stringify(datos),
            headers: {
                'Content-Type': 'application/json'
            },
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.error('Error al actualizar los puntos:', error);
        });
    })
})