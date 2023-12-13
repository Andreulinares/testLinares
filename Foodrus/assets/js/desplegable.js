document.addEventListener('DOMContentLoaded', function () {
    let header = document.getElementById('mi-header');
    let dropdownMenu = document.getElementById('desplegable-menu');
    let isOpen = false;

    document.getElementById('usuario-btn').addEventListener('click', function (event) {
        event.stopPropagation(); // Evita que el clic llegue al listener de clic fuera del encabezado
        isOpen = !isOpen;

        if (isOpen) {
            // Deslizar el header hacia abajo y mostrar el menú desplegable
            header.style.transform = 'translateY(50px)'; 
            dropdownMenu.style.display = 'block';
        } else {
            // El header vuelve a su posición original y se oculta el menú desplegable
            header.style.transform = 'translateY(0)';
            dropdownMenu.style.display = 'none';
        }
    });

    document.addEventListener('click', function () {
        if (isOpen) {
            // Si el menú desplegable está abierto, se cierra y el header vuelve a su posicion original
            isOpen = false;
            header.style.transform = 'translateY(0)';
            dropdownMenu.style.display = 'none';
        }
    });
});
