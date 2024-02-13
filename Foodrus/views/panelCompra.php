<?php
require __DIR__ . '/../model/Pedido.php';
require __DIR__ . '/../utils/CalculadoraPrecios.php';
require __DIR__ . '/../model/ProductoDAO.php';

session_start();

if (!isset($_SESSION['carrito_id'])) {
    $_SESSION['carrito_id'] = strtoupper(substr(bin2hex(random_bytes(5)), 0, 10));
}

if (isset($_SESSION['mostrarModalQR']) && $_SESSION['mostrarModalQR']) {
    // Limpiar la variable de sesión
    unset($_SESSION['mostrarModalQR']);
    
    // Establecer una variable de JavaScript para mostrar el modal
    echo '<script>let mostrarModalQR = true;</script>';
} else {
    // Establecer la variable de JavaScript como false si no se debe mostrar el modal
    echo '<script>let mostrarModalQR = false;</script>';
}

?>

<!DOCTYPE html PUBLIC>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Panel de compra</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/carrito.css" rel="stylesheet">
    <link href="../assets/css/header.css" rel="stylesheet">

    <link href="../assets/css/ventana_emergente.css" rel="stylesheet" type="text/css" media="screen">
    <link rel="stylesheet" type="text/css" href="../notie-master/dist/notie.css">

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php include('../views/header.php'); ?>

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
    <!--
    contenedor producto donde se veran los productos añadidos al carrito
    con sus detalles y cantidad. Tambien tendran botones para eliminar y añadir a favoritos.
    -->
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
    <!--
    contenedor resumen donde se mostraran opciones de compra y 
    el precio total mas el precio de envio que se tendra que pagar
    -->
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

            <p><span class="pre-text2">TOTAL</span> <span id="precioTotal" class="precio3"><?= number_format($subtotal + $precioEnvio, 2) ?>€</span></p>
            <hr class="linea">

            <form action="#" method="post" class="cupon-form">
                <div class="form-group">
                    <label for="cupon">Código de descuento</label>
                    <input type="text" class="form-control" id="cupon" placeholder="Introduce el código de cupón">
                </div>
                <button type="submit" class="btn btn-primary btn-cupon">APLICAR</button>
            </form>

            <hr class="linea2">
<!-- FORMULARIO PRINCIPAL PARA REALIZAR PEDIDO -->
            <hr class="linea3">
            <form action="../index.php?controller=producto&action=finalizarCompra" method="post">
                <input type="hidden" name="cantidadTotal" value="<?= $cantidadTotal ?>">
                <button type="submit" class="btn btn-primary btn-finalizar">FINALIZAR COMPRA</button>
            </form>
            <!-- Abrir modal de propinas -->
            <button type="button" class="btn-propina" data-bs-toggle="modal" data-bs-target="#modal-propinas">Añadir propina</button>
            <!-- Modal de las propinas -->
            <div id="modal-propinas" class="modal fade" tabindex="-1" aria-labelledby="propinasLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content m-contenido">
                        <div class="modal-cont">
                            <!-- Contenido del modal con opciones de propina -->
                            <label for="inputPropina">Selecciona la propina:</label>
                            <input type="number" id="inputPropina" min="1" max="100" value="3">
                            <input type="hidden" id="cantidadTotal" name="cantidadTotal" value="<?= $cantidadTotal ?>">

                            <button onclick="guardarPropina()" class="btn-guardar-p" data-bs-dismiss="modal">Guardar Propina</button>
                            <button type="button" class="btn-omitir-p" data-bs-dismiss="modal">Omitir Propina</button>
                        </div>
                    </div>
                </div>
            </div>        
            <!-- Modal que contiene la imagen qr generada -->
            <div id="modalQR" class="modal">
                <div class="modal-content">
                    <h2 class="tit-qr">Gracias por su compra!</h2>
                    <div id="contenedorQR"></div>
                    <button class="btn-modal" onclick="cerrarModal()">Cerrar</button>
                </div>
            </div>

            <!-- CREAR OTRO FORMULARIO PARA GESTIONAR PUNTOS -->
            <form id="form-compra" action="">
                <input type="hidden" id="cantidadTotal" name="cantidadTotal" value="<?= $cantidadTotal ?>">

                <div class="form-group form-puntos">
                    <label for="puntos-usuario">Utilizar puntos:</label>
                    <input type="number" id="puntos-usuario" name="puntos-usuario" min="0">
                </div>

                <div class="div-puntos">
                    <p><span class="pre-text3">Puntos actuales:</span>
                    <span id="puntos-actuales">0</span></p>
                </div>

                <button type="submit" class="btn btn-primary btn-puntos">USAR</button>
            </form>
        </div>
    </div>
</section>
<section>
    <p class="p-recomendados">Productos recomendados</p>
<!-- Seccion de productos recomendados -->
<!-- Los productos iran cambiando cada vez que se accede a la pagina de panelCompra -->
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
        echo '<form action="../index.php?controller=producto&action=recuperarPedido" method="post">';
        echo '<button type="submit" class="btn btn-primary rec-p" name="recuperar_pedido">Recuperar pedido</button>';
        echo '</form>';
    } else {//Si no se ha hecho ningun pedido o si no esta la sesion iniciada:
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
<!-- Script del programa de fidelidad, qr y propinas-->
<script src="../notie-master/dist/notie.js"></script>
<script src="../assets/js/qr.js"></script>
<script src="../assets/js/programaFidelidad.js"></script>
<script src="../assets/js/propinas.js"></script>
<!-- VENTANA EMERGENTE CARRITO -->
    <div id="ventana" class="cont-ventana" style="display: none;">
        <div class="div-ventana">
            <p class="mi-cesta">Mi cesta</p>
            <button id="btnFinalizarCompra">FINALIZAR COMPRA</button>
            <button id="btnContinuarComprando">CONTINUAR COMPRANDO</button>
        </div>
    </div>

    <div id="fondoOscuro"></div>

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
</body>
</html>