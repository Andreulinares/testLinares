function guardarPropina(){
    let propinaSeleccionada = parseFloat(document.getElementById('inputPropina').value);
    let precioTotal = parseFloat(document.getElementById('cantidadTotal').value);

    let precioMasPropina = (propinaSeleccionada / 100) * precioTotal;
    let nuevoPrecio = precioTotal + precioMasPropina;

    document.getElementById('precioTotal').innerText = nuevoPrecio.toFixed(2) + '€';

    success();
}

function success() {
    notie.alert({ type: 1, text: 'Propina añadida con exito!', time: 2 });
}