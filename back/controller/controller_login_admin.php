<?php
session_start(); //iniciando sessão
include_once("../conexao.php"); //incluindo banco

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST, 'password');


$senha_md5 = md5($senha);

$result_usuario = "SELECT * FROM admin WHERE EMAIL_ADM = '$email'";
$result_usuario = mysqli_query($conn, $result_usuario);
$row_usuario = mysqli_fetch_assoc($result_usuario);

$senha_banco = $row_usuario['SENHA_ADM'];

$id = $row_usuario['ID_ADM'];
$_SESSION['id_adm'] = $id;

if ($senha_md5 == $senha_banco && $email == $row_usuario['EMAIL_ADM']) {
    echo "<script>location.href='../admin/admin.php';</script>";
} else {
    $_SESSION["msg"] = "<p style='color: red;'>Nome de usuário ou senha incorretos.</p>";
    echo "<script>location.href='../admin/login.php';</script>";
}

?>