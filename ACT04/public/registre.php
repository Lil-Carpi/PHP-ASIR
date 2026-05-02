<?php
require __DIR__ . '/../src/libs/boostrap.php';
require __DIR__ . '/../src/libs/register.php';
?>
<?php
view('header', [
  'title' => 'Minetest Wiki v2 - Registre',
  'place' => '- Registre'
]);
?>
<?php if (!empty($errores)): ?>
  <div style="background-color: #ff9999; color:#cc0000; padding: 15px; margin-bottom:20px; border-radius: 5px;">
    <ul>
      <?php foreach ($errores as $error): ?>
        <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
      <?php endforeach ?>
    </ul>
  </div>
<?php endif ?>
<?php if (!empty($registro) && empty($exito)): ?>
  <div style="background-color: lightgreen ;margin: 30px; padding: 25px; border: solid 3px #053406 ;border-radius: 10px;">
    <ul>
        <li><?= htmlspecialchars($exito, ENT_QUOTES, 'UTF-8') ?></li>
    </ul>
  </div>
<?php endif ?>

<div class="formulCenter">
  <div class="formul">
    <form id="loginForm" method="POST">
      <div class="formGroup">
        <p>Usuari:</p>
        <input id="usuari" name="username" type="text" placeholder="usuari">
      </div>
      <div class="formGroup">
        <p>Contrasenya:</p>
        <input id="contrasenya" name="password" type="password" placeholder="contrasenya">
      </div>
      <div class="formGroup">
        <p>Repeteix la contrasenya:</p>
        <input id="contrasenyaRepetida" name="password_confirm" type="password" placeholder="contrasenya">
      </div>
      <div class="loginButtons">
      <div class="formGroup">
        <p>Avatar:</p>
        <select name="avatar" id="avatar">
          <option value="Ninot">Ninot</option>
          <option value="Dona1">Dona 1</option>
          <option value="Dona2">Dona 2</option>
          <option value="Home1">Home 1</option>
          <option value="Home2">Home 2</option>
        </select>
      </div>
      <button class="submitBtn" type="submit">D'acord</button>
      </div>
    </form>
  </div>
</div>