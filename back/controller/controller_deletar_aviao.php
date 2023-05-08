<?php 
session_start();
include_once("../conexao.php");


try {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    if(!empty($id)) {
        $str_query = "DELETE FROM assentos WHERE FK_AVIAO='$id'";
        $query = mysqli_query($conn, $str_query);
        
        if(mysqli_affected_rows($conn)) {
            $str_query = "DELETE FROM aviao WHERE ID_AVIAO = '$id'";
            $query = mysqli_query($conn, $str_query);

            if(mysqli_affected_rows($conn)) {
                $_SESSION['msg'] = "<p style='color: green;' class='text-center'>AVIAO DELETADO COM SUCESSO</p>";
                echo "<script>location.href='../admin/aviao.php'</script>";
            } else {
                $_SESSION['msg'] = "<p style='color: red;' class='text-center'>ERRO! AVIAO NÃO FOI DELETADO</p>";
                echo "<script>location.href='../admin/aviao.php'</script>";
            }
        } else {
            $_SESSION['msg'] = "<p style='color: green;' class='text-center'>ERRO! AVIAO NÃO FOI DELETADO</p>";
            echo "<script>location.href='../admin/aviao.php'</script>";
        }
    }
} catch (\Exception $e) {
    $_SESSION['msg'] = "$e";
    echo "<script>location.href='../admin/aviao.php'</script>";
}
?>