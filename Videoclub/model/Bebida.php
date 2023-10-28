<?php

include_once 'Producto.php';

class Bebida extends Producto{

    public function __construct($producto_id, $nombre_producto, $descripcion, $categoria, $precio, $almacen)
    {
        parent::__construct($producto_id, $nombre_producto, $descripcion, $categoria, $precio, $almacen);
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