document.addEventListener('DOMContentLoaded', function () {
    let header = document.getElementById('mi-header');
    let nombreUsuario = document.getElementById('usuario-btn');
    let desplegableMenu = document.getElementById('desplegable-menu');
    let banner = document.getElementById('carouselExampleIndicators'); // Reemplaza 'banner' con el ID real de tu banner

    // Manejador de eventos para el clic en el nombre de usuario
    nombreUsuario.addEventListener('click', function (event) {
        event.stopPropagation(); // Evita que el clic se propague al documento y cierre inmediatamente el menú
        toggleMenu();
    });

    // Agregar un manejador de eventos para cerrar el menú desplegable si se hace clic fuera de él
    document.addEventListener('click', function (event) {
        if (!desplegableMenu.contains(event.target) && event.target !== nombreUsuario) {
            contraerMenu();
        }
    });

    // Función para alternar entre expandir y contraer el menú
    function toggleMenu() {
        if (header.style.transform === 'translateY(0px)') {
            desplegarMenu();
        } else {
            contraerMenu();
        }
    }

    // Función para desplegar el menú
    function desplegarMenu() {
        header.style.transform = 'translateY(' + nombreUsuario.clientHeight + 'px)';
        desplegableMenu.style.display = 'block';
        document.body.style.marginTop = header.clientHeight + 'px';
        header.style.position = 'fixed'; // Fija la posición del header
        banner.style.marginTop = '0'; // Ajusta el banner
    }

    // Función para contraer el menú
    function contraerMenu() {
        header.style.transform = 'translateY(0)';
        desplegableMenu.style.display = 'none';
        document.body.style.marginTop = '0';
        header.style.position = 'relative'; // Restaura la posición relativa del header
        banner.style.marginTop = '0';
    }
});
