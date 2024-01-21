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

        $input = json_decode(file_get_contents('php://input'), true);

        $puntuacion = $input['puntuacion'];
        $comentario = $input['comentario'];

        $reseña = new Reseña(
            null,
            $cliente_id,
            $puntuacion,
            $comentario,
            date("Y-m-d H:i:s")
        );

        ProductoDAO::insertarReseñas($reseña);

        echo json_encode(['mensaje' => 'Reseña añadida correctamente']);
    }
}