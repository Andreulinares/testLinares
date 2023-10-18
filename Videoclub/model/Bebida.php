<?php

include_once 'Producto.php';

class Bebida extends Producto{

    public function __construct($id, $name, $descripcion)
    {
        parent::__construct($id, $name, $descripcion);
    }

    public function calculaPrecioTotal($numProducto){
        $precioTotal = $numProducto*self::precioBebida;
        return $precioTotal;
    }
    public function devuelvePrecioProducto(){

    }
}

?>