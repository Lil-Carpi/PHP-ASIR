<?php
/* Carga archivos vista/componente y le pasa datos para que los utilice
$filename (string):  El nombre del archivo a cargar (sin la extension .php) 
$data (array):       Array asociativo con los datos que se quiere pasar al archivo, que, por defecto, esta vacio.
*/
function view(string $filename, array $data = []): void
{
    // extract() pilla un array asociativo y convierte sus claves en variables locales.
    // basicamente: ['title' => 'Minetest Wiki v2 - Inici', 'place' => '- Inici'] esto crea las variables de $title y $place
    // Puedes ver como funciona en cualquier pagina que este en /public, en las primeras 10 lineas.
    extract($data);

    // Crea la ruta absoluta con direccion a '/src/inc/ e incluye el archivo.
    // utilizar require_once evita que un mismo archivo se cargue dos veces.
    require_once __DIR__ . '/../inc/' . $filename . '.php';
}
?>