<?php
session_start();
include_once('../conexao.php');

$nome_admm = filter_input(INPUT_POST, 'nome_adm');
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha');
$conf_senha = filter_input(INPUT_POST, 'confsenha');

if($senha != $conf_senha) {
    $_SESSION['msg'] = "<p class='text-center' style='color: red;'>As senhas não conferem!</p>";
    echo "<script>location.href='../admin/editar_admin.php'</script>";
} else {

    $update = "UPDATE admin SET NOME_ADM='$nome_admm', EMAIL_ADM='$email', SENHA_ADM='". md5($senha) ."'";
    $update = mysqli_query($conn, $update);

    if($update) {
        $_SESSION['msg'] = "<p class='text-center' style='color: green'>Admin editado com sucesso!</p>";
        echo "<script>location.href='../admin/perfis.php'</script>";
        
    } else {
        $_SESSION['msg'] = "<p class='text-center' style'color:red'>Erro ao editar admin!</p>";
        echo "<script>location.href='../admin/editar_admin.php'</script>";
    }
}
?>