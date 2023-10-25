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
            <li><?= $pizza->getNombre_producto(); ?> - Precio: $<?= $pizza->getPrecio(); ?></li>
            <?php endforeach; ?>
    </ul>

    <h2>Bebidas</h2>
    <ul>
        <?php foreach ($bebidas as $bebida): ?>
            <li><?= $bebida->getNombre_producto(); ?> - Precio: $<?= $bebida->getPrecio(); ?></li>
            <?php endforeach; ?>
    </ul>
    
    <button id="mostrarFormulario">Añadir producto</button>

    <div id="formulario" style="display: none;">
            <form action="productoController.php" method="POST">
                <h3>Añadir producto nuevo</h3>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" required>
                <label for="precio">Precio:</label>
                <input type="number" name="precio" required>
                <label for="descripcion">Descripción:</label>
                <input type="text" name="descripcion" required>
                <label for="categoria">Categoría:</label>
                <select name="categoria" required>
                    <option value="pizza">Pizza</option>
                    <option value="bebida">Bebida</option>
                </select>
                <button type="submit" name="agregarProducto">Añadir Producto</button>
            </form>
    </div>

    <script>
        document.getElementById("mostrarFormulario").addEventListener("click", function() {
            let formulario = document.getElementById("formulario");
            if (formulario.style.display === "none") {
                formulario.style.display = "block";
            } else {
                formulario.style.display = "none";
            }
        });
    </script>
</body>
</html>