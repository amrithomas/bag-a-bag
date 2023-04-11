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
    <form action="controller_cadastro.php" method="post">
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
            placeholder="Digite o seu nome do meio"
            autofocus required
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
            type="text"
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

        <label>Telefone: </label>
        <input
            type="text"
            name="telefone"
            id="telefone"
            placeholder="(XX) XXXXX-XXXX"
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