function generarCodigoQR() {
    // url que se usara para generar la imagen qr
    let urlMisPedidos = 'http://testlinares.com/Foodrus/views/misPedidos.php';

    // Construir la URL de la API de generación de códigos QR
    let apiUrl = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${encodeURIComponent(urlMisPedidos)}`;

    // Hacer una solicitud para obtener la imagen del código QR
    fetch(apiUrl, {
        method: 'GET',
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Error al obtener el código QR: ${response.status}`);
        }
        return response.blob();
    })
    .then(data => {
        // Llamar a una función para mostrar el código QR en la pantalla
        mostrarCodigoQR(URL.createObjectURL(data));
    })
    .catch(error => console.error('Error al generar el código QR:', error));
}

function mostrarCodigoQR(codigoQR) {
    // Crear elemento img especificando el codigo QR como contenido del src.
    let img = document.createElement('img');
    img.src = codigoQR;
    //Añadimos la imagen qr al contenedor
    let contenedorQR = document.getElementById('contenedorQR');
    contenedorQR.innerHTML = '';  // Limpiar cualquier contenido previo
    contenedorQR.appendChild(img);
    //Mostramos el modal al llamar a esta funcion
    document.getElementById('modalQR').style.display = 'block';
}

function cerrarModal() {
    //Cerrar el modal
    document.getElementById('modalQR').style.display = 'none';
}
