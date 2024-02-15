<header id="mi-header">
    <nav class="navbar navbar-expand-lg navbar-dark nav-principal" style="background-color: #1450A0;">
        <div class="container">
            <!-- Logo foodrus -->
            <a class="navbar-brand" href="/Foodrus/views/Inicio.php">
                <img src="/Foodrus/img/Logo-foodrus.png" width="150" height="50">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Buscador -->
            <form class="d-flex ms-auto buscador" role="search">
                    <input class="form-control me-2 custom-search" type="search" placeholder="Busca aqui algo divertido">
                    <img src="/Foodrus/img/lupa.png" width="20" height="20" class="img-lupa">
            </form>
        

                <!-- mi cuenta, ubicacion y carta -->
                <ul class="navbar-nav me-2">
                    <li class="nav-item ubi">
                        <a class="nav-link" href="#">
                        <img src="/Foodrus/img/storeFinder.svg" alt="ubicacion" class="ubicacion">
                        </a>
                    </li>
                    <li class="nav-item mi-cuenta">
                        <a id="usuario-btn" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="/Foodrus/img/usuario.svg" alt="mi-cuenta" class="usuario">
                        <span class="texto-menu">
                            <?php
                            if (isset($_SESSION['user_email'])){
                            $usuario = ProductoDAO::obtenerUsuario($_SESSION['user_email']);
                            echo $usuario->getNombre();
                            } else {
                            echo "MI CUENTA";
                            }
                            ?>
                            </span>
                        </a>
                        <?php
                        if (isset($_SESSION['user_email'])) : ?>
                        <ul id="desplegable-menu" class="dropdown-menu">
                        <li>
                            <form action="/Foodrus/index.php?controller=usuario&action=logout" method="post">
                            <button type="submit" id="salir" class="dropdown-item salir boton-desp" name="cerrar_sesion">Salir</button>
                            </form>
                        </li>
                        <li>
                            <form action="/Foodrus/index.php?controller=usuario&action=mostrarPedidos" method="post">
                            <button type="submit" id="mis-pedidos" class="dropdown-item mis-pedidos boton-desp" name="mis-pedidos">Mis pedidos</button>
                            </form>
                        </li>
                        <li>
                            <form action="/Foodrus/index.php?controller=usuario&action=editarUsuario" method="post">
                            <button type="submit" id="mod-usuario" class="dropdown-item mod-usuario" name="mod-usuario">Detalles de la cuenta</button>
                            </form>
                        </li>
                        <!-- PANEL ADMINISTRADOR -->
                        <?php
                        $rol = ProductoDAO::obtenerRolUsuario($_SESSION['user_email']);
                        if ($rol == 'administrador'){
                            ?>
                            <li>
                                <a href="/Foodrus/index.php?controller=producto&action=listaProductos" class="dropdown-item admin-productos boton-desp" name="ad-product">Productos</a>
                            </li>
                            <?php
                        }
                        ?>
                        </ul>
                        <script src="/Foodrus/assets/js/desplegable.js"></script>
                        <?php else : ?>
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                            let dropdownToggle = document.querySelector('.nav-link.dropdown-toggle');

                            if (dropdownToggle) {
                                dropdownToggle.addEventListener('click', function () {
                                window.location.href = 'login.php';
                                });
                            }
                            });
                        </script>
                        <?php endif; ?>
                    </li>
                </ul>

                <!-- Icono carrito -->
                <a href="javascript:void(0);" onclick="mostrarVentana()" class="ms-2 carrito-svg" id="carrito-icono">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 42.98 49.23"><defs><style>.cls-1{fill:none;}.cls-2{clip-path:url(#clip-path);}.cls-3{fill:#fff;}</style><clipPath id="clip-path" transform="translate(0)"><rect class="cls-1" width="43.75" height="50"/></clipPath></defs><title>carritohead_w</title><g id="Capa_2" data-name="Capa 2"><g id="Capa_1-2" data-name="Capa 1"><g class="cls-2">
                        <path class="cls-3" d="M39.91,13.71a1.55,1.55,0,0,0-1.53-1.41H30.7V9.23a9.21,9.21,0,1,0-18.42,0V12.3H4.6a1.55,1.55,0,0,0-1.53,1.41L0,47.55a1.53,1.53,0,0,0,1.53,1.68H41.45a1.52,1.52,0,0,0,1.13-.5,1.54,1.54,0,0,0,.4-1.18ZM15.35,9.23a6.14,6.14,0,1,1,12.28,0V12.3H15.35ZM3.22,46.15,6,15.38h6.28v3.5a3.08,3.08,0,1,0,3.07,0v-3.5H27.63v3.5a3.08,3.08,0,1,0,3.07,0v-3.5H37l2.78,30.77Z" transform="translate(0)"/></g><path class="cls-3" d="M28,33.75l-2.55,1.76a1.24,1.24,0,0,0-.55,1.15c0,.33-.11,2.66-.11,3s-.15,1.2-1.17.3c0,0-1.7-1.48-1.95-1.71a1.35,1.35,0,0,0-1.55-.32L17.48,39s-1.6.65-1-.79,1-2.56,1.09-2.93a1.42,1.42,0,0,0-.24-1.33c-.15-.18-1.42-1.86-1.72-2.28,0,0-1-1.25.7-1.17l3,.08a1.14,1.14,0,0,0,1-.59c.49-.77,1.93-2.58,1.63-2.2.26-.32.84-1.11,1.23.2,0,0,.55,1.73.81,2.45a1.44,1.44,0,0,0,1.18,1.11l2.74,1s1.29.4.07,1.25" transform="translate(0)"/></g></g>
                </svg>
                <div class="numero-carrito" id="numero-carrito">0</div>
                </a>
            </div>
        </div>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-dark nav-secundario" style="background-color: #1450A0;">
        <div id="nav-contenedor" class="container">
            <!-- Contenido del segundo menú -->
                <ul class="navbar-nav me-2">
                    <li class="nav-item mi-carta">
                        <a href="/Foodrus/views/carta.php" class="nav-link text-white carta">Carta</a>
                    </li>
                    <li class="nav-item">
                        <a href="/Foodrus/views/reseñas.php" class="nav-link text-white reseñas">Reseñas</a>
                    </li>
                </ul>
        </div>
    </nav>
</header>