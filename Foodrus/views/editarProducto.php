
    <form action="index.php?action=actualizar" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $producto->getProducto_id()?>">
        <label for="disId">ID:</label><br>
        <input name="disId" disabled value="<?= $producto->getProducto_id()?>"><br>
        <label for="disAlmacen">Almacen:</label><br>
        <input name="disAlmacen" disabled value="<?= $producto->getAlmacen()?>"><br>
        <label for="nombre">Nombre:</label><br>
        <input name="nombre" value="<?= $producto->getNombre_producto()?>"><br>
        <label for="descripcion">Descripcion:</label><br>
        <input name="descripcion" value="<?= $producto->getDescripcion()?>"><br>
        <label for="precio">Precio:</label><br>
        <input name="precio" value="<?= $producto->getPrecio()?>"><br>
        <label for="categoria">Categoria:</label><br>
        <input name="categoria" value="<?= $producto->getCategoria()?>"><br><br>
        <label for="imagen">Subir imagen:</label><br>
        <input type="file" name="imagen" accept="image/*"><br><br>
        <button type="submit" name="edit">Actualizar</button>
    </form>