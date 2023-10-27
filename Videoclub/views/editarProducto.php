<?php
require_once __DIR__ . '/../model/Pizza.php';
require_once __DIR__ . '/../model/Bebida.php';
?>

<?php foreach ($pizzas as $pizza): ?>
    <form action="index.php?action=actualizar" method="post">
        <input type="hidden" name="id" value="<?= $pizza->getProducto_id()?>">
        <input name="disId" disabled value="<?= $pizza->getProducto_id()?>">
        <input name="nombre" value="<?= $pizza->getNombre_producto()?>">
        <input name="precio" value="<?= $pizza->getPrecio()?>">
        <input name="descripcion" value="<?= $pizza->getDescripcion()?>">
        <button type="submit" name="edit">Actualizar</button>
    </form>
<?php endforeach; ?>