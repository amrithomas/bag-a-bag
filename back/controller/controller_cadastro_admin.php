<?php 
session_start();
include_once('../conexao.php');

$nome_admm = filter_input(INPUT_POST, 'nome_adm');
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha');
$conf_senha = filter_input(INPUT_POST, 'confsenha');

if ($senha != $conf_senha) {
    $_SESSION['msg'] = "<p class='text-center' style='color: red;'>As senhas não conferem!</p>";
    echo "<script>location.href='../admin/perfis.php'</script>";
} else {
    $query = "SELECT * FROM admin WHERE EMAIL_ADM='$email'";
    $query = mysqli_query($conn, $query);

    if(mysqli_num_rows($query)) {
        $_SESSION['msg'] = "<p class='text-center' style='color: red'>Email ja cadastrado no sistema!</p>";
        echo "<script>location.href='../admin/perfis.php'</script>";
    } else {
        $query = "INSERT INTO admin (ID_ADM, NOME_ADM, EMAIL_ADM, SENHA_ADM) VALUES (DEFAULT, '$nome_admm','$email',  '" . md5($senha) ."')";
        $query_result = mysqli_query($conn, $query);
        
        if($query_result !== false) {
            $_SESSION['msg'] = "<p class='text-center' style='color: green'>Admin cadastrado com sucesso!</p>";
            echo "<script>location.href='../admin/perfis.php'</script>";
        } else {
            $_SESSION['msg'] = "<p class='text-center' style='color: red'>Erro ao cadastrar o admin!</p>";
            echo "<script>location.href='../admin/perfis.php'</script>";
        }
        
    }
}
