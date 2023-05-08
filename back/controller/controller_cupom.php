<?php
    session_start(); //iniciando sessão
    include_once("../conexao.php"); //incluindo conexão

    //pegando dados
    
    $codigo_cupom = filter_input(INPUT_POST, "codigo_cupom", FILTER_SANITIZE_STRING);
    $valor_desconto = filter_input(INPUT_POST, "valor_desconto", FILTER_SANITIZE_STRING);
   

    //rgx para 3 letras e 3 numeros
    $rgx = '/[A-Z]{3}[0-9]{3}/';
    
    //verificação de código já existente no db
    $a = "SELECT * FROM cupom WHERE CODIGO_CUPOM ='$codigo_cupom'";
    $select_cupom = mysqli_query($conn, $a);
    $row_cupom = mysqli_fetch_assoc($select_cupom);
    
    //validando o rgx
    if (preg_match($rgx, $codigo_cupom) == 1) {
        
        if(!empty($row_cupom)){
            $_SESSION["msg"] = "<p style='color: red;'> Não foi possível cadastrar com sucesso</p>";
            echo "<script>location.href='../admin/cupom_desconto.php';</script>";
        }else  {
             //inserindo no banco
            $result_usuario = "INSERT INTO cupom (CODIGO_CUPOM, VALOR_DESCONTO, CRIADO) VALUES ('$codigo_cupom','$valor_desconto', NOW())";
            $resultado_usuario = mysqli_query($conn, $result_usuario);
            
            if (mysqli_insert_id($conn)) {
                $_SESSION["msg"] = "<p style='color: green;' class='text-center'> CUPOM CADASTRADO COM SUCESSO</p>";
                echo "<script>location.href='../admin/cupom.php';</script>";
            } else {
                $_SESSION["msg"] = "<p style='color: red;'> Não foi possível cadastrar com sucesso</p>";
            }
            
        }

    }else{
        $_SESSION["msg"] = "<p style='color: red;'> Não foi possível cadastrar com sucesso</p>";
        echo "<script>location.href='../admin/cupom_desconto.php';</script>";
    }
    

?>