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
});

function agregarReseñaAContenedor(comentario, puntuacion) {
    // Se crea un nuevo contenedor
    const contenedor = document.createElement('div');
    contenedor.classList.add('reseña-contenedor');
    // Zona Puntuacion
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
    // Agregar el contenedor al elemento tbody
    document.getElementById('reseñas-container').appendChild(contenedor);
    // Limpiar campos del formualario
    document.getElementById('coment').value = '';
    document.getElementById('puntuacion').value = '';
}*/

document.getElementById('form-reseñas').addEventListener('submit', function (event) {
    event.preventDefault();

    let formDatos = new FormData(event.target);
    formDatos.append('accion', 'add_review');

    fetch('../controller/APIController.php', {
        method: 'POST',
        body: JSON.stringify({ 
            accion: 'add_review', 
            reseña: {
                puntuacion: formDatos.get('puntuacion'),
                comentario: formDatos.get('coment')
            }
        }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
    })
    .catch(error => {
        console.error('Error al enviar la reseña:', error);
    });
});