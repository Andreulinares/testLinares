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
       
        if($_POST["accion"] == 'buscar_pedido'){

            $id_usuario = json_decode($_POST["id_usuario"]); //se decodifican los datos JSON que se reciben desde JS
            $pedidos = ""; //puedes hacer un select de pedidos aqui, o un insert o lo que quieras, utilizando el MODELO
            
            // Si quieres devolverle información al JS, codificas en json un array con la información
            // y se los devuelves al JS
            echo json_encode($pedidos, JSON_UNESCAPED_UNICODE) ; 
            return; //return para salir de la funcion

        }else if($_POST["accion"] == 'add_review'){
            $usuario = ProductoDAO::obtenerUsuario($_SESSION['user_email']);
            $cliente_id = $usuario->getCliente_id();

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