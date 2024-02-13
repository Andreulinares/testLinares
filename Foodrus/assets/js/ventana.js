function mostrarVentana() {
    let ventana = document.getElementById("ventana");
    let fondoOscuro = document.getElementById("fondoOscuro");
    ventana.style.display = 'block';
    fondoOscuro.style.display = 'block';

    document.getElementById('btnFinalizarCompra').addEventListener('click', function() {
        window.location.href = '/Foodrus/views/panelCompra.php';
    });

    document.getElementById('btnContinuarComprando').addEventListener('click', function() {
        ventana.style.display = 'none'; 
        fondoOscuro.style.display = 'none';
    });

    window.onclick = function(event) {
        if (event.target === ventana) {
            ventana.style.display = 'none';
            fondoOscuro.style.display = 'none';
        }
    };
}