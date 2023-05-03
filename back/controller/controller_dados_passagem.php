<?php
session_start();
include_once("../conexao.php");

// pega o tamanho do array POST para saber quantos asentos foram selecionados
$total_assentos = sizeof($_POST);

echo var_dump($_POST);
$assentos_escolhidos = array_values($_POST);

for ($i=0; $i <= $total_assentos; $i++) { 
    $numero_assento = $assentos_escolhidos[$i];
    echo $numero_assento;
    
    $query = "UPDATE assentos SET ocupado = 1 FROM assentos INNER JOIN aviao ON assentos.FK_AVIAO = aviao.ID_AVIAO INNER JOIN voo ON WHERE voo.FK_AVIAO = aviao.ID_AVIAO WHERE NUMERO_ASSENTO = $numero_assento";
}

?>