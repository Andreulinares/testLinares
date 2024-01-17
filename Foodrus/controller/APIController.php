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
 
    public function api(){
        session_start();
        $usuario = ProductoDAO::obtenerUsuario($_SESSION['user_email']);
        $cliente_id = $usuario->getCliente_id();

        if($_POST["accion"] == 'buscar_pedido'){

            $reseñas = ProductoDAO::obtenerReseñas($cliente_id);

        }else if($_POST["accion"] == 'add_review'){

            $data = json_decode(file_get_contents('php://input'));

            $reseña = new Reseña(
                null,
                $cliente_id,
                $data['reseña']['puntuacion'],
                $data['reseña']['comentario'],
                date("Y-m-d H:i:s")
            );

            ProductoDAO::insertarReseñas($reseña);

            echo json_encode(['mensaje' => 'Reseña añadida correctamente']);
        }
    }
}