<?php
session_start();
include_once('../conexao.php');

// OBTER DADOS
$horario_partida = filter_input(INPUT_POST, 'horario_partida');
$horario_chegada = filter_input(INPUT_POST, 'horario_chegada');

// FORMATAR O VALOR DE MOEDA PARA O PADRÃO FLOAT
$valor_passagem = filter_input(INPUT_POST, 'valor_passagem');
$valor_passagem = substr($valor_passagem, 4);
$valor_passagem = str_replace(".", "", $valor_passagem); 
$valor_passagem[-3] = ".";
$valor_passagem = (float) $valor_passagem;

$fk_origem_aero = filter_input(INPUT_POST, 'fk_origem_aero', FILTER_SANITIZE_NUMBER_INT);
$fk_destino_aero = filter_input(INPUT_POST, 'fk_destino_aero', FILTER_SANITIZE_NUMBER_INT);
$fk_aviao = filter_input(INPUT_POST, 'fk_aviao', FILTER_SANITIZE_NUMBER_INT);

$fk_aeroporto_escala = filter_input(INPUT_POST, 'fk_aeroporto_escala', FILTER_SANITIZE_NUMBER_INT);
$horario_chegada_escala = filter_input(INPUT_POST, 'horario_chegada_escala');
$tempo_escala = filter_input(INPUT_POST, 'tempo_escala');

// Verifica se escolheu escala
if(!empty($fk_aeroporto_escala)){
	
	$query = "INSERT INTO escala (HORARIO_CHEGADA_ESCALA, TEMPO_ESCALA, FK_AEROPORTO_ESCALA) VALUES ('$horario_chegada_escala', '$tempo_escala', '$fk_aeroporto_escala')";
	mysqli_query($conn, $query);
}
// INSERIR DADOS NA TABELA DE ESCALA

if (mysqli_insert_id($conn)) {
	$fk_escala = mysqli_insert_id($conn);
}else {
	$fk_escala = "NULL";
}

	// INSERIR DADOS NA TABELA DE VOOS
	$query = "INSERT INTO voo (HORARIO_PARTIDA, HORARIO_CHEGADA, VALOR_PASSAGEM, CRIADO, FK_ORIGEM_AERO, FK_DESTINO_AERO, FK_AVIAO, FK_ESCALA) VALUES ('$horario_partida', '$horario_chegada', '$valor_passagem', NOW(), '$fk_origem_aero', '$fk_destino_aero', '$fk_aviao', $fk_escala)";
	mysqli_query($conn, $query);

	if (mysqli_insert_id($conn)) {
		echo "DEU CERTO";
	} else {
		echo "não criou voo";
	}
// }
// else {
// 	echo "Não criou escala nem voo";
// }

?>
