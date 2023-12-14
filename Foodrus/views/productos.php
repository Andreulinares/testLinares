<?php
require_once __DIR__ . '/../model/Pizza.php';
require_once __DIR__ . '/../model/Bebida.php';
require_once __DIR__ . '/../model/Postre.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
<h2>Productos FoodRus</h2>
    <table class="table table-bordered table-striped">
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Precio</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Categoria</th>
            <th scope="col">Imagen</th>
            <th scope="col"></th>
        </tr>
        <!-- Pizzas -->
        <?php foreach ($pizzas as $pizza): ?>
            <tr>
                <td><?= $pizza->getNombre_producto(); ?></td>
                <td>$<?= $pizza->getPrecio(); ?></td>
                <td><?= $pizza->getDescripcion(); ?></td>
                <td><?= $pizza->getCategoria(); ?></td>
                <td><img src="<?= $pizza->getImagen(); ?>" width="50" height="50"></td>
                <td>
                    <div class="row">
                        <div class="col">
                            <form action="index.php?controller=producto&action=eliminar" method="post">
                                <input type="hidden" name="producto_id" value="<?= $pizza->getProducto_id(); ?>">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                        <div class="col">
                            <form action="index.php?controller=producto&action=editar" method="post">
                                <input type="hidden" name="id" value="<?= $pizza->getProducto_id()?>">
                                <input type="hidden" name="almacen" value="<?= $pizza->getAlmacen()?>">
                                <input type="hidden" name="nombre" value="<?= $pizza->getNombre_producto()?>">
                                <input type="hidden" name="descripcion" value="<?= $pizza->getDescripcion()?>">
                                <input type="hidden" name="precio" value="<?= $pizza->getPrecio()?>">
                                <input type="hidden" name="categoria" value="<?= $pizza->getCategoria()?>">
                                <input type="hidden" name="imagen" value="<?= $pizza->getImagen()?>">
                                <button type="submit" class="btn btn-warning">Modificar</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
<!-- Bebidas -->
        <?php foreach ($bebidas as $bebida): ?>
            <tr>
                <td><?= $bebida->getNombre_producto(); ?></td>
                <td>$<?= $bebida->getPrecio(); ?></td>
                <td><?= $bebida->getDescripcion(); ?></td>
                <td><?= $bebida->getCategoria(); ?></td>
                <td><img src="<?= $bebida->getImagen(); ?>" width="50" height="50"></td>
                <td>
                    <div class="row">
                        <div class="col">
                            <form action="index.php?controller=producto&action=eliminar" method="post">
                                <input type="hidden" name="producto_id" value="<?= $bebida->getProducto_id(); ?>">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                        <div class="col">
                            <form action="index.php?controller=producto&action=editar" method="post">
                                <input type="hidden" name="id" value="<?= $bebida->getProducto_id()?>">
                                <input type="hidden" name="almacen" value="<?= $bebida->getAlmacen()?>">
                                <input type="hidden" name="nombre" value="<?= $bebida->getNombre_producto()?>">
                                <input type="hidden" name="descripcion" value="<?= $bebida->getDescripcion()?>">
                                <input type="hidden" name="precio" value="<?= $bebida->getPrecio()?>">
                                <input type="hidden" name="categoria" value="<?= $bebida->getCategoria()?>">
                                <input type="hidden" name="imagen" value="<?= $bebida->getImagen()?>">
                                <button type="submit" class="btn btn-warning">Modificar</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
<!-- Postres -->
        <?php foreach ($postres as $postre): ?>
            <tr>
                <td><?= $postre->getNombre_producto(); ?></td>
                <td>$<?= $postre->getPrecio(); ?></td>
                <td><?= $postre->getDescripcion(); ?></td>
                <td><?= $postre->getCategoria(); ?></td> 
                <td><img src="<?= $postre->getImagen(); ?>" width="50" height="50"></td>
                <td>
                    <div class="row">
                        <div class="col">
                            <form action="index.php?controller=producto&action=eliminar" method="post">
                                <input type="hidden" name="producto_id" value="<?= $postre->getProducto_id(); ?>">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                        <div class="col">
                            <form action="index.php?controller=producto&action=editar" method="post">
                                <input type="hidden" name="id" value="<?= $postre->getProducto_id()?>">
                                <input type="hidden" name="almacen" value="<?= $postre->getAlmacen()?>">
                                <input type="hidden" name="nombre" value="<?= $postre->getNombre_producto()?>">
                                <input type="hidden" name="descripcion" value="<?= $postre->getDescripcion()?>">
                                <input type="hidden" name="precio" value="<?= $postre->getPrecio()?>">
                                <input type="hidden" name="categoria" value="<?= $postre->getCategoria()?>">
                                <input type="hidden" name="imagen" value="<?= $postre->getImagen()?>">
                                <button type="submit" class="btn btn-warning">Modificar</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <!-- Añadir producto --> 
    <button id="mostrarFormulario" class="btn btn-primary">Añadir producto</button>

    <div id="formulario" style="display: none;">
            <form action="index.php?controller=producto&action=añadir" method="POST" enctype="multipart/form-data">
                <h3>Añadir producto nuevo</h3>
                <label for="id">ID:</label>
                <input type="number" name="id" required><br><br>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" required><br><br>
                <label for="imagen">Imagen:</label>
                <input type="file" name="imagen" accept="image/*"><br><br>
                <label for="precio">Precio:</label>
                <input type="number" name="precio" required><br><br>
                <label for="descripcion">Descripción:</label>
                <input type="text" name="descripcion" required><br><br>
                <label for="categoria">Categoría:</label>
                <select name="categoria" required><br><br>
                    <option value="pizza">Pizza</option>
                    <option value="bebida">Bebida</option>
                    <option value="postre">Postre</option>
                </select>
                <button type="submit" name="agregarProducto" class="btn btn-success">Añadir Producto</button>
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