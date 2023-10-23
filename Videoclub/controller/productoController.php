<?php
//Creamos el controlador de pedidos
require __DIR__ . '/../model/ProductoDAO.php';

class productoController{
    
    public function index(){

        $pizzas = array();
        $bebidas = array();

        $categoria = '';

        if($categoria = 'pizza'){
            $pizzas = ProductoDAO::getAllProducts($categoria);
        }else if($categoria = 'bebida'){
            $bebidas = ProductoDAO::getAllProducts($categoria);
        }
        require __DIR__ . '/../views/productos.php';
    }

    public function compra(){
        echo 'Pagina principal compras';
    }
}
