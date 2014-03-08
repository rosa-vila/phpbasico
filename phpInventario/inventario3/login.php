<?php session_start(); 
require_once 'funciones_bd.php'; 

$login = (isset($_REQUEST['login']))?
            $_REQUEST['login']:"";
$password = (isset($_REQUEST['password']))?
            $_REQUEST['password']:"";
//si esiste , se cogen los datos si estan vacios (algun campos) nos devuelve al index (no da mensage de error)
if ($login == "" || $password =="") {
    $url = "index.php";
    header('Location:'.$url);
}
//Se realiza la consulta, se monta la cadena y se cogen los datos.si no hay resultado error si no se carga el registro
$bd = conectaBd();

$consulta = "SELECT * FROM usuario WHERE login = :login and password = :password";
$resultado = $bd->prepare($consulta);
if (!$resultado->execute(array(":login" => $login,":password" => $password))) {
       $url = "error.php?msg_error=Error_Consulta__Login";
       header('Location:'.$url);
} else { 
       $registro = $resultado->fetch(); //coge el primer registrp de la tabla y lo carga
       if(!$registro) {
           $url = "error.php?msg_error=Error_Usuario_Inexistente";
           header('Location:'.$url);
       } else { //Si lo encuentra crea la variable session y nos lleva al listado software
           $_SESSION['usuario'] = $registro[2]; //Coger tercer campo: nombre
           $url = "listado_software.php";
           header('Location:'.$url);
       }
}  
?>
    </body>
</html>




     