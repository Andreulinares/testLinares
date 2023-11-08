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

    public function añadir(){
        if (isset($_POST['agregarProducto'])){
            $producto_id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $descripcion = $_POST['descripcion'];
            $categoria = $_POST['categoria'];

            if ($categoria === 'pizza') {
                $nuevoProducto = new Pizza($producto_id, 0, $nombre, $descripcion, $precio, $categoria);
                ProductoDAO::agregarProducto($nuevoProducto);
            } elseif ($categoria === 'bebida') {
                $nuevoProducto = new Bebida($producto_id, 0, $nombre, $descripcion, $precio, $categoria);
                ProductoDAO::agregarProducto($nuevoProducto);
            } else {
                echo "Categoría de producto desconocida";
                return;
            }
        }
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

    public function actualizar(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $categoria = $_POST['categoria'];
            $precio = $_POST['precio'];
    
    
            
            $result = ProductoDAO::updateProduct($id, $nombre, $descripcion, $categoria, $precio);
                
            header("Location: index.php?action=index");
        }
    }

    public function editar(){
        
        $categoria = $_POST['categoria'];

        if ($categoria === 'pizza') {
            $producto = ProductoDAO::getPizzaById($_POST['id']);
        } elseif ($categoria === 'bebida') {
            $producto = ProductoDAO::getBebidaById($_POST['id']);
        }

        require __DIR__ . '/../views/editarProducto.php';
    }
}