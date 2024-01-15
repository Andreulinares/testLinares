document.addEventListener('DOMContentLoaded', function() {
    let usuarioBoton = document.getElementById('usuario-btn');
    let desplegableMenu = document.getElementById('desplegable-menu');
    let contenedorHeader = document.getElementById('mi-header');
    let menuAbierto = false;

    usuarioBoton.addEventListener('click', function(event) {
        event.stopPropagation();
        menuAbierto = !menuAbierto;
        contenedorHeader.classList.toggle('header-expandido');
        desplegableMenu.style.display = menuAbierto ? 'block' : 'none';
    });

    desplegableMenu.addEventListener('blur', function() {
        if (menuAbierto) {
            menuAbierto = false;
            contenedorHeader.classList.toggle('header-expandido');
            desplegableMenu.style.display = 'none';
        }
    });

    document.addEventListener('click', function() {
        if (menuAbierto) {
            menuAbierto = false;
            contenedorHeader.classList.toggle('header-expandido');
            desplegableMenu.style.display = 'none';
        }
    });
});