<?php
require_once __DIR__ . '/../model/Pizza.php';
require_once __DIR__ . '/../model/Bebida.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="">
</head>
<body>
<h2>Productos FoodRus</h2>
    <table class="table table-bordered table-striped">
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Descripcion</th>
            <th>Categoria</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($pizzas as $pizza): ?>
            <tr>
                <td><?= $pizza->getNombre_producto(); ?></td>
                <td>$<?= $pizza->getPrecio(); ?></td>
                <td><?= $pizza->getDescripcion(); ?></td>
                <td><?= $pizza->getCategoria(); ?></td>
                <td>
                <form action="index.php?action=eliminar" method="post">
                    <input type="hidden" name="producto_id" value="<?= $pizza->getProducto_id(); ?>">
                    <button type="submit">Eliminar</button>
                </form>
                </td>
                <td>
                <form action="index.php?action=editar" method="post">
                    <input type="hidden" name="id" value="<?= $pizza->getProducto_id()?>">
                    <input type="hidden" name="almacen" value="<?= $pizza->getAlmacen()?>">
                    <input type="hidden" name="nombre" value="<?= $pizza->getNombre_producto()?>">
                    <input type="hidden" name="descripcion" value="<?= $pizza->getDescripcion()?>">
                    <input type="hidden" name="precio" value="<?= $pizza->getPrecio()?>">
                    <input type="hidden" name="categoria" value="<?= $pizza->getCategoria()?>">
                    <button>Modificar</button>
                </form>
                </td>
            </tr>
        <?php endforeach; ?>

        <?php foreach ($bebidas as $bebida): ?>
            <tr>
                <td><?= $bebida->getNombre_producto(); ?></td>
                <td>$<?= $bebida->getPrecio(); ?></td>
                <td><?= $bebida->getDescripcion(); ?></td>
                <td><?= $bebida->getCategoria(); ?></td>
                <td>
                <form action="index.php?action=eliminar" method="post">
                    <input type="hidden" name="producto_id" value="<?= $bebida->getProducto_id(); ?>">
                    <button type="submit">Eliminar</button>
                </form>
                </td>
                <td>
                <form action="index.php?action=editar" method="post">
                    <input type="hidden" name="id" value="<?= $bebida->getProducto_id()?>">
                    <input type="hidden" name="almacen" value="<?= $bebida->getAlmacen()?>">
                    <input type="hidden" name="nombre" value="<?= $bebida->getNombre_producto()?>">
                    <input type="hidden" name="descripcion" value="<?= $bebida->getDescripcion()?>">
                    <input type="hidden" name="precio" value="<?= $bebida->getPrecio()?>">
                    <input type="hidden" name="categoria" value="<?= $bebida->getCategoria()?>">
                    <button>Modificar</button>
                </form> 
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    
    <button id="mostrarFormulario">Añadir producto</button>

    <div id="formulario" style="display: none;">
            <form action="index.php?action=añadir" method="POST">
                <h3>Añadir producto nuevo</h3>
                <label for="id">ID:</label>
                <input type="number" name="id" required><br><br>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" required><br><br>
                <label for="precio">Precio:</label>
                <input type="number" name="precio" required><br><br>
                <label for="descripcion">Descripción:</label>
                <input type="text" name="descripcion" required><br><br>
                <label for="categoria">Categoría:</label>
                <select name="categoria" required><br><br>
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