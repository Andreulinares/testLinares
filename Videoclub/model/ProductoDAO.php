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
                    $producto = new Pizza($row->producto_id, $row->nombre_producto, $row->descripcion, $row->categoria, $row->precio, $row->almacen_id);
                }else if($categoria === 'bebida'){
                    $producto = new Bebida($row->producto_id, $row->nombre_producto, $row->descripcion, $row->categoria, $row->precio, $row->almacen_id);
                }
                $productos[] = $producto;
            }
        }

        return $productos;
    }

    public static function agregarProducto($producto){
        $con = database::connect();

        $stmt = $con->prepare("INSERT INTO productos (almacen_id, nombre_producto, descripcion, categoria, precio) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdsd", $producto->getAlmacen(), $producto->getNombre_producto(), $producto->getDescripcion(), $producto->getCategoria(), $producto->getPrecio());

        if ($stmt->execute()){
            return true;
        }else{
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

    public static function updateProduct($id, $almacen, $nombre, $descripcion, $categoria, $precio){
        $con = database::connect();

        $stmt = $con->prepare("UPDATE productos SET almacen_id = ?, nombre_producto = ?, descripcion = ?, precio = ?, categoria = ? WHERE producto_id = ?");
        $stmt->bind_param("issdsi", $almacen, $nombre, $descripcion, $precio, $categoria, $id);

        $stmt->execute();
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
                return new Pizza($row->producto_id, $row->almacen_id, $row->nombre_producto, $row->descripcion, $row->categoria, $row->precio);
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
                return new Bebida($row->producto_id, $row->almacen_id, $row->nombre_producto, $row->descripcion, $row->categoria, $row->precio);
            } else {
                
                return null;
            }
        }
    }
    
}

?>