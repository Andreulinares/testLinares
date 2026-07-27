<?php
require_once __DIR__ . '/../model/ProductoDAO.php';


class usuarioController{

public function login() {
        
    require_once 'views/login.php'; 
}

//REGISTRAR USUARIO Y INICIAR SESION
    public function registrarUsuario(){
        if(isset($_POST['registrar'])){
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apell'];
            $telefono = $_POST['tel'];
            $email = $_POST['mail'];
            $passwd = $_POST['passwd'];
            $rol = "usuario";

            $usuario = new Usuario(0, $email, $nombre, $apellidos, $passwd, $telefono, $rol);
            ProductoDAO::agregarUsuario($usuario);

            header("Location: " . URL_BASE . "?controller=usuario&action=login");
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

                header("Location: " . URL_BASE . "?controller=producto&action=index");
                exit();
            } else {
                echo 'El usuario no existe, vuelve a intentarlo';
            }
        }
    }
//CERRAR SESION
    public function logout(){
        session_start();

        if(isset($_POST['cerrar_sesion'])){
            session_unset();
            session_destroy();

            header("Location: " . URL_BASE . "?controller=producto&action=index");
            exit();
        }
    }
//MOSTRAR PEDIDOS 
    public function mostrarPedidos(){
        session_start();

        $rol = ProductoDAO::obtenerRolUsuario($_SESSION['user_email']);

        if ($rol == 'administrador'){
            $pedidos = ProductoDAO::obtenerTodosPedidos();
        }else{
            $usuario = ProductoDAO::obtenerUsuario($_SESSION['user_email']);
            $cliente_id = $usuario->getCliente_id();

            $pedidos = ProductoDAO::obtenerPedidosUsuario($cliente_id);
        }

        require __DIR__ . '/../views/misPedidos.php';
    }
//EDITAR Y ACTUALIZAR DATOS USUARIOS
    public function editarUsuario(){
        session_start();

        $usuario = ProductoDAO::obtenerUsuario($_SESSION['user_email']);

        require __DIR__ . '/../views/editarUsuario.php';
    }
    
    public function actualizar(){
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apell'];
        $telefono = $_POST['tel'];
        $email = $_POST['mail'];
        $contraseña = $_POST['passwd'];
        $id = $_POST['id'];

        ProductoDAO::actualizarUsuario($id, $nombre, $apellidos, $telefono, $email, $contraseña);

        header("Location: " . URL_BASE . "?controller=producto&action=index");
        exit();
    }
//SALIR DE LA PAGINA DE EDITAR USUARIO SIN MODIFICAR NADA
    public function cancelar(){
        header("Location: " . URL_BASE . "?controller=producto&action=index");
        exit();
    }

    public function eliminarPedido(){
        if (isset($_POST['pedido_id'])){
            $pedido_id = $_POST['pedido_id'];
            if (ProductoDAO::deletePedido($pedido_id)){
                echo "El pedido se elimino correctamente";
                $this->mostrarPedidos();
            }else{
                echo "Error, no se ha podido eliminar el pedido";
            }
        }
    }
//Cambiar estado del pedido a entregado
    public function finalizarPedido(){
        $pedido_id = $_POST['pedido_id'];
        $estado = $_POST['nuevo_estado'];

        ProductoDAO::actualizarEstadoPedido($pedido_id, $estado);
        $this->mostrarPedidos();
    }
}
