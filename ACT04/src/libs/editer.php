<?php

if (!isset($_POST['editar_id'])) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM dtItems WHERE ItemId = ?');
$stmt->execute([$_POST['editar_id']]);
$item = $stmt->fetch();

if (!$item) {
    die("L'ítem no existeix.");
}
?>
