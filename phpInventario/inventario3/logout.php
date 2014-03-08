<?php 
    session_start(); 
    $_SESSION['usuario'] = null;//para eliminar objetos no es necesario
    unset($_SESSION['usuario']);
    $url = "index.php";
    header("Location:".$url);
?>


