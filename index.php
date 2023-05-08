<?php 
  session_start();
  include_once('back/conexao.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Bag-a-Bagₑ - Home</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/airplane_favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">


  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Groovin
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/groovin-free-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="index.php">BAG-A-BAGₑ</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">HOME</a></li>
          <li><a class="nav-link scrollto" href="#services">SOBRE</a></li>
          <li><a class="nav-link scrollto" href="#why-us">DESTINOS</a></li>
          <li><a class="nav-link scrollto " href="#pricing">OFERTAS</a></li>
          <li><a class="nav-link scrollto" href="#contact">CONTATO</a></li>
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
              echo '<li><a class="getstarted scrollto" href="pages/user.php?id=' . $row["ID_USUARIO"] . '" style="margin-left: 80px;">Ver perfil</a></li>';
              echo '<li><a class="nav-link scrollto" href="back/controller/controller_logoff.php">LOGOFF</a></li>';
            }
            else{
              //SE NÃO ESTIVER LOGADO APARECERÁ AS SEGUINTES INFORMAÇÕES
              echo '<li><a class="nav-link scrollto" href="pages/login.html" style="margin-left: 80px;">LOGIN</a></li>';
              echo '<li><a class="getstarted scrollto" href="pages/cadastro.php">CADASTRE-SE</a></li>';
            }
          ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header>
  <!-- fim header -->

  <!-- ======= carrossel ======= -->
  <section id="hero">
    <div class="hero-container">
      <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">

          <!-- Slide 1 -->
          <div class="carousel-item active" style="background-image: url(assets/img/slide/slide-1.jpg);">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown">Viagens</h2>
                <p class="animate__animated animate__fadeInUp">O fim de uma viagem é apenas o começo de outra.</p>
              </div>
            </div>
          </div>

          <!-- Slide 2 -->
          <div class="carousel-item" style="background-image: url(assets/img/slide/slide-2.jpg);">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown">Diversão Garantida</h2>
                <p class="animate__animated animate__fadeInUp">O nosso destino nunca é um lugar, mas uma nova maneira de olhar as coisas.</p>
              </div>
            </div>
          </div>

          <!-- Slide 3 -->
          <div class="carousel-item" style="background-image: url(assets/img/slide/slide-3.jpg);">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown">Realize seus sonhos</h2>
                <p class="animate__animated animate__fadeInUp">Viaje e volte com a mala repleta de alegria, sorrisos, lindas recordações e ótimas histórias pra contar.</p>
              </div>
            </div>
          </div>

        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

      </div>
    </div>
  </section><!-- fim do carrossel -->

  <main id="main">

    <!-- ======= parte interativa do site com algumas informações ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row no-gutters">
          <div class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-lg-start"></div>
          <div class="col-xl-7 ps-0 ps-lg-5 pe-lg-1 d-flex align-items-stretch">
            <div class="content d-flex flex-column justify-content-center">
              <h3>BAG-A-BAGₑ</h3>
              <p>
                Somos a BAG-A-BAGₑ, e trazemos as melhores reservas que você precisa!
              </p>
              <div class="row">
                <div class="col-md-6 icon-box">
                  <!--icon avião-->
                  <i class='bx bxs-plane'></i>
                  <h4>Aviação</h4>
                  <p>Diversas Companhias Aéreas a disposição para sua viagem.</p>
                </div>
                <div class="col-md-6 icon-box">
                  <i class='bx bx-money-withdraw'></i>
                  <!--icon cifrão-->
                  <h4>Econômico</h4>
                  <p>Viagens econômicas com muitas ofertas para você!</p>
                </div>
                <div class="col-md-6 icon-box">
                   <!--icon sol-->
                  <i class='bx bx-sun'></i>
                  <h4>Destinos</h4>
                  <p>Melhores lugares de todos os países para sua diversão.</p>
                </div>
                <div class="col-md-6 icon-box">
                  <!--icon escudo de segurança-->
                  <i class='bx bx-shield-quarter'></i>
                  <h4>Segurança</h4>
                  <p>Segurança garantida para você e sua família.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
    <!-- fim parte interativa do site com algumas informações -->

    <!-- ======= parte de avaliações ======= -->
    <section id="counts" class="counts">
      <div class="container">

        <div class="row no-gutters">

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <!-- emotion de satisfação do cliente -->
              <i class="bi bi-emoji-smile"></i>
              <span data-purecounter-start="0" data-purecounter-end="2450" data-purecounter-duration="1" class="purecounter"></span>
              <p><strong>Clientes Satisfeitos</strong></p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <!-- emotion de reservas já feitas -->
              <i class="bi bi-journal-richtext"></i>
              <span data-purecounter-start="0" data-purecounter-end="2500" data-purecounter-duration="1" class="purecounter"></span>
              <p><strong>Muitas Reservas</strong> já feitas conosco</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <!-- emotion de atendimento ao cliente -->
              <i class="bi bi-headset"></i>
              <span data-purecounter-start="0" data-purecounter-end="2450" data-purecounter-duration="1" class="purecounter"></span>
              <p><strong>Avaliações positivas</strong> de atendimento ao clientes</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <!-- emotion dos trabalhadores -->
              <i class="bi bi-people"></i>
              <span data-purecounter-start="0" data-purecounter-end="2000" data-purecounter-duration="1" class="purecounter"></span>
              <p><strong>Trabalhadores</strong> de diversas áreas!</p>
            </div>
          </div>

        </div>

      </div>
    </section>
    <!-- fim parte de avaliações -->

    <hr>
    <!-- ======= sobre nós ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title">
          <h2>Sobre</h2>
          <p>Viajar é a única coisa que você compra e te faz mais rico.</p>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 icon-box">
            <div class="icon"><i class='bx bx-buildings'></i></div>
            <h4 class="title"></h4>
            <p class="description">Fundada em 2000 a BAG-A-BAGₑ é uma empresa brasileira que comercializa reservas de passagens nacional e internacional.</p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box">
            <div class="icon"><i class='bx bxs-map-alt'></i></div>
            <h4 class="title"></h4>
            <p class="description">Possuimos um polo na região metropolitana de São Paulo</p>
            <a href="https://goo.gl/maps/nbjvp67HnGXc4yZv9">Local</a>
          </div>
          <div class="col-lg-4 col-md-6 icon-box">
            <div class="icon"><i class='bx bx-check-double'></i></div>
            <h4 class="title"><a href=""></a></h4>
            <p class="description">Temos como objetivo atender às necessidades dos clientes que buscam praticidade, conforto e segurança em suas viagens. </p>
          </div>
        
      </div>
    </section>
    <!-- fim sobre nós  -->
    <hr>
    <!-- ======= destinos em Alta ======= -->
    <section id="why-us" class="why-us">
      <div class="container">

        <div class="section-title">
          <center>
            <h2>Destinos em Alta</h2>
            <p>Viajar primeiro te deixa sem palavras. Depois te transforma num contador de histórias!</p>
          </center>
        </div>

        <div class="row">

          <div class="col-lg-4">
            <div class="box">
              <span>01</span>
              <h4>Rio de Janeiro</h4>
              <p>Um dos locais mais procurados, Rio de Janeiro têm muitos pontos turisticos como o Cristo Redentor, Pão de Açucar, Escadaria Selarón, Lapa e o Parque Lage. Além das belas praias que possuem paisagens de tirar o fôlego!</p>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="box">
              <span>02</span>
              <h4>Santiago</h4>
              <p>Capital do Chile, é uma cidade aconchegante, moderna, charmosa e arborizada, que possui um sistema de metrô bastante eficiente e diversos pontos turísticos como o Cerro San Cristóbal, parque com vista para toda a cidade.</p>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="box">
              <span>03</span>
              <h4>Cancún</h4>
              <p>Cancún é uma cidade do México, que fica localizada nos mares do caribe. Devido às suas águas cristalinas e todos os atrativos para praticar atividades aquáticas, esse é um dos destinos mais famosos entre os brasileiros.</p>
            </div>
          </div>

        </div>

        <center>
          <div>
            <a href="pages/destinos.php" class="btn-get-started animate__animated animate__fadeInUp scrollto">Saiba Mais</a>
          </div>
        </center>

      </div>
    </section>
    <!-- fim dos destinos em alta -->

    <hr>

    <!-- ======= ofertas ======= -->
    <section id="pricing" class="pricing">

      <div class="container">

        <div class="section-title">
          <h2>Ofertas</h2>
          <p></p>
        </div>

        <div class="row">

          <div class="col-lg-4 col-md-6">
            <div class="box">
              <div>
                <img src="assets/img/destino/img1.webp" alt="">
              </div>
              <h3>Punta Cana</h3>
              <ul>
                <li>Saindo de São Paulo</li>
                <li>Hotel + Áereo</li>
                <hr>
                <li>Preço por pessoa</li>
                <h4><sup>R$</sup>2.590<span> </span></h4>
                <li>Taxas e impostos não incluso!</li>
              </ul>
              <div class="btn-wrap">
                <a href="pages/destinos.php#internacionais" class="btn-buy">Saiba Mais</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-4 mt-md-0">
            <div class="box recommended">
              <div>
                <img src="assets/img/destino/img6.webp" alt="">
              </div>
              <h3>Porto Seguro</h3>
              <ul>
                <li>Saindo de São Paulo</li>
                <li>Hotel + Áereo</li>
                <hr>
                <li>Preço por pessoa</li>
                <h4><sup>R$</sup>750<span></span></h4>
                <li>Taxas e impostos não incluso!</li>
              </ul>
              <div class="btn-wrap">
                <a href="pages/destinos.php#nacionais" class="btn-buy">Saiba Mais</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-4 mt-lg-0">
            <div class="box">
              <div>
                <img src="assets/img/destino/img3.webp" alt="">
              </div>
              <h3>Cancún</h3>
              <ul>
                <li>Saindo de São Paulo</li>
                <li>Hotel + Áereo</li>
                <hr>
                <li>Preço por pessoa</li>
                <h4><sup>R$</sup>1.950<span></span></h4>
                <li>Taxas e impostos não incluso!</li>
              </ul>
              <div class="btn-wrap">
                <a href="pages/destinos.php#internacionais" class="btn-buy">Saiba Mais</a>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section>
    <!-- ======= fim ofertas ======= -->
    <hr>
    <!-- ======= contato ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Contato</h2>
          <p>Entre em Contato através do nosso Telefone, Email ou  nós mande uma mensagem a seguir!</p>
        </div>

        <div class="row contact-info">

          <div class="col-md-4">
            <div class="contact-address">
              <i class="bi bi-geo-alt"></i>
              <h3>Endereço</h3>
              <address>Av. Washington Luís, Vila Congonhas, São Paulo - SP</address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="bi bi-phone"></i>
              <h3>Número de Telefone</h3>
              <p><a href="tel:+155895548855">(11) 9000-0000</a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="bi bi-envelope"></i>
              <h3>Email</h3>
              <p><a href="mailto:info@example.com">bag.a.bag@gmail.com</a></p>
            </div>
          </div>

        </div>

        <div class="form">
          <form action="forms/contact.php" method="post" role="form" class="php-email-form">
            <div class="row">
              <div class="col-md-6 form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Seu Nome" data-rule="minlen:4" data-msg="Please enter at least 4 chars" required>
              </div>
              <div class="col-md-6 form-group mt-3 mt-md-0">
                <input type="email" class="form-control" name="email" id="email" placeholder="Seu Email" data-rule="email" data-msg="Please enter a valid email" required>
              </div>
            </div>
            <div class="form-group mt-3">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Assunto" required>
            </div>
            <div class="form-group mt-3">
              <textarea class="form-control" name="message" rows="5" placeholder="Menssagem" required></textarea>
            </div>
            <div class="my-3">
              <div class="loading">Carregando</div>
              <div class="error-message"></div>
              <div class="sent-message">Sua mensagem foi enviada. Obrigado!</div>
            </div>
            <div class="text-center"><button type="submit">Enviar</button></div>
          </form>
        </div>

      </div>
    </section>
    <!-- fim contato -->

  </main>
  <!-- fim main -->

  <!-- ======= começo footer(rodapé) ======= -->
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
                <a href="" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="" class="instagram"><i class="bx bxl-instagram"></i></a>
                <!-- <a href="" class="google-plus"><i class="bx bxl-skype"></i></a> -->
                <!-- <a href="" class="linkedin"><i class="bx bxl-linkedin"></i></a> -->
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>BAG-A-BAGₑ</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#about">Sobre</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="pages/destinos.php">Destinos</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#pricing">Ofertas</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#contact">Contato</a></li>
            </ul>
          </div>

        <div class="col-lg-3 col-md-6 footer-links">
            <h4>Conta</h4>
            <ul>
              <?php 
                if(isset($_SESSION['id_usuario'])) {
                  //SE ESTIVER LOGADO APARECERÁ AS SEGUINTES INFORMAÇÕES
                  echo '<li><i class="bx bx-chevron-right"></i> <a href="pages/user.php?id=' . $row["ID_USUARIO"] . '">Ver perfil</a></li>';
                  echo '<li><i class="bx bx-chevron-right"></i> <a href="back/controller/controller_logoff.php">Logoff</a></li>';
                }
                else {
                  //SE NÃO ESTIVER LOGADO APARECERÁ AS SEGUINTES INFORMAÇÕES
                  echo '<li><i class="bx bx-chevron-right"></i> <a href="pages/login.html">Login</a></li>';
                  echo '<li><i class="bx bx-chevron-right"></i> <a href="pages/cadastro.php">Cadastre-se</a></li>';
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
  </footer>
  <!-- fim footer(rodapé) -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>