<?php
// Backend para el registro de usuarios.
// el frontend de este php es /public/registre.php

// Se linkea a boostrap para acceder a la base de datos (tiene el db_connect ahi)
require __DIR__ . '/boostrap.php';
// Servirá para almacenar los mensajes que se le van a pasar al usuario en caso de que la contraseña sea
// incorrecta o tenga algun error.
$errores = [];
// Mensajes de exito... la verdad no se que hace esto aqui... Creo que no hace nada.
// Podria hasta quitarlo, porque en el momento que se crea el usuario, se le redirecciona directamente a 
// iniciar sesion...
$exito = '';
// TODO TA MAL POR DEFECTO! 👹🗣🔥🗣🔥
$registro = false;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['username'] ?? '');
    $pass = $_POST['password'] ?? '';
    $pass_confirm = $_POST['password_confirm'] ?? '';
    $avatar = $_POST['avatar'] ?? 'Ninot';
// Si se manda el request al server como POST:
    // quitamos espacios al usuario y lo almacenamos en $usuario
    // almacenamos la contraseña en $pass
    // volvemos a almacenar la segunda contraseña en $pass_confirm (servira para confirmar que ha 
    // introducido la contraseña 2 veces correctamente).
    // guardamos el avatar que el usuario ha escogido en $avartar


    $usuario = filter_var($usuario, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // sanitizamos el nombre de usuario para quitar caracteres especiales.
        // Por ejemplo: < se convierte en &tl;
        //              > se convierte en &gt;
        //              & se convierte en &amp;
        //              " se convierte en &quot;
        //              ' se convierte en &#39; este esta raro
        // Todo esto se hace con el fin de reducir los XSS.

    if(empty($usuario) || mb_strlen($usuario) < 3) {
        $errores[] = "L'usuari ha de tenir almenys 3 caracters.";
    }
    // Si el $usuario esta vacio o tiene menos de 3 caracteres, 
    //se almacena en el $errores que el usuario ha de tener al menos 3 caracteres.

    if(empty($pass) || mb_strlen($pass) < 6) {
        $errores[] = "La contrasenya ha de tenir almenys 6 caracters.";
    }
    // Si $pass esta vacio o tiene menos de 6 caracteres,
    // se almacena en $errores que la contraseña ha de tener al menos 6 caracteres.

    if($pass !== $pass_confirm){
        $errores[] = "Les contrasenyes no coincideixen.";
    }
    // Si $pass y $pass_confirm no coinciden (osea, la confirmacion de la cotnraseña no es la misma que la contraseña)
    // se almacena en $errores que las contraseñas no coniciden.

    $avatars_permesos = ['Ninot', 'Dona1', 'Dona2', 'Home1', 'Home2'];
    if(!in_array($avatar, $avatars_permesos)) {
        $errores[] = "L'avatar seleccionat no és vàlid.";
    }
    // este realmente no hacia falta hacerlo asi de estricto, quiero decir, en registre.php podria haber hecho un bucle 
    // para que mostrara todos los avatares que hay disponibles en su directorio, pero esto 
    // facilitaba todo un poco mas. Pero si quiero meter mas avatares o que el usuario pueda subir su propio avatar
    // esto se deberia de modificar este codigo para que fuera algo asi:

        //foreach (archivo_avatar as archivo):
            // if archivo != '.' && archivo != '..':
                //avatars_permesos[]= pathinfo(archivo, PATHINFO_FILENAME)

    // Si, lo que acabo de escribir es una aberracion que tiene python+php pero es solo concepto, no me decapite porfa.
    
    // guardamos en $avatars_permesos los avatares que estan disponibles, que son los siguientes:['Ninot', 'Dona1', 'Dona2', 'Home1', 'Home2']
        // ahora hacemos la comparacion:
        // si en el array $avatar NO hay lo mismo que hay en $avatars_permesos:
                // guarda en $errores que el avatar seleccionado no es valido.
    
    if (empty($errores)) {
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE username = :user');
        $stmt->execute(['user' => $usuario]);
    // Si no hay ningun error (es decir, todo ha ido bien):
        // preparamos la consulta en la cual buscamos el username que se le pase como parametro user
        // que en este caso es $usuario
        // esto nos sirve para saber si el usuario que se quiere crear ya existe. La comparacion se hace en 
        // el siguiente § (§ == párrafo).
    

        if($stmt->fetchColumn() > 0) {
            $errores[] = "Aquest usuari ja existeix.";
        } else {
            $hash = password_hash($pass, PASSWORD_DEFAULT);

        // si en $stmt existe algun usuario que sea $usuarioç
            // decimos que el usuario ya existe.
        // que no:
            // guardamos la contraseña en $hash hashandolo con Bcript (mas info: https://www.php.net/manual/en/password.constants.php#constant.password-default)

            $insertuser = $pdo->prepare("INSERT INTO users (username, password, avatar) VALUES (:user, :pass, :avatar)");
            $registro = $insertuser->execute([
                'user' => $usuario,
                'pass' => $hash,
                'avatar' => $avatar
            ]);

            // Una vez pasadas todas las comprovaciones, toca meter al usuario y sus preferencias y contraseña en la base de datos:
            // preparamos el insert, insertando en la tabla users el username, pass y avatar. Esto lo guardamos en $insertuser.
            // por $registro le pasamos los datos como array asociativo de user, que es $usuario, pass que es $hash (ya no es $pass, porque ya hemos encriptado la
            // contraseña), y el avatar como $avatar.


            if($registro) {
                $exito = "L'usuari s'ha creat correctament";
                header('Location: login.php');
                exit;
            } else {
                $errores[] = "L'usuari no s'ha creat per algún motiu!";
            }
            // si el registro no ha dado ningun error:
                // en $exito metemos: El usuario se ha creado correctamente.
                // redireccionamos al usuario a la pagina de iniciar sesion
            // si no:
                // metemos en $errores que el usuario no se ha creado por algun motivo.
        }   
    }
}


?>