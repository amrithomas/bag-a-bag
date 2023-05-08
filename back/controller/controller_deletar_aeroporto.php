<?php 
session_start();
include_once("../conexao.php");


try {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    if(!empty($id)) {
        $query = "DELETE FROM aeroporto WHERE ID_AEROPORTO = '$id'";
        $query = mysqli_query($conn, $query);

        if(mysqli_affected_rows($conn)) {
            $_SESSION['msg'] = "<p style='color: green;' class='text-center'>AEROPORTO DELETADO COM SUCESSO</p>";
            echo "<script>location.href='../admin/aeroporto.php'</script>";
        } else {
            $_SESSION['msg'] = "<p style='color: red;' class='text-center'>ERRO! AEROPORTO NÃO FOI DELETADO</p>";
            echo "<script>location.href='../admin/aeroporto.php'</script>";
        }
    }
} catch (\Exception $e) {
    $_SESSION['msg'] = "$e";
    echo "<script>location.href='../admin/aeroporto.php'</script>";
}
?>