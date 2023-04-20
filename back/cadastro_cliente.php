<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Cadastrar</title>
    <!-- script para utilizar o viacep -->
    <script>
    
    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
            
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
            
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";
                

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };

    </script>

</head>
<body>
    <h1>Cadastrar</h1>

    <!-- MENSAGEM DE STATUS DO CADASTRO QUE FOI REALIZADO -->
    <?php
        if(isset($_SESSION["msg"])) {   // isset() verifica se a variavel existe;
            echo $_SESSION["msg"];
            unset($_SESSION["msg"]);    // unset() destrói a variável passada como argumento, melhor utilizada em escopo global
        }
    ?>
    
    <form action="controller/controller_cadastro.php" method="post">
        <label>Nome: </label>
        <input
            type="text"
            name="nome"
            id="nome"
            placeholder="Digite o seu nome"
            autofocus required
        ><br><br>

        <label>Nome do Meio: </label>
        <input
            type="text"
            name="nome_meio"
            id="nome_meio"
            placeholder="Digite o seu nome do meio (opicional)"
            autofocus
        ><br><br>
        
        <label>Sobrenome: </label>
        <input
            type="text"
            name="sobrenome"
            id="sobrenome"
            placeholder="Digite o seu sobrenome"
            autofocus required
        ><br><br>

        <label>CPF: </label>
        <input
            type="text"
            name="cpf"
            id="cpf"
            placeholder="Digite o seu CPF"
            autofocus required
        ><br><br>
        
        <label>RG: </label>
        <input
            type="text"
            name="rg"
            id="rg"
            placeholder="Digite o seu rg"
            autofocus required
        ><br><br>


        
        <label>Data de Nascimento: </label>
        <input
            type="date"
            name="data_nasc"
            id="data_nasc"
            placeholder="Digite a sua data de nascimento"
            autofocus required
        ><br><br>

        <label>Pais: </label>
        <input
            type="number"
            name="pais"
            id="pais"
            placeholder="Digite a sua data de nascimento"
            value= 55
            autofocus required
            disabled
        ><br><br>

        <label>DDD: </label>
        <input
            type="tel"
            name="ddd"
            id="ddd"
            placeholder="(XX)"
            maxlength="9"
            autofocus required
        ><br><br>

        <label>Telefone: </label>
        <input
            type="tel"
            name="telefone"
            id="telefone"
            placeholder="XXXXXXXXX"
            maxlength="9"
            autofocus required
        ><br><br>

        <label>E-mail: </label>
        <input
            type="email"
            name="email"
            id="email"
            placeholder="Digite o seu melhor email"
            required
        ><br><br>

        <label>CEP:</label>
        <input type="text" name="cep" id="cep" placeholder="digite o CEP" maxlength="8" autofocus required onblur="pesquisacep(this.value);"><br><br>

        <label>Rua:</label>
        <input type="text" name="rua" id="rua" placeholder="digite a rua" autofocus required><br><br>

        <label>Número:</label>
        <input type="text" name="numero" id="numero" placeholder="digite o número" autofocus required><br><br>

        <label>Bairro:</label>
        <input type="text" name="bairro" id="bairro" placeholder="digite o bairro" autofocus required><br><br>

        <label>Cidade:</label>
        <input type="text" name="cidade" id="cidade" placeholder="digite a cidade" autofocus required><br><br>

        <label>UF:</label>
        <input type="text" name="uf" id="uf" placeholder="digite a UF" maxlength="2" autofocus required><br><br>

        <label>Complemento:</label>
        <input type="text" name="complemento" id="complemento" placeholder="Complemento" autofocus ><br><br>

        <label>Senha: </label>
        <input
            type="password"
            name="senha"
            id="senha"
            placeholder="Digite sua melhor senha"
            autofocus
            required
        ><br><br>
        
        <label>Confirmar senha: </label>
        <input
            type="text"
            name="confirmar"
            id="confirmar"
            placeholder="Digite o seu nome do meio"
            autofocus required
        ><br><br>

        <input type="submit" value="Salvar">
    </form>
    
    <br>
</body>
</html>