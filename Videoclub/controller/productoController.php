<?php
//Creamos el controlador de pedidos
include_once 'model/Producto.php';
include_once 'model/Bebida.php';
include_once 'model/Pizza.php';
include_once 'model/ProductoDAO.php';

class pedidoController{
    
    public function index(){
        
        echo ProductoDAO::getAllProducts();
    }

    public function compra(){
        echo 'Pagina principal compras';
    }
}
?>