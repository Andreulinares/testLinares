document.addEventListener('DOMContentLoaded', function () {
    const checkboxes = document.querySelectorAll('.filtro-categoria');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            filtrarProductos();
        });
    });

    function filtrarProductos() {
        const categoriasSeleccionadas = obtenerCategoriasSeleccionadas();

        // Mostrar todas las tarjetas
        const todasLasTarjetas = Array.from(document.querySelectorAll('.card-container'));
        todasLasTarjetas.forEach(tarjeta => {
            tarjeta.style.display = 'block';
        });

        // Ocultar tarjetas de categorías no seleccionadas
        categoriasSeleccionadas.forEach(categoria => {
            const tarjetasNoSeleccionadas = todasLasTarjetas.filter(tarjeta => !tarjeta.classList.contains(categoria));
            tarjetasNoSeleccionadas.forEach(tarjeta => {
                tarjeta.style.display = 'none';
            });
        });
    }

    function obtenerCategoriasSeleccionadas() {
        return Array.from(checkboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value);
    }

    // Inicialmente, muestra todas las tarjetas al cargar la página
    filtrarProductos();
});
