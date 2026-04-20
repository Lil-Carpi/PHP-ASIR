<?php
require __DIR__ . '/../src/libs/boostrap.php';
require __DIR__ . '/../src/libs/displayer.php';
require __DIR__ . '/../src/libs/editerC.php'
?>
<?php
view('header', [
  'title' => 'Minetest Wiki v2 - Editar Comentari',
  'place' => '- Editar Comentari'
]);
?>
<main>
    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="formul" style="margin: 20px 30px;">
            <h2>Editar el teu comentari</h2>
            <form method="POST" action="index.php">
                <input type="hidden" name="action" value="edit_comment">
                <input type="hidden" name="id_comentario" value="<?= htmlspecialchars($id_a_editar) ?>">
                <div class="formGroup">
                    <textarea name="comment" rows="5" required style="width: 100%; padding: 10px; border-radius: 5px;"><?= htmlspecialchars($texto_original, ENT_QUOTES, 'UTF-8') ?></textarea>
                </div>
                <div style="margin-top: 10px;">
                    <button type="submit" class="submitBtn">Guardar Canvis</button>
                    <a href="index.php" style="margin-left: 10px; color: #666;">Cancel·lar</a>
                </div>
            </form>
        </div>
    <?php else: ?>
        <script>window.location.href = 'index.php';</script>
    <?php endif; ?>
</main>
