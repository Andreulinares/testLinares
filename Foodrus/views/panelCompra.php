<?php
session_start();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de compra</title>
</head>
<body>
    <h3>Mi cesta</h3>

    <?php
    foreach ($_SESSION['selecciones'] as $pedido):
    ?>

    <div class="producto">
        <div class="img-producto">
            <img src="<?= $pedido->getProducto()->getImagen(); ?>" width="100" height="100">
        </div>
        <div class="detalles">
            <div class="nombre-producto"><?= $pedido->getProducto()->getNombre_producto(); ?></div>
            <div class="id-producto"><?= $pedido->getProducto()->getProducto_id(); ?></div>
            <div class="precio-producto">
                <p>Precio del articulo:<?= $pedido->getProducto()->getPrecio(); ?></p>
            </div>
        </div>
    </div>
    <?php
    endforeach;
    ?>
</body>
</html>