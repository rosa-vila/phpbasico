<?php
session_start(); //para poder usar variables de sesión.
require_once 'funciones_bd.php';
require_once 'funciones_validar.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function validarDatosRegistro (){
    // Recuperar datos enviados desde "formulario_nuevo_equipo.php"
    $datos = Array();
    $datos[0] = (isset ($_REQUEST['nombre']))? $_REQUEST['nombre']:"";
    $datos[1] = (isset ($_REQUEST['desc']))? $_REQUEST['desc']:"";
    $datos[2] = (isset ($_REQUEST['ip']))? $_REQUEST['ip']:"";
    $datos[3] = (isset ($_REQUEST['ram']))? $_REQUEST['ram']:"";
 
    //................Validar...............
    $errores = Array();//$errores es un array de flag, de true y false
    $errores[0] = !validarNombre($datos[0]);
    $errores[1] = !validarDesc($datos[1]);
    $errores[2] = !validarIP($datos[2]);
    $errores[3] = !validarRam($datos[3]);
    
    //.....Asignar a variables de sesión.
    $_SESSION['datos'] = $datos; //datos introducidos
    $_SESSION['errores'] = $errores;//errores concretos que hay
    $_SESSION['hayErrores'] = ($errores[0]||$errores[1]||$errores[2]||$errores[3]);//Nos dice que errores hay
    

}
//(hay 2 tipos de errores: de validacion y de bases de datos y en funcion de estos nos llevara a un sitio o a otro)
//function grabarEquipo(){
  //  print_r($_SESSION['datos']);
    //print_r($_SESSION['errores']);}


    //PRINCIPAL
validarDatosRegistro();
if ($_SESSION['hayErrores']) {
    $url = "formulario_nuevo_equipo.php";
    header('Location:'.$url);
} else {
    $db = conectaBd();
    $consulta = "INSERT INTO Equipo (nombre, descripcion, ip, ram)
    VALUES ('"
           .$_SESSION['datos'][0]."', '"
           .$_SESSION['datos'][1]."', '"
           .$_SESSION['datos'][2]."', " 
           .$_SESSION['datos'][3].")";
    //print_r($consulta);
    if ($db->query($consulta)) {
           $url = "grabacion_ok.php";
           header('Location:'.$url);
    } else {
            $url = "error.php?msg_error=Error_BD";
            header('Location:'.$url);
    }
    $db = null;
}

?>