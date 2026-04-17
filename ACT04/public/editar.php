<?php
require __DIR__ . '/../src/libs/boostrap.php';
require __DIR__ . '/../src/libs/editer.php';
?>
<?php 
view('header', [
  'title' => 'Minetest Wiki v2 - Editar',
  'place' => '- Editar'
]);
?>
<main>
    <form method="POST" action="index.php">
        <fieldset>
            <input type="hidden" name="editar_save_id" value="<?= $item['ItemId'] ?>">

            <img src="assets/imatges/items/<?= htmlspecialchars($item['ImageFile'], ENT_QUOTES, 'UTF-8') ?>" width="32" alt="">

            Nom de l'ítem: <input name='itemName' type='text' value="<?= htmlspecialchars($item['Nom'], ENT_QUOTES, 'UTF-8') ?>" required>
            Descripció: <input name='descripcion' type='text' value="<?= htmlspecialchars($item['Descripcio'], ENT_QUOTES, 'UTF-8') ?>" required>
            <div style="margin-top:25px;">
                <button type="submit" class="afegirBtn"> <img src="assets/imatges/botons/edit.svg"> Desa els canvis</button>
        </fieldset>
        </div>
    </form>
    <br>
    <a href="index.php"><button class="afegirBtn"> <img src="assets/imatges/botons/left.svg"> Torna a la llista (sense desar canvis)</button></a>
</main>
</body>

</html>