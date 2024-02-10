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
        const puntosActuales = data.puntos === null ? 0 : data.puntos;
        document.getElementById('puntos-actuales').textContent = puntosActuales;
    })
    .catch(error => {
        console.error('Error al obtener puntos:', error);
    });
}
//Actualizamos los puntos correspondientes recogiendo los valores del formulario
document.addEventListener('DOMContentLoaded', function() {
    mostrarPuntos();

    let formulario = document.getElementById('form-compra');

    formulario.addEventListener('submit', function (event) {
        event.preventDefault();
        //Obtenemos los valores introducidos por el usuario y sus puntos actuales
        const puntosUsuario = parseInt(document.getElementById('puntos-usuario').value);
        const puntosActualesSpan = document.getElementById('puntos-actuales');
        const puntosActualesText = puntosActualesSpan.innerText;
        const puntosActuales = parseInt(puntosActualesText);
        //Obtenemos cantidad total del pedido
        const cantidadTotal = parseInt(document.getElementById('cantidadTotal').value);
        //Calcular cantidad de puntos necesarios
        const puntosNecesarios = Math.floor(cantidadTotal * 100);
        console.log(puntosUsuario, puntosNecesarios, puntosActuales);
        if (puntosUsuario >= puntosNecesarios && puntosUsuario <= puntosActuales){
            const datos = {
                accion: 'actualizar_puntos',
                puntosUsuario: puntosUsuario,
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
    
                mostrarPuntos();
            })
            .catch(error => {
                console.error('Error al actualizar los puntos:', error);
            });
        } else {
            alert('Cantidad de puntos insuficientes o invalida');
        }
    });
});