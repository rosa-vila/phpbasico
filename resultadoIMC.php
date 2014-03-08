<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
        <div>resultado IMC</div>
        <?php
        //Prueba inicial
            //print_r($_REQUEST);
       //Entrada datos 
            $masa = $_REQUEST['masa'];
            $estatura = $_REQUEST['estatura'];
          //Aunque no es necesario es recomendable declarar antes las variables que usemos
            $imc=0.0;
            $clasificacion = "";                  
      //Cálculo y Salida
           $estatura = $estatura/100; //cms a mts
           $imc = $masa / ($estatura * $estatura);
          echo " Valor IMC = ";
          echo $imc;
        
          if ($imc < 18.5) {
              $clasificacion = "Bajo peso";
          } elseif ($imc < 25 ) {
              $clasificacion = "Peso Normal";              
          } elseif ($imc < 30 ) {
              $clasificacion = "Sobrepeso";
          } else {
              $clasificacion = "Obesidad";              
          }
          echo "<br>";
          echo "Clasificación = ".$clasificacion;
        ?>
    </body>
</html>