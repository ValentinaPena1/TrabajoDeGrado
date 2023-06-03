<?php
// Código PHP aquí
?>

<!DOCTYPE html>
<html>
<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>LudoAprende</title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700|Roboto:400,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
</head>


<body>
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.php">
            <span>
              <img src="images/Logo.jpeg">
            </span>
          </a>
          <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex mx-auto flex-column flex-lg-row align-items-center">
              <ul class="navbar-nav  ">
                <li class="nav-item">
                  <a class="nav-link" href="index.php">Inicio </a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="juegos.php"> Juegos <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="equipo.html"> Equipo de trabajo </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="Estadisticas.html"> Estadisticas </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="FAQ.html"> Preguntas Frecuentes </a>
                </li>
              </ul>
              <div class="dropdown">
              <?php




?>


  <a class="nav-link dropdown-toggle" href="#" id="perfilDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Ver perfil
  </a>
  <div class="dropdown-menu" aria-labelledby="perfilDropdown">
    <a class="dropdown-item" href="perfil.php">Ver perfil</a>
    <a class="dropdown-item" href="usuario-historial.php">Historial</a>
    <a class="dropdown-item" href="agregar_rol.php">roles</a>
    <a class="dropdown-item" href="login.php">Cerrar Sesión</a>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('.dropdown').hover(
      function() {
        $(this).addClass('show');
        $(this).find('.dropdown-menu').addClass('show');
      },
      function() {
        $(this).removeClass('show');
        $(this).find('.dropdown-menu').removeClass('show');
      }
    );
  });
</script>


            </div>
          </div>
          <form class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">
            <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
          </form>
        </nav>
      </div>
    </header>
    <!-- end header section -->
  </div>

  <!-- about section -->
  <section class=" slider_section position-relative">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="slider_item-box layout_padding2">
            <div class="container">
              <img src="images/luna.png">
              <div class="row">
                <div class="col-md-6">
                  <div class="detail-box">

                    <div>

                    <h1>
    ¡Hola <?php  ?>!<br>
    <div class="gameform">
        <h4 class="description">
            <br>
            A veces puede ser difícil leer y escribir, pero quiero recordarte que eres muy especial y tienes muchas habilidades únicas.
        </h4>
    </div>
    <h4 class="detail-description">
        ¡Tú puedes lograrlo!
    </h4>
</h1>


                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                    <div>
                      <img src="images/game.png" alt="" class="" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="sun-img">
                <img src="images/sol.png">
              </div>

            </div>
          </div>
        </div>
     

      </div>

    </div>

  </section>
  <!-- end about section -->


  <!-- info section -->
  <section class="info_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="info-nav">
            <h4>
              Navegacion
            </h4>
            <ul>
              <li>
                <a href="index.html">
                  Inicio
                </a>
              </li>
              <li>
                <a href="about.html">
                  Juegos
                </a>
              </li>
              <li>
                <a href="service.html">
                  Equipo de Trabajo
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-3">
          <div class="info-contact">
            <h4>
              Contacto
            </h4>
            <div class="email">
              <h6 style="color: white;">
                Correo Electronico:
              </h6>
              <a href="">
                <img src="images/google-plus.png" alt="">
                <span>
                  valentinapen0@gmail.com
                </span>
              </a>
            </div>
            <div class="call">
              <h6 style="color: white;">
                Telefono:
              </h6>
              <a href="">
                <img src="images/telephone.png" alt="">
                <span>
                  ( +57 312 597 3444 )
                </span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="discover">
            <h4>
              Redes
            </h4>

            <div class="social-box">
              <a href="https://www.facebook.com/profile.php?id=100082680907138&mibextid=LQQJ4d">
                <img src="images/facebook.png" alt=""> Facebook
              </a>

              <br>
              <br>
              <a href="https://instagram.com/valepena123?igshid=YmMyMTA2M2Y=">
                <img src="images/instagram.png" alt="" style="width: 22px; height: 22px;">
                Instagram
              </a>
              <br>
              <br>
              <a href="www.linkedin.com/in/ana-valentina-peña-montero-29208012b">
                <img src="images/linkedin.png" alt="" style="width: 22px; height: 22px;">
                Linkedin
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  

  <!-- end info_section -->
  <script>
    // Obtener el botón por su id
    var perfilButton = document.getElementById("perfilButton");

    // Agregar un evento de clic al botón
    perfilButton.addEventListener("click", function() {
        // Obtener los datos del usuario de la URL actual
        var urlParams = new URLSearchParams(window.location.search);
        var nombre = urlParams.get("nombre");
        var email = urlParams.get("email");

        // Redirigir a la página de perfil con los datos del usuario en la URL
        window.location.href = "perfil.php?nombre=" + nombre + "&email=" + email;
    });
</script>
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
</body>

</html>
