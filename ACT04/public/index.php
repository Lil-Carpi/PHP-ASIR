<?php
require __DIR__ . '/../src/libs/boostrap.php';
require __DIR__ . '/../src/libs/displayer.php';
?>
<?php
view('header', [
  'title' => 'Minetest Wiki v2 - Inici',
  'place' => '- Inici'
]);
?>
<main>
  <div class="secBar">
    <h1>Página inicial</h1>
  </div>

  <?php if (!empty($mensaje)): ?>
    <div style="background-color: lightgreen; margin: 30px; padding: 25px; border: solid 3px #053406; border-radius: 10px;">
      <?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?>
    </div>
  <?php endif; ?>

  <?php $isLogged = isset($_SESSION['user_id']); ?>

  <div class="llistaItems <?= !$isLogged ? 'loggedOutView' : '' ?>">
    <h2>Llista d'items</h2>

    <ul>
      <?php foreach ($items as $item): ?>
        <li>
          <img src="assets/imatges/items/<?= htmlspecialchars($item['ImageFile'], ENT_QUOTES, 'UTF-8') ?>" alt="" width="32">
          <?= htmlspecialchars($item['Nom'], ENT_QUOTES, 'UTF-8')?> (<?= htmlspecialchars($item['Descripcio'], ENT_QUOTES, 'UTF-8'); ?>)



          <?php if ($isLogged): ?>
            <form method="POST" style="display: inline;">
              <input type="hidden" name="esborrar_id" value="<?= $item['ItemId'] ?>">
              <button class="minibtn" type="submit"><img src="assets/imatges/botons/delete.svg"></button>
            </form>

            <form method="POST" action="editar.php" style="display:inline;">
              <input type="hidden" name="editar_id" value="<?= $item['ItemId'] ?>">
              <button class="minibtn" type="submit"><img src="assets/imatges/botons/edit.svg"></button>
            </form>
          <?php endif; ?>


        </li>
      <?php endforeach; ?>
    </ul>

    <?php if ($isLogged): ?>
      <a href="afegir.php" class="afegirBtn"> <img src="assets/imatges/botons/add.svg" alt=""> Afegir items</a>
    <?php else: ?>
      <div class="afegirBtn disabledBtn" title="Inicia sessió per editar dades">
        <img src="assets/imatges/botons/add.svg" alt=""> Afegir items
      </div>
    <?php endif; ?>

  </div>
<hr style="margin: 40px 0; border: 1px solid #ddd;">

<div class="comentarios-section" style="max-width: auto; margin: 0 30px;">
    <h2>Comentaris</h2>
    <!--Se que es opcional, pero em feia molta gracia... A mes, estic experimentant perque estic creant el meu projecte personal que es diu
    LilCMS, es un gestor de contingut que estic creant amb django. Es different a php, pero em dona una idea general de com fer-ho.
    Si vols veure el projecte: https://github.com/Lil-Carpi/LilCMS.git -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="formul" style="margin-bottom: 20px;">
            <form method="POST" action="index.php">
                <input type="hidden" name="action" value="add_comment">
                <div class="formGroup">
                    <textarea name="comment" rows="3" placeholder="Escriu un comentari..." required style="width: 100%; padding: 10px; border-radius: 5px;"></textarea>
                </div>
                <button type="submit" class="submitBtn">Enviar comentari</button>
            </form>
        </div>
    <?php else: ?>
        <div style="background: #f0f0f0; padding: 15px; border-radius: 8px; text-align: center; margin-bottom: 20px;">
            <p><a href="login.php" style="color: #333; font-weight: bold;">Inicia sessió</a> per deixar un comentari.</p>
        </div>
    <?php endif; ?>

    <div class="lista-comentarios">
        <?php if (empty($comentarios)): ?>
            <p style="color: #666;">Encara no hi ha comentaris. Sigues el primer!</p>
        <?php else: ?>
            <?php foreach ($comentarios as $c): ?>
                <?php 
                    
                    $ext = ($c['avatar'] === 'Ninot') ? '.svg' : '.png'; 
                ?>
                <div class="comentario" style="display: flex; gap: 15px; background: #fff; padding: 15px; border-radius: 8px; border: 1px solid #eee; margin-bottom: 10px;">
                    <img src="assets/imatges/avatars/<?= htmlspecialchars($c['avatar']) . $ext ?>" alt="avatar" style="width: 50px; height: 50px; border-radius: 50%;">
                    
                    <div style="flex-grow: 1;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                          <div>
                            <strong style="color: #2c3e50;"><?= htmlspecialchars($c['username']) ?></strong>
                            <span style="color: #999; font-size: 0.8em;"><?= date('d/m/Y H:i', strtotime($c['created_at'])) ?></span>
                          </div>

                            <?php if($isLogged):?>

                              <form  method="POST">
                                <input type="hidden" name="id_a_borrar" value="<?=$c['id']?>">
                                <div title="Esborra aquest comentari">
                                  <button class="afegirBtn" type="submit"><img src="assets/imatges/botons/delete.svg" alt=""> Esborrar comentari</button>
                                </div>
                              </form>
                            <?php endif;?>


                            
                        </div>
                        <p style="margin: 0; color: #444;"><?= nl2br(htmlspecialchars($c['comment'])) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
</main>
<?php view('footer'); ?>