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


$consulta = "SELECT * FROM cupom";

$consulta = mysqli_query($conn, $consulta);
$total_cupom = mysqli_num_rows($consulta);
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Cupom</title>
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
                    <li><a class="nav-link scrollto" href="./voo.php">VOO</a></li>
                    <li><a class="nav-link scrollto" href="./aviao.php">AVIAO</a></li>
                    <li><a class="nav-link scrollto " href="./aeroporto.php">AEROPORTO</a></li>
                    <li><a class="nav-link scrollto active" href="./cupom.php">CUPOM</a></li>
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

    <main style="margin-top: 8em;">
        <div class="container">
            <h1>Cupons</h1>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Cadastrar Cupom
            </button>

            <!-- Modal -->
            <div style="margin-top: 10em;" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastro Cupom</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="../controller/controller_cupom.php" method="post">
                                <label>Código Cupom:</label>
                                <input type="text" id="cupom" name="codigo_cupom" placeholder="XXX000" maxlength="6" required>
                                <label>Valor em Porcentagem:</label>
                                <input type="number" id="valor" name="valor_desconto" maxlength="3" placeholder="20" required>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
            <div class="row mt-4">
                <?php for ($i = 0; $i < $total_cupom; $i++) {
                    $cupom = mysqli_fetch_assoc($consulta); ?>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header">
                                <h4><?php echo $cupom['CODIGO_CUPOM'] ?></h4>
                            </div>

                            <div class="card-body">
                                <p class="mb-4 text-left">
                                    <strong>Valor de desconto - </strong> <?php echo $cupom['VALOR_DESCONTO'] . "%" ?>
                                </p>
                            </div>

                            <div class="card-footer">
                                <a href="./editar_cupom.php?id=<?php echo $cupom['ID_CUPOM'] ?>">
                                    <button type='button' class='btn btn-outline-primary' style='margin-right: 5px;'>Editar</button>
                                </a>
                                
                                <a href="../controller/controller_deletar_cupom.php?id=<?php echo $cupom['ID_CUPOM'] ?>">
                                    <button type='submit' class='btn btn-outline-danger'>Excluir</button>
                                </a>
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