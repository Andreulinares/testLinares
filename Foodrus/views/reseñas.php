<?php
require_once __DIR__ . '/../model/ProductoDAO.php';
require __DIR__ . '/../controller/APIController.php';
session_start();
?>

<!DOCTYPE html PUBLIC>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reseñas</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/formulario_reseñas.css" rel="stylesheet" type="text/css" media="screen">

    <link href="../assets/css/header.css" rel="stylesheet" type="text/css" media="screen">
    <link href="../assets/css/ventana_emergente.css" rel="stylesheet" type="text/css" media="screen">
    <link rel="stylesheet" type="text/css" href="../notie-master/dist/notie.css">

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php include('../views/header.php'); ?>
<section>
    <h3 class="h3-reseña">Deja tu reseña</h3>
        <form id="form-reseñas" action="">
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

    <h2 class="h2-reseña">Reseñas de los clientes</h2>

    <div class="filtro-reseñas">
            <label for="filtro-nota">Filtrar por Nota:</label>
            <select id="filtro-nota">
                <option value="0">Mostrar Todas</option>
                <option value="1">1 estrella</option>
                <option value="2">2 estrellas</option>
                <option value="3">3 estrellas</option>
                <option value="4">4 estrellas</option>
                <option value="5">5 estrellas</option>
            </select>
    </div>
    <div class="filtro-ordenar">
        <label for="filtro-orden">Ordenar por:</label>
        <select id="filtro-orden">
            <option value="asc">Ascendente</option>
            <option value="desc">Descendente</option>
        </select>
    </div>

    <div id="reseñas-container"></div>
</section>
<!-- SCRIPTS RESEÑAS Y NOTIE.JS -->
<script src="../notie-master/dist/notie.js"></script>
<script src="../assets/js/reseñas.js"></script>
<!-- VENTANA CARRITO -->

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