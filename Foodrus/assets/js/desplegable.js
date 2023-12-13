document.addEventListener('DOMContentLoaded', function () {
    let header = document.getElementById('mi-header');
    let dropdownMenu = document.getElementById('desplegable-menu');
    let isOpen = false;

    document.getElementById('usuario-btn').addEventListener('click', function () {
        isOpen = !isOpen;

        if (isOpen) {
            // Deslizar el header hacia abajo y mostrar el menú desplegable
            header.style.transform = 'translateY(50px)'; // Ajusta la cantidad de desplazamiento según tus necesidades
            dropdownMenu.style.display = 'block';
        } else {
            // Volver el header a su posición original y ocultar el menú desplegable
            header.style.transform = 'translateY(0)';
            dropdownMenu.style.display = 'none';
        }
    });
});
