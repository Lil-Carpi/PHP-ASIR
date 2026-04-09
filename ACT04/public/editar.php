<?php
require_once '../private/db_connect.php';

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
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Minetest Wiki - Edita ítem</title>
</head>
<body>
    <header>
        <nav>
             <img class="logo" src="assets/imatges/logo.png" alt="minetest logo">
            <h1>Minetest Wiki v2- Edita ítem</h1>
        </nav>
    </header>
    <main>
        <form method="POST" action="index.php"> <fieldset>
                <input type="hidden" name="editar_save_id" value="<?= $item['ItemId'] ?>">
                
                <img src="assets/imatges/items/<?= htmlspecialchars($item['ImageFile'], ENT_QUOTES, 'UTF-8') ?>" width="32" alt="">
                
                Nom de l'ítem: <input name='itemName' type='text' value="<?= htmlspecialchars($item['Nom'], ENT_QUOTES, 'UTF-8') ?>" required>
                Descripció: <input name='descripcion' type='text' value="<?= htmlspecialchars($item['Descripcio'], ENT_QUOTES, 'UTF-8') ?>" required>
                <div style="margin-top:25px;">
                    <button type="submit" class="afegirBtn" > <img src="assets/imatges/botons/edit.svg"> Desa els canvis</button> </fieldset>
                </div>
        </form>
        <br>
        <a href="index.php"><button class="afegirBtn"> <img src="assets/imatges/botons/left.svg"> Torna a la llista (sense desar canvis)</button></a> </main>
</body>
</html>
