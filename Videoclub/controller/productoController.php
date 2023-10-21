<?php
//Creamos el controlador de pedidos
require __DIR__ . '/../model/ProductoDAO.php';

class productoController{
    
    public function index(){
        $categoria = 'pizza';
        $productos = ProductoDAO::getAllProducts($categoria);

        echo "<h1>Pizzas</h1>";
        echo "<ul>";
        foreach ($productos as $producto){
            echo "<li>" . $producto->nombre_producto . "</li>";
        }
        echo "</ul>";
    }

    public function compra(){
        echo 'Pagina principal compras';
    }
}
