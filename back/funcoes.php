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
    $resto = ($soma % 11);
    if ($resto < 2) {
        $dv1 = 0;
    } else {
		$dv1 = (11 - $resto);
	}
    
    // Calcular o segundo dígito verificador
    $soma = 0;
    for ($i = 1; $i < 10; $i++) {
        $soma += ($cpf[$i] * (11 - $i));
    }
    $resto = ($soma % 11);
    if ($resto < 2) {
        $dv2 = 0;
    } else {
		$dv2 = (11 - $resto);
	}
    
    // Verificar se os dígitos verificadores são iguais aos últimos dois dígitos do CPF
    if ($dv1 != $cpf[9] || $dv2 != $cpf[10]) {
        return false;
    }
    
    // CPF válido
    return true;
}

function criarFormulario($total_passageiros) {
    $form_content = "";
    
    if ($total_passageiros == 1) {
        $i = 1;

        $form_content = $form_content . "
              <div class='row'>
                <div class='half-box'>
                  <div class='col'>
                    <label for = 'nome_passageiro" . $i . "' class='required' style = 'color: #5c9f24'>Nome</label>
                    <input type = 'text' name='nome_passageiro" . $i ."' class='form-control required' style = 'background-color: #FFF; border-color: black' id = 'name'>
                  </div>
                </div>
              </div>
                <div class = 'half-box'>
                <div class='col'>
                  <label for = 'sobrenome_passageiro" . $i . "' class='required' style = 'color: #5c9f24'>Sobrenome</label>
                  <input type='text' name='sobrenome_passageiro" . $i . "'  class='form-control required' style = 'background-color: #FFF; border-color: black' id = 'ultname'>
                </div>
              </div>
              <div class='row'>
                <div class = 'half-box'>
                  <label for = 'cpf_passageiro" . $i . "' class='required' style = 'color: #5c9f24' >CPF</label>
                  <input type = 'number' name='cpf_passageiro" . $i . "' class='form-control required' style = 'background-color: #FFF; border-color: black' id = 'cpf'>
                </div>
                <div class = 'half-box'>
                    <label for = 'data_nasc_passageiro" . $i . "' class='required' style = 'color: #5c9f24'>Data de Nascimento</label>
                    <input type = 'date' name = 'data_nasc_passageiro" . $i . "' id = 'data_nasc' class='form-control' style = 'background-color: #FFF; border-color: black'>
                </div>
              </div>
              <div class='row'>
                <div class = 'half-box'>
                  <div class = 'col-4'>
                    <label for = 'ddd" . $i . "' class='required' style = 'color: #5c9f24'>DDD</label>
                    <input type = 'number' maxlength='2' name = 'ddd" . $i . "' placeholder = '(XX)' id = 'ddd' class='form-control required'style = 'background-color: #FFF; border-color: black'>
                  </div>
                </div>
                <div class = 'half-box'>
                  <label for = 'numero_telefone" . $i . "' class='required' style = 'color: #5c9f24'>Telefone</label>
                  <input type = 'tel' name = 'numero_telefone" . $i . "' id = 'telefone' placeholder = 'XXXXX-XXXX' maxlength='15' class='form-control required' onkeypress='tel(this)' style = 'background-color: #FFF; border-color: black'>
                </div>
              </div>
              <div class='row'>
                  <div class = 'half-box'>
                    <label for = 'email_passageiro" . $i . "' class='required' style = 'color: #5c9f24'>E-mail</label>
                    <input type = 'email' name = 'email_passageiro" . $i . "' id = 'email' class='form-control required' style = 'background-color: #FFF; border-color: #000'>
                  </div>
              </div>";
    } else {
        for ($i=1; $i <= $total_passageiros; $i++) { 
            $form_content = $form_content . "
            <div class='row'>
                <div class='half-box'>
                <h2>Passageiro " . $i . "</h2>" .
                "</div>
            </div>
            <div class='row'>
                <div class='half-box'>
                <div class='col'>
                    <label for = 'nome_passageiro" . $i . "' class='required' style = 'color: #5c9f24'>Nome</label>
                    <input type = 'text' name='nome_passageiro" . $i ."' class='form-control required' style = 'background-color: #FFF; border-color: black' id = 'name'>
                </div>
                </div>
            </div>
                <div class = 'half-box'>
                <div class='col'>
                <label for = 'sobrenome_passageiro" . $i . "' class='required' style = 'color: #5c9f24'>Sobrenome</label>
                <input type='text' name='sobrenome_passageiro" . $i . "'  class='form-control required' style = 'background-color: #FFF; border-color: black' id = 'ultname'>
                </div>
            </div>
            <div class='row'>
                <div class = 'half-box'>
                <label for = 'cpf_passageiro" . $i . "' class='required' style = 'color: #5c9f24' >CPF</label>
                <input type = 'number' name='cpf_passageiro" . $i . "' class='form-control required' style = 'background-color: #FFF; border-color: black' id = 'cpf'>
                </div>
                <div class = 'half-box'>
                    <label for = 'data_nasc_passageiro" . $i . "' class='required' style = 'color: #5c9f24'>Data de Nascimento</label>
                    <input type = 'date' name = 'data_nasc_passageiro" . $i . "' id = 'data_nasc' class='form-control' style = 'background-color: #FFF; border-color: black'>
                </div>
            </div>
            <div class='row'>
                <div class = 'half-box'>
                <div class = 'col-4'>
                    <label for = 'ddd" . $i . "' class='required' style = 'color: #5c9f24'>DDD</label>
                    <input type = 'number' maxlength='2' name = 'ddd" . $i . "' placeholder = '(XX)' id = 'ddd' class='form-control required'style = 'background-color: #FFF; border-color: black'>
                </div>
                </div>
                <div class = 'half-box'>
                <label for = 'numero_telefone" . $i . "' class='required' style = 'color: #5c9f24'>Telefone</label>
                <input type = 'tel' name = 'numero_telefone" . $i . "' id = 'telefone' placeholder = 'XXXXX-XXXX' maxlength='15' class='form-control required' onkeypress='tel(this)' style = 'background-color: #FFF; border-color: black'>
                </div>
            </div>
            <div class='row'>
                <div class = 'half-box'>
                    <label for = 'email_passageiro" . $i . "' class='required' style = 'color: #5c9f24'>E-mail</label>
                    <input type = 'email' name = 'email_passageiro" . $i . "' id = 'email' class='form-control required' style = 'background-color: #FFF; border-color: #000'>
                </div>
            </div>";
        }
    }
    $form_content = $form_content . "
    <div class='row'>
        <div class='full-box'>
            <button type='submit' id = 'cadastrar' class='btn btn-success'>Cadastrar</button>
        </div>
    </div>";
    return $form_content;
}

?>