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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_save_id'])) {
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




// GUARDAR UN NUEVO COMENTARIO (Texto + GIF)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_comment') {
    if (isset($_SESSION['user_id']) && !empty(trim($_POST['comment']))) {
        $nuevo_comentario = trim($_POST['comment']);
        $gif_url = trim($_POST['gif_url'] ?? ''); 

        // Validación: si escriben algo, que parezca una URL (esto dentro de su campo)
        if (!empty($gif_url) && !filter_var($gif_url, FILTER_VALIDATE_URL)) {
            $gif_url = null; 
        }

        $insertStmt = $pdo->prepare("INSERT INTO comentaris (user_id, comment, gif_url) VALUES (:user_id, :comment, :gif_url)");
        $insertStmt->execute([
            'user_id' => $_SESSION['user_id'],
            'comment' => $nuevo_comentario,
            'gif_url' => empty($gif_url) ? null : $gif_url
        ]);
        
        header('Location: index.php');
        exit;
    }
}

// PROCESO DE EDICIÓN DE COMENTARIO
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit_comment') {
    $id_comentario = $_POST['id_comentario'] ?? null;
    $nuevo_texto = trim($_POST['comment'] ?? '');

    if ($id_comentario && !empty($nuevo_texto) && isset($_SESSION['user_id'])) {
        try {
            $stmt = $pdo->prepare("UPDATE comentaris SET comment = ? WHERE id = ? AND user_id = ?");
            $stmt->execute([$nuevo_texto, $id_comentario, $_SESSION['user_id']]);
            
            header("Location: index.php?mensaje=Comentari actualitzat");
            exit;
        } catch (PDOException $e) {
            $mensaje = "Error al actualitzar el comentari.";
        }
    }
}

// BORRADO DE LOS COMENTARIOS
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_a_borrar'])) {
    $id_a_borrar = $_POST['id_a_borrar'];
    if (isset($_SESSION['user_id'])) {
      try {
        $stmt = $pdo->prepare('DELETE FROM comentaris WHERE id = ? AND user_id = ?');
        $stmt->execute([$id_a_borrar, $_SESSION['user_id']]);

        header("Location: index.php");
        exit;
      } catch (PDOException $e) {
        $mensaje = "Error al borrar el comentario.";
      }
    }
}

// OBTENER LOS COMENTARIOS EXISTENTES
$comentariosStmt = $pdo->query("
    SELECT comentaris.id, comentaris.comment, comentaris.gif_url, comentaris.created_at, comentaris.user_id, users.username, users.avatar
    FROM comentaris
    JOIN users ON comentaris.user_id = users.id
    ORDER BY comentaris.created_at DESC
    LIMIT 30
");
$comentarios = $comentariosStmt->fetchAll();
?>