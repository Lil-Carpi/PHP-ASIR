<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Activitat 5.1 - Cub RGB</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <?php
  // --REQUISITO-- (Cumplido): Constante para el número de muestras 
  // Cambia este valor para ver más o menos divisiones (ej. 3, 5, 6)


  // REQUISITO 2: Realizar consultas mediante GET / POST seleccionado por el usuario.
  // 
  

  /*
  define('NUM_MOSTRES', 5);

  echo "<h1>Activitat 5.1 - Generador de colors HTML</h1>";
  echo "<p>Mostrant rodanxes d'un cub de " . NUM_MOSTRES . " mostres per dimensió.</p>";

  // REQUISITO: Función propia para convertir decimal a hexadecimal 
  function miDec2Hex($numero)
  {
    // Aseguramos que es un entero
    $numero = intval($numero);
    if ($numero == 0) return "00";

    $hexDigits = "0123456789abcdef";
    $hex = "";

    while ($numero > 0) {
      $resto = $numero % 16;
      $hex = $hexDigits[$resto] . $hex;
      $numero = floor($numero / 16);
    }

    // Si el resultado tiene 1 solo dígito, añadimos un 0 delante (padding)
    if (strlen($hex) == 1) {
      $hex = "0" . $hex;
    }

    return $hex;
  }

  // REQUISITO: Función para calcular luminancia y color del texto 
  function obtenerColorTexto($r, $g, $b)
  {
    // Fórmula dada en el PDF: Y = 0.299*R + 0.587*G + 0.114*B
    $luminancia = (0.299 * $r) + (0.587 * $g) + (0.114 * $b);

    // Si luminancia < 128 es oscura (texto blanco), sino clara (texto negro)
    return ($luminancia < 128) ? '#ffffff' : '#000000';
  }

  // Cálculo del "paso" o incremento entre colores
  // Si N=3, los valores son 0, 127, 255. Paso = 255 / (3-1) = 127.5
  $paso = 255 / (NUM_MOSTRES - 1);

  // Bucle para las rodajas (Eje Azul - Blue) 
  for ($z = 0; $z < NUM_MOSTRES; $z++) {
    $blue = round($z * $paso);

    echo "<div class='slice-container'>";
    echo "<div class='slice-label'>Blue: $blue</div>";
    echo "<table>";

    // Bucle para las filas (Eje Verde - Green)
    for ($y = 0; $y < NUM_MOSTRES; $y++) {
      $green = round($y * $paso);
      echo "<tr>";

      // Bucle para las celdas/columnas (Eje Rojo - Red)
      for ($x = 0; $x < NUM_MOSTRES; $x++) {
        $red = round($x * $paso);

        // Convertimos a Hexadecimal usando nuestra función
        $hexR = miDec2Hex($red);
        $hexG = miDec2Hex($green);
        $hexB = miDec2Hex($blue);

        $colorHex = "#" . $hexR . $hexG . $hexB;

        // Calculamos el color del texto para el contraste
        $textColor = obtenerColorTexto($red, $green, $blue);

        // Mostramos la celda [cite: 38]
        echo "<td style='background-color: $colorHex; color: $textColor;'>";
        echo $colorHex;
        echo "</td>";
      }
      echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
  }*/

  echo "<h2>Activitat 5.2 - Generador de colors HTML amb GET - POST</h2>";
  echo "<p></p>"
  echo "<form></form>"
  echo "<button type="button" >"

  ?>

  

  
</body>

</html>
