<?php
 session_start();
include_once('../conexao.php');

 $qtd_parcelas = $_POST['parcelas'];  // quantidade de parcelas escolhida pelo usuário na página pagamento.php
 $opcao = $_POST["pagamento"];

 $id_reserva = $_SESSION['id_reserva']; // Obter o ID_RESERVA da variável de sessão

 function atualizar_status_reserva($conn, $id_reserva) {
    $query2 = "SELECT * FROM reserva 
        INNER JOIN pagamento ON FK_RESERVA = ID_RESERVA";
    $query2 = mysqli_query($conn, $query2);
    $row2 = mysqli_fetch_assoc($query2);

    if(!empty($row2)) {
        $result_usuario = "UPDATE reserva SET STATUS_RESERVA = 'Confirmada'  WHERE ID_RESERVA = '$id_reserva'";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
    }
}
 
 
 switch($opcao){
     case "credito":
        
        // Obter o número do cartão do campo de entrada
        $numeroCartao = filter_input(INPUT_POST, 'numeroCartao', FILTER_SANITIZE_NUMBER_INT);
        
        // Obter a data de validade do cartão do campo de entrada
        $dataValidade = filter_input(INPUT_POST, 'dataValidade');
        
        
        // Função para validar dados do cartão 
        function validarDadosCartao($numeroCartao, $dataValidade) {
            // Remove espaços em branco e traços do número do cartão
            $numeroCartao = str_replace(array(' ', '-'), '', $numeroCartao);
        
            // Verifica se o número do cartão tem apenas números
            if (!ctype_digit($numeroCartao)) {
                return false;
            }
        
            // Verifica se o número do cartão tem pelo menos 13 dígitos e no máximo 16 dígitos
            $numDigitos = strlen($numeroCartao);
            if ($numDigitos < 13 || $numDigitos > 16) {
                return false;
            }
        
            
            // verificar a validade do número do cartão
            $soma = 0;
            for ($i = $numDigitos - 1; $i >= 0; $i--) {
                $digito = intval($numeroCartao[$i]);
                if ($i % 2 == $numDigitos % 2) {
                    $digito *= 2;
                    if ($digito > 9) {
                        $digito -= 9;
                    }
                }
                $soma += $digito;
            }
            if ($soma % 10 != 0) {
                return false;
            }
        
            // Verificar se a data de validade está no formato correto e é uma data futura
            if (!preg_match('/^(0[1-9]|1[0-2])\/[0-9]{4}$/', $dataValidade)) {
                return false;
            }
        
            $mesAno = explode('/', $dataValidade);
            $mes = (int) $mesAno[0];
            $ano = (int) $mesAno[1];
            $anoAtual = date('Y');
        
            if (($ano > $anoAtual) || ($ano == $anoAtual && $mes > date('m'))) {
                return true;
            } else {
                return false;
            }
        }
        
        // Inserção dos dados no banco 
        if (validarDadosCartao($numeroCartao, $dataValidade)) {
            $result_usuario = "INSERT INTO pagamento (status_pagamento, data_pagamento, tipo_pagamento, fk_reserva, parcelas) VALUES ('Aprovado',NOW(),'Crédito','$id_reserva','$qtd_parcelas')";
            $resultado_usuario = mysqli_query($conn, $result_usuario);
            $resultado = atualizar_status_reserva($conn, $id_reserva);
            echo "<script>location.href='../../index.php';</script>";
        } else {
            echo "<script>location.href='../../pages/pagamento.php';</script>";
        }
        break;
    case "pix":
        // Inserção dos dados no banco 
        $result_usuario = "INSERT INTO pagamento (status_pagamento, data_pagamento, tipo_pagamento, fk_reserva, parcelas) VALUES ('Aprovado',NOW(),'Pix','$id_reserva',NULL)";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
        $resultado = atualizar_status_reserva($conn, $id_reserva);
        echo "<script>location.href='../../index.php';</script>";
        break;

    case "boleto":
        // Inserção dos dados no banco 
        $result_usuario = "INSERT INTO pagamento (status_pagamento, data_pagamento, tipo_pagamento, fk_reserva, parcelas) VALUES ('Aprovado',NOW(),'Boleto','$id_reserva',NULL)";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
        $resultado = atualizar_status_reserva($conn, $id_reserva);
        echo "<script>location.href='../../index.php';</script>";
        break;
    case "":

        echo "<script>location.href='../../pages/pagamento.php';</script>";
        break;
    
    
        
}

session_destroy(); // Destruir a sessão 
?>
