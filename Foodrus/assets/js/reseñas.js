/*document.addEventListener('DOMContentLoaded', function () {
    // Manejar el evento de envío del formulario
    document.getElementById('form-reseñas').addEventListener('submit', function (event) {
        event.preventDefault(); // Evitar el envío normal del formulario

        // Obtener los valores del formulario
        var comentario = document.getElementById('coment').value;
        var puntuacion = document.getElementById('puntuacion').value;

        // Validar y agregar la nueva reseña a la tabla
        if (comentario && puntuacion) {
            agregarReseñaAContenedor(comentario, puntuacion);
        }
    });
});*/

function mostrarReseña(puntuacion, comentario) {
    const contenedor = document.createElement('div');
    contenedor.classList.add('reseña-contenedor');

    // Zona Puntuación
    const puntuacionElement = document.createElement('div');
    puntuacionElement.classList.add('puntuacion');

    // Convertir la puntuación a estrellas
    let estrellasHtml = '';
    for (let i = 0; i < puntuacion; i++) {
        estrellasHtml += '<img src="../img/fullstar.png" class="img-estrella" alt="Estrella">';
    }

    puntuacionElement.innerHTML = estrellasHtml;
    contenedor.appendChild(puntuacionElement);

    // Zona Comentario
    const comentarioElement = document.createElement('div');
    comentarioElement.classList.add('comentario');
    comentarioElement.textContent = comentario;
    contenedor.appendChild(comentarioElement);

    // Agregar el contenedor al elemento contenedor de reseñas
    document.getElementById('reseñas-container').appendChild(contenedor);
}

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('form-reseñas').addEventListener('submit', function (event) {
    event.preventDefault();

        let puntuacion = document.getElementById('puntuacion').value;
        let comentario = document.getElementById('coment').value;

        let datosReseña = {
            accion: 'add_review',
            reseña: {
                puntuacion: puntuacion,
                comentario: comentario
            }
        };

        fetch('http://testlinares.com/Foodrus/index.php?controller=API&action=api', {
            method: 'POST',
            body: JSON.stringify(datosReseña),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);

            return fetch('http://testlinares.com/Foodrus/index.php?controller=API&action=api', {
                method: 'POST',
                body: JSON.stringify({ accion: 'mostrar_reseñas' }),
                headers: {
                    'Content-Type': 'application/json'
                }
            });
        })
        .then(response => response.json())
        .then(reseñas => {
            console.log('Reseñas obtenidas:', reseñas);

            // Mostrar cada reseña en la página
            reseñas.forEach(reseña => {
                mostrarReseña(reseña.puntuacion, reseña.comentario);
            });
        })
        .catch(error => {
            console.error('Error al enviar la reseña:', error);
        });
    });
});