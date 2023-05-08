<?php
    session_start(); //iniciando sessão
    include_once("../conexao.php"); //incluindo conexão

    //PEGANDO DADOS

    $sigla = filter_input(INPUT_POST, "sigla", FILTER_SANITIZE_STRING);
    $nome_aeroporto = filter_input(INPUT_POST, "nome_aeroporto", FILTER_SANITIZE_STRING);
    $pais = filter_input(INPUT_POST, "pais", FILTER_SANITIZE_STRING);
    $cidade = filter_input(INPUT_POST, "cidade", FILTER_SANITIZE_STRING);

    // CRAINDO VARIÁVEIS
    $unico_nome = false;
    $unico_sigla = false;

    // VERIFICANDO SE A SIGLA DO AEROPORTO É UNICO
    $s = "SELECT * FROM aeroporto WHERE sigla ='$sigla'";
    $select_sigla = mysqli_query($conn, $s);
    $row_sigla = mysqli_fetch_assoc($select_sigla);

    if(!empty($row_sigla)){
        $unico_sigla = false;
    }else  {
        echo "<br>";
        echo "sigla unica";
        $unico_sigla = true;
    }

    // VERIFICANDO SE O NOME DO AEROPORTO É UNICO
    $n = "SELECT * FROM aeroporto WHERE nome_aeroporto ='$nome_aeroporto'";
    $select_nome = mysqli_query($conn, $n);
    $row_nome = mysqli_fetch_assoc($select_nome);

    if(!empty($row_nome)){
        $unico_nome = false;
    }else  {
        echo "<br>";
        echo "nome do aeroporto unico";
        $unico_nome = true;
    }



    if ($unico_sigla && $unico_nome){
        $result_cadastro = "INSERT INTO aeroporto (sigla, nome_aeroporto, pais, cidade, criado) VALUES ('$sigla','$nome_aeroporto','$pais','$cidade', NOW())";
        $resultado_cadastro = mysqli_query($conn, $result_cadastro);
        $id_aeroporto = mysqli_insert_id($conn); //pegando o id do aeroporto
    }
?>