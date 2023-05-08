<!-- para que esse arquivo funcione, deve haver registros nas tabelas de endereço, rg, cadastro, usuario e telefone -->

<?php
session_start();
include_once('../conexao.php');
include_once('../funcoes.php');

// ID_USUARIO
$id_usuario = 4; //$_SESSION['id_usuario'];

// /\ 
// esses dados serão recebidos por variaveis SESSION ou pelo <form>
// \/ 

// ID_VOO
$id_voo = 1; 

// OBTER OS IDs DOS ASSENTOS
$assentos = $_SESSION['assentos'];
$total_passageiros = count($assentos);

$assentos_pks = [];
for ($i=0; $i < $total_passageiros; $i++) { 
    $query = "SELECT ID_ASSENTO FROM assentos INNER JOIN aviao ON aviao.ID_AVIAO = assentos.FK_AVIAO INNER JOIN voo ON voo.FK_AVIAO_IDA = aviao.ID_AVIAO WHERE ID_VOO=$id_voo AND NUMERO_ASSENTO=$assentos[$i]";
    $consulta = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($consulta);
    
    $assentos_pks[] = $row['ID_ASSENTO'];
}

// PEGAR OS DADOS DO(S) PASSAGEIRO(S) COM O ARRAY POST
$array_dados = array_values($_POST);
$total_passageiros = sizeof($array_dados) / 7;

// Pegar o preço da passagem do voo
$query = "SELECT VALOR_PASSAGEM FROM voo WHERE ID_VOO=$id_voo";
$consulta = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($consulta);
$valor_passagem = $row['VALOR_PASSAGEM'];

$valor_total = $valor_passagem * $total_passageiros;

// VERIFICA SE TODOS OS PASSAGEIROS POSSUEM CPF VÁLIDO
for ($passageiro=0; $passageiro < $total_passageiros; $passageiro++) {
    $nome = $array_dados[0+(7*$passageiro)];
    $sobrenome = $array_dados[1+(7*$passageiro)];
    $cpf_passageiro = $array_dados[2+(7*$passageiro)];

    if (!(validarCPF($cpf_passageiro))) {
        $_SESSION['msg'] = "<p style='color:red;'>Erro. O CPF informado para o passageiro <b> $nome $sobrenome </b> ($cpf_passageiro) é inválido.</p>";
        echo "<script>location.href='../../pages/cadastro-passageiro.php';</script>";
        break;
    }
}

// CRIA A RESERVA
$query = "INSERT INTO reserva (STATUS_RESERVA, VALOR_TOTAL, DATA_RESERVA, DATA_STATUS, FK_USUARIO) VALUES ('Pendente', $valor_total, NOW(), NOW(), $id_usuario)";
$consulta = mysqli_query($conn, $query);


if (mysqli_insert_id($conn)) {
    $id_reserva = mysqli_insert_id($conn);
} else {
    $_SESSION['msg'] = "<p style='color:red;'>Erro. Não foi possível criar a reserva. Tente novamente.</p>";
    echo "<script>location.href='../../pages/cadastro-passageiro.php';</script>";
}

// CRIAÇÃO DE PASSAGEM
for ($i=0, $passageiro=0; $passageiro < $total_passageiros; $passageiro++) {
    $nome_passageiro = $array_dados[$i++];
    $sobrenome_passageiro = $array_dados[$i++];
    $cpf_passageiro = $array_dados[$i++];
    $data_nasc_passageiro = $array_dados[$i++];
    $ddd = $array_dados[$i++];
    $numero_telefone = $array_dados[$i++]; 
    $numero_telefone = str_replace("-", "", $numero_telefone);
    $email_passageiro = $array_dados[$i++];
    $fk_assento = $assentos_pks[$passageiro];

    // procura por um passageiro com os dados informados no banco
    $query = "SELECT * FROM passageiro WHERE CPF_PASSAGEIRO=$cpf_passageiro AND DATA_NASC_PASSAGEIRO='$data_nasc_passageiro'";
    $consulta = mysqli_query($conn, $query);
    
    // SE NÃO HOUVER PASSAGEIRO COM OS DADOS INFORMADOS...
    if (mysqli_num_rows($consulta) == 0) {
        // ...procura pelo telefone informado
        $query = "SELECT * FROM telefone WHERE DDD=$ddd AND NUMERO_TELEFONE=$numero_telefone";
        $consulta = mysqli_query($conn, $query);

        // SE NÃO HOUVER ESTE TELEFONE NO BANCO...
        if (mysqli_num_rows($consulta) == 0) {
            // ...inserir telefone do passageiro no banco
            $query = "INSERT INTO telefone (DDD, NUMERO_TELEFONE, MODIFICADO) VALUES ($ddd, $numero_telefone, NOW())";
            $consulta = mysqli_query($conn, $query);

            if (mysqli_insert_id($conn)) {
                $id_telefone = mysqli_insert_id($conn);
            } else {
                $_SESSION['msg'] = "<p style='color:red;'>Erro. Não foi possível realizar o cadastro. Tente novamente.</p>";
                echo "<script>location.href='../../pages/cadastro-passageiro.php';</script>";
                break;
            }

        } else {
            $row = mysqli_fetch_assoc($consulta);
            $id_telefone = $row['ID_TELEFONE'];
        }

        // CRIAR REGISTRO DE PASSAGEIRO
        $query = "INSERT INTO passageiro (NOME_PASSAGEIRO, SOBRENOME_PASSAGEIRO, EMAIL_PASSAGEIRO, CPF_PASSAGEIRO, DATA_NASC_PASSAGEIRO, FK_TELEFONE) VALUES ('$nome_passageiro', '$sobrenome_passageiro', '$email_passageiro', '$cpf_passageiro', '$data_nasc_passageiro', $id_telefone)";
        $consulta = mysqli_query($conn, $query);
        
        if (mysqli_insert_id($conn)) {
            $id_passageiro = mysqli_insert_id($conn);
            $_SESSION['msg'] = "<p style='color:green;'>Cadastro realizado com sucesso.</p>";
        } else {
            $_SESSION['msg'] = "<p style='color:red;'>Erro. Não foi possível realizar o cadastro. Tente novamente.</p>";
            echo "<script>location.href='../../pages/cadastro-passageiro.php';</script>";
            break;
        }
    }
    // SE HOUVER PASSAGEIRO COM OS DADOS INFORMADOS...
    else {
        $row = mysqli_fetch_assoc($consulta);
        $id_passageiro = $row['ID_PASSAGEIRO'];
    }

    // CRIAR PASSAGEM
    $query = "INSERT INTO passagem (FK_ASSENTO, FK_PASSAGEIRO, FK_VOO, FK_CUPOM, FK_RESERVA) VALUES ($assentos_pks[$passageiro], $id_passageiro, $id_voo, DEFAULT, $id_reserva)";
    $consulta = mysqli_query($conn, $query);
}

if (mysqli_insert_id($conn)) {        
    $_SESSION['valor_total'] = $valor_total;
    $_SESSION['id_reserva'] = $id_reserva;

    $_SESSION['msg'] = "<p style='color:green;'>Cadastro de passageiros realizado com sucesso.</p>";
    echo $_SESSION['msg'];
    // echo "<script>location.href='../../pages/pagamento.php';</script>";
} else {
    $_SESSION['msg'] = "<p style='color:red;'>Erro. Não foi possível realizar o cadastro. Tente novamente.</p>";
    echo "<script>location.href='../../pages/cadastro-passageiro.php';</script>";
}

?>
