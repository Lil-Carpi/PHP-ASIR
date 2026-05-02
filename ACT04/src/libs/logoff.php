<?php
// Backend para la confirmacion del cerrado de sesion.
// Su frontend es /public/logout.php

// Se linkea a boostrap. No se porque esta, pero si lo quito da error.
//require __DIR__ . '/boostrap.php';
// No, definitivamente no hace nada, porque lo he quitado y sigue funcionado.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['confirm'] === 'yes') {
        session_destroy();
    }
    header('Location: /../../index.php');
    exit;
// basicamente: Recibimos como post la peticion 
// para crujirnos la cookie de sesion del usuario.
// despues se le redirecciona a la pagina principal.
}