<?php
require_once __DIR__ . '/../model/ProductoDAO.php';

session_start();
?>

<!DOCTYPE html PUBLIC>
<html>
<head>
    <title>Platilla de bootstrapp</title>

    <meta charset="UTF-8">
    <meta name="description" content="Descripció web">
    <meta name="keywords" content="Restaurante Foodrus">
    <meta name="author" content="Andreu">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/full_estil.css" rel="stylesheet" type="text/css" media="screen">

    <link href="../assets/css/header.css" rel="stylesheet" type="text/css" media="screen">
    <link href="../assets/css/ventana_emergente.css" rel="stylesheet" type="text/css" media="screen">

    <script src="../assets/js/bootstrap.bundle.min.js"></script>

</head>
<body>

  <?php include('../views/header.php'); ?>

<main>
<section><!-- CARRUSEL -->
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active sliderbg">
              <img src="../assets/images/cafeteria1.webp" class="d-block w-100" alt="Imagen1"/>
            </div>
            <div class="carousel-item sliderbg">
                <img src="../assets/images/carrusel2.webp" class="d-block w-100" alt="Imagen2"/>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" ariahidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<!-- SECCION 1 -->
    <section>
        <h2 class="h2-inicio">Menús</h2>

        <div class="container">
          <div class="row">
            <div class="col-4">
              <div class="button-container text-center">
                <a href="carta.php#infantil" class="btn btn-primary btn-custom b1 b-text">INFANTIL</a>
              </div>
            </div>
            <div class="col-4">
              <div class="button-container text-center">
                <a href="carta.php#estandar" class="btn btn-primary btn-custom b-text">ESTANDAR</a>
              </div>
            </div>
            <div class="col-4">
              <div class="button-container text-center">
                <a href="carta.php#temporal" class="btn btn-primary btn-custom b2 b-text">TEMPORAL</a>
              </div>
            </div>
          </div>
        </div>

    </section>
<!-- SECCION 2 CATEGORIAS PRODUCTOS -->
    <section>
    <h2 class="h2-inicio">Categorías</h2>

    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="button-container text-center">
                    <button type="button" class="btn btn-primary btn-custom b1">
                        <img src="../assets/images/categoria1.png" alt="Categoría 1" width="120", height="65">
                    </button>
                </div>
            </div>
            <div class="col-4">
                <div class="button-container text-center">
                    <button type="button" class="btn btn-primary btn-custom">
                        <img src="../assets/images/categoria2.png" alt="Categoría 2" width="120", height="65">
                    </button>
                </div>
            </div>
            <div class="col-4">
                <div class="button-container text-center">
                    <button type="button" class="btn btn-primary btn-custom b2">
                        <img src="../assets/images/categoria3.png" alt="Categoría 3" width="120", height="65">
                    </button>
                </div>
            </div>
        </div>
    </div>


    </section>
<!-- SECCION 3 INFORMACION SOBRE EL SERVICIO DE LA PAGINA -->
    <section>

        <div class=" container-fluid text-center container-sec">
          <div class="row">
            <div class="col-xs-12 col-sm-3">
              <img src="../assets/images/punto_recogida.png">
              <p class="parraf">Punto de recogida</p>
              <p class="parraf2">Enviamos tu pedido al punto de recogida que elijas</p>
            </div>
            <div class="col-xs-12 col-sm-3">
              <img src="../assets/images/click_and_collect.png">
              <p class="parraf">Click & Collect</p>
              <p class="parraf2">Compra online y recoge en tu tienda mas cercana</p>
            </div>
            <div class="col-xs-12 col-sm-3">
              <img src="../assets/images/entregas3horas.png">
              <p class="parraf">Envio en 3 horas</p>
              <p class="parraf2">Creemos que lo unico por lo que tendriamos que tener prisa es por jugar</p>
            </div>
            <div class="col-xs-12 col-sm-3">
              <img src="../assets/images/devoluciones.png">
              <p class="parraf">Devolucion gratis</p>
              <p class="parraf2">¿No te gusto lo que compraste? Sin problema</p>
            </div>
          </div>
        </div>

    </section>
    <?php
    $productosParaMostrar = [
      ['id' => 2, 'categoria' => 'pizza'],
      ['id' => 9, 'categoria' => 'pizza'],
      ['id' => 21, 'categoria' => 'bebida'],
      ['id' => 3, 'categoria' => 'pizza'],
    ];

    $productos = [];

    foreach ($productosParaMostrar as $productoInfo) {
      $id = $productoInfo['id'];
      $categoria = $productoInfo['categoria'];
  
      $producto = ProductoDAO::getProductsByIds($categoria, [$id]);
  
      if ($producto) {
          $productos[] = $producto[0]; 
      }
    }
    ?><!-- SECCION 4 ULTIMOS PRODUCTOS VISITADOS -->
    <section class="ultProductos">
      <h3 class="ult-product">Ultimos productos visitados</h3>
      <div class="container">
        <div class="row">
            <?php
            foreach ($productos as $producto){
            ?>
              <div class="col-md-3 mb-4">
                  <div class="card" id="product-<?= $producto->getProducto_id(); ?>" style="width: 18rem; height: 250px;">
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
      </div>
    </section>

</main>

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
