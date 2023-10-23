<?php
//Creamos el controlador de pedidos
require __DIR__ . '/../model/ProductoDAO.php';

class productoController{
    
    public function index(){
        $categoria = 'pizza';

        $productos = ProductoDAO::getAllProducts($categoria);
        require __DIR__ . '/../views/productos.php';

    }

    public function compra(){
        echo 'Pagina principal compras';
    }
}
