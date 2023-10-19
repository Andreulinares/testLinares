<?php

include_once 'Producto.php';

class Bebida extends Producto{

    public function __construct($producto_id, $nombre_producto, $descripcion, $categoria)
    {
        parent::__construct($producto_id, $nombre_producto, $descripcion, $categoria);
    }

    public function calculaPrecioTotal($numProducto){
        $precioTotal = $numProducto*self::precioBebida;
        return $precioTotal;
    }
    public function devuelvePrecioProducto(){

    }
}

?>