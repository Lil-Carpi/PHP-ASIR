<?php

declare(strict_types=1); // Declara variables estrictas
$metodo = $_SERVER['REQUEST_METHOD']; // Pide el metodo de envio del formulario


// Verificador del nombre que se envia
// 
$nombre = $metodo === 'POST' 
  ? ($_POST['nombre'] ?? 'Ánonimo') // Si no se proporciona uno, es Ánonimo por defecto \Para POST
  : ($_GET['nombre'] ?? 'Ánonimo'); // Para GET
// Concepto
// Lo que se ha pasado en nombre es exactamente con el metodo 'POST'?
// Si es que la respuesta es SI, pilla el valor que se encuentre en nombre pasado con POST. Si no existe, usa "Ánonimo".
// Si es que la respuesta es NO, pilla el valor que se encuentre en nombre pasado con GET. Si no existe, usa "Ánonimo".


// Verificador de la cantidad de secciones que se envia
//
$secciones = $metodo === 'POST' 
  ? intval($_POST['secciones'] ?? 5) // Si no se proporciona uno, usa por defecto 5. 
  : intval($_GET['secciones'] ?? 5);
// Concepto
// Lo que se ha pasado en secciones es exactamente con el metodo 'POST'?
// Si es que la respuesta es SI, convierte el valor en entero y pilla lo que se encuentre en secciones pasado con POST. Si no existe, usa 5.
// Si es que la respuesta es NO, convierte el valor en entero y pilla lo que se encuentre en secciones pasado con GET. Si no existe, usa 5.

$secciones = max(2, min(10, $secciones)); // Seguridad: Obliga a que los saltos sean solo de entre 2 a 10 para que la maquina
                                          // no se haga un Harakiri.

function miDec2Hex(int $numero): string // Funcion de conversion a base 16 para el color hexadecimal
// Entra como integer por la variable numero y sale como string
// En el extraño caso que el valor que entre no sea un integer o no salga como un string, dara error.
{
  $hexDigits = "0123456789abcdef"; // Los digitos disponibles del hexadecimal
  if ($numero === 0) return "00"; // En caso de que el numero sea 0, devuelve "00". Hexa necesita de dos digitos para operar

  $hex = ""; // inicia el string hex, para ir poniendo los valores
  while ($numero > 0) { 
    $resto = $numero % 16; // Se usa el resto para seleccionar el digito hexadecimal
    $hex = $hexDigits[$resto] . $hex;  
    $numero = intdiv($numero, 16);
  }

  return str_pad($hex, 2, "0", STR_PAD_LEFT);
}

function obtenerColorTexto(int $r, int $g, int $b): string
{
  $iluminancia = (0.299 * $r) + (0.587 * $g) + (0.114 * $b);
  return ($iluminancia < 128) ? '#ffffff' : '#000000';
}

$paso = 255 / ($secciones - 1);
?>

<!DOCTYPE html>
<html lang="ca">

<head>
  <meta charset="UTF-8">
  <title>Resultado</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <h1>Bienvenido, <?= htmlspecialchars($nombre) ?></h1>
  <p>
    <span class="variable">método = <?= $metodo ?></span>
    <span class="variable">nombre = <?= htmlspecialchars($nombre) ?></span>
    <span class="variable">secciones = <?= $secciones ?></span>
  </p>
  <?php
  for ($z = 0; $z < $secciones; $z++) {
    $blue = (int) round($z * $paso);

    echo "<div class='slice-container'>";
    echo "<div class='slice-label'>Blue: $blue</div>";
    echo "<table>";

    for ($y = 0; $y < $secciones; $y++) {
      $green = (int) round($y * $paso);
      echo "<tr>";

      for ($x = 0; $x < $secciones; $x++) {
        $red = (int) round($x * $paso);

        $hex = "#" .
          miDec2Hex($red) .
          miDec2Hex($green) .
          miDec2Hex($blue);
        $textColor = obtenerColorTexto($red, $green, $blue);
        echo "<td style='background:$hex; color:$textColor'>$hex</td>";
      }
      echo "</tr>";
    }
    echo "</table></div>";
  }
  ?>
</body>

</html>
