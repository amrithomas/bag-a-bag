<?php
session_start();
include_once('../conexao.php');

// OBTER DADOS
$aviao_ida = filter_input(INPUT_POST, 'aviao_ida');
$aviao_volta = filter_input(INPUT_POST, 'aviao_volta');

$aeroporto_origem = filter_input(INPUT_POST, 'aeroporto_origem', FILTER_SANITIZE_NUMBER_INT);
$aeroporto_destino = filter_input(INPUT_POST, 'aeroporto_destino', FILTER_SANITIZE_NUMBER_INT);

$horario_partida_ida = filter_input(INPUT_POST, 'horario_partida_ida');
$horario_chegada_ida = filter_input(INPUT_POST, 'horario_chegada_ida');

$horario_partida_volta = filter_input(INPUT_POST, 'horario_partida_volta');
$horario_chegada_volta = filter_input(INPUT_POST, 'horario_chegada_volta');

$aeroporto_escala_ida = filter_input(INPUT_POST, 'aeroporto_escala_ida', FILTER_SANITIZE_NUMBER_INT);
$aeroporto_escala_volta = filter_input(INPUT_POST, 'aeroporto_escala_volta', FILTER_SANITIZE_NUMBER_INT);

$horario_escala_ida = filter_input(INPUT_POST, 'horario_ida_escala');
$tempo_escala_ida = filter_input(INPUT_POST, 'tempo_escala_ida');

$horario_escala_volta = filter_input(INPUT_POST, 'horario_volta_escala');
$tempo_escala_volta = filter_input(INPUT_POST, 'tempo_escala_volta');


echo $aviao_ida . "<br>";
echo $aviao_volta . "<br>";

echo $aeroporto_origem . "<br>";
echo $aeroporto_destino . "<br>";

echo $aeroporto_escala_ida . "<br>";
echo $aeroporto_escala_volta . "<br>";

// FORMATAR O VALOR DE MOEDA PARA O PADRÃO FLOAT
$valor_passagem = filter_input(INPUT_POST, 'valor_passagem');
// $valor_passagem = substr($valor_passagem, 4);
// $valor_passagem = str_replace(".", "", $valor_passagem); 
// $valor_passagem[-3] = ".";
$valor_passagem = (float) $valor_passagem;



// Verifica se escolheu escala
if (!empty($aeroporto_escala_ida) && !empty($aeroporto_escala_volta)) {

	$query = "INSERT INTO escala (HORARIO_CHEGADA_ESCALA, TEMPO_ESCALA, FK_AEROPORTO_ESCALA) VALUES ('$horario_escala_ida', '$tempo_escala_ida', '$aeroporto_escala_ida')";
	mysqli_query($conn, $query);
	$query = "INSERT INTO escala (HORARIO_CHEGADA_ESCALA, TEMPO_ESCALA, FK_AEROPORTO_ESCALA) VALUES ('$horario_escala_volta', '$tempo_escala_volta', '$aeroporto_escala_volta')";
	mysqli_query($conn, $query);
}
// INSERIR DADOS NA TABELA DE ESCALA
if (mysqli_insert_id($conn)) {
	$aeroporto_escala_ida = mysqli_insert_id($conn);
	$aeroporto_escala_volta = mysqli_insert_id($conn);
} else {
	$aeroporto_escala_ida = "NULL";
	$aeroporto_escala_volta = "NULL";
	// INSERIR DADOS NA TABELA DE VOOS
	$query = "INSERT INTO voo 
		(FK_ORIGEM_AERO, FK_DESTINO_AERO, FK_ESCALA_IDA, FK_ESCALA_VOLTA, VALOR_PASSAGEM, IDA_HORARIO_PARTIDA, IDA_HORARIO_CHEGADA, VOLTA_HORARIO_PARTIDA, VOLTA_HORARIO_CHEGADA, FK_AVIAO_IDA, FK_AVIAO_VOLTA, CRIADO) 
		VALUES ('$aeroporto_origem', '$aeroporto_destino', '$aeroporto_escala_ida', '$aeroporto_escala_volta', '$valor_passagem', '$horario_partida_ida', '$horario_chegada_ida', '$horario_partida_volta', '$horario_chegada_volta', '$aviao_ida', '$aviao_volta', NOW())";
	
	mysqli_query($conn, $query);
	if (mysqli_insert_id($conn)) {
		$_SESSION['msg'] = "<p style='color: green;' class='text-center'>VOO CADASTRADO COM SUCESSO!</p>";
		echo "<script>location.href='../admin/voo.php'</script>";
	} else {
		$_SESSION['msg'] = "<p style='color: red;' class='text-center'>ERRO!</p>";
		echo "<script>location.href='../admin/criar_voo.php'</script>";
	}
}


	