<?php 
session_start();
include_once('../conexao.php');

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

$query_consulta = "SELECT * FROM VOO WHERE ID_VOO='$id'";
$consulta = mysqli_query($conn, $query_consulta);
$row_consulta = mysqli_fetch_assoc($consulta);

$aviao_ida = filter_input(INPUT_POST, 'aviao_ida', FILTER_SANITIZE_NUMBER_INT);
$aviao_volta = filter_input(INPUT_POST, 'aviao_volta', FILTER_SANITIZE_NUMBER_INT);
$aviao_volta = empty($aviao_volta) ? "NULL" : $aviao_volta;

$aeroporto_origem = filter_input(INPUT_POST, 'aeroporto_origem', FILTER_SANITIZE_NUMBER_INT);
$aeroporto_destino = filter_input(INPUT_POST, 'aeroporto_destino', FILTER_SANITIZE_NUMBER_INT);

$horario_partida_ida = filter_input(INPUT_POST, 'horario_partida_ida');
$horario_chegada_ida = filter_input(INPUT_POST, 'horario_chegada_ida');

$horario_partida_volta = filter_input(INPUT_POST, 'horario_partida_volta');
if ($horario_partida_volta == "") {
    $horario_partida_volta = "NULL";
} else {
    $horario_partida_volta = "'$horario_partida_volta'";
}

$horario_chegada_volta = filter_input(INPUT_POST, 'horario_chegada_volta');
if ($horario_chegada_volta == "") {
    $horario_chegada_volta = "NULL";
} else {
    $horario_chegada_volta = "'$horario_chegada_volta'";
}

$aeroporto_escala_ida = filter_input(INPUT_POST, 'aeroporto_escala_ida', FILTER_SANITIZE_NUMBER_INT);
$aeroporto_escala_volta = filter_input(INPUT_POST, 'aeroporto_escala_volta', FILTER_SANITIZE_NUMBER_INT);

$horario_escala_ida = filter_input(INPUT_POST, 'horario_ida_escala');
$tempo_escala_ida = filter_input(INPUT_POST, 'tempo_escala_ida');

$horario_escala_volta = filter_input(INPUT_POST, 'horario_volta_escala');
$tempo_escala_volta = filter_input(INPUT_POST, 'tempo_escala_volta');

$valor_passagem = filter_input(INPUT_POST, 'valor_passagem');
$valor_passagem = (float) $valor_passagem;

if (!empty($aeroporto_escala_ida)) {
    if (!empty($row_consulta['FK_ESCALA_IDA'])) {
        $fk_escala_ida = $row_consulta['FK_ESCALA_IDA'];

        $query_escala1 = "UPDATE ESCALA
        SET
        HORARIO_CHEGADA_ESCALA='$horario_escala_ida',
        TEMPO_ESCALA='$tempo_escala_ida',
        FK_AEROPORTO_ESCALA=$aeroporto_escala_ida
        WHERE ID_ESCALA=$row_consulta[FK_ESCALA_IDA]";    
    } else {
        $query_escala1 = "INSERT INTO ESCALA (HORARIO_CHEGADA_ESCALA, TEMPO_ESCALA, FK_AEROPORTO_ESCALA)
        VALUES ('$horario_escala_ida', '$tempo_escala_ida', $aeroporto_escala_ida)";
    }

    mysqli_query($conn, $query_escala1);

} else {
    $fk_escala_ida = "NULL";
}

if (!empty($aeroporto_escala_volta)) {
    if (!empty($row_consulta['FK_ESCALA_VOLTA'])) {
        $fk_escala_volta = $row_consulta['FK_ESCALA_VOLTA'];

        $query_escala2 = "UPDATE ESCALA
        SET
        HORARIO_CHEGADA_ESCALA='$horario_escala_volta',
        TEMPO_ESCALA='$tempo_escala_volta',
        FK_AEROPORTO_ESCALA=$aeroporto_escala_volta
        WHERE ID_ESCALA=$row_consulta[FK_ESCALA_VOLTA]";
    } else {
        $query_escala2 = "INSERT INTO ESCALA (HORARIO_CHEGADA_ESCALA, TEMPO_ESCALA, FK_AEROPORTO_ESCALA)
        VALUES ('$horario_escala_volta', '$tempo_escala_volta', $aeroporto_escala_volta)";
    }
    
    mysqli_query($conn, $query_escala2);

} else {
    $fk_escala_volta = "NULL";
}

$update = "UPDATE voo 
SET 
FK_ORIGEM_AERO=$aeroporto_origem,
FK_DESTINO_AERO=$aeroporto_destino,
FK_ESCALA_IDA=$fk_escala_ida,
FK_ESCALA_VOLTA=$fk_escala_volta,
VALOR_PASSAGEM=$valor_passagem,
IDA_HORARIO_PARTIDA='$horario_partida_ida',
IDA_HORARIO_CHEGADA='$horario_chegada_ida',
VOLTA_HORARIO_PARTIDA=$horario_partida_volta,
VOLTA_HORARIO_CHEGADA=$horario_chegada_volta,
FK_AVIAO_IDA=$aviao_ida,
FK_AVIAO_VOLTA=$aviao_volta,
MODIFICADO=NOW()
WHERE ID_VOO='$id'";

$resultado = mysqli_query($conn, $update);

if (mysqli_affected_rows($conn)) {
    $_SESSION["msg"] = "<p class='text-center' style='color: green;'>Edição realizada com sucesso</p>";
    echo "<script>location.href='../admin/voo.php';</script>";
} else {
    $_SESSION["msg"] = "<p class='text-center' style='color: red;'>VOO NÂO FOI EDITADO</p>";
    echo "<script>location.href='../admin/editar_voo.php';</script>";
}

?>
