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
    fetch('//testlinares.com/Foodrus/index.php?controller=API&action=api', {
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
    mostrarReseñasEnPagina();//mostrar reseñas

    let formulario = document.getElementById('form-reseñas');

    formulario.addEventListener('submit', function (event) {
        event.preventDefault();

        const comentario = document.getElementById('comentario').value;
        const puntuacion = document.getElementById('puntuacion').value; 
        //obtenemos los datos insertados en el formulario mediante FormData
        const formData = new FormData();
        formData.append('comentario', comentario);
        formData.append('puntuacion', puntuacion);

        fetch('//testlinares.com/Foodrus/index.php?controller=API&action=insertarReseñas', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.mensaje === 'Reseña añadida correctamente'){
                success();//llamar a funcion notie
                mostrarReseñasEnPagina();//mostrar reseñas actualizadas una vez insertada nueva reseña
                document.getElementById('comentario').value = '';
                document.getElementById('puntuacion').value = '';
            }
            
        })
        .catch(error => {
            console.error('Error al enviar la reseña:', error);
        });
    });
});

//funcion notie js que muestra mensaje de exito
function success() {
    notie.alert({ type: 1, text: 'Reseña adida con exito!', time: 2 });
}

document.getElementById('filtro-nota').addEventListener('change', function () {
    const notaSeleccionada = this.value;

    // Oculta todas las reseñas
    const reseñas = document.querySelectorAll('.reseña-contenedor');
    reseñas.forEach(reseña => reseña.style.display = 'none');

    // Muestra solo las reseñas de la nota seleccionada
    if (notaSeleccionada !== '0') {
        const reseñasFiltradas = document.querySelectorAll(`.puntuacion img[src="../img/fullstar.png"]`);
        reseñasFiltradas.forEach(reseña => {
            const contenedor = reseña.closest('.reseña-contenedor');
            const puntuacion = reseña.parentNode.querySelectorAll('img').length;

            if (puntuacion == notaSeleccionada) {
                contenedor.style.display = 'block';
            }
        });
    } else {
        // Si se selecciona "Mostrar Todas", muestra todas las reseñas (opcion por defecto)
        reseñas.forEach(reseña => reseña.style.display = 'block');
    }
});

document.getElementById('filtro-orden').addEventListener('change', function () {
    const ordenSeleccionado = this.value;

    // Obtener todas las reseñas
    const reseñas = document.querySelectorAll('.reseña-contenedor');

    // Almacenar las reseñas en un array para poder ordenarlas usando sort
    const reseñasArray = Array.from(reseñas);

    // Ordenamos las reseñas 
    reseñasArray.sort((a, b) => {
        const puntuacionA = obtenerPuntuacion(a);
        const puntuacionB = obtenerPuntuacion(b);

        return (ordenSeleccionado === 'asc') ? puntuacionA - puntuacionB : puntuacionB - puntuacionA;
    });

    // Eliminar las reseñas del contenedor actual
    const contenedorReseñas = document.getElementById('reseñas-container');
    contenedorReseñas.innerHTML = '';

    // Agregar las reseñas ordenadas al contenedor
    reseñasArray.forEach(reseña => {
        contenedorReseñas.appendChild(reseña);
    });
});

function obtenerPuntuacion(reseñaElemento) {
    // Obtenemos la puntuación desde las imágenes de estrellas
    const estrellas = reseñaElemento.querySelectorAll('.puntuacion img[src="../img/fullstar.png"]');
    return estrellas.length;
}




