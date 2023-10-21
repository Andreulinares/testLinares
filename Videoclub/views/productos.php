<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzas</title>
</head>
<body>
    <h1>Pizzas</h1>
    <ul>
        <?php foreach ($productos as $producto): ?>
            <li><?= $producto->nombre_producto ?></li>
            <?php endforeach; ?>
    </ul>

</body>
</html>