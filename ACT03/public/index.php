<?php
require_once '../private/db_connect.php';

$mensaje = '';
$clase_mensaje = '';

// proceso de borrado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['esborrar_id'])) {
  $stmt = $pdo->prepare('DELETE FROM dtItems WHERE ItemId = ?');
  if ($stmt->execute([$_POST['esborrar_id']])) {
    $mensaje = "Ítem esborrat correctament!";
    $clase_mensaje = "success";
  }
}

// proceso de edicion (viene de editar.php)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_save_id'])) {
  // Hardening: PDO evita el SQLi
  $stmt = $pdo->prepare('UPDATE dtItems SET Nom = ?, Descripcio = ? WHERE ItemId = ?');
  if ($stmt->execute([$_POST['itemName'], $_POST['descripcion'], $_POST['editar_save_id']])) {
    $mensaje = "Ítem actualitzat correctament!";
    $clase_mensaje = "success";
  }
}

// Obtencion de items
$stmt = $pdo->query('SELECT * FROM dtItems');
$items = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/main.css">
  <title>Minetest Wiki - Inici</title>
</head>

<body>
  <header>
    <nav>

      <h1>Minetest Wiki</h1>
      <img class="logo" src="assets/imatges/logo.png" alt="minetest logo">

    </nav>
  </header>

  <main>
    <?php if ($mensaje): ?>
      <div style="background-color: lightgreen; padding: 10px; margin-bottom: 20px;">
        <?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?>
      </div>
    <?php endif; ?>
    <h2>Llista d'items</h2>
    <ul>
      <?php foreach ($items as $item): ?>
        <li><img src="assets/imatges/items/<?= htmlspecialchars($item['ImageFile'], ENT_QUOTES, 'UTF-8') ?>" alt="" width="32">
          <?= htmlspecialchars($item['Nom'], ENT_QUOTES, 'UTF-8') ?>
          (<?= htmlspecialchars($item['Descripcio'], ENT_QUOTES, 'UTF-8') ?>)
          <form method="POST" style="display: inline;">
            <input type="hidden" name="esborrar_id" value="<?= $item['ItemId'] ?>">
            <button type="submit"><img src="assets/imatges/botons/delete.svg"></button>
          </form>
          <form method="POST" action="editar.php" style="display:inline;"> <input type="hidden" name="editar_id" value="<?= $item['ItemId'] ?>">
            <button type="submit"><img src="assets/imatges/botons/edit.svg"></button>
          </form>
        </li>
      <?php endforeach; ?>
    </ul>
    <a href="afegir.php"><button> <img src="assets/imatges/botons/add.svg" alt=""> afegir items</a>
  </main>

</body>

</html>
