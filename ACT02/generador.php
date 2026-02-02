<?php

declare(strict_types=1);
$metodo = $_SERVER['REQUEST_METHOD'];

$nombre = $metodo === 'POST'
  ? ($_POST['nombre'] ?? 'Ánonimo')
  : ($_GET['nombre'] ?? 'Ánonimo');

$secciones = $metodo === 'POST'
  ? intval($_POST['secciones'] ?? 5)
  : intval($_GET['secciones'] ?? 5);

$secciones = max(2, min(10, $secciones));

function miDec2Hex(int $numero): string
{
  $hexDigits = "0123456789abcdef";
  if ($numero === 0) return "00";

  $hex = "";
  while ($numero > 0) {
    $resto = $numero % 16;
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
