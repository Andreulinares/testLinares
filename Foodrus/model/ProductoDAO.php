<?php

require __DIR__ . '/../config/database.php';

require_once 'Pizza.php';
require 'Bebida.php';
require 'Postre.php';
require 'Usuario.php';

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

        $stmt = $con->prepare("INSERT INTO clientes (cliente_id, email, nombre, apellido, contraseña, telefono) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssi", $cliente_id, $email, $nombre, $apellidos, $passwd, $telefono);

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
                return new Usuario($row->cliente_id, $row->email, $row->nombre, $row->apellido, $row->contraseña, $row->telefono);
            } else {
                
                return null;
            }
        }
    }

    public static function verificarCredenciales($email, $password) {
        // Obtener el usuario basado en la dirección de correo electrónico
        $usuario = self::obtenerUsuario($email);

        // Verificar si el usuario existe y la contraseña es correcta
        if ($usuario && password_verify($password, $usuario->getPassword())) {
            return true;
        }

        return false;
    }
    
}

?>