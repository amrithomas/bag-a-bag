<?php
session_start();
include_once('../conexao.php');

$id = filter_input(INPUT_POST, 'id');
$codigo_cupom = filter_input(INPUT_POST, 'codigo_cupom');
$desconto = filter_input(INPUT_POST, 'valor_desconto');

$update = "UPDATE cupom SET CODIGO_CUPOM='$codigo_cupom', VALOR_DESCONTO='$desconto', MODIFICADO=NOW() WHERE ID_CUPOM='$id'";
$update = mysqli_query($conn, $update);

if($update) {
    $_SESSION['msg'] = "<p class='text-center' style='color:green'>Edição realizada com sucesso</p>";
    echo "<script>location.href='../admin/cupom.php'</script>";
} else {
    $_SESSION['msg'] = "<p class='text-center' style='color: red'>Erro ao editar cupom</p>";
    echo "<script>location.href='../admin/editar_cupom.php'</script>";
}

?>