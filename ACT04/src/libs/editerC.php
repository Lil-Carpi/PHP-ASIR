<?php
// Backend de edicion de comentarios
// Frontend es /public/editarC.php

$id_a_editar = $_POST['id_a_editar'] ?? null;
// Pillamos el id del comentario que tenemos que editar.
// el operador null coalescing (??) por si alguien entra a la pagina directamente sin enviar el formulario
$texto_original = '';
//Aqui se va a guardar el texto que ya estaba escrito

if ($id_a_editar && isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("SELECT comment FROM comentaris WHERE id = ? AND user_id = ?"); // IDOR Jumpscare
    $stmt->execute([$id_a_editar, $_SESSION['user_id']]);
    $comentario_encontrado = $stmt->fetch();
    if ($comentario_encontrado) {
        $texto_original = $comentario_encontrado['comment'];
    // Comprobamos que el usuario tenga una sesion iniciada para poder editar el comentario
    // Comprovamos si el id del usuario y el id del comentario coincidan antes de poder editarlo
        // Esto nos servira para editar el Insecure Direct Object Reference Vulnerability (o tambien llamado IDOR).
        // Mira esto para mas info: https://blog.hackmetrix.com/insecure-direct-object-reference/
    // Si se encuentra el comentario en la consulta a la base de datos, se almacena en la variable de $texto_original.
        } else {
        header('Location: index.php?error=no_autorizado');
        exit;
        // Si no se encuentra el comentario o el comentario no coincide con el id del usuario, no le dejamos editar.
    }
} else {
    header('Location: index.php');
    exit;
    // Si no tiene un ID o directamente no ha iniciado sesion, se le devuelve al index.
}

?>