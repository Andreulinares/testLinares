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
            $almacen = $_POST['almacen'];
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $descripcion = $_POST['descripcion'];
            $categoria = $_POST['categoria'];

            if ($categoria === 'pizza') {
                $nuevoProducto = new Pizza(0, $nombre, $almacen, $descripcion, $precio, $categoria);
                ProductoDAO::agregarProducto($nuevoProducto);
            } elseif ($categoria === 'bebida') {
                $nuevoProducto = new Bebida(0, $nombre, $almacen, $descripcion, $precio, $categoria);
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
            // Recoge los datos del formulario
            $id = $_POST['id'];
            $almacen = $_POST['almacen'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $categoria = $_POST['categoria'];
            $precio = $_POST['precio'];
    
            // Puedes realizar validaciones aquí si es necesario
    
            // Actualiza el producto en la base de datos
            $result = ProductoDAO::updateProduct($id, $almacen, $nombre, $descripcion, $categoria, $precio);
    
            if ($result) {
                // Redirige a la página de éxito o a la lista de productos
                header("Location: index.php?action=index");
                exit;
            } else {
                // Maneja el caso en que la actualización falle
                echo "Error al actualizar el producto.";
            }
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
