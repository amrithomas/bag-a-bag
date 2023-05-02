<!-- ARQUIVO DE TESTES -->
<?php
session_start();
include_once('conexao.php');

// PEGAR AS AERONAVES
$options_avioes_id_aviao = "";
$options_avioes_codigo_aviao = "";
$options_avioes_empresa = "";
$options_avioes_total_assentos = "";

$query = "SELECT * FROM aviao ORDER BY CODIGO_AVIAO ASC";
$consulta = mysqli_query($conn, $query);

while($row_aviao = mysqli_fetch_assoc($consulta)) {
    $options_avioes_id_aviao = $options_avioes_id_aviao . "<option value='" . $row_aviao['ID_AVIAO'] . "'>" . $row_aviao['ID_AVIAO'] . "</option>";
    $options_avioes_codigo_aviao = $options_avioes_codigo_aviao . "<option>" . $row_aviao['CODIGO_AVIAO'] . "</option>";
    $options_avioes_empresa = $options_avioes_empresa . "<option>" . $row_aviao['EMPRESA'] . "</option>";
    $options_avioes_total_assentos = $options_avioes_total_assentos . "<option>" . $row_aviao['TOTAL_ASSENTO'] . "</option>";
}


// PEGAR OS AEROPORTOS
$options_aeroportos_id_aeroporto = "";
$options_aeroportos_nome_aeroporto = "";
$options_aeroportos_sigla = "";
$options_aeroportos_pais = "";
$options_aeroportos_cidade = "";

$query = "SELECT * FROM aeroporto";
$consulta = mysqli_query($conn, $query);

while($row_origem = mysqli_fetch_assoc($consulta)) {
    $options_aeroportos_id_aeroporto = $options_aeroportos_id_aeroporto . "<option value='" . $row_origem['ID_AEROPORTO'] . "'>" . $row_origem['ID_AEROPORTO'] . "</option>";
    $options_aeroportos_nome_aeroporto = $options_aeroportos_nome_aeroporto . "<option>" . $row_origem['SIGLA'] . " - " . $row_origem['NOME_AEROPORTO'] . "</option>";
    $options_aeroportos_sigla = $options_aeroportos_sigla . "<option>" . $row_origem['SIGLA'] . "</option>";
    $options_aeroportos_pais = $options_aeroportos_pais . "<option>" . $row_origem['PAIS'] . "</option>";
    $options_aeroportos_cidade = $options_aeroportos_cidade . "<option>" . $row_origem['CIDADE'] . "</option>";
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Criar Viagem</title>
</head>
<body onload="mudaSelectsAeronave(); mudaSelectsOrigem(); mudaSelectsDestino(); mudaSelectsEscala(); toggleVolta();">
    <form name="voo" action="controller/controller_adicionar_voo.php" method="post">
        <fieldset>
        <legend><h1>Criar Viagem</h1></legend>
            <!-- MENSAGEM DE STATUS DO CADASTRO QUE FOI REALIZADO -->
            <?php
                if(isset($_SESSION["msg"])) {   // isset() verifica se a variavel existe;
                    echo $_SESSION["msg"];
                    unset($_SESSION["msg"]);    // unset() destrói a variável passada como argumento, melhor utilizada em escopo global
                }
            ?>
            <!-- VOO DE IDA -->
            <fieldset id="fieldset_ida"><legend><h2>Voo de Ida</h2></legend>
                <!-- ESCOLHA DE AERONAVE -->
                <fieldset><legend><b>Aeronave</b></legend>
                    <select name="fk_aviao_ida" style="display: none">
                        <option value="">--</option>
                        <?php
                            echo "$options_avioes_id_aviao";
                        ?>
                    </select>

                    <label>Codigo da Aeronave: </label>
                    <select name="codigo_aviao" onchange="mudaSelectsAeronave()" required>
                        <option value="">--</option>
                        <?php
                            echo "$options_avioes_codigo_aviao";
                        ?>
                    </select>

                    <label>Empresa: </label>
                    <select name="empresa" disabled>
                        <option value="">--</option>
                        <?php
                            echo "$options_avioes_empresa";
                        ?>
                    </select>

                    <label>Assentos: </label>
                    <select name="assentos" disabled>
                        <option value="">--</option>
                        <?php
                            echo "$options_avioes_total_assentos";
                        ?>
                    </select>
                </fieldset>
                
                <br>

                <!-- ESCOLHA DE AEROPORTO DE ORIGEM -->
                <fieldset><legend><b>Aeroporto de Origem</b></legend>
                    <select name="fk_origem_aero_ida" style="display: none">
                        <option value="">--</option>
                        <?php
                            echo "$options_aeroportos_id_aeroporto";
                        ?>
                    </select>

                    <label>Nome:</label>
                    <select name="origem_nome_aeroporto" onchange="mudaSelectsOrigem()" required>
                        <option value="">--</option>
                        <?php
                            echo "$options_aeroportos_nome_aeroporto";
                        ?>
                    </select>

                    <label>Sigla: </label>
                    <select name="origem_sigla" disabled>
                        <option value="0">--</option>
                        <?php
                            echo "$options_aeroportos_sigla";
                        ?>
                    </select>

                    <label>País: </label>
                    <select name="origem_pais" disabled>
                        <option value="">--</option>
                        <?php
                            echo "$options_aeroportos_pais";
                        ?>
                    </select>

                    <label>Cidade: </label>
                    <select name="origem_cidade" disabled>
                        <option value="">--</option>
                        <?php
                            echo "$options_aeroportos_cidade";
                        ?>
                    </select>
                    
                    <br>
                    <br>

                    <!-- DEFINIR HORÁRIO DE PARTIDA -->
                    <div>
                        <label>Data de Decolagem:</label>
                        <input type="datetime-local" name="ida_horario_partida" required>
                    </div>
                </fieldset>
                
                <br>

                <!-- CRIAR ESCALA DA IDA -->
                <hr>
                <fieldset><legend><b>Escala</b></legend>
                    <select name="fk_aeroporto_escala_ida" style="display: none">
                        <option value="">--</option>
                        <?php
                            echo "$options_aeroportos_id_aeroporto";
                        ?>
                    </select>
                    
                    <label>Nome:</label>
                    <select name="escala_nome_aeroporto" onchange="mudaSelectsEscala()">
                        <option value="">--</option>
                        <?php
                            echo "$options_aeroportos_nome_aeroporto";
                        ?>
                    </select>

                    <label>Sigla: </label>
                    <select name="escala_sigla" disabled>
                        <option value="0">--</option>
                        <?php
                            echo "$options_aeroportos_sigla";
                        ?>
                    </select>

                    <label>País: </label>
                    <select name="escala_pais" disabled>
                        <option value="">--</option>
                        <?php
                            echo "$options_aeroportos_pais";
                        ?>
                    </select>

                    <label>Cidade: </label>
                    <select name="escala_cidade" disabled>
                        <option value="">--</option>
                        <?php
                            echo "$options_aeroportos_cidade";
                        ?>
                    </select>

                    <br>
                    <br>

                    <!-- DEFINIR HORÁRIO DE CHEGADA NA ESCALA -->
                    <div>
                        <label>Data de Pouso:</label>
                        <input type="datetime-local" name="horario_chegada_escala_ida">
                    </div>

                    <br>

                    <!-- DEFINIR DURAÇÂO DA ESCALA  -->
                    <div>
                        <label>Duração da Escala:</label>
                        <input type="time" name="tempo_escala_ida" step="1">
                    </div>

                    <br>

                    <button type="button" onclick="limparEscala(0)">Limpar Escala</button>
                </fieldset>
                <br>
                <hr>

                <!-- ESCOLHA DE AEROPORTO DE DESTINO -->
                <fieldset><legend><b>Aeroporto de Destino</b></legend>
                    <select name="fk_destino_aero_ida" style="display: none">
                        <option value="">--</option>
                        <?php
                            echo "$options_aeroportos_id_aeroporto";
                        ?>
                    </select>

                    <label>Nome:</label>
                    <select name="destino_nome_aeroporto" onchange="mudaSelectsDestino()" required>
                        <option value="">--</option>
                        <?php
                            echo "$options_aeroportos_nome_aeroporto";
                        ?>
                    </select>

                    <label>Sigla: </label>
                    <select name="destino_sigla" disabled>
                        <option value="0">--</option>
                        <?php
                            echo "$options_aeroportos_sigla";
                        ?>
                    </select>
                    <label>País: </label>
                    <select name="destino_pais" disabled>
                        <option value="">--</option>
                        <?php
                            echo "$options_aeroportos_pais";
                        ?>
                    </select>
                    <label>Cidade: </label>
                    <select name="destino_cidade" disabled>
                        <option value="">--</option>
                        <?php
                            echo "$options_aeroportos_cidade";
                        ?>
                    </select>

                    <br>
                    <br>
                
                    <!-- DEFINIR HORÁRIO DE CHEGADA -->
                    <div>
                        <label>Data de Pouso:</label>
                        <input type="datetime-local" name="ida_horario_chegada" required>
                    </div>
                </fieldset>
            </fieldset>
            <br>    
            <hr>
            
            <label><input type="checkbox" name="tipo" id="tipo" onclick="toggleVolta()" value="1">Viagem de ida e volta</label>

            <!-- VOO DE VOLTA -->
            <fieldset id="fieldset_volta"><legend><h2>Voo de volta</h2></legend>
                <!-- ESCOLHA DE AERONAVE -->
                <fieldset><legend><b>Aeronave</b></legend>
                    <select name="fk_aviao_volta" style="display: none">
                        <option value="">--</option>
                        <?php
                            echo "$options_avioes_id_aviao";
                        ?>
                    </select>

                    <label>Codigo da Aeronave: </label>
                    <select name="codigo_aviao" onchange="mudaSelectsAeronave()" >
                        <option value="">--</option>
                        <?php
                            echo "$options_avioes_codigo_aviao";
                        ?>
                    </select>

                    <label>Empresa: </label>
                    <select name="empresa" disabled>
                        <option value="">--</option>
                        <?php
                            echo "$options_avioes_empresa";
                        ?>
                    </select>

                    <label>Assentos: </label>
                    <select name="assentos" disabled>
                        <option value="">--</option>
                        <?php
                            echo "$options_avioes_total_assentos";
                        ?>
                    </select>
                </fieldset>
                
                <br>

                <!-- ESCOLHA DE AEROPORTO DE ORIGEM -->
                <fieldset><legend><b>Aeroporto de Origem</b></legend>
                    <select name="fk_origem_aero_volta" style="display: none">
                        <option value="">--</option>
                        <?php
                            echo "$options_aeroportos_id_aeroporto";
                        ?>
                    </select>

                    <label>Nome:</label>
                    <select name="origem_nome_aeroporto" disabled>
                        <option value="">--</option>
                        <?php
                            echo "$options_aeroportos_nome_aeroporto";
                        ?>
                    </select>

                    <label>Sigla: </label>
                    <select name="origem_sigla" disabled>
                        <option value="0">--</option>
                        <?php
                            echo "$options_aeroportos_sigla";
                        ?>
                    </select>

                    <label>País: </label>
                    <select name="origem_pais" disabled>
                        <option value="">--</option>
                        <?php
                            echo "$options_aeroportos_pais";
                        ?>
                    </select>

                    <label>Cidade: </label>
                    <select name="origem_cidade" disabled>
                        <option value="">--</option>
                        <?php
                            echo "$options_aeroportos_cidade";
                        ?>
                    </select>
                    
                    <br>
                    <br>

                    <!-- DEFINIR HORÁRIO DE PARTIDA -->
                    <div>
                        <label>Data de Decolagem:</label>
                        <input type="datetime-local" name="volta_horario_partida" >
                    </div>
                </fieldset>
                
                <br>

                <!-- CRIAR ESCALA DA VOLTA -->
                <hr>
                <fieldset><legend><b>Escala</b></legend>
                    <select name="fk_aeroporto_escala_volta" style="display: none">
                        <option value="">--</option>
                        <?php
                            echo "$options_aeroportos_id_aeroporto";
                        ?>
                    </select>
                    
                    <label>Nome:</label>
                    <select name="escala_nome_aeroporto" onchange="mudaSelectsEscala()">
                        <option value="">--</option>
                        <?php
                            echo "$options_aeroportos_nome_aeroporto";
                        ?>
                    </select>

                    <label>Sigla: </label>
                    <select name="escala_sigla" disabled>
                        <option value="0">--</option>
                        <?php
                            echo "$options_aeroportos_sigla";
                        ?>
                    </select>

                    <label>País: </label>
                    <select name="escala_pais" disabled>
                        <option value="">--</option>
                        <?php
                            echo "$options_aeroportos_pais";
                        ?>
                    </select>

                    <label>Cidade: </label>
                    <select name="escala_cidade" disabled>
                        <option value="">--</option>
                        <?php
                            echo "$options_aeroportos_cidade";
                        ?>
                    </select>

                    <br>
                    <br>

                    <!-- DEFINIR HORÁRIO DE CHEGADA NA ESCALA -->
                    <div>
                        <label>Data de Pouso:</label>
                        <input type="datetime-local" name="horario_chegada_escala_volta" >
                    </div>

                    <br>

                    <!-- DEFINIR DURAÇÂO DA ESCALA  -->
                    <div>
                        <label>Duração da Escala:</label>
                        <input type="time" name="tempo_escala_volta" step="1">
                    </div>

                    <br>

                    <button type="button" onclick="limparEscala(1)">Limpar Escala</button>
                </fieldset>
                <br>
                <hr>

                <!-- ESCOLHA DE AEROPORTO DE DESTINO -->
                <fieldset><legend><b>Aeroporto de Destino</b></legend>
                    <select name="fk_destino_aero_volta" style="display: none">
                        <option value="">--</option>
                        <?php
                            echo "$options_aeroportos_id_aeroporto";
                        ?>
                    </select>

                    <label>Nome:</label>
                    <select name="destino_nome_aeroporto" disabled>
                        <option value="">--</option>
                        <?php
                            echo "$options_aeroportos_nome_aeroporto";
                        ?>
                    </select>

                    <label>Sigla: </label>
                    <select name="destino_sigla" disabled>
                        <option value="0">--</option>
                        <?php
                            echo "$options_aeroportos_sigla";
                        ?>
                    </select>
                    
                    <label>País: </label>
                    <select name="destino_pais" disabled>
                        <option value="">--</option>
                        <?php
                            echo "$options_aeroportos_pais";
                        ?>
                    </select>

                    <label>Cidade: </label>
                    <select name="destino_cidade" disabled>
                        <option value="">--</option>
                        <?php
                            echo "$options_aeroportos_cidade";
                        ?>
                    </select>

                    <br>
                    <br>
                
                    <!-- DEFINIR HORÁRIO DE CHEGADA -->
                    <div>
                        <label>Data de Pouso:</label>
                        <input type="datetime-local" name="volta_horario_chegada" >
                    </div>
                </fieldset>

                <br>
                <button type="button" onclick="limparVolta()">Limpar Voo de Volta</button>
                
                <br>
            </fieldset>

            <!-- DEFINIR VALOR DAS PASSAGENS -->
            <div>
                <h3>Valor da Passagem</h3>
                <input type="text" name="valor_passagem" id="valor_passagem" oninput="formatarValor()" required>
            </div>
                
            <br>

            <input type="submit" value="Salvar">
            <input type="reset" value="Limpar Tudo">
    </fieldset>
    </form>

    
    <script>
        function formatarValor() {
            var inputValor = document.getElementById('valor_passagem');
            var valor = inputValor.value.replace(/\D+/g, ''); // Remove caracteres não numéricos
            var valorFormatado = (Number(valor) / 100).toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });
            inputValor.value = valorFormatado;
        }
        
        let form = document.forms['voo'];

        
        function limparEscala(i) {
            form.escala_nome_aeroporto[i].options.selectedIndex = 0;
            mudaSelectsEscala();

            if (i == 0) {
                form.horario_chegada_escala_ida.value = "";  
                form.tempo_escala_ida.value = "";  
            } else {
                form.horario_chegada_escala_volta.value = "";  
                form.tempo_escala_volta.value = "";  
            }

        }

        function toggleVolta() {
            let toggle = document.getElementById("tipo");
            let fieldsetVolta = document.getElementById("fieldset_volta");

            let aviaoVolta= form.codigo_aviao[1].options;
            let horarioPartidaVolta = form.volta_horario_partida;
            let horarioChegadaVolta = form.volta_horario_chegada;
            
            if (toggle.checked) {
                fieldsetVolta.style.display = "block";
                mudaSelectsOrigem();
                mudaSelectsDestino();
                mudaSelectsEscala();
                
                form.codigo_aviao[1].setAttribute("required", "");
                form.volta_horario_partida.setAttribute("required", "");
                form.volta_horario_chegada.setAttribute("required", "");
                
            } else {
                fieldsetVolta.style.display = "none";
                aviaoVolta.selectedIndex = 0;
                horarioPartidaVolta.value = "";
                horarioChegadaVolta.value = "";
                limparEscala(1)
                mudaSelectsAeronave();
                
                form.codigo_aviao[1].removeAttribute("required");
                form.volta_horario_partida.removeAttribute("required");
                form.volta_horario_chegada.removeAttribute("required");
            }
        }

        function limparVolta() {
            // função para limpar os inputs da volta
            limparEscala(1)
        }

        function mudaSelectsAeronave() {
            let selectID = form.fk_aviao_ida.options;
            let selectCodaviao = form.codigo_aviao[0].options;
            let selectEmpresa = form.empresa[0].options;
            let selectAssento = form.assentos[0].options;
            
            let opcao = selectCodaviao.selectedIndex;

            selectID.selectedIndex = opcao;
            selectEmpresa.selectedIndex = opcao;
            selectAssento.selectedIndex = opcao;
            
            selectID = form.fk_aviao_volta.options;
            selectCodaviao = form.codigo_aviao[1].options;
            selectEmpresa = form.empresa[1].options;
            selectAssento = form.assentos[1].options;
            
            opcao = selectCodaviao.selectedIndex;

            selectID.selectedIndex = opcao;
            selectEmpresa.selectedIndex = opcao;
            selectAssento.selectedIndex = opcao;
        }

        function mudaSelectsOrigem() {
            let selectID = form.fk_origem_aero_ida.options;
            let selectNome = form.origem_nome_aeroporto[0].options;
            let selectSigla = form.origem_sigla[0].options;
            let selectPais = form.origem_pais[0].options;
            let selectCidade = form.origem_cidade[0].options;
            
            let selectID_x = form.fk_destino_aero_volta.options;
            let selectNome_x = form.destino_nome_aeroporto[1].options;
            let selectSigla_x = form.destino_sigla[1].options;
            let selectPais_x = form.destino_pais[1].options;
            let selectCidade_x = form.destino_cidade[1].options;
            
            let opcao = selectNome.selectedIndex;

            selectID.selectedIndex =  opcao;
            selectNome.selectedIndex = opcao;
            selectSigla.selectedIndex = opcao;
            selectPais.selectedIndex = opcao;
            selectCidade.selectedIndex =  opcao;

            selectID_x.selectedIndex = opcao;
            selectNome_x.selectedIndex = opcao;
            selectSigla_x.selectedIndex = opcao;
            selectPais_x.selectedIndex = opcao;
            selectCidade_x.selectedIndex = opcao;
        }
    
        function mudaSelectsDestino() {
            let selectID = form.fk_destino_aero_ida.options;
            let selectNome = form.destino_nome_aeroporto[0].options;
            let selectSigla = form.destino_sigla[0].options;
            let selectPais = form.destino_pais[0].options;
            let selectCidade = form.destino_cidade[0].options;
            
            let selectID_x = form.fk_origem_aero_volta.options;
            let selectNome_x = form.origem_nome_aeroporto[1].options;
            let selectSigla_x = form.origem_sigla[1].options;
            let selectPais_x = form.origem_pais[1].options;
            let selectCidade_x = form.origem_cidade[1].options;
            
            let opcao = selectNome.selectedIndex;

            selectID.selectedIndex =  opcao;
            selectNome.selectedIndex = opcao;
            selectSigla.selectedIndex = opcao;
            selectPais.selectedIndex = opcao;
            selectCidade.selectedIndex =  opcao;

            selectID_x.selectedIndex = opcao;
            selectNome_x.selectedIndex = opcao;
            selectSigla_x.selectedIndex = opcao;
            selectPais_x.selectedIndex = opcao;
            selectCidade_x.selectedIndex = opcao;
        }

        function mudaSelectsEscala() {
            let selectEscalaAeroID = form.fk_aeroporto_escala_ida.options;
            let selectEscalaNomeAero = form.escala_nome_aeroporto[0].options;
            let selectEscalaSigla = form.escala_sigla[0].options;
            let selectEscalaPais = form.escala_pais[0].options;
            let selectEscalaCidade = form.escala_cidade[0].options;
            
            let opcao = selectEscalaNomeAero.selectedIndex;

            selectEscalaAeroID.selectedIndex = opcao;
            selectEscalaSigla.selectedIndex = opcao;
            selectEscalaPais.selectedIndex = opcao;
            selectEscalaCidade.selectedIndex =  opcao;

            selectEscalaAeroID = form.fk_aeroporto_escala_volta.options;
            selectEscalaNomeAero = form.escala_nome_aeroporto[1].options;
            selectEscalaSigla = form.escala_sigla[1].options;
            selectEscalaPais = form.escala_pais[1].options;
            selectEscalaCidade = form.escala_cidade[1].options;

            opcao = selectEscalaNomeAero.selectedIndex;

            selectEscalaAeroID.selectedIndex = opcao;
            selectEscalaSigla.selectedIndex = opcao;
            selectEscalaPais.selectedIndex = opcao;
            selectEscalaCidade.selectedIndex =  opcao;
        }
    </script>
</body>
</html>
