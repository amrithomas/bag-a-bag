<?php 
    session_start();
    unset($_SESSION['id_adm']);
    echo "<script>location.href='../admin/login.php';</script>";
?>