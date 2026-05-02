<?php
// Backend de edicion de items
// Frontend es /public/editar.php

if (!isset($_POST['editar_id']) || !isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
// Si el usuario no tiene un id de edicion o no ha iniciado sesion, se le devuelve al index.
$stmt = $pdo->prepare('SELECT * FROM dtItems WHERE ItemId = ?');
$stmt->execute([$_POST['editar_id']]);
$item = $stmt->fetch();
// Hacemos la consulta a la base de datos y guardamos el resultado. 

if (!$item) {
    die("Primer de tot, l'ítem no existeix.
         Segon: Com coi has arribat aqui?!");
}
// Si no devuelve el resultado, le decimos que el item no existe... 
?>
