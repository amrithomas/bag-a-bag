<?php
session_start();
include_once('../conexao.php');

$codaviao = filter_input(INPUT_POST, 'codaviao');
$empresa  = filter_input(INPUT_POST, 'empresa');

// adicionar o avião ao banco
$query = "INSERT INTO aviao_codaviao (CODIGO_AVIAO, EMPRESA, TOTAL_ASSENTO, CRIADO) VALUES ('$codaviao', '$empresa', DEFAULT, NOW())";
$consulta = mysqli_query($conn, $query);

if (mysqli_insert_id($conn)) {
    $id_aviao = mysqli_insert_id($conn);

    // adiciona 50 assentos de primeira classe do aviao
    for ($i=1; $i <= 50; $i++) {
        $query_assentos_primeira_classe = "INSERT INTO assentos_codaviao (ID_ASSENTO_CODAVIAO, NUMERO_ASSENTO, CLASSE, FK_AVIAO) VALUES (($i+(200*($id_aviao-1))), $i, 'Primeira', '$id_aviao')";
        $consulta = mysqli_query($conn, $query_assentos_primeira_classe);
    }

    // adiciona 150 assentos de classe economica do aviao
    for ($i=51; $i <= 200; $i++) {
        $query_assentos_primeira_classe = "INSERT INTO assentos_codaviao (ID_ASSENTO_CODAVIAO, NUMERO_ASSENTO, CLASSE, FK_AVIAO) VALUES (($i+(200*($id_aviao-1))), $i, 'Econômica', '$id_aviao')";
        $consulta = mysqli_query($conn, $query_assentos_primeira_classe);
    }

}
else {
    $_SESSION['msg'] = "<p style='color:red;'>Erro. Não foi possível inserir o avião ao banco de dados. Tente novamente</p>";
    header('Location: ../cadastro_aviao.php');
}

?>
