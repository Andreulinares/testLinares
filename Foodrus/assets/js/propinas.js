function guardarPropina(){
    let propinaSeleccionada = parseFloat(document.getElementById('inputPropina').value);
    let precioTotal = parseFloat(document.getElementById('cantidadTotal').value);

    let precioMasPropina = (propinaSeleccionada / 100) * precioTotal;
    let nuevoPrecio = precioTotal + precioMasPropina;

    localStorage.setItem('propina', nuevoPrecio.toFixed(2));

    document.getElementById('precioTotal').innerText = nuevoPrecio.toFixed(2) + '€';

    document.querySelectorAll('input[name="cantidadTotal"]').forEach(input => {
        input.value = nuevoPrecio.toFixed(2);
    });

    success();
}

function success() {
    notie.alert({ type: 1, text: 'Propina añadida con exito!', time: 2 });
}

document.addEventListener("DOMContentLoaded", function() {
    let propinaGuardada = localStorage.getItem('propina');
    if (propinaGuardada) {
        document.querySelectorAll('input[name="cantidadTotal"]').forEach(input => {
            input.value = propinaGuardada;
        });
    }
});