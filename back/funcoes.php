<?php
include_once("conexao.php");
date_default_timezone_set('America/Sao_Paulo');
// VALIDAR RG
function validarRG($rg) {
    // Remover pontos e traços do número de RG
    $rg = preg_replace('/\D/', '', $rg);
    
    // Verificar se o número de RG tem 9 dígitos
    if (strlen($rg) != 9) {
        return false;
    }
    
    // Calcular o dígito verificador
    $soma = 0;
    for ($i = 0; $i < 8; $i++) {
        $soma += ($rg[$i] * (9 - $i));
    }
    $dv = ($soma % 11);
    if ($dv == 10) {
        $dv = 'X';
    }
    
    // Verificar se o dígito verificador é igual ao último dígito do número de RG
    if ($dv != $rg[8]) {
        return false;
        //$_SESSION["rg"] = "<p style='color: red;'>RG inválido</p>";
    }
    
    // RG válido
    return true;
}

// VALIDAR CPF
function validarCPF($cpf) {
    if (strlen($cpf) == 11){
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        } else {
            $a = 10;
            $c = 11;
            $calculo = 0;
            $calculo2 = 0;

            // VALIDAÇÃO DO PRIMEIRO NÚMERO
            for ($i = 0; $i < 9; $i++) {
                $calculo = $calculo + ($cpf[$i] * ($a--));
            }
            $resultado = $calculo % 11;
            $primeiro_numero = 11 - $resultado;

            if ($primeiro_numero > 10) {
                $primeiro_numero = 0;
            }


            if ($primeiro_numero != $cpf[9]) {
                return false;
            } 
            // VALIDAÇÃO SEGUNDO NÚMERO
            else {
                for ($b = 0; $b < 10; $b++) {
                    $calculo2 = $calculo2 + ($cpf[$b] * ($c--));
                }
                $resultado2 = $calculo2 % 11;
                $segundo_numero = 11 - $resultado2;


                if ($segundo_numero > 10) {
                    $segundo_numero = 0;
                }

                if ($segundo_numero != $cpf[10]) {
                    return false;
                    //$_SESSION["cpf"] = "<p style='color: red;'>CPF inválido</p>";
                }
                else {
                    return true;

                    
                }
            }
        }
    } else {
        return false;
    }
}

function validarDataRg($data_emissao){
    $data_atual = date("Y-m-d");
    $diff = date_diff(date_create($data_emissao), date_create($data_atual));
    $idade = $diff->format('%y');
    
    if ($idade < 10 && $data_atual >= $data_emissao){
        return true;
    } else {
        return false;
        //$_SESSION["data_rg"] = "<p style='color: red;'>Data de emissão inválida</p>"; 
    }
}


?>