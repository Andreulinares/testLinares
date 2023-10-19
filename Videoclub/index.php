<?php
include('../Videoclub/controller/productoController.php');
include('../Videoclub/config/parameters.php');

if (isset($_GET['controller'])){
    //Si no se pasa nada, se mostrara pagina principal de pedidos
    header("Location:");
}else{
    $nombre_controller = $_GET['controller'].'Controller';

    if(class_exists($nombre_controller)){
        //Miramos si nos pasa una accion
        //en caso contrario mostraremos una accion por defecto
        $controller = new $nombre_controller();

        if(isset($_GET['action']) && method_exists($controller,$_GET['action'])){
            $action = $_GET['action'];
        }else{
            $action = action_default;
        }

        $controller->action();
    }else{
        echo $nombre_controller. ' NO EXISTE'; 
    }
}
?>