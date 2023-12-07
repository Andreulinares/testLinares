<?php
session_start();
?>

<!DOCTYPE html PUBLIC>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/login.css" rel="stylesheet" type="text/css" media="screen">
    <title>Login</title>
</head>
<body>

<header>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1450A0;">
    <div class="container">
        <!-- Logo foodrus -->
        <a class="navbar-brand" href="Inicio.php">
            <img src="../img/Logo-foodrus.png" width="150" height="50">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <!-- Buscador -->
            <form class="d-flex ms-auto" role="search">
                <input class="form-control me-2 custom-search" type="search" placeholder="Busca aqui algo divertido">
                <img src="../img/lupa.png" width="20" height="20" class="img-lupa">
            </form>

            <!-- mi cuenta, ubicacion y carta -->
            <ul class="navbar-nav me-2">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <img src="../img/storeFinder.svg" alt="ubicacion" class="ubicacion">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">
                        <img src="../img/usuario.svg" alt="mi-cuenta" class="usuario">
                        <span class="texto-menu">MI CUENTA</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="carta.php" class="nav-link text-white carta">Carta</a>
                </li>
            </ul>
        </div>

            <!-- Icono carrito -->
        <a href="javascript:void(0);" onclick="mostrarVentana()" class="ms-2" id="carrito-icono">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 42.98 49.23"><defs><style>.cls-1{fill:none;}.cls-2{clip-path:url(#clip-path);}.cls-3{fill:#fff;}</style><clipPath id="clip-path" transform="translate(0)"><rect class="cls-1" width="43.75" height="50"/></clipPath></defs><title>carritohead_w</title><g id="Capa_2" data-name="Capa 2"><g id="Capa_1-2" data-name="Capa 1"><g class="cls-2">
                <path class="cls-3" d="M39.91,13.71a1.55,1.55,0,0,0-1.53-1.41H30.7V9.23a9.21,9.21,0,1,0-18.42,0V12.3H4.6a1.55,1.55,0,0,0-1.53,1.41L0,47.55a1.53,1.53,0,0,0,1.53,1.68H41.45a1.52,1.52,0,0,0,1.13-.5,1.54,1.54,0,0,0,.4-1.18ZM15.35,9.23a6.14,6.14,0,1,1,12.28,0V12.3H15.35ZM3.22,46.15,6,15.38h6.28v3.5a3.08,3.08,0,1,0,3.07,0v-3.5H27.63v3.5a3.08,3.08,0,1,0,3.07,0v-3.5H37l2.78,30.77Z" transform="translate(0)"/></g><path class="cls-3" d="M28,33.75l-2.55,1.76a1.24,1.24,0,0,0-.55,1.15c0,.33-.11,2.66-.11,3s-.15,1.2-1.17.3c0,0-1.7-1.48-1.95-1.71a1.35,1.35,0,0,0-1.55-.32L17.48,39s-1.6.65-1-.79,1-2.56,1.09-2.93a1.42,1.42,0,0,0-.24-1.33c-.15-.18-1.42-1.86-1.72-2.28,0,0-1-1.25.7-1.17l3,.08a1.14,1.14,0,0,0,1-.59c.49-.77,1.93-2.58,1.63-2.2.26-.32.84-1.11,1.23.2,0,0,.55,1.73.81,2.45a1.44,1.44,0,0,0,1.18,1.11l2.74,1s1.29.4.07,1.25" transform="translate(0)"/></g></g>
            </svg>
            <div class="numero-carrito" id="numero-carrito">0</div>
        </a>
    </div>
</nav>
</header>
<section>
    <div class="container mt-5">
        
        <!-- Pestañas -->
        <ul class="nav nav-tabs custom-tabs" id="myTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="login-tab" data-bs-toggle="tab" href="#loginForm" role="tab" aria-controls="loginForm" aria-selected="true">ENTRAR</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="registro-tab" data-bs-toggle="tab" href="#registroForm" role="tab" aria-controls="registroForm" aria-selected="false">SOY NUEVO</a>
            </li>
        </ul>
        <div class="tab-content">
        <!-- Formularios --> 
            <div class="col-md-6 bg-login tab-pane show active" id="loginForm" role="tabpanel" aria-labelledby="login-tab">
                <form action="../index.php?controller=usuario&action=iniciarSesion" method="post">
                    <label for="email">Dirección de correo electrónico:</label>
                    <input type="email" class="form-control" id="email" name="email" required>

                    <label for="password">Contraseña:</label>
                    <input type="password" class="form-control" id="password" name="password" required>

                    <button type="submit" name="iniciar_sesion" class="btn btn-primary mt-3">Iniciar Sesión</button>
                </form>
            </div>

            <div class="col-md-6 bg-login tab-pane" id="registroForm" role="tabpanel" aria-labelledby="registro-tab">
                <form action="../index.php?controller=usuario&action=registrarUsuario" method="post">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>

                    <label for="apell">Apellidos</label>
                    <input type="text" class="form-control" id="apell" name="apell" required>

                    <label for="tel">Numero de telefono:</label>
                    <input type="number" class="form-control" id="tel" name="tel" required>

                    <label for="mail">Correo electrónico</label>
                    <input type="text" class="form-control" id="mail" name="mail" required>

                    <label for="passwd">Contraseña:</label>
                    <input type="password" class="form-control" id="passwd" name="passwd" required>

                    <button type="submit" name="registrar" class="btn btn-success mt-3">Registrarse</button>
                </form>
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="container-fluid p-5 text-white bg-custom">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-3">
                <!-- Iconos de redes sociales -->
                <a href="#" class="text-white"><img src="../img/red1.png" alt="Imagen 1"></a>
                <a href="#" class="text-white"><img src="../img/red2.png" alt="Imagen 2"></a>
                <a href="#" class="text-white"><img src="../img/red3.png" alt="Imagen 3"></a>
                <a href="#" class="text-white"><img src="../img/red4.png" alt="Imagen 4"></a>
            </div>
        </div>
        <div class="row"> 
            <div class="col-xs-12 pt-2 text-center copyright">
                <!-- Copyright -->
                <p class="text-white">&copy;2023 | Andreu Linares</p>
            </div>
        </div>
    </div>
</footer>

<!-- VENTANA EMERGENTE CARRITO-->
<div id="ventana" style="display: none;">
    <div class="div-ventana">
        <p class="mi-cesta">Mi cesta</p>
        <button id="btnFinalizarCompra">FINALIZAR COMPRA</button>
        <button id="btnContinuarComprando">CONTINUAR COMPRANDO</button>
    </div>
</div>

<div id="fondoOscuro"></div>
</body>

<script src="../assets/js/ventana.js" defer></script>

<?php if (empty($_SESSION['selecciones'])): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('btnFinalizarCompra').disabled = true;
        });
    </script>
<?php endif; ?>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<!-- Bolita roja actualizar cantidad -->
<script>
function actualizarNumCarrito(){
    let numProductos = <?php echo count($_SESSION['selecciones']); ?>;

    let bolitaRoja = document.getElementById('numero-carrito');
    if(bolitaRoja){
        bolitaRoja.textContent = numProductos;
    }
}

document.addEventListener('DOMContentLoaded', function () {
        actualizarNumCarrito();
});
</script>
</html>