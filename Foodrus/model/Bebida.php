<?php

include_once 'Producto.php';

class Bebida extends Producto{

    public function __construct($producto_id, $almacen_id, $nombre_producto, $descripcion, $precio, $categoria)
    {
        parent::__construct($producto_id, $almacen_id, $nombre_producto, $descripcion, $precio, $categoria);
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