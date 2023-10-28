
    <form action="index.php?action=actualizar" method="post">
        <input type="hidden" name="id" value="<?= $producto->getProducto_id()?>">
        <input name="disId" disabled value="<?= $producto->getProducto_id()?>">
        <input name="nombre" value="<?= $producto->getNombre_producto()?>">
        <input name="precio" value="<?= $producto->getPrecio()?>">
        <input name="descripcion" value="<?= $producto->getDescripcion()?>">
        <button type="submit" name="edit">Actualizar</button>
    </form>