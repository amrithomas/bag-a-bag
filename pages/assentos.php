<?php 
session_start();
include_once('../back/conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Bag-a-Bagₑ - Assentos</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/airplane_favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com"> <!-- Fonte: Poppins -->
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!-- Fonte: Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet"> <!-- Fonte: Poppins -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <!-- CSS Bag-a-Bag -->
  <link rel="stylesheet" href="../assets/css/assentos/assentos.css">


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

      <h1 class="logo"><a href="../index.html">BAG-A-BAGₑ</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="../index.html">HOME</a></li>
          <li><a class="nav-link scrollto" href="../index.html#about">SOBRE</a></li>
          <li><a class="nav-link scrollto" href="./destinos.html">DESTINOS</a></li>
          <li><a class="nav-link scrollto " href="../index.html#pricing">OFERTAS</a></li>
          <li><a class="nav-link scrollto" href="../index.html#contact">CONTATO</a></li>
          <!-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul> -->
          </li>
          <li><a class="nav-link scrollto active" href="login.html" style = "margin-left: 80px;">LOGIN</a></li>
          <li><a class="getstarted scrollto" href="./cadastro.php">CADASTRE-SE</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
    
  <main style="margin-top: 100px" class="text-center"> <!-- ======== Início Main ========= -->
    
    <div style="min-height: 120px; position: absolute; right: 0; top: 30%; ">
      <div class="collapse collapse-horizontal" id="collapseWidthExample">
        <div class="card card-body" style="width: 300px;">
          <h6>Assento 01</h6>
          <br>
          <p>Valor: R$49,00</p>
        </div>
      </div>
    </div>

    <!-- ===== Div Master ===== -->
    <div class="container" style="border: solid 1px black"> 
      <h3 class="text-center">Assentos Primeira Classe</h3>

    <?php 
    $comando = 
    "SELECT NUMERO_ASSENTO FROM assentos_codaviao
    INNER JOIN aviao_codaviao ON aviao_codaviao.ID_CODAVIAO = assentos_codaviao.FK_AVIAO
    INNER JOIN voo ON  voo.FK_AVIAO = aviao_codaviao.ID_CODAVIAO WHERE ID_VOO = 1 AND CLASSE = 'Primeira'
     ";
    $query = mysqli_query($conn,$comando);
    $row_resultado = mysqli_fetch_all($query);
    // print_r($row_resultado);

    
    for ($x = 0; $x < count($row_resultado); $x=$x+4){
      for ($y = 0; $y < count($row_resultado); $y++){
        ?>
        <!-- ===== Linha ===== -->
        <hr class="m-1">
        <div class="row">
          <!-- ======== Lado Esquerdo ======= -->
          <div class="col-6 col-sm-5 col-md-4 col-lg-4 col-xl-4 offset-sm-1 offset-md-2 offset-lg-2 offset-xl-2 d-flex justify-content-end">
            <!-- === Botao === -->
            <button type="button" class="btn">
              <img src="../assets/img/poltrona_verde-sembg.png" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" style="height: 50px; width: 50px;" alt="">
            </button>
            <!-- === Botao === -->
            <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo 'pq n funciona?'?>aaaa">
              <img src="../assets/img/poltrona_verde-sembg.png" style="height: 50px; width: 50px;" alt="">
            </button>
          </div> <!-- === Fim Lado Esquerdo === -->
          <?php
          echo $y;
          ?>
          
          <!-- ======== Lado Direito ======= -->
          <div class="col-6 col-sm-5 col-md-4 col-lg-3 col-xl-4 d-flex justify-content-start">
            <!-- === Botao === -->
            <button type="button" class="btn">
              <img src="../assets/img/poltrona_verde-sembg.png" style="height: 50px; width: 50px;" alt="">
            </button>
            <!-- === Botao === -->
            <button type="button" class="btn">
              <img src="../assets/img/poltrona_verde-sembg.png" style="height: 50px; width: 50px;" alt="">
            </button>
         
          </div> <!-- === Fim Lado Direito ===-->
          
        </div> <!-- ==== Fim Linha 01 ==== -->
        <?php
      }
    }
      ?>
      
      
    

    


      <hr class="m-1">
      
      
    </div> <!-- ===== Fim Div Master ===== -->

    <br><br><br>
    <br><br><br>
      
        
  </main> <!-- ======= End Main ======= -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>BAG-A-BAGₑ</h3>
              <p>
                A108 Adam Street <br>
                NY 535022, USA<br><br>
                <strong>Telefone:</strong>(11) 9000-0000<br>
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
              <li><i class="bx bx-chevron-right"></i> <a href="../index.html">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="../index.html#about">Sobre</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="destinos.html">Destinos</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="../index.html#pricing">Ofertas</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="../index.html#contact">Contato</a></li>
            </ul>
          </div>

        <div class="col-lg-3 col-md-6 footer-links">
            <h4>Conta</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Login</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="cadastro.php">Cadastre-se</a></li>
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


    <!-- Vendor JS Files -->
  <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/login.js"></script>
</body>