<?php
require_once __DIR__ . '/../model/ProductoDAO.php';

if (isset($_SESSION['user_email'])){
    $rol = ProductoDAO::obtenerRolUsuario($_SESSION['user_email']);

    $esAdmin = ($rol == 'administrador');
}

?>

<!DOCTYPE html PUBLIC>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis pedidos</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link href="/Foodrus/assets/css/mis_pedidos.css" rel="stylesheet" type="text/css" media="screen">

    <link href="/Foodrus/assets/css/header.css" rel="stylesheet" type="text/css" media="screen">
    <link href="/Foodrus/assets/css/ventana_emergente.css" rel="stylesheet" type="text/css" media="screen">
    <link rel="stylesheet" type="text/css" href="/Foodrus/notie-master/dist/notie.css">

    <script src="/Foodrus/assets/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <?php include('header.php'); ?>
    
    <section class="pedidos">
        <?php if (isset($esAdmin) && $esAdmin) : ?>
            <h2 class="mispedidos">Todos los pedidos realizados</h2>
        <?php else : ?>
            <h2 class="mispedidos">Mis pedidos</h2>
        <?php endif; ?>

        <table class="table table-bordered table-striped">
            <tr>
                <th scope="col">Num Pedido</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Estado</th>
                <th scope="col">Fecha pedido</th>
                <th scope="col">Acciones</th>
                <th scope="col"></th>
            </tr>
            <?php foreach ($pedidos as $pedido) : ?>
                <tr>
                    <td><?= $pedido->getPedido_id(); ?></td>
                    <td>€<?= $pedido->getCantidad(); ?></td>
                    <td><?= $pedido->getEstado(); ?></td>
                    <td><?= $pedido->getFecha_pedido(); ?></td>
                    <td>
                        <?php if ($rol == 'administrador') : ?>
                            <form action="index.php?controller=usuario&action=finalizarPedido" method="post">
                                <input type="hidden" name="pedido_id" value="<?= $pedido->getPedido_id(); ?>">
                                <input type="hidden" name="nuevo_estado" value="entregado">
                                <button type="submit" class="btn btn-success">Finalizado</button>
                            </form>
                        <?php else: ?>
                            <form action="index.php?controller=usuario&action=eliminarPedido" method="post">
                                <input type="hidden" name="pedido_id" value="<?= $pedido->getPedido_id(); ?>">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        <?php endif; ?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-secondary ver-detalles" data-bs-toggle="modal" data-bs-target="#detallesModal-<?= $pedido->getPedido_id(); ?>">Ver Detalles</button>
                    </td>
                </tr>
    <!-- VENTANA DETALLES PEDIDO -->
                <div class="modal fade" id="detallesModal-<?= $pedido->getPedido_id(); ?>" tabindex="-1" role="dialog" aria-labelledby="detallesModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detallesModalLabel">Detalles del Pedido <?= $pedido->getPedido_id(); ?></h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php
                                // Obtener los detalles de los productos para este pedido
                                $detallesProductos = ProductoDAO::obtenerDetallesProductos($pedido->getPedido_id());

                                // Mostrar los detalles en una lista
                                echo '<ul>';
                                foreach ($detallesProductos as $detalle) {
                                    echo '<li>' . $detalle['nombre_producto'] . ' - Cantidad: ' . $detalle['cantidad'] . '</li>';
                                }
                                echo '</ul>';
                                ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </table>
    </section>
    <h3 class="h3-reseña">Deja tu reseña</h3>
        <form id="form-reseñas" action="">
            <div class="form-group">
                <label for="pedido_id">ID del Pedido</label>
                <input type="text" id="pedido_id" name="pedido_id" class="form-control input-pedido" required>
            </div>
            <div class="form-group">
                <label for="comentario">Comentario</label>
                <textarea class="form-control label-form" id="comentario" name="comentario" required></textarea>
            </div>
            <div class="form-group">
                <label for="puntuacion">Puntuacion</label>
                <input type="number" id="puntuacion" name="puntuacion" min="1" max="5" required>
            </div>
            <button type="submit" class="btn-enviar">Enviar</button>
        </form>                            
<footer>
    <div class="container-fluid p-5 text-white bg-custom">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-3">
                <!-- Iconos de redes sociales -->
                <a href="#" class="text-white"><img src="/Foodrus/img/red1.png" alt="Imagen 1"></a>
                <a href="#" class="text-white"><img src="/Foodrus/img/red2.png" alt="Imagen 2"></a>
                <a href="#" class="text-white"><img src="/Foodrus/img/red3.png" alt="Imagen 3"></a>
                <a href="#" class="text-white"><img src="/Foodrus/img/red4.png" alt="Imagen 4"></a>
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

<script src="/Foodrus/notie-master/dist/notie.js"></script>
<script src="/Foodrus/assets/js/reseñas.js"></script>

<div id="ventana" class="cont-ventana" style="display: none;">
    <div class="div-ventana">
        <p class="mi-cesta">Mi cesta</p>
        <button id="btnFinalizarCompra">FINALIZAR COMPRA</button>
        <button id="btnContinuarComprando">CONTINUAR COMPRANDO</button>
    </div>
</div>

<div id="fondoOscuro"></div>

<script src="/Foodrus/assets/js/ventana.js" defer></script>

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