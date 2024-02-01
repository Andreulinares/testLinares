<?php

require_once __DIR__ . '/../config/database.php';

require_once 'Pizza.php';
require_once 'Bebida.php';
require_once 'Postre.php';
require_once 'Usuario.php';

class ProductoDAO{
    public static function getAllProducts($categoria){
        $con = database::connect();
        $productos = array();

        if ($result = $con->query("SELECT * FROM productos WHERE categoria = '$categoria' ")){

            while ($row = $result->fetch_object()){
                if ($categoria === 'pizza'){
                    $producto = new Pizza($row->producto_id, $row->almacen_id, $row->nombre_producto, $row->descripcion, $row->precio, $row->categoria, $row->imagen);
                }else if($categoria === 'bebida'){
                    $producto = new Bebida($row->producto_id, $row->almacen_id, $row->nombre_producto, $row->descripcion, $row->precio, $row->categoria, $row->imagen);
                }else if($categoria === 'postre'){
                    $producto = new Postre($row->producto_id, $row->almacen_id, $row->nombre_producto, $row->descripcion, $row->precio, $row->categoria, $row->imagen);
                }
                $productos[] = $producto;
            }
        }

        return $productos;
    }
// OPERACIONES CON PRODUCTOS DE LA BASE DE DATOS
    public static function agregarProducto($producto){
        $con = database::connect();

        $producto_id = $producto->getProducto_id();
        $nombre_producto = $producto->getNombre_producto();
        $descripcion = $producto->getDescripcion();
        $categoria = $producto->getCategoria();
        $precio = $producto->getPrecio();
        $imagen = $producto->getImagen();

        $stmt = $con->prepare("INSERT INTO productos (producto_id, nombre_producto, descripcion, precio, categoria, imagen) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issdss", $producto_id, $nombre_producto, $descripcion, $precio, $categoria, $imagen);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
        
        $con->close();
    }

    public static function deleteProduct($id){
        $con = database::connect();

        $stmt = $con->prepare("DELETE FROM productos WHERE producto_id = ?");
        $stmt->bind_param("i", $id); 

        if ($stmt->execute()){
            $stmt->close();
            return true;
        }else{
            $stmt->close();
            return false;
        }
    }   

    public static function updateProduct($id, $nombre, $descripcion, $categoria, $precio, $imagen){
        $con = database::connect();
    
        if ($imagen['size'] > 0) {
            $directorioDestino = __DIR__ . 'uploads/';
            $imagenPath = $directorioDestino . uniqid() . '_' . $imagen['name'];
    
            if (!move_uploaded_file($imagen['tmp_name'], $imagenPath)) {
                return false;       
            }
            $stmt = $con->prepare("UPDATE productos SET nombre_producto = ?, descripcion = ?, precio = ?, categoria = ?, imagen = ? WHERE producto_id = ?");
            $stmt->bind_param("ssdssi", $nombre, $descripcion, $precio, $categoria, $imagenPath, $id);
        } else {
            $stmt = $con->prepare("UPDATE productos SET nombre_producto = ?, descripcion = ?, precio = ?, categoria = ? WHERE producto_id = ?");
            $stmt->bind_param("ssdsi", $nombre, $descripcion, $precio, $categoria, $id);
        }
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        
        $con->close();
    }
    

    public static function getProductsByIds($categoria, $ids) {
        $con = database::connect();
        $productos = array();
    
        $ids = implode(',', $ids);
    
        if ($result = $con->query("SELECT * FROM productos WHERE categoria = '$categoria' AND producto_id IN ($ids)")) {
    
            while ($row = $result->fetch_object()) {
                if ($categoria === 'pizza') {
                    $producto = new Pizza($row->producto_id, $row->almacen_id, $row->nombre_producto, $row->descripcion, $row->precio, $row->categoria, $row->imagen);
                } else if ($categoria === 'bebida') {
                    $producto = new Bebida($row->producto_id, $row->almacen_id, $row->nombre_producto, $row->descripcion, $row->precio, $row->categoria, $row->imagen);
                } else if ($categoria === 'postre') {
                    $producto = new Postre($row->producto_id, $row->almacen_id, $row->nombre_producto, $row->descripcion, $row->precio, $row->categoria, $row->imagen);
                }
                $productos[] = $producto;
            }
        }
    
        return $productos;
    }  

    public static function getPizzaById($id){
        $con = database::connect();
    
        $stmt = $con->prepare("SELECT * FROM productos WHERE producto_id = ? AND categoria = 'pizza'");
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute()){
            $result = $stmt->get_result();
            $con->close();
    
            if ($result->num_rows == 1) {
                $row = $result->fetch_object();
                return new Pizza($row->producto_id, $row->almacen_id, $row->nombre_producto, $row->descripcion, $row->precio, $row->categoria, $row->imagen);
            } else {
                
                return null;
            }
        }
    }
    
    public static function getBebidaById($id){
        $con = database::connect();
    
        $stmt = $con->prepare("SELECT * FROM productos WHERE producto_id = ? AND categoria = 'bebida'");
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute()){
            $result = $stmt->get_result();
            $con->close();
    
            if ($result->num_rows == 1) {
                $row = $result->fetch_object();
                return new Bebida($row->producto_id, $row->almacen_id, $row->nombre_producto, $row->descripcion, $row->precio, $row->categoria, $row->imagen);
            } else {
                
                return null;
            }
        }
    }

    public static function getPostreById($id){
        $con = database::connect();
    
        $stmt = $con->prepare("SELECT * FROM productos WHERE producto_id = ? AND categoria = 'postre'");
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute()){
            $result = $stmt->get_result();
            $con->close();
    
            if ($result->num_rows == 1) {
                $row = $result->fetch_object();
                return new Postre($row->producto_id, $row->almacen_id, $row->nombre_producto, $row->descripcion, $row->precio, $row->categoria, $row->imagen);
            } else {
                
                return null;
            }
        }
    }

    
    public static function obtenerProductosAleatorios($productos, $cantidad = 4) {
        $productosAleatorios = isset($_SESSION['productosAleatorios']) ? $_SESSION['productosAleatorios'] : null;
    
        if (!$productosAleatorios || count($productosAleatorios) !== $cantidad) {
            $productosAleatorios = array_rand($productos, $cantidad);
            
            $_SESSION['productosAleatorios'] = $productosAleatorios;
        }
    
        return array_map(function($indice) use ($productos) {
            return $productos[$indice];
        }, (array)$productosAleatorios);
    }
    
    //USUARIOS BASE DE DATOS

    public static function agregarUsuario($usuario){
        $con = database::connect();

        $cliente_id = $usuario->getCliente_id();
        $nombre = $usuario->getNombre();
        $apellidos = $usuario->getApellidos();
        $telefono = $usuario->getTelefono();
        $email = $usuario->getEmail();
        $passwd = $usuario->getPassword();
        $rol = $usuario ->getRol();

        $stmt = $con->prepare("INSERT INTO clientes (cliente_id, email, nombre, apellido, contraseña, telefono, rol) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssis", $cliente_id, $email, $nombre, $apellidos, $passwd, $telefono, $rol);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            echo "Error al registrar usuario" . $stmt->error;
            return false;
        }
        
        $con->close();
    }

    public static function obtenerUsuario($email){
        $con = database::connect();

        $stmt = $con->prepare("SELECT * FROM CLIENTES WHERE email = ?");
        $stmt->bind_param("s", $email);
    
        if ($stmt->execute()){
            $result = $stmt->get_result();
            $con->close();
    
            if ($result->num_rows == 1) {
                $row = $result->fetch_object();
                return new Usuario($row->cliente_id, $row->email, $row->nombre, $row->apellido, $row->contraseña, $row->telefono, $row->rol);
            } else {
                
                return null;
            }
        }
    }

    public static function obtenerRolUsuario($email){
        $con = database::connect();

        $stmt = $con->prepare("SELECT rol FROM CLIENTES WHERE email = ?");
        $stmt->bind_param("s", $email);

        $stmt->execute();
    
        $stmt->bind_result($rol);
    
        $stmt->fetch();

        $stmt->close();

        return $rol ? $rol : false;
    }

    public static function verificarCredenciales($email, $password) {
        // Obtener el usuario basado en la dirección de correo electrónico
        $usuario = self::obtenerUsuario($email);

        // Verificar si el usuario existe y la contraseña es correcta
        if ($usuario && $password === $usuario->getPassword()) {
            return true;
        }

        return false;
    }
// OPERACIONES CON PEDIDOS DE LA BASE DE DATOS
    public static function insertarPedido($pedido){
        $con = database::connect();

        $pedido_id = $pedido->getPedido_id();
        $id_cliente = $pedido->getId_cliente();
        $cantidad = $pedido->getCantidad();
        $estado = $pedido->getEstado();
        $fecha_pedido = $pedido->getFecha_pedido();

        $stmt = $con->prepare("INSERT INTO pedidos (pedido_id, id_cliente, cantidad, estado, fecha_pedido) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sidss", $pedido_id, $id_cliente, $cantidad, $estado, $fecha_pedido);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            echo "Error al insertar pedido" . $stmt->error;
            return false;
        }
        
        $con->close();
    }

    public static function obtenerPedidosUsuario($cliente_id){
        $con = database::connect();

        $stmt = $con->prepare("SELECT * FROM PEDIDOS WHERE id_cliente = ?");
        $stmt->bind_param("i", $cliente_id);

        if ($stmt->execute()){
            $result = $stmt->get_result();
            $con->close();
    
            $pedidos = array();
    
            while ($row = $result->fetch_object()) {
                $pedidos[] = new PedidoBD($row->pedido_id, $row->id_cliente, $row->cantidad, $row->estado, $row->fecha_pedido);
            }
    
            return $pedidos;
        }
        return null;
    }

    public static function obtenerTodosPedidos(){
        $con = database::connect();

        $stmt = $con->prepare("SELECT * FROM PEDIDOS");
        
        if ($stmt->execute()){
            $result = $stmt->get_result();
            $con->close();

            $pedidos = array();

            while ($row = $result->fetch_object()) {
                $pedidos[] = new PedidoBD($row->pedido_id, $row->id_cliente, $row->cantidad, $row->estado, $row->fecha_pedido);
            }

            return $pedidos;
        }
        return null;
    }
//Funcion para actualizar datos del usuario
    public static function actualizarUsuario($id, $nombre, $apellidos, $telefono, $email, $contraseña){
        $con = database::connect();

        $stmt = $con->prepare("UPDATE clientes SET email = ?, nombre = ?, apellido = ?, contraseña = ?, telefono = ? WHERE cliente_id = ?");
        $stmt->bind_param("ssssdi", $email, $nombre, $apellidos, $contraseña, $telefono, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        
        $con->close();
    }
// Eliminar pedido de la base de datos
    public static function deletePedido($id){
        $con = database::connect();

        $stmt = $con->prepare("DELETE FROM pedidos WHERE pedido_id = ?");
        $stmt->bind_param("s", $id); 

        if ($stmt->execute()){
            $stmt->close();
            return true;
        }else{
            $stmt->close();
            return false;
        }
    }
/**
 * funcion para associar productos a un pedido en concreto segun la id del pedido
 * recuperamos los valores de id de pedido, id de producto y cantidad y los insertamos
 */
    public static function associarProductoPedido($id_pedido, $id_producto, $cantidad){
        $con = database::connect();

        $stmt = $con->prepare("INSERT INTO productos_pedido (id_pedido, id_producto, cantidad) VALUES (?, ?, ?)");
        $stmt->bind_param("sii", $id_pedido, $id_producto, $cantidad);

        if ($stmt->execute()){
            $stmt->close();
            return true;
        }else{
            $stmt->close();
            return false;
        }
    }
/**
 * obtenemos los detalles correspondientes de los productos del pedido
 * seleccionamos el nombre de los productos y su cantidad
 */
    public static function obtenerDetallesProductos($id_pedido) {
        $con = database::connect();
    
        $stmt = $con->prepare("SELECT p.nombre_producto, pp.cantidad
                                FROM productos_pedido pp
                                JOIN productos p ON pp.id_producto = p.producto_id
                                WHERE pp.id_pedido = ?");
        $stmt->bind_param("s", $id_pedido);
        $stmt->execute();
        $stmt->bind_result($nombre_producto, $cantidad);
    
        $detallesProductos = array();
    
        while ($stmt->fetch()) {
            $detallesProductos[] = array(
                'nombre_producto' => $nombre_producto,
                'cantidad' => $cantidad
            );
        }
    
        $stmt->close();
        return $detallesProductos;
    }
    
    //ACTUALIZAR PEDIDO BASE DE  DATOS Y COMPROBAR SI PEDIDO_ID EXISTE 

    public static function carritoExiste($carritoId) {
        $con = database::connect();

        $stmt = $con->prepare("SELECT COUNT(*) FROM pedidos WHERE pedido_id = ?");
        $stmt->bind_param("s", $carritoId);
        $stmt->execute();
        $stmt->bind_result($count);

        $stmt->fetch();

        $stmt->close();

        return $count > 0;
    }

    public static function actualizarPedido($pedido_id, $cantidad, $estado, $fecha) {
        $con = database::connect();

        $stmt = $con->prepare("UPDATE pedidos SET cantidad = ?, estado = ?, fecha_pedido = ? WHERE pedido_id = ?");
        $stmt->bind_param("dsss", $cantidad, $estado, $fecha, $pedido_id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        
        $con->close();
    }
//VACIAR DETALLES AL ACTUALIZAR PEDIDO 
    public static function limpiarDetallesPedido($id_pedido) {
        $con = database::connect();
    
        $stmt = $con->prepare("DELETE FROM productos_pedido WHERE id_pedido = ?");
        $stmt->bind_param("s", $id_pedido);
        $stmt->execute();
    
        $stmt->close();
    }

    public static function actualizarEstadoPedido($pedido_id, $estado){
        $con = database::connect();

        $stmt = $con->prepare("UPDATE pedidos SET estado = ? WHERE pedido_id = ?");
        $stmt->bind_param("ss", $estado, $pedido_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        
        $con->close();
    }

    //Obtener todas las reseñas y insertarlas a la tabla reseñas de la BD

    public static function obtenerReseñas(){
        $con = database::connect();
    
        $stmt = $con->prepare("SELECT puntuacion, comentario, nombre_usuario FROM reseñas");
        $stmt->execute();
    
        $result = $stmt->get_result();
    
        $reseñas = array();
    
        while ($row = $result->fetch_assoc()) {
            $reseñas[] = $row;
        }
    
        $stmt->close();
        $con->close();
    
        return $reseñas;
    }
    

    public static function insertarReseñas($reseña){
        $con = database::connect();

        $id_cliente = $reseña->getId_cliente();
        $puntuacion = $reseña->getPuntuacion();
        $comentario = $reseña->getComentario();
        $fecha_creacion = $reseña->getFecha_creacion();
        $nombre_usuario = $reseña->getNombre_usuario();


        $stmt = $con->prepare("INSERT INTO reseñas (id_cliente, puntuacion, comentario, fecha_creacion, nombre_usuario) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisss", $id_cliente, $puntuacion, $comentario, $fecha_creacion, $nombre_usuario);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        
        $con->close();
    }

    //Funciones puntos de usuario 
    
    public static function obtenerPuntos($cliente_id){
        $con = database::connect();

        $stmt = $con->prepare("SELECT puntos FROM puntos WHERE id_cliente = ?");
        $stmt->bind_param("i", $cliente_id);

        if ($stmt->execute()) {
            $stmt->bind_result($puntos);
    
            $stmt->fetch();

            $con->close();
    
            return $puntos;
        } else {
            return false;
        }
    }

    public static function insertarPuntosUsuario($cliente_id, $puntosObtenidos){
        $con = database::connect();

        // Obtener puntos actuales
        $puntosActuales = self::obtenerPuntos($cliente_id);

        if ($puntosActuales !== false) {
            // Si el cliente ya tiene una fila con puntos, actualizamos
            $nuevosPuntos = $puntosActuales + $puntosObtenidos;
            $stmt = $con->prepare("UPDATE puntos SET puntos = ? WHERE id_cliente = ?");
            $stmt->bind_param("ii", $nuevosPuntos, $cliente_id);
            $stmt->execute();
        } else {
            // Si el cliente no tiene ningun punto todavia, insertamos nueva fila
            $stmt = $con->prepare("INSERT INTO puntos (id_cliente, puntos) VALUES (?, ?)");
            $stmt->bind_param("ii", $cliente_id, $puntosObtenidos);
            $stmt->execute();
        }

        $con->close();
    }

    public static function actualizarPuntos($cliente_id, $puntos){
        $con = database::connect();

        $stmt = $con->prepare("UPDATE puntos SET puntos = ? WHERE id_cliente = ?");
        $stmt->bind_param("ii", $puntos, $cliente_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        
        $con->close();
    }
}

?>