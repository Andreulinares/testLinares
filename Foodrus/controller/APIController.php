<?php
//Esto es un NUEVO CONTROLADOR
//hacer todas las configuraciones necesarias para que funcione como controlador

/** IMPORTANTE**/
//Cargar Modelos necesarios BBDD
require_once __DIR__ . '/../model/ProductoDAO.php';
require __DIR__ . '/../model/Reseña.php';
require_once __DIR__ . '/../model/PedidoBD.php';

/** IMPORTANTE**/
//Instala la extensión Thunder Client en VSC. Te permite probar si tu API funciona correctamente.

class APIController{    
//funcion para mostrar las reseñas en la pagina reseñas.php
//utilizamos la funcion obtener Reseñas para realizar un select a la bd y las guardamos en una variable
    public function api() {
        session_start();
        $accion = $_POST["accion"];  
    
        if ($accion == 'mostrar_reseñas') {
            $reseñas = ProductoDAO::obtenerReseñas();
            echo json_encode($reseñas, JSON_UNESCAPED_UNICODE);
            exit;
        }   
    }
//Funcion insertar reseñas, obtenemos los datos correspondientes y insertamos a la base de datos 
//utilizando la funcion insertarReseñas, insertamos los datos de la reseña en la bd
    public function insertarReseñas(){
        session_start();
        $usuario = ProductoDAO::obtenerUsuario($_SESSION['user_email']);
        $cliente_id = $usuario->getCliente_id();   
        $nombre_usuario = $usuario->getNombre();

        $puntuacion = $_POST['puntuacion'];
        $comentario = $_POST['comentario'];

        $reseña = new Reseña(
            null,
            $cliente_id,
            $puntuacion,
            $comentario,
            date("Y-m-d H:i:s"),
            $nombre_usuario
        );

        ProductoDAO::insertarReseñas($reseña);

        $response = ['mensaje' => 'Reseña añadida correctamente'];
        echo json_encode($response);
    }
//obtenemos los puntos correspondientes del usuario y los almacenamos en una variable
    public function apiPuntos(){
        session_start();
        $usuario = ProductoDAO::obtenerUsuario($_SESSION['user_email']);
        $cliente_id = $usuario->getCliente_id();

        $accion = $_POST["accion"];

        if ($accion == 'obtener_puntos') {
            $puntos = ProductoDAO::obtenerPuntos($cliente_id);

            echo json_encode(['puntos' => $puntos], JSON_UNESCAPED_UNICODE);
            exit;
        }
    }
//Funcion para actualizar los puntos y insertar pedido en la bd. Obtenemos los `puntos del usuario
//Y los puntos actuales, y luego los actualizamos. Despues insertamos pedido en la bd 
    /*public function actualizarPuntos(){
        session_start();
        $usuario = ProductoDAO::obtenerUsuario($_SESSION['user_email']);
        $cliente_id = $usuario->getCliente_id();
        
        $puntosUsuario = $_POST['puntosUsuario'];
        $puntosActuales = ProductoDAO::obtenerPuntos($cliente_id);

        $puntosNuevos = $puntosActuales - $puntosUsuario;

        ProductoDAO::actualizarPuntos($cliente_id, $puntosNuevos);

        $pedido_id = $_SESSION['carrito_id'];
        $cantidad = $_POST['cantidadTotal'];
        $estado = 'pendiente';
        $fecha = date('Y-m-d H:i:s');

        $pedido = new PedidoBD($pedido_id, $cliente_id, $cantidad, $estado, $fecha);
        ProductoDAO::insertarPedido($pedido);

        foreach ($_SESSION['selecciones'] as $pedido){
            $id_producto = $pedido->getProducto()->getProducto_id();
            $cantidad = $pedido->getCantidad();

            ProductoDAO::associarProductoPedido($pedido_id, $id_producto, $cantidad);
        }

        $_SESSION['mostrarModalQR'] = true;

        $response = ['mensaje' => 'Operacion realizada correctamente'];
        echo json_encode($response);
    }*/

    public function actualizarPuntos(){
        session_start();
        $usuario = ProductoDAO::obtenerUsuario($_SESSION['user_email']);
        $cliente_id = $usuario->getCliente_id();
        
        $puntosUsuario = $_POST['puntosUsuario'];
        $puntosActuales = ProductoDAO::obtenerPuntos($cliente_id);

        if ($puntosUsuario <= 0 || $puntosUsuario > $puntosActuales) {
            $response = ['mensaje' => 'Cantidad de puntos insuficiente o inválida'];
            echo json_encode($response);
            exit;
        }

        $puntosNuevos = $puntosActuales - $puntosUsuario;
        ProductoDAO::actualizarPuntos($cliente_id, $puntosNuevos);

        $pedido_id = $_SESSION['carrito_id'];
        $cantidad = $_POST['cantidadTotal'];
        $estado = 'pendiente';
        $fecha = date('Y-m-d H:i:s');

        $pedido = new PedidoBD($pedido_id, $cliente_id, $cantidad, $estado, $fecha);
        ProductoDAO::insertarPedido($pedido);

        foreach ($_SESSION['selecciones'] as $pedido) {
            $id_producto = $pedido->getProducto()->getProducto_id();
            $cantidad = $pedido->getCantidad();
            ProductoDAO::associarProductoPedido($pedido_id, $id_producto, $cantidad);
        }

        $_SESSION['mostrarModalQR'] = true;

        $response = ['mensaje' => 'Operacion realizada correctamente'];
        echo json_encode($response);
    }
//vaciar carrito al cerrar el modal del qr
    public function limpiarCarrito(){
        session_start();

        unset($_SESSION['selecciones']);
    }
}