<?php 
  session_start();
  include_once('../back/conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Bag-a-Bagₑ - Destinos</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="../assets/img/airplane_favicon.png" rel="icon" />
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
      rel="stylesheet"
    />
    <!-- Import CSS Files -->
    <link rel="stylesheet" href="../assets/css/destinos/destinos.css">
    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet" />
    <link
      href="../assets/vendor/bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="../assets/vendor/bootstrap-icons/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link
      href="../assets/vendor/glightbox/css/glightbox.min.css"
      rel="stylesheet"
    />
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet" />

    <!-- =======================================================
        * Template Name: Groovin
        * Updated: Mar 10 2023 with Bootstrap v5.2.3
        * Template URL: https://bootstrapmade.com/groovin-free-bootstrap-theme/
        * Author: BootstrapMade.com
        * License: https://bootstrapmade.com/license/
        ======================================================== -->
  </head>

  <body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
      <div class="container d-flex align-items-center justify-content-between">
  
        <h1 class="logo"><a href="../index.php">BAG-A-BAGₑ</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
  
        <nav id="navbar" class="navbar">
          <ul>
            <li><a class="nav-link scrollto " href="../index.php">HOME</a></li>
            <li><a class="nav-link scrollto" href="../index.php#about">SOBRE</a></li>
            <li><a class="nav-link scrollto active" href="./destinos.php">DESTINOS</a></li>
            <li><a class="nav-link scrollto " href="../index.php#pricing">OFERTAS</a></li>
            <li><a class="nav-link scrollto" href="../index.php#contact">CONTATO</a></li>
            <!-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="#">Drop Down 1</a></li>
                <li><a href="#">Drop Down 2</a></li>
                <li><a href="#">Drop Down 3</a></li>
                <li><a href="#">Drop Down 4</a></li>
              </ul> -->
            </li>
            <?php
            //VERIFICANDO SE TEM UM USUARIO LOGADO
            if(isset($_SESSION['id_usuario'])) {
              $id = $_SESSION['id_usuario'];

              $query = "SELECT * FROM usuario 
              INNER JOIN telefone ON FK_TELEFONE = ID_TELEFONE 
              INNER JOIN cadastro ON FK_CADASTRO = ID_CADASTRO
              WHERE ID_USUARIO='$id'";
              $query = mysqli_query($conn, $query);
              $row = mysqli_fetch_assoc($query);
              //SE ESTIVER LOGADO APARECERÁ AS SEGUINTES INFORMAÇÕES
              echo '<li><a class="getstarted scrollto" href="user.php?id=' . $row["ID_USUARIO"] . '" style="margin-left: 80px;">Ver perfil</a></li>';
              echo '<li><a class="nav-link scrollto" href="../back/controller/controller_logoff.php">LOGOFF</a></li>';
            }
            else{
              //SE NÃO ESTIVER LOGADO APARECERÁ AS SEGUINTES INFORMAÇÕES
              echo '<li><a class="nav-link scrollto" href="login.html" style="margin-left: 80px;">LOGIN</a></li>';
              echo '<li><a class="getstarted scrollto" href="cadastro.php">CADASTRE-SE</a></li>';
            }
          ?>
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
  
      </div>
    </header>
    <!-- End Header -->

    <main class="container" id="main">
      <section id="search" class="container search">
        <form action="" class="form-passagem">
          <div class="form-group row">
            <div class="col-lg-6 form-group">
              <label for="" class="h6">De onde você deseja partir?</label>
              <input type="text" name="" class="col-lg-4 form-control" id="" />
            </div>
            <div class="col-lg-6 form-group">
              <label for="" class="h6">Para onde você quer ir?</label>
              <input type="text" name="" class="col-lg-4 form-control" id="" />
            </div>
          </div>
          <hr class="mt-4" style="border: 1px solid #5c9f24; color: #5c9f24" />
          <div class="row">
            <div class="col-lg-6">
              <label for="" class="h6">Data da viagem de Ida</label>
              <input type="date" name="" id="" class="form-control" />
            </div>
            <div class="col-lg-6">
              <label for="" class="h6">Data da viagem de Volta</label>
              <input type="date" name="" id="" class="form-control" />
            </div>
          </div>
        </form>
      </section>

      <!-- <h1 class="container">DESTAQUES</h1> -->
      <section id="internacionais" class="container destinos">
        <div class="row mb-4 text-center">
          <h2>Destinos Internacionais</h2>
        </div>
        <div class="row">
          <div class="row gx-2 mb-4">
            <a class="col-lg-4 col-sm-12" href="">
              <div class="card" style="width: 100%">
                <img
                  class="card-img-top"
                  src="../assets/img/destinos/santiago.jpg"
                  alt="Card image cap"
                />
                <div class="card-body">
                  <h5 class="card-title">Santiago</h5>
                  <p class="card-text text-black">Saindo de São Paulo</p>
                  <hr />
                  <p class="card-text text-black">Preço por pessoa:</p>
                  <p class="card-text">R$ 1145</p>
                  <p class="card-text text-black">
                    Taxas e impostos não inclusos
                  </p>
                </div>
              </div>
            </a>
            <a class="col-lg-4 col-sm-12" href="">
              <div class="card" style="width: 100%">
                <img
                  class="card-img-top"
                  src="../assets/img/destinos/punta-cana.jpg"
                  alt="Card image cap"
                />
                <div class="card-body">
                  <h5 class="card-title">Punta Cana</h5>
                  <p class="card-text text-black">Saindo de São Paulo</p>
                  <hr />
                  <p class="card-text text-black">Preço por pessoa:</p>
                  <p class="card-text">R$ 2590</p>
                  <p class="card-text text-black">
                    Taxas e impostos não inclusos
                  </p>
                </div>
              </div>
            </a>
            <a class="col-lg-4 col-sm-12 center" href="">
              <div class="card" style="width: 100%">
                <img
                  class="card-img-top"
                  src="../assets/img/destinos/cancun.jpg"
                  alt="Card image cap"
                />
                <div class="card-body">
                  <h5 class="card-title">Cancún</h5>
                  <p class="card-text text-black">Saindo de São Paulo</p>
                  <hr />
                  <p class="card-text text-black">Preço por pessoa:</p>
                  <p class="card-text">R$ 1950</p>
                  <p class="card-text text-black">
                    Taxas e impostos não inclusos
                  </p>
                </div>
              </div>
            </a>
          </div>
          <div class="container">
            <a class="row col-2 offset-5 align-items-center" href="../pages/destinos/voos.php">
              <button
                style="min-width: 65px"
                type="button"
                class="mt-4 btn btn-outline-success text-center"
              >
                Ver mais...
              </button>
            </a>
          </div>
        </div>
      </section>

      <section id="nacionais" class="destinos">
        <div class="row mb-4 text-center">
          <h2>Destinos Nacionais</h2>
        </div>
        <div class="row">
          <div class="row gx-2 mb-4">
            <a class="col-lg-4 col-sm-12" href="">
              <div class="card" style="width: 100%">
                <img
                  class="card-img-top"
                  src="../assets/img/destinos/rio_de_janeiro.jpg"
                  alt="Card image cap"
                />
                <div class="card-body">
                  <h5 class="card-title">Rio de Janeiro</h5>
                  <p class="card-text text-black">Saindo de São Paulo</p>
                  <hr />
                  <p class="card-text text-black">Preço por pessoa:</p>
                  <p class="card-text">R$ 500</p>
                  <p class="card-text text-black">
                    Taxas e impostos não inclusos
                  </p>
                </div>
              </div>
            </a>
            <a class="col-lg-4 col-sm-12" href="">
              <div class="card" style="width: 100%">
                <img
                  class="card-img-top"
                  src="../assets/img/destinos/natal.jpg"
                  alt="Card image cap"
                />
                <div class="card-body">
                  <h5 class="card-title">Natal</h5>
                  <p class="card-text text-black">Saindo de São Paulo</p>
                  <hr />
                  <p class="card-text text-black">Preço por pessoa:</p>
                  <p class="card-text">R$ 800</p>
                  <p class="card-text text-black">
                    Taxas e impostos não inclusos
                  </p>
                </div>
              </div>
            </a>
            <a class="col-lg-4 col-sm-12" href="">
              <div class="card" style="width: 100%">
                <img
                  class="card-img-top"
                  src="../assets/img/destinos/porto-seguro.jpg"
                  alt="Card image cap"
                />
                <div class="card-body">
                  <h5 class="card-title">Porto Seguro</h5>
                  <p class="card-text text-black">Saindo de São Paulo</p>
                  <hr />
                  <p class="card-text text-black">Preço por pessoa:</p>
                  <p class="card-text">R$ 750</p>
                  <p class="card-text text-black">
                    Taxas e impostos não inclusos
                  </p>
                </div>
              </div>
            </a>
          </div>
          <div class="container">
            <a class="row col-2 offset-5 align-items-center" href="../pages/destinos/voos.php">
              <button
                style="min-width: 65px"
                type="button"
                class="mt-4 btn btn-outline-success text-center"
              >
                Ver mais...
              </button>
            </a>
          </div>
        </div>
      </section>
    </main>
    <!-- End #main -->

       <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>BAG-A-BAGₑ</h3>
              <p>
                Av. Washington Luís<br>
                Vila Congonhas<br>
                São Paulo - SP N°4878<br><br>
                <strong>Telefone:</strong>(11) <em></em> 9000-0000<br>
                <strong>Email:</strong>bag.a.bag@gmail.com<br>
              </p>
              <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>BAG-A-BAGₑ</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="../index.php">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="../index.php#about">Sobre</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Destinos</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="../index.php#pricing">Ofertas</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="../index.php#contact">Contato</a></li>
            </ul>
          </div>

        <div class="col-lg-3 col-md-6 footer-links">
            <h4>Conta</h4>
            <ul>
              <?php 
                if(isset($_SESSION['id_usuario'])) {
                  //SE ESTIVER LOGADO APARECERÁ AS SEGUINTES INFORMAÇÕES
                  echo '<li><i class="bx bx-chevron-right"></i> <a href="user.php?id=' . $row["ID_USUARIO"] . '">Ver perfil</a></li>';
                  echo '<li><i class="bx bx-chevron-right"></i> <a href="../back/controller/controller_logoff.php">Logoff</a></li>';
                }
                else {
                  //SE NÃO ESTIVER LOGADO APARECERÁ AS SEGUINTES INFORMAÇÕES
                  echo '<li><i class="bx bx-chevron-right"></i> <a href="login.html">Login</a></li>';
                  echo '<li><i class="bx bx-chevron-right"></i> <a href="cadastro.php">Cadastre-se</a></li>';
                }
              ?>
              <!-- <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li> -->
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Inscreva-se para receber ofertas exclusivas</h4>
            <!-- <p>Inscreva-se para receber ofertas exclusivas</p> -->
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Quero recebê-las!">
            </form>

          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Groovin</span></strong>. All rights Reserved.
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/groovin-free-bootstrap-theme/ -->
        Designed by  <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

    <a
      href="#"
      class="back-to-top d-flex align-items-center justify-content-center"
      ><i class="bi bi-arrow-up-short"></i
    ></a>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
  </body>
</html>
