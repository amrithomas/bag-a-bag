<?php
session_start();
include_once("../conexao.php");

// ID_VOO
$id_voo = 1;

// pega o tamanho do array POST para saber quantos asentos foram selecionados
$total_assentos = sizeof($_POST);
echo "total de assentos: " . $total_assentos . "<br>";

echo var_dump($_POST) . "<br>";
$assentos_escolhidos = array_values($_POST);

// MARCAR ASSENTOS DO AVIAO DE IDA COMO OCUPADOS
for ($i=0; $i < $total_assentos; $i++) { 
    $numero_assento = $assentos_escolhidos[$i];
    echo $numero_assento . "<br>";

    $query = "UPDATE assentos INNER JOIN aviao ON assentos.FK_AVIAO = aviao.ID_AVIAO INNER JOIN voo ON voo.FK_AVIAO_IDA = aviao.ID_AVIAO SET ocupado = 1 WHERE NUMERO_ASSENTO='$numero_assento' AND voo.ID_VOO='$id_voo'";

    $consulta = mysqli_query($conn, $query);
}

// SABER SE HÁ VOO DE VOLTA
$query = "SELECT * FROM voo WHERE id_voo=$id_voo";
$consulta = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($consulta);

// MARCAR ASSENTOS DO AVIAO DE VOLTA COMO OCUPADOS SE HOUVER VOLTA
if (!empty($row['FK_AVIAO_VOLTA'])) {
    for ($i=0; $i < $total_assentos; $i++) { 
        $numero_assento = $assentos_escolhidos[$i];
        echo $numero_assento . "<br>";

        // ASSENTOS DO AVIAO DE VOLTA
        $query = "UPDATE assentos INNER JOIN aviao ON assentos.FK_AVIAO = aviao.ID_AVIAO INNER JOIN voo ON voo.FK_AVIAO_VOLTA = aviao.ID_AVIAO SET ocupado = 1 WHERE NUMERO_ASSENTO='$numero_assento' AND voo.ID_VOO='$id_voo'";
        $consulta = mysqli_query($conn, $query);
    }
}

// // PEGAR O PREÇO DAS PASSAGENS
// $query = "SELECT * FROM voo WHERE id_voo=$id_voo"
// $preco_passagem 

?>