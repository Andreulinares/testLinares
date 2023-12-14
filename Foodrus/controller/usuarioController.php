<?php
require_once __DIR__ . '/../model/ProductoDAO.php';


class usuarioController{

    public function registrarUsuario(){
        if(isset($_POST['registrar'])){
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apell'];
            $telefono = $_POST['tel'];
            $email = $_POST['mail'];
            $passwd = $_POST['passwd'];
            $rol = "usuario";

            $usuario = new Usuario(0, $nombre, $apellidos, $telefono, $email, $passwd, $rol);
            ProductoDAO::agregarUsuario($usuario);

            header("Location: ../Foodrus/views/login.php");
        }else{
            echo 'El usuario ya esta registrado en la base de datos';
        }
    }

    public function iniciarSesion(){
        session_start();
        if(isset($_POST['iniciar_sesion'])){
            $email = $_POST['email'];
            $passwd = $_POST['password'];

            if (ProductoDAO::verificarCredenciales($email, $passwd)){
                $_SESSION['user_email'] = $email;

                header("Location: ../Foodrus/views/Inicio.php");
                exit();
            } else {
                echo 'El usuario no existe, vuelve a intentarlo';
            }
        }
    }

    public function logout(){
        session_start();

        if(isset($_POST['cerrar_sesion'])){
            session_unset();
            session_destroy();

            header("Location: ../Foodrus/views/Inicio.php");
            exit();
        }
    }
    
}
