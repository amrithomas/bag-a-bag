<?php 
session_start(); //iniciando sessão
include_once('../back/conexao.php'); //incluindo conexão

// $id = $_SESSION['id_usuario'];

// $query = "SELECT * FROM usuario 
// INNER JOIN telefone ON FK_TELEFONE = ID_TELEFONE 
// INNER JOIN cadastro ON FK_CADASTRO = ID_CADASTRO
// INNER JOIN rg ON FK_RG = ID_RG
// WHERE ID_USUARIO='$id'";
// $query = mysqli_query($conn, $query);
// $row = mysqli_fetch_assoc($query);

// if(empty($row)) {
//   header('Location: ../pages/login.html');
// }

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
        <li><a class="getstarted scrollto" href="<?php echo "user.php?id=" . $row['ID_USUARIO'] ?>" style = "margin-left: 80px;">Ver perfil</a></li>
        <li><a class="nav-link scrollto" href="../back/controller/controller_logoff.php" >LOGOFF</a></li>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->
    
  </div>
</header><!-- End Header -->

<main style="margin-top: 100px" class="text-center"> <!-- ======== Início Main ========= -->

<!-- ===== Div Master ===== -->
<div class="container mb-3 shadow" id="demo" style="border: solid 1px black">
<!-- Cabeçalho da Listagem -->
<div class="">
  <h3 class="text-center mb-3 mt-3" id="titulo">Assentos Econômicos</h3>
  <button type="button" class="btn btn-outline-success"  data-bs-toggle="collapse" data-bs-target="#cardAssento">Assentos Selecionados</button>

  
</div> 

<?php 
$tipo = 'Primeira';

// Verifica se o formulário foi enviado
if(isset($_POST['tipo'])){
  // Atualiza a variável com o valor enviado pelo formulário
  $tipo = $_POST['tipo'];
}

// Exibe o valor atual da variável
// echo 'Classe atual: ' . $tipo;

// Exibe o formulário com o botão switch
?>
  <div class="text-start" style="border: solid 0px red;">

  <form method="post">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="tipoSwitch" name="tipo" value="Econômica" <?php if($tipo == 'Econômica'){ echo 'checked'; } ?> onchange="this.form.submit()">
        <label class="form-check-label" for="tipoSwitch"><?php if ($tipo == 'Primeira'){echo 'Assentos de Primeira Classe';}else{echo 'Assentos de Classe Econômica';} ?></label>
    </div>
  </form>

  </div>




<!-- Fim Cabeçalho Listagem -->
  <form action="../pages/cadastro-passageiro.php" method="POST">
    
    <!-- ====== Card de Informação do Assento ====== -->

      <!-- === Estilização para Fixagem Lateral do Card === -->
      <div style="min-height: 120px; position: fixed; right: 0; top: 20%; z-index: 1;">
      <!-- === Referencial para Puxagem do Botão === -->
        <div class="collapse collapse-horizontal shadow" id="cardAssento">
          <!-- === Inicio Estilização === -->
          <div class="card card-body" style="width: 300px;">
            <!-- <input type="radio" id="ast" name="ast" enabled> -->
            <div class="row text-center">
              <h6 class="col-10">Assentos Selecionados</h6>
              <button type="button"  data-bs-toggle="collapse" data-bs-target="#cardAssento" class="btn-close col-2"  aria-label="Close"></button>

            </div>
            <!-- === Campo dos Assentos === -->
            <div id="ListaAssentos" style="overflow-y: auto; height: 300px;">
              
              <!-- Inserção via JS -->
            
            </div>

            <div class="row offset-1 mt-1">
              <input type="hidden" id="enviaArray" name="assentos" value=""/>
              <button type="submit" onclick="enviadado()" class="btn btn-success col-5" id="">
                Prosseguir
              </button>
              <button type="button" id="remover" onclick="remove()"  class="btn btn-danger col-5 mx-1">
                Remover
              </button>
              
            </div>
          </div>
        </div>
      </div>
    <!-- ====== Fim do Card de Informação do Assento ====== -->
    
    
    <?php
    // Atualiza o título de acordo com o valor de $tipo
    if($tipo == 'Econômica') {
      echo '<script>document.getElementById("titulo").innerHTML = "Assentos Econômicos";</script>';
    } else {
      echo '<script>document.getElementById("titulo").innerHTML = "Assentos de Primeira Classe";</script>';
    }


    $_SESSION['id_voo'] = filter_input(INPUT_GET,'voo');
    $id_voo = filter_input(INPUT_GET,'voo');

    // $tipo = filter_input(INPUT_GET,'tipo');
    // var_dump($tipo);
    // $tipo = 'Primeira';
    
    //Obter Quantidade de Assentos
    $comando = 
    "SELECT NUMERO_ASSENTO FROM assentos
    INNER JOIN aviao ON aviao.ID_AVIAO = assentos.FK_AVIAO            
    INNER JOIN voo ON  voo.FK_AVIAO_IDA = aviao.ID_AVIAO WHERE ID_VOO = '$id_voo' AND CLASSE = '$tipo'
    ";
    $query = mysqli_query($conn,$comando);
    $row_resultado = mysqli_fetch_all($query);

    //Obter quais assentos estão Ocupados
    $comando_ocupado = 
    "SELECT NUMERO_ASSENTO FROM assentos
    INNER JOIN aviao ON aviao.ID_AVIAO = assentos.FK_AVIAO               
    INNER JOIN passagem ON passagem.FK_ASSENTO = ID_ASSENTO WHERE FK_VOO = '$id_voo' AND CLASSE = '$tipo'
    ";
    $query_ocupado = mysqli_query($conn,$comando_ocupado);
    $row_resultado_ocupado = mysqli_fetch_all($query_ocupado);
    
    //Comandos para verificar o funcionamento do vetor
    // print_r($row_resultado);
    // echo count($row_resultado);
    // print_r($row_resultado[0]);
    // print_r($row_resultado[0][0]);
    // print_r(count($row_resultado));
    
    //Comandos para verificar o funcionamento do Ocupado
    // print_r($row_resultado_ocupado[0][0]);

    $x = 0;
    $y = 0;


    if(!empty($row_resultado_ocupado)){
      $z = $row_resultado_ocupado[0][0]-1;
    }else{//Evitar que o array de assentos ocupados esteja nulo, fazendo assim o código quebrar
      $z = 0;
      // echo $z;
      $row_resultado_ocupado[0][0] = 0;
    }

    // echo $x;
    // echo $z;

    // echo $row_resultado[0][0];

    // if (!empty($row_resultado_ocupado)){
    //   $z = $row_resultado_ocupado[0][0];
    //   echo 'tem coisa';
    // }else{
    //   $z = 0;
    //   echo 'nao tem coisa';
    // }


    //Listagem de Linhas
    while($x < (count($row_resultado))){ 
      
      $x = $x + 1; //Variável correspondente ao número de cada poltrona
      $y = $y + 1; //Variável capaz de organizar a impressão das poltronas
      if($y == 5){ //Filtro limitador da quantidade de variáveis
        $y = 1;
      }
      
      //Contador para Listagem de Poltronas Ocupadas
      if($z < (count($row_resultado_ocupado))){
        $z = $z + 1;
      }
      
      
      
      
      //Listagem Primeira Poltrona do Lado Esquerdo
      if($y == 1){
        
        ?>
        <!-- ===== Linha ===== -->
        <hr class="m-1">
        <div class="row"> 
          <!-- ======== Lado Esquerdo ======= -->
          <div class="col-6 col-sm-5 col-md-4 col-lg-4 col-xl-4 offset-sm-1 offset-md-2 offset-lg-2 offset-xl-2 d-flex justify-content-end">
            <?php
            if ($row_resultado[$x-1][0] == $row_resultado_ocupado[$z-1][0]){
              ?>
            <!-- === Poltrona 01 Caso Ocupada === -->
            <button type="button" disabled class="btn" id="poltrona<?php echo $row_resultado[$x-1][0] ?>" data-bs-toggle="" data-bs-placement="left" data-bs-title="<?php echo $row_resultado[$x-1][0] ?>" name="ast" onclick="envia(<?php echo $row_resultado[$x-1][0] ?>)" value="<?php echo $row_resultado[$x-1][0] ?>">
              <img id="img<?php echo $row_resultado[$x-1][0]?>" src="../assets/img/poltrona_vermelha-sembg.png"  style="height: 50px; width: 50px;" alt="">
            </button>
            <?php
            }else{
              ?>
              <!-- === Poltrona 01 Caso Desocupada === -->
              <button type="button" class="btn" id="poltrona<?php echo $row_resultado[$x-1][0] ?>" data-bs-toggle="" data-bs-placement="left" data-bs-title="<?php echo $row_resultado[$x-1][0] ?>" name="ast" onclick="envia(<?php echo $row_resultado[$x-1][0]?>)" value="<?php echo $row_resultado[$x-1][0] ?>">
                <img id="img<?php echo $row_resultado[$x-1][0]?>" src="../assets/img/poltrona_verde-sembg.png"  style="height: 50px; width: 50px;" alt="">
              </button>
              <?php
            
          }
            
          } //Fim da Listagem da Primeira Poltrona
      
      //Listagem Segunda Poltrona do Lado Esquerdo
      if($y == 2){
        if($row_resultado[$x-1][0] == $row_resultado_ocupado[$z-1][0]){
          ?>
          <!-- === Poltrona 02 Caso Ocupada === -->
          <button type="button" disabled class="btn" id="poltrona<?php echo $row_resultado[$x-1][0] ?>" data-bs-toggle="" data-bs-placement="bottom" data-bs-title="<?php echo $row_resultado[$x-1][0] ?>" name="ast" onclick="envia(<?php echo $row_resultado[$x-1][0] ?>)" value="<?php echo $row_resultado[$x-1][0] ?>">
            <img id="img<?php echo $row_resultado[$x-1][0]?>" src="../assets/img/poltrona_vermelha-sembg.png" style="height: 50px; width: 50px;" alt="">
          </button>
          </div> <!-- === Fim Lado Esquerdo === -->
          <?php
        }else{
          ?>
          <!-- === Poltrona 02 Caso Descoupada === -->
          <button type="button" class="btn" id="poltrona<?php echo $row_resultado[$x-1][0] ?>" data-bs-toggle="" data-bs-placement="bottom" data-bs-title="<?php echo $row_resultado[$x-1][0] ?>" name="ast" onclick="envia(<?php echo $row_resultado[$x-1][0] ?>)" value="<?php echo $row_resultado[$x-1][0] ?>">
            <img id="img<?php echo $row_resultado[$x-1][0]?>" src="../assets/img/poltrona_verde-sembg.png" style="height: 50px; width: 50px;" alt="">
          </button>
          </div> <!-- === Fim Lado Esquerdo === -->
          <?php
        }
          
      } //Fim da Listagem da Segunda Poltrona  
      // echo $x;
      ?>
      <?php
      //Listagem da Terceira Poltrona do Lado Direito
      if($y == 3){
        ?>
          <!-- ======== Lado Direito ======= -->
          <div class="col-6 col-sm-5 col-md-4 col-lg-3 col-xl-4 d-flex justify-content-start">
            <?php 
            if($row_resultado[$x-1][0] == $row_resultado_ocupado[$z-1][0]){
            ?>
            <!-- === Poltrona 3 Caso Ocupada === -->
            <button type="button" disabled class="btn" id="poltrona<?php echo $row_resultado[$x-1][0] ?>" data-bs-toggle="" data-bs-placement="bottom" data-bs-title="<?php echo $row_resultado[$x-1][0] ?>" name="ast" onclick="envia(<?php echo $row_resultado[$x-1][0] ?>)" value="<?php echo $row_resultado[$x-1][0] ?>">
              <img id="img<?php echo $row_resultado[$x-1][0] ?>" src="../assets/img/poltrona_vermelha-sembg.png" style="height: 50px; width: 50px;" alt="">
            </button>
        <?php 
        }else{
          ?>
          <!-- === Poltrona 3 Caso Descoupada === -->
            <button type="button" class="btn" id="poltrona<?php echo $row_resultado[$x-1][0] ?>" data-bs-toggle="" data-bs-placement="bottom" data-bs-title="<?php echo $row_resultado[$x-1][0]?>" name="ast" onclick="envia(<?php echo $row_resultado[$x-1][0] ?>)" value="<?php echo $row_resultado[$x-1][0] ?>">
              <img id="img<?php echo $row_resultado[$x-1][0] ?>" src="../assets/img/poltrona_verde-sembg.png" style="height: 50px; width: 50px;" alt="">
            </button>
            <?php
        }
      }//Fim da Listagem da Terceira Poltrona

      //Listagem da Quarta Poltrona do Lado Direito
      if($y == 4){
        if($row_resultado[$x-1][0] == $row_resultado_ocupado[$z-1][0]){
        ?>
          <!-- === Poltrona 04 Caso Ocupada === -->
          <button type="button" disabled class="btn" id="poltrona<?php echo $row_resultado[$x-1][0] ?>" data-bs-toggle="" data-bs-placement="right" data-bs-title="<?php echo $row_resultado[$x-1][0] ?>" name="ast" onclick="envia(<?php echo $row_resultado[$x-1][0] ?>)" value="<?php echo $row_resultado[$x-1][0] ?>">
            <img id="img<?php echo $row_resultado[$x-1][0] ?>" src="../assets/img/poltrona_vermelha-sembg.png" style="height: 50px; width: 50px;" alt="">
          </button>
         
          </div> <!-- === Fim Lado Direito ===-->
          
        </div> <!-- ==== Fim Linha ==== -->
        <?php
        }else{
          ?>
          <!-- === Poltrona 04 Caso Desocupada === -->
          <button type="button" class="btn" id="poltrona<?php echo $row_resultado[$x-1][0] ?>" data-bs-toggle="" data-bs-placement="right" data-bs-title="<?php echo $row_resultado[$x-1][0]?>" name="ast" onclick="envia(<?php echo $row_resultado[$x-1][0]?>)" value="<?php echo $row_resultado[$x-1][0] ?>">
            <img id="img<?php echo $row_resultado[$x-1][0] ?>" src="../assets/img/poltrona_verde-sembg.png" style="height: 50px; width: 50px;" alt="">
          </button>
         
          </div> <!-- === Fim Lado Direito ===-->
          
        </div> <!-- ==== Fim Linha ==== -->
        <?php
        }
      }//Fim da Listagem da Quarta Poltrona
      


      
    }//Fim da Listagem das Linhas
      ?>
      <hr class="m-1">

      
    </form> 
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
  <!-- Script Assento -->
  <script src="../assets/js/assentos.js"></script>
</body>
