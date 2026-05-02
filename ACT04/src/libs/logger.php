<?php
// Creamos la variable para guardar los mensajes de error.
$errores = [];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['username'] ?? '');
    $pass = $_POST['password'] ?? '';

    // Se guardan las credenciales de usuario en su respectiva variable

    if(empty($usuario) || empty($pass)) {
        $errores[] = "Si us plau, omple tots els camps";
        // para comprovar que ha introducido todos los campos
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :user");
        $stmt->execute(['user'=>$usuario]);
        $user = $stmt->fetch();

        // se prepara la consulta y se guarda el resultado en la variable stmt

        if($user && password_verify($pass, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['avatar'] = $user['avatar'];

            header('Location: index.php');
            exit;

            // En caso de que todo coincida, se le da una cookie de sesion al usuario vinculandolo con su id, usuario y avatar, que loego se utilizará en el frontend. 
        } else {
            $errores[] = "Usuari o contrasenya no valids.";
            // Si no, suelta error.
        }
    }
}
?>