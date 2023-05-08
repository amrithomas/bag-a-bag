<?php
session_start();
include_once('../conexao.php');

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$query = "SELECT * FROM admin WHERE ID_ADM ='$id'";
$consulta = mysqli_query($conn, $query);
if (mysqli_num_rows($consulta) == 1) {
    $row_consulta = mysqli_fetch_assoc($consulta);
} else {
    // Se não encontrou nenhum registro, redireciona para a página de visualização de aviões
    $_SESSION["msg"] = "<p class='text-center' style='color: red;'>Erro ao encontrar admin para edição</p>";
    unset($_SESSION);
    header("Location: perfis.php");
    exit();
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Aeroporto</title>
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
                    <li><a class="nav-link scrollto active" href="./aviao.php">AVIAO</a></li>
                    <li><a class="nav-link scrollto " href="./aeroporto.php">AEROPORTO</a></li>
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
    <main class="container" style="margin-top: 15em;">
        <div class="card">
            <div class="card-header">
                <h1>Editar Admin</h1>
                <?php
                if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                ?>
            </div>
            <form action="../controller/controller_editar_admin.php" method="POST">

                <div class="card-body">
                    <label class="mt-4" for="nome_adm">Nome</label>
                    <input type="text" name="nome_adm" value="<?php echo $row_consulta['NOME_ADM'] ?>" id="nome_adm"> <br>

                    <label class="mt-4" for="email">Email</label>
                    <input type="email" name="email" value="<?php echo $row_consulta['EMAIL_ADM'] ?>" id="email"> <br>

                    <label class="mt-4" for="senha">Senha</label>
                    <input type="password" name="senha" id="senha"> <br>

                    <label class="mt-4" for="confsenha">Confirmar senha</label>
                    <input type="password" name="confsenha" id="senha">
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>