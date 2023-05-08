<?php
    session_start(); //iniciando sessão
    include_once("conexao.php"); //incluindo conexão

    //pegando dados
    
    $ddd = filter_input(INPUT_POST, "ddd", FILTER_SANITIZE_STRING);
    $numero = filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_STRING);
   
    //inserindo no banco
    $result_usuario = "INSERT INTO telefone (codigo_pais, ddd, numero, tipo) VALUES (DEFAULT,'$ddd','$numero',DEFAULT)";
    $resultado_usuario = mysqli_query($conn, $result_usuario);

    if (mysqli_insert_id($conn)) {
        // header("Location:#");
    } else {
        $_SESSION["msg"] = "<p style='color: blue;'> Não foi possível cadastrar com sucesso</p>";
        // header("Location:#");
    }
    

    
    
?>
