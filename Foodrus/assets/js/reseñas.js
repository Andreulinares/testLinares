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

// Función para mostrar reseñas en la página
function mostrarReseñasEnPagina() {
    fetch('http://testlinares.com/Foodrus/index.php?controller=API&action=api', {
        method: 'POST',
        body: new URLSearchParams({
            accion: 'mostrar_reseñas'
        }),
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
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
        console.error('Error al obtener reseñas:', error);
    });
}

// Evento cuando se carga la página
document.addEventListener('DOMContentLoaded', function () {
    // Llamada a la función para mostrar reseñas al cargar la página
    mostrarReseñasEnPagina();

    // Evento de envío del formulario para agregar una nueva reseña
    document.getElementById('form-reseñas').addEventListener('submit', function (event) {
        event.preventDefault();

        let puntuacion = document.getElementById('puntuacion').value;
        let comentario = document.getElementById('coment').value;

        // Crear un objeto URLSearchParams con los datos del formulario
        const reseña = {
            puntuacion: puntuacion,
            comentario: comentario
        };

        const reseñaJSON = JSON.stringify(reseña); 

        fetch('http://testlinares.com/Foodrus/index.php?controller=API&action=api', {
            method: 'POST',
            body: reseñaJSON, accion: 'add_review',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);

            // Llamada a la función para mostrar reseñas después de agregar una nueva
            mostrarReseñasEnPagina();
        })
        .catch(error => {
            console.error('Error al enviar la reseña:', error);
        });
    });
});
