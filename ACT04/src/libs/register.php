<?php
require __DIR__ . '/boostrap.php';
$errores = [];
$exito = '';
$registro = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['username'] ?? '');
    $pass = $_POST['password'] ?? '';
    $pass_confirm = $_POST['password_confirm'] ?? '';
    $avatar = $_POST['avatar'] ?? 'Ninot';

    $usuario = filter_var($usuario, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if(empty($usuario) || mb_strlen($usuario) < 3) {
        $errores[] = "L'usuari ha de tenir almenys 3 caracters.";
    }
    if(empty($pass) || mb_strlen($pass) < 6) {
        $errores[] = "La contrasenya ha de tenir almenys 6 caracters.";
    }
    if($pass !== $pass_confirm){
        $errores[] = "Les contrasenyes no coincideixen.";
    }
    $avatars_permesos = ['Ninot', 'Dona1', 'Dona2', 'Home1', 'Home2'];
    if(!in_array($avatar, $avatars_permesos)) {
        $errores[] = "L'avatar seleccionat no és vàlid.";
    }

    if (empty($errores)) {
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE username = :user');
        $stmt->execute(['user' => $usuario]);

        if($stmt->fetchColumn() > 0) {
            $errores[] = "Aquest usuari ja existeix.";
        } else {
            $hash = password_hash($pass, PASSWORD_DEFAULT);

            $insertuser = $pdo->prepare("INSERT INTO users (username, password, avatar) VALUES (:user, :pass, :avatar)");
            $registro = $insertuser->execute([
                'user' => $usuario,
                'pass' => $hash,
                'avatar' => $avatar
            ]);

            if($registro) {
                $exito = "L'usuari s'ha creat correctament";
                exit;
            } else {
                $errores[] = "L'usuari no s'ha creat per algún motiu!";
            }
        }
    }
}


?>