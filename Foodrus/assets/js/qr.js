function generarCodigoQR() {
    // Obtener datos necesarios, especificar la url de la pagina que queremos usar
    let urlMisPedidos = 'http://testlinares.com/Foodrus/views/misPedidos.php';

    // Hacer una solicitud a la API que genera el codigo QR
    fetch('https://api.qr-code-generator.com/v1/create/', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            data: urlMisPedidos,
            size: '200x200',  //ajustamos tamaño de la imagen 
            margin: 10
        })
    })
    .then(response => response.json())
    .then(data => {
        // Llamar a una función para mostrar el código QR en la pantalla
        mostrarCodigoQR(data.qr_code);
    })
    .catch(error => console.error('Error al generar el código QR:', error));
}

function mostrarCodigoQR(codigoQR) {
    // Crear elemento img especificando el codigo QR como contenido del src.
    let img = document.createElement('img');
    img.src = codigoQR;

    // Crear un contenedor 
    let contenedorQR = document.createElement('div');
    contenedorQR.appendChild(img);

    // Añadir ventana pop up al contenedor
    let popup = window.open('', '_blank', 'width=300,height=300');
    popup.document.body.appendChild(contenedorQR);

    let botonCerrar = document.createElement('button');
    botonCerrar.textContent = 'Cerrar';
    botonCerrar.addEventListener('click', function () {
        popup.close();  // Cerrar el pop-up cuando se hace clic en el botón
    });
    contenedorQR.appendChild(botonCerrar);

    // diseño y estilo contenedor (opcional)

    // Llamar a la función para redirigir a la pagina de carta.php
}
function mostrarVentanaQR(){
    generarCodigoQR();

    return true;
}
