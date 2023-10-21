<?php

require __DIR__ . '/../config/database.php';

require 'Pizza.php';
require 'Bebida.php';

class ProductoDAO{
    public static function getAllProducts($categoria){
        $con = database::connect();
        $productos = array();

        if ($result = $con->query("SELECT * FROM productos WHERE categoria = '$categoria' ")){

            while($producto = $result->fetch_object('Pizza')){
                $productos[] = $producto;
            }
        }

        return $productos;
    }
}

?>