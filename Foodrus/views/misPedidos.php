<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis pedidos</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <h2>Mis pedidos</h2>

    <table class="table table-bordered table-striped">
        <tr>
            <th scope="col">Num Pedido</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Estado</th>
            <th scope="col">Fecha pedido</th>
        </tr>
        <?php foreach ($pedidos as $pedido) : ?>
            <tr>
                <td><?= $pedido->getPedido_id(); ?></td>
                <td>€<?= $pedido->getCantidad(); ?></td>
                <td><?= $pedido->getEstado(); ?></td>
                <td><?= $pedido->getFecha_pedido(); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>