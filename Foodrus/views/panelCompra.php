<?php
require __DIR__ . '/../model/Pedido.php';
require __DIR__ . '/../model/Pizza.php';
require __DIR__ . '/../model/Bebida.php';
require __DIR__ . '/../model/Postre.php';
require __DIR__ . '/../utils/CalculadoraPrecios.php';

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
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1450A0;">
            <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../img/Logo-foodrus.png" width="150" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="Inicio.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="carta.php">Carta</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Dropdown
                    </a>
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                </li>
                </ul>
                <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
            <a href="panelCompra.php">
                <svg class="carrito" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 42.98 49.23"><defs><style>.cls-1{fill:none;}.cls-2{clip-path:url(#clip-path);}.cls-3{fill:#fff;}</style><clipPath id="clip-path" transform="translate(0)"><rect class="cls-1" width="43.75" height="50"/></clipPath></defs><title>carritohead_w</title><g id="Capa_2" data-name="Capa 2"><g id="Capa_1-2" data-name="Capa 1"><g class="cls-2">
                <path class="cls-3" d="M39.91,13.71a1.55,1.55,0,0,0-1.53-1.41H30.7V9.23a9.21,9.21,0,1,0-18.42,0V12.3H4.6a1.55,1.55,0,0,0-1.53,1.41L0,47.55a1.53,1.53,0,0,0,1.53,1.68H41.45a1.52,1.52,0,0,0,1.13-.5,1.54,1.54,0,0,0,.4-1.18ZM15.35,9.23a6.14,6.14,0,1,1,12.28,0V12.3H15.35ZM3.22,46.15,6,15.38h6.28v3.5a3.08,3.08,0,1,0,3.07,0v-3.5H27.63v3.5a3.08,3.08,0,1,0,3.07,0v-3.5H37l2.78,30.77Z" transform="translate(0)"/></g><path class="cls-3" d="M28,33.75l-2.55,1.76a1.24,1.24,0,0,0-.55,1.15c0,.33-.11,2.66-.11,3s-.15,1.2-1.17.3c0,0-1.7-1.48-1.95-1.71a1.35,1.35,0,0,0-1.55-.32L17.48,39s-1.6.65-1-.79,1-2.56,1.09-2.93a1.42,1.42,0,0,0-.24-1.33c-.15-.18-1.42-1.86-1.72-2.28,0,0-1-1.25.7-1.17l3,.08a1.14,1.14,0,0,0,1-.59c.49-.77,1.93-2.58,1.63-2.2.26-.32.84-1.11,1.23.2,0,0,.55,1.73.81,2.45a1.44,1.44,0,0,0,1.18,1.11l2.74,1s1.29.4.07,1.25" transform="translate(0)"/></g></g>
                </svg>
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

        <form action="../index.php?action=compra" method='post' class="botones">
            <label for="cantidad">Cantidad:</label>
            <button class="b1 bet-button w3-black w3-section" type="submit" name="Add" value=<?=$pos?>> + </button>
            <input class="cantidad" type="number" id="cantidad" name="cantidad" value="<?= $pedido->getCantidad() ?>" readonly>
            <button class="b2 del-button w3-black w3-section" type="submit" name="Del" value=<?=$pos?>> - </button>
        </form>
        <div class="precio-total">
            <p><?= number_format($precioTotal, 2); ?> €</p>
        </div>
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
        </div>
    </div>
</section>
<section>

</section>
</body>
</html>