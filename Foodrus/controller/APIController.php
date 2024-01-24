<?php
//Esto es un NUEVO CONTROLADOR
//hacer todas las configuraciones necesarias para que funcione como controlador

/** IMPORTANTE**/
//Cargar Modelos necesarios BBDD
require_once __DIR__ . '/../model/ProductoDAO.php';
require __DIR__ . '/../model/Reseña.php';

/** IMPORTANTE**/
//Instala la extensión Thunder Client en VSC. Te permite probar si tu API funciona correctamente.

class APIController{    

    public function api() {
        session_start();
        $accion = $_POST["accion"];  
    
        if ($accion == 'mostrar_reseñas') {
            $reseñas = ProductoDAO::obtenerReseñas();
            echo json_encode($reseñas, JSON_UNESCAPED_UNICODE);
            exit;
        }   
    }

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

    public function apiPuntos(){
        session_start();
        $usuario = ProductoDAO::obtenerUsuario($_SESSION['user_email']);
        $cliente_id = $usuario->getCliente_id();

        $accion = $_POST["accion"];

        if ($accion == 'obtener_puntos') {
            $puntos = ProductoDAO::obtenerPuntos($cliente_id);

            echo json_encode(['puntos' => $puntos], JSON_UNESCAPED_UNICODE);
            exit;
        }else if($accion == 'actualizar_puntos') {
            $precioEnvio = 3.80;
            $subtotal = CalculadoraPrecios::calcularPrecioPedido($_SESSION['selecciones']);
            $cantidadTotal = number_format($subtotal + $precioEnvio, 2);

            $puntosObtenidos = $this->calcularPuntosCompra($cantidadTotal);

            ProductoDAO::insertarPuntosUsuario($cliente_id, $puntosObtenidos);
        }
    }

    private function calcularPuntosCompra($cantidadTotal){
        return floor($cantidadTotal / 100);
    }
}