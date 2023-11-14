<?php 

include_once 'Producto.php';

class Postre extends Producto{

    public function __construct($producto_id, $almacen_id, $nombre_producto, $descripcion, $precio, $categoria, $imagen)
    {
        parent::__construct($producto_id, $almacen_id, $nombre_producto, $descripcion, $precio, $categoria, $imagen);
    }

    public function calculaPrecioTotal($numProducto){
        $precioTotal = $numProducto*$this->precio;
        return $precioTotal;
    }
    public function devuelvePrecioProducto(){
        return $this->precio;
    }
}

?>