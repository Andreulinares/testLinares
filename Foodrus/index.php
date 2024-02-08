<?php
require __DIR__ . '/../Foodrus/config/parameters.php';
require __DIR__ . '/../Foodrus/controller/productoController.php';
require __DIR__ .'/../Foodrus/controller/usuarioController.php';
require __DIR__ .'/../Foodrus/controller/APIController.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['controller'])) {
    // Creamos el nombre del controlador
    $nombre_controller = $_GET['controller'] . 'Controller';

    // Verificamos si la clase del controlador existe
    if (class_exists($nombre_controller)) {
        // Creamos una instancia del controlador
        $controller = new $nombre_controller();

        // Verificamos si se proporciona el parámetro 'action' en la URL
        if (isset($_GET['action']) && method_exists($controller, $_GET['action'])) {
            $action = $_GET['action'];
        } else {
            // Si no se proporciona 'action', utilizamos la acción por defecto
            $action = $action_default;
        }

        // Ejecutamos la acción en el controlador
        $controller->$action();
    } else {
        // Si la clase del controlador no existe, mostramos un mensaje de error
        echo $nombre_controller . ' NO EXISTE';
    }
} else {
    // Si no se proporciona 'controller' en la URL, mostramos una página principal por defecto
    $nombre_controller = 'productoController';

    // Verificamos si la clase del controlador existe
    if (class_exists($nombre_controller)) {
        // Creamos una instancia del controlador
        $controller = new $nombre_controller();

        // Verificamos si se proporciona el parámetro 'action' en la URL
        if (isset($_GET['action']) && method_exists($controller, $_GET['action'])) {
            $action = $_GET['action'];
        } else {
            // Si no se proporciona 'action', utilizamos la acción por defecto
            $action = $action_default;
        }

        // Ejecutamos la acción en el controlador
        $controller->$action();
    } else {
        // Si la clase del controlador no existe, mostramos un mensaje de error
        echo $nombre_controller . ' NO EXISTE';
    }
}
?>