<?php
session_start();
include_once('../conexao.php');

$id = $_SESSION['id_adm'] ;
  
$query = "SELECT * FROM admin 
  WHERE ID_ADM='$id'";
$query = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($query);

if(empty($row)) {
  echo "<script>location.href='../../index.php';</script>";
}

$consulta = "SELECT 
    voo.ID_VOO,
    voo.VALOR_PASSAGEM,
    voo.IDA_HORARIO_PARTIDA,
    voo.IDA_HORARIO_CHEGADA,
    voo.VOLTA_HORARIO_PARTIDA,
    voo.VOLTA_HORARIO_CHEGADA,
    av1.CODIGO_AVIAO AS CODIGO_AVIAO_IDA,
    av2.CODIGO_AVIAO AS CODIGO_AVIAO_VOLTA,
    origem.NOME_AEROPORTO AS NOME_AEROPORTO_ORIGEM,
    destino.NOME_AEROPORTO AS NOME_AEROPORTO_DESTINO,
    aeroporto_ida.NOME_AEROPORTO AS NOME_AEROPORTO_ESCALA_IDA,
    aeroporto_volta.NOME_AEROPORTO AS NOME_AEROPORTO_ESCALA_VOLTA
    FROM voo 
    LEFT JOIN aeroporto AS origem ON voo.FK_ORIGEM_AERO = origem.ID_AEROPORTO
    LEFT JOIN aeroporto AS destino ON voo.FK_DESTINO_AERO = destino.ID_AEROPORTO
    LEFT JOIN escala AS escala_ida ON voo.FK_ESCALA_IDA = escala_ida.ID_ESCALA
    LEFT JOIN escala AS escala_volta ON voo.FK_ESCALA_VOLTA = escala_volta.ID_ESCALA
    LEFT JOIN aeroporto AS aeroporto_ida ON escala_ida.FK_AEROPORTO_ESCALA = aeroporto_ida.ID_AEROPORTO
    LEFT JOIN aeroporto AS aeroporto_volta ON escala_volta.FK_AEROPORTO_ESCALA = aeroporto_volta.ID_AEROPORTO
    LEFT JOIN aviao AS av1 ON voo.FK_AVIAO_IDA = av1.ID_AVIAO
    LEFT JOIN aviao AS av2 ON voo.FK_AVIAO_VOLTA = av2.ID_AVIAO
";


$consulta = mysqli_query($conn, $consulta);
$total_voos = mysqli_num_rows($consulta);
?>

<html>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Voo</title>
    <!-- Favicons -->
    <link href="../../assets/img/airplane_favicon.png" rel="icon">
    <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Template Main CSS File -->
    <link href="../../assets/css/style.css" rel="stylesheet">

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
                    <li><a class="nav-link scrollto " href="./admin.php">PAINEL</a></li>
                    <li><a class="nav-link scrollto active" href="./voo.php">VOO</a></li>
                    <li><a class="nav-link scrollto" href="./aviao.php">AVIAO</a></li>
                    <li><a class="nav-link scrollto " href="./aeroporto.php">AEROPORTO</a></li>
                    <li><a class="nav-link scrollto" href="./cupom.php">CUPOM</a></li>
                    <li><a class="nav-link scrollto" href="./relatorio.php">RELATORIO</a></li>
                    <li><a class="nav-link scrollto" href="./perfis.php">PERFIS</a></li>
                    <?php
                    // VERIFICANDO SE TEM UM USUARIO LOGADO
                    echo '<li><a class="nav-link scrollto" href="../controller/controller_logoff_admin.php" >LOGOFF</a></li>';
                    ?>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
        </div>
    </header>

    <main style="margin-top:  8em;">
        <div class="container">
            <h1>Voos</h1>
            <a href="./criar_voo.php">
                <button type="button" class="btn btn-primary">Cadastrar Voo</button>
            </a>
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
            <div class="row mt-4">
                <?php for ($i = 0; $i < $total_voos; $i++) {
                    $voo = mysqli_fetch_assoc($consulta);
                ?>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header">
                                <h4>Numero do Voo - <?php echo $voo['ID_VOO'] ?></h4>
                            </div>
                            <div class="card-body mt-2">
                                <p class="mb-4 text-left">
                                    <strong>Origem </strong> - <?php echo $voo['NOME_AEROPORTO_ORIGEM'] ?>
                                    <br>
                                    <strong>Destino </strong> - <?php echo $voo['NOME_AEROPORTO_DESTINO'] ?>
                                </p>

                                <p class="mb-4 text-left">
                                    <strong>Preço base - </strong> <?php echo $voo['VALOR_PASSAGEM'] ?>
                                    <br><br>
                                    <strong>Horario de Ida - </strong> <?php echo $voo['IDA_HORARIO_PARTIDA'] ?>
                                    <br><br>
                                    <strong>Previsão chegada ida - </strong> <?php echo $voo['IDA_HORARIO_CHEGADA'] ?>
                                    <br><br>
                                    <strong>Horario Volta - </strong> <?php echo $voo['VOLTA_HORARIO_PARTIDA'] ?>
                                    <br><br>
                                    <strong>Previsão chegada volta - </strong> <?php echo $voo['VOLTA_HORARIO_CHEGADA'] ?>
                                </p>

                                <p class="mb-4 text-left">
                                    <strong>Avião Ida - </strong> <?php echo $voo['CODIGO_AVIAO_IDA'] ?>
                                    <br><br>
                                    <strong>Avião Volta - </strong> <?php echo $voo['CODIGO_AVIAO_VOLTA'] ?>
                                </p>

                                <p class="mb-4 text-left">
                                    <strong>Escala de Ida - </strong> <?php echo $voo['NOME_AEROPORTO_ESCALA_IDA'] ?>
                                    <br><br>
                                    <strong>Escala de Volta - </strong> <?php echo $voo['NOME_AEROPORTO_ESCALA_VOLTA'] ?>
                                </p>
                            </div>
                            <div class="card-footer">
                                <?php
                                echo
                                "<a href='./editar_voo.php?id=" . $voo['ID_VOO'] .  "'>
                                <button type='button' class='btn btn-outline-primary' style='margin-right: 5px;''>Editar</button>
                                </a>"
                                ?>
                                <?php echo
                                "<a href='../controller/controller_deletar_voo.php?id=" . $voo['ID_VOO'] . "'>
                                    <button type='submit' class='btn btn-outline-danger'>Excluir</button>
                                    </a>" ?>

                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>

    <footer style="height: 100px;"></footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</html>