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
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
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

<body>
    <!-- ======= header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo"><a href="index.php">BAG-A-BAGₑ</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#">PAINEL</a></li>
                    <li><a class="nav-link scrollto" href="./voo.php">VOO</a></li>
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

    <main style="margin-top: 10em;">
        <div class="container">
            <div class="card">
                <div class="card-header p-4">
                    <h1>Bem-vindo(a) ao painel de administração da plataforma Bag-A-Bag!</h1>
                </div>
                <div class="card-body p-4">
                    <p class="h5">Nós da equipe Bag-A-Bag estamos felizes em tê-lo(a) conosco. Como administrador(a) da plataforma,
                        você terá acesso a diversas ferramentas e recursos para gerenciar reservas de passagens de forma eficiente e segura. <br><br>
                        Nosso objetivo é proporcionar aos nossos clientes uma experiência de reserva de viagens rápida, fácil e agradável.
                        Com a sua ajuda, podemos garantir que todos os passageiros possam viajar com segurança e conforto, independentemente do destino.</p>
                </div>
                <hr>
                <div class="card-body">
                    <div class="row">
                        <div href="./voo.php" style="cursor: pointer;" class="col-6">
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-airplane" viewBox="0 0 24 24">
                                    <path d="M6.428 1.151C6.708.591 7.213 0 8 0s1.292.592 1.572 1.151C9.861 1.73 10 2.431 10 3v3.691l5.17 2.585a1.5 1.5 0 0 1 .83 1.342V12a.5.5 0 0 1-.582.493l-5.507-.918-.375 2.253 1.318 1.318A.5.5 0 0 1 10.5 16h-5a.5.5 0 0 1-.354-.854l1.319-1.318-.376-2.253-5.507.918A.5.5 0 0 1 0 12v-1.382a1.5 1.5 0 0 1 .83-1.342L6 6.691V3c0-.568.14-1.271.428-1.849Zm.894.448C7.111 2.02 7 2.569 7 3v4a.5.5 0 0 1-.276.447l-5.448 2.724a.5.5 0 0 0-.276.447v.792l5.418-.903a.5.5 0 0 1 .575.41l.5 3a.5.5 0 0 1-.14.437L6.708 15h2.586l-.647-.646a.5.5 0 0 1-.14-.436l.5-3a.5.5 0 0 1 .576-.411L15 11.41v-.792a.5.5 0 0 0-.276-.447L9.276 7.447A.5.5 0 0 1 9 7V3c0-.432-.11-.979-.322-1.401C8.458 1.159 8.213 1 8 1c-.213 0-.458.158-.678.599Z" />
                                </svg>
                                <h2 class="ml-3 text-xl font-semibold text-gray-900">
                                    <a href="./voo.php">Voos</a>
                                </h2>
                            </div>

                            <p class="mt-4 text-black ">
                                Bem-vindo(a) à página de cadastro de voos da plataforma Bag-A-Bag! Aqui você pode cadastrar novos voos e atualizar informações sobre os voos já registrados.
                                <br><br>
                                Com o nosso sistema de cadastro de voos, você pode inserir informações importantes, como aeroportos de partida e chegada, horários, escalas, companhia aérea, e muito mais
                            </p>

                            <p class="mt-4 text-black">
                                <a href="./voo.php" style="font-size: 16px;">Ver mais
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                                    </svg>
                                </a>
                            </p>
                        </div>
                        <div href="./aviao.php" style="cursor: pointer;" class="col-6">
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-airplane" viewBox="0 0 24 24">
                                    <path d="M6.428 1.151C6.708.591 7.213 0 8 0s1.292.592 1.572 1.151C9.861 1.73 10 2.431 10 3v3.691l5.17 2.585a1.5 1.5 0 0 1 .83 1.342V12a.5.5 0 0 1-.582.493l-5.507-.918-.375 2.253 1.318 1.318A.5.5 0 0 1 10.5 16h-5a.5.5 0 0 1-.354-.854l1.319-1.318-.376-2.253-5.507.918A.5.5 0 0 1 0 12v-1.382a1.5 1.5 0 0 1 .83-1.342L6 6.691V3c0-.568.14-1.271.428-1.849Zm.894.448C7.111 2.02 7 2.569 7 3v4a.5.5 0 0 1-.276.447l-5.448 2.724a.5.5 0 0 0-.276.447v.792l5.418-.903a.5.5 0 0 1 .575.41l.5 3a.5.5 0 0 1-.14.437L6.708 15h2.586l-.647-.646a.5.5 0 0 1-.14-.436l.5-3a.5.5 0 0 1 .576-.411L15 11.41v-.792a.5.5 0 0 0-.276-.447L9.276 7.447A.5.5 0 0 1 9 7V3c0-.432-.11-.979-.322-1.401C8.458 1.159 8.213 1 8 1c-.213 0-.458.158-.678.599Z" />
                                </svg>
                                <h2 class="ml-3 text-xl font-semibold text-gray-900">
                                    <a href="./aviao.php">Aviões</a>
                                </h2>
                            </div>
                            <p class="mt-4 text-black ">
                                Bem-vindo(a) à página de cadastro de aviões da plataforma Bag-A-Bag! Aqui você pode cadastrar novos aviões e atualizar informações sobre as aeronaves já registradas.
                                <br><br>
                                Com o nosso sistema de cadastro de aviões, você pode inserir informações sobre o modelo, a capacidade, a companhia aérea e outros detalhes importantes.
                            </p>

                            <p class="mt-4 text-black">
                                <a href="./aviao.php" style="font-size: 16px;">Ver mais
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                                    </svg>
                                </a>
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div href="./aeroporto.php" style="cursor: pointer;" class="col-6">
                            <div class="d-flex align-content-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-buildings" viewBox="0 0 16 16">
                                    <path d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022ZM6 8.694 1 10.36V15h5V8.694ZM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15Z" />
                                    <path d="M2 11h1v1H2v-1Zm2 0h1v1H4v-1Zm-2 2h1v1H2v-1Zm2 0h1v1H4v-1Zm4-4h1v1H8V9Zm2 0h1v1h-1V9Zm-2 2h1v1H8v-1Zm2 0h1v1h-1v-1Zm2-2h1v1h-1V9Zm0 2h1v1h-1v-1ZM8 7h1v1H8V7Zm2 0h1v1h-1V7Zm2 0h1v1h-1V7ZM8 5h1v1H8V5Zm2 0h1v1h-1V5Zm2 0h1v1h-1V5Zm0-2h1v1h-1V3Z" />
                                </svg>
                                <h2 class="ml-3 text-xl font-semibold text-gray-900" style="margin-left: 5px;">
                                    <a href="./aeroporto.php">Aeroporto</a>
                                </h2>
                            </div>

                            <p class="mt-4 text-black ">
                                Bem-vindo(a) à página de cadastro de aeroportos da plataforma Bag-A-Bag! Aqui você pode cadastrar novos aeroportos e atualizar informações sobre os aeroportos já registrados.
                                <br><br>
                                Com o nosso sistema de cadastro de aeroportos, você pode inserir informações importantes, como nome do aeroporto, código IATA/ICAO, localização geográfica, entre outras informações relevantes.
                            </p>

                            <p class="mt-4 text-black">
                                <a href="./aeroporto.php" style="font-size: 16px;">Ver mais
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                                    </svg>
                                </a>
                            </p>
                        </div>
                        <div href="./cupom.php" style="cursor: pointer;" class="col-6">
                            <div class="d-flex align-content-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" fill="currentColor" class="bi bi-ticket" viewBox="0 0 16 16">
                                    <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6V4.5ZM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5h-13Z" />
                                </svg>
                                <h2 class="ml-3 text-xl font-semibold text-gray-900" style="margin-left: 5px;">
                                    <a href="./cupom.php">Cupons</a>
                                </h2>
                            </div>
                            <p class="mt-4 text-black ">
                                Bem-vindo(a) à página de cadastro de cupons de desconto da plataforma Bag-A-Bag! Aqui você pode criar novos cupons de desconto e gerenciar os já existentes.
                                <br><br>
                                Com o nosso sistema de cadastro de cupons, você pode criar cupons personalizados com diferentes valores de desconto e condições de uso, como por exemplo, porcentagem de desconto ou valor fixo de desconto. Além disso, você pode definir a data de validade dos cupons e limitar o número de vezes que cada cupom pode ser utilizado.
                            </p>

                            <p class="mt-4 text-black">
                                <a href="./cupom.php" style="font-size: 16px;">Ver mais
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                                    </svg>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer style="height: 100px;">

    </footer>
</body>