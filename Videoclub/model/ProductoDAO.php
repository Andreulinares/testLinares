<?php

require __DIR__ . '/../config/database.php';

require_once 'Pizza.php';
require 'Bebida.php';

class ProductoDAO{
    public static function getAllProducts($categoria){
        $con = database::connect();
        $productos = array();

        if ($result = $con->query("SELECT * FROM productos WHERE categoria = '$categoria' ")){

            while ($row = $result->fetch_object()){
                if ($categoria === 'pizza'){
                    $producto = new Pizza($row->producto_id, $row->nombre_producto, $row->descripcion, $row->categoria, $row->precio);
                }else if($categoria === 'bebida'){
                    $producto = new Bebida($row->producto_id, $row->nombre_producto, $row->descripcion, $row->categoria, $row->precio);
                }
                $productos[] = $producto;
            }
        }

        return $productos;
    }
}

?>