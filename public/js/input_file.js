
function displayFileName(input) {
    var fileName = input.files[0].name;
    var fileText = input.parentNode.querySelector('.fileText');
    // Actualiza el contenido del elemento fileText con el nombre del archivo seleccionado
    fileText.innerHTML = '<i class="fa-solid fa-arrow-up-from-bracket"></i> ' + fileName;
    // Muestra el icono de eliminar
    input.parentNode.querySelector('.remove-icon').classList.add('show');
}

function removeFile(input) {
    var parent = input.parentNode;
    var fileText = parent.querySelector('.fileText');
    // Limpia el valor del input de archivo
    input.value = '';
    // Oculta el icono de eliminar
    parent.querySelector('.remove-icon').classList.remove('show');
    // Restaura el texto predeterminado en fileText
    fileText.innerHTML = '<i class="fa-solid fa-arrow-up-from-bracket"></i> Haz clic aquí para subir el documento';
}
