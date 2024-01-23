<!DOCTYPE html PUBLIC>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar datos</title>
    <link href="/Foodrus/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/Foodrus/assets/css/editarUsuario.css" rel="stylesheet" type="text/css" media="screen">

    <link href="/Foodrus/assets/css/header.css" rel="stylesheet">
    <link href="/Foodrus/assets/css/ventana_emergente.css" rel="stylesheet" type="text/css" media="screen">

    <script src="/Foodrus/assets/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php include('header.php'); ?>

    <div class="principal">
        <h2 class="titulo">Datos Personales</h2>
        <hr class="linea">

        <form action="index.php?controller=usuario&action=actualizar" method="post">
            <input type="hidden" name="id" value="<?= $usuario->getCliente_id()?>">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control label-form" id="nombre" name="nombre" value="<?= $usuario->getNombre(); ?>" required>
            </div>
            <div class="form-group">
                <label for="apell">Apellidos</label>
                <input type="text" class="form-control label-form" id="apell" name="apell" value="<?= $usuario->getApellidos(); ?>" required>
            </div>
            <div class="form-group">
                <label for="tel">Numero de telefono:</label>
                <input type="number" class="form-control label-form" id="tel" name="tel" value="<?= $usuario->getTelefono(); ?>" required>
            </div>
            <div class="form-group">
                <label for="mail">Correo electrónico</label>
                <input type="email" class="form-control label-form" id="mail" name="mail" value="<?= $usuario->getEmail(); ?>" required>
            </div>
            <div class="form-group">
                <label for="passwd">Contraseña:</label>
                <input type="password" class="form-control label-form" id="passwd" name="passwd" value="<?= $usuario->getPassword(); ?>" required>
            </div>

            <a href="index.php?controller=usuario&action=cancelar" class="btn btn-secondary btn-cancelar">CANCELAR</a>
            <button type="submit" name="act-datos" class="btn btn-act">ACTUALIZAR</button>
        </form>
    </div>

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

<div id="ventana" style="display: none;">
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