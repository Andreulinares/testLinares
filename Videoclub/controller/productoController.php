<?php
//Creamos el controlador de pedidos
include('../model/ProductoDAO.php');

class productoController{
    
    public function index(){
        
        echo ProductoDAO::getAllProducts();
    }

    public function compra(){
        echo 'Pagina principal compras';
    }
}
?>