<?php

include_once '../config/database.php';

include_once 'Producto.php';

class ProductoDAO{
    public static function getAllProducts($categoria){
        $con = database::connect();
        $productos = array();

        if ($result = $con->query("SELECT * FROM productos WHERE categoria = '$categoria' ")){

            while($producto = $result->fetch_object('Producto')){
                $productos[] = $producto;
            }
        }

        return $productos;
    }
}

?>