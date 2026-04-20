<?php

$id_a_editar = $_POST['id_a_editar'] ?? null;
$texto_original = '';
if ($id_a_editar && isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("SELECT comment FROM comentaris WHERE id = ? AND user_id = ?");
    $stmt->execute([$id_a_editar, $_SESSION['user_id']]);
    $comentario_encontrado = $stmt->fetch();
    if ($comentario_encontrado) {
        $texto_original = $comentario_encontrado['comment'];
    } else {
        header('Location: index.php?error=no_autorizado');
        exit;
    }
} else {
    header('Location: index.php');
    exit;
}

$id_a_editar = $_POST['id_a_editar'] ?? null;
$texto_original = '';

if ($id_a_editar && isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("SELECT comment FROM comentaris WHERE id = ? AND user_id = ?");
    $stmt->execute([$id_a_editar, $_SESSION['user_id']]);
    $comentario_encontrado = $stmt->fetch();
    if ($comentario_encontrado) {
        $texto_original = $comentario_encontrado['comment'];
    } else {
        header('Location: index.php');
        exit;
    }
}
?>