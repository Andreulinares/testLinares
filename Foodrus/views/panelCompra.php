<?php
require __DIR__ . '/../model/Pedido.php';
require __DIR__ . '/../model/Pizza.php';
require __DIR__ . '/../model/Bebida.php';
require __DIR__ . '/../model/Postre.php';

session_start();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de compra</title>
    <link href="../assets/css/carrito.css" rel="stylesheet">
</head>
<body>
    <h3>Mi cesta</h3>

    <?php
    foreach ($_SESSION['selecciones'] as $pos => $pedido):
        $producto = $pedido->getProducto();
        $cantidad = $pedido->getCantidad();
        $precioTotal = $producto->getPrecio() * $cantidad;
    ?>

    <div class="producto">
        <div class="img-producto">
            <img src="../<?= $pedido->getProducto()->getImagen(); ?>" width="100" height="100">
        </div>
        <div class="detalles">
            <div class="nombre-producto"><?= $pedido->getProducto()->getNombre_producto(); ?></div>
            <div class="id-producto"><?= $pedido->getProducto()->getProducto_id(); ?></div>
            <div class="precio-producto">
                <p>Precio del articulo: <?= $precioTotal; ?></p>
            </div>
        </div>

        <form action="../index.php?action=compra" method='post' class="botones">
            <label for="cantidad">Cantidad:</label>
            <button class="b1 bet-button w3-black w3-section" type="submit" name="Add" value=<?=$pos?>> + </button>
            <input class="cantidad" type="number" id="cantidad" name="cantidad" value="<?= $pedido->getCantidad() ?>" readonly>
            <button class="b2 del-button w3-black w3-section" type="submit" name="Del" value=<?=$pos?>> - </button>
        </form>
    </div>
    <?php
    endforeach;
    ?>
</body>
</html>