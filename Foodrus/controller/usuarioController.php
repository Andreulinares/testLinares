<?php
require __DIR__ . '/../model/ProductoDAO.php';


class usuarioController{

    public function registrarUsuario(){
        if(isset($_POST['registrar'])){
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apell'];
            $telefono = $_POST['tel'];
            $email = $_POST['mail'];
            $passwd = $_POST['passwd'];

            $usuario = new Usuario(0, $nombre, $apellidos, $telefono, $email, $passwd);
            ProductoDAO::agregarUsuario($usuario);
        }else{
            echo 'El usuario ya esta registrado en la base de datos';
        }
    }
    
}
