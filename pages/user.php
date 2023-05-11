<?php
session_start();
include_once('../back/conexao.php');

$id = $_GET["id"];

$_SESSION['id_usuario'] = $id;

$query = "SELECT * FROM usuario 
    INNER JOIN telefone ON FK_TELEFONE = ID_TELEFONE 
    INNER JOIN cadastro ON FK_CADASTRO = ID_CADASTRO
    WHERE ID_USUARIO='$id'";
$query = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($query);

if (empty($row)) {
  header('Location: login.php');
}
//Select para puxar dados da reserva | While para apresentar dados necessários posteriormente
$query4= "SELECT ID_RESERVA FROM reserva WHERE FK_USUARIO = '$id'";
  $result4 = mysqli_query($conn, $query4);
  $row4 = mysqli_fetch_assoc($result4);
  
  $reservas_ids = [];
  $j = 0;
  $total_reserva = 0; 
  while ($row4 = mysqli_fetch_assoc($result4)) {
    $total_reserva++;
    $reservas_ids[$j] = $row4['ID_RESERVA'];
    $j++;
  }
  
  for ($i=0; $i < count($reservas_ids) ; $i++) { 
    
  } 
 // select para apresentar origem e destino (aeroportos)
  $query1 = "SELECT  * FROM passagem 
  INNER JOIN reserva ON ID_RESERVA = FK_RESERVA
  INNER JOIN voo ON FK_VOO = ID_VOO
  INNER JOIN aviao ON ID_AVIAO = FK_AVIAO_IDA
  INNER JOIN aeroporto AS origem ON FK_ORIGEM_AERO = origem.ID_AEROPORTO
  INNER JOIN aeroporto AS destino ON FK_DESTINO_AERO = destino.ID_AEROPORTO
  WHERE FK_USUARIO = '$id'
  GROUP BY FK_RESERVA
  ORDER BY ID_RESERVA DESC;";

$result1 = mysqli_query($conn, $query1);

//select para trazer dados de voo
$query2 = "SELECT  passagem.*, aviao.*, origem.CIDADE as ORIGEM_CIDADE, destino.CIDADE as DESTINO_CIDADE
FROM passagem
INNER JOIN reserva ON ID_RESERVA = FK_RESERVA
INNER JOIN voo ON FK_VOO = ID_VOO
INNER JOIN aviao ON ID_AVIAO = FK_AVIAO_IDA
JOIN aeroporto origem ON voo.FK_ORIGEM_AERO = origem.ID_AEROPORTO
JOIN aeroporto destino ON voo.FK_DESTINO_AERO = destino.ID_AEROPORTO
WHERE FK_USUARIO = '$id'
GROUP BY FK_RESERVA
ORDER BY ID_RESERVA DESC;";

$result2 = mysqli_query($conn, $query2);
// select para trazer dados de código do avião, reserva (distinguir usuários de cada reserva)
$query3 = "SELECT a1.CODIGO_AVIAO AS CODIGO_AVIAO_IDA, 
                  a2.CODIGO_AVIAO AS CODIGO_AVIAO_VOLTA
           FROM passagem
           INNER JOIN reserva ON ID_RESERVA = FK_RESERVA
           INNER JOIN voo ON FK_VOO = ID_VOO
           INNER JOIN aviao ON ID_AVIAO = FK_AVIAO_IDA
           JOIN aviao a1 ON FK_AVIAO_IDA = a1.ID_AVIAO
           LEFT JOIN aviao a2 ON FK_AVIAO_VOLTA = a2.ID_AVIAO
           WHERE FK_USUARIO = '$id'
           GROUP BY FK_RESERVA
           ORDER BY ID_RESERVA DESC;";

$result3 = mysqli_query($conn, $query3);

// Criar o array associativo combinando os resultados dos SELECTs
$data = array();
while ($row2 = mysqli_fetch_assoc($result2)) {
  $row1 = mysqli_fetch_assoc($result1);
  $combined_row = array_merge($row1, $row2);
  $row3 = mysqli_fetch_assoc($result3);
  $final_row = array_merge($combined_row, $row3);
  $data[] = $final_row;
}



?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

  <title>Bag-a-Bagₑ - User</title>
  <meta content="" name="description" />
  <meta content="" name="keywords" />

  <!-- Favicons -->
  <link href="../assets/img/airplane_favicon.png" rel="icon" />
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />
  <!-- Import CSS Files -->
  <link rel="stylesheet" href="../assets/css/destinos/destinos.css">
  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet" />
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
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
          <li><a class="nav-link scrollto " href="./destinos.php">DESTINOS</a></li>
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
          <li><a class="getstarted scrollto" href="<?php echo "user.php?id=" . $row['ID_USUARIO'] ?>" style = "margin-left: 80px;">Ver perfil</a></li>
          <li><a class="nav-link scrollto" href="../back/controller/controller_logoff.php" >LOGOFF</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header>
  <!-- End Header -->
  <main id="main" class="mt-5 container">
    <section class="row d-flex align-items-center justify-content-center" id="profile">
    <?php
    if (isset($_SESSION['msg'])) {
      echo $_SESSION['msg'];
      unset($_SESSION['msg']);
    }
    ?>
      <img src="../assets/img/user/icone_perfil.png" alt="" class="col-lg-2 col-sm-6">
      <div class="col-lg-8 col-sm-6 mt-2">
        <h1><?php echo ucfirst($row['NOME']) . ' ' . ucfirst($row['NOME_MEIO']) . ' ' . ucfirst($row['SOBRENOME']) ?></h1>
        <p>E-mail: <?php echo $row['EMAIL'] ?></p>
        <p>CPF: <?php echo $row['CPF'] ?></p>
        <p>Telefone: <?php echo $row['DDD'] . ' ' . $row['NUMERO_TELEFONE'] ?></p>
      </div>
      <div class="col-lg-2">
        <a href="<?php echo "alteracoes_cadastro.php?id=" . $row['ID_USUARIO'] ?>">
          <button type="submit" style="min-width: 80px;" class="btn btn-outline-success text-center">
            <i class="bi bi-gear"></i>
            Editar
          </button>
        </a>
      </div>
    </section>

    <section id="reservar" class="container">
      <!-- Verificando se tem uma reserva para apresentar a mensagem -->
    <?php if (!empty($data[$i]['ID_RESERVA'])) { ?>
      <h2 class="text-center">Últimas Reservas</h2>
      <?php } ?>
      <!-- Trazendo os dados de reservas encontrados nos selects -->
      <?php for ($i=0; $i < count($data); $i++) {  
        
        if (!is_null($data[$i]['FK_AVIAO_IDA']) && !is_null($data[$i]['FK_AVIAO_VOLTA'])) {
          // A reserva tem FK_AVIAO_IDA e FK_AVIAO_VOLTA preenchidos, logo é ida e volta
          $tipo_passagem = "Reserva de ida e volta";
        } elseif (!is_null($data[$i]['FK_AVIAO_IDA']) && is_null($data[$i]['FK_AVIAO_VOLTA'])) {
          // A reserva tem apenas FK_AVIAO_IDA preenchido, logo é apenas ida
          $tipo_passagem = "Reserva de ida";
          $data[$i]['CODIGO_AVIAO_VOLTA'] = '-';
        } elseif (!is_null($data[$i]['FK_AVIAO_VOLTA']) && is_null($data[$i]['FK_AVIAO_IDA'])) {
          // A reserva tem apenas FK_AVIAO_VOLTA preenchido, logo é apenas volta
          $tipo_passagem = "Reserva de volta";
          $data[$i]['CODIGO_AVIAO_IDA'] = '-';
        } else {
          // Nenhum dos campos está preenchido, logo não é possível determinar o tipo dos campos
          $tipo_passagem = "";
          $data[$i]['CIDADE'] = "";
          $data[$i]['CIDADE'] = "";
          $data[$i]['CODIGO_AVIAO_IDA'] = "";
          $data[$i]['CODIGO_AVIAO_VOLTA'] = "";
          $data[$i]['VALOR_TOTAL'] = "";
          $data[$i]['ID_RESERVA'] = "";
        }
        
        ?>
        <!-- Apresentação dos dados de Reserva e Passageiros  -->
        <?php if (!empty($data[$i]['ID_RESERVA'])) { ?>
          <div class="card col-12 mt-5" style="width: 100%;">
            <div class="card-body">
            <h5 class="card-title">ID da Reserva: <?php echo $data[$i]['ID_RESERVA'] ?></h5>
            <h5 class="card-title">Status: <?php echo $data[$i]['STATUS_RESERVA'] ?></h5>
            <h6 class="card-subtitle mb-2 text-body-secondary mt-4">Origem: <?php echo $data[$i]['ORIGEM_CIDADE'] ?> </h6>
            <h6 class="card-subtitle mb-2 text-body-secondary mt-4">Destino: <?php echo $data[$i]['DESTINO_CIDADE'] ?> </h6>
            <h6 class="card-subtitle mb-2 text-body-secondary mt-4">Data da Viagem: <?php echo date_format(date_create($data[$i]['IDA_HORARIO_PARTIDA']), 'd/m/Y') ?> </h6>
            <p class="card-text mt-2">Tipo da passagem: <?php echo $tipo_passagem ?></p>
            <p class="card-text mt-2">Código do avião de ida: <?php echo $data[$i]['CODIGO_AVIAO_IDA'] ?> </p>
            <p class="card-text mt-2">Código do avião de volta: <?php echo $data[$i]['CODIGO_AVIAO_VOLTA'] ?> </p>
            <p class="card-text mt-2">Preço: R$ <?php echo $data[$i]['VALOR_TOTAL'] ?> </p>
            <h5 class="card-title">Detalhes do(s) passageiro(s)</h5>
            <!-- Trazendo os passageiros da reserva  -->
            <?php 
              $query_passageiro = "SELECT * FROM passagem
              INNER JOIN reserva ON ID_RESERVA = FK_RESERVA
              INNER JOIN voo ON FK_VOO = ID_VOO
              INNER JOIN aeroporto ON FK_DESTINO_AERO = ID_AEROPORTO
              INNER JOIN aviao ON ID_AVIAO = FK_AVIAO_IDA
              INNER JOIN passageiro ON FK_PASSAGEIRO = ID_PASSAGEIRO
              INNER JOIN telefone ON FK_TELEFONE = ID_TELEFONE
                                  WHERE FK_RESERVA = ".$data[$i]['ID_RESERVA'];
              $result_passageiro = mysqli_query($conn, $query_passageiro);
              while ($row_passageiro = mysqli_fetch_assoc($result_passageiro)) { 
                //exibe  informações do passageiro
                $data_formatada = date("d/m/Y", strtotime($row_passageiro['DATA_NASC_PASSAGEIRO']));
                //exibe a data formatada
                ?>
                <h6 class="card-subtitle mb-2 text-body-secondary mt-4">Nome: <?php echo ucfirst($row_passageiro['NOME_PASSAGEIRO']) . ' ' . $row_passageiro['SOBRENOME_PASSAGEIRO']; ?></h6>
                <p class="card-text mt-2">E-mail: <?php echo $row_passageiro['EMAIL_PASSAGEIRO']; ?></p>
                <!-- <p class="card-text mt-2">CPF: <?php echo $row_passageiro['CPF_PASSAGEIRO']; ?></p> -->
                <!-- <p class="card-text mt-2">Data de nascimento: <?php echo $data_formatada; ?></p> -->
                <p class="card-text mt-2">Telefone: <?php echo $row_passageiro['DDD'] . ' ' . $row_passageiro['NUMERO_TELEFONE']; ?></p>
            <?php } 
              // buscando ano/mês/dia de agora | buscando ano/mês/dia do voo da reserva
              $agora = date('Y-m-d');
              $data_partida = date('Y-m-d', strtotime($data[$i]['IDA_HORARIO_PARTIDA']));
              
              $diff = date_diff(date_create($data_partida), date_create($agora));
              $dias_para_voo = $diff->days;
            ?>
            <?php if($data_partida < $agora && ($data[$i]['STATUS_RESERVA'] == 'Confirmada' || $data[$i]['STATUS_RESERVA'] == 'Pendente')){ ?>
              <p class="card-text mt-2" style="color: green">Voo realizado </p>
            <!-- Verificando se a data de partida do voo (daquela reserva) é posterior a data atual em dois dias, e a reserva é ou confirmada ou pendente (para conseguir cancelar caso o usuário queira)  -->
            <?php } else if(($data_partida > $agora) && ($dias_para_voo > 2) && ($data[$i]['STATUS_RESERVA'] == 'Confirmada' || $data[$i]['STATUS_RESERVA'] == 'Pendente')){  ?>
              <form action="../back/controller/controller_update_reserva.php" method="post">
                <input type="hidden" name="id_reserva" value="<?php echo $data[$i]['ID_RESERVA']; ?>">
                <button type="submit" style="min-width: 80px;" class="btn btn-outline-danger text-center " onclick="location.reload();">
                  <i class="bi bi-x-lg"></i>
                Cancelar
              </button>
              </form>
          <?php } ?> 
        <?php } ?> 
        </div>
      </div>
      <?php }?>
  </section> 
  </main>


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
              <li><i class="bx bx-chevron-right"></i> <a href="<?php echo "user.php?id=" . $row['ID_USUARIO'] ?>">Ver perfil</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="../back/controller/controller_logoff.php">Logoff</a></li>
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
  </footer><!-- End Footer -->
</body>