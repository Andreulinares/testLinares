<?php
//Creamos el controlador de pedidos
require_once __DIR__ . '/../model/ProductoDAO.php';
require __DIR__ . '/../model/Pedido.php';
require_once __DIR__ . '/../model/PedidoBD.php';

class productoController{

    public function index(){
        //require header
        //vista home
        //require footer
    }
    
    public function listaProductos(){

        $pizzas = ProductoDAO::getAllProducts('pizza');
        $bebidas = ProductoDAO::getAllProducts('bebida');
        $postres = ProductoDAO::getAllProducts('postre');
        
        require __DIR__ . '/../views/productos.php';
            
    }

    public function añadir(){
        if (isset($_POST['agregarProducto'])){
            $producto_id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $descripcion = $_POST['descripcion'];
            $categoria = $_POST['categoria'];
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $directorioDestino = 'uploads';
                $imagen = $directorioDestino . '/' . $_FILES['imagen']['name'];
                //Seleccionamos la imagen del directorio y la movemos en la ruta correspondiente para cargar la img
                if(move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen)){
                
                    if ($categoria === 'pizza') {
                        $nuevoProducto = new Pizza($producto_id, 0, $nombre, $descripcion, $precio, $categoria, $imagen);
                        ProductoDAO::agregarProducto($nuevoProducto);
                    } elseif ($categoria === 'bebida') {
                        $nuevoProducto = new Bebida($producto_id, 0, $nombre, $descripcion, $precio, $categoria, $imagen);
                        ProductoDAO::agregarProducto($nuevoProducto);
                    } elseif ($categoria === 'postre') {
                        $nuevoProducto = new Postre($producto_id, 0, $nombre, $descripcion, $precio, $categoria, $imagen);
                        ProductoDAO::agregarProducto($nuevoProducto);
                    } else {
                        echo "Categoría de producto desconocida";
                        return;
                    }//Dependiendo de la categoria del producto, añadimos un producto del tipo correspondiente
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
        } elseif ($categoria === 'postre') {
            $producto = ProductoDAO::getPostreById($_POST['id']);
        }

        require __DIR__ . '/../views/editarProducto.php';
    }

    public function sel() {
        session_start();
    
        if (isset($_POST['id']) && isset($_POST['categoria'])) {
            $id = $_POST['id'];
            $categoria = $_POST['categoria'];
    
            if ($categoria == 'pizza') {
                $producto = ProductoDAO::getPizzaById($id);
            } elseif ($categoria == 'bebida') {
                $producto = ProductoDAO::getBebidaById($id);
            } else {
                $producto = ProductoDAO::getPostreById($id);
            }
    
            if (!isset($_SESSION['selecciones'])) {
                $_SESSION['selecciones'] = array();
            }
    
            // Buscar si el producto ya está en el carrito
            $productoEnCarrito = null;
            foreach ($_SESSION['selecciones'] as $pedido) {
                if ($pedido->getProducto()->getProducto_id() == $id) {
                    $productoEnCarrito = $pedido;
                    break;
                }
            }
    
            if ($productoEnCarrito) {
                // Si el producto ya está en el carrito, se incrementa la cantidad
                $productoEnCarrito->setCantidad($productoEnCarrito->getCantidad() + 1);
            } else {
                // En caso contrario, se añadadira como un nuevo producto
                $pedido = new Pedido($producto);
                $_SESSION['selecciones'][] = $pedido;
            }
        }
    
        header("Location: ../Foodrus/views/carta.php");
    }
    

    public function compra(){
        session_start();
        if (isset($_POST['Add'])) {
            $pos = $_POST['Add'];
            $pedido = $_SESSION['selecciones'][$pos];
            
            
            $pedido->setCantidad($pedido->getCantidad() + 1);
        } elseif (isset($_POST['Del'])) {
            $pos = $_POST['Del'];
            $pedido = $_SESSION['selecciones'][$pos];

            if ($pedido->getCantidad() > 1) {
                $pedido->setCantidad($pedido->getCantidad() - 1);
                
            } else {
                unset($_SESSION['selecciones'][$pos]);
                $_SESSION['selecciones'] = array_values($_SESSION['selecciones']);

                if (empty($_SESSION['selecciones'])) {
                    // Redireccionar a la página de inicio si no quedan productos en el carrito
                    header("Location: ../Foodrus/views/Inicio.php");
                    exit();
                }
            }
        }

        header("Location: ../Foodrus/views/panelCompra.php");
    }

    public function eliminaCarrito(){
        session_start();
        if (isset($_POST['eliminar'])){
            $pos = $_POST['eliminar'];
            
            unset($_SESSION['selecciones'][$pos]);

            header("Location: ../Foodrus/views/panelCompra.php");

            if (empty($_SESSION['selecciones'])) {
                // Redireccionar a la página de inicio si no quedan productos en el carrito
                header("Location: ../Foodrus/views/Inicio.php");
                exit();
            }
        }
    }

    public function finalizarCompra(){
        session_start();
        if (!isset($_SESSION['user_email'])){
            header("Location: ../Foodrus/views/login.php");
            exit();
        }else{
            //Guardar cookie
            setcookie('UltimoPedido', $_POST['cantidadTotal'], time() + 3600);
            setcookie('UltimosProductos', serialize($_SESSION['selecciones']), time() + 3600);

            //Te almacena el pedido en la base de datos ProductoDAO que guarda el pedido en BBDD
            $pedido_id = $_SESSION['carrito_id'];
            $cantidad = $_POST['cantidadTotal'];
            $estado = 'pendiente';
            $fecha = date('Y-m-d H:i:s');
            $usuario = ProductoDAO::obtenerUsuario($_SESSION['user_email']);
            $cliente_id = $usuario->getCliente_id();
            //Si la id del carrito ya existe en la base de datos 
            //actualizamos pedido con los nuevos datos
            if (ProductoDAO::carritoExiste($pedido_id)){
                ProductoDAO::limpiarDetallesPedido($pedido_id);

                ProductoDAO::actualizarPedido($pedido_id, $cantidad, $estado, $fecha);

                foreach ($_SESSION['selecciones'] as $pedido){
                    $id_producto = $pedido->getProducto()->getProducto_id();
                    $cantidad = $pedido->getCantidad();
    
                    ProductoDAO::associarProductoPedido($pedido_id, $id_producto, $cantidad);
                }
                
                $_SESSION['mostrarModalQR'] = true;
                header("Location: ../Foodrus/views/panelCompra.php");
            } else {//En caso contrario, insertamos pedido en la BD
                $pedido = new PedidoBD($pedido_id, $cliente_id, $cantidad, $estado, $fecha);
                ProductoDAO::insertarPedido($pedido);

                foreach ($_SESSION['selecciones'] as $pedido){
                    $id_producto = $pedido->getProducto()->getProducto_id();
                    $cantidad = $pedido->getCantidad();
    
                    ProductoDAO::associarProductoPedido($pedido_id, $id_producto, $cantidad);
                }

                $_SESSION['mostrarModalQR'] = true;
                header("Location: ../Foodrus/views/panelCompra.php"); 
            }

            $puntosObtenidos = floor($_POST['cantidadTotal'] * 100);
            ProductoDAO::insertarPuntosUsuario($cliente_id, $puntosObtenidos); 
        }
    }

    public function recuperarPedido(){
        session_start();

        if(isset($_POST['recuperar_pedido'])){
            if(isset($_COOKIE['UltimosProductos'])){
                $productosRecuperados = unserialize($_COOKIE['UltimosProductos']);
                $_SESSION['selecciones'] = $productosRecuperados;

                header("Location: ../Foodrus/views/panelCompra.php");
            }
        }
    }

}
