<?php
$errores = [];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['username'] ?? '');
    $pass = $_POST['password'] ?? '';

    if(empty($usuario) || empty($pass)) {
        $errores[] = "Si us plau, omple tots els camps";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :user");
        $stmt->execute(['user'=>$usuario]);
        $user = $stmt->fetch();

        if($user && password_verify($pass, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['avatar'] = $user['avatar'];

            header('Location: index.php');
            exit;
        } else {
            $errores[] = "Usuari o contrasenya no valids.";
        }
    }
}
?>