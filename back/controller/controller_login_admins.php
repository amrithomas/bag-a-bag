<?php 
    session_start();
    include_once('../conexao.php');

    $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

    // Procura email e senha entre os superadmins
    $query = "SELECT * FROM super_admin WHERE email_sadm='$email' AND senha_sadm='" . md5($senha) . "'";
    $query_consulta = mysqli_query($conn, $query);
    $consulta = mysqli_fetch_assoc($query_consulta);

    if (!empty($consulta)){
        $_SESSION['msg'] = "<p style='color:#70D44B;'><b>Conectado como superadmin: '". $consulta['NOME_SADM'] ."'</b></p>";
        $_SESSION['security'] = true;
        header("Location: ../login.php");
    }
    // Procura email e senha entre os admins
    else {
        $query = "SELECT * FROM admin WHERE email_adm='$email' AND senha_adm='" . md5($senha). "'";
        $query_consulta = mysqli_query($conn, $query);
        $consulta = mysqli_fetch_assoc($query_consulta);
    
        if (!empty($consulta)){
            $_SESSION['msg'] = "<p style='color:#70D44B;'><b>Conectado como admin: '". $consulta['NOME_ADM'] ."'</b></p>";
            $_SESSION['security'] = true;
            header("Location: ../login.php");
        } else {
            $_SESSION['msg'] = "<p style='color:red;'>Falha no login. Insira seus dados novamente </p>";
            header("Location: ../login.php");
        }
    }
?>
