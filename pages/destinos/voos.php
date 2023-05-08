<?php 
session_start(); //iniciando sessão
include_once("../../back/conexao.php"); //incluindo conexão

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Bag-a-Bagₑ - Vôos</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../../assets/img/airplane_favicon.png" rel="icon">
  <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com"> <!-- Main Poppins -->
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!-- Main Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet"> <!-- Main Poppins -->

  <!-- Vendor CSS Files -->
  <link href="../../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../../assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/detalhes_destinos/punta-cana.css">

  <!-- =======================================================
  * Template Name: Groovin
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/groovin-free-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body style="min-width: 769px;">

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="../index.php">BAG-A-BAGₑ</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="#">HOME</a></li>
          <li><a class="nav-link scrollto" href="#">SOBRE</a></li>
          <li><a class="nav-link scrollto active" href="">DESTINOS</a></li>
          <li><a class="nav-link scrollto " href="#">OFERTAS</a></li>
          <li><a class="nav-link scrollto" href="#">CONTATO</a></li>
          <!-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul> -->
          </li>
          <li><a class="nav-link scrollto" href="#contact" style = "margin-left: 80px;">LOGIN</a></li>
          <li><a class="getstarted scrollto" href="#about">CADASTRE-SE</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Carrossel ======= -->
  <section id="hero" style="height: 40vw;">
    <div class="hero-container">
      <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
        <div class="carousel-inner" role="listbox">
          <!-- Slide 1 -->
          <div class="carousel-item active" style="background-image: url(../../assets/img/destinos/punta-cana.jpg); background-position: center;">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown">Todos os Vôos</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section><!-- fim do carrossel -->

  <main id="main" class="container-fluid">
    
  <!-- ============================ Modal de Filtragem ==============================-->
    <div id="meuModal" class="modal fade" role="dialog" style="z-index: 99991;">
    
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" >
    
        <div class="modal-content">
          
          <form action="" method="POST">
            <div class="container">
              <div class="row">
                <!-- ======= Div Master Modal  ====== -->
                <div class="p-3" style="border: solid 0px red">
                  <div class="modal-header"> <!-- Header do Modal -->
                    <h4 class="modal-title">Filtre ou Ordene</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div> <!-- Fim do Header do Modal-->

                  <!-- ======== Div Child Modal 1 ======== -->
                  <div class="modal-body filtros-caixa2 mb-2" id="filtros-caixa-2" style="border: solid 0px blue; overflow-y: auto; height: 400px;">
                    <!-- ==================== Área Referentes às Paradas =================== -->
                    <h5>Paradas</h5>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="paradas" id="um" value="" checked>
                      <label class="form-check-label" for="um">
                        Todas as Paradas
                      </label>
                    </div>
        
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="paradas" id="dois" value="">
                      <label class="form-check-label" for="dois">
                        Direto
                      </label>
                    </div>
        
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="paradas" id="tres" value="">
                      <label class="form-check-label" for="tres">
                        Um ou Mais
                      </label>
                    </div>
                    <!--  ================ Área Referente a Companhia Aérea ============== -->
                    <h5 class="mt-4">Companhia</h5>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="companhia" id="um" value="" checked>
                      <label class="form-check-label" for="um">
                        Todas as Companhias
                      </label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="companhia" id="dois" value="">
                      <label class="form-check-label" for="dois">
                        Tam
                      </label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="companhia" id="tres" value="">
                      <label class="form-check-label" for="tres">
                        Gol
                      </label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="companhia" id="quatro" value="">
                      <label class="form-check-label" for="quatri">
                        Azul
                      </label>
                    </div>
                    <!--  ================ Área Referente ao Preço ============== -->
                    

                    <!--  ================ Área Referente a Classe do Vôo ============== -->
                    <h5 class="mt-4">Classe</h5>
                    
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="classe" id="um" value="" checked>
                      <label class="form-check-label" for="um">
                        Econômica
                      </label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="classe" id="dois" value="">
                      <label class="form-check-label" for="dois">
                        Primeira Classe
                      </label>
                    </div>
                    <!--  ================ Área Referente ao Horário de Chegada Vôo  ============== -->
                    <h5 class="mt-4">Horário de Chegada</h5>

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="horario" id="um" value="" checked>
                      <label class="form-check-label" for="um">
                        Manhã / 00:00 - 12:00
                      </label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="horario" id="dois" value="">
                      <label class="form-check-label" for="dois">
                        Tarde / 12:00 - 18:00
                      </label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="horario" id="tres" value="">
                      <label class="form-check-label" for="tres">
                        Noite / 18:00 - 18:00
                      </label>
                    </div>
                    <!--  ================ Área Referente ao Horário de Saída ============== -->  
                    <h5 class="mt-4">Horário de Saída</h5>

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="horario" id="um" value="" checked>
                      <label class="form-check-label" for="um">
                        Manhã / 00:00 - 12:00
                      </label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="horario" id="dois" value="">
                      <label class="form-check-label" for="dois">
                        Tarde / 12:00 - 18:00
                      </label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="horario" id="tres" value="">
                      <label class="form-check-label" for="tres">
                        Noite / 18:00 - 18:00
                      </label>
                    </div>
                    
                  </div>
                  <!-- ========= Fim Div Child 1 Modal ========= -->
                  <!--- ================ Botões de Submit ========================-->
                  <div class="modal-footer mt-3">
                    <button type="button" class="btn btn-outline-danger">
                      Limpar Campos
                    </button>
                    <button type="button" class="btn btn-outline-success">
                      Aplicar
                    </button>
                  </div>
    
                </div>  <!-- ==== Fim Div Master =====-->
    
              </div> <!-- === Fim Div Row ===-->
    
            </div> <!-- === Fim Container ===-->
          </form>
    
        </div>
        
          
      </div>
    </div>
  <!-- ========================== Fim Modal de Filtragem ======================================= -->
      

    <!-- ================== Div Master ================= -->
    <div style="border: solid 0px blue;" class="">
      
      <!-- ================= Area de Passagens ================= -->
        <div class="mb-2 container mt-3 shadow rounded" id="form-filtros">
          <!-- ================== Conteúdo ================= -->
          <div class="container text-center">
            <h1 class="mt-3 mb-3">Vôos</h1>
            
            <button type="button" id="botao-modal" class="btn btn-outline-success mb-5" data-bs-toggle="modal" data-bs-target="#meuModal">
              Filtrar e Ordenar
            </button>
          </div>

          <?php
          //Descobrir e Listar todos os Vôos Existentes
          
          $comando = 
          "SELECT 
          voo.ID_VOO,
          voo.VALOR_PASSAGEM,
          voo.IDA_HORARIO_PARTIDA,
          voo.IDA_HORARIO_CHEGADA,
          voo.VOLTA_HORARIO_PARTIDA,
          voo.VOLTA_HORARIO_CHEGADA,
          av1.EMPRESA AS EMPRESA_AVIAO_IDA,
          av2.EMPRESA AS EMPRESA_AVIAO_VOLTA,
          -- av1.CODIGO_AVIAO AS CODIGO_AVIAO_IDA, código do aviao dispensavel
          -- av2.CODIGO_AVIAO AS CODIGO_AVIAO_VOLTA, código do aviao dispensavel
          origem_ida.NOME_AEROPORTO AS NOME_AEROPORTO_ORIGEM_IDA,
          destino_ida.NOME_AEROPORTO AS NOME_AEROPORTO_DESTINO_IDA,
          -- origem_volta.NOME_AEROPORTO AS NOME_AEROPORTO_ORIGEM_VOLTA,
          -- destino_volta.NOME_AEROPORTO AS NOME_AEROPORTO_DESTINO_VOLTA,
          aeroporto_ida.NOME_AEROPORTO AS NOME_AEROPORTO_ESCALA_IDA,
          aeroporto_volta.NOME_AEROPORTO AS NOME_AEROPORTO_ESCALA_VOLTA
          FROM voo 
          LEFT JOIN aeroporto AS origem_ida ON voo.FK_ORIGEM_AERO = origem_ida.ID_AEROPORTO
          LEFT JOIN aeroporto AS destino_ida ON voo.FK_DESTINO_AERO = destino_ida.ID_AEROPORTO
          -- LEFT JOIN aeroporto AS origem_volta ON voo.FK_ORIGEM_AERO = origem_volta.ID_AEROPORTO
          -- LEFT JOIN aeroporto AS destino_volta ON voo.FK_DESTINO_AERO = destino_volta.ID_AEROPORTO
          LEFT JOIN escala AS escala_ida ON voo.FK_ESCALA_IDA = escala_ida.ID_ESCALA
          LEFT JOIN escala AS escala_volta ON voo.FK_ESCALA_VOLTA = escala_volta.ID_ESCALA
          LEFT JOIN aeroporto AS aeroporto_ida ON escala_ida.FK_AEROPORTO_ESCALA = aeroporto_ida.ID_AEROPORTO
          LEFT JOIN aeroporto AS aeroporto_volta ON escala_volta.FK_AEROPORTO_ESCALA = aeroporto_volta.ID_AEROPORTO
          LEFT JOIN aviao AS av1 ON voo.FK_AVIAO_IDA = av1.ID_AVIAO
          LEFT JOIN aviao AS av2 ON voo.FK_AVIAO_VOLTA = av2.ID_AVIAO
          ";

          $query = mysqli_query($conn,$comando);
          $row_resultado = mysqli_fetch_all($query);


          // var_dump($row_resultado[5][0]);
          
          $x = 0;

          while ($x < (count($row_resultado))){
            $x = $x + 1;
            //Variável que Representa o ID do Voo
            $id_voo = $row_resultado[$x-1][0];//<- Esse último número representa a coluna a ser obtida as informações, indo de 0(id_voo) até 11(nome_aeroporto_escala_volta) 
            
            //obter local de origem ida
            $local_ida_full = $row_resultado[$x-1][8];
            $pattern = '/^Aeroporto de|^Aeroporto Internacional de|^Aeroporto do|^Aeroporto Internacional do|^Aeroporto da|^Aeroporto Internacional da/';
            $locais_ida_origem = preg_replace($pattern,'',$local_ida_full);

            //obter local de origem ida
            $local_volta_full = $row_resultado[$x-1][9];
            $pattern = '/^Aeroporto de|^Aeroporto Internacional de|^Aeroporto do|^Aeroporto Internacional do|^Aeroporto da|^Aeroporto Internacional da/';
            $locais_ida_destino = preg_replace($pattern,'',$local_volta_full);

            //obter valor da cadeira
            $_SESSION['valor_poltrona'] = $row_resultado[$x-1][1]


            ?>
          <!-- ===== Card dos Vôos Existentes ====== -->
          <a href="../assentos.php?voo=<?php echo $id_voo?>"> <!-- Enviar para Tela de Assentos -->
            <div class="card mb-3 shadow" id="cards-bab" style="width: 90%; margin: 0 auto;">
              <div class="card-body" id="demo" style="padding: 0;">
                
              <div class="row">
                  <!-- Informações do Vôo -->
                  <div class="col-9" id="card-voo-left">
                    <div class="card-title row">
                      <h5 class="col-3" style="color:#3A5C1D;">IDA <?php echo $id_voo ?></h5>
                      <h5 class="col-9 text-center"><?php echo $locais_ida_origem ?> ➝ <?php echo $locais_ida_destino?></h5>
                    </div>

                    <hr>
                    <div class="row card-subtitle mb-2 text-body-secondary">
                      <h6 class="col-3">
                        <i class="bi bi-check-circle" style="color:green;"></i>  
                        <?php echo $row_resultado[$x-1][6]?>
                      </h6>
                      <h6 class="col-9 text-center"><?php echo date('d/m/Y H:m',strtotime($row_resultado[$x-1][2])) ?> ➝ <?php echo date('d/m/y H:m',strtotime($row_resultado[$x-1][3])) ?></h6>
                    </div>

                    <hr>
                    
                    <div class="card-title row">
                      <h5 class="col-3" style="color:#3A5C1D;">VOLTA</h5>
                      <h5 class="col-9 text-center">A definir ➝ A definir</h5>
                    </div>

                    <hr>
                    <div class="row card-subtitle mb-2 text-body-secondary">
                      <h6 class="col-3">
                        <i class="bi bi-check-circle" style="color:green;"></i> 
                        <?php echo $row_resultado[$x-1][7] ?>
                      </h6>
                      <h6 class="col-9 text-center"><?php echo date('d/m/Y H:m',strtotime($row_resultado[$x-1][4])) ?> ➝ <?php echo date('d/m/Y H:m',strtotime($row_resultado[$x-1][5])) ?></h6>
                    </div>
                    
                  </div>
                  <!-- Valor do Vôo -->
                  <div class="text-center col-3 " id="card-voo-right">
                    <h4 class="card-title mt-5"><?php echo $row_resultado[$x-1][1]; ?></h4>
                    <h6 class="card-subtitle mt-1 text-body-secondary">por adulto, sem taxas</h6>
                    <p class="mt-2" style="margin:-2px;">ou</p>
                    <p class="mt-1">12x de R$<?php echo number_format($row_resultado[$x-1][1]/12, 2,'.',""); ?></p>

                    <!-- <input type="button" class="btn btn-success mt-3" value="Fazer Pedido"> -->
                  </div>
                </div>

              </div>  <!-- Card Body -->

            </div> <!-- ==================== Fim Card ===================== -->
          </a>
        <?php
        } //Fim While
        ?>

        </div>  <!-- ===== Fim Área de Passsagens ===== -->
          

        
      </div><!-- Fim Div Master -->

    
    
      
  </main><!-- End #main -->

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
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Sobre</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Destinos</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Ofertas</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Contato</a></li>
            </ul>
          </div>

        <div class="col-lg-3 col-md-6 footer-links">
            <h4>Conta</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Login</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Cadastre-se</a></li>
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

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../../assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../../assets/js/main.js"></script>
  <script src="../../assets/js/detalhes_destinos/punta-cana.js"></script>

</body>

</html>