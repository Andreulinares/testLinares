<?php

require __DIR__ . '/../config/database.php';

require_once 'Pizza.php';
require 'Bebida.php';

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

        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK){
            $nombre_imagen = $_FILES['imagen']['name'];
            $ruta_temporal = $_FILES['imagen']['tmp_name'];

            $directorioDestino = '../uploads/';

            $nombreUnico = uniqid() . '_' . $nombre_imagen;
            $rutaDestino = $directorioDestino . $nombreUnico;

            move_uploaded_file($ruta_temporal, $rutaDestino);
        }else{
            echo "Porfavor, seleccione una imagen para subir.";
            return false; 
        }    

        $stmt = $con->prepare("INSERT INTO productos (producto_id, nombre_producto, descripcion, precio, categoria, imagen) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issdss", $producto_id, $nombre_producto, $descripcion, $precio, $categoria, $nombreUnico);

        if ($stmt->execute()){
            return true;
        }else{
            unlink($rutaDestino);
            echo "Error al insertar en la base de datos";
            return false;
        }

        $stmt->close();
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
            $directorioDestino = __DIR__ . '/../uploads/';
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
    

    public static function getProductById($id){
        $con = database::connect();

        $stmt = $con->prepare("SELECT categoria FROM productos WHERE producto_id=?");
        $stmt->bind_param("i", $id);

        $stmt->execute();
        $categoria=$stmt->get_result()->fetch_object()->categoria;

        $stmt = $con->prepare("SELECT * FROM productos WHERE producto_id=?");
        $stmt->bind_param("i", $id);

        $stmt->execute();
        $result=$stmt->get_result();

        $con->close();

        if ($categoria === 'pizza') {
            $producto = $result->fetch_object('Pizza', [6, '', '', '', '', '', '']);
        } elseif ($categoria === 'bebida') {
            $producto = $result->fetch_object('Bebida', [6, '', '', '', '', '', '']);
        }

        return $producto;
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
    
}

?>