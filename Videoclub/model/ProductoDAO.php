<?php

include('../Videoclub/config/database.php');

include('../Videoclub/model/Producto.php');

class ProductoDAO{
    public static function getAllProducts(){
        $con = DataBase::connect();
        if ($result = $con->query("SELECT * FROM productos WHERE categoria = 'pizza' ")){

            while($producto = $result->fetch_array()){
                echo $producto['nombre_producto'];
                echo '<br>';
            }
        }
    }
}

?>