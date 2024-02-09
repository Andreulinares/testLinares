function guardarPropina(){
    let propinaSeleccionada = parseFloat(document.getElementById('inputPropina').value);
    let precioTotal = parseFloat(document.getElementById('cantidadTotal').value);

    let precioMasPropina = (propinaSeleccionada / 100) * precioTotal;
    let nuevoPrecio = precioTotal + precioMasPropina;

    document.getElementById('precioTotal').innerText = nuevoPrecio.toFixed(2) + '€';
}