document.addEventListener('DOMContentLoaded', function () {
    // Manejar el evento de envío del formulario
    document.getElementById('form-reseñas').addEventListener('submit', function (event) {
        event.preventDefault(); // Evitar el envío normal del formulario

        // Obtener los valores del formulario
        var comentario = document.getElementById('coment').value;
        var puntuacion = document.getElementById('puntuacion').value;

        // Validar y agregar la nueva reseña a la tabla
        if (comentario && puntuacion) {
            agregarReseñaATabla(comentario, puntuacion);
        }
    });
});

function agregarReseñaATabla(comentario, puntuacion) {
    // Crear una nueva fila y celdas
    var fila = document.createElement('tr');
    var celdaComentario = document.createElement('td');
    var celdaPuntuacion = document.createElement('td');

    // Establecer el contenido de las celdas
    celdaComentario.textContent = comentario;
    celdaPuntuacion.textContent = puntuacion;

    // Agregar las celdas a la fila
    fila.appendChild(celdaComentario);
    fila.appendChild(celdaPuntuacion);

    // Agregar la fila a la tabla
    document.getElementById('tablaReseñas').getElementsByTagName('tbody')[0].appendChild(fila);

    // Limpiar los campos del formulario
    document.getElementById('coment').value = '';
    document.getElementById('puntuacion').value = '';
}