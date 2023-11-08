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
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $directorioDestino = __DIR__ . '/../uploads/'; 
                $imagen = $directorioDestino . uniqid() . '_' . $_FILES['imagen']['name'];
                
                if(move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen)){
                
                    if ($categoria === 'pizza') {
                        $nuevoProducto = new Pizza($producto_id, 0, $nombre, $descripcion, $precio, $categoria, $imagen);
                        ProductoDAO::agregarProducto($nuevoProducto);
                    } elseif ($categoria === 'bebida') {
                        $nuevoProducto = new Bebida($producto_id, 0, $nombre, $descripcion, $precio, $categoria, $imagen);
                        ProductoDAO::agregarProducto($nuevoProducto);
                    } else {
                        echo "Categoría de producto desconocida";
                        return;
                    }
                } else {
                    echo "Error al mover la imagen";
                    return;
                }
            } else {
                echo "No se subio una imagen valida";
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
            $imagen = $_FILES['imagen'];
    
    
            
            $result = ProductoDAO::updateProduct($id, $nombre, $descripcion, $categoria, $precio, $imagen);
                
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
