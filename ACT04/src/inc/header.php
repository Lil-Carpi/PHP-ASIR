<!DOCTYPE html>
<html lang="ca">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/main.css">
  <title><?= $title ?? 'Home' ?></title>
</head>
<header>
  <nav class="navbar">
    <div class="loginBtn" id="signin">
      <img class="logo" src="assets/imatges/logo.png" alt="minetest logo">
      <h1>Minetest Wiki v2 <?= $place ?? 'inici' ?></h1>
      
      <?php if (isset($_SESSION['user_id'])): ?>
        <?php 
            // Ninot tocan els ous
            $ext = ($_SESSION['avatar'] === 'Ninot') ? '.svg' : '.png'; 
        ?>
        <div class="userBox">
          <img class="userAvatar" src="assets/imatges/avatars/<?= $_SESSION['avatar'] . $ext ?>" alt="avatar">
          <div class="userInfo">
            <span class="username"><?= htmlspecialchars($_SESSION['username']) ?></span>
            <span class="userId">(id <?= htmlspecialchars($_SESSION['user_id']) ?>)</span>
          </div>
          <a href="logout.php" class="logoutBtn"><p class="afegirBtn"><img src="assets/imatges/botons/delete.svg" alt="">Tanca sessió</p></a>
        </div>
        
        
      <?php else: ?>
        <a class="login" href="login.php">Inicia sessió</a>
      <?php endif ?>
    </div>
  </nav>
</header>