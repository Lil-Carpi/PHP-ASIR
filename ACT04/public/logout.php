<?php
require __DIR__ . '/../src/libs/boostrap.php';
require __DIR__ . '/../src/libs/logoff.php';
?>
<?php 
view('header', [
  'title' => 'Minetest Wiki v2 - Logout',
  'place' => '- Logout'
]);
?>

<main>
  <div class="confirm">
    <h2>Confirmació</h2>
    <p>Segur que vols tancar la sessió?</p>
    <form id="LogoutConfirm" method="POST">
      <div>
        <button class="minibtn" name="confirm" type="submit" value="yes"><img src="assets/imatges/botons/check.svg"> Sí </button>
        <button class="minibtn" name="confirm" type="submit" value="no"><img src="assets/imatges/botons/delete.svg">No</button>
      </div>
    </form>
  </div>
</main>
