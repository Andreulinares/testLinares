<?php

include_once 'Producto.php';

class Pizza extends Producto{

    public function __construct($almacen, $producto_id, $nombre_producto, $descripcion, $categoria, $precio)
    {
        parent::__construct($almacen, $producto_id, $nombre_producto, $descripcion, $categoria, $precio);
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