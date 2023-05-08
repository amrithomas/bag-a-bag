<?php
session_start();
include_once('../conexao.php');
include_once("../funcoes.php");
$reservas_canceladas = "SELECT COUNT(*) FROM reserva WHERE STATUS_RESERVA = 'Cancelada'";
$resultado_reservas_canceladas = mysqli_query($conn, $reservas_canceladas);
$num_reservas_canceladas = mysqli_fetch_array($resultado_reservas_canceladas)[0];

$id_adm = $_SESSION['id_adm'] ;
  
$query1 = "SELECT * FROM admin 
  WHERE ID_ADM='$id_adm'";
$query1 = mysqli_query($conn, $query1);
$row1 = mysqli_fetch_assoc($query1);

if(empty($row1)) {
  echo "<script>location.href='../../index.php';</script>";
}

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Relatorio</title>
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


    <!-- Template Main CSS File -->
    <link href="../../assets/css/style.css" rel="stylesheet">

</head>

<main>
     <!-- ======= header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo"><a href="index.php">BAG-A-BAGₑ</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto " href="./admin.php">PAINEL</a></li>
                    <li><a class="nav-link scrollto" href="./voo.php">VOO</a></li>
                    <li><a class="nav-link scrollto" href="./aviao.php">AVIAO</a></li>
                    <li><a class="nav-link scrollto " href="./aeroporto.php">AEROPORTO</a></li>
                    <li><a class="nav-link scrollto" href="./cupom.php">CUPOM</a></li>
                    <li><a class="nav-link scrollto active" href="./relatorio.php">RELATORIO</a></li>
                    <li><a class="nav-link scrollto " href="./perfis.php">PERFIS</a></li>
                    <?php
                    // VERIFICANDO SE TEM UM USUARIO LOGADO
                    echo '<li><a class="nav-link scrollto" href="../controller/controller_logoff_admin.php" >LOGOFF</a></li>';
                    ?>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
        </div>
    </header>

    <body style="margin-top: 8em;">
        <div class="container">
            <h1>Relatório</h1>
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>

            <br><div class="col-md-7">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h4>Reservas Canceladas</h4>
                    </div>
                    <div class="card-body">
                        <p class="mb-4 text-left" style="font-weight: bold;">
                            <?php echo "Número de reservas canceladas: " . $num_reservas_canceladas; ?>
                        </p>
                    </div>
                    <div class="card-footer">
                        <br>
                    </div>
                </div><br>

                <div class="col-md-12">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h4>Total de Passageiros por Destino</h4>
                    </div>
                    <div class="card-body">
                    <?php

                        // Executar a consulta SQL para selecionar os aeroportos
                        $sql = "SELECT * FROM aeroporto ORDER BY NOME_AEROPORTO";
                        $resultado = mysqli_query($conn, $sql);

                        // Criar o dropdown de cidades
                        echo "<form method='post'>";
                        echo "<select name='aeroporto'>";
                        while ($row = mysqli_fetch_assoc($resultado)) {
                            echo "<option value='" . $row['ID_AEROPORTO'] . "'>" . $row['CIDADE'] . " - " . $row['SIGLA'] . "</option>";
                        }
                        echo "</select>";
                        echo "<input type='submit' value='Filtrar'>";
                        echo "</form>";

                        // Se o formulário foi submetido, executar a consulta SQL para selecionar os voos
                        if (isset($_POST['aeroporto'])) {
                            $id_aeroporto = $_POST['aeroporto'];
                            $sql_nome = "SELECT * FROM aeroporto WHERE ID_AEROPORTO = $id_aeroporto";
                            $result_nome = mysqli_query($conn, $sql_nome);
                            $row_nome = mysqli_fetch_assoc($result_nome);

                            // $sql = "SELECT * FROM voo WHERE FK_ORIGEM_AERO = $id_aeroporto";
                            $sql = "SELECT COUNT(*) FROM passagem
                                        INNER JOIN passageiro ON passagem.FK_PASSAGEIRO = passageiro.ID_PASSAGEIRO
                                        INNER JOIN reserva ON passagem.FK_RESERVA = reserva.ID_RESERVA
                                        INNER JOIN voo ON passagem.FK_VOO = voo.ID_VOO
                                        WHERE FK_DESTINO_AERO = $id_aeroporto";
                            $resultado = mysqli_query($conn, $sql);

                            // Exibir os resultados em uma tabela
                            echo "<table>";
                            echo "<tr><th>Passageiros para " . $row_nome['CIDADE'] . " - " . $row_nome['SIGLA'] ."</th></tr>";
                            $num_passageiros = mysqli_fetch_array($resultado)[0];
                            echo "<tr><td>" . $num_passageiros . "</td></tr>";
                            echo "</table>";
                        }

                    ?>
                    </div>
                    <div class="card-footer">
                        <br>
                    </div>
                </div><br>

                <div class="col-md-12">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h4>Total de Passageiros por Data</h4>
                    </div>
                    <div class="card-body">
                    <?php
                        // Executar a consulta SQL para selecionar os aeroportos
                        $sql = "SELECT * FROM voo ORDER BY ID_VOO";
                        $resultado = mysqli_query($conn, $sql);

                        // Criar o dropdown de cidades
                        echo "<form method='post'>";
                        echo '<input type="date" name="data" id="data">';   
                        echo "<input type='submit' value='Buscar'>";
                        echo "</form>";

                        // Se o formulário foi submetido, executar a consulta SQL para selecionar os voos
                        if (isset($_POST['data'])) {
                            $data = $_POST['data'];

                            // $sql = "SELECT * FROM voo WHERE FK_ORIGEM_AERO = $id_aeroporto";
                            $sql = "SELECT COUNT(*) FROM passagem
                                        INNER JOIN passageiro ON passagem.FK_PASSAGEIRO = passageiro.ID_PASSAGEIRO
                                        INNER JOIN reserva ON passagem.FK_RESERVA = reserva.ID_RESERVA
                                        INNER JOIN voo ON passagem.FK_VOO = voo.ID_VOO
                                        WHERE IDA_HORARIO_PARTIDA LIKE '%$data%'";
                            $resultado = mysqli_query($conn, $sql);

                            // Exibir os resultados em uma tabela
                            echo "<table>";
                            echo "<tr><th>Passageiros na data de " . date("d/m/Y", strtotime($data)) . "</th></tr>";
                            $num_passageiros = mysqli_fetch_array($resultado)[0];
                            echo "<tr><td>" . $num_passageiros . "</td></tr>";
                            echo "</table>";
                        }

                    ?>
                    </div>
                    <div class="card-footer">
                        <br>
                    </div>
            </div><br>
            <div class="col-md-12">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h4>Consulta de CPF</h4>
                    </div>
                    <div class="card-body">
                    <?php
                        // Executar a consulta SQL para selecionar os aeroportos
                        $sql = "SELECT * FROM voo ORDER BY ID_VOO";
                        $resultado = mysqli_query($conn, $sql);

                        // Criar o dropdown de cidades
                        echo "<form method='post'>";
                        echo '<input type="text" name="cpf" id="cpf">';   
                        echo "<input type='submit' value='Buscar'>";
                        echo "</form>";

                        // Se o formulário foi submetido, executar a consulta SQL para selecionar os voos
                        if (isset($_POST['cpf'])) {
                            $cpf = $_POST['cpf'];
                            $cpf = trim($cpf);
                            $cpf = str_replace(".","",$cpf);
                            $cpf = str_replace("-","",$cpf);

                            if (validarCPF($cpf)){
                                // $sql = "SELECT * FROM voo WHERE FK_ORIGEM_AERO = $id_aeroporto";
                                $sql = "SELECT * FROM passagem
                                            INNER JOIN passageiro ON passagem.FK_PASSAGEIRO = passageiro.ID_PASSAGEIRO
                                            INNER JOIN reserva ON passagem.FK_RESERVA = reserva.ID_RESERVA
                                            INNER JOIN voo ON passagem.FK_VOO = voo.ID_VOO
                                            INNER JOIN aviao ON  voo.FK_AVIAO_IDA = aviao.ID_AVIAO
                                            WHERE CPF_PASSAGEIRO LIKE '%$cpf%'";
                                $resultado = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($resultado);

                                if(!empty($row)) {
                                // Exibir os resultados em uma tabela
                                echo "<table>";
                                echo "<tr><th>" . $row['NOME_PASSAGEIRO'] . " está alocado em " . $row['CODIGO_AVIAO'] . "</th></tr>";
                                echo "</table>";
                                } else {
                                    echo "CPF NÃO EXISTE.";
                                }
                            } else {
                                echo "CPF NÃO EXISTE.";
                            }
                        }

                    ?>
                    </div>
                    <div class="card-footer">
                        <br>
                    </div>
            </div>
        </div>
</main>
