<?php
    session_start(); //iniciando sessão
    include_once("conexao.php"); //incluindo conexão
    include_once("funcoes.php")

    //pegando dados
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
    $senha = filter_input(INPUT_POST, "senha");
    //if (validarRG($rg)){
    //    
    //}

    //inserindo no banco
    $result_usuario = "INSERT INTO cadastro (email, senha, data_cadastro) VALUES ('$email','" . md5($senha) . "', NOW())";
    $resultado_usuario = mysqli_query($conn, $result_usuario);

    if (mysqli_insert_id($conn)) {
        $_SESSION["msg"] = "<p style='color: blue;'>Cadastrado realizado com sucesso</p>";
        header("Location: cadastro_funcionario.php");
    } else {
        $_SESSION["msg"] = "<p style='color: blue;'>Cadastro não foi realizado com sucesso</p>";
        header("Location: cadastro_funcionario.php");
    }
    

    
    
?>
