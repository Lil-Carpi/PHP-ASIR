<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/main.css">
  <title>Minetest Wiki - Inici</title>
</head>

<body>
  <header>
    <nav class="navbar">
      <img class="logo" src="assets/imatges/logo.png" alt="minetest logo">
      <h1>Minetest Wiki v2 - Registre</h1>
    </nav>
  </header>
  <main>
  <div class="formulCenter">
    <div class="formul">
      <form id="loginForm">
        <div class="formGroup">
          <p>Usuari:</p>
          <input id="usuari" type="text" placeholder="usuari">
        </div>
        <div class="formGroup">
          <p>Contrasenya:</p>
          <input id="contrasenya" type="password" placeholder="contrasenya">
        </div>
        <div class="formGroup">
          <p>Repeteix la contrasenya:</p>
          <input id="contrasenyaRepetida" type="password" placeholder="contrasenya">
        </div>
        <div class="formGroup">
            <select name="avatar" id="avatar">
                <option value="Ninot"><img src="assets/imatges/avatars/Ninot.svg">Ninot</option>
                <option value="Dona1"><img src="assets/imatges/avatars/Dona1.png" alt="">  Dona 1</option>
                <option value="Dona2"> <img src="assets/imatges/avatars/Dona2.png" alt=""> Dona 2</option>
                <option value="Home1"><img src="assets/imatges/avatars/Home1.png" alt=""> Home 1</option>
                <option value="Home2"><img src="assets/imatges/avatars/Home2.png" alt="">Home 2</option>
            </select>
        </div>
        <button class="submitBtn" type="submit">D'acord</button>
      </form>
    </div>
  </div>

  </main>
   
</body>
</html>