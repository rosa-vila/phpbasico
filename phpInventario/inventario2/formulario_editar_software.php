<?php
session_start();
require_once 'funciones.php';
require_once 'funciones_bd.php';
    //Estructura:campos del formulario
$_SESSION['datos'] = (isset($_SESSION['datos']))?
            $_SESSION['datos']:Array('','','','');
$_SESSION['errores'] = (isset($_SESSION['errores']))?
            $_SESSION['errores']:Array(FALSE,FALSE,FALSE,FALSE);
$_SESSION['hayErrores'] = (isset($_SESSION['hayErrores']))?
            $_SESSION['hayErrores']:FALSE;
      //En vez de partir de vacio, partimos de datos existentes-
     //vamos a leer de la base de datos el id que nos lle -si todo va bien lo cargamos si no nos vamos a un error
/**
 * Cargar de la base de datos
 */

$_SESSION['id'] = (isset($_REQUEST['id']))?
            $_REQUEST['id']:$_SESSION['id'];

//selecciono de software el registro con ese id, si falla el conectaBb da un error si no pasa al select
//Si no hay error carga fech, el registro , el array con los datos. El registro puede estar vacio y sale un error o que tenga datos y nos los muestre.
$bd = conectaBd();
$consulta = "SELECT * FROM software WHERE id=".$_SESSION['id'];
$resultado = $bd->query($consulta);

if (!$resultado) {
       $url = "error.php?msg_error=Error_Consulta_Editar"; //fallo de sintaxis en query.
       header('Location:'.$url);
} else { 
       $registro = $resultado->fetch(); 
       if(!$registro) {
           $url = "error.php?msg_error=Error_Registro_Software_inexistente";
           header('Location:'.$url);
       } else {
           $_SESSION['datos'][0] = $registro['titulo'];
           $_SESSION['datos'][1] = $registro['url'];
       }
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
        <div>TODO write content</div>
        <form action="grabar_nuevo_software.php" method="GET">
            <p>Titulo: <input type="text" name="titulo" 
                              value="<?php echo $_SESSION['datos'][0]; ?>"/></p>
            <?php
                if ($_SESSION['errores'][0]) {
                    echo "<div class 'error'>".MSG_ERR_TITULO."</div>";
                }
            ?>
            <p>URL: <input type="text" name="url"
                           value="<?php echo $_SESSION['datos'][1]; ?>"/></p>
             <?php
                if ($_SESSION['errores'][1]) {
                    echo "<div class 'error'>".MSG_ERR_URL."</div>";
                }
            ?>
            <p><input type="submit" value="Enviar" /></p>
        </form>
    </body>
</html>