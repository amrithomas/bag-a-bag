<?php 
session_start();
include_once('../conexao.php');

$codaviao = filter_input(INPUT_POST, 'codaviao');
$empresa  = filter_input(INPUT_POST, 'empresa');
$id = filter_input(INPUT_POST, 'id');

$update = "UPDATE aviao SET CODIGO_AVIAO='$codaviao', EMPRESA='$empresa', MODIFICADO=NOW()  WHERE ID_AVIAO='$id'";
$resultado = mysqli_query($conn, $update);

if ($resultado) {
    $_SESSION["msg"] = "<p class='text-center' style='color: green;'>Edição realizada com sucesso</p>";
    echo "<script>location.href='../admin/aviao.php';</script>";
} else {
    $_SESSION["msg"] = "<p class='text-center' style='color: red;'>Erro ao editar avião</p>";
    echo "<script>location.href='../admin/editar_aviao.php';</script>";
}

?>
