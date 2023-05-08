<?php
session_start();
include_once('../conexao.php');

$id = filter_input(INPUT_POST, 'id');
$sigla = filter_input(INPUT_POST, 'sigla');
$nome_aeroporto = filter_input(INPUT_POST, 'nome_aeroporto');
$pais = filter_input(INPUT_POST, 'pais');
$cidade = filter_input(INPUT_POST, 'cidade');

$id = (float) $id;

$update = "UPDATE aeroporto SET SIGLA='$sigla', NOME_AEROPORTO='$nome_aeroporto', PAIS='$pais', CIDADE='$cidade', MODIFICADO=NOW() WHERE ID_AEROPORTO='$id'";
$update = mysqli_query($conn, $update);

if ($update) {
    $_SESSION['msg'] = '<p class="text-center" style="color: green;">Edição realizada com sucesso</p>';
    echo "<script>location.href='../admin/aeroporto.php'</script>";
} else {
    $_SESSION['msg'] = '<p class="text-center" style="color:red">Erro ao editar aeroporto</p>';
    echo "<script>location.href='../admin/editar_aeroporto.php'</script>";
}
