<?php
require_once __DIR__ . '/../model/ProductoDAO.php';

//$totalProductos = count($pizza, $bebidas, $postres);
$pizzas = ProductoDAO::getAllProducts('pizza');
$bebidas = ProductoDAO::getAllProducts('bebida');
$postres = ProductoDAO::getAllProducts('postre');

$totalProductos = count($pizzas) + count($bebidas) + count($postres);

session_start();
?>


<!DOCTYPE html PUBLIC>
<html>
<head>
    <title>Pagina de carta</title>

    <meta charset="UTF-8">
    <meta name="description" content="Descripció web">
    <meta name="keywords" content="Paraules clau">
    <meta name="author" content="Autor">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/carta.css" rel="stylesheet" type="text/css" media="screen">

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
                        <a class="nav-link" href="<?= isset($_SESSION['user_email']) ? '#' : 'login.php'; ?>" id="navbarDropdownCarta" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="../img/usuario.svg" alt="mi-cuenta" class="usuario">
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
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown" class="desplegable">
                            <li>
                            <form action="../index.php?controller=usuario&action=logout" method="post">
                                <button type="submit" class="dropdown-item" name="cerrar_sesion">Salir</button>
                            </form>
                            </li>
                        </ul>
                        <?php endif; ?>
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
    <h2 class="h2-carta">CARTA</h2>
    
    <h2 class="t-menu">MENU INFANTIL</h2>

    <div class="container">
    <div class="productos-totales">
        <?= $totalProductos ?> productos encontrados
    </div>

    <div class="row tarjetas">
        <?php
        $pizzasIds = [10, 9, 11, 2, 12, 3];
        $pizzas = ProductoDAO::getProductsByIds('pizza', $pizzasIds);

        $bebidasIds = [4, 6, 8, 20, 21, 22];
        $bebidas = ProductoDAO::getProductsByIds('bebida', $bebidasIds);

        $postresIds = [23, 24, 25];
        $postres = ProductoDAO::getProductsByIds('postre', $postresIds);

        $productos = array_merge($pizzas, $bebidas, $postres);

        $tarjetasPorFila = 0;

        foreach ($productos as $index => $producto):
            $esNovedad = ($index % 2 == 1);
            $specialClass = $esNovedad ? 'special-card' : '';
        ?>
            <?php if ($tarjetasPorFila % 4 == 0): ?>
                </div><div class="row tarjetas">
            <?php endif; ?>

            <div class="col-md-3 card-container <?= $specialClass ?>">
                <div class="card">
                    <img src="../<?= $producto->getImagen(); ?>" class="card-img-top img-fluid img-product">
                    <div class="card-body">
                        <?php if ($esNovedad) : ?>
                            <p class="novedad">Novedad</p>
                        <?php endif; ?>
                        <h5 class="card-title titulo-producto"><?= $producto->getNombre_producto(); ?></h5>
                        <p class="card-text">
                            <span class="precio"><?= $producto->getPrecio(); ?> €</span>
                            <form action="../index.php?controller=producto&action=sel" method="post">
                                <input type="hidden" name="id" value="<?= $producto->getProducto_id(); ?>">
                                <input type="hidden" name="categoria" value="<?= $producto->getCategoria(); ?>">
                                <button type="submit" name="añadir-carrito" class="carro-btn">
                                    <svg class="carro" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                        <path class="carro-color"
                                            d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/>
                                    </svg>
                                </button>
                            </form>
                        </p>
                    </div>
                </div>
            </div>

            <?php $tarjetasPorFila++; ?>
        <?php endforeach; ?>
    </div>
    </div>

    <h2 class="t-menu">MENU ESTANDAR</h2>

    <div class="container contenedor">
    <div class="row tarjetas">
        <?php
        $pizzasIds2 = [13, 7, 5, 17, 14, 15];
        $pizzas2 = ProductoDAO::getProductsByIds('pizza', $pizzasIds2);

        $bebidasIds2 = [19, 16, 18];
        $bebidas2 = ProductoDAO::getProductsByIds('bebida', $bebidasIds2);

        $postresIds2 = [26, 27, 28];
        $postres2 = ProductoDAO::getProductsByIds('postre', $postresIds2);

        $productos2 = array_merge($pizzas2, $bebidas2, $postres2);

        $tarjetasPorFila = 0;

        foreach ($productos2 as $index => $producto2):
            $esNovedad = ($index % 2 == 1);
            $specialClass = $esNovedad ? 'special-card' : '';
        ?>
            <?php if ($tarjetasPorFila % 4 == 0): ?>
                    </div><div class="row tarjetas">
            <?php endif; ?>

            <div class="col-md-3 card-container <?= $specialClass ?>">
                <div class="card">
                    <img src="../<?= $producto2->getImagen(); ?>" class="card-img-top img-fluid img-product">
                    <div class="card-body">
                        <?php if ($esNovedad) : ?>
                            <p class="novedad">Novedad</p>
                        <?php endif; ?>
                        <h5 class="card-title titulo-producto"><?= $producto2->getNombre_producto(); ?></h5>
                        <p class="card-text">
                            <span class="precio"><?= $producto2->getPrecio(); ?> €</span>
                            <form action="../index.php?controller=producto&action=sel" method="post">
                                <input type="hidden" name="id" value="<?= $producto2->getProducto_id(); ?>">
                                <input type="hidden" name="categoria" value="<?= $producto2->getCategoria(); ?>">
                                <button type="submit" name="añadir-carrito" class="carro-btn">
                                    <svg class="carro" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                        <path class="carro-color"
                                            d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/>
                                    </svg>
                                </button>
                            </form>
                        </p>
                    </div>
                </div>
            </div>

            <?php $tarjetasPorFila++; ?>
        <?php endforeach; ?>                  

        </div>
        <div class="productos-totales">
            <?= $totalProductos ?> productos encontrados
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
<!-- VENTANA EMERGENTE CARRITO -->
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