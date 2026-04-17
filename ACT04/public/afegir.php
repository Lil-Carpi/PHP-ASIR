<?php
require __DIR__ . '/../src/libs/boostrap.php';
require __DIR__ . '/../src/libs/adder.php';
?>

<?php view('header', [
  'title' => 'Minetest Wiki v2 - Afegir',
  'place' => '- Afegir'
]);
?>

  <main>
    <?php if ($mensaje): ?>
      <div style="background-color: <?= strpos($mensaje, 'error') !== false ? 'lightcoral' : 'lightgreen' ?>; margin: 30px; padding: 25px; border: solid 3px #053406 ;border-radius: 10px;">
        <?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?>
      </div>
    <?php endif; ?>

    <div>
      <form method="POST" action="afegir.php" enctype="multipart/form-data">
        <fieldset class="fsetP">
          <p style=" display:flex; margin-left: 10px; gap: 30px; margin-bottom: 0;">
            Nom d'item: <input name='itemName' type='text' required tabindex='1'>
            Descripcio: <input name='descripcion' type='text' tabindex='2'>
          </p>
          <div>
            <fieldset class="fsetC">
              <legend style="margin: 30px;">Utilitza un dels dos següents</legend>
              <div>
              Nom d'arxiu d'imatge (ex: Apple.png): <input name="imageName" type="text" tabindex='3'>
              </div>
              <div>
              Arxiu d'imatge (extensió = .png, mida 40kb): <input type="file" name="imageFile" id="imageFile" accept=".png" tabindex='4'>
              </div>
            </fieldset>
          </div>
          <button type="submit" class="afegirBtn"><img src="assets/imatges/botons/add.svg" alt=""> Afegeix</button>
        </fieldset>
      </form>
    </div>
    <div class="llistaItems">
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
          <a class="afegirBtn" href="index.php"><img src="assets/imatges/botons/left.svg" alt=""> Torna a la llista</a>
    </div>

  </main>
</body>

</html>
