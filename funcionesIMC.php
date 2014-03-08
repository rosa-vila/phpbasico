<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Definición de Constantes
 */
define('PESO_MIN', 1);//Kgs
define('PESO_MAX', 500);//Kgs

define('ESTATURA_MIN', 50);//cms
define('ESTATURA_MAX', 300);//cms

define ('MSG_ERR_PESO', 'El peso debe ser un valor ...');
define ('MSG_ERR_ESTATURA', 'La estatura debe ser un valor ...');

/**
 * CalculoIMC
 * Calcula el valor IMC.
 * @param masa expresada en kg [0-500].
 * @param estatura expresada en cm [0-300].
 * @return float(numero real)resultado del calculo imc redondeado a dos decimales.
 * @link http://es.wikipedia.org/wiki/%C3%8Dndice_de_masa_corporal
 */
function calculoIMC($peso, $estatura){
    $estatura = $estatura/100; //cms a mts
    $imc=$peso / ($estatura * $estatura);
    return round ($imc, 2); //round devuelve el IMC con una precisión de 2 decimales.
};

/**
 * ClasificacionIMC
 * Calcula la clasificación ..
 * @param imc valor valido de IMC
 * @return String Contiene clasificación según valor
 * @link http://es.wikipedia.org/wiki/%C3%8Dndice_de_masa_corporal
 */
function clasificacionIMC($imc){
    if ($imc < 18.5) {
              $clasificacion = "Bajo peso";
          } elseif ($imc < 25 ) {
              $clasificacion = "Peso Normal";              
          } elseif ($imc < 30 ) {
              $clasificacion = "Sobrepeso";
          } else {
              $clasificacion = "Obesidad";              
          }
         return $clasificacion;
};

//Validaciones
/**
 * enRango
 * Indica si un valor está en un rango determinado [inicio,fin]
 * @param inicio
 * @param fin
 * @param valor
 * @return true si valor esta en el rango [inicio, fin], sino false
 */
function enRango($inicio, $fin, $valor) {
    return ($valor>=$inicio && $valor<=$fin);
}

/**
 * validarPeso
 * Validar peso: Indica si el valor de peso es correcto
 * @param peso debe ser un valor numérico entre [1-500]
 * @return boolean true si cumple y false en caso contrario.
 */

function validarPeso($peso) {
    $resultado = FALSE;
    if(filter_var ($peso, FILTER_VALIDATE_INT)){
        $resultado = enRango(PESO_MIN, PESO_MAX,$peso);
    }else{
         $resultado = FALSE;
    }
    return $resultado;
}

/**
 * validarEstatura
 * Validar altura: Indica si el valor de altura es correcto
 * @param altura debe ser un valor numérico entre lo definido en constantes
 * @return boolean true si cumple y false en caso contrario.
 */
function validarEstatura($estatura) {
    $resultado = FALSE;
    if(filter_var($estatura, FILTER_VALIDATE_INT)){
        $resultado = enRango(ESTATURA_MIN, ESTATURA_MAX,$estatura);
    }else{
         $resultado = FALSE;
    }
    return $resultado;
}