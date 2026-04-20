<?php
$mensaje = '';
$clase_mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['esborrar_id'])) {
  try {
    $stmt = $pdo->prepare('DELETE FROM dtItems WHERE ItemId = ?');
    $stmt->execute([$_POST['esborrar_id']]);
    $mensaje = 'Ítem esborrat correctament!';
    $clase_mensaje = "success";
  } catch (PDOException $e) {
    $mensaje = "Esborrat no realitzat per algun error!";
    $clase_mensaje = "error";
  }

}

// proceso de edicion (viene de editar.php)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_save_id'])) {
  // Hardening: PDO evita el SQLi
  try {
    $stmt = $pdo->prepare('UPDATE dtItems SET Nom = ?, Descripcio = ? WHERE ItemId = ?');
    $stmt->execute([$_POST['itemName'], $_POST['descripcion'], $_POST['editar_save_id']]);
    $mensaje = "Ítem actualitzat correctament!";
    $clase_mensaje = "success";
  } catch (PDOException $e) {
    $mensaje = "Esborrat no realitzat per algun error!";
    $clase_mensaje = "error";
  }
}
// Obtencion de items
$stmt = $pdo->query('SELECT * FROM dtItems');
$items = $stmt->fetchAll();

// GUARDAR UN NUEVO COMENTARIO (Solo si el usuario está logueado)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_comment') {
    if (isset($_SESSION['user_id']) && !empty(trim($_POST['comment']))) {
        $nuevo_comentario = trim($_POST['comment']);
        
        $insertStmt = $pdo->prepare("INSERT INTO comentaris (user_id, comment) VALUES (:user_id, :comment)");
        $insertStmt->execute([
            'user_id' => $_SESSION['user_id'],
            'comment' => $nuevo_comentario
        ]);
        
        // Recargamos la página para evitar que el usuario reenvíe el formulario al actualizar (F5)
        header('Location: index.php');
        exit;
    }
}

// OBTENER LOS COMENTARIOS EXISTENTES
// Hacemos un JOIN con la tabla users para traernos también el nombre, el id del comentario y el avatar del autor
$comentariosStmt = $pdo->query("
    SELECT comentaris.id, comentaris.comment, comentaris.created_at, users.username, users.avatar 
    FROM comentaris 
    JOIN users ON comentaris.user_id = users.id 
    ORDER BY comentaris.created_at DESC 
    LIMIT 30
");
$comentarios = $comentariosStmt->fetchAll();



// // // // // // BORRADO DE LOS COMENTARIOS
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_a_borrar'])) {
  $id_a_borrar = $_POST['id_a_borrar'] ?? null;

  if (isset($_SESSION['user_id']) && $id_a_borrar) {
    try {
      $stmt = $pdo->prepare('DELETE FROM comentaris WHERE id = ?');
      $stmt->execute([$_POST['id_a_borrar']]);
      $mensaje= 'Comentari esborrat correctament!';
      $clase_mensaje = "success";
      header("Location: index.php");
      exit;
    } catch (PDOException $e) {
      $mensaje = "Esborrat de comentari no realitzat per algún motiu!";
    }
  }
}





?>


