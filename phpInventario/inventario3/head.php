<?php
session_start();
if (!isset($_SESSION['usuario'])){
       $url = "error.php?msg_error=Requiere__Login";
       header('Location:'.$url);   
}
echo"<div>";
echo "Usuario=".$_SESSION['usuario'];//que se vea el usuario logueado
echo"</div>";
echo"<div>";
echo"<a href=logout.php>Logout</a>";
echo"</div>";
?>

