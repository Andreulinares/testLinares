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

function mostrarReseña(puntuacion, comentario, nombre_usuario) {
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

    // Zona nombre usuario
    const nombreElement = document.createElement('div');
    nombreElement.classList.add('nombreUsuario');
    nombreElement.textContent = nombre_usuario;
    contenedor.appendChild(nombreElement);

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
        //Limpiar contenedor para evitar reseñas duplicadas
        const contenedorReseñas = document.getElementById('reseñas-container');
        contenedorReseñas.innerHTML = '';
        // Mostrar cada reseña en la página
        reseñas.forEach(reseña => {
            mostrarReseña(reseña.puntuacion, reseña.comentario, reseña.nombre_usuario);
        });
    })
    .catch(error => {
        console.error('Error al obtener reseñas:', error);
    });
}

document.addEventListener('DOMContentLoaded', function () {
    mostrarReseñasEnPagina();

    let formulario = document.getElementById('form-reseñas');

    formulario.addEventListener('submit', function (event) {
        event.preventDefault();

        const comentario = document.getElementById('comentario').value;
        const puntuacion = document.getElementById('puntuacion').value; 

        const formData = new FormData();
        formData.append('comentario', comentario);
        formData.append('puntuacion', puntuacion);

        fetch('http://testlinares.com/Foodrus/index.php?controller=API&action=insertarReseñas', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            mostrarReseñasEnPagina();
            document.getElementById('comentario').value = '';
            document.getElementById('puntuacion').value = '';
        })
        .catch(error => {
            console.error('Error al enviar la reseña:', error);
        });
    });
});