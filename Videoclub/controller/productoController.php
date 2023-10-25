<?php
//Creamos el controlador de pedidos
require __DIR__ . '/../model/ProductoDAO.php';

class productoController{
    
    public function index(){

        $pizzas = ProductoDAO::getAllProducts('pizza');
        $bebidas = ProductoDAO::getAllProducts('bebida');
        
        require __DIR__ . '/../views/productos.php';

        
    }

    public function compra(){
        echo 'Pagina principal compras';
    }
}
