<?php
require_once '../private/db_connect.php';

$mensaje = '';
$clase_mensaje = '';

// OPCIONAL: selector de imagenes
$dir_imatges = 'assets/imatges/items/';
$imatges_disponibles = [];
if (is_dir($dir_imatges)) {
  $arxius = scandir($dir_imatges);
  foreach ($arxius as $arxiu) {
    // Solo cogemos archivos que sean imágenes PNG
    if (strtolower(pathinfo($arxiu, PATHINFO_EXTENSION)) === 'png') {
      $imatges_disponibles[] = $arxiu;
    }
  }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nom = trim($_POST['itemName']);
  $descripcio = trim($_POST['descripcion']);
  $imageName = trim($_POST['imageName']);

  if (isset($_FILES['imageFile']) && $_FILES['imageFile']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['imageFile']['tmp_name'];
    $fileName = $_FILES['imageFile']['name'];
    $fileSize = $_FILES['imageFile']['size'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if ($fileExtension === 'png' && $fileSize < 40960) {
      $dest_path = 'assets/imatges/items/' . basename($fileName);
      if (move_uploaded_file($fileTmpPath, $dest_path)) {
        $imageName = $fileName;
      } else {
        $mensaje = "Error al moure l'arxiu pujat.";
      }
    } else {
      $mensaje = "Només s'admeten arxius PNG menors de 40Kb.";
    }
  }
  if (empty($mensaje) && !empty($nom)) {
    try {
      $stmt = $pdo->prepare('INSERT INTO dtItems (Nom, Descripcio, ImageFile) VALUES (?, ?, ?)');
      $stmt->execute([$nom, $descripcio, $imageName]);
      $mensaje = "Ítem afegit correctament!";
    } catch (Exception $e) {
      $mensaje = "Inserció no realitzada per algun error!";
    }
  }
}

$stmt = $pdo->query('SELECT * FROM dtItems');
$items = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/main.css">
    <script src="assets/js/index.js" defer></script>
  <title>Minetest Wiki - Afegeix ítem</title>
</head>

<body>
  <header>
    <nav>

      <h1>Minetest Wiki - Afegeix ítem</h1>
      <img class="logo" src="assets/imatges/logo.png" alt="minetest logo">

    </nav>
  </header>

  <main>
    <?php if ($mensaje): ?>
      <div style="background-color: <?= strpos($mensaje, 'error') !== false ? 'lightcoral' : 'lightgreen' ?>; padding: 10px;">
        <?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?>
      </div>
    <?php endif; ?>

    <div>
      <form method="POST" action="afegir.php" enctype="multipart/form-data">
        <fieldset>
          Nom d'item: <input name='itemName' type='text' required tabindex='1'>
          Descripcio: <input name='descripcion' type='text' tabindex='2'>
          <div>
            <fieldset>
              <legend>Utilitza un dels dos següents</legend>
              Nom d'arxiu d'imatge (ex: Apple.png): <input name="imageName" type="text" tabindex='3'> <br>
              Arxiu d'imatge (extensió = .png, mida < 40kb): <input type="file" name="imageFile" id="imageFile" accept=".png" tabindex='4'>
            </fieldset>
          </div>
          <button type="submit"><img src="assets/imatges/botons/add.svg" alt=""> Afegeix</button>
        </fieldset>
      </form>
      <div class="image-selector-container">
        <h3>O tria una imatge existent fent-hi clic:</h3>
        <div class="image-grid">
          <?php foreach ($imatges_disponibles as $img): ?>
            <img src="<?= $dir_imatges . htmlspecialchars($img, ENT_QUOTES, 'UTF-8') ?>"
              alt="<?= htmlspecialchars($img, ENT_QUOTES, 'UTF-8') ?>"
              class="selectable-image"
              data-filename="<?= htmlspecialchars($img, ENT_QUOTES, 'UTF-8') ?>"
              onclick="seleccionarImatge(this)">
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <h2>Llista d'ítems</h2>
    <ul>
      <?php foreach ($items as $item): ?>
        <li>
          <img src="assets/imatges/items/<?= htmlspecialchars($item['ImageFile'], ENT_QUOTES, 'UTF-8') ?>" alt="" width="32">
          <?= htmlspecialchars($item['Nom'], ENT_QUOTES, 'UTF-8') ?>
          (<?= htmlspecialchars($item['Descripcio'], ENT_QUOTES, 'UTF-8') ?>)
        </li>
      <?php endforeach; ?>
    </ul>
    <a href="index.php"><button><img src="assets/imatges/botons/left.svg" alt=""> Torna a la llista</button></a>
  </main>
</body>

</html>
