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
    $pos = 0;
    foreach ($_SESSION['selecciones'] as $pedido):
    //var_dump($_SESSION['selecciones']);
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

        <form action="../index.php?action=compra" method='post'>
            <button class="bet-button w3-black w3-section" type="submit" name="Add" value=<?=$pos?>> + </button>
            <button class="del-button w3-black w3-section" type="submit" name="Del" value=<?=$pos?>> - </button>
        </form>
    </div>
    <?php
    endforeach;
    ?>
</body>
</html>