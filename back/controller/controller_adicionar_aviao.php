<?php
session_start();
include_once('../conexao.php');

$codaviao = filter_input(INPUT_POST, 'codaviao');
$empresa  = filter_input(INPUT_POST, 'empresa');

// PROCURA PELA SIGLA NO BANCO
$query = "SELECT * FROM aviao WHERE CODIGO_AVIAO='$codaviao'";
$consulta = mysqli_query($conn, $query);

if (!(mysqli_num_rows($consulta)==0)) {
    $_SESSION["msg"] = "<p style='color: red;' class='text-center'>Cadastro não realizado. Código de aeronave já cadastrado</p>";
    echo "<script>location.href='../admin/aviao.php';</script>";
}

// adicionar o avião ao banco
$query = "INSERT INTO aviao (CODIGO_AVIAO, EMPRESA, TOTAL_ASSENTO, CRIADO) VALUES ('$codaviao', '$empresa', DEFAULT, NOW())";
$consulta = mysqli_query($conn, $query);

if (mysqli_insert_id($conn)) {
    $id_aviao = mysqli_insert_id($conn);

    // adiciona 50 assentos de primeira classe do aviao
    for ($i=1; $i <= 50; $i++) {
        $query_assentos_primeira_classe = "INSERT INTO assentos (ID_ASSENTO, NUMERO_ASSENTO, CLASSE, FK_AVIAO) VALUES (($i+(200*($id_aviao-1))), $i, 'Primeira', '$id_aviao')";
        $consulta = mysqli_query($conn, $query_assentos_primeira_classe);
    }

    // adiciona 150 assentos de classe economica do aviao
    for ($i=51; $i <= 200; $i++) {
        $query_assentos_primeira_classe = "INSERT INTO assentos (ID_ASSENTO, NUMERO_ASSENTO, CLASSE, FK_AVIAO) VALUES (($i+(200*($id_aviao-1))), $i, 'Econômica', '$id_aviao')";
        $consulta = mysqli_query($conn, $query_assentos_primeira_classe);
    }
    $_SESSION['msg'] = "<p style='color:grenn;' class='text-center'>AERONAVE CADASTRADA COM SUCESSO</p>";
    echo "<script>location.href='../admin/aviao.php';</script>";

}
else {
    $_SESSION['msg'] = "<p style='color:red;'>Erro. Não foi possível inserir o avião ao banco de dados. Tente novamente</p>";
    echo "<script>location.href='../admin/aviao.php';</script>";
}
