<!-- ARQUIVO SOMENTE PARA TESTES -->

<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
    <form action="controller/controller_login.php" method="post">
        <label for="email">Email</label>
        <input type="email" name="email">

        <label for="senha">Senha</label>
        <input type="password" name="senha">
        
        <input type="submit" value="Enviar">
    </form>
</body>
</html>
