<?php
session_start();
include_once('../back/conexao.php');
$id = filter_input(INPUT_GET, 'id' , FILTER_SANITIZE_NUMBER_INT);
$result_cadastro = "SELECT * FROM usuario 
INNER JOIN telefone ON FK_TELEFONE = ID_TELEFONE 
INNER JOIN cadastro ON FK_CADASTRO = ID_CADASTRO
INNER JOIN rg ON FK_RG = ID_RG
INNER JOIN endereco ON FK_ENDERECO = ID_ENDERECO
WHERE ID_USUARIO = '$id'";
$resultado_cadastro = mysqli_query($conn, $result_cadastro); //mysqli_query: executa uma consulta no banco de dados
$row_cadastro = mysqli_fetch_assoc($resultado_cadastro); //retornar uma matriz associativa representando a próxima linha no conjunto de resultados representado pelo parâmetro result , aonde cada chave representa o nome de uma coluna do conjunto de resultados.


$query = "SELECT * FROM usuario 
INNER JOIN telefone ON FK_TELEFONE = ID_TELEFONE 
INNER JOIN cadastro ON FK_CADASTRO = ID_CADASTRO
WHERE ID_USUARIO='$id'";
$query = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($query);

if(empty($row)) {
  echo "<script>location.href='../index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Bag-a-Bagₑ - Alteração de Cadastro</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/airplane_favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">


  <!-- Template Main CSS File -->
  <link href="../assets/css/alteracoes_cadastro/alteracoes_cadastro.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Groovin
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/groovin-free-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <script type="text/javascript"> //js para o número de telefone, adicionar traço
    function mascara(telefone) {
      if (telefone.value.length == 4)
        telefone.value = telefone.value + '-'; //quando o campo já tiver 8 caracteres, o script irá inserir um tracinho, para melhor visualização do telefone.
    }
  </script>
  <script>

    function limpa_formulário_cep() {
      //Limpa valores do formulário de cep.
      document.getElementById('endereco').value = ("");
      document.getElementById('cidade').value = ("");
      document.getElementById('estado').value = ("");
    }

    function meu_callback(conteudo) {
      if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
        document.getElementById('endereco').value = (conteudo.logradouro);
        document.getElementById('cidade').value = (conteudo.localidade);
        document.getElementById('estado').value = (conteudo.uf);
      } //end if.
      else {
        //CEP não Encontrado.
        limpa_formulário_cep();
        alert("CEP não encontrado.");
      }
    }

    function pesquisacep(valor) {

      //Nova variável "cep" somente com dígitos.
      var cep = valor.replace(/\D/g, '');

      //Verifica se campo cep possui valor informado.
      if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if (validacep.test(cep)) {

          //Preenche os campos com "..." enquanto consulta webservice.
          document.getElementById('endereco').value = "...";
          document.getElementById('cidade').value = "...";
          document.getElementById('estado').value = "...";

          //Cria um elemento javascript.
          var script = document.createElement('script');

          //Sincroniza com o callback.
          script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

          //Insere script no documento e carrega o conteúdo.
          document.body.appendChild(script);

        } //end if.
        else {
          //cep é inválido.
          limpa_formulário_cep();
          alert("Formato de CEP inválido.");
        }
      } //end if.
      else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
      }
    };

  </script>

</head>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center">
  <div class="container d-flex align-items-center justify-content-between">

    <h1 class="logo"><a href="index.php">BAG-A-BAGₑ</a></h1>
    <!-- Uncomment below if you prefer to use an image logo -->
    <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

    <nav id="navbar" class="navbar">
      <ul>
        <li><a class="nav-link scrollto active" href="../index.php">HOME</a></li>
        <li><a class="nav-link scrollto" href="../index.php#about">SOBRE</a></li>
        <li><a class="nav-link scrollto" href="destinos.php">DESTINOS</a></li>
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
</header><!-- End Header -->

<!--- Começo do container/alteracoes -->

<main class="main-alteracoes">
  <h5>Alteração Cadastral</h5>
  </div>
  <!-- <form action="#" method> -->
  <div class="row">
    <div class="main-alteracoes-dados">
      <h1>Dados pessoais</h1>
      <div class="row">
        <div class="half-box">
          <div class="col">
            <!-- Informações como nome, CPF, RG e Data de nascimento estará como disabled, precisará colocar o comando para a informação colocada em cadastro já aparecer nesses campos desabilitados -->
            <form action="../back/controller/controller_editar_cadastro.php" method="post">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <label for="name" style="color: #5c9f24">Nome</label>
              <input type="text" class="form-control required" style="background-color: #FFF; border-color: black"
                name="name" id="name" value="<?php echo $row_cadastro['NOME']; ?>">
          </div>
        </div>
        <div class="half-box">
          <div class="col">
            <label for="lastname" style="color: #5c9f24">Nome do meio</label>
            <input type="text" class="form-control required" style="background-color: #FFF; border-color: black" name="middlename" id="sobrenome" value="<?php echo $row_cadastro['NOME_MEIO']; ?>">
          </div>
        </div>
      </div>
      <div class="half-box" style="width: 88%;">
        <div class="col" style="width: 54%;">
          <label for="ultname" style="color: #5c9f24">Sobrenome</label>
          <input type="text" class="form-control required" style="background-color: #FFF; border-color: black"
            name="ultname" id="ultname" value="<?php echo $row_cadastro['SOBRENOME']; ?>">
        </div>
      </div>
      <div class="row">
        <div class="half-box">
          <label for="cpf" class="required" style="color: #5c9f24">CPF</label>
          <input type="number" class="form-control required" style="background-color: #d8d8d8; border-color: black"
            name="cpf" id="cpf" disabled value="<?php echo $row_cadastro['CPF']; ?>">
        </div>
        <div class="half-box">
          <label for="rg" class="required" style="color: #5c9f24">RG</label>
          <input type="rg" name="rg" id="rg" class="form-control required"
            style="background-color: #d8d8d8; border-color: black" disabled
            value="<?php echo $row_cadastro['NUMERO_RG']; ?>">
        </div>
      </div>
      <div class="row">
        <div class="half-box">
          <label for="date" style="color: #5c9f24">Data de emissão (RG)</label>
          <input type="date" name="data_emissao" id="dataexpedicao" class="form-control"
            style="background-color: #FFF; border-color: black" value="<?php echo $row_cadastro['DATA_EMISSAO']; ?>">
        </div>
        <div class="half-box">
          <label for="date" class="required" style="color: #5c9f24">Data de Nascimento</label>
          <input type="date" name="data_nasc" id="datanascimento" class="form-control"
            style="background-color: #d8d8d8; border-color: black" disabled
            value="<?php echo $row_cadastro['DATA_NASCIMENTO']; ?>">
        </div>
      </div>
      <div class="row">
        <div class="half-box">
          <div class="col-4">
            <label for="number" style="color: #5c9f24">DDD</label>
            <input type="number" maxlength="2" name="ddd" placeholder="(XX)" id="ddd" class="form-control required"
              style="background-color: #FFF; border-color: black" value="<?php echo $row_cadastro['DDD']; ?>">
          </div>
        </div>
        <div class="half-box">
          <label for="tel" style="color: #5c9f24">Telefone</label>
          <input type="tel" name="telefone" id="telefone" placeholder="XXXXX-XXXX" maxlength="15"
            class="form-control required" onkeypress="mascara(this)" style="background-color: #FFF; border-color: black"
            value="<?php echo $row_cadastro['NUMERO_TELEFONE']; ?>">
        </div>
      </div>
      <div class="half-box">
        <label for="email" style="color: #5c9f24">E-mail</label>
        <input type="email" name="email" id="email" class="form-control required"
          style="background-color: #FFF; border-color: #000" value="<?php echo $row_cadastro['EMAIL']; ?>">
      </div>
    </div>
    <div class="main-alteracoes-endereco">
      <h2>Localidade</h2>
      <div class="row">
        <!-- Informações como nome, CPF, RG e Data de nascimento estará como disabled, precisará colocar o comando para a informação colocada em cadastro já aparecer nesses campos desabilitados -->
        <div class="half-box">
          <label for="endereco" style="color: #5c9f24">Endereço</label>
          <input type="endereco" name="endereco" id="endereco" class="form-control required"
            style="background-color: #FFF; border-color: #000" value="<?php echo $row_cadastro['RUA']; ?>">
        </div>
      </div>
      <div class="row">
        <div class="half-box">
          <label for="cidade" style="color: #5c9f24">Cidade</label>
          <input type="cidade" name="cidade" id="cidade" class="form-control required"
            style="background-color: #FFF; border-color: #000" value="<?php echo $row_cadastro['CIDADE']; ?>">
        </div>
        <div class="half-box">
          <label for="estado" style="color: #5c9f24">Estado</label>
          <input type="estado" name="estado" id="estado" class="form-control required"
            style="background-color: #FFF; border-color: #000" value="<?php echo $row_cadastro['UF']; ?>">
        </div>
      </div>
      <div class="row">
      </div>
      <div class="row" style="margin-bottom: 10%">
        <div class="half-box">
          <label for="number" style="color: #5c9f24">N°</label>
          <input type="number" name="numero" id="numero" class="form-control required"
            style="background-color: #FFF; border-color: #000" value="<?php echo $row_cadastro['NUMERO_ENDERECO']; ?>">
        </div>
        <div class="half-box">
          <label for="complemento" style="color: #5c9f24">Complemento</label>
          <input type="complemento" name="complemento" id="complemento" class="form-control"
            style="background-color: #FFF; border-color: #000" value="<?php echo $row_cadastro['COMPLEMENTO']; ?>">
        </div>
        <div class="row">
          <div class="half-box">
            <div class="col-6" style="margin: auto;">
              <label for="number" class="required" style="color: #5c9f24">CEP</label>
              <input type="number" name="cep" id="cep" class="form-control required"
                style="background-color: #FFF; border-color: #000" onblur="pesquisacep(this.value);"
                value="<?php echo $row_cadastro['CEP']; ?>">
            </div>
          </div>
        </div>
      </div>
      <div class="botao">
        <button type="submit" id="cadastrar" class="btn btn-success">Salvar</button>
      </div>
      </form>
</main>
<!---Fim do container/alteracoes -->

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
            <li><i class="bx bx-chevron-right"></i> <a href="../index.php">Home</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="../index.php#about">Sobre</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="destinos.php">Destinos</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="../index.php#pricing">Ofertas</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="../index.php#contact">Contato</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Conta</h4>
          <ul>
          <li><i class="bx bx-chevron-right"></i> <a href="<?php echo "user.php?id=" . $row['ID_USUARIO'] ?>">Ver perfil</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="../back/controller/controller_logoff.php">Logoff</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-6 footer-newsletter">
          <h4>Inscreva-se para receber ofertas exclusivas</h4>
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
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </div>
</footer>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
    class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>