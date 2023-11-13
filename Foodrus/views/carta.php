<?php
require __DIR__ . '/../model/ProductoDAO.php';

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
          <a class="navbar-brand" href="#">Navbar</a>
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
      <div class="row">
        <?php
        $pizzasIds = [10, 9, 11, 2, 12, 3];
        $pizzas = ProductoDAO::getProductsByIds('pizza', $pizzasIds);

        foreach ($pizzas as $pizza): 
        ?>
        
        <div class="col-md-4 card-container">
          <div class="card">
            <img src="<?= $pizza->getImagen(); ?>" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title"><?= $pizza->getNombre_producto(); ?></h5>
              <p class="card-text">
                <?= $pizza->getPrecio(); ?> €
                <img src="../img/cart3.svg" alt="carro" class="carro">
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

        foreach ($bebidas as $bebida):
        ?>

        <div class="col-md-4 card-container">
          <div class="card">
            <img src="<?= $bebida->getImagen(); ?>" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title"><?= $bebida->getNombre_producto(); ?></h5>
              <p class="card-text">
                <?= $bebida->getPrecio(); ?> €
                <img src="../img/cart3.svg" alt="carro" class="carro">
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
</body>
</html>