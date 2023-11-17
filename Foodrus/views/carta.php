<?php
require __DIR__ . '/../model/ProductoDAO.php';

//$totalProductos = count($pizza, $bebidas, $postres);
$pizzas = ProductoDAO::getAllProducts('pizza');
$bebidas = ProductoDAO::getAllProducts('bebida');
$postres = ProductoDAO::getAllProducts('postre');

$totalProductos = count($pizzas) + count($bebidas) + count($postres);
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
                <a class="nav-link" href="../index.php">Carta</a>
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
        </div>
      </nav>
  </header>

  <section>
    <h2 class="h2-carta">CARTA</h2>
    
    <h2 class="t-menu">MENU INFANTIL</h2>

    <div class="container">
      <h3 class="subtitulo">MINI PIZZAS</h3>
      <div class="productos-totales">
        <?= $totalProductos ?> productos encontrados
      </div>
      <div class="row">
        <?php
        $pizzasIds = [10, 9, 11, 2, 12, 3];
        $pizzas = ProductoDAO::getProductsByIds('pizza', $pizzasIds);

        foreach ($pizzas as $index => $pizza):
            $esNovedad = ($index % 2 == 1); 
        ?>
        
        <div class="col-md-4 card-container">
          <div class="card">
          <img src="../<?= $pizza->getImagen(); ?>" class="card-img-top img-fluid img-product">
            <div class="card-body">
              <?php if ($esNovedad) : ?>
                <p class="novedad">Novedad</p>
              <?php endif; ?>
              <h5 class="card-title titulo-producto"><?= $pizza->getNombre_producto(); ?></h5>
              <p class="card-text">
                <span class="precio"><?= $pizza->getPrecio(); ?> €</span>
                <svg class="carro" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                    <path class="carro-color" d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/>
                </svg>
              </p>
            </div>
          </div>
        </div>
        <?php
        endforeach; 
        ?>
      </div>
      <h3 class="subtitulo">BEBIDAS</h3>
      <div class="row">
        <?php
        $bebidasIds = [4, 6, 8, 20, 21, 22];
        $bebidas = ProductoDAO::getProductsByIds('bebida', $bebidasIds);

        foreach ($bebidas as $index => $bebida):
            $esNovedad = ($index % 2 == 1);
        ?>

        <div class="col-md-4 card-container">
          <div class="card">
            <img src="../<?= $bebida->getImagen(); ?>" class="card-img-top img-fluid img-product">
            <div class="card-body">
              <?php if ($esNovedad) : ?>
                <p class="novedad">Novedad</p>
              <?php endif; ?>
              <h5 class="card-title titulo-producto"><?= $bebida->getNombre_producto(); ?></h5>
              <p class="card-text">
                <span class="precio"><?= $bebida->getPrecio(); ?> €</span>
                <svg class="carro" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                    <path class="carro-color" d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/>
                </svg>
              </p>
            </div>
          </div>
        </div>
        <?php
        endforeach;
        ?>
      </div>
      <h3 class="subtitulo">POSTRES</h3>
      <div class="row">
        <?php
        $postresIds = [23, 24, 25];
        $postres = ProductoDAO::getProductsByIds('postre', $postresIds);

        foreach ($postres as $postre):
        ?>

        <div class="col-md-4 card-container">
          <div class="card">
            <img src="../<?= $postre->getImagen(); ?>" class="card-img-top img-fluid img-product">
            <div class="card-body">
              <p class="novedad">Novedad</p>
              <h5 class="card-title titulo-producto"><?= $postre->getNombre_producto(); ?></h5>
              <p class="card-text">
                <span class="precio"><?= $postre->getPrecio(); ?> €</span>
                <svg class="carro" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                    <path class="carro-color" d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/>
                </svg>
              </p>
            </div>
          </div>
        </div>
        <?php
        endforeach;
        ?>
      </div>
    </div>
  </section>

  <footer>
    
  </footer>
</body>
</html>