<?php
require_once __DIR__ . '/../model/Pizza.php';
require_once __DIR__ . '/../model/Bebida.php';
require_once __DIR__ . '/../model/Postre.php';

require_once __DIR__ . '/../model/ProductoDAO.php';

session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link href="/Foodrus/assets/css/admin_productos.css" rel="stylesheet" type="text/css" media="screen">

    <script src="/Foodrus/assets/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<header id="mi-header">
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1450A0;">
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
            <form class="d-flex ms-auto" role="search">
                <input class="form-control me-2 custom-search" type="search" placeholder="Busca aqui algo divertido">
                <img src="/Foodrus/img/lupa.png" width="20" height="20" class="img-lupa">
            </form>

            <!-- mi cuenta, ubicacion y carta -->
            <ul class="navbar-nav me-2">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <img src="/Foodrus/img/storeFinder.svg" alt="ubicacion" class="ubicacion">
                    </a>
                </li>
                <li class="nav-item">
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
                                <button type="submit" class="dropdown-item salir" name="cerrar_sesion">Salir</button>
                            </form>
                        </li>
                        <li>
                            <form action="/Foodrus/index.php?controller=usuario&action=mostrarPedidos" method="post">
                                <button type="submit" class="dropdown-item mis-pedidos" name="mis-pedidos">Mis pedidos</button>
                            </form>
                        </li>
                        <li>
                            <form action="/Foodrus/index.php?controller=usuario=editarUsuario" method="post">
                                <button type="submit" class="dropdown-item mod-usuario" name="mod-usuario">Detalles de la cuenta</button>
                            </form>
                        </li>
                        <!-- PANEL ADMINISTRADOR -->
                        <?php
                        $rol = ProductoDAO::obtenerRolUsuario($_SESSION['user_email']);
                        if ($rol == 'administrador'){
                        ?>
                            <li>
                                <a href="/Foodrus/index.php?controller=producto&action=index" class="dropdown-item admin-productos" name="ad-product">Productos</a>
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
                <li class="nav-item">
                    <a href="/Foodrus/views/carta.php" class="nav-link text-white carta">Carta</a>
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
<h2 class="titulo-p">Productos FoodRus</h2>
    <table class="table table-bordered table-striped">
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Precio</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Categoria</th>
            <th scope="col">Imagen</th>
            <th scope="col"></th>
        </tr>
        <!-- Pizzas -->
        <?php foreach ($pizzas as $pizza): ?>
            <tr>
                <td><?= $pizza->getNombre_producto(); ?></td>
                <td>$<?= $pizza->getPrecio(); ?></td>
                <td><?= $pizza->getDescripcion(); ?></td>
                <td><?= $pizza->getCategoria(); ?></td>
                <td><img src="<?= $pizza->getImagen(); ?>" width="50" height="50"></td>
                <td>
                    <div class="row">
                        <div class="col">
                            <form action="index.php?controller=producto&action=eliminar" method="post">
                                <input type="hidden" name="producto_id" value="<?= $pizza->getProducto_id(); ?>">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                        <div class="col">
                            <form action="index.php?controller=producto&action=editar" method="post">
                                <input type="hidden" name="id" value="<?= $pizza->getProducto_id()?>">
                                <input type="hidden" name="almacen" value="<?= $pizza->getAlmacen()?>">
                                <input type="hidden" name="nombre" value="<?= $pizza->getNombre_producto()?>">
                                <input type="hidden" name="descripcion" value="<?= $pizza->getDescripcion()?>">
                                <input type="hidden" name="precio" value="<?= $pizza->getPrecio()?>">
                                <input type="hidden" name="categoria" value="<?= $pizza->getCategoria()?>">
                                <input type="hidden" name="imagen" value="<?= $pizza->getImagen()?>">
                                <button type="submit" class="btn btn-warning">Modificar</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
<!-- Bebidas -->
        <?php foreach ($bebidas as $bebida): ?>
            <tr>
                <td><?= $bebida->getNombre_producto(); ?></td>
                <td>$<?= $bebida->getPrecio(); ?></td>
                <td><?= $bebida->getDescripcion(); ?></td>
                <td><?= $bebida->getCategoria(); ?></td>
                <td><img src="<?= $bebida->getImagen(); ?>" width="50" height="50"></td>
                <td>
                    <div class="row">
                        <div class="col">
                            <form action="index.php?controller=producto&action=eliminar" method="post">
                                <input type="hidden" name="producto_id" value="<?= $bebida->getProducto_id(); ?>">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                        <div class="col">
                            <form action="index.php?controller=producto&action=editar" method="post">
                                <input type="hidden" name="id" value="<?= $bebida->getProducto_id()?>">
                                <input type="hidden" name="almacen" value="<?= $bebida->getAlmacen()?>">
                                <input type="hidden" name="nombre" value="<?= $bebida->getNombre_producto()?>">
                                <input type="hidden" name="descripcion" value="<?= $bebida->getDescripcion()?>">
                                <input type="hidden" name="precio" value="<?= $bebida->getPrecio()?>">
                                <input type="hidden" name="categoria" value="<?= $bebida->getCategoria()?>">
                                <input type="hidden" name="imagen" value="<?= $bebida->getImagen()?>">
                                <button type="submit" class="btn btn-warning">Modificar</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
<!-- Postres -->
        <?php foreach ($postres as $postre): ?>
            <tr>
                <td><?= $postre->getNombre_producto(); ?></td>
                <td>$<?= $postre->getPrecio(); ?></td>
                <td><?= $postre->getDescripcion(); ?></td>
                <td><?= $postre->getCategoria(); ?></td> 
                <td><img src="<?= $postre->getImagen(); ?>" width="50" height="50"></td>
                <td>
                    <div class="row">
                        <div class="col">
                            <form action="index.php?controller=producto&action=eliminar" method="post">
                                <input type="hidden" name="producto_id" value="<?= $postre->getProducto_id(); ?>">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                        <div class="col">
                            <form action="index.php?controller=producto&action=editar" method="post">
                                <input type="hidden" name="id" value="<?= $postre->getProducto_id()?>">
                                <input type="hidden" name="almacen" value="<?= $postre->getAlmacen()?>">
                                <input type="hidden" name="nombre" value="<?= $postre->getNombre_producto()?>">
                                <input type="hidden" name="descripcion" value="<?= $postre->getDescripcion()?>">
                                <input type="hidden" name="precio" value="<?= $postre->getPrecio()?>">
                                <input type="hidden" name="categoria" value="<?= $postre->getCategoria()?>">
                                <input type="hidden" name="imagen" value="<?= $postre->getImagen()?>">
                                <button type="submit" class="btn btn-warning">Modificar</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <!-- Añadir producto --> 
    <button id="mostrarFormulario" class="btn btn-primary">Añadir producto</button>

    <div id="formulario" style="display: none;">
            <form action="index.php?controller=producto&action=añadir" method="POST" enctype="multipart/form-data">
                <h3>Añadir producto nuevo</h3>
                <label for="id">ID:</label>
                <input type="number" name="id" required><br><br>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" required><br><br>
                <label for="imagen">Imagen:</label>
                <input type="file" name="imagen" accept="image/*"><br><br>
                <label for="precio">Precio:</label>
                <input type="number" name="precio" required><br><br>
                <label for="descripcion">Descripción:</label>
                <input type="text" name="descripcion" required><br><br>
                <label for="categoria">Categoría:</label>
                <select name="categoria" required><br><br>
                    <option value="pizza">Pizza</option>
                    <option value="bebida">Bebida</option>
                    <option value="postre">Postre</option>
                </select>
                <button type="submit" name="agregarProducto" class="btn btn-success">Añadir Producto</button>
            </form>
    </div>

    <script>
        document.getElementById("mostrarFormulario").addEventListener("click", function() {
            let formulario = document.getElementById("formulario");
            if (formulario.style.display === "none") {
                formulario.style.display = "block";
            } else {
                formulario.style.display = "none";
            }
        });
    </script>

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
</body>
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
</html>