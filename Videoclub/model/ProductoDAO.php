<?php

include_once 'config/db.php';

class ProductoDAO{
    public static function getAllProducts(){
        $con = DataBase::connect();
        if ($result = $con->query("SELECT * FROM productos")){

            while($producto = $result->fetch_array()){
                echo $producto['name'];
                echo '<br>';
            }
        }
    }
}

?>