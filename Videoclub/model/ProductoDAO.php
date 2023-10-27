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
                    $producto = new Pizza($row->producto_id, $row->nombre_producto, $row->descripcion, $row->categoria, $row->precio);
                }else if($categoria === 'bebida'){
                    $producto = new Bebida($row->producto_id, $row->nombre_producto, $row->descripcion, $row->categoria, $row->precio);
                }
                $productos[] = $producto;
            }
        }

        return $productos;
    }

    public static function agregarProducto($producto){
        $con = database::connect();

        $stmt = $con->prepare("INSERT INTO productos (almacen_id, nombre_producto, descripcion, categoria, precio) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $producto->getAlmacen_id(), $producto->getNombre_producto(), $producto->getDescripcion(), $producto->getCategoria(), $producto->getPrecio());

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

    public static function updateProduct($id, $nombre, $descripcion, $categoria, $precio){
        $con = database::connect();

        $stmt = $con->prepare("UPDATE FROM productos SET nombre_producto = ?, descripcion = ?, categoria = ?, precio = ? WHERE producto_id = ?");
        $stmt->bind_param("ssssi", $nombre, $descripcion, $categoria, $precio, $id);

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
            $producto = $result->fetch_object('Pizza', [$id, '', '', '', '']);
        } elseif ($categoria === 'bebida') {
            $producto = $result->fetch_object('Bebida', [$id, '', '', '', '']);
        }

        return $producto;
    }
}

?>