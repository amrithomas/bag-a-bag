<?php
session_start();
include_once("conexao.php");

$dados_passagens = $_SESSION['$dados_passagens'];

$reserva = [];

for ($i=0; $i < sizeof($dados_passagens); $i++) { 
    $reserva[$i] = $dados_passagens[$i];
}

//  = array(
//     ['tipo_passagem'=>"", 'id_passageiro'=>$_SESSION['id_passageiro'], 'fk_assento'=>$_SESSION['fk_assento']], //passagem 1
//     ['tipo_passagem'=>$tipo_passagem, 'id_passageiro'=>$_SESSION['id_passageiro'], 'fk_assento'=>$_SESSION['fk_assento']],
// )

?>