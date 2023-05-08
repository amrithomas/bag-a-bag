<!-- ARQUIVO PARA TESTES -->
<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Avião</title>
</head>
<body>
    <h1>Cadastrar Avião</h1>
    <!-- MENSAGEM DE STATUS DO CADASTRO QUE FOI REALIZADO -->
    <?php
        if(isset($_SESSION["msg"])) {   // isset() verifica se a variavel existe;
            echo $_SESSION["msg"];
            unset($_SESSION["msg"]);    // unset() destrói a variável passada como argumento, melhor utilizada em escopo global
        }
    ?>
    
    <form action="controller/controller_adicionar_aviao.php" method="post">
        <label>Código da Aeronave: </label>
        <input
            type="text"
            name="codaviao"
            autofocus required
            maxlength="7"
        ><br><br>

        <label>Empresa: </label>
        <input
            type="text"
            name="empresa"
            autofocus required
        ><br><br>

        <input type="submit" value="Salvar">
    </form>
</body>
</html>
