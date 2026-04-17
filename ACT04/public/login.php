<?php
require __DIR__ . '/../src/libs/boostrap.php';


if (isset($_SESSION['user_id'])) {
  header('Location: index.php');
  exit;
}

require __DIR__ . '/../src/libs/logger.php';
?>
<?php
view('header', [
  'title' => 'Minetest Wiki v2 - Login',
  'place' => '- Login'
]);
?>
<main>
  <div class="formulCenter">
    <div class="formul">
      <?php if (!empty($errores)): ?>
        <div style="background-color: #ff9999; color:#cc0000; padding: 15px; margin-bottom:20px; border-radius: 5px;">
          <ul>
            <?php foreach ($errores as $error): ?>
              <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
            <?php endforeach ?>
          </ul>
        </div>
      <?php endif ?>
      
      <form id="loginForm" method="POST" action="login.php">
        <div class="formGroup">
          <p>Usuari:</p>
          <input id="usuari" name="username" type="text" placeholder="usuari" required>
        </div>
        <div class="formGroup">
          <p>Contrasenya:</p>
          <input id="contrasenya" name="password" type="password" placeholder="contrasenya" required>
        </div>
        <button class="submitBtn" type="submit">Inicia la sessió</button>
        <a href="registre.php">
          <p>Registra't</p>
        </a>
      </form>
    </div>
  </div>
  <?php view('footer'); ?>
</main>