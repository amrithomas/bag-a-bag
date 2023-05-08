<!-- ARQUIVO DE TESTES -->
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

$query = "SELECT * FROM aviao";
$consulta_aviao = mysqli_query($conn, $query);
$total_aviao = mysqli_num_rows($consulta_aviao);


$query = "SELECT * FROM aeroporto";
$consulta_aeroporto = mysqli_query($conn, $query);
$total_aeroporto = mysqli_num_rows($consulta_aeroporto);
$aeroporto = mysqli_fetch_assoc($consulta_aeroporto);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Voo</title>
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

<body class="container">
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
    <div class="card" style="margin-top: 10em;">
        <div class="card-header">
            <h1>Cadastrar Voo</h1>
        </div>
        <div class="card-body">
            <form name="voo" action="../controller/controller_adicionar_voo.php" method="post">
                <div>
                    <h3 class="mt-4">Aeronave Ida</h3>
                    <select name="aviao_ida" id="" require>
                        <option value="">--</option>
                        <?php mysqli_data_seek($consulta_aviao, 0); // reinicia o ponteiro do resultado 
                        ?>
                        <?php while ($aviao = mysqli_fetch_assoc($consulta_aviao)) { ?>
                            <option value="<?php echo $aviao['ID_AVIAO'] ?>"><?php echo $aviao['CODIGO_AVIAO'] ?></option>
                        <?php } ?>
                    </select>
                    <h3 class="mt-4">Aeronave Volta</h3>
                    <select name="aviao_volta" id="">
                        <option value="">--</option>
                        <?php mysqli_data_seek($consulta_aviao, 0); // reinicia o ponteiro do resultado 
                        ?>
                        <?php while ($aviao = mysqli_fetch_assoc($consulta_aviao)) { ?>
                            <option value="<?php echo $aviao['ID_AVIAO'] ?>"><?php echo $aviao['CODIGO_AVIAO'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div>
                    <h3 class="mt-4">Aeroporto Origem</h3>
                    <select name="aeroporto_origem" id="" require>
                        <option value="">--</option>
                        <?php mysqli_data_seek($consulta_aeroporto, 0);
                        while ($aeroporto = mysqli_fetch_assoc($consulta_aeroporto)) { ?>
                            <option value="<?php echo $aeroporto['ID_AEROPORTO']?>"><?php echo $aeroporto['NOME_AEROPORTO'] ?></option>
                        <?php } ?>
                    </select>
                    <h3 class="mt-4">Aeroporto Destino</h3>
                    <select name="aeroporto_destino" id="" require>
                        <option value="">--</option>
                        <?php mysqli_data_seek($consulta_aeroporto, 0);
                        while ($aeroporto = mysqli_fetch_assoc($consulta_aeroporto)) { ?>
                            <option value="<?php echo $aeroporto['ID_AEROPORTO']?>"><?php echo $aeroporto['NOME_AEROPORTO'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="d-flex">
                    <div style="margin-right: 44px;">
                        <h3 class="mt-4">Horario partida Ida</h3>
                        <input type="datetime-local" name="horario_partida_ida" require>
                    </div>
                    <div>
                        <h3 class="mt-4">Horario chegada Ida</h3>
                        <input type="datetime-local" name="horario_chegada_ida" require>
                    </div>
                </div>

                <div class="d-flex">
                    <div style="margin-right: 20px;">
                        <h3 class="mt-4">Horario partida Volta</h3>
                        <input type="datetime-local" name="horario_partida_volta">
                    </div>
                    <div>
                        <h3 class="mt-4">Horario chegada Volta</h3>
                        <input type="datetime-local" name="horario_chegada_volta">
                    </div>
                </div>

                <div>
                    <h3 class="mt-4">Aeroporto Escala Ida</h3>
                    <select name="aeroporto_escala_ida" id="" >
                        <option value="">--</option>
                        <?php mysqli_data_seek($consulta_aeroporto, 0);
                            while ($aeroporto = mysqli_fetch_assoc($consulta_aeroporto)) { ?>
                            <option value="<?php echo $aeroporto['ID_AEROPORTO']?>"><?php echo $aeroporto['NOME_AEROPORTO'] ?></option>
                        <?php } ?>
                    </select>
                    <label for="">Previsão Escala Ida</label>
                    <input type="datetime-local" name="horario_ida_escala">
                    <label for="">Duração Escala Ida</label>
                    <input type="time" name="tempo_escala_ida" step="1">

                    <h3 class="mt-4">Aeroporto Escala Volta</h3>
                    <select name="aeroporto_escala_volta" id="" >
                        <option value="">--</option>
                        <?php mysqli_data_seek($consulta_aeroporto, 0);
                            while ($aeroporto = mysqli_fetch_assoc($consulta_aeroporto)) { ?>
                            <option value="<?php echo $aeroporto['ID_AEROPORTO']?>"><?php echo $aeroporto['NOME_AEROPORTO'] ?></option>
                        <?php } ?>
                    </select>
                    <label for="">Previsão Escala Volta</label>
                    <input type="datetime-local" name="horario_volta_escala">
                    <label for="">Duração Escala Volta</label>
                    <input type="time" name="tempo_escala_volta" step="1">
                </div>

                <div>
                    <h3 class="mt-4">Valor Passagem</h3>
                    <input type="text" name="valor_passagem">
                </div>
                <div class="mt-4 card-footer text-center">
                    <input class="btn btn-primary" type="submit"></input>
                </div>
            </form>
        </div>
    </div>

    <footer style="height: 100px;"></footer>
</body>

</html>