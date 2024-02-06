<?php
require_once __DIR__ . '/../model/ProductoDAO.php';

//$totalProductos = count($pizza, $bebidas, $postres);
$pizzas = ProductoDAO::getAllProducts('pizza');
$bebidas = ProductoDAO::getAllProducts('bebida');
$postres = ProductoDAO::getAllProducts('postre');

$totalProductos = count($pizzas) + count($bebidas) + count($postres);

session_start();

/*if (isset($_SESSION['mostrarModal']) && $_SESSION['mostrarModal']) {
    // Establecer sessionStorage para indicar que se debe mostrar el modal
    echo '<script>sessionStorage.setItem("mostrarModal", "true");</script>';
    // Limpiar la variable de sesión
    unset($_SESSION['mostrarModal']);
}*/
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
    <link href="../assets/css/header.css" rel="stylesheet" type="text/css" media="screen">

    <link href="../assets/css/ventana_emergente.css" rel="stylesheet" type="text/css" media="screen">
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    
</head>
<body>

<?php include('../views/header.php'); ?>

<section>

    <div id="filtros">
        <label><input type="checkbox" class="filtro-categoria" value="pizza"> Pizza</label><br>
        <label><input type="checkbox" class="filtro-categoria" value="bebida"> Bebida</label><br>
        <label><input type="checkbox" class="filtro-categoria" value="postre"> Postre</label><br>
    </div>

    <h2 class="h2-carta">CARTA</h2>
    <!-- MENU INFANTIL -->
    <h2 id="infantil" class="t-menu">MENU INFANTIL</h2>

    <div class="container">
    <div class="productos-totales">
        <?= $totalProductos ?> productos encontrados
    </div>
<!-- recogemos las ids de los productos correspondientes -->
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
<!-- Haciendo uso de la variable $tarjetasPorFila nos aseguramos de que las tarjetas -->
<!-- esten en filas de 4. Luego usando un foreach recorremos el array de $productos -->
<!-- que contiene todas las ids de los productos de esta seccion y aplicamos la clase special-card -->
<!-- a las tarjetas impares.-->
            <div class="col-md-3 card-container <?= $specialClass ?> <?= $producto->getCategoria(); ?>">
                <div class="card">
                    <img src="../<?= $producto->getImagen(); ?>" class="card-img-top img-fluid img-product" alt="<?= $producto->getNombre_producto(); ?>">
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

    <h2 id="estandar" class="t-menu t-estandar">MENU ESTANDAR</h2>
<!-- MENU ESTANDAR -->
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

            <div class="col-md-3 card-container <?= $specialClass ?> <?= $producto2->getCategoria(); ?>">
                <div class="card">
                    <img src="../<?= $producto2->getImagen(); ?>" class="card-img-top img-fluid img-product" alt="<?= $producto2->getNombre_producto(); ?>">
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
    </div>

    <h2 id="temporal" class="t-menu-temporal">MENU TEMPORAL</h2>
<!-- MENU TEMPORAL -->
    <div class="container">
        <div class="row tarjetas">
            <?php
            $pizzasIds3 = [29, 30];
            $pizzas3 = ProductoDAO::getProductsByIds('pizza', $pizzasIds3);                

            $postresIds3 = [31];
            $postres3 = ProductoDAO::getProductsByIds('postre', $postresIds3);

            $productos3 = array_merge($pizzas3, $postres3);

            $tarjetasPorFila = 0;

            foreach ($productos3 as $index => $producto3):
            ?>
                <?php if ($tarjetasPorFila % 4 == 0): ?>
                    </div><div class="row tarjetas">
                <?php endif; ?>

                <div class="col-md-3 card-container special-card2 <?= $producto3->getCategoria(); ?>">
                    <div class="card">
                        <img src="../<?= $producto3->getImagen(); ?>" class="card-img-top img-fluid img-product" alt="<?= $producto3->getNombre_producto(); ?>">
                        <div class="card-body">
                                <p class="exclusivo">Exclusivo</p>
                            <h5 class="card-title titulo-producto"><?= $producto3->getNombre_producto(); ?></h5>
                            <p class="card-text">
                                <span class="precio"><?= $producto3->getPrecio(); ?> €</span>
                                <form action="../index.php?controller=producto&action=sel" method="post">
                                    <input type="hidden" name="id" value="<?= $producto3->getProducto_id(); ?>">
                                    <input type="hidden" name="categoria" value="<?= $producto3->getCategoria(); ?>">
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
<script src="../assets/js/filtroProductos.js"></script>
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
    <div id="ventana" class="cont-ventana" style="display: none;">
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