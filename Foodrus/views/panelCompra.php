<?php
require __DIR__ . '/../model/Pedido.php';
require __DIR__ . '/../utils/CalculadoraPrecios.php';
require __DIR__ . '/../model/ProductoDAO.php';

session_start();

if (!isset($_SESSION['carrito_id'])) {
    $_SESSION['carrito_id'] = strtoupper(substr(bin2hex(random_bytes(5)), 0, 10));
}

//Calcular precio envio

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Panel de compra</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/carrito.css" rel="stylesheet">
    <link href="../assets/css/carrito2.css" rel="stylesheet">

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<header id="mi-header">
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
                        <a id="usuario-btn" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                        <ul id="desplegable-menu" class="dropdown-menu">
                            <li>
                                <form action="../index.php?controller=usuario&action=logout" method="post">
                                    <button type="submit" class="dropdown-item salir" name="cerrar_sesion">Salir</button>
                                </form>
                            </li>
                            <li>
                                <form action="">
                                    <button type="submit" class="dropdown-item mis-pedidos" name="mis-pedidos">Mis pedidos</button>
                                </form>
                            </li>
                            <?php
                            $rol = ProductoDAO::obtenerRolUsuario($_SESSION['user_email']);
                            if ($rol == 'administrador'){
                                ?>
                                <li>
                                    <a href="../index.php?controller=producto&action=index" class="dropdown-item admin-productos" name="ad-product">Productos</a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <script src="../assets/js/desplegable.js"></script>
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
    <h1>Mi cesta | ID: <?= $_SESSION['carrito_id']; ?></h1>
    <hr>

    <?php
    foreach ($_SESSION['selecciones'] as $pos => $pedido):
        $producto = $pedido->getProducto();
        $cantidad = $pedido->getCantidad();
        $precioTotal = $producto->getPrecio() * $cantidad;

        $precioEnvio = 3.80;

        $subtotal = CalculadoraPrecios::calcularPrecioPedido($_SESSION['selecciones']);

        $cantidadTotal = number_format($subtotal + $precioEnvio, 2);

    ?>

    <div class="producto">
        <div class="img-producto">
            <img src="../<?= $pedido->getProducto()->getImagen(); ?>" width="100" height="100">
        </div>
        <div class="detalles">
            <div class="nombre-producto"><?= $pedido->getProducto()->getNombre_producto(); ?></div>
            <div class="id-producto"><?= $pedido->getProducto()->getProducto_id(); ?></div>
            <div class="precio-producto">
                <p>Precio del articulo: <?= $pedido->getProducto()->getPrecio(); ?> €</p>
            </div>
        </div>

        <form action="../index.php?controller=producto&action=compra" method='post' class="botones">
            <label for="cantidad">Cantidad:</label>
            <button class="b1 bet-button w3-black w3-section" type="submit" name="Add" value=<?=$pos?>> + </button>
            <input class="cantidad" type="number" id="cantidad" name="cantidad" value="<?= $pedido->getCantidad() ?>" readonly>
            <button class="b2 del-button w3-black w3-section" type="submit" name="Del" value=<?=$pos?>> - </button>
        </form>
        <div class="precio-total">
            <p><?= number_format($precioTotal, 2); ?> €</p>
        </div>

        <form action="../index.php?controller=producto&action=eliminaCarrito" method="post">
            <button type="submit" name="eliminar" value=<?=$pos?> class="eliminar-p">ELIMINAR</button>
            <button type="submit" class="favoritos">MOVER A FAVORITOS</button>
        </form>
    </div>
    <?php
    endforeach;
    ?>
</section>
<section>
    <div class="resumen">
        <div class="envio">
            <form action="panelCompra.php" method="post">
                <input type="radio" id="domicilio" name="tipoEnvio" value="domicilio" checked>
                <label class="c1" for="domicilio">Envío a domicilio</label>

                <input type="radio" id="recogida" name="tipoEnvio" value="recogida">
                <label class="c2" for="recogida">Envio a punto de recogida</label>

                <input type="radio" id="tienda" name="tipoEnvio" value="tienda">
                <label class="c3" for="tienda">Recoger en tienda en 2h</label>
            </form>
        </div>

        <div class="precios">
            <p><span class="pre-text">Subtotal:</span> <span class="precio"><?= number_format($subtotal, 2)?>€</span></p>

            <p><span class="pre-text">Envío:</span> <span class="precio2"><?= number_format($precioEnvio, 2); ?>€</p></span>

            <p><span class="pre-text2">TOTAL</span> <span class="precio3"><?= number_format($subtotal + $precioEnvio, 2) ?>€</span></p>
            <hr class="linea">

            <form action="#" method="post" class="cupon-form">
                <div class="form-group">
                    <label for="cupon">Código de descuento</label>
                    <input type="text" class="form-control" id="cupon" placeholder="Introduce el código de cupón">
                </div>
                <button type="submit" class="btn btn-primary btn-cupon">APLICAR</button>
            </form>

            <hr class="linea2">

            <hr class="linea3">
            <form action="../index.php?controller=producto&action=finalizarCompra" method="post">
                <input type="hidden" name="cantidadTotal" value="<?= $cantidadTotal ?>">
                <button type="submit" class="btn btn-primary btn-finalizar">FINALIZAR COMPRA</button>
            </form>
        </div>
    </div>
</section>
<section>
    <p class="p-recomendados">Productos recomendados</p>

    <?php 
    $pizzas = ProductoDAO::getAllProducts('pizza');
    $bebidas = ProductoDAO::getAllProducts('bebida');
    $postres = ProductoDAO::getAllProducts('postre');

    $todosProductos = array_merge($pizzas, $bebidas, $postres);

    $productosRecomendados = ProductoDAO::obtenerProductosAleatorios($todosProductos);
    ?>

    <div class="row tarjetas">
        <?php
        $pos = ['uno', 'dos', 'tres', 'cuatro'];

        foreach ($productosRecomendados as $key => $producto){
            $clase = $pos[$key];
        ?>
        <div class="col-md-3 mb-4">
            <div class="card <?= $clase; ?>" style="width: 18rem; height: 250px;">
                <img src="../<?= $producto->getImagen(); ?>" class="card-img-top product-image" alt="<?= $producto->getNombre_producto(); ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $producto->getNombre_producto(); ?></h5>
                    <p class="card-text"><?= number_format($producto->getPrecio(), 2); ?> €</p>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</section>

<section>
    <p class="ultimos-pedidos">ULTIMOS PEDIDOS</p>

    <?php
    // Para mostrar el último pedido
    if (isset ($_SESSION['user_email']) && isset($_COOKIE['UltimoPedido'])) {
        echo '<p class="pedido-real">Último pedido: ' . $_COOKIE['UltimoPedido'] . '</p>';
    } else {
        echo '<p class="pedido-real">No hay pedidos anteriores.</p>';
    }
    ?>
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