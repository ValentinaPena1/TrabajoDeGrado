<?php
session_start();
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

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700|Roboto:400,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.html">
            <span>
              <img src="images/Logo.jpeg">
            </span>
          </a>
          <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex mx-auto flex-column flex-lg-row align-items-center">
              <ul class="navbar-nav  ">
                <li class="nav-item active">
                  <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="equipo.html"> Equipo de trabajo </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="usuario-historial.php"> Estadisticas </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="FAQ.html"> Preguntas Frecuentes </a>
                </li>
                
                <div class="dropdown">
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
                  document.addEventListener("DOMContentLoaded", function() {
                    var dropdown = document.querySelector('.dropdown');

                    dropdown.addEventListener('mouseover', function() {
                      this.classList.add('show');
                      this.querySelector('.dropdown-menu').classList.add('show');
                    });

                    dropdown.addEventListener('mouseout', function() {
                      this.classList.remove('show');
                      this.querySelector('.dropdown-menu').classList.remove('show');
                    });
                  });
                </script>

              </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
    <!-- slider section -->
    <section class=" slider_section position-relative">
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="slider_item-box layout_padding2">
              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <?php
                    // Configuración de la conexión a la base de datos
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "ludo";

                    // Crear conexión
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Verificar la conexión
                    if ($conn->connect_error) {
                      die("La conexión falló: " . $conn->connect_error);
                    }

                   
                    $sql = "SELECT * FROM juegos";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        echo "<table class='table table-striped'>
                                <thead>
                                    <tr>
                                        <th scope='col'># Partida</th>
                                        <th scope='col'>Fecha Partida</th>
                                        <th scope='col'>Nivel</th>
                                        <th scope='col'>Puntaje</th>
                                    </tr>
                                </thead>
                                <tbody>";
                        // Recorrer los resultados y mostrar los datos en la tabla
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <th scope='row'>" . $row["IdJuego"] . "</th>
                                    <td>" . $row["FechaPartida"] . "</td>
                                    <td>" . $row["IdNivel"] . "</td>
                                    <td>" . $row["Puntaje"] . "</td>
                                </tr>";
                        }
                        echo "</tbody>
                            </table>";
                    } else {
                        echo "No se encontraron registros.";
                    }
                    // Cerrar la conexión
                    $conn->close();
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end slider section -->
  </div>
  <div class="bg">
    <!-- service section -->

    <!--info section -->
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

    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      crossorigin="anonymous"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
      integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
      crossorigin="anonymous"></script>
</body>

</html>
