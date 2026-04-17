<?php
$mensaje = '';
$clase_mensaje = '';

if (!isset($_SESSION['user_id'])) {
  header('Location: index.php');
  exit;
}


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