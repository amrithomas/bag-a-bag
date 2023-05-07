<?php
session_start();
include_once('../conexao.php');

$consulta = "SELECT * FROM aeroporto";

$consulta = mysqli_query($conn, $consulta);
$total_aeroporto = mysqli_num_rows($consulta);
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
                    <li><a class="nav-link scrollto active" href="./aerporto.php">AEROPORTO</a></li>
                    <li><a class="nav-link scrollto" href="./cupom.php">CUPOM</a></li>
                    <li><a class="nav-link scrollto" href="./relatorio.php">RELATORIO</a></li>
                    <li><a class="nav-link scrollto" href="./perfis.php">PERFIS</a></li>
                    <?php
                    // VERIFICANDO SE TEM UM USUARIO LOGADO
                    if (isset($_SESSION['id_usuario'])) {
                        $id = $_SESSION['id_usuario'];

                        $query = "SELECT * FROM usuario 
                        INNER JOIN telefone ON FK_TELEFONE = ID_TELEFONE 
                        INNER JOIN cadastro ON FK_CADASTRO = ID_CADASTRO
                        WHERE ID_USUARIO='$id'";
                        $query = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($query);
                        // SE ESTIVER LOGADO APARECERÁ AS SEGUINTES INFORMAÇÕES
                        echo '<li><a class="getstarted scrollto" href="pages/user.php?id=' . $row["ID_USUARIO"] . '" style="margin-left: 80px;">Ver perfil</a></li>';
                        echo '<li><a class="nav-link scrollto" href="back/controller/controller_logoff.php">LOGOFF</a></li>';
                    }
                    ?>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
        </div>
    </header>

    <body style="margin-top: 8em;">
        <div class="container">
            <h1>Aeroportos</h1>
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
            <div class="row mt-4">
                <?php for ($i = 0; $i < $total_aeroporto; $i++) {
                    $areporto = mysqli_fetch_assoc($consulta); ?>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header">
                                <h4><?php echo $areporto['SIGLA'] ?> - <?php echo $areporto['NOME_AEROPORTO'] ?></h4>
                            </div>

                            <div class="card-body">
                                <p class="mb-4 text-left">
                                    <strong>País - </strong> <?php echo $areporto['PAIS'] ?>
                                    <br><br>
                                    <strong>Cidade - </strong> <?php echo $areporto['CIDADE'] ?>
                                </p>
                            </div>

                            <div class="card-footer">
                                <button type="button" class="btn btn-outline-primary" style="margin-right: 5px;">Editar</button>

                                <?php echo
                                "<a href='../controller/controller_deletar_aeroporto.php?id=" . $areporto['ID_AEROPORTO'] . "'>
                                <button type='submit' class='btn btn-outline-danger'>Excluir</button>
                                </a>" ?>
                            </div>
                        </div>
                    </div>

                <?php } ?>
            </div>
        </div>
    </body>

    <footer style="height: 100px;"></footer>
</main>