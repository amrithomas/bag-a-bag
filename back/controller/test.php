<!-- ARQUIVO SOMENTE PARA TESTES -->
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
    <form action="controller_passageiro.php" method="POST">
        <!-- input para o id do usurário associado ao passageiro -->
        <input type="hidden" name="id_usuario" value="1">

        <label for="">nome</label>
        <input type="text" name="nome" id="">

        <label for="">sobrenome</label>
        <input type="text" name="sobrenome" id="">

        <label for="">email</label>
        <input type="email" name="email" id="">

        <label for="">cpf</label>
        <input type="text" name="cpf" id="" maxlength="11">

        <label for="">data nascimento</label>
        <input type="date" name="data_nascimento" id="">

        <label for="">ddd</label>
        <input type="text" name="ddd" id="">

        <label for="">numero</label>
        <input type="text" name="numero" id="" maxlength="9">

        <input type="submit" value="Enviar">
    </form>
</body>
</html>
