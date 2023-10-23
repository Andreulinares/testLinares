<?php
require_once __DIR__ . '/../model/Pizza.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzas</title>
</head>
<body>
    <h2>Pizzas</h2>
    <ul>
        <?php foreach ($pizzas as $pizza): ?>
            <li><?= $pizza->getNombre_producto() ?></li>
            <?php endforeach; ?>
    </ul>

    <h2>Bebidas</h2>
    <ul>
        <?php foreach ($bebidas as $bebida): ?>
            <li><?= $bebida->getNombre_producto() ?></li>
            <?php endforeach; ?>
    </ul>        
</body>
</html>