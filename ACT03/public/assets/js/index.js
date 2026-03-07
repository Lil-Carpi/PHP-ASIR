function seleccionarImatge(elementImatge) {
    // 1. Quitar la clase 'selected' de todas las imágenes
    let imatges = document.querySelectorAll('.selectable-image');
    imatges.forEach(img => img.classList.remove('selected'));

    // 2. Añadir la clase 'selected' a la imagen que acabamos de clicar
    elementImatge.classList.add('selected');

    // 3. Coger el nombre del archivo guardado en el atributo data-filename
    let nomArxiu = elementImatge.getAttribute('data-filename');

    // 4. Escribir ese nombre automáticamente en el input de texto del formulario
    let inputNomImatge = document.querySelector('input[name="imageName"]');
    if(inputNomImatge) {
        inputNomImatge.value = nomArxiu;
    }
}
