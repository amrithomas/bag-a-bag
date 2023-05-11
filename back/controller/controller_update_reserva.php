<?php
    session_start();
    include_once('../conexao.php');
    $id = $_SESSION['id_usuario'];
    $reserva = $_POST['id_reserva'];

    $result_usuario = "UPDATE reserva SET STATUS_RESERVA = 'Cancelada'  WHERE ID_RESERVA = '$reserva'";
    $resultado_usuario = mysqli_query($conn, $result_usuario);
    echo "<script>location.href='../../pages/user.php?id=$id';</script>";
    
?>