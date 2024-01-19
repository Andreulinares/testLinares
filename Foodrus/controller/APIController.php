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
        $usuario = ProductoDAO::obtenerUsuario($_SESSION['user_email']);
        $cliente_id = $usuario->getCliente_id();
    
        $accion = $_POST["accion"];  // Obtén la acción del formulario
    
        if ($accion == 'mostrar_reseñas') {
            $reseñas = ProductoDAO::obtenerReseñas();
            echo json_encode($reseñas, JSON_UNESCAPED_UNICODE);
            exit;
        } elseif ($accion == 'add_review') {
            $puntuacion = $_POST['puntuacion'];
            $comentario = $_POST['comentario'];
        
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
}