document.addEventListener('DOMContentLoaded', function () {
    const checkboxes = document.querySelectorAll('.filtro-categoria');

    checkboxes.forEach(checkbox => {
        //Llamamos a la funcion de filtrarProductos
        checkbox.addEventListener('change', function () {
            filtrarProductos();
        });
    });

    function filtrarProductos() {
        const categoriasSeleccionadas = obtenerCategoriasSeleccionadas();

        // Obtener todas las tarjetas
        const todasLasTarjetas = Array.from(document.querySelectorAll('.card-container'));

        // Mostrar u ocultar tarjetas según las categorías seleccionadas
        todasLasTarjetas.forEach(tarjeta => {
            const categoriaTarjeta = obtenerCategoriaTarjeta(tarjeta);
            tarjeta.style.display = categoriasSeleccionadas.length === 0 || categoriasSeleccionadas.includes(categoriaTarjeta) ? 'block' : 'none';
        });
    }

    function obtenerCategoriasSeleccionadas() {
        //funcion para obtener categorias seleccionadas en el checkbox
        return Array.from(checkboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value);
    }

    function obtenerCategoriaTarjeta(tarjeta) {
        const categoriasSeleccionadas = obtenerCategoriasSeleccionadas();
        return tarjeta.classList.value.split(' ').find(clase => categoriasSeleccionadas.includes(clase));
    }

    // Inicialmente, muestra todas las tarjetas al cargar la página
    filtrarProductos();
});