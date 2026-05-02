<?php
// Backend de index.html
// Frontend es /public/index.html

$mensaje = '';
// Ambas son variables globales para poder mostrar mensajes de error o de exito en el frontend.
$clase_mensaje = '';



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['esborrar_id']) && isset($_SESSION['user_id'])) {
  try {
    $stmt = $pdo->prepare('DELETE FROM dtItems WHERE ItemId = ?');
    $stmt->execute([$_POST['esborrar_id']]);
    $mensaje = 'Ítem esborrat correctament!';
    $clase_mensaje = "success";
  } catch (PDOException $e) {
    $mensaje = "Esborrat no realitzat per algun error!";
    $clase_mensaje = "error";
  }
}
// Si el usuario ha mandado un requisito de borrar un item y ha iniciado sesion
// se hace el borrado en la base de datos, se da un mensaje de que se ha borrado correctamente y el tipo de mensaje es success.
// Si hay algun tipo de error, se captura con el PDOException y se manda el mensaje de error correspondiente.

// NOTA:
// Los tipos de mensajes me sirven principalmente para poder mostrar el color con respecto al tipo de mensaje que es.
//  Si es succes, es verde. Si es rojo, es error



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_save_id']) && isset($_SESSION['user_id'])) {
  try {
    $stmt = $pdo->prepare('UPDATE dtItems SET Nom = ?, Descripcio = ? WHERE ItemId = ?');
    $stmt->execute([$_POST['itemName'], $_POST['descripcion'], $_POST['editar_save_id']]);
    $mensaje = "Ítem actualitzat correctament!";
    $clase_mensaje = "success";
  } catch (PDOException $e) {
    $mensaje = "Esborrat no realitzat per algun error!";
    $clase_mensaje = "error";
  }
}

// Si el usuario ha pedido editar el item y el mismo ha iniciado sesion:
// se prepara el update y se manda la edicion a la base de datos.
// Tambien se le da al usuario el mensaje de exito con su respectivo $clase_mensaje.
// Si ha fallado, se captura cone l PDOException y se da su error correspondiente.


// Obtencion de items
$stmt = $pdo->query('SELECT * FROM dtItems');
$items = $stmt->fetchAll();

// Nos sirve para hacer el display en el index.


//
//  Comentarios (opcional)
//  Acepto feedback, no broma.
//

// GUARDAR UN NUEVO COMENTARIO (Texto + GIF)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_comment') {
    if (isset($_SESSION['user_id']) && !empty(trim($_POST['comment']))) {
        $nuevo_comentario = trim($_POST['comment']);
        $gif_url = trim($_POST['gif_url'] ?? ''); 
        // verificamos que el usuario ha iniciado sesion y que el comentario no sea solo espacio en blanco.
        // Si el comentario tiene contenido, se guardará en la base de datos.
        // tambien se puede añadir un gif si el usuario lo desea en un campo aparte especifico para gifs.

        // NOTA:
        // Para los gifs, se ha de poner la url de un gif de cualquier pagina web.
        // Por ejemplo: https://media.tenor.com/Dd2dQDlK2cAAAAAj/ishowspeed-speed.gif

        if (!empty($gif_url) && !filter_var($gif_url, FILTER_VALIDATE_URL)) {
            $gif_url = null; 
        }
        // Si el campo de gif no esta vacio, se hace un filtro para validar que lo que se ha mandado sea 
        // realmente una URL. De lo contrario, se le añade el valor null.


        $insertStmt = $pdo->prepare("INSERT INTO comentaris (user_id, comment, gif_url) VALUES (:user_id, :comment, :gif_url)");
        $insertStmt->execute([
            'user_id' => $_SESSION['user_id'],
            'comment' => $nuevo_comentario,
            'gif_url' => empty($gif_url) ? null : $gif_url
        ]);
        
        // Preparamos el insert a la base de datos, y guardamos el id del usuario, el comentario y el gif si hace falta. 
        // Lo del gif, usamos un operador ternario para asegurarnos de que no metemos ningun null a la db.
        
        // Nota:
        // Un operador ternario es como un if/else corto de una sola linea. Para comparar es como el arrow funcion de JS en terminos de concepto.
        // En vez de hacer una funcion tocha, puedes hacer una funcion anonima de como... 2 a 3 lineas. el concepto es el mismo, pero es un if/else.
        // La estructura es siempre la misma:
        // condicion_a_comprovar ? valor_si_es_true : valor_si_es_false.
        
        // En este caso, 'gif_url' => empty($gif_url) ? null : $gif_url se podria traducir a:
          // if(empty($gif_url)){
          //  $resultado = null;
          //} else {
          //  $resultado = $gif_url
          //}
          // 'gif_url' => $resultado
        
        
        header('Location: index.php');
        exit;

        // Una vez editado, se manda al usuario a index.
    }
}

// PROCESO DE EDICIÓN DE COMENTARIO
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit_comment') {
    $id_comentario = $_POST['id_comentario'] ?? null;
    $nuevo_texto = trim($_POST['comment'] ?? '');
    // pillamos el id del comentario y el texto texto
    if ($id_comentario && !empty($nuevo_texto) && isset($_SESSION['user_id'])) {
        try {
            $stmt = $pdo->prepare("UPDATE comentaris SET comment = ? WHERE id = ? AND user_id = ?");
            $stmt->execute([$nuevo_texto, $id_comentario, $_SESSION['user_id']]);
    // Si el id del comentario no esta vacio y el usuario ha iniciado sesion
    // se prepara el update a la base de datos y se la mandamos al backend (Proteccion ^^ IDOR ^^ incluido).
            header("Location: index.php?mensaje=Comentari actualitzat");
            exit;
        } catch (PDOException $e) {
            $mensaje = "Error al actualitzar el comentari.";
        }
        // si ha habido algun problema, pillamos el error con PDOException y decimos que el comentario no se ha podido actualizar.
    }
}

// BORRADO DE LOS COMENTARIOS
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_a_borrar'])) {
    $id_a_borrar = $_POST['id_a_borrar'];
    if (isset($_SESSION['user_id'])) {
      try {
        $stmt = $pdo->prepare('DELETE FROM comentaris WHERE id = ? AND user_id = ?');
        $stmt->execute([$id_a_borrar, $_SESSION['user_id']]);

        header("Location: index.php");

        // Si el usuario manda la peticion de borrar el post, pillamos el id del post
        // si el usuario ha iniciado sesion
        // se prepara el delete del comentario de la base de datos (otra vez, con proteccion IDOR)
        // Una vez que se borre, se le devuelve a index.
        exit;
      } catch (PDOException $e) {
        $mensaje = "Error al borrar el comentario.";
        // si ha habido algun problema, pillamos el error con PDOException y decimos que el comentario no se ha podido borrar.
      }
    }
}

// OBTENER LOS COMENTARIOS EXISTENTES
// Tambien incluimos a los autores de cada comentario.
// Con el join, hacemos fusion de la tabla comentaris con la tabla users por user_id.
// Esto permite traer el comentario y datos del autor en una sola consulta.
// Ordenamos por orden descendente y limitamos a solo 30 comentarios.
$comentariosStmt = $pdo->query("
    SELECT comentaris.id, comentaris.comment, comentaris.gif_url, comentaris.created_at, comentaris.user_id, users.username, users.avatar
    FROM comentaris
    JOIN users ON comentaris.user_id = users.id
    ORDER BY comentaris.created_at DESC
    LIMIT 30
");
$comentarios = $comentariosStmt->fetchAll();
?>