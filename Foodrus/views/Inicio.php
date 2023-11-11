<!DOCTYPE html PUBLIC>
<html>
<head>
    <title>Platilla de bootstrapp</title>

    <meta charset="UTF-8">
    <meta name="description" content="Descripció web">
    <meta name="keywords" content="Paraules clau">
    <meta name="author" content="Autor">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/full_estil.css" rel="stylesheet" type="text/css" media="screen">

</head>

<body>

   <header>
    <nav class="navbar navbar-expand-lg" style="background-color: #1450A0;">
        <div class="container">
          <a class="navbar-brand" href="#">Navbar</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Inicio</a>
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

<main>
    <section>
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active sliderbg">
              <img src="../assets/images/carrusel1.png" class="d-block w-100" alt="Imagen1"/>
            </div>
            <div class="carousel-item sliderbg">
                <img src="../assets/images/carrusel2.png" class="d-block w-100" alt="Imagen2"/>
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


    <section>
        <h2 class="h2-inicio">Menús</h2>

        <div class="container">
          <div class="row">
            <div class="col-4">
              <div class="button-container text-center">
                <button type="button" class="btn btn-primary btn-custom b1 b-text">INFANTIL</button>
              </div>
            </div>
            <div class="col-4">
              <div class="button-container text-center">
                <button type="button" class="btn btn-primary btn-custom b-text">ESTANDAR</button>
              </div>
            </div>
            <div class="col-4">
              <div class="button-container text-center">
                <button type="button" class="btn btn-primary btn-custom b2 b-text">TEMPORAL</button>
              </div>
            </div>
          </div>
        </div>

    </section>

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

    <section>

        <div class=" container-fluid p-0 container text-center container-sec">
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

    <section class="ultProductos">
      <h3 class="ult-product">Ultimos productos visitados</h3>
      <div class="container">
        <div class="row">
            <div class="col">
                <div class="card" style="width: 18 rem; height: 250px;">
                    <img src="" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Pepperoni</h5>
                        <p class="card-text">13,00 €</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="width: 18 rem; height: 250px;">
                    <img src="" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Margarita</h5>
                        <p class="card-text">12,00 €</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="width: 18 rem; height: 250px;">
                    <img src="" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Batido platano</h5>
                        <p class="card-text">3,00 €</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="width: 18 rem; height: 250px;">
                    <img src="" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Tropical</h5>
                        <p class="card-text">13,00 €</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>

</main>

<footer>

    <div class="container-fluid margin">

      <div class="row p-5 pb-2 bg-custom text-white">
          <div class="col-md-2">
              <p class="p-foot">MEDIOS DE PAGO</p>
              <div class="mb-2">
                <div class="d-flex align-items-center">
                  <div class="p-2">
                    <img src="../assets/images/visaIcon.png" class="align-middle">
                  </div>
                  <div class="p-2">
                    <img src="../assets/images/MastercardIcon.png" class="align-middle">
                  </div>
                  <div class="p-2">
                    <img src="../assets/images/paypalIcon.png" class="align-middle">
                  </div>
                </div>
              </div>
          </div>

          <div class="col-md-2 offset-md-4">
              <p class="p-foot">Newsletter:</p>
              <div class="mb-2">
                <form>
                  <div class="input-group">
                    <input type="text" class="custom-input" id="gmail" placeholder="Escribe tu correo">
                  </div> 
                </form>
              </div>
          </div>
      </div>

      <div class="row p-5 pb-2 bg-custom text-white">
        <div class="col-md-3">
            <p class="p-foot">DESCARGA NUESTRA APP</p>
            <div class="mb-2 d-flex align-items-center">
                <div class="p-2">
                    <img src="../assets/images/google-play-es.svg" class="align-middle">
                </div>
                <div class="p-2">
                    <img src="../assets/images/app-store-es.svg" class="align-middle">
                </div>
            </div>
        </div>
      </div>

      <div class="row p-5 pb-2 bg-custom text-white">
          <div class="col-md-2">
              <p class="p-foot">AYUDA</p>
              <div class="mb-2 f-a">
                <a class="text-white text-decoration-none" href="#">Contacto</a> 
              </div>
              <div class="mb-2 f-a">
                <a class="text-white text-decoration-none" href="#">Opciones de entrega y costes</a> 
              </div>
              <div class="mb-2 f-a">
                <a class="text-white text-decoration-none" href="#">Metodos de pago</a> 
              </div>
              <div class="mb-2 f-a">
                <a class="text-white text-decoration-none" href="#">Promociones</a> 
              </div>
          </div>
          <div class="col-md-2">
              <p class="p-foot">SERVICIOS</p>
              <div class="mb-2 f-a">
                <a class="text-white text-decoration-none" href="#">Precio minimo garantizado</a> 
              </div>
              <div class="mb-2 f-a">
                <a class="text-white text-decoration-none" href="#">Tarjeta regalo digital</a> 
              </div>
              <div class="mb-2 f-a">
                <a class="text-white text-decoration-none" href="#">Devoluciones y garantias</a> 
              </div>
              <div class="mb-2 f-a">
                <a class="text-white text-decoration-none" href="#">Envio premium</a> 
              </div>
          </div>
          <div class="col-md-2">
              <p class="p-foot">EMPRESA</p>
              <div class="mb-2 f-a">
                <a class="text-white text-decoration-none" href="#">Historia</a> 
              </div>
              <div class="mb-2 f-a">
                <a class="text-white text-decoration-none" href="#">Tiendas</a> 
              </div>
              <div class="mb-2 f-a">
                <a class="text-white text-decoration-none" href="#">Empleo</a> 
              </div>
              <div class="mb-2 f-a">
                <a class="text-white text-decoration-none" href="#">Afiliados</a> 
              </div>
          </div>
          <div class="col-md-2">
              <p class="p-foot">OTROS</p>
              <div class="mb-2 f-a">
                <a class="text-white text-decoration-none" href="#">Condiciones de compra</a> 
              </div>
              <div class="mb-2 f-a">
                <a class="text-white text-decoration-none" href="#">Politica de privacidad</a> 
              </div>
              <div class="mb-2 f-a">
                <a class="text-white text-decoration-none" href="#">Politica de cookies</a> 
              </div>
              <div class="mb-2 f-a">
                <a class="text-white text-decoration-none" href="#">Eventos</a> 
              </div>
          </div>
          <div class="col-md-2">
              <p class="p-foot">Siguenos</p>
          </div>
      </div>
      <div class="row bg-secondary"> 
        <div class="col-xs-12 pt-3 copyright">
            <p class="text-white text-center">&copy;2022 PRENATAL RETAIL GROUP SPAIN S.L.U.</P>
        </div>
    </div>
</footer>

</body>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

</html>
