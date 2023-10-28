
    <form action="index.php?action=actualizar" method="post">
        <input type="hidden" name="id" value="<?= $producto->getProducto_id()?>">
        <input name="disId" disabled value="<?= $producto->getProducto_id()?>">
        <input name="almacen" value="<?= $producto->getAlmacen()?>">
        <input name="nombre" value="<?= $producto->getNombre_producto()?>">
        <input name="precio" value="<?= $producto->getPrecio()?>">
        <input name="descripcion" value="<?= $producto->getDescripcion()?>">
        <input name="categoria" value="<?= $producto->getCategoria()?>">
        <button type="submit" name="edit">Actualizar</button>
    </form>