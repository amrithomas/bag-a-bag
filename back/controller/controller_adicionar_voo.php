<?php
session_start();
include_once('../conexao.php');

// OBTER DADOS
$fk_origem_aero = filter_input(INPUT_POST, 'fk_origem_aero_ida', FILTER_SANITIZE_NUMBER_INT);
$fk_destino_aero = filter_input(INPUT_POST, 'fk_destino_aero_ida', FILTER_SANITIZE_NUMBER_INT);

$fk_aviao_ida = filter_input(INPUT_POST, 'fk_aviao_ida', FILTER_SANITIZE_NUMBER_INT);

$ida_horario_partida = filter_input(INPUT_POST, 'ida_horario_partida');
$ida_horario_chegada = filter_input(INPUT_POST, 'ida_horario_chegada');

$fk_aeroporto_escala_ida = filter_input(INPUT_POST, 'fk_aeroporto_escala_ida', FILTER_SANITIZE_NUMBER_INT);
$horario_chegada_escala_ida = filter_input(INPUT_POST, 'horario_chegada_escala_ida');
$tempo_escala_ida = filter_input(INPUT_POST, 'tempo_escala_ida');

$tipo = filter_input(INPUT_POST, 'tipo');
if ($tipo == 1) {
	$fk_aviao_volta = filter_input(INPUT_POST, 'fk_aviao_volta', FILTER_SANITIZE_NUMBER_INT);

	$volta_horario_partida = filter_input(INPUT_POST, 'volta_horario_partida');
	$volta_horario_chegada = filter_input(INPUT_POST, 'volta_horario_chegada');

	$fk_aeroporto_escala_volta = filter_input(INPUT_POST, 'fk_aeroporto_escala_volta', FILTER_SANITIZE_NUMBER_INT);
	$horario_chegada_escala_volta = filter_input(INPUT_POST, 'horario_chegada_escala_volta');
	$tempo_escala_volta = filter_input(INPUT_POST, 'tempo_escala_volta');

	$valor_passagem = filter_input(INPUT_POST, 'valor_passagem');
} else {
	$fk_aviao_volta = "NULL";

	$volta_horario_partida = "";
	$volta_horario_chegada = "";

	$fk_aeroporto_escala_volta = "";
	$horario_chegada_escala_volta = "NULL";
	$tempo_escala_volta = "NULL";
}



$valor_passagem = filter_input(INPUT_POST, 'valor_passagem');



// formatar o valor de moeda para o padrão float
$valor_passagem = substr($valor_passagem, 4);
$valor_passagem = str_replace(".", "", $valor_passagem); 
$valor_passagem[-3] = ".";
$valor_passagem = (float) $valor_passagem;

if ($valor_passagem == 0) {
	$_SESSION["msg"] = "<p style='color: red;'>Erro. Valor da passagem não foi informado</p>";
    header("Location: ../criar_voo.php");
}


// INSERIR DADOS NA TABELA DE ESCALA
if (!empty($fk_aeroporto_escala_ida)) {
	if ((!empty($horario_chegada_escala_ida)) && (!empty($tempo_escala_ida))) {
		$query = "INSERT INTO escala (HORARIO_CHEGADA_ESCALA, TEMPO_ESCALA, FK_AEROPORTO_ESCALA) VALUES ('$horario_chegada_escala_ida', '$tempo_escala_ida', '$fk_aeroporto_escala_ida')";
		mysqli_query($conn, $query);
		
		$fk_escala_ida = mysqli_insert_id($conn) ? mysqli_insert_id($conn) : "NULL";
	} else {
		$_SESSION["msg"] = "<p style='color: red;'>Dados de escala incompletos.</p>";
    	header("Location: ../criar_voo.php");
	}
} else {
	$fk_escala_ida = "NULL";
}

if (!empty($fk_aeroporto_escala_volta)) {
	if ((!empty($horario_chegada_escala_volta)) && (!empty($tempo_escala_volta))) {
		$query = "INSERT INTO escala (HORARIO_CHEGADA_ESCALA, TEMPO_ESCALA, FK_AEROPORTO_ESCALA) VALUES ('$horario_chegada_escala_volta', '$tempo_escala_volta', '$fk_aeroporto_escala_volta')";
		mysqli_query($conn, $query);
		
		$fk_escala_volta = mysqli_insert_id($conn) ? mysqli_insert_id($conn) : "NULL";

	} else {
		$_SESSION["msg"] = "<p style='color: red;'>Dados de escala incompletos.</p>";
    	header("Location: ../criar_voo.php");
	}
} else {
	$fk_escala_volta = "NULL";
}

// INSERIR DADOS NA TABELA DE VOOS
$query = "INSERT INTO voo (FK_ORIGEM_AERO, FK_DESTINO_AERO, FK_ESCALA_IDA, FK_ESCALA_VOLTA, VALOR_PASSAGEM, IDA_HORARIO_PARTIDA, IDA_HORARIO_CHEGADA, VOLTA_HORARIO_PARTIDA, VOLTA_HORARIO_CHEGADA, FK_AVIAO_IDA, FK_AVIAO_VOLTA, CRIADO) VALUES ($fk_origem_aero, $fk_destino_aero, $fk_escala_ida, $fk_escala_volta, '$valor_passagem', '$ida_horario_partida', '$ida_horario_chegada', '$volta_horario_partida', '$volta_horario_chegada', $fk_aviao_ida, $fk_aviao_volta, NOW())";
mysqli_query($conn, $query);

if (mysqli_insert_id($conn)) {
	$_SESSION["msg"] = "<p style='color: green;'>Viagem cadastrada com sucesso.</p>";
    header("Location: ../criar_voo.php");
} else {
	$_SESSION["msg"] = "<p style='color: red;'>Erro. A viagem não foi cadastrada.</p>";
    header("Location: ../criar_voo.php");
}



?>
