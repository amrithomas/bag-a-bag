<!-- ARQUIVO DE TESTES -->
<?php
session_start();
include_once('conexao.php');

// PEGAR AS AERONAVES
$options_avioes_id_codaviao = "";
$options_avioes_codigo_aviao = "";
$options_avioes_empresa = "";
$options_avioes_total_assentos = "";

$query = "SELECT * FROM aviao_codaviao";
$consulta = mysqli_query($conn, $query);

while($row_aviao = mysqli_fetch_assoc($consulta)) {
    $options_avioes_id_codaviao = $options_avioes_id_codaviao . "<option value='" . $row_aviao['ID_CODAVIAO'] . "'>" . $row_aviao['ID_CODAVIAO'] . "</option>";
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
    $options_aeroportos_nome_aeroporto = $options_aeroportos_nome_aeroporto . "<option>" . $row_origem['NOME_AEROPORTO'] . "</option>";
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
    <title>CRUD - Criar Voo</title>
</head>
<body>
    <h1>Criar Voo</h1>

    <!-- MENSAGEM DE STATUS DO CADASTRO QUE FOI REALIZADO -->
    <?php
        if(isset($_SESSION["msg"])) {   // isset() verifica se a variavel existe;
            echo $_SESSION["msg"];
            unset($_SESSION["msg"]);    // unset() destrói a variável passada como argumento, melhor utilizada em escopo global
        }
    ?>
    
    <form name="voo" action="controller/controller_adicionar_voo.php" method="post">
        <!-- ESCOLHA DE AERONAVE -->
        <div>
            <h3>Aeronave</h3>
            <select name="fk_aviao" style="display: none">
                <option value="">--</option>
                <?php
                    echo "$options_avioes_id_codaviao";
                ?>
            </select>
            <label>Codigo da Aeronave: </label>
            <select name="codigo_aviao" onchange="mudaSelectsAeronave()">
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
        </div>

        <br>

        <!-- ESCOLHA DE AEROPORTO DE ORIGEM -->
        <div>
            <h3>Aeroporto de Origem</h3>

            <select name="fk_origem_aero" style="display: none">
                <option value="">--</option>
                <?php
                    echo "$options_aeroportos_id_aeroporto";
                ?>
            </select>

            <label>Origem: </label>
            <select name="origem_nome_aeroporto" onchange="mudaSelectsOrigem()">
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
        </div>
        
        <br>

        <!-- ESCOLHA DE AEROPORTO DE DESTINO -->
        <div>
            <h3>Aeroporto de Destino</h3>

            <select name="fk_destino_aero" style="display: none">
                <option value="">--</option>
                <?php
                    echo "$options_aeroportos_id_aeroporto";
                ?>
            </select>

            <label>Destino: </label>
            <select name="destino_nome_aeroporto" onchange="mudaSelectsDestino()">
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
        </div>
        
        <br>
        
        <!-- ESCOLHA DE DATA E HORARIO DE PARTIDA-->
        <div>
            <h3>Decolagem</h3>
            <input type="datetime-local" name="horario_partida">
        </div>

        <br>
        
        <!-- ESCOLHA DE DATA E HORARIO DE CHEGADA-->
        <div>
            <h3>Pouso</h3>
            <input type="datetime-local" name="horario_chegada">
        </div>

        <br>

        <!-- ESCOLHA DE ESCALA -->
        <hr>
        <div>
            <h2>Escala</h2>
            <select name="fk_aeroporto_escala" style="display: none">
                <option value="">--</option>
                <?php
                    echo "$options_aeroportos_id_aeroporto";
                ?>
            </select>

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

            <h3>Pouso</h3>
            <input type="datetime-local" name="horario_chegada_escala">

            <h3>Duração da Escala</h3>
            <input type="time" name="tempo_escala" step="1">
        </div>

        <br>

        <!-- DEFINIR VALOR DAS PASSAGENS PARA ADULTOS -->
        <hr>
        <div>
            <h3>Valor da Passagem</h3>
            <input type="text" name="valor_passagem" id="valor_passagem" oninput="formatarValor()">
            
        </div>


        <br>

        <input type="submit" value="Salvar">
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

        function mudaSelectsAeronave() {
            let selectID = form.fk_aviao.options;
            let selectCodaviao = form.codigo_aviao.options;
            let selectEmpresa = form.empresa.options;
            let selectAssento = form.assentos.options;
            
            let opcao = selectCodaviao.selectedIndex;

            selectID.selectedIndex = opcao;
            selectEmpresa.selectedIndex = opcao;
            selectAssento.selectedIndex = opcao;
        }

        function mudaSelectsOrigem() {
            let selectID = form.fk_origem_aero.options;
            let selectNome = form.origem_nome_aeroporto.options;
            let selectSigla = form.origem_sigla.options;
            let selectPais = form.origem_pais.options;
            let selectCidade = form.origem_cidade.options;
            
            let opcao = selectNome.selectedIndex;

            selectID.selectedIndex =  opcao;
            selectNome.selectedIndex = opcao;
            selectSigla.selectedIndex = opcao;
            selectPais.selectedIndex = opcao;
            selectCidade.selectedIndex =  opcao;
        }
    
        function mudaSelectsDestino() {
            let selectID = form.fk_destino_aero.options;
            let selectNome = form.destino_nome_aeroporto.options;
            let selectSigla = form.destino_sigla.options;
            let selectPais = form.destino_pais.options;
            let selectCidade = form.destino_cidade.options;
            
            let opcao = selectNome.selectedIndex;

            selectID.selectedIndex =  opcao;
            selectNome.selectedIndex = opcao;
            selectSigla.selectedIndex = opcao;
            selectPais.selectedIndex = opcao;
            selectCidade.selectedIndex =  opcao;
        }

        function mudaSelectsEscala() {
            let selectEscalaAeroID = form.fk_aeroporto_escala.options;
            let selectEscalaNomeAero = form.escala_nome_aeroporto.options;
            let selectEscalaSigla = form.escala_sigla.options;
            let selectEscalaPais = form.escala_pais.options;
            let selectEscalaCidade = form.escala_cidade.options;
            
            let opcao = selectEscalaNomeAero.selectedIndex;

            selectEscalaAeroID.selectedIndex =opcao;
            selectEscalaSigla.selectedIndex = opcao;
            selectEscalaPais.selectedIndex = opcao;
            selectEscalaCidade.selectedIndex =  opcao;
        }

        

        function mudaSelectAlternado() {
        // criar uma função que altere a option do destino se a da origem for a mesma (ou fazer no back end)
        }
    </script>
</body>
</html>
