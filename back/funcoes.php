<?php
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
    }
    
    // RG válido
    return true;
}

// VALIDAR CPF
function validarCPF($cpf) {

    // Remover pontos e traços do número de CPF
    $cpf = preg_replace('/\D/', '', $cpf);
    
    // Verificar se o número de CPF tem 11 dígitos
    if (strlen($cpf) != 11) {
      return false;
    }
    
    // Verificar se todos os dígitos são iguais
    if (preg_match('/^(\d)\1*$/', $cpf)) {
      return false;
    }
    
    // Calcular o primeiro dígito verificador
    $soma = 0;
    for ($i = 0; $i < 9; $i++) {
      $soma += ($cpf[$i] * (10 - $i));
    }
    $dv1 = ($soma % 11);
    if ($dv1 == 10) {
      $dv1 = 0;
    }
    
    // Calcular o segundo dígito verificador
    $soma = 0;
    for ($i = 0; $i < 10; $i++) {
      $soma += ($cpf[$i] * (11 - $i));
    }
    $dv2 = ($soma % 11);
    if ($dv2 == 10) {
      $dv2 = 0;
    }
    
    // Verificar se os dígitos verificadores são iguais aos últimos dois dígitos do CPF
    if ($dv1 != $cpf[9] || $dv2 != $cpf[10]) {
      return false;
    }
    
    // CPF válido
    return true;
}

?>