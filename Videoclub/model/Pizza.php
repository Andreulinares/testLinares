<?php

include_once 'Producto.php';

class Pizza extends Producto{

    public function __construct($producto_id, $nombre_producto, $descripcion, $categoria)
    {
        parent::__construct($producto_id, $nombre_producto, $descripcion, $categoria);
    }

    public function calculaPrecioTotal($numProducto){
        $precioTotal = $numProducto*self::precioPizza;
        return $precioTotal;
    }
    public function devuelvePrecioProducto(){

    }
}

?>