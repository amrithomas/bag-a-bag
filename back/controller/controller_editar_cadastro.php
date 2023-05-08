<?php
    session_start();
    include_once("../conexao.php");
    include_once("../funcoes.php");

    $id = filter_input(INPUT_POST, 'id' , FILTER_SANITIZE_NUMBER_INT);

    $result_cadastro = "SELECT * FROM usuario 
    INNER JOIN telefone ON FK_TELEFONE = ID_TELEFONE 
    INNER JOIN cadastro ON FK_CADASTRO = ID_CADASTRO
    INNER JOIN rg ON FK_RG = ID_RG
    INNER JOIN endereco ON FK_ENDERECO = ID_ENDERECO
    WHERE ID_USUARIO = '$id'";
    $resultado_cadastro = mysqli_query($conn, $result_cadastro); //mysqli_query: executa uma consulta no banco de dados
    $row_cadastro = mysqli_fetch_assoc($resultado_cadastro); //retornar a linha da tabela cadastro referente ao select

    $nome = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $sobrenome = filter_input(INPUT_POST, "ultname", FILTER_SANITIZE_STRING);
    $nome_meio = filter_input(INPUT_POST, "middlename", FILTER_SANITIZE_STRING);

    $cpf = filter_input(INPUT_POST, "cpf" );
    $cpf = trim($cpf);
    $cpf = str_replace(".","",$cpf);
    $cpf = str_replace("-","",$cpf);

    $rg = filter_input(INPUT_POST, "rg" );
    $rg = trim($rg);
    $rg = str_replace(".","",$rg);
    $rg = str_replace("-","",$rg);

    $data_emissao = filter_input(INPUT_POST, "data_emissao");
    $data_nascimento = filter_input(INPUT_POST, "data_nasc");
    $ddd = filter_input(INPUT_POST, "ddd", FILTER_SANITIZE_STRING);

    $telefone = filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_STRING);
    $telefone = trim($telefone);
    $telefone = str_replace("-","",$telefone);

    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);

    $cep = filter_input(INPUT_POST, "cep", FILTER_SANITIZE_STRING);
    $cep = str_replace(".","",$cep);
    $cep = str_replace("-","",$cep);

    $cidade = filter_input(INPUT_POST, "cidade", FILTER_SANITIZE_STRING);
    $uf = filter_input(INPUT_POST, "estado", FILTER_SANITIZE_STRING);
    $rua = filter_input(INPUT_POST, "endereco", FILTER_SANITIZE_STRING);
    $numero = filter_input(INPUT_POST, "numero", FILTER_SANITIZE_STRING);
    $bairro = filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_STRING);
    $complemento = filter_input(INPUT_POST, "complemento", FILTER_SANITIZE_STRING);

    // colocando o validador como falso
    $data_rg_valida = false;

    // fazendo as verificações do formulario
    if (validarDataRg($data_emissao)){
        $data_rg_valida = true;
        echo "<br>";
        echo "data de emissao do rg valido";
    } //verificação da data de emissão do rg

    if ($data_rg_valida){
        $update_cadastro = "UPDATE cadastro SET EMAIL = '$email' WHERE id_cadastro = (SELECT FK_CADASTRO FROM usuario WHERE ID_USUARIO = '$id')";
        $update_endereco = "UPDATE endereco SET CEP = '$cep', RUA = '$rua', NUMERO_ENDERECO = '$numero', BAIRRO = '$bairro', CIDADE = '$cidade', UF = '$uf', COMPLEMENTO = '$complemento' WHERE ID_ENDERECO= (SELECT FK_ENDERECO FROM usuario WHERE ID_USUARIO = '$id')";
        $update_telefone = "UPDATE telefone SET DDD = '$ddd', NUMERO_TELEFONE = '$telefone' WHERE ID_TELEFONE= (SELECT FK_TELEFONE FROM usuario WHERE ID_USUARIO = '$id')";
        $update_rg = "UPDATE rg SET DATA_EMISSAO = '$data_emissao' WHERE ID_RG= (SELECT FK_RG FROM usuario WHERE ID_USUARIO = '$id')";
        $update_usuario = "UPDATE usuario SET NOME = '$nome', NOME_MEIO= '$nome_meio', SOBRENOME = '$sobrenome' WHERE ID_USUARIO= '$id'";
        
        $resultado_endereco = mysqli_query($conn, $update_endereco);
        $resultado_cadastro = mysqli_query($conn, $update_cadastro);
        $resultado_telefone = mysqli_query($conn, $update_telefone);
        $resultado_rg = mysqli_query($conn, $update_rg);
        $resultado_usuario = mysqli_query($conn, $update_usuario);

        //verificar modificações
        //verificar tabela de cadastro
        if ($email != $row_cadastro['EMAIL']){
            $update_cadastro_modificado = "UPDATE cadastro SET MODIFICADO = NOW() WHERE id_cadastro = (SELECT FK_CADASTRO FROM usuario WHERE ID_USUARIO = '$id')";
            $resultado_cadastro_modificado = mysqli_query($conn, $update_cadastro_modificado);
        }

        //verificar tabela de endereço
        if ($cep != $row_cadastro['CEP'] || $rua != $row_cadastro['RUA'] || $numero != $row_cadastro['NUMERO_ENDERECO'] || $bairro != $row_cadastro['BAIRRO'] || $cidade != $row_cadastro['CIDADE'] || $uf != $row_cadastro['UF'] || $complemento != $row_cadastro['COMPLEMENTO']){
            $update_endereco_modificado = "UPDATE endereco SET MODIFICADO = NOW() WHERE ID_ENDERECO= (SELECT FK_ENDERECO FROM usuario WHERE ID_USUARIO = '$id')";
            $resultado_endereco_modificado = mysqli_query($conn, $update_endereco_modificado);
        }
        
        //verificar tabela de telefone
        if ($telefone != $row_cadastro['NUMERO_TELEFONE'] || $ddd != $row_cadastro['DDD'] ){
            $update_telefone_modificado = "UPDATE telefone SET MODIFICADO = NOW() WHERE ID_TELEFONE= (SELECT FK_TELEFONE FROM usuario WHERE ID_USUARIO = '$id')";
            $resultado_telefone_modificado = mysqli_query($conn, $update_telefone_modificado);
        }
        
        //verificar tabela de usuario
        if ($nome != $row_cadastro['NOME'] || $nome_meio != $row_cadastro['NOME_MEIO'] || $sobrenome != $row_cadastro['SOBRENOME']){
            $update_usuario_modificado = "UPDATE usuario SET MODIFICADO = NOW() WHERE ID_USUARIO= '$id'";
            $resultado_usuario_modificado = mysqli_query($conn, $update_usuario_modificado);
        }
        
        if (mysqli_affected_rows($conn)) {
            //$_SESSION["msg"] = "<p style='color: blue;'>Usuário editado com sucesso</p>";
            header("Location: ../../pages/user.php?id=$id");
        } else {
            //$_SESSION["msg"] = "<p style='color: blue;'>Usuário não foi editado.</p>";
            header("Location: ../../pages/alteracoes_cadastro?id=$id");
        }
    }

?>