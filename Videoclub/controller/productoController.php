<?php
//Creamos el controlador de pedidos
require __DIR__ . '/../model/ProductoDAO.php';

class productoController{
    
    public function index(){

        $pizzas = ProductoDAO::getAllProducts('pizza');
        $bebidas = ProductoDAO::getAllProducts('bebida');
        
        require __DIR__ . '/../views/productos.php';

        
        if (isset($_POST['agregarProducto'])){
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $descripcion = $_POST['descripcion'];
            $categoria = $_POST['categoria'];

            if ($categoria === 'pizza') {
                $nuevoProducto = new Pizza(0, $nombre, $descripcion, $precio, $categoria);
                ProductoDAO::agregarProducto($nuevoProducto);
            } elseif ($categoria === 'bebida') {
                $nuevoProducto = new Bebida(0, $nombre, $descripcion, $precio, $categoria);
                ProductoDAO::agregarProducto($nuevoProducto);
            } else {
                echo "Categoría de producto desconocida";
                return;
            }
        }
            
    }

    public function compra(){
        echo 'Pagina principal compras';
    }

    public function eliminar(){
        if (isset($_POST['producto_id'])){
            $producto_id = $_POST['producto_id'];
            if (ProductoDAO::deleteProduct($producto_id)){
                echo "El producto se elimino correctamente";
            }else{
                echo "Error, no se ha podido eliminar el producto";
            }
        }
    }
}
